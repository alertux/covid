<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

use App\Models\Customers;
use App\Models\Contracts;
use App\Models\Technicians;
use App\Models\Reports;
use Illuminate\Support\Facades\DB;


class ApiController extends BaseController
{
    public function __construct()
    {
        
    }

    public function check()
    {
        $return = array(
            'status'    =>  'ok'
        );

        return response()->json($return);
    }

    public function permission()
    {
        return true;
    }

    public function customers()
    {
        try{
            $q = request()->input('q');
            $page_limit = request()->input('page_limit');
            $rows = [];
            if($page_limit == null ) $page_limit = 10;
            if($q != null){
                $rows = Customers::where('name', 'like', $q.'%')->
                    orderBy('name', 'asc')->
                    forPage(1, $page_limit)->
                    get(['id','name as text', 'address', 'nit', 'dui']);
            }
            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function products_by_name()
    {
        try{
            $q = request()->input('q');
            $page_limit = request()->input('page_limit');
            $rows = [];
            if($page_limit == null ) $page_limit = 10;
            if($q != null){
                $rows = Product::where('name', 'like', $q.'%')->
                orderBy('barcode', 'asc')->
                forPage(1, $page_limit)->
                get(['id','name as text', 'barcode', 'description', 'price_out', 'inventary_min']);
            }
            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function products_by_code()
    {
        try{
            $q = request()->input('q');
            $page_limit = request()->input('page_limit');
            $rows = [];
            if($page_limit == null ) $page_limit = 10;
            if($q != null){
                $rows = Product::where('barcode', 'like', $q.'%')->
                orderBy('barcode', 'asc')->
                forPage(1, $page_limit)->
                get(['id','barcode as text', 'name', 'description', 'price_out', 'inventary_min']);
            }
            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function customers_by_name_or_code()
    {
        try{
            $q = request()->input('q');
            $page_limit = request()->input('page_limit');
            $rows = [];
            if($page_limit == null ) $page_limit = 10;
            if($q != null){
                $rows = Customers::where('business_name', 'like', $q.'%')->
                    orwhere('customer_code', 'like', $q.'%')->
                    orderBy('created_at', 'desc')->
                    forPage(1, $page_limit)->
                    get(['id','business_name', 'customer_code', 'reference_name']);
            }
            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }


    public function reports()
    {
        try{
            $q = request()->input('q');
            $page_limit = request()->input('page_limit');
            $rows = [];
            $technician_id =  Technicians::where('user_id', Auth::user()->id)->first()->id;
            if($page_limit == null ) $page_limit = 10;
            if($q != null){
                $query = "select tr.* from reports as tr
                            left join customers ct on tr.customer_id=ct.id
                            where tr.technician_id=$technician_id and
                            (tr.tr_key like '$q%'
                            or tr.current_date like '$q%'
                            or ct.business_name like '$q%')
                            limit $page_limit";
                $rows = DB::select($query)->paginate(10);
            }
            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function contracts()
    {
        try{
            $hours_left = request()->input('hours_left', -1);
            $customer_id = request()->input('customer_id', null);
            // $technician_id =  Technicians::where('user_id', Auth::user()->id)->first()->id;
            $contract_id = request()->input('contract_id', null);
            if( $contract_id == null) {
                $rows = Contracts::where('customer_id', $customer_id)->
                    where('hours_left', '>', $hours_left)->
                    orderBy('created_at', 'desc')->
                    forPage(1, 5)->
                    get();
            } else {
                $rows = Contracts::where('id', $contract_id)->get();
            }

            foreach($rows as $row){
                $last_tr = collect(
                    Reports::where('contract_id', $row->id)
                        ->orderBy('current_date', 'desc')
                        ->forPage(1)
                        ->get(['current_date']))->first();

                $row->last_tr_date = $last_tr['current_date'];
                $row->call_fee_type_prices;
            }

            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function all_contracts()
    {
        try{
            $customer_id = request()->input('customer_id');
            // $technician_id =  Technicians::where('user_id', Auth::user()->id)->first()->id;
            $rows = Contracts::where('customer_id', $customer_id)->
            orderBy('created_at', 'desc')->
            get();
            $result = [
                'status' => 'ok',
                'rows' => $rows
            ];
        }catch(Exception $e) {
            $result = [
                'status' => 'failure',
                'error' =>  $e->getMessage()
            ];
        }
        return response()->json($result);
    }
}
