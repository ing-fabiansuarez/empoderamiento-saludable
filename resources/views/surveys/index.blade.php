<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empoderamiento Saludable - Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .step { display: none; animation: fade .3s ease; }
        .step.active { display: block; }
        @keyframes fade { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .card { background: #fff; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,.08); }
        .progress { transition: width .4s ease; }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-slate-100 min-h-screen py-10 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-indigo-900">Proyecto Empoderamiento Saludable</h1>
            <p class="text-slate-500 text-sm">Red Mutis — Investigación de Riesgo Mínimo</p>
        </div>

        @if(session('result'))
            <div class="mb-8 bg-white rounded-2xl p-8 text-center shadow-xl border-t-4 border-indigo-600 animate-bounce">
                <h3 class="text-xl font-bold text-indigo-900 mb-2">Resultado FINDRISC</h3>
                <p class="text-2xl font-bold text-indigo-700 mb-1">{{ session('result')['score'] }} Puntos</p>
                <p class="text-lg font-semibold text-slate-800 mb-4">{{ session('result')['risk_level'] }}</p>
                <div class="bg-indigo-50 p-4 rounded-xl text-sm text-slate-600 mb-4">
                    <p><strong>Código de Seguimiento Anónimo:</strong> {{ session('result')['uuid'] }}</p>
                    <p class="mt-2 text-xs italic">Resultado orientativo. No constituye diagnóstico médico.</p>
                </div>
                <button onclick="window.location.href='/'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl font-semibold transition">Nueva Encuesta</button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl">
                <p class="text-red-700 font-bold mb-2">Por favor corrige los siguientes errores:</p>
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-full bg-slate-200 h-3 rounded-full mb-8">
            <div id="bar" class="progress bg-indigo-600 h-3 rounded-full" style="width:33.33%"></div>
        </div>

        <div class="card p-8">
            <form id="findriscForm" action="{{ route('surveys.store') }}" method="POST">
                @csrf

                <!-- STEP 1: CONSENTIMIENTO -->
                <div class="step active" id="s1">
                    <h2 class="text-xl font-semibold text-indigo-900 mb-4">Consentimiento Informado</h2>
                    <div class="bg-indigo-50 p-6 rounded-xl text-sm text-slate-700 leading-relaxed h-80 overflow-y-auto mb-6 border space-y-3">
                        <p><strong>Marco Normativo:</strong> Declaración de Helsinki (1964, rev. 2002), Resolución 008430 de 1993 (Riesgo Mínimo) y Ley 1581 de 2012.</p>
                        <p><strong>Objetivo:</strong> Evaluar riesgo metabólico mediante FINDRISC y analizar estrategias digitales de empoderamiento saludable.</p>
                        <p><strong>Procedimiento:</strong> Registro de peso, talla, perímetro abdominal y aplicación de FINDRISC completo. Sin exámenes clínicos.</p>
                        <p><strong>Duración:</strong> 8–12 minutos.</p>
                        <p><strong>Riesgos:</strong> Riesgo mínimo; posible incomodidad leve al responder preguntas.</p>
                        <p><strong>Beneficios:</strong> Estimación orientativa de riesgo y contribución científica.</p>
                        <p><strong>No diagnóstico:</strong> El resultado no reemplaza valoración médica.</p>
                        <p><strong>Confidencialidad:</strong> Código anónimo automático; datos protegidos y uso exclusivamente académico.</p>
                        <p><strong>No explotación comercial.</strong></p>
                        <p><strong>Voluntariedad:</strong> Puede retirarse en cualquier momento sin consecuencias.</p>
                    </div>
                    <label class="flex items-center space-x-3 mb-6 cursor-pointer">
                        <input type="checkbox" id="consent" class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-slate-700">He leído y acepto participar voluntariamente.</span>
                    </label>
                    <button type="button" onclick="next(2)" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transform transition hover:scale-[1.02]">Continuar</button>
                </div>

                <!-- STEP 2: DATOS -->
                <div class="step" id="s2">
                    <h2 class="text-xl font-semibold text-indigo-900 mb-6">Datos Antropométricos</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-slate-600">Sexo</label>
                            <select name="gender" id="gender" class="w-full border-slate-200 bg-slate-50 p-3 rounded-xl mt-1 focus:ring-2 focus:ring-indigo-500 transition outline-none">
                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Hombre</option>
                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Mujer</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-600">Edad</label>
                            <input type="number" name="age" id="age" min="18" max="100" value="{{ old('age') }}" required class="w-full border-slate-200 bg-slate-50 p-3 rounded-xl mt-1 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-600">Peso (kg)</label>
                            <input type="number" name="weight" id="weight" min="30" max="250" step="0.1" value="{{ old('weight') }}" required class="w-full border-slate-200 bg-slate-50 p-3 rounded-xl mt-1 focus:ring-2 focus:ring-indigo-500 outline-none transition" oninput="calculateBmi()">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-600">Estatura (cm)</label>
                            <input type="number" name="height" id="height" min="120" max="220" value="{{ old('height') }}" required class="w-full border-slate-200 bg-slate-50 p-3 rounded-xl mt-1 focus:ring-2 focus:ring-indigo-500 outline-none transition" oninput="calculateBmi()">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-600">Perímetro de Cintura (cm)</label>
                            <input type="number" name="waist" id="waist" min="40" max="200" value="{{ old('waist') }}" required class="w-full border-slate-200 bg-slate-50 p-3 rounded-xl mt-1 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                    </div>
                    <div id="bmiTxt" class="mt-4 text-indigo-700 text-sm font-bold bg-indigo-50 p-3 rounded-lg hidden"></div>
                    
                    <div class="flex gap-4 mt-8">
                        <button type="button" onclick="next(1)" class="w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-600 py-3 rounded-xl font-semibold transition">Atrás</button>
                        <button type="button" onclick="next(3)" class="w-2/3 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transform transition hover:scale-[1.02]">Continuar</button>
                    </div>
                </div>

                <!-- STEP 3: FINDRISC -->
                <div class="step" id="s3">
                    <h2 class="text-xl font-semibold text-indigo-900 mb-6">Hábitos y Antecedentes (FINDRISC)</h2>
                    <div class="space-y-4 text-sm">
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="font-semibold text-indigo-900 mb-2">¿Realiza habitualmente al menos 30 min de actividad física?</p>
                            <div class="space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="act" value="0" {{ old('act') === '0' ? 'checked' : '' }} required class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">Sí</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="act" value="2" {{ old('act') === '2' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="font-semibold text-indigo-900 mb-2">¿Con qué frecuencia consume frutas, verduras o hortalizas?</p>
                            <div class="space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="food" value="0" {{ old('food') === '0' ? 'checked' : '' }} required class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">A diario</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="food" value="1" {{ old('food') === '1' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">No a diario</span>
                                </label>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="font-semibold text-indigo-900 mb-2">¿Toma medicación para la hipertensión regularmente?</p>
                            <div class="space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="htn" value="2" {{ old('htn') === '2' ? 'checked' : '' }} required class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">Sí</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="htn" value="0" {{ old('htn') === '0' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="font-semibold text-indigo-900 mb-2">¿Le han encontrado alguna vez valores de glucosa altos?</p>
                            <div class="space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="glu" value="5" {{ old('glu') === '5' ? 'checked' : '' }} required class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">Sí</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="glu" value="0" {{ old('glu') === '0' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="font-semibold text-indigo-900 mb-2">¿Algún miembro de su familia ha sido diagnosticado con diabetes?</p>
                            <select name="fam" required class="w-full border-slate-200 bg-white p-3 rounded-xl mt-1 outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="0" {{ old('fam') == '0' ? 'selected' : '' }}>No</option>
                                <option value="3" {{ old('fam') == '3' ? 'selected' : '' }}>Sí: abuelos, tíos, primos (2do grado)</option>
                                <option value="5" {{ old('fam') == '5' ? 'selected' : '' }}>Sí: padres, hermanos, hijos (1er grado)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="button" onclick="next(2)" class="w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-600 py-3 rounded-xl font-semibold transition">Atrás</button>
                        <button type="submit" class="w-2/3 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold transform transition hover:scale-[1.02] shadow-lg shadow-green-200">CALCULAR RIESGO</button>
                    </div>
                </div>
            </form>
        </div>
        
        <p class="text-center mt-8 text-slate-400 text-xs">
            &copy; {{ date('Y') }} Red Mutis - Proyecto de Investigación de Salud Metabólica
        </p>
    </div>

    <script>
        function next(n) {
            if (n === 2 && !document.getElementById("consent").checked) {
                alert("Debe leer y aceptar el consentimiento informado para continuar.");
                return;
            }
            
            // Basic validation for step 2 before moving to 3
            if (n === 3) {
                const age = document.getElementById('age').value;
                const weight = document.getElementById('weight').value;
                const height = document.getElementById('height').value;
                const waist = document.getElementById('waist').value;
                
                if (!age || !weight || !height || !waist) {
                    alert("Por favor complete todos los datos antropométricos.");
                    return;
                }
            }

            document.querySelectorAll(".step").forEach(s => s.classList.remove("active"));
            document.getElementById("s" + n).classList.add("active");
            
            const progress = (n / 3) * 100;
            document.getElementById("bar").style.width = progress + "%";
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function calculateBmi() {
            const w = parseFloat(document.getElementById('weight').value);
            const h = parseFloat(document.getElementById('height').value) / 100;
            const bmiDisplay = document.getElementById("bmiTxt");

            if (w && h && h > 0) {
                const bmi = (w / (h * h)).toFixed(1);
                bmiDisplay.innerText = "Tu IMC estimado es: " + bmi;
                bmiDisplay.classList.remove("hidden");
            } else {
                bmiDisplay.classList.add("hidden");
            }
        }
    </script>
</body>
</html>
