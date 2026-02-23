<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador — Red Mutis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        input[type="text"], input[type="password"] {
            transition: border-color .2s, box-shadow .2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
    </style>
</head>
<body class="min-h-screen bg-[#f0f6ff] flex flex-col">

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
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest">Panel de Administración</span>
                </div>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1.5 text-xs text-blue-700 bg-blue-50 border border-blue-200 px-3 py-1 rounded-full font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Acceso Restringido
            </span>
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-blue-50 overflow-hidden">

                <!-- Card header -->
                <div class="bg-gradient-to-br from-blue-700 to-blue-900 px-8 py-8 text-white text-center">
                    <div class="w-14 h-14 bg-white/15 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-extrabold">Iniciar Sesión</h1>
                    <p class="text-blue-200 text-sm mt-1">Acceso exclusivo para administradores</p>
                </div>

                <!-- Form -->
                <div class="p-8">

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-xl p-4 flex gap-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            <p class="text-red-700 text-sm font-medium">{{ $errors->first('user') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Usuario
                            </label>
                            <input
                                type="text"
                                name="user"
                                id="user"
                                value="{{ old('user') }}"
                                placeholder="Nombre de usuario"
                                required
                                autofocus
                                class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium placeholder:text-slate-300 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                Contraseña
                            </label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                required
                                class="w-full border-2 border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm font-medium placeholder:text-slate-300 outline-none"
                            >
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-800 active:scale-[.98] text-white py-3.5 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-blue-100 flex items-center justify-center gap-2 mt-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Ingresar
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-center text-xs text-slate-400 py-6 space-y-1">
        <p class="font-medium text-slate-500">Proyecto Empoderamiento Saludable · Red Mutis</p>
        <p>Panel de administración · Uso exclusivamente interno · © {{ date('Y') }}</p>
    </footer>

</body>
</html>
