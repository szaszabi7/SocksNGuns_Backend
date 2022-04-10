<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonalInformation;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
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
        return response()->json(["message" => "Adatkok sikeresen elmentve"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $p = PersonalInformation::where('user_id', auth()->user()->id)->first();
        if (is_null($p)) {
            return response()->json(['message' => 'Nincs adat'], 404);
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
        $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'post_code' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string'
        ]);
        $p = PersonalInformation::findOrFail($id);
        $p->fill($request->all());
        $p->save();
        return response()->json(["message" => "Adatkok sikeresen módosítva"], 200);
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
