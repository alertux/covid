<?php

namespace App\Http\Controllers\Management;

use App\Models\Category;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Request()->input("customer_name");
        $customer = $this->search_customers($name)->paginate(15);
        return view('pages.management.customer', ['customer' => $customer, 'customer_name' => $name]);
    }

    private function search_customers($name){
        $customers = Customers::orderBy('name', 'asc');
        if($name != NULL)
        {
            $t = '%' . $name . '%';
            $customers = $customers->where('name', 'like', $t);
        }

        return $customers;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $obj = new \stdClass();
        $obj->id = 0;
        $obj->name = '';
        $obj->company_name = '';
        $obj->address = '';
        $obj->city = '';
        $obj->email = '';
        $obj->phone = '';
        $obj->fax = '';
        $obj->nit = '';
        $obj->dui = '';
        $obj->giro = '';
        $obj->nrc = '';
        $obj->department = '';

        return view('pages.management.customeredit',
            [
                'cat' => $obj
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
        $cat = Customers::where('id', $id)->first();

        if (empty($cat)) {
            return redirect()->route("customer.index");
        }

        return view('pages.management.customeredit',
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
        $data = $request->all();

        if( $id != 0 ){
            $obj = Customers::where('id', $id)->first();
            $return = $obj->saveData($data);
        }else{
            $obj = new Customers();
            $return = $obj->saveData($data);
            $id = $obj->id;
        }

        if ($return === true) {
            Request()->session()->flash('success', 'Cliente actualizado éxito!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("customer.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Customers::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("customer.index");
        }

        $cat->delete();
        Request()->session()->flash('success', 'Cliente eliminada éxito!');

        return redirect()->route("customer.index");
    }
    
    
}
