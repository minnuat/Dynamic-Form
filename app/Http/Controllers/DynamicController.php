<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Form;
use App\Models\FormField;

class DynamicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dynamic-form.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form = new Form();
        $form->form_name = $request->input('form_name');
        $form->save();

        foreach ($request->input('label') as $key => $label) {
            $field = new FormField();
            $field->form_id = $form->id;
            $field->label = $label;
            $field->field = $request->input('field')[$key];
            $field->comment = $request->input('comment')[$key];
            $field->save();
        }

        return redirect()->back()->with('success', 'Form saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
