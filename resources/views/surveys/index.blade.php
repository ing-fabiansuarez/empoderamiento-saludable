<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación de Riesgo de Diabetes — Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Steps */
        .step { display: none; animation: fadeUp .35s ease both; }
        .step.active { display: block; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Progress bar */
        .progress-bar { transition: width .5s cubic-bezier(.4,0,.2,1); }

        /* Radio/Checkbox custom */
        .choice-card input[type="radio"] { display: none; }
        .choice-card label {
            display: flex; align-items: center; gap: .75rem;
            padding: .9rem 1.1rem; border-radius: .85rem;
            border: 1.5px solid #dbeafe; cursor: pointer;
            background: #f8fafc; transition: all .2s;
        }
        .choice-card label:hover { border-color: #3b82f6; background: #eff6ff; }
        .choice-card input:checked + label {
            border-color: #1d4ed8; background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .choice-card .radio-dot {
            width: 18px; height: 18px; border-radius: 50%;
            border: 2px solid #93c5fd; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            transition: all .2s;
        }
        .choice-card input:checked + label .radio-dot {
            border-color: #1d4ed8; background: #1d4ed8;
        }
        .choice-card input:checked + label .radio-dot::after {
            content: ''; display: block;
            width: 7px; height: 7px;
            border-radius: 50%; background: white;
        }

        /* Risk badge colors */
        .badge-low     { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .badge-slight  { background: #fef9c3; color: #713f12; border: 1px solid #fde047; }
        .badge-mod     { background: #ffedd5; color: #9a3412; border: 1px solid #fdba74; }
        .badge-high    { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .badge-vhigh   { background: #fce7f3; color: #831843; border: 1px solid #f9a8d4; }

        /* Input focus */
        input[type="number"], select {
            transition: border-color .2s, box-shadow .2s;
        }
        input[type="number"]:focus, select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }

        /* Scrollbar for consent */
        .consent-scroll::-webkit-scrollbar { width: 6px; }
        .consent-scroll::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 3px; }
        .consent-scroll::-webkit-scrollbar-thumb { background: #93c5fd; border-radius: 3px; }
    </style>
</head>
<body class="min-h-screen bg-[#f0f6ff]">

    <!-- TOP HEADER BAR -->
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
            <span class="hidden sm:inline-flex items-center gap-1.5 text-xs text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Estudio Activo · Riesgo Mínimo
            </span>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">

        <!-- HERO SECTION -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold text-blue-600 bg-blue-50 border border-blue-200 px-3 py-1 rounded-full mb-3">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Escala Validada FINDRISC · OMS
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-blue-950 leading-tight mb-2">
                        Evaluación de Riesgo<br>
                        <span class="text-blue-600">de Diabetes Tipo 2</span>
                    </h1>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-lg">
                        Proyecto de investigación académica que utiliza la escala <strong>FINDRISC</strong> (Finnish Diabetes Risk Score) para estimar de forma orientativa el riesgo de desarrollar diabetes tipo 2 en los próximos 10 años.
                    </p>
                </div>
                <!-- Stats decorative panel -->
                <div class="flex-shrink-0 grid grid-cols-2 gap-3 w-full md:w-64">
                    <div class="bg-white border border-blue-100 rounded-2xl p-4 text-center shadow-sm">
                        <p class="text-2xl font-extrabold text-blue-700">FINDRISC</p>
                        <p class="text-[11px] text-slate-400 uppercase tracking-wide mt-0.5">Escala OMS</p>
                    </div>
                    <div class="bg-white border border-blue-100 rounded-2xl p-4 text-center shadow-sm">
                        <p class="text-2xl font-extrabold text-emerald-600">10 min</p>
                        <p class="text-[11px] text-slate-400 uppercase tracking-wide mt-0.5">Duración</p>
                    </div>
                    <div class="col-span-2 bg-blue-700 rounded-2xl p-4 text-center shadow-sm">
                        <p class="text-xs text-blue-200 font-medium">Participación</p>
                        <p class="text-white font-bold text-sm mt-0.5">Anónima · Voluntaria · Confidencial</p>
                    </div>
                </div>
            </div>

            <!-- Step indicators — 4 steps -->
            <div class="flex items-center gap-2">
                @foreach(['Consentimiento', 'Medidas', 'Hábitos', 'Resultados'] as $i => $label)
                    <div id="step-indicator-{{ $i+1 }}" class="flex items-center gap-2 transition-all duration-300">
                        <div class="step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $i === 0 ? 'bg-blue-700 text-white' : 'bg-white text-slate-400 border-2 border-slate-200' }} transition-all">{{ $i+1 }}</div>
                        <span class="step-label text-xs font-semibold {{ $i === 0 ? 'text-blue-700' : 'text-slate-400' }} hidden sm:inline transition-all">{{ $label }}</span>
                    </div>
                    @if($i < 3)
                        <div id="connector-{{ $i+1 }}" class="flex-1 h-0.5 bg-slate-200 rounded-full mx-1 transition-all duration-500"></div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- VALIDATION ERRORS (shown above the card if there are errors) -->
        @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-xl p-5 flex gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                <div>
                    <p class="text-red-700 font-semibold text-sm mb-1">Por favor, corrige los siguientes campos:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl shadow-xl border border-blue-50 overflow-hidden">
            <form id="findriscForm" action="{{ route('surveys.store') }}" method="POST">
                @csrf

                <!-- ======================== STEP 1: CONSENTIMIENTO ======================== -->
                <div class="step active" id="s1">
                    <div class="bg-gradient-to-br from-blue-700 to-blue-900 px-8 py-6 text-white">
                        <div class="flex items-center gap-3 mb-1">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            <span class="text-blue-300 text-sm font-medium uppercase tracking-widest">Paso 1 de 4</span>
                        </div>
                        <h2 class="text-xl font-bold">Consentimiento Informado</h2>
                        <p class="text-blue-200 text-sm mt-1">Por favor, lea detenidamente antes de participar.</p>
                    </div>

                    <div class="p-8">
                        <div class="consent-scroll bg-slate-50 rounded-2xl border border-slate-200 p-6 text-sm text-slate-600 leading-7 h-72 overflow-y-auto mb-6 space-y-4">
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">§</div>
                                <div><strong class="text-slate-700">Marco Normativo:</strong> El presente estudio se rige por la Declaración de Helsinki (1964, rev. 2002), la Resolución 008430 de 1993 del Ministerio de Salud de Colombia (Investigación de Riesgo Mínimo) y la Ley 1581 de 2012 de Protección de Datos Personales.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">⊕</div>
                                <div><strong class="text-slate-700">Objetivo:</strong> Evaluar el riesgo metabólico de los participantes mediante la escala FINDRISC y analizar estrategias digitales para el empoderamiento saludable en prevención de diabetes tipo 2.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">📋</div>
                                <div><strong class="text-slate-700">Procedimiento:</strong> Se registrarán datos de peso, talla, perímetro abdominal y se aplicará el cuestionario FINDRISC completo. No se realizan exámenes clínicos ni extracción de muestras biológicas.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">⏱</div>
                                <div><strong class="text-slate-700">Duración estimada:</strong> Entre 8 y 12 minutos.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">!</div>
                                <div><strong class="text-slate-700">Riesgos:</strong> Este estudio es de riesgo mínimo. Es posible cierta incomodidad leve al responder preguntas sobre hábitos de salud.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">✓</div>
                                <div><strong class="text-slate-700">Beneficios:</strong> Recibirá una estimación orientativa de su riesgo y contribuirá al conocimiento científico en salud pública colombiana.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">🔒</div>
                                <div><strong class="text-slate-700">Confidencialidad:</strong> Se le asignará un código anónimo automático. Sus datos serán protegidos y utilizados exclusivamente con fines académicos. No se realizará explotación comercial de la información.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">⚠</div>
                                <div><strong class="text-slate-700">No diagnóstico:</strong> El resultado de este instrumento no reemplaza la valoración clínica de un profesional de la salud.</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">↩</div>
                                <div><strong class="text-slate-700">Voluntariedad:</strong> Su participación es completamente voluntaria. Puede retirarse en cualquier momento y sin consecuencia alguna.</div>
                            </div>
                        </div>

                        <label class="flex items-start gap-3 cursor-pointer p-4 rounded-xl border-2 border-slate-200 hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 mb-6">
                            <input type="checkbox" id="consent" class="mt-0.5 h-5 w-5 rounded accent-blue-700 flex-shrink-0 cursor-pointer">
                            <div>
                                <p class="font-semibold text-slate-800 text-sm">He leído y comprendo el consentimiento informado</p>
                                <p class="text-xs text-slate-400 mt-0.5">Acepto participar voluntariamente en este estudio de investigación.</p>
                            </div>
                        </label>

                        <button type="button" onclick="next(2)" class="w-full bg-blue-700 hover:bg-blue-800 active:scale-[.98] text-white py-3.5 rounded-xl font-semibold text-sm tracking-wide transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                            Continuar con la Evaluación
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- ======================== STEP 2: MEDIDAS ANTROPOMÉTRICAS ======================== -->
                <div class="step" id="s2">
                    <div class="bg-gradient-to-br from-cyan-700 to-blue-800 px-8 py-6 text-white">
                        <div class="flex items-center gap-3 mb-1">
                            <svg class="w-5 h-5 text-cyan-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            <span class="text-cyan-300 text-sm font-medium uppercase tracking-widest">Paso 2 de 4</span>
                        </div>
                        <h2 class="text-xl font-bold">Datos Antropométricos</h2>
                        <p class="text-cyan-200 text-sm mt-1">Ingrese sus medidas corporales con la mayor precisión posible.</p>
                    </div>

                    <div class="p-8">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-7 flex gap-3 text-sm text-blue-800">
                            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                            <p>El <strong>perímetro de cintura</strong> se mide a la altura del ombligo, con el abdomen relajado, al final de una espiración normal.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Sexo -->
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Sexo Biológico</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer transition-all duration-200 border-slate-200 hover:border-blue-400">
                                        <input type="radio" name="gender" value="M" class="accent-blue-700" {{ old('gender', 'M') == 'M' ? 'checked' : '' }}>
                                        <div><span class="text-lg">♂</span><span class="ml-1 font-semibold text-sm text-slate-700">Hombre</span></div>
                                    </label>
                                    <label class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer transition-all duration-200 border-slate-200 hover:border-blue-400">
                                        <input type="radio" name="gender" value="F" class="accent-blue-700" {{ old('gender') == 'F' ? 'checked' : '' }}>
                                        <div><span class="text-lg">♀</span><span class="ml-1 font-semibold text-sm text-slate-700">Mujer</span></div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Edad <span class="text-slate-400 font-normal">(años)</span></label>
                                <input type="number" name="age" min="18" max="100" value="{{ old('age') }}" placeholder="ej. 45" required
                                    class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium placeholder:text-slate-300 outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Peso <span class="text-slate-400 font-normal">(kg)</span></label>
                                <input type="number" name="weight" id="weight" min="30" max="250" step="0.1" value="{{ old('weight') }}" placeholder="ej. 78.5" required
                                    class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium placeholder:text-slate-300 outline-none"
                                    oninput="calculateBmi()">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Estatura <span class="text-slate-400 font-normal">(cm)</span></label>
                                <input type="number" name="height" id="height" min="120" max="220" value="{{ old('height') }}" placeholder="ej. 170" required
                                    class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium placeholder:text-slate-300 outline-none"
                                    oninput="calculateBmi()">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Perímetro de Cintura <span class="text-slate-400 font-normal">(cm)</span></label>
                                <input type="number" name="waist" id="waist" min="40" max="200" value="{{ old('waist') }}" placeholder="ej. 92" required
                                    class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium placeholder:text-slate-300 outline-none">
                            </div>
                        </div>

                        <!-- IMC Live Preview -->
                        <div id="bmiDisplay" class="hidden mt-5 rounded-xl border-2 border-blue-200 bg-blue-50 p-4 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-black text-sm" id="bmiValue">--</span>
                            </div>
                            <div>
                                <p class="text-xs text-blue-500 font-medium uppercase tracking-wider">Índice de Masa Corporal (IMC)</p>
                                <p id="bmiCategory" class="text-blue-900 font-bold text-sm mt-0.5"></p>
                                <p class="text-xs text-blue-400">Estimación previa · El cálculo oficial se realiza en el servidor</p>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-7">
                            <button type="button" onclick="next(1)" class="flex-none bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-3.5 rounded-xl font-semibold text-sm transition">← Atrás</button>
                            <button type="button" onclick="next(3)" class="flex-1 bg-blue-700 hover:bg-blue-800 active:scale-[.98] text-white py-3.5 rounded-xl font-semibold text-sm tracking-wide transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                                Continuar
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ======================== STEP 3: HÁBITOS ======================== -->
                <div class="step" id="s3">
                    <div class="bg-gradient-to-br from-indigo-700 to-blue-900 px-8 py-6 text-white">
                        <div class="flex items-center gap-3 mb-1">
                            <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            <span class="text-indigo-300 text-sm font-medium uppercase tracking-widest">Paso 3 de 4</span>
                        </div>
                        <h2 class="text-xl font-bold">Hábitos y Antecedentes de Salud</h2>
                        <p class="text-indigo-200 text-sm mt-1">Cuestionario clínico FINDRISC — responda con honestidad.</p>
                    </div>

                    <div class="p-8 space-y-6">

                        <fieldset>
                            <legend class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                                <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-black flex items-center justify-center flex-shrink-0">1</span>
                                ¿Realiza <strong class="mx-1 text-indigo-700">al menos 30 min de actividad física</strong> diariamente (incluyendo actividad laboral)?
                            </legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div>
                                    <input type="radio" id="act_yes" name="act" value="0" {{ old('act') === '0' ? 'checked' : '' }} required>
                                    <label for="act_yes" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> Sí, regularmente</label>
                                </div>
                                <div>
                                    <input type="radio" id="act_no" name="act" value="2" {{ old('act') === '2' ? 'checked' : '' }}>
                                    <label for="act_no" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> No</label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                                <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-black flex items-center justify-center flex-shrink-0">2</span>
                                ¿Consume <strong class="mx-1 text-indigo-700">frutas, verduras u hortalizas</strong> todos los días?
                            </legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div>
                                    <input type="radio" id="food_yes" name="food" value="0" {{ old('food') === '0' ? 'checked' : '' }} required>
                                    <label for="food_yes" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> Sí, a diario</label>
                                </div>
                                <div>
                                    <input type="radio" id="food_no" name="food" value="1" {{ old('food') === '1' ? 'checked' : '' }}>
                                    <label for="food_no" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> No regularmente</label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                                <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-black flex items-center justify-center flex-shrink-0">3</span>
                                ¿Toma <strong class="mx-1 text-indigo-700">medicación antihipertensiva</strong> de forma regular?
                            </legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div>
                                    <input type="radio" id="htn_yes" name="htn" value="2" {{ old('htn') === '2' ? 'checked' : '' }} required>
                                    <label for="htn_yes" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> Sí</label>
                                </div>
                                <div>
                                    <input type="radio" id="htn_no" name="htn" value="0" {{ old('htn') === '0' ? 'checked' : '' }}>
                                    <label for="htn_no" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> No</label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                                <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-black flex items-center justify-center flex-shrink-0">4</span>
                                ¿Le han detectado alguna vez <strong class="mx-1 text-indigo-700">niveles elevados de glucosa</strong> en sangre?
                            </legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div>
                                    <input type="radio" id="glu_yes" name="glu" value="5" {{ old('glu') === '5' ? 'checked' : '' }} required>
                                    <label for="glu_yes" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> Sí</label>
                                </div>
                                <div>
                                    <input type="radio" id="glu_no" name="glu" value="0" {{ old('glu') === '0' ? 'checked' : '' }}>
                                    <label for="glu_no" class="justify-center text-sm font-medium text-slate-700"><span class="radio-dot"></span> No</label>
                                </div>
                            </div>
                        </fieldset>

                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                                <span class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs font-black flex items-center justify-center flex-shrink-0">5</span>
                                ¿Tiene <strong class="mx-1 text-indigo-700">antecedentes familiares</strong> de diabetes mellitus?
                            </label>
                            <select name="fam" required class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium focus:border-blue-500 focus:ring-blue-200 focus:ring-2 outline-none bg-white appearance-none cursor-pointer">
                                <option value="0" {{ old('fam') == '0' ? 'selected' : '' }}>No, ningún familiar con diabetes conocida</option>
                                <option value="3" {{ old('fam') == '3' ? 'selected' : '' }}>Sí — Familiar de 2° grado (abuelos, tíos, primos)</option>
                                <option value="5" {{ old('fam') == '5' ? 'selected' : '' }}>Sí — Familiar de 1° grado (padres, hermanos, hijos)</option>
                            </select>
                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-500 leading-relaxed">
                            <strong class="text-slate-600">📌 Nota académica:</strong> Sus respuestas serán procesadas en el servidor de forma segura. Ningún dato identificable será almacenado. Se generará un código anónimo como referencia de su participación.
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="next(2)" class="flex-none bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-3.5 rounded-xl font-semibold text-sm transition">← Atrás</button>
                            <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 active:scale-[.98] text-white py-3.5 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Calcular Mi Riesgo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ======================== STEP 4: RESULTADOS ======================== -->
                @if(session('result'))
                    @php
                        $score     = session('result')['score'];
                        $risk      = session('result')['risk_level'];
                        $uuid      = session('result')['uuid'];
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

                    <div class="step" id="s4">
                        <!-- Header -->
                        <div class="bg-gradient-to-br {{ $headerGradient }} px-8 py-6 text-white relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 80% 20%, white 1px, transparent 1px); background-size: 24px 24px;"></div>
                            <div class="flex items-center gap-3 mb-1 relative">
                                <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span class="text-white/70 text-sm font-medium uppercase tracking-widest">Paso 4 de 4 · Evaluación Completada</span>
                            </div>
                            <h2 class="text-2xl font-extrabold relative">Tu Resultado FINDRISC</h2>
                            <p class="text-white/70 text-sm mt-1 relative">Evaluación completada. Resultados procesados en el servidor.</p>
                        </div>

                        <!-- Score area -->
                        <div class="{{ $bgTint }} px-8 py-6 border-b border-slate-100">
                            <div class="flex flex-col md:flex-row md:items-center gap-6">
                                <!-- Score display -->
                                <div class="flex-1">
                                    <p class="text-xs text-slate-500 uppercase font-semibold tracking-widest mb-1">Puntaje Total</p>
                                    <div class="flex items-end gap-3 mb-3">
                                        <p class="text-7xl font-extrabold text-slate-900 leading-none">{{ $score }}</p>
                                        <div class="pb-2">
                                            <p class="text-slate-500 text-sm font-medium">puntos</p>
                                            <p class="text-slate-400 text-xs">sobre 26</p>
                                        </div>
                                    </div>

                                    <!-- Score bar with scale -->
                                    <div class="mb-2">
                                        <div class="w-full bg-white rounded-full h-4 border border-slate-200 relative overflow-hidden">
                                            <div class="{{ $scoreBarColor }} h-4 rounded-full transition-all duration-1000" style="width: {{ $scorePercent }}%"></div>
                                        </div>
                                        <div class="flex justify-between text-[10px] text-slate-400 mt-1 px-0.5">
                                            <span>0</span><span>7</span><span>11</span><span>14</span><span>19</span><span>26</span>
                                        </div>
                                    </div>

                                    <span class="{{ $badgeClass }} inline-block text-sm font-bold px-5 py-2 rounded-xl mt-1">
                                        {{ $risk }}
                                    </span>
                                </div>

                                <!-- Risk table legend -->
                                <div class="flex-shrink-0 bg-white rounded-2xl border border-slate-200 p-4 w-full md:w-56 text-xs shadow-sm">
                                    <p class="text-slate-400 uppercase font-semibold tracking-wider mb-3">Escala de Riesgo</p>
                                    <div class="space-y-1.5">
                                        @foreach([['0–6','Riesgo Bajo','badge-low'],['7–11','Ligeramente Elevado','badge-slight'],['12–14','Moderado','badge-mod'],['15–19','Alto','badge-high'],['≥20','Muy Alto','badge-vhigh']] as [$range, $label, $cls])
                                            <div class="flex items-center justify-between gap-2">
                                                <span class="text-slate-500 font-mono">{{ $range }}</span>
                                                <span class="{{ $cls }} text-[10px] font-bold px-2 py-0.5 rounded-lg">{{ $label }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Code + disclaimer + actions -->
                        <div class="p-8 space-y-5">
                            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                                <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-2">Código de Participante Anónimo</p>
                                <p class="font-mono text-sm text-slate-700 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 break-all">{{ $uuid }}</p>
                                <p class="text-[11px] text-slate-400 mt-2">Guarda este código como referencia de tu participación en el estudio.</p>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm text-blue-800 flex gap-3">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                <p>⚕️ Este resultado es <strong>orientativo</strong> y <strong>no constituye un diagnóstico médico</strong>. Si obtuviste un riesgo moderado o superior, consulta con tu médico para una valoración clínica completa.</p>
                            </div>

                            <a href="/" class="w-full bg-blue-700 hover:bg-blue-800 active:scale-[.98] text-white py-3.5 rounded-xl font-semibold text-sm tracking-wide transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                Llenar Otra Encuesta
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Placeholder vacío para que el JS pueda activar s4 si el servidor redirige aquí --}}
                    <div class="step" id="s4"></div>
                @endif

            </form>
        </div>

        <!-- FOOTER -->
        <footer class="mt-10 text-center text-xs text-slate-400 space-y-1">
            <p class="font-medium text-slate-500">Proyecto Empoderamiento Saludable · Red Mutis</p>
            <p>Investigación de Riesgo Mínimo · Uso exclusivamente académico · © {{ date('Y') }}</p>
            <p>La escala FINDRISC no reemplaza la valoración médica profesional.</p>
        </footer>
    </main>

    <script>
        const TOTAL_STEPS = 4;

        function next(n) {
            if (n === 2 && !document.getElementById("consent").checked) {
                alert("Debe leer y aceptar el consentimiento informado para continuar.");
                return;
            }

            if (n === 3) {
                const age    = document.querySelector('input[name="age"]').value;
                const weight = document.getElementById('weight').value;
                const height = document.getElementById('height').value;
                const waist  = document.getElementById('waist').value;
                if (!age || !weight || !height || !waist) {
                    alert("Por favor complete todos los datos antropométricos antes de continuar.");
                    return;
                }
            }

            document.querySelectorAll(".step").forEach(s => s.classList.remove("active"));
            document.getElementById("s" + n).classList.add("active");
            updateStepIndicators(n);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateStepIndicators(n) {
            for (let i = 1; i <= TOTAL_STEPS; i++) {
                const dot   = document.querySelector(`#step-indicator-${i} .step-dot`);
                const label = document.querySelector(`#step-indicator-${i} .step-label`);
                if (!dot) continue;
                if (i < n) {
                    dot.className   = 'step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold bg-emerald-500 text-white transition-all';
                    dot.innerHTML   = '✓';
                    label.className = 'step-label text-xs font-semibold text-emerald-600 hidden sm:inline transition-all';
                } else if (i === n) {
                    dot.className   = 'step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold bg-blue-700 text-white transition-all';
                    dot.innerHTML   = i;
                    label.className = 'step-label text-xs font-semibold text-blue-700 hidden sm:inline transition-all';
                } else {
                    dot.className   = 'step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold bg-white text-slate-400 border-2 border-slate-200 transition-all';
                    dot.innerHTML   = i;
                    label.className = 'step-label text-xs font-semibold text-slate-400 hidden sm:inline transition-all';
                }
                if (i < TOTAL_STEPS) {
                    const connector = document.getElementById(`connector-${i}`);
                    if (connector) connector.className = i < n
                        ? 'flex-1 h-0.5 bg-emerald-400 rounded-full mx-1 transition-all duration-500'
                        : 'flex-1 h-0.5 bg-slate-200 rounded-full mx-1 transition-all duration-500';
                }
            }
        }

        function calculateBmi() {
            const w   = parseFloat(document.getElementById('weight').value);
            const hCm = parseFloat(document.getElementById('height').value);
            const display = document.getElementById('bmiDisplay');
            if (w && hCm && hCm > 0) {
                const h   = hCm / 100;
                const bmi = w / (h * h);
                document.getElementById('bmiValue').innerText = bmi.toFixed(1);
                let cat = bmi < 18.5 ? 'Bajo peso' : bmi < 25 ? 'Peso normal' : bmi < 30 ? 'Sobrepeso' : bmi < 35 ? 'Obesidad grado I' : bmi < 40 ? 'Obesidad grado II' : 'Obesidad grado III';
                document.getElementById('bmiCategory').innerText = cat;
                display.classList.remove('hidden');
            } else {
                display.classList.add('hidden');
            }
        }

        // Auto-jump to results step (step 4) if server returned a result
        @if(session('result'))
            next(4);
        @elseif($errors->any())
            next({{ $errors->has('act') || $errors->has('food') || $errors->has('htn') || $errors->has('glu') || $errors->has('fam') ? 3 : ($errors->has('age') || $errors->has('weight') || $errors->has('height') || $errors->has('waist') || $errors->has('gender') ? 2 : 1) }});
        @endif
    </script>
</body>
</html>
