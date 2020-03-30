<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report_at = trim(Request()->input('report_at'));
        //Log::error("report_at: " . $report_at);

        if (!empty($report_at)) {
            $report_date = Carbon::parse($report_at)->format("Y-m-d");

            $reports = Report::where('report_at', '=', $report_date)->orderBy('id', 'asc')->paginate(15);
        } else
            $reports = Report::orderBy('id', 'asc')->paginate(15);

        return view('pages.management.report', ['reports' => $reports, 'report_at' => $report_at]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $report = new \stdClass();
        $report->id = 0;
        $report->report_at = '';
        $report->complaint = '';
        $report->country = '';
        $report->summary = '';
        $report->other = '';

        return view('pages.management.reportedit',
            [
                'report' => $report
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
        $report = Report::where('id', $id)->first();

        if (empty($report)) {
            return redirect()->route("report.index");
        }

        return view('pages.management.reportedit',
            [
                'report' => $report
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
        $report_at = Carbon::parse($request->input('report_at'));
        $complaint = $request->input('complaint');
        $country = $request->input('country');
        $summary = $request->input('summary');
        $other = $request->input('other');

        if ($id != 0) {
            $report = Report::where('id', $id)->first();
            $report->report_at = $report_at;
            $report->complaint = $complaint;
            $report->country = $country;
            $report->summary = $summary;
            $report->other = $other;

            $return = $report->save();
        } else {
            $report = new Report();
            $report_data = array(
                'id' => $id,
                'report_at' => $report_at,
                'complaint' => $complaint,
                'country' => $country,
                'summary' => $summary,
                'other' => $other
            );
            $return = $report->saveData($report_data);
            $id = $report->id;
        }


        if ($return === true) {
            Request()->session()->flash('success', '¡Éxito actualizado!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("report.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("report.index");
        }

        $report->delete();
        Request()->session()->flash('success', 'Removed Report Success!');

        return redirect()->route("report.index");
    }


}
