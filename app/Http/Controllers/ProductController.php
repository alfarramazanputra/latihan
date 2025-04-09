<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return view('pages.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        if ($request->file('image')) {
            $extention = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name.'_'.time().'.'.$extention;
            $request->file('image')->move(public_path('assets/products'), $newName);
        } else {
            $newName = null;
        }

        $price = str_replace(['Rp. ', '.'], '', $request->price);

        Product::create([
            'name' => $request->name,
            'price' => $price,
            'stock' => $request->stock,
            'image' => $newName
        ]);
        return redirect()->route('products.index')->with('success', 'Berhasil Menambahkan Data Produk!');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $productId = Product::find($id);
        return view('pages.products.edit', compact('productId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $productUpdate = Product::find($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $price = str_replace(['Rp. ', '.'], '', $request->price);

        if ($request->file('image')) {
            // hapus gambar lama jika ada
            if ($productUpdate->image) {
                $oldImagePath = public_path('asset/product_images/' . $productUpdate->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->move(public_path('asset/product_images'), $newName);

            $productUpdate->update([
                'name' => $request->name,
                'price' => $price,
                'stock' => $request->stock,
                'image' => $newName,
            ]);
        } else {
            $productUpdate->update([
                'name' => $request->name,
                'price' => $price,
                'stock' => $request->stock,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Berhasil Mengubah Data Produk!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        Product::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Produk!');
    }
}
