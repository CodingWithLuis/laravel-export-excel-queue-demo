<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('orders.index');
    }
}
