<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\View\ViewModels\HomeViewModel;

final class HomeController extends Controller
{
    /**
     * @return HomeViewModel
     */
    public function __invoke(): HomeViewModel
    {
        return (new HomeViewModel())->view('home');
    }
}
