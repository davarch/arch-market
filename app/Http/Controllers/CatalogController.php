<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\View\ViewModels\CatalogViewModel;
use Domain\Catalog\Models\Category;

final class CatalogController extends Controller
{
    /**
     * @param  Category|null  $category
     * @return CatalogViewModel
     */
    public function __invoke(?Category $category): CatalogViewModel
    {
        return (new CatalogViewModel($category))->view('catalog.index');
    }
}
