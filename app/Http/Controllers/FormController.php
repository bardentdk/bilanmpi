<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return Inertia::render('BilanForm');
    }

    public function submit(BilanRequest $request)
    {
        return redirect()->route('groq.generate')->with('bilan', $request->validated());
    }
}
