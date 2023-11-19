<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    // function acceder()
    // {
    //     return 'Jai accès!';
    // }
    // function pasacceder()
    // {
    //     return 'Jai pas accès!';
    // }

    // function login()
    // {
    //     return (view('pages.headerNotLoggedin') . view('pages.login'));
    // }

    // function register()
    // {
    //     return (view('pages.headerNotLoggedin') . view('pages.register'));
    // }

    function index()
    {
        $categories = Categorie::all();
        $products = Product::all();
        return view('main.index', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    function productDetails()
    {
        return (view('main.product-details'));
    }

    function shop()
    {
        return (view('main.shop'));
    }

    function register()
    {
        return (view('auth.register'));
    }

    function login()
    {
        return (view('auth.login'));
    }

    function cart(Request $request)
    {
        $currentBasket = session('panier', []);
        $ids = array_keys($currentBasket);
        $products = Product::whereIn('id', $ids)->get();
        return (view('main.cart', compact('products', 'currentBasket')));
    }

    function checkout()
    {
        return (view('main.checkout'));
    }

    function contact()
    {
        return (view('main.contact'));
    }



}
