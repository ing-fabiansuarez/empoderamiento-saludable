<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\Survey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Rap2hpoutre\FastExcel\FastExcel;

class AdminSessionController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Attempt admin login.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = AdminUser::where('user', $credentials['user'])->first();

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return back()
                ->withInput($request->only('user'))
                ->withErrors(['user' => 'Credenciales incorrectas. Intente de nuevo.']);
        }

        $request->session()->regenerate();
        session(['admin_id' => $admin->id, 'admin_user' => $admin->user]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the admin dashboard.
     */
    public function dashboard(Request $request): View
    {
        $perPage = $request->input('per_page', 10);
        $surveys = Survey::orderBy('id', 'asc')->paginate($perPage);

        return view('admin.dashboard', compact('surveys', 'perPage'));
    }

    /**
     * Delete a survey.
     */
    public function destroySurvey($id): RedirectResponse
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Registro eliminado correctamente.');
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_id', 'admin_user']);

        return redirect()->route('admin.login');
    }

    /**
     * Export all surveys to Excel.
     */
    public function exportSurveys()
    {
        $surveys = Survey::all();

        return (new FastExcel($surveys))->download('encuestas.xlsx', function ($survey) {
            return [
                'ID' => $survey->id,
                'Nombres' => $survey->names,
                'Apellidos' => $survey->surnames,
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
    }
}
