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
     * Store a newly created survey in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'required|in:M,F',
            'age'    => 'required|integer|min:18|max:100',
            'weight' => 'required|numeric|min:30|max:250',
            'height' => 'required|numeric|min:120|max:220',
            'waist'  => 'required|numeric|min:40|max:200',
            'act'    => 'required|integer|in:0,2',
            'food'   => 'required|integer|in:0,1',
            'htn'    => 'required|integer|in:0,2',
            'glu'    => 'required|integer|in:0,5',
            'fam'    => 'required|integer|in:0,3,5',
        ]);

        // Calculate BMI
        $heightInMeters = $validated['height'] / 100;
        $bmi = $validated['weight'] / ($heightInMeters * $heightInMeters);

        // Calculate FINDRISC Score
        $score = 0;

        // Age Score
        if ($validated['age'] < 45) {
            $score += 0;
        } elseif ($validated['age'] <= 54) {
            $score += 2;
        } elseif ($validated['age'] <= 64) {
            $score += 3;
        } else {
            $score += 4;
        }

        // BMI Score
        if ($bmi < 25) {
            $score += 0;
        } elseif ($bmi < 30) {
            $score += 1;
        } else {
            $score += 3;
        }

        // Waist Score
        if ($validated['gender'] === 'M') {
            if ($validated['waist'] < 94) {
                $score += 0;
            } elseif ($validated['waist'] < 102) {
                $score += 3;
            } else {
                $score += 4;
            }
        } else { // Gender F
            if ($validated['waist'] < 80) {
                $score += 0;
            } elseif ($validated['waist'] < 88) {
                $score += 3;
            } else {
                $score += 4;
            }
        }

        // Other factors
        $score += $validated['act'];
        $score += $validated['food'];
        $score += $validated['htn'];
        $score += $validated['glu'];
        $score += $validated['fam'];

        // Determine Risk Level
        if ($score < 7) {
            $riskLevel = 'Riesgo Bajo';
        } elseif ($score <= 11) {
            $riskLevel = 'Riesgo Ligeramente Elevado';
        } elseif ($score <= 14) {
            $riskLevel = 'Riesgo Moderado';
        } elseif ($score <= 19) {
            $riskLevel = 'Riesgo Alto';
        } else {
            $riskLevel = 'Riesgo Muy Alto';
        }

        // Create the record
        $survey = Survey::create(array_merge($validated, [
            'uuid'       => (string) Str::uuid(),
            'bmi'        => round($bmi, 1),
            'score'      => $score,
            'risk_level' => $riskLevel,
        ]));

        return back()->with('result', [
            'score'      => $score,
            'risk_level' => $riskLevel,
            'uuid'       => $survey->uuid,
        ])->with('success', 'Encuesta guardada con éxito.');
    }
}
