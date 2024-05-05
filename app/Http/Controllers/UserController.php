<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function index()
    {
        $forms = Form::all();

        return view('users.index', compact('forms'));
    }

    public function show($id)
    {
        $form   = Form::findOrFail($id);
        $formId = $id;

        return view('users.show', compact('form', 'formId'));
    }


    public function store(Request $request)
    {
        $request->validate([
        ]);

        $userId = Auth::id();

        $formId = $request->input('formId');

        $formData = $request->all();

        $submission = new FormSubmission();
        $submission->form_id = $formId;
        $submission->user_id = $userId;
        $submission->data = json_encode($formData);
        $submission->save();

        return redirect()->route('forms.index')->with('success', 'Form submitted successfully');
    }

}
