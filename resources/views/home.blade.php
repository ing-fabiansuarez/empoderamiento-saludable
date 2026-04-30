<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio — Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .card-btn {
            transition: all 0.3s ease;
        }
        .card-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="min-h-screen bg-[#f0f6ff]">
    <header class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4.5 12.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 19.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 5.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-blue-900 text-sm leading-none block">Red Mutis</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">Investigación en Salud Metabólica</span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-16">
        <div class="mb-12 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-blue-950 leading-tight mb-4">Proyecto Empoderamiento Saludable</h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto">Seleccione la sección a la que desea ingresar para continuar con su proceso de participación.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <!-- Botón Izquierdo -->
            <a href="{{ route('surveys.findrisc') }}" class="card-btn bg-white rounded-3xl shadow-lg border border-blue-100 overflow-hidden flex flex-col group">
                <div class="bg-gradient-to-br from-blue-700 to-blue-900 p-6 flex justify-center items-center">
                    <svg class="w-16 h-16 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="p-8 text-center flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-blue-700 transition-colors">1. Consentimiento Informado</h2>
                        <p class="text-slate-500 text-sm">Encuesta inicial (FINDRISC). Debe completarse antes de continuar a la siguiente sección.</p>
                    </div>
                    <div class="mt-6">
                        <span class="inline-block bg-blue-50 text-blue-700 font-semibold px-4 py-2 rounded-lg text-sm group-hover:bg-blue-600 group-hover:text-white transition-colors">Comenzar</span>
                    </div>
                </div>
            </a>

            <!-- Botón Derecho -->
            <a href="{{ route('surveys.instrument') }}" class="card-btn bg-white rounded-3xl shadow-lg border border-blue-100 overflow-hidden flex flex-col group">
                <div class="bg-gradient-to-br from-teal-600 to-teal-800 p-6 flex justify-center items-center">
                    <svg class="w-16 h-16 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div class="p-8 text-center flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-teal-700 transition-colors">2. Instrumento de Necesidades</h2>
                        <p class="text-slate-500 text-sm">Instrumento de Elicitación de Necesidades de Stakeholders. Requiere haber completado el paso 1.</p>
                    </div>
                    <div class="mt-6">
                        <span class="inline-block bg-teal-50 text-teal-700 font-semibold px-4 py-2 rounded-lg text-sm group-hover:bg-teal-600 group-hover:text-white transition-colors">Comenzar</span>
                    </div>
                </div>
            </a>
        </div>

        <footer class="mt-16 text-center text-xs text-slate-400 space-y-1">
            <p class="font-medium text-slate-500">Proyecto Empoderamiento Saludable · Red Mutis</p>
            <p>© {{ date('Y') }} · Investigación de Riesgo Mínimo</p>
        </footer>
    </main>
</body>
</html>
