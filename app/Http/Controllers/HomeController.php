<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $rows = Wishlist::get();

        return view('home', compact('rows'));
    }
}
