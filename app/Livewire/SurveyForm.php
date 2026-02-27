<?php

namespace App\Livewire;

use App\Models\Survey;
use Illuminate\Support\Str;
use Livewire\Component;

class SurveyForm extends Component
{
    // Steps: 1 (Consent), 2 (Identification), 3 (Antropometrica), 4 (Habitos), 99 (Confirmation for Diabetes)
    public $currentStep = 1;

    public $consent = false;

    public $mail;

    public $has_diabetes;

    // FINDRISC fields
    public $gender = 'M';

    public $age;

    public $weight;

    public $height;

    public $waist;

    public $daily_activity;

    public $fruit_consumption;

    public $antihypertensive_medication;

    public $elevated_glucose;

    public $family_history = '0';

    public function mount()
    {
        if (old('has_diabetes') !== null) {
            $this->has_diabetes = old('has_diabetes');
        }
        $this->mail = old('mail');
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'consent' => 'required|accepted',
            ], [
                'consent.accepted' => 'Debes aceptar el consentimiento para continuar.',
            ]);
            $this->currentStep = 2;
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'mail' => 'required|email|max:150',
                'has_diabetes' => 'required|in:0,1',
            ]);

            if ($this->has_diabetes == '1') {
                $this->currentStep = 99;
            } else {
                $this->currentStep = 3;
            }
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'gender' => 'required|in:M,F',
                'age' => 'required|integer|min:18|max:100',
                'weight' => 'required|numeric|min:30|max:250',
                'height' => 'required|numeric|min:120|max:220',
                'waist' => 'required|numeric|min:40|max:200',
            ]);
            $this->currentStep = 4;
        }
    }

    public function prevStep()
    {
        if ($this->currentStep === 99) {
            $this->currentStep = 2;
        } else {
            $this->currentStep--;
        }
    }

    public function save()
    {
        if ($this->has_diabetes == '1') {
            $this->validate([
                'consent' => 'required|accepted',
                'mail' => 'required|email|max:150',
                'has_diabetes' => 'required|in:1',
            ]);

            $survey = Survey::create([
                'uuid' => (string) Str::uuid(),
                'mail' => $this->mail,
                'has_diabetes' => true,
                'score' => null,
                'risk_level' => 'Diagnosticado con Diabetes',
            ]);

            return redirect()->route('surveys.show', $survey->uuid)->with('success', 'Registro guardado con éxito.');
        }

        $this->validate([
            'consent' => 'required|accepted',
            'mail' => 'required|email|max:150',
            'has_diabetes' => 'required|in:0',
            'gender' => 'required|in:M,F',
            'age' => 'required|integer|min:18|max:100',
            'weight' => 'required|numeric|min:30|max:250',
            'height' => 'required|numeric|min:120|max:220',
            'waist' => 'required|numeric|min:40|max:200',
            'daily_activity' => 'required|integer|in:0,2',
            'fruit_consumption' => 'required|integer|in:0,1',
            'antihypertensive_medication' => 'required|integer|in:0,2',
            'elevated_glucose' => 'required|integer|in:0,5',
            'family_history' => 'required|integer|in:0,3,5',
        ]);

        // Calculate BMI
        $heightInMeters = $this->height / 100;
        $bmi = $this->weight / ($heightInMeters * $heightInMeters);

        // Calculate FINDRISC Score
        $score = 0;

        // Age Score
        if ($this->age < 45) {
            $score += 0;
        } elseif ($this->age <= 54) {
            $score += 2;
        } elseif ($this->age <= 64) {
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
        if ($this->gender === 'M') {
            if ($this->waist < 94) {
                $score += 0;
            } elseif ($this->waist < 102) {
                $score += 3;
            } else {
                $score += 4;
            }
        } else { // Gender F
            if ($this->waist < 80) {
                $score += 0;
            } elseif ($this->waist < 88) {
                $score += 3;
            } else {
                $score += 4;
            }
        }

        // Other factors
        $score += (int) $this->daily_activity;
        $score += (int) $this->fruit_consumption;
        $score += (int) $this->antihypertensive_medication;
        $score += (int) $this->elevated_glucose;
        $score += (int) $this->family_history;

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

        // Map labels (logic from original controller)
        $dailyActivityLabel = $this->daily_activity == 0 ? 'si' : 'no';
        $fruitConsumptionLabel = $this->fruit_consumption == 0 ? 'si' : 'no';
        $antihypertensionLabel = $this->antihypertensive_medication == 2 ? 'si' : 'no';
        $elevatedGlucoseLabel = $this->elevated_glucose == 5 ? 'si' : 'no';

        $familyHistoryLabel = 'no';
        if ($this->family_history == 3) {
            $familyHistoryLabel = 'familiar grado 2';
        } elseif ($this->family_history == 5) {
            $familyHistoryLabel = 'familiar grado 1';
        }

        $survey = Survey::create([
            'uuid' => (string) Str::uuid(),
            'mail' => $this->mail,
            'has_diabetes' => false,
            'gender' => $this->gender,
            'age' => $this->age,
            'weight' => $this->weight,
            'height' => $this->height,
            'waist' => $this->waist,
            'daily_activity' => $dailyActivityLabel,
            'fruit_consumption' => $fruitConsumptionLabel,
            'antihypertensive_medication' => $antihypertensionLabel,
            'elevated_glucose' => $elevatedGlucoseLabel,
            'family_history' => $familyHistoryLabel,
            'bmi' => round($bmi, 1),
            'score' => $score,
            'risk_level' => $riskLevel,
        ]);

        return redirect()->route('surveys.show', $survey->uuid)->with('success', 'Encuesta guardada con éxito.');
    }

    public function render()
    {
        return view('livewire.survey-form');
    }
}
