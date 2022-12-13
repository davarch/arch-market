<?php

declare(strict_types=1);

namespace Domain\Order\Concerns;

use Closure;

trait PaymentEvents
{
    protected static Closure $onCreating;

    protected static Closure $onSuccess;

    protected static Closure $onValidating;

    protected static Closure $onError;

    /**
     * @param  Closure  $event
     */
    public static function onCreating(Closure $event): void
    {
        self::$onCreating = $event;
    }

    /**
     * @param  Closure  $event
     */
    public static function onSuccess(Closure $event): void
    {
        self::$onSuccess = $event;
    }

    /**
     * @param  Closure  $event
     */
    public static function onValidating(Closure $event): void
    {
        self::$onValidating = $event;
    }

    /**
     * @param  Closure  $event
     */
    public static function onError(Closure $event): void
    {
        self::$onError = $event;
    }
}
