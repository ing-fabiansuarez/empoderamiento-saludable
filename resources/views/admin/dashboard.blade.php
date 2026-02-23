<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Red Mutis Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-[#f0f6ff] flex flex-col">

    <header class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 19.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3M4.5 5.5c.375-1 1.875-3 3.75-3s3.75 3 5.25 3 3.375-2 3.75-3" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-blue-900 text-sm leading-none block">Red Mutis</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">Panel de Administración</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-500">Bienvenido, <strong class="text-slate-700">{{ session('admin_user') }}</strong></span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-xs bg-slate-100 hover:bg-red-50 hover:text-red-600 border border-slate-200 hover:border-red-200 text-slate-600 px-4 py-2 rounded-lg font-semibold transition-all flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-10">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-950 leading-tight mb-2">Panel de Control</h1>
                <p class="text-slate-500 text-sm">Gestión e informes de la plataforma Empoderamiento Saludable.</p>
            </div>
            
            <a href="{{ route('admin.export') }}" class="inline-flex bg-emerald-600 hover:bg-emerald-700 active:scale-[.98] text-white py-2.5 px-6 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-emerald-200 items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Exportar a Excel
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl p-4 flex gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                <p class="text-emerald-800 font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-blue-50 overflow-hidden flex flex-col mb-6">
            <div class="bg-gradient-to-br from-blue-700 to-blue-900 px-6 py-5 text-white flex items-center justify-between border-b border-blue-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">Respuestas de Encuestas</h2>
                        <p class="text-blue-200 text-xs">Listado de evaluaciones FINDRISC registradas</p>
                    </div>
                </div>

                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-blue-800/50 p-1.5 rounded-lg border border-blue-700/50">
                    <label for="per_page" class="text-xs font-medium text-blue-100 ml-2">Mostrar:</label>
                    <select name="per_page" id="per_page" onchange="this.form.submit()" class="bg-white border-0 rounded-md px-2 py-1 text-sm text-slate-700 focus:ring-2 focus:ring-blue-400 outline-none cursor-pointer">
                        @foreach([5, 10, 15, 20, 25, 30, 40, 50] as $opt)
                            <option value="{{ $opt }}" {{ $perPage == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Participante</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Contacto</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Puntaje</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Riesgo</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($surveys as $survey)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">#{{ $survey->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-slate-800 text-sm">{{ $survey->names }} {{ $survey->surnames }}</div>
                                    <div class="text-xs text-slate-400">{{ $survey->created_at->format('d/m/Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $survey->mail }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">{{ $survey->score }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                                        @if($survey->risk_level === 'Bajo' || str_contains(strtolower($survey->risk_level), 'bajo')) bg-emerald-100 text-emerald-700
                                        @elseif($survey->risk_level === 'Ligeramente elevado' || str_contains(strtolower($survey->risk_level), 'ligeramente')) bg-yellow-100 text-yellow-700
                                        @elseif($survey->risk_level === 'Moderado' || str_contains(strtolower($survey->risk_level), 'moderado')) bg-orange-100 text-orange-700
                                        @elseif(str_contains(strtolower($survey->risk_level), 'alto')) bg-red-100 text-red-700
                                        @else bg-slate-100 text-slate-700 @endif
                                    ">
                                        {{ $survey->risk_level }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('admin.surveys.destroy', $survey->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-bold text-slate-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Eliminar registro">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-slate-500 text-sm">
                                    No hay encuestas registradas todavía.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($surveys->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                    {{ $surveys->appends(['per_page' => $perPage])->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </main>

    <footer class="text-center text-xs text-slate-400 py-6">
        <p>Proyecto Empoderamiento Saludable · Red Mutis · © {{ date('Y') }}</p>
    </footer>

</body>
</html>
