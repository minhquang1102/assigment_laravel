<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Tra ve danh sach cac ban ghi product
    public function index()
    {
        // Eloquent
        // all: lay ra toan bo cac ban ghi
        $products = Product::all();
        // get: lay ra toan bo cac ban ghi, ket hop dc cac dieu kien #
        // get se nam cuoi cung cua doan truy van
        // lay danh sach va kem ban ghi quan he
        // with() ngay trong cau truy van
        $productsGet = Product::select('id', 'name', 'price', 'category_id')
            // ->with('category', function ($query) {
            //     $query->select('id', 'name');
            // })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('product.index', ['products' => $productsGet]);
        // dd('Danh sach category', $categories, $categoriesGet);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Tao ban ghi product moi
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Tra ve thong tin ban ghi product theo id
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Cap nhat thong tin cua 1 ban ghi
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Xoa 1 ban ghi product
    public function delete(Product $pro)
    {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($pro->delete()) {
            return redirect()->route('products.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $productDelete = Product::destroy($id);
        if ($productDelete !== 0) {
            return redirect()->route('products.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
}
