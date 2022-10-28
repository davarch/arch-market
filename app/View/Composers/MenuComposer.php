<?php

namespace App\View\Composers;

use App\Models\Menu;
use Cache;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        $view->with('menu', Cache::remember('menu', 60 * 60 * 24, static fn () => Menu::all()));
    }
}
