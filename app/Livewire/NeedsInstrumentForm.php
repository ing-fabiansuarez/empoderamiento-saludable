<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NeedsInstrument;
use App\Models\Survey;

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

    public function save()
    {
        $this->validate([
            'uuid' => 'required|exists:surveys,uuid',
            'role' => 'required|string',
            'risk_level' => 'required|in:Bajo,Moderado,Alto',
            'barrier' => 'required|string',
            'barrier_other' => 'required_if:barrier,Otro|string|max:255',
            'perception_vs_reality' => 'required|integer|min:1|max:10',
            'failure_loop' => 'required|string',
            'hopes' => 'required|string',
        ], [
            'uuid.exists' => 'El ID Único ingresado no existe. Por favor verifique el código en su correo.',
            'uuid.required' => 'El ID Único es obligatorio.',
            'barrier_other.required_if' => 'Debe especificar cuál es la otra barrera.',
        ]);

        // Check if this UUID has already filled this second survey
        if (NeedsInstrument::where('uuid', $this->uuid)->exists()) {
            $this->addError('uuid', 'Este ID Único ya ha completado el Instrumento de Elicitación de Necesidades.');
            return;
        }

        NeedsInstrument::create([
            'uuid' => $this->uuid,
            'role' => $this->role,
            'risk_level' => $this->risk_level,
            'barrier' => $this->barrier,
            'barrier_other' => $this->barrier === 'Otro' ? $this->barrier_other : null,
            'perception_vs_reality' => $this->perception_vs_reality,
            'failure_loop' => $this->failure_loop,
            'hopes' => $this->hopes,
        ]);

        $this->successMessage = true;
    }

    public function render()
    {
        return view('livewire.needs-instrument-form');
    }
}
