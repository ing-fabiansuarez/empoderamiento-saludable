<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Evaluación — Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .badge-low     { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .badge-slight  { background: #fef9c3; color: #713f12; border: 1px solid #fde047; }
        .badge-mod     { background: #ffedd5; color: #9a3412; border: 1px solid #fdba74; }
        .badge-high    { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-vhigh   { background: #fce7f3; color: #831843; border: 1px solid #f9a8d4; }
    </style>
</head>
<body class="min-h-screen bg-[#f0f6ff]">

    <header class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 19.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 5.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-blue-900 text-sm leading-none block">Red Mutis</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">Investigación en Salud Metabólica</span>
                </div>
            </div>
            <a href="{{ route('surveys.index') }}" class="text-xs font-semibold text-blue-700 hover:text-blue-800 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Volver al inicio
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        <div class="bg-white rounded-3xl shadow-xl border border-blue-50 overflow-hidden">
            @php
                $score = $survey->score;
                $risk = $survey->risk_level;
                $uuid = $survey->uuid;
                $badgeClass = match(true) {
                    $score < 7  => 'badge-low',
                    $score < 12 => 'badge-slight',
                    $score < 15 => 'badge-mod',
                    $score < 20 => 'badge-high',
                    default     => 'badge-vhigh',
                };
                $headerGradient = match(true) {
                    $score < 7  => 'from-emerald-600 to-emerald-800',
                    $score < 12 => 'from-yellow-500 to-amber-700',
                    $score < 15 => 'from-orange-500 to-orange-800',
                    $score < 20 => 'from-red-600 to-red-900',
                    default     => 'from-rose-700 to-pink-900',
                };
                $scoreBarColor = match(true) {
                    $score < 7  => 'bg-emerald-400',
                    $score < 12 => 'bg-yellow-400',
                    $score < 15 => 'bg-orange-500',
                    $score < 20 => 'bg-red-500',
                    default     => 'bg-rose-600',
                };
                $bgTint = match(true) {
                    $score < 7  => 'bg-emerald-50',
                    $score < 12 => 'bg-yellow-50',
                    $score < 15 => 'bg-orange-50',
                    $score < 20 => 'bg-red-50',
                    default     => 'bg-pink-50',
                };
                $scorePercent = min(100, round(($score / 26) * 100));
            @endphp

            <!-- Header -->
            <div class="bg-gradient-to-br {{ $headerGradient }} px-8 py-10 text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 80% 20%, white 1px, transparent 1px); background-size: 24px 24px;"></div>
                <div class="flex items-center gap-3 mb-2 relative">
                    <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span class="text-white/70 text-sm font-medium uppercase tracking-widest">Evaluación Completada</span>
                </div>
                <h2 class="text-3xl font-extrabold relative">Tu Resultado FINDRISC</h2>
                <p class="text-white/70 text-sm mt-1 relative">Basado en la escala finlandesa de riesgo de diabetes.</p>
            </div>

            <!-- Score area -->
            <div class="{{ $bgTint }} px-8 py-8 border-b border-slate-100">
                <div class="flex flex-col md:flex-row md:items-center gap-8">
                    <!-- Score display -->
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 uppercase font-semibold tracking-widest mb-2">Puntaje Total</p>
                        <div class="flex items-end gap-3 mb-4">
                            <p class="text-8xl font-extrabold text-slate-900 leading-none">{{ $score }}</p>
                            <div class="pb-2">
                                <p class="text-slate-500 text-lg font-medium">puntos</p>
                                <p class="text-slate-400 text-sm">sobre 26</p>
                            </div>
                        </div>

                        <!-- Score bar with scale -->
                        <div class="mb-4">
                            <div class="w-full bg-white rounded-full h-5 border border-slate-200 relative overflow-hidden shadow-inner">
                                <div class="{{ $scoreBarColor }} h-5 rounded-full transition-all duration-1000" style="width: {{ $scorePercent }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-slate-400 mt-2 px-1 font-medium">
                                <span>0</span><span>7</span><span>11</span><span>14</span><span>19</span><span>26</span>
                            </div>
                        </div>

                        <span class="{{ $badgeClass }} inline-block text-lg font-bold px-6 py-2.5 rounded-2xl shadow-sm mt-2">
                            {{ $risk }}
                        </span>
                    </div>

                    <!-- Risk table legend -->
                    <div class="flex-shrink-0 bg-white rounded-2xl border border-slate-200 p-6 w-full md:w-64 text-sm shadow-sm">
                        <p class="text-slate-400 uppercase font-semibold tracking-wider mb-4 border-b pb-2">Escala de Riesgo</p>
                        <div class="space-y-3">
                            @foreach([['0–6','Riesgo Bajo','badge-low'],['7–11','Ligeramente Elevado','badge-slight'],['12–14','Moderado','badge-mod'],['15–19','Alto','badge-high'],['≥20','Muy Alto','badge-vhigh']] as [$range, $label, $cls])
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-slate-500 font-mono text-xs">{{ $range }}</span>
                                    <span class="{{ $cls }} text-[11px] font-bold px-2.5 py-1 rounded-lg">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code + disclaimer + actions -->
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-3">Código de Participante Anónimo</p>
                        <p class="font-mono text-sm text-slate-700 bg-slate-50 px-4 py-3 rounded-xl border border-slate-100 break-all shadow-inner">{{ $uuid }}</p>
                        <p class="text-[11px] text-slate-400 mt-3 leading-relaxed">Guarda este código como referencia única de tu participación en el estudio académico.</p>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 text-sm text-blue-800 shadow-sm flex flex-col justify-center">
                        <div class="flex gap-3 mb-2">
                            <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                            <span class="font-bold text-blue-900">Aviso Importante</span>
                        </div>
                        <p class="leading-relaxed">⚕️ Este resultado es <strong>orientativo</strong> y <strong>no constituye un diagnóstico médico</strong> profesional. Si obtuviste un riesgo moderado o superior, es fundamental que consultes con tu médico para una valoración clínica completa.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('surveys.index') }}" class="flex-1 bg-blue-700 hover:bg-blue-800 active:scale-[.98] text-white py-4 rounded-2xl font-bold text-base tracking-wide transition-all shadow-lg shadow-blue-100 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Llenar Otra Encuesta
                    </a>
                    <button onclick="window.print()" class="sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-4 rounded-2xl font-bold text-base transition-all flex items-center justify-center gap-2 border border-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Imprimir
                    </button>
                </div>
            </div>
        </div>

        <footer class="mt-12 text-center text-xs text-slate-400 space-y-2">
            <p class="font-semibold text-slate-500">Proyecto Empoderamiento Saludable · Red Mutis</p>
            <p>Investigación de Riesgo Mínimo · Uso exclusivamente académico · © {{ date('Y') }}</p>
            <p>La escala FINDRISC es un instrumento de cribado validado internacionalmente.</p>
        </footer>
    </main>

</body>
</html>
