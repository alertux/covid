<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use PDF;

class ValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page= Request()->input("page", "1");
        $page_action = Request()->input("page_action");
        $page_limit= Request()->input("page_limit", "15");
        $currentPath= Route::getFacadeRoot()->current()->uri();
        if( $page_action == "next")
            $page ++;
        else
            $page --;
        $search_text = Request()->input("productcode", "");
        //$offernumber = Request()->input("offernumber");
        $access_token = Request()->session()->get('access_token', '1000');

        if( $access_token != "1000") {
            $returnObj = $this->getInvoiceList($access_token, "https://books.zoho.com/api/v3/creditnotes?organization_id=633541911", $page, $page_limit, $search_text);
            if($returnObj->code != 0){
                $getTokenFlag = $this->getAccessToken();
                if( $getTokenFlag ) {
                    $access_token = Request()->session()->get('access_token');
                    $returnObj = $this->getInvoiceList($access_token, "https://books.zoho.com/api/v3/creditnotes?organization_id=633541911", $page, $page_limit, $search_text);
                }else{
                    $returnObj = null;
                    Request()->session()->flash('fail', 'Get AccessToken Failed!');
                }
            }
        }else{
            $getTokenFlag = $this->getAccessToken();
            if( $getTokenFlag ) {
                $access_token = Request()->session()->get('access_token');
                $returnObj = $this->getInvoiceList($access_token, "https://books.zoho.com/api/v3/creditnotes?organization_id=633541911", $page, $page_limit, $search_text);
            }else{
                $returnObj = null;
                Request()->session()->flash('fail', 'Get AccessToken Failed!');
            }
        }

        if($returnObj != null) {
            return view('pages.management.validation', ['notes' => $returnObj->creditnotes, 'pageObj' => $returnObj->page_context, 'page_url' => $currentPath . ".index", 'search_text' => $search_text, 'page_type' => 'index']);
        }else
            return view('pages.management.validation', ['notes' => [], 'pageObj'=> null, 'page_url'=>$currentPath.".index", 'search_text'=>$search_text, 'page_type' => 'index']);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($creditnote_id)
    {
        $access_token = Request()->session()->get('access_token', '1000');

        $returnObj = $this->getInvoiceObj($access_token, "https://books.zoho.com/api/v3/creditnotes/", $creditnote_id);
        if($returnObj->code != 0){
            $getTokenFlag = $this->getAccessToken();
            if( $getTokenFlag ) {
                $access_token = Request()->session()->get('access_token');
                $returnObj = $this->getInvoiceObj($access_token, "https://books.zoho.com/api/v3/creditnotes/", $creditnote_id);
            }else{
                $returnObj = null;
                Request()->session()->flash('fail', 'Get AccessToken Failed!');
            }
        }
        if($returnObj != null) {
            $customer = Customers::where('customer_id', $returnObj->creditnote->customer_id)->first();
            if(empty($customer))
                $customer_data = array(
                    'customer_nit' => "",
                    'customer_giro' => "",
                    'pay_method' => "",
                    'customer_address' => "",
                    'customer_city' => ""
                );
            else
                $customer_data = array(
                    'customer_nit' => $customer->nit,
                    'customer_giro' => $customer->giro,
                    'pay_method' => $customer->pay_method,
                    'customer_address' => $customer->address,
                    'customer_city' => $customer->city,
                );

            return view('pages.management.creditedit', ['note' => $returnObj->creditnote, 'customer_info'=>$customer_data]);
        }else
            return redirect()->route("credit.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $creditnote_id
     * @return \Illuminate\Http\Response
     */
    public function show($creditnote_id)
    {
        $access_token = Request()->session()->get('access_token', '1000');

        $returnObj = $this->getInvoiceObj($access_token, "https://books.zoho.com/api/v3/creditnotes/", $creditnote_id);
        if($returnObj->code != 0){
            $getTokenFlag = $this->getAccessToken();
            if( $getTokenFlag ) {
                $access_token = Request()->session()->get('access_token');
                $returnObj = $this->getInvoiceObj($access_token, "https://books.zoho.com/api/v3/creditnotes/", $creditnote_id);
            }else{
                $returnObj = null;
                Request()->session()->flash('fail', 'Get AccessToken Failed!');
            }
        }
        if($returnObj != null) {
            $customer = Customers::where('customer_id', $returnObj->creditnote->customer_id)->first();
            if(empty($customer))
                $customer_data = array(
                    'customer_nit' => "",
                    'customer_giro' => "",
                    'pay_method' => "",
                    'customer_address' => "",
                    'customer_city' => ""
                );
            else
                $customer_data = array(
                    'customer_nit' => $customer->nit,
                    'customer_giro' => $customer->giro,
                    'pay_method' => $customer->pay_method,
                    'customer_address' => $customer->address,
                    'customer_city' => $customer->city,
                );

            return view('pages.management.creditshow', ['note' => $returnObj->creditnote, 'customer_info'=>$customer_data]);
        }else
            return redirect()->route("credit.index");
    }

    public function customer_info($customer_id)
    {
        $nit_val = Request()->input("nit_val", "");
        $giro_val = Request()->input("giro_val", "");
        $pay_val = Request()->input("pay_val", "");
        $add_val = Request()->input("address_val", "");
        $city_val = Request()->input("city_val", "");

        $user = Customers::where('customer_id', $customer_id)->first();
        if (empty($user)) {
            $user = new Customers();
            $user_data = array(
                'customer_id' => $customer_id,
                'nit' => $nit_val,
                'giro' => $giro_val,
                'pay_method' => $pay_val,
                'address' => $add_val,
                'city' => $city_val
            );
            $return = $user->saveData($user_data);
        }else{
            $user->nit = $nit_val;
            $user->giro = $giro_val;
            $user->pay_method = $pay_val;
            $user->address = $add_val;
            $user->city = $city_val;
            $return = $user->save();
        }

        return "success";
    }

    public function printPreview($creditnote_id)
    {
        $access_token = Request()->session()->get('access_token', '1000');
        $returnObj = $this->getInvoiceObj($access_token, "https://books.zoho.com/api/v3/creditnotes/", $creditnote_id);
        if($returnObj->code != 0){
            $getTokenFlag = $this->getAccessToken();
            if( $getTokenFlag ) {
                $access_token = Request()->session()->get('access_token');
                $returnObj = $this->getInvoiceObj($access_token, "https://books.zoho.com/api/v3/creditnotes/", $creditnote_id);
            }else{
                $returnObj = null;
                Request()->session()->flash('fail', 'Get AccessToken Failed!');
            }
        }

        if($returnObj != null) {
            $customer = Customers::where('customer_id', $returnObj->creditnote->customer_id)->first();
            if(empty($customer))
                $customer_data = array(
                    'nit' => "",
                    'giro' => "",
                    'pay_method' => "",
                    'address' => "",
                    'city' => "",
                );
            else
                $customer_data = array(
                    'nit' => $customer->nit,
                    'pay_method' => $customer->pay_method,
                    'giro' => $customer->giro,
                    'address' => $customer->address,
                    'city' => $customer->city,
                );

            $venta_total = $returnObj->creditnote->total - round($returnObj->creditnote->sub_total/100, 2);
            $zeroUp = floor($venta_total);
            $zeroDown = round(($venta_total - $zeroUp)*100);
            if($zeroDown != 0)
                $zeroStr = " ".$zeroDown."/100 ";
            else
                $zeroStr = "";
            $totalStr = strtoupper($this->convertir($zeroUp)).$zeroStr." Dólares";
            $returnObj->creditnote->balance = $totalStr;

            return view('pages.management.print_credit', ['note' => $returnObj->creditnote, 'customer_info' => $customer_data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $technician_code)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
