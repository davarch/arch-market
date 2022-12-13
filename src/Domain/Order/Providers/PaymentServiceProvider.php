<?php

namespace Domain\Order\Providers;

use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Payment;
use Domain\Order\Payment\Gateways\UnitPay;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * @throws PaymentProviderException
     */
    public function boot(): void
    {
        PaymentSystem::provider(new UnitPay());

        PaymentSystem::onCreating(static function (PaymentData $paymentData) {
            return $paymentData;
        });

        PaymentSystem::onSuccess(static function (Payment $payment) {
        });

        PaymentSystem::onValidating(static function () {
        });

        PaymentSystem::onError(static function (string $message) {
        });
    }
}
