<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use File;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function countdata() {
        $usercount = User::count();
        $productcount = Product::count();
        return view('dashboard', compact('productcount','usercount'));
    }

    public function cari(Request $request){
        // menangkap data pencarian
	    $cari = $request->cari;
        // $products = Product::all();

        // mengambil data dari table pegawai sesuai pencarian data
        $products = DB::table('products')
        ->where('nama_produk','like',"%".$cari."%")
        ->paginate();

        // mengirim data pegawai ke view index
        return view('product.index',['products' => $products]);
    }

    public function create() {
        return view('product.create');
    }

    public function store(Request $request) {
        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'image' => $this->saveImg($request->image)
        ]);

        return redirect('/product')->with('success', 'Berhasil Menambah Data Produk');
    }

    public function edit(Product $product) {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $product->update([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'image' => $request->hasFile('image') ? $this->saveImg($request->image, $product->image) : $product->image
        ]);

        return redirect('/product')->with('success', 'Data berhasil diupdate!');
    }

    public function delete(Product $product){
        if (File::exists(public_path('img/gambar_produk/'. $product->image))) {
            File::delete(public_path('img/gambar_produk/'. $product->image));
        }

        $product->delete();
        return redirect('/product');
    }

    public function saveImg($image, $old_image = null){

        if ($old_image) {
            if (File::exists(public_path('img/gambar_produk/'. $old_image))) {
                File::delete(public_path('img/gambar_produk/'. $old_image));
            }
        }

        $nama_file = time().$image->getClientOriginalExtension();
        $tujuan_upload = 'img/gambar_produk';

		$image->move($tujuan_upload,$nama_file);

        return $nama_file;
	}


}
