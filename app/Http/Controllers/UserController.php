<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        return response()->json(['response' => 'Users has been successfully loaded!', 'users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['response' => 'Single user view...', 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id != Auth::user()->id) {
            return response()->json(['response' => "You can't update account which does not belong to you!"]);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:30',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user1 = clone $user;
        $user->name = $request->name;

        if ($user->save()) {
            return response()->json(['response' => 'Account has been successfully updated!', 'before_update' => new UserResource($user1), 'after_update' => new UserResource($user)]);
        } else {
            return response()->json(['response' => "Account update has failed!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->name == "admin" && Auth::user()->email == "admin@gmail.com") {
            if ($user->delete()) {
                return response()->json(['response' => 'User has been successfully deleted!', 'deleted_user' => new UserResource($user)]);
            } else {
                return response()->json(['response' => "Failed to delete user!", 'user' => new UserResource($user)]);
            }
        } else {
            return response()->json(['response' => "Only admin can delete users!"]);
        }
    }
}
