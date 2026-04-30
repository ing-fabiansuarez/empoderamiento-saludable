<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function findrisc()
    {
        return view('surveys.findrisc');
    }

    public function instrument()
    {
        return view('surveys.instrument');
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
