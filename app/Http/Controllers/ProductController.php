<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use App\Like;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $parent_cats = Category::where('parent_id', '=', 0)->get();
        $sub_cats = Category::where('parent_id', '!=', 0)->get();

        return view('products.create', compact('parent_cats', 'sub_cats'));
    }

    public function store(Request $request)
    {
       $data = request()->validate([
           'title' => 'required',
           'price' => 'required',
           'description' => 'required',
           'category_id' => 'required',
           'image' => 'required|mimes:jpeg,png,jpg,gif',
       ]); 

        $file_name = time().'.'.request()->image->getClientOriginalExtension();
        $save = $request->file('image')->storeAs('public/images', $file_name);

       auth()->user()->products()->create([
           'title' => $data['title'],
           'price' => $data['price'],
           'description' => $data['description'],
           'category_id' => $data['category_id'],
           'image' => $file_name,
       ]);

       return redirect('/');
    }

    public function show(Product $product)
    {
        $parent_cat = Category::where('id', '=', $product->category->parent_id)->first()['title'];
        $comments = Comment::where('product_id', $product->id)->get();
        $like_count = Like::where('product_id', $product->id)->count();
        return view('products.show', compact('product', 'parent_cat', 'comments', 'like_count'));
    }

    public function store_comment()
    {
        $data = request()->validate([
            'text' => 'required',
            'product_id' => 'required',
        ]);

        auth()->user()->comments()->create([
            'text' => $data['text'],
            'product_id' => $data['product_id'],
        ]);

        return redirect('/show/'. $data['product_id']);

    }

    public function like()
    {
        $data = request()->validate([
            'product_id' => '',
            'likes' => '',
        ]);

        auth()->user()->likes()->updateOrCreate([
            'product_id' => $data['product_id'],
            'likes' => True,
        ]);

        return redirect('/show/'. $data['product_id']);
    }
}
