<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

final class CatalogController extends Controller
{
    /**
     * @param  Category|null  $category
     * @return View
     */
    public function __invoke(?Category $category): View
    {
        $categories = Category::query()
            ->select('id', 'title', 'slug')
            ->has('products')
            ->get();

        $products = Product::query()
            ->select(['id', 'title', 'slug', 'price', 'thumbnail'])
            ->when(request('s'), function (Builder $query) {
                $query->whereFullText(['title', 'text'], request('s'));
            })
            ->when($category?->id, function (Builder $query) use ($category) {
                $query->whereRelation(
                    'categories',
                    'categories.id',
                    '=',
                    $category->id
                );
            })
            ->filtered()
            ->sorted()
            ->paginate(6);

        return view('catalog.index',
            compact('categories', 'products', 'category')
        );
    }
}
