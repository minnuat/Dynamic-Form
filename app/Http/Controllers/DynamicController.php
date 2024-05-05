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
        $forms = Form::all();

        return view('dynamic-form.index', compact('forms'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function edit($id)
    {
        $form = Form::find($id);
        
        return view('dynamic-form.edit', compact('form'));

    }

    public function update(Request $request, $formId)
    {
        $validatedData = $request->validate([
            'form_name' => 'required|string|max:255',
            'label' => 'required|array',
            'field' => 'required|array',
            'comment' => 'required|array',
        ]);

        $form = Form::findOrFail($formId);

        $form->update([
            'form_name' => $validatedData['form_name'],
        ]);

        $fields = [];
        foreach ($validatedData['label'] as $key => $label) {
            $fields[] = [
                'label' => $label,
                'field' => $validatedData['field'][$key],
                'comment' => $validatedData['comment'][$key],
            ];
        }
        $form->fields()->delete(); 
        $form->fields()->createMany($fields); 

        return redirect()->route('dynamic-form.show', $formId)->with('success', 'Form updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $form = Form::find($id);
        $form->delete();

        return redirect()->back()->with('success', 'Form deleted successfully.');
    }
}
