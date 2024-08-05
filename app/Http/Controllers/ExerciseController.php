<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{

    public function index()
    {
        $exercises = exercise::latest()->paginate(6);

        return view('exercises', compact('exercises'))->with(request()->input('page'));
    }

    public function create()
    {
        return view('create');
    }



    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'muscle' => 'required',
            'info' => 'required'

        ]);

        //create a new exercise
        Exercise::create($request->all());

        //redirect the user and send message
        return redirect()->route('exercises.index');
    }


    public function show(Exercise $exercise)
    {
        return view('details', compact('exercise'));
    }


    public function edit(Exercise $exercise)
    {
        return view('edit', compact('exercise'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exercise $exercise)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'muscle' => 'required',
            'info' => 'required'

        ]);

        //create a new exercise
        $exercise->update($request->all());

        //redirect the user and send message
        return redirect()->route('exercises.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercises.index');
    }
}

