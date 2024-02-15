<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $data = $request->validated();

        $new_technology = new Technology();
        $new_technology->name = $data['name'];
        $new_technology->slug = Str::of($new_technology->name)->slug('-');
        $new_technology->save();

        return redirect()->route('admin.technologies.index')->with('messages', "Tecnologia '$new_technology->name' aggiunta correttamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();

        $technology->update($data);
        $technology->slug = Str::of($technology->name)->slug('-');
        $technology->save();

        return redirect()->route('admin.technologies.index')->with('messages', "Tecnologia '$technology->name' modificata correttamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $name = $technology->name;
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('messages', "Tecnologia '$name' cancellata correttamente");
    }
}
