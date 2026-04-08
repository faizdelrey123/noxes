<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // ADMIN & PETUGAS - LIST
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('series', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        if (auth()->user()->role == 'petugas') {
            return view('staff.product.index', compact('products'));
        }
        return view('admin.products.index', compact('products'));
    }

    // FORM TAMBAH
    public function create()
    {
        if (auth()->user()->role == 'petugas') {
            return view('staff.product.create');
        }
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
            'spesifikasi' => $request->spesifikasi,
            'image' => $imageName
        ]);

        $route = auth()->user()->role == 'petugas' ? 'staff.product.index' : 'admin.product.index';
        return redirect()->route($route)
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if (auth()->user()->role == 'petugas') {
            return view('staff.product.edit', compact('product'));
        }
        return view('admin.products.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        $route = auth()->user()->role == 'petugas' ? 'staff.product.index' : 'admin.product.index';
        return redirect()->route($route)->with('success', 'Produk berhasil diubah');
    }

    // HAPUS
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }

    // USER - LIST PRODUK
    public function userProducts(\Illuminate\Http\Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('series', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
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