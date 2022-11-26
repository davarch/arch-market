<?php

namespace App\ViewModels;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
    protected Collection $categories;

    protected Collection $products;

    protected Collection $brands;

    public function __construct()
    {
        $this->categories = Category::popular();
        $this->products = Product::popular();
        $this->brands = Brand::popular();
    }

    /**
     * @return Collection
     */
    public function categories(): Collection
    {
        return $this->categories;
    }

    /**
     * @return Collection
     */
    public function brands(): Collection
    {
        return $this->brands;
    }

    /**
     * @return Collection
     */
    public function products(): Collection
    {
        return $this->products;
    }
}
