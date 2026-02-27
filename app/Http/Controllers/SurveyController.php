<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    /**
     * Display the survey form.
     */
    public function index()
    {
        return view('surveys.index');
    }


    /**
     * Display the survey results.
     */
    public function show(string $uuid)
    {
        $survey = Survey::where('uuid', $uuid)->firstOrFail();

        return view('surveys.result', compact('survey'));
    }
}
