<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
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

    public function register(RegisterRequest $request)
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

        return redirect('products');
    }
}
