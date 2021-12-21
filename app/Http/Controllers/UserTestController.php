<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserTestResource;
use App\UserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userTests = UserTest::get()->where('userID', Auth::user()->id);

        if (sizeof($userTests) == 0) {
            return response()->json(['response' => "You don't have any tests yet!"]);
        }

        $userTestsEdited = array();

        foreach ($userTests as $userTest) {
            array_push($userTestsEdited, new UserTestResource($userTest));
        }

        return response()->json(['response' => 'These are your tests...', 'tests' => $userTestsEdited]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'ambulance' => 'required|string|max:30',
                'covidTestID' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $results = array('positive', 'negative');
        $resultID = rand(0, 1);

        $userTest = UserTest::create([
            'ambulance' => $request->ambulance,
            'result' => $results[$resultID],
            'userID' => Auth::user()->id,
            'covidTestID' => $request->covidTestID
        ]);

        return response()->json(['response' => 'Test has been successfully created!', new UserTestResource($userTest)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function show(UserTest $userTest)
    {
        return response()->json(['response' => 'Single test view...', 'test' => new UserTestResource($userTest)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTest $userTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTest $userTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserTest  $userTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTest $userTest)
    {
        if ($userTest->userID != Auth::user()->id) {
            return response()->json(['response' => "This test doesn't belong to you. You can not delete it!", 'test' => $userTest]);
        } else if ($userTest->delete()) {
            return response()->json(['response' => 'Test has been successfully deleted!', 'deleted_test' => new UserTestResource($userTest)]);
        } else {
            return response()->json(['response' => 'Deleting test has failed!', 'test' => new UserTestResource($userTest)]);
        }
    }
}
