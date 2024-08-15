<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use Illuminate\Http\Request;

class AdminExerciseController extends Controller
{

    public function index()
    {
        $exercises = exercise::latest()->paginate(6);
        $data = Exercise::withTrashed()->get();
        return view('admin-exercises', compact('exercises', 'data'));
    }

    public function restore($id)
    {
        $data = Exercise::withTrashed()->find($id);
        $data->restore();
        return redirect()->route('admin-exercises.index');
    }



    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */

}

