<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')
            ->paginate(6);
        $seasons = Season::all();

        return view('product', compact('products', 'seasons'));
    }



    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $seasons = Season::all();

        return view('show', compact('product', 'seasons'));
    }



    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        if ($request->has('season_ids')) {
            $product->seasons()->sync($request->season_ids);
        } else {
            $product->seasons()->sync([]);
        }

        return redirect()->route('products.index');
    }



    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->seasons()->detach();

        $product->delete();

        return redirect()->route('products.index');
    }


    public function search(Request $request)
    {
        $products = Product::with('seasons')
            ->KeywordSearch($request->keyword)
            ->Paginate(6)
            ->appends($request->all());

        $seasons = Season::all();

        return view('product', compact('products', 'seasons'));
    }



    public function showRegister()
    {
        $files = Storage::files('public/images');
        $images = array_map(function ($file) {
            return Storage::url($file);
        }, $files);

        $seasons = Season::all();

        $product = null;

        return view('register', compact('product', 'images', 'seasons'));
    }



    public function register(ProductRequest $request)
    {
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        if ($request->has('season_ids')) {
            $product->seasons()->attach($request->season_ids);
        }

        return redirect()->route('products.index');
    }
}
