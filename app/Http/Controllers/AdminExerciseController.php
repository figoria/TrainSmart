<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use Illuminate\Http\Request;

class AdminExerciseController extends Controller
{

    public function index()
    {
        $exercises = exercise::latest()->paginate(6);

        return view('admin-exercises', compact('exercises'))->with(request()->input('page'));
    }





    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */

}

