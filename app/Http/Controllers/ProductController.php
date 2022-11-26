<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;

final class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load(['optionValues.option']);

        $also = Product::query()
            ->where(function ($query) use ($product) {
                $query->whereIn('id', session('also', []))
                    ->where('id', '!=', $product->id);
            })
            ->get();

        $options = $product->optionValues->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });

        session()->put('also.'.$product->id, $product->id);

        return view('product.show', [
            'product' => $product,
            'options' => $options,
            'also' => $also,
        ]);
    }
}
