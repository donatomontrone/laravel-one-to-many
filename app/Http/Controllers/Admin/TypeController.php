<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    protected $rules = [
        'name' => 'required|min:5|max:50|',
        'color' => 'required|size:7|regex:/^#[a-zA-Z0-9]{6}$/',

    ];

    protected $messages = [
        'name.required' => 'Inserisci il nome del tipo.',
        'name.min' => 'Il nome è troppo corto.',
        'name.max' => 'Il nome è troppo lungo.',
        'color.required' => 'Inserisci un colore per il tipo in formato HEX.',
        'color.size' => 'La lunghezza del colore in formato HEX non è valida.',
        'color.regex' => 'Il formato accettato è #000000.',
    ];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Type $type)
    {

        return view('admin.types.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->rules,
            $this->messages
        );
        $newType = new Type();
        $newType->fill($data);
        $newType->save();

        return redirect()->route('admin.types.show', $newType->id)->with('info-message', "'$newType->name' was created successfully!")->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Type $project
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Type $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $newRules = $this->rules;
        $newRules['name'] = ['required', 'min:5', 'max:50', Rule::unique('types')->ignore($type->id)];

        $data = $request->validate($newRules, $this->messages);

        $type->update($data);

        return redirect()->route('admin.types.show', compact('type'))->with('info-message', "'$type->name' was updated successfully!")->with('alert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('info-message', "$type->name has been deleted!")->with('alert', 'danger');
    }
}
