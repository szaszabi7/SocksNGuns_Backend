<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonalInformation;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pers = PersonalInformation::with("user")->get();
        return response()->json($pers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = New PersonalInformation();
        $p->fill($request->all());
        $p->save();
        return response()->json($p, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = PersonalInformation::with("user")->find($id);
        if (is_null($p)) {
            return response()->json(['message' => 'Ez a felhasználó nem létezik'], 404);
        } else {
            return response()->json($p);
        }
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
        $p = PersonalInformation::findOrFail($id);
        $p->fill($request->all());
        $p->save();
        return response()->json($p, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PersonalInformation::destroy($id);
        return response()->noContent();
    }
}
