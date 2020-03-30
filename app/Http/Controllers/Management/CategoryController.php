<?php

namespace App\Http\Controllers\Management;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_name = Request()->input("category_name");
        if($category_name != null){
            $t = '%' . $category_name . '%';
            $category = Category::where('name', 'like', $t)->orderBy('name', 'asc')->paginate(15);
        }else
            $category = Category::orderBy('name', 'asc')->paginate(15);

        return view('pages.management.category', ['category' => $category, 'category_name' => $category_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cat = new \stdClass();
        $cat->id = 0;
        $cat->name = '';
        $cat->description = '';
        $cat->image = '';

        return view('pages.management.categoryedit',
            [
                'cat' => $cat
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
        $cat = Category::where('id', $id)->first();

        if (empty($cat)) {
            return redirect()->route("category.index");
        }

        return view('pages.management.categoryedit',
            [
                'cat' => $cat
            ]
        );
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
        $cat_name = $request->input('category_name');
        $cat_desc = $request->input('category_desc');
        $data = $request->all();

        if (isset($data['category_image'])) {
            $path = $request->file('category_image')->store('public/cat_image');
            $cat_image = Storage::url($path);
        }else
            $cat_image = "";

        if( $id != 0 ){
            $cat = Category::where('id', $id)->first();
            $cat->name = $cat_name;
            $cat->description = $cat_desc;
            if(isset($cat_image))   $cat->image = $cat_image;
            $return = $cat->save();
        }else{
            $cat = new Category();
            $cat_data = array(
                'id' => $id,
                'name' => $cat_name,
                'description' => $cat_desc,
                'image' => $cat_image
            );
            $return = $cat->saveData($cat_data);
            $id = $cat->id;
        }


        if ($return === true) {
            Request()->session()->flash('success', 'Categoría Actualizada Éxito!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("category.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("category.index");
        }

        $products = Product::where('category_id', $id)->get();
        if( count($products) == 0 ) {
            $cat->delete();
            Request()->session()->flash('success', 'Categoría Eliminada Éxito!');
        }else
            Request()->session()->flash('fail', 'categoría eliminada fallida!');

        return redirect()->route("category.index");
    }
    
    
}
