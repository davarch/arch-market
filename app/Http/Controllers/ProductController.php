<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\View\ViewModels\ProductViewModel;
use Domain\Product\Models\Product;

final class ProductController extends Controller
{
    public function __invoke(Product $product): ProductViewModel
    {
        return (new ProductViewModel($product))->view('product.show');
    }
}
