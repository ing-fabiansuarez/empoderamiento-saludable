<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación de Riesgo de Diabetes — Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .choice-card input[type="radio"] {
            display: none;
        }

        .choice-card label {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .9rem 1.1rem;
            border-radius: .85rem;
            border: 1.5px solid #dbeafe;
            cursor: pointer;
            background: #f8fafc;
            transition: all .2s;
        }

        .choice-card label:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .choice-card input:checked+label {
            border-color: #1d4ed8;
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
        }

        .choice-card .radio-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #93c5fd;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .choice-card input:checked+label .radio-dot {
            border-color: #1d4ed8;
            background: #1d4ed8;
        }

        .choice-card input:checked+label .radio-dot::after {
            content: '';
            display: block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: white;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            padding: 1.5rem 2rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .35rem;
            flex-shrink: 0;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2.5px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            font-weight: 800;
            color: #94a3b8;
            background: #fff;
            position: relative;
        }

        .step-circle.active {
            border-color: #1d4ed8;
            color: #1d4ed8;
            background: #eff6ff;
            transform: scale(1.12);
        }

        .step-circle.done {
            border-color: #059669;
            background: #059669;
            color: #fff;
        }

        .step-circle.skipped {
            border-color: #94a3b8;
            background: #f1f5f9;
            color: #94a3b8;
            opacity: .5;
        }

        .step-label {
            font-size: .68rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .step-label.active {
            color: #1d4ed8;
        }

        .step-label.done {
            color: #059669;
        }

        .step-connector {
            flex: 1;
            height: 2.5px;
            background: #e2e8f0;
            border-radius: 9px;
            margin: 0 .5rem;
            margin-bottom: 1.2rem;
            overflow: hidden;
            position: relative;
        }

        .step-connector-fill {
            height: 100%;
            transition: width .45s;
            background: linear-gradient(90deg, #1d4ed8, #059669);
        }
    </style>
    @livewireStyles
</head>

<body class="min-h-screen bg-[#f0f6ff]">
    <header class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M4.5 12.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 19.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 5.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-blue-900 text-sm leading-none block">Red Mutis</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">Investigación en Salud
                        Metabólica</span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-extrabold text-blue-950 leading-tight mb-2">Evaluación de Riesgo de
                Diabetes</h1>{{-- 
            <p class="text-slate-500 text-sm max-w-lg">Complete el test anónimo para estimar su riesgo de desarrollar
                diabetes tipo 2.</p> --}}
        </div>

        <livewire:survey-form />

        <footer class="mt-10 text-center text-xs text-slate-400 space-y-1">
            <p class="font-medium text-slate-500">Proyecto Empoderamiento Saludable · Red Mutis</p>
            <p>© {{ date('Y') }} · Investigación de Riesgo Mínimo</p>
        </footer>
    </main>

    @livewireScripts
</body>

</html>
