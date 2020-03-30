<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check_at = trim(Request()->input('check_at'));
        //Log::error("check_at: " . $check_at);

        if (!empty($check_at)) {
            $check_date = Carbon::parse($check_at)->format("Y-m-d");

            $diagnosis = Diagnosis::where('check_at', '=', $check_date)->orderBy('id', 'asc')->paginate(15);
        } else
            $diagnosis = Diagnosis::orderBy('id', 'asc')->paginate(15);

        return view('pages.management.diagnosis', ['diagnosis' => $diagnosis, 'check_at' => $check_at]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $diagnosis = new \stdClass();
        $diagnosis->id = 0;
        $diagnosis->check_at = '';
        $diagnosis->name = '';
        $diagnosis->state = '';
        $diagnosis->path = '';
        $diagnosis->url = '';
        $diagnosis->detail = '';


        return view('pages.management.diagnosisedit',
            [
                'diagnosis' => $diagnosis
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diagnosis = Diagnosis::where('id', $id)->first();

        if (empty($diagnosis)) {
            return redirect()->route("diagnosis.index");
        }

        return view('pages.management.diagnosisedit',
            [
                'diagnosis' => $diagnosis
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $check_at = Carbon::parse($request->input('check_at'));
        $name = $request->input('name');
        $state = $request->input('state');
        $url = $request->input('url');
        $detail = $request->input('detail');

        $data = $request->all();
        if (isset($data['path'])) {
            $fpath = $request->file('path')->store('public/upload');
            $path = Storage::url($fpath);
        }else
            $path = "";

        if ($id != 0) {
            $diagnosis = Diagnosis::where('id', $id)->first();
            $diagnosis->check_at = $check_at;
            $diagnosis->name = $name;
            $diagnosis->state = $state;
            if (!empty($path)) $diagnosis->path = $path;
            $diagnosis->url = $url;
            $diagnosis->detail = $detail;

            $return = $diagnosis->save();
        } else {
            $diagnosis = new Diagnosis();
            $diagnosis_data = array(
                'id' => $id,
                'check_at' => $check_at,
                'name' => $name,
                'state' => $state,
                'path' => $path,
                'url' => $url,
                'detail' => $detail
            );
            $return = $diagnosis->saveData($diagnosis_data);
            $id = $diagnosis->id;
        }


        if ($return === true) {
            Request()->session()->flash('success', '¡Éxito actualizado!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("diagnosis.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnosis = Diagnosis::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("diagnosis.index");
        }

        $diagnosis->delete();
        Request()->session()->flash('success', 'Removed Diagnosis Success!');

        return redirect()->route("diagnosis.index");
    }


}
