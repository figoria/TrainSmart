<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Tag;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{


    public function index()
    {
        $tags = Tag::all();
        $filters = [];
        $exercises = Exercise::with('tags')->get();
        $exercises = exercise::latest()->paginate(6);
        return view('exercises', compact('exercises', 'tags', 'filters'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('create', compact('tags'));
    }


    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'title' => 'required',
            'muscle' => 'required',
            'info' => 'required'
        ]);

        //create a new exercise
        $exercise = new Exercise();
        $exercise->title = $request->input('title');
        $exercise->muscle = $request->input('muscle');
        $exercise->info = $request->input('info');


        if ($exercise->save()) {
            $exercise->tags()->attach($request->input('tags'));
        }

        //redirect the user and send message
        return redirect()->route('admin-exercises.index');
    }


    public function show(Exercise $exercise)
    {
        return view('details', compact('exercise'));
    }


    public function edit(Exercise $exercise)
    {
        $tags = Tag::all();
        return view('edit', compact('exercise', 'tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exercise $exercise)
    {
        //validate the input
        $request->validate([
            'title' => 'required',
            'muscle' => 'required',
            'info' => 'required',
            'tags' => 'required|exists:tags,id|min:1'

        ]);

        //create a new exercise
        $exercise->update($request->all());
        $exercise->title = $request->input('title');
        $exercise->muscle = $request->input('muscle');
        $exercise->info = $request->input('info');

        if ($exercise->save()) {
            $exercise->tags()->detach();
            $exercise->tags()->attach($request->input('tags'));
        }
        //redirect the user and send message
        return redirect()->route('admin-exercises.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->tags()->detach();
        $exercise->forcedelete();

        return redirect()->route('admin-exercises.index');
    }


    public function softDeleteOrRestore(int $id, Request $request)
    {

        $exercise = Exercise::withTrashed()->find($id);
        if ($exercise->trashed()) {
            $exercise->restore();
            return redirect()->route('admin-exercises.index');
        } else {
            $exercise->delete();
            return redirect()->route('admin-exercises.index');
        }
    }

    public function search(Request $request)
    {
        $tags = Tag::all();
        $request->validate([
            'search' => 'max:255',
            'filters' => 'exists:tags,id'
        ]);
        $filters = $request->input('filters');

        if (collect($filters)->count() === 0) {
            $exercises = Exercise::where('muscle', 'LIKE', '%' . $request->input('search') . '%')
                ->orWhere('subtitle', 'LIKE', '%' . $request->input('search') . '%')->get();
            return view('exercises', compact('exercises', 'tags', 'filters'));
        } elseif ($request->input('search') === null) {
            $exercises = Exercise::whereHas('tags', function ($query) use ($filters) {
                $query->whereIn('tag_id', $filters);
            })->get();
            return view('exercises', compact('exercises', 'tags', 'filters'));
        } else {
            $exercises = Exercise::whereHas('tags', function ($query) use ($filters) {
                $query->whereIn('tag_id', $filters);
            });

            $exercises->where('title', 'LIKE', '%' . $request->input('search') . '%')
                ->orWhere('muscle', 'LIKE', '%' . $request->input('search') . '%')
                ->get();
            return view('exercises', compact('exercises', 'tags', 'filters'));
        }
    }

}

