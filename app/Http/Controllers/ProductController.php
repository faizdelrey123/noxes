<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // ADMIN & PETUGAS - LIST
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.products.create');
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'series' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        Product::create([
            'name' => $request->name,
            'series' => $request->series,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    // HAPUS
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }

    // USER - LIST PRODUK
    public function userProducts()
    {
        $products = Product::all();
        return view('user.products.index', compact('products'));
    }

    // DETAIL PRODUK
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.products.detail', compact('product'));
    }

    // FILTER SERIES
    public function bySeries($series)
    {
        $products = Product::where('series', $series)->get();
        return view('user.products.index', compact('products'));
    }
}