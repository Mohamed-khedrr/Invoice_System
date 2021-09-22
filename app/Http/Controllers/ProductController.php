<?php

namespace App\Http\Controllers;

use App\Product;
use App\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products/products', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_name' => "required | unique:products,product_name",
            'description' => "required",
            'section_id' => "required"
        ], [
            'product_name.unique' => "اسم المنتج موجود مسبقا",
            'product_name.required' => "يرجي وضع اسم للمنتج",
            'description.required' => "يرجي وضع وصف للمنتج",
            'section_id.required' => "يرجي اختيار القسم"
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id
        ]);
        session()->flash('insert', 'تم حفظ المنتج');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = $request->validate(
            [
                'product_name' => "required | unique:products,product_name, $request->id",
                'section_name' => 'required',
                'description' => 'required'
            ],
            [
                'product_name.required' => 'برجاء ادخال اسم المنتج',
                'product_name.unique' => 'اسم المنتج موجود مسبقا',
                'sectino_name.required' => 'برجاء ختيار القسم',
                'description.required' => 'برجاء ادخال اسم الوصف',
            ]
        );
        $section_id = Section::where('section_name', $request->section_name)->pluck('id')->first();
        $data = Product::findOrFail($request->id);
        $data->update([
            'product_name' => $request->product_name,
            'section_id' => $section_id,
            'description' => $request->description
        ]);
        session()->flash('edit', 'تم التعديل ');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Product::findOrFail($request->id);
        $data->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect()->route('products.index');
    }
}
