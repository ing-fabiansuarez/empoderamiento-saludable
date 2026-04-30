<?php

namespace App\Livewire;

use App\Mail\NeedsInstrumentCompleted;
use App\Models\NeedsInstrument;
use App\Models\Survey;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class NeedsInstrumentForm extends Component
{
    public $uuid;

    public $role = '';

    public $risk_level = '';

    public $barrier = '';

    public $barrier_other = '';

    public $perception_vs_reality = 5;

    public $failure_loop = '';

    public $hopes = '';

    public $successMessage = false;

    public $isAlreadySubmitted = false;

    public function updatedUuid($value)
    {
        if (! empty($value) && Str::isUuid($value)) {
            $this->isAlreadySubmitted = NeedsInstrument::where('uuid', $value)->exists();
        } else {
            $this->isAlreadySubmitted = false;
        }
    }

    public function save()
    {
        $validator = Validator::make([
            'uuid' => $this->uuid,
            'role' => $this->role,
            'risk_level' => $this->risk_level,
            'barrier' => $this->barrier,
            'barrier_other' => $this->barrier_other,
            'perception_vs_reality' => $this->perception_vs_reality,
            'failure_loop' => $this->failure_loop,
            'hopes' => $this->hopes,
        ], [
            'uuid' => 'bail|required|uuid|exists:surveys,uuid',
            'role' => 'required|string',
            'risk_level' => 'required|in:Bajo,Moderado,Alto',
            'barrier' => 'required|string',
            'barrier_other' => 'required_if:barrier,Otro|string|max:255',
            'perception_vs_reality' => 'required|integer|min:1|max:10',
            'failure_loop' => 'required|string',
            'hopes' => 'required|string',
        ], [
            'uuid.uuid' => 'ID no válido',
            'uuid.exists' => 'ID no válido',
            'uuid.required' => 'El ID Único es obligatorio.',
            'barrier_other.required_if' => 'Debe especificar cuál es la otra barrera.',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('uuid')) {
                $this->dispatch('focus-uuid');
            }
            $validator->validate();
        }

        // Check if this UUID has already filled this second survey
        if (NeedsInstrument::where('uuid', $this->uuid)->exists()) {
            $this->addError('uuid', 'Este ID Único ya ha completado el Instrumento de Elicitación de Necesidades.');

            return;
        }

        $instrument = NeedsInstrument::create([
            'uuid' => $this->uuid,
            'role' => $this->role,
            'risk_level' => $this->risk_level,
            'barrier' => $this->barrier,
            'barrier_other' => $this->barrier === 'Otro' ? $this->barrier_other : null,
            'perception_vs_reality' => $this->perception_vs_reality,
            'failure_loop' => $this->failure_loop,
            'hopes' => $this->hopes,
        ]);

        $survey = Survey::where('uuid', $this->uuid)->first();

        // Rate limiting: 1 email per 30 seconds for survey 2
        $executed = RateLimiter::attempt(
            'send-email-survey2-' . session()->getId(),
            1,
            function() use ($instrument, $survey) {
                Mail::to($survey->mail)->send(new NeedsInstrumentCompleted($instrument, $survey));
            },
            30
        );

        if (! $executed) {
            $seconds = RateLimiter::availableIn('send-email-survey2-' . session()->getId());
            $this->addError('rate_limit', 'Por favor espere '.$seconds.' segundos antes de volver a enviar un correo.');
            return;
        }

        $this->successMessage = true;
    }

    public function resendEmail()
    {
        if (empty($this->uuid)) {
            return;
        }

        $instrument = NeedsInstrument::where('uuid', $this->uuid)->first();
        $survey = Survey::where('uuid', $this->uuid)->first();

        if (! $instrument || ! $survey) {
            return;
        }

        $executed = RateLimiter::attempt(
            'send-email-survey2-' . session()->getId(),
            1,
            function() use ($instrument, $survey) {
                Mail::to($survey->mail)->send(new NeedsInstrumentCompleted($instrument, $survey));
            },
            30
        );

        if (! $executed) {
            $seconds = RateLimiter::availableIn('send-email-survey2-' . session()->getId());
            $this->addError('rate_limit', 'Por favor espere '.$seconds.' segundos antes de volver a enviar un correo.');
            return;
        }

        session()->flash('resend_success', 'Se ha reenviado exitosamente a ' . $survey->mail);
    }

    public function render()
    {
        return view('livewire.needs-instrument-form');
    }
}
