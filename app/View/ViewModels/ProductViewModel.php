<?php

namespace App\View\ViewModels;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class ProductViewModel extends ViewModel
{
    public function __construct(public Product $product)
    {
        $product->load(['optionValues.option']);

        session()->put('also.'.$product->id, $product->id);
    }

    public function options()
    {
        return $this->product->optionValues->keyValues();
    }

    public function also(): Collection|array
    {
        return  Product::query()
            ->where(function ($query) {
                $query->whereIn('id', session('also', []))
                    ->where('id', '!=', $this->product->id);
            })
            ->get();
    }
}
