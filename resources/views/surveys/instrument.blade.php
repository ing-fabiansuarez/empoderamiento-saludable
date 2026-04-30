<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumento de Necesidades — Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @livewireStyles
</head>

<body class="min-h-screen bg-[#f0f6ff]">
    <header class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="w-8 h-8 rounded-lg bg-teal-700 flex items-center justify-center hover:bg-teal-800 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>
                <div>
                    <span class="font-bold text-blue-900 text-sm leading-none block">Red Mutis</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">Investigación en Salud Metabólica</span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-extrabold text-blue-950 leading-tight mb-2">Instrumento de Elicitación de Necesidades</h1>
        </div>

        <livewire:needs-instrument-form />

        <footer class="mt-10 text-center text-xs text-slate-400 space-y-1">
            <p class="font-medium text-slate-500">Proyecto Empoderamiento Saludable · Red Mutis</p>
            <p>© {{ date('Y') }} · Investigación de Riesgo Mínimo</p>
        </footer>
    </main>

    @livewireScripts
</body>
</html>
