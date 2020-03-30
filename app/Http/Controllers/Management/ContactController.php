<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contacts;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meet_at = trim(Request()->input('meet_at'));
        //Log::error("meet_at: " . $meet_at);

        if (!empty($meet_at)) {
            $meet_date = Carbon::parse($meet_at)->format("Y-m-d");

            $contacts = Contacts::where('meet_at', '=', $meet_date)->orderBy('id', 'asc')->paginate(15);
        } else
            $contacts = Contacts::orderBy('id', 'asc')->paginate(15);

        return view('pages.management.contacts', ['contacts' => $contacts, 'meet_at' => $meet_at]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $contact = new \stdClass();
        $contact->id = 0;
        $contact->meet_at = '';
        $contact->name = '';
        $contact->detail = '';
        $contact->other = '';

        return view('pages.management.contactsedit',
            [
                'contact' => $contact
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
        $contact = Contacts::where('id', $id)->first();

        if (empty($contact)) {
            return redirect()->route("contacts.index");
        }

        return view('pages.management.contactsedit',
            [
                'contact' => $contact
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
        $meet_at = Carbon::parse($request->input('meet_at'));
        $name = $request->input('name');
        $detail = $request->input('detail');
        $other = $request->input('other');

        if ($id != 0) {
            $contact = Contacts::where('id', $id)->first();
            $contact->meet_at = $meet_at;
            $contact->name = $name;
            $contact->detail = $detail;
            $contact->other = $other;

            $return = $contact->save();
        } else {
            $contact = new Contacts();
            $contact_data = array(
                'id' => $id,
                'meet_at' => $meet_at,
                'name' => $name,
                'detail' => $detail,
                'other' => $other
            );
            $return = $contact->saveData($contact_data);
            $id = $contact->id;
        }


        if ($return === true) {
            Request()->session()->flash('success', '¡Éxito actualizado!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("contacts.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contacts::where('id', $id)->first();
        if (empty($id)) {
            return redirect()->route("contacts.index");
        }

        $contact->delete();
        Request()->session()->flash('success', 'Removed Contact Success!');

        return redirect()->route("contacts.index");
    }


}
