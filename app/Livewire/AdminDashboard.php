<?php

namespace App\Livewire;

use App\Models\NeedsInstrument;
use App\Models\Survey;
use Livewire\Component;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;

class AdminDashboard extends Component
{
    use WithPagination;

    public $surveyType = 1; // 1 = Consentimiento/FINDRISC, 2 = Necesidades

    public $sortOrder = 'desc'; // 'desc' = Recientes, 'asc' = Últimos

    public $riskFilter = ''; // '' = Todos, 'Bajo', 'Moderado', 'Alto', etc.

    public $isSidebarOpen = true;

    public $perPage = 10;

    protected $queryString = [
        'surveyType' => ['except' => 1],
        'sortOrder' => ['except' => 'desc'],
        'riskFilter' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function updating($name, $value)
    {
        if (in_array($name, ['surveyType', 'sortOrder', 'riskFilter', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function toggleSidebar()
    {
        $this->isSidebarOpen = ! $this->isSidebarOpen;
    }

    public function getQuery()
    {
        $query = null;

        if ($this->surveyType == 1) {
            $query = Survey::query();
            if ($this->riskFilter) {
                // Handle variations like "Ligeramente elevado" just in case by using LIKE if needed, or exact match.
                // Our risk_level usually contains the exact text or we can just use `like`
                $query->where('risk_level', 'ilike', '%'.$this->riskFilter.'%');
            }
        } else {
            $query = NeedsInstrument::query();
            if ($this->riskFilter) {
                $query->where('risk_level', 'ilike', '%'.$this->riskFilter.'%');
            }
        }

        $query->orderBy('created_at', $this->sortOrder);

        return $query;
    }

    public function exportToExcel()
    {
        $data = $this->getQuery()->get();

        if ($this->surveyType == 1) {
            return response()->streamDownload(function () use ($data) {
                (new FastExcel($data))->export('php://output', function ($survey) {
                    return [
                        'ID' => $survey->id,
                        'Correo' => $survey->mail,
                        'Sexo' => $survey->gender,
                        'Edad' => $survey->age,
                        'Peso (kg)' => $survey->weight,
                        'Estatura (cm)' => $survey->height,
                        'Cintura (cm)' => $survey->waist,
                        'Actividad Física' => $survey->daily_activity,
                        'Frutas/Verduras' => $survey->fruit_consumption,
                        'Medic. Antihipertensiva' => $survey->antihypertensive_medication,
                        'Glucosa Elevada' => $survey->elevated_glucose,
                        'Antecedentes Familiares' => $survey->family_history,
                        'IMC' => $survey->bmi,
                        'Puntaje FINDRISC' => $survey->score,
                        'Nivel de Riesgo' => $survey->risk_level,
                        'Fecha Registro' => $survey->created_at->format('Y-m-d H:i:s'),
                    ];
                });
            }, 'encuestas_findrisc.xlsx');
        } else {
            return response()->streamDownload(function () use ($data) {
                (new FastExcel($data))->export('php://output', function ($survey) {
                    return [
                        'ID' => $survey->id,
                        'UUID' => $survey->uuid,
                        'Rol' => $survey->role,
                        'Nivel de Riesgo' => $survey->risk_level,
                        'Barrera' => $survey->barrier,
                        'Otra Barrera' => $survey->barrier_other,
                        'Percepción vs Realidad' => $survey->perception_vs_reality,
                        'Bucle de Fallo' => $survey->failure_loop,
                        'Esperanzas (Hopes)' => $survey->hopes,
                        'Fecha Registro' => $survey->created_at->format('Y-m-d H:i:s'),
                    ];
                });
            }, 'encuestas_necesidades.xlsx');
        }
    }

    public function destroyRecord($id)
    {
        if ($this->surveyType == 1) {
            Survey::findOrFail($id)->delete();
        } else {
            NeedsInstrument::findOrFail($id)->delete();
        }

        session()->flash('success', 'Registro eliminado correctamente.');
    }

    public function render()
    {
        $surveys = $this->getQuery()->paginate($this->perPage);

        return view('livewire.admin-dashboard', compact('surveys'));
    }
}
