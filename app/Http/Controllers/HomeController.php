<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        $categories = Category::popular();
        $products = Product::popular();
        $brands = Brand::popular();

        return view('home', compact('categories', 'brands', 'products'));
    }
}
