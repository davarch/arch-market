<?php

declare(strict_types=1);

namespace Domain\Cart;

use Domain\Cart\Contracts\CartIdentityStorageContract;
use Domain\Cart\Models\Cart;
use Domain\Cart\Models\CartItem;
use Domain\Cart\StorageIdentities\FakeIdentityStorage;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Support\ValueObjects\Price;

final class CartManager
{
    public function __construct(protected CartIdentityStorageContract $identityStorage)
    {
    }

    public function add(Product $product, int $quantity = 1, array $optionValues = []): Model|Builder|Cart
    {
        $storage_id = $this->identityStorage->get();

        $cart = Cart::query()
            ->updateOrCreate(
                [
                    'storage_id' => $storage_id,
                ],
                $this->storedData($storage_id)
            );

        $cartItem = $cart->cartItems()->updateOrCreate(
            [
                'product_id' => $product->getKey(),
                'string_option_values' => $this->stringedOptionValues($optionValues),
            ],
            [
                'price' => $product->price,
                'quantity' => DB::raw("quantity +  $quantity"),
                'string_option_values' => $this->stringedOptionValues($optionValues),
            ]
        );

        $cartItem->optionValues()->sync($optionValues);

        $this->forgetCache();

        return $cart;
    }

    public function quantity(CartItem $item, int $quantity = 1): void
    {
        $item->update([
            'quantity' => $quantity,
        ]);

        $this->forgetCache();
    }

    public function delete(CartItem $item): void
    {
        $item->delete();
        $this->forgetCache();
    }

    public function truncate(): void
    {
        if ($this->get()) {
            $this->get()->delete();
        }

        $this->forgetCache();
    }

    public function count(): int
    {
        return $this->cartItems()
            ->sum(fn (CartItem $item) => $item->quantity);
    }

    public function amount(): Price
    {
        return Price::make(
            $this->cartItems()
                ->sum(fn (CartItem $item) => $item->amount->raw())
        );
    }

    public function items(): Collection
    {
        if (! $this->get()) {
            return collect([]);
        }

        return CartItem::query()
            ->with(['product', 'optionValues.option'])
            ->whereBelongsTo($this->get())
            ->get();
    }

    public function updateStorageIdentity(string $old, string $current): void
    {
        Cart::query()
            ->where('storage_id', $old)
            ->update($this->storedData($current));
    }

    private function storedData(string $id): array
    {
        $data = [
            'storage_id' => $id,
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }

    private function stringedOptionValues(array $optionValues): string
    {
        sort($optionValues);

        return implode(';', $optionValues);
    }

    private function get(): Cart|bool
    {
        return cache()->remember($this->cacheKey(), now()->addHour(), function () {
            return Cart::query()
                ->with('cartItems')
                ->where('storage_id', $this->identityStorage->get())
                ->when(auth()->check(), fn (Builder $q) => $q->orWhere('user_id', auth()->id()))
                ->first() ?? false;
        });
    }

    private function cartItems(): Collection
    {
        if (! $this->get()) {
            return collect([]);
        }

        return $this->get()->cartItems;
    }

    private function cacheKey(): string
    {
        return str('cart_'.$this->identityStorage->get())
            ->slug('_')
            ->value();
    }

    private function forgetCache(): void
    {
        cache()->forget($this->cacheKey());
    }

    public static function fake(): void
    {
        app()->bind(CartIdentityStorageContract::class, FakeIdentityStorage::class);
    }
}
