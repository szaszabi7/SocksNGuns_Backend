<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Ez a felhasználó nem létezik'], 404);
        } else {
            return response()->json($user);
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
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->noContent();
    }

    public function userCount() {
        $users = User::all()->count();
        return response()->json($users);
    }

    public function changePassword(Request $request) {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        User::find(auth()->user()->id)->update(['password'=> bcrypt($request->password)]);
        return response()->json(["message" => "Jelszó sikeresen megváltoztatva"], 200);
    }

    public function changeUsername(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:users,name|min:5'
        ]);

        User::find(auth()->user()->id)->update(['name'=> $request->name]);
        return response()->json(["message" => "Felhasználónév sikeresen megváltoztatva"], 200);
    }
}
