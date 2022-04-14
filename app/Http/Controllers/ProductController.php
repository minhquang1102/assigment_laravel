<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

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
            ->with('category', function ($query) {
                $query->select('id', 'name');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('product.index', ['products' => $productsGet]);
        // dd('Danh sach category', $categories, $categoriesGet);
    }

    public function create()
    {
        return view('product.create');
    }

    
    public function store(Request $request)
    {
        $productRequest = $request->all();
        $product = new Product();
        $product->name = $productRequest['name'];
        $product->description = $productRequest['description'];
        $product->price = $productRequest['price'];
        $product->image_url = $productRequest['image_url'];
        $product->status = $productRequest['status'];
        $product->category_id = $productRequest['category_id'];
        // use Illuminate\Support\Str;

        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Tra ve thong tin ban ghi product theo id
    public function edit(Product $id)
    {
        $products = $id->products;
        $productsWithPaginate = $id
            ->products()->select('name')->paginate(10);
        return view('product.create', [
            'product' => $id,
            'products' => $productsWithPaginate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Cap nhat thong tin cua 1 ban ghi
    public function update(ProductRequest $request, Product $id)
    {
        $proUpdate = $id;
        // Gan gia tri moi cho doi tuong $cateUpdate
        $proUpdate->name = $request->name;
        $proUpdate->description = $request->description;
        $proUpdate->price = $request->price;
        $proUpdate->image_url = $request->image_url;
        $proUpdate->status = $request->status;
        $proUpdate->category_id = $request->category_id;
        // Thuc thi viec luu du lieu moi vao DB
        $proUpdate->update();
        // Quay ve danh sach
        return redirect()->route('products.index');
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
