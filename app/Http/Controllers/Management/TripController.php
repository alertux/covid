<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Places;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visit_at = trim(Request()->input('visit_at'));
        //Log::error("visit_at: " . $visit_at);

        if (!empty($visit_at)) {
            $visit_date = Carbon::parse($visit_at)->format("Y-m-d");

            $places = Places::where('visit_at', '=', $visit_date)
                ->orWhere('visit_at', '<=', $visit_date)
                ->where('end_at', '>=', $visit_date)
                ->orderBy('id', 'asc')->paginate(15);
        } else
            $places = Places::orderBy('id', 'asc')->paginate(15);

        return view('pages.management.places', ['places' => $places, 'visit_at' => $visit_at]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $place = new \stdClass();
        $place->id = 0;
        $place->visit_at = '';
        $place->end_at = '';
        $place->place_name = '';
        $place->country = '';
        $place->summary = '';
        $place->persons = '';


        return view('pages.management.tripedit',
            [
                'place' => $place
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
        $place = Places::where('id', $id)->first();

        if (empty($place)) {
            return redirect()->route("places.index");
        }

        return view('pages.management.tripedit',
            [
                'place' => $place
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
        $visit_at = Carbon::parse($request->input('visit_at'));
        $end_at = Carbon::parse($request->input('end_at'));
        $place_name = $request->input('place_name');
        $country = $request->input('country');
        $summary = $request->input('summary');
        $persons = $request->input('persons');

        if ($id != 0) {
            $place = places::where('id', $id)->first();
            $place->visit_at = $visit_at;
            $place->end_at = $end_at;
            $place->place_name = $place_name;
            $place->country = $country;
            $place->summary = $summary;
            $place->persons = $persons;

            $return = $place->save();
        } else {
            $place = new places();
            $place_data = array(
                'id' => $id,
                'visit_at' => $visit_at,
                'end_at' => $end_at,
                'place_name' => $place_name,
                'country' => $country,
                'summary' => $summary,
                'persons' => $persons
            );
            $return = $place->saveData($place_data);
            $id = $place->id;
        }


        if ($return === true) {
            Request()->session()->flash('success', '¡Éxito actualizado!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("trip.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Places::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("places.index");
        }

        $place->delete();
        Request()->session()->flash('success', 'Removed Place Success!');

        return redirect()->route("places.index");
    }


}
