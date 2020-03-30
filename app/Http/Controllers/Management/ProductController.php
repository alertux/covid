<?php

namespace App\Http\Controllers\Management;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_name = Request()->input("product_name");
        $cat_id = Request()->input("category_id");
        $category = Category::orderBy('name', 'asc')->get();
        $products = $this->search_products($product_name, $cat_id)->paginate(15);
        return view('pages.management.product', ['product' => $products, 'product_name' => $product_name, 'category' => $category, 'cat_id' => $cat_id]);
    }

    private function search_products($productname, $category_id = 0, $active = 2){
        $products = DB::table('product as a')->join('category as b', 'a.category_id', '=', 'b.id')->select(DB::raw('a.*, b.name as category_name'))->orderBy('name', 'asc');
        if($productname != NULL)
        {
            $t = '%' . $productname . '%';
            $products = $products->where('name', 'like', $t);
        }

        if($category_id != NULL && $category_id != 0)
        {
            $products = $products->where('category_id', $category_id);
        }
        return $products;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = Category::orderBy('name', 'asc')->get();
        if( count($category) == 0 ){
            Request()->session()->flash('fail', 'Por favor cree una categoría de producto!');
            return redirect()->route("product.index");
        }


        $obj = new \stdClass();
        $obj->id = 0;
        $obj->name = '';
        $obj->barcode = '';
        $obj->unit = '';
        $obj->inventary_min = '';
        $obj->price_in = '';
        $obj->price_out = '';
        $obj->category_id = $category[0]->id;
        $obj->is_active = 0;
        $obj->presentation = '';
        $obj->description = '';
        $obj->image = '';

        return view('pages.management.productedit',
            [
                'cat' => $obj, 'category' => $category
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Product::where('id', $id)->first();

        if (empty($cat)) {
            return redirect()->route("product.index");
        }

        $category = Category::orderBy('name', 'asc')->get();

        return view('pages.management.productedit',
            [
                'cat' => $cat, 'category' => $category
            ]
        );
    }

    public function fill_inventory($product_id)
    {
        $inventory_fill = Request()->input("inventory_fill", 0);
        $product = Product::where('id',$product_id)->first();
        if( empty($product) ){
            $result = [
                'status' => 'no',
                'inventory' => 0
            ];
        }else{
            $refill = $product->inventary_min + $inventory_fill;
            $product->inventary_min = $refill;
            $product->save();
            $result = [
                'status' => 'ok',
                'inventory' => $refill
            ];
            //Request()->session()->flash('success', 'Inventario de llenado exitoso!');
        }

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('product_name');
        $barcode = $request->input('product_barcode');
        $unit = $request->input('product_unit');
        $min = $request->input('product_min');
        $in = $request->input('product_in');
        $out = $request->input('product_out');
        $pre = $request->input('product_pre');
        $category_id = $request->input('category');
        $active = $request->input('active');
        $desc = $request->input('product_desc');
        $data = $request->all();

        if (isset($data['product_image'])) {
            $path = $request->file('product_image')->store('public/product_image');
            $product_image = Storage::url($path);
        }else
            $product_image = "";

        if( $id != 0 ){
            $obj = Product::where('id', $id)->first();
            $obj->name = $name;
            $obj->barcode = $barcode;
            $obj->unit = $unit;
            $obj->inventary_min = $min;
            $obj->price_in = $in;
            $obj->price_out = $out;
            $obj->category_id = $category_id;
            $obj->is_active = $active;
            $obj->presentation = $pre;
            $obj->description = $desc;
            if(isset($product_image))   $obj->image = $product_image;
            $return = $obj->save();
        }else{
            $obj = new Product();
            $obj_data = array(
                'id' => $id,
                'name' => $name,
                'barcode' => $barcode,
                'unit' => $unit,
                'inventary_min' => $min,
                'price_in' => $in,
                'price_out' => $out,
                'category_id' => $category_id,
                'is_active' => $active,
                'presentation' => $pre,
                'description' => $desc,
                'image' => $product_image,
                'user_id' => Auth::user()->id
            );
            $return = $obj->saveData($obj_data);
            $id = $obj->id;
        }


        if ($return === true) {
            Request()->session()->flash('success', 'Producto actualizado con éxito!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("product.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Product::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("product.index");
        }

        $cat->delete();
        Request()->session()->flash('success', 'Producto eliminado éxito!');

        return redirect()->route("product.index");
    }
    
    
}
