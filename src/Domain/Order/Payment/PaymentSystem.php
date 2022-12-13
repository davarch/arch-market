<?php

declare(strict_types=1);

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Concerns\PaymentEvents;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProcessException;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Payment;
use Domain\Order\Models\PaymentHistory;
use Domain\Order\States\Payment\PaidPaymentState;

final class PaymentSystem
{
    use PaymentEvents;

    /**
     * @var PaymentGatewayContract
     */
    protected static PaymentGatewayContract $provider;

    /**
     * @param  PaymentGatewayContract|Closure  $providerOrClosure
     * @return void
     *
     * @throws PaymentProviderException
     */
    public static function provider(PaymentGatewayContract|Closure $providerOrClosure): void
    {
        if (is_callable($providerOrClosure)) {
            $providerOrClosure = $providerOrClosure();
        }

        self::instanceOfGateway($providerOrClosure);

        self::$provider = $providerOrClosure;
    }

    /**
     * @throws PaymentProviderException
     */
    public static function create(PaymentData $paymentData): PaymentGatewayContract
    {
        self::instanceOfGateway(self::$provider);

        Payment::query()->create([
            'payment_id' => $paymentData->id,
        ]);

        if (is_callable(self::$onCreating)) {
            $paymentData = call_user_func(self::$onCreating, $paymentData);
        }

        return self::$provider->data($paymentData);
    }

    /**
     * @throws PaymentProviderException
     */
    public static function validate(): PaymentGatewayContract
    {
        self::instanceOfGateway(self::$provider);

        PaymentHistory::query()->create([
            'method' => request()?->method(),
            'payload' => self::$provider->request(),
            'payment_gateway' => get_class(self::$provider),
        ]);

        if (is_callable(self::$onValidating)) {
            call_user_func(self::$onValidating);
        }

        if (self::$provider->validate() && self::$provider->paid()) {
            try {
                $payment = Payment::query()
                    ->where('payment_id', self::$provider->paymentId())
                    ->firstOr(function () {
                        throw PaymentProcessException::paymentNotFound();
                    });

                if (is_callable(self::$onSuccess)) {
                    call_user_func(self::$onSuccess, $payment);
                }

                $payment->state->transitionTo(PaidPaymentState::class);
            } catch (PaymentProcessException $exception) {
                if (is_callable(self::$onError)) {
                    call_user_func(
                        self::$onError,
                        self::$provider->errorMessage() ?? $exception->getMessage()
                    );
                }
            }
        }

        return self::$provider;
    }

    /**
     * @throws PaymentProviderException
     */
    private static function instanceOfGateway(mixed $provider): void
    {
        if (! $provider instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }
    }
}
