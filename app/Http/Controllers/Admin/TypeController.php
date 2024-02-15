<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $data = $request->validated();

        $new_type = new Type();
        $new_type->name = $data['name'];
        $new_type->slug = Str::of($new_type->name)->slug('-');
        $new_type->save();

        return redirect()->route('admin.types.index')->with('messages', "Tipo '$new_type->name' aggiunto correttamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->validated();

        $type->update($data);
        $type->slug = Str::of($type->name)->slug('-');
        $type->save();

        return redirect()->route('admin.types.index')->with('messages', "Tipo '$type->name' modificato correttamente");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $name = $type->name;
        $type->delete();
        return redirect()->route('admin.types.index')->with('messages', "Tipo '$name' cancellato correttamente");
    }
}
