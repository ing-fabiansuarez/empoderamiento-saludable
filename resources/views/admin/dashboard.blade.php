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
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-blue-950 leading-tight mb-2">Panel de Control</h1>
            <p class="text-slate-500 text-sm">Gestión e informes de la plataforma Empoweramiento Saludable.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Export Card -->
            <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-blue-50 overflow-hidden flex flex-col">
                <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 px-6 py-5 text-white flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">Base de Datos</h2>
                        <p class="text-emerald-100 text-xs">Datos de encuestas FINDRISC</p>
                    </div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-sm text-slate-600 mb-6 flex-1 leading-relaxed">
                        Descarga el consolidado completo de encuestas registradas por los usuarios. El archivo incluye identificadores, medidas antropométricas y resultados del score.
                    </p>

                    <a href="{{ route('admin.export') }}" class="w-full bg-emerald-600 hover:bg-emerald-700 active:scale-[.98] text-white py-3.5 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Exportar a Excel (.xlsx)
                    </a>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-center text-xs text-slate-400 py-6">
        <p>Proyecto Empoderamiento Saludable · Red Mutis · © {{ date('Y') }}</p>
    </footer>

</body>
</html>
