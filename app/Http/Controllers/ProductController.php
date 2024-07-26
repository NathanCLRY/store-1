<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favoris;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //home show last product and all categories
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->paginate(10);
        if (isset(auth()->user()->id)) {
            $favs = Favoris::where('user_id', '=', auth()->user()->id)
                ->get();
        } else {
            $favs = null;
        }
        return view('product.products', compact('categories', 'products', 'favs'));
    }

    //detail: show product detail
    public  function show(Product $product)
    {
        $products = Product::where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        if (isset(auth()->user()->id)) {
            $fav = Favoris::where('user_id', '=', auth()->user()->id)
                ->where('product_id', '=', $product->id)
                ->first();
            $favs = Favoris::where('user_id', '=', auth()->user()->id)
                ->get();
        } else {
            $fav = null;
            $favs = null;
        }
        return view('product.show', compact('product', 'products', 'fav', 'favs'));
    }

    //show  last product by category
    public function productByCategory()
    {
        return view('product.products');
    }

    public function favoris(Product $product)
    {
        $fav = Favoris::where('user_id', '=', auth()->user()->id)
            ->where('product_id', '=', $product->id)
            ->first();

        if (isset($fav)) {
            $fav->delete();
        } else {
            Favoris::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product->id
            ]);
        }

        return back();
    }
}
