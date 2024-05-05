<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class UserController extends Controller
{
    
    public function index()
    {
        // Retrieve forms created by admins
        $forms = Form::all();

        // Return the view with the forms data
        return view('users.index', compact('forms'));
    }

    public function show($id)
    {
        // Retrieve the selected form by id
        $form = Form::findOrFail($id);

        // Return the view with the form details
        return view('users.show', compact('form'));
    }

}
