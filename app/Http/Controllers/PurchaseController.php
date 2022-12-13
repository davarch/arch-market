<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final class PurchaseController extends Controller
{
    /**
     * @return Application|RedirectResponse|Redirector
     *
     * @throws PaymentProviderException
     */
    public function index(): Application|RedirectResponse|Redirector
    {
        return redirect(
            PaymentSystem::create(PaymentData::from([]))->url()
        );
    }

    /**
     * @return JsonResponse
     *
     * @throws PaymentProviderException
     */
    public function callback(): JsonResponse
    {
        return PaymentSystem::validate()->response();
    }
}
