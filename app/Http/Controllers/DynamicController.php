<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Form;
use App\Models\FormField;
use App\Jobs\SendFormCreationNotification;

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


        SendFormCreationNotification::dispatch($form);

        return redirect()->back()->with('success', 'Form saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Retrieve forms created by admins
        $forms = Form::all();

        // Return the view with the forms data
        return view('dynamic-form.index', compact('forms'));
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
