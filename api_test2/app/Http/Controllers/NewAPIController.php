<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumne;
use Illuminate\Support\Facades\Validator;

class NewAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Alumne::all();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Creem les regles de validació
        $rules = [
            'nom' => 'required',
            'cognoms' => 'required',
            'data_naixement' => 'required',
            'poblacio' => 'required',
            'genere' => 'required',
            'telefon' => 'required',
        ];

        // Executem el validador. Si falla retornem l’error
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'created' => false,
                'errors' => $validator->errors()->all()
            ];
        }

        Alumne::create($request->all());
        return ['created' => true];

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Alumne::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumne = Alumne::find($id);
        $alumne->update($request->all());
        return ['updated' => true];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Alumne::destroy($id);
        return ['deleted' => true];
    }
}
