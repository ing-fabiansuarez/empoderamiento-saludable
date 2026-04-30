<div class="flex-1 w-full max-w-7xl mx-auto px-4 py-8 flex items-start relative transition-all duration-300">

    <!-- SIDEBAR COLAPSABLE -->
    <div class="{{ $isSidebarOpen ? 'w-72 opacity-100 mr-6' : 'w-0 opacity-0 mr-0 overflow-hidden' }} transition-all duration-300 ease-in-out flex-shrink-0 bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-blue-50 relative">
        <div class="p-6">
            <h2 class="text-lg font-bold text-blue-950 mb-6 flex items-center gap-2 border-b border-blue-50 pb-4">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filtros
            </h2>

            <!-- Tipo de Encuesta -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Fuente de Datos</label>
                <div class="space-y-2">
                    <label class="flex items-start gap-3 p-3 rounded-xl border {{ $surveyType == 1 ? 'border-blue-500 bg-blue-50' : 'border-slate-200 cursor-pointer hover:bg-slate-50' }} transition-colors">
                        <input type="radio" wire:model.live="surveyType" value="1" class="mt-0.5 w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Encuesta 1</p>
                            <p class="text-xs text-slate-500">Consentimiento / FINDRISC</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-3 rounded-xl border {{ $surveyType == 2 ? 'border-blue-500 bg-blue-50' : 'border-slate-200 cursor-pointer hover:bg-slate-50' }} transition-colors">
                        <input type="radio" wire:model.live="surveyType" value="2" class="mt-0.5 w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Encuesta 2</p>
                            <p class="text-xs text-slate-500">Instrumento de Necesidades</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Orden -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Orden</label>
                <select wire:model.live="sortOrder" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="desc">Más Recientes Primero</option>
                    <option value="asc">Más Antiguos Primero</option>
                </select>
            </div>

            <!-- Nivel de Riesgo -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Nivel de Riesgo</label>
                <select wire:model.live="riskFilter" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Todos los niveles</option>
                    <option value="Bajo">Bajo</option>
                    <option value="Moderado">Moderado</option>
                    <option value="Ligeramente">Ligeramente elevado</option>
                    <option value="Alto">Alto</option>
                </select>
            </div>
            
            <button wire:click="toggleSidebar" class="w-full flex items-center justify-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-semibold py-2 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors mt-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                Ocultar panel
            </button>
        </div>
    </div>

    <!-- BOTON FLOTANTE PARA MOSTRAR SIDEBAR -->
    @if(!$isSidebarOpen)
        <button wire:click="toggleSidebar" class="absolute left-0 top-20 bg-white border border-blue-100 shadow-md p-2 rounded-r-xl text-blue-600 hover:bg-blue-50 transition-colors z-20" title="Mostrar Filtros">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
        </button>
    @endif

    <!-- CONTENIDO PRINCIPAL (TABLA) -->
    <div class="flex-1 w-full min-w-0 transition-all duration-300">
        <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-950 leading-tight mb-2">Panel de Control</h1>
                <p class="text-slate-500 text-sm">Gestión e informes de la plataforma Empoderamiento Saludable.</p>
            </div>
            
            <button wire:click="exportToExcel" wire:loading.attr="disabled" class="inline-flex bg-emerald-600 hover:bg-emerald-700 active:scale-[.98] disabled:opacity-50 disabled:cursor-not-allowed text-white py-2.5 px-6 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-emerald-200 items-center justify-center gap-2">
                <svg wire:loading.remove wire:target="exportToExcel" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <svg wire:loading wire:target="exportToExcel" class="animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="exportToExcel">Exportar a Excel</span>
                <span wire:loading wire:target="exportToExcel">Exportando...</span>
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl p-4 flex gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                <p class="text-emerald-800 font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-blue-50 overflow-hidden flex flex-col relative">
            <div wire:loading class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center">
                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            
            <div class="bg-gradient-to-br from-blue-700 to-blue-900 px-6 py-5 text-white flex items-center justify-between border-b border-blue-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">Respuestas de Encuestas</h2>
                        <p class="text-blue-200 text-xs">
                            {{ $surveyType == 1 ? 'Listado de evaluaciones FINDRISC registradas' : 'Listado del Instrumento de Necesidades' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 bg-blue-800/50 p-1.5 rounded-lg border border-blue-700/50">
                    <label for="per_page" class="text-xs font-medium text-blue-100 ml-2">Mostrar:</label>
                    <select wire:model.live="perPage" id="per_page" class="bg-white border-0 rounded-md px-2 py-1 text-sm text-slate-700 focus:ring-2 focus:ring-blue-400 outline-none cursor-pointer">
                        @foreach([5, 10, 15, 20, 25, 30, 40, 50] as $opt)
                            <option value="{{ $opt }}">{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">ID / Fecha</th>
                            
                            @if($surveyType == 1)
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Participante</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Contacto</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Puntaje</th>
                            @else
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">UUID</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Barrera Ppal</th>
                            @endif

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Riesgo</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($surveys as $survey)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-slate-800 text-sm">#{{ $survey->id }}</div>
                                    <div class="text-xs text-slate-400">{{ $survey->created_at->format('d/m/Y H:i') }}</div>
                                </td>
                                
                                @if($surveyType == 1)
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-slate-800 text-sm">{{ $survey->names }} {{ $survey->surnames }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $survey->mail }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">{{ $survey->score }}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-mono">{{ Str::limit($survey->uuid, 12) }}...</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $survey->role }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 max-w-xs truncate" title="{{ $survey->barrier_other ?? $survey->barrier }}">
                                        {{ $survey->barrier_other ?? $survey->barrier }}
                                    </td>
                                @endif

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
                                    <button wire:click="destroyRecord({{ $survey->id }})" wire:confirm="¿Seguro que deseas eliminar este registro?" class="font-bold text-slate-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Eliminar registro">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-slate-500 text-sm">
                                    No hay resultados que coincidan con los filtros aplicados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($surveys->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                    {{ $surveys->links('livewire::tailwind') }}
                </div>
            @endif
        </div>
    </div>
</div>
