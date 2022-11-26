<?php

declare(strict_types=1);

namespace App\View\ViewModels;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

final class HomeViewModel extends ViewModel
{
    /**
     * @return Collection
     */
    public function categories(): Collection
    {
        return Category::popular();
    }

    /**
     * @return Collection
     */
    public function brands(): Collection
    {
        return Brand::popular();
    }

    /**
     * @return Collection
     */
    public function products(): Collection
    {
        return Product::popular();
    }
}
