<?php

declare(strict_types=1);

namespace App\Jobs;

use Domain\Product\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class ProductJsonProperties implements ShouldQueue, ShouldBeUnique
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    public function __construct(public Product $product)
    {
    }

    public function handle(): void
    {
        $this->product->updateQuietly([
            'json_properties' => $this->product->properties->keyValues(),
        ]);
    }

    public function uniqueId()
    {
        return $this->product->getKey();
    }
}
