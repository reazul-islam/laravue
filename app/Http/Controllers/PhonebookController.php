<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhonebookRequest;
use App\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phonebook');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhonebookRequest $request)
    {
        $p = new Phonebook();
        $p->name = $request->name;
        $p->email = $request->email;
        $p->phone = $request->phone;
        $p->save();
        return $p;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request, Phonebook $phonebook)
    {
        $p = Phonebook::find($request->id);
        $p->name = $request->name;
        $p->email = $request->email;
        $p->phone = $request->phone;
        $p->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Phonebook::find($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }

    public function getData()
    {
        return Phonebook::orderBy('name','ASC')->get();
    }
}
