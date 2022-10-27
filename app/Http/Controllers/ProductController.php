<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $datas = Product::join('admin', 'admin.id_admin', '=', 'product.id_admin')->get();

        return view('product.index')->with('datas', $datas);
    }

    public function create() {
        return view('product.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_admin' => ['required', 'string', 'exists:admin,id_admin'],
            'id_produk' => ['required', 'string', 'unique:product,id_produk'],
            'merk' => ['required', 'string'],
            'stok' => ['required', 'integer'],
            'harga' => ['required', 'integer'],
        ]);

        Product::updateOrCreate([
            'id_admin' => $request->id_admin,
            'id_produk' => $request->id_produk,
            'merk' => $request->merk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('product.index')->with('success', 'Data Produk berhasil disimpan');
    }

    public function edit($id) {
        $data = Product::where('id_produk', $id)
            ->join('admin', 'admin.id_admin', '=', 'product.id_admin')
            ->first();

        return view('product.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_admin' => ['required', 'string', 'exists:admin,id_admin'],
            'id_produk' => ['required', 'string', 'unique:product,id_produk,' . $id],
            'merk' => ['required', 'string'],
            'stok' => ['required', 'integer'],
            'harga' => ['required', 'integer'],
        ]);

        Product::where('id_produk', $id)->update([
            'id_admin' => $request->id_admin,
            'id_produk' => $request->id_produk,
            'merk' => $request->merk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('product.index')->with('success', 'Data Produk berhasil diubah');
    }

    public function delete($id) {
        Product::where('id_produk', $id)->delete();

        return redirect()->route('product.index')->with('success', 'Data Produk berhasil dihapus');
    }
}
