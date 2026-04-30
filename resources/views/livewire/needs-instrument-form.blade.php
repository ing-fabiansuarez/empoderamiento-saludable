<div>
    <div class="bg-white rounded-3xl shadow-xl border border-teal-50 overflow-hidden">
        <div class="bg-gradient-to-br from-teal-600 to-teal-800 px-8 py-6 text-white">
            <h2 class="text-xl font-bold">Instrumento de Elicitación de Necesidades de Stakeholders</h2>
            <p class="text-teal-200 text-sm mt-1">Proyecto: Empoderamiento Saludable (Red Mutis)</p>
        </div>

        <div class="p-8">
            @if($successMessage)
                <div class="bg-teal-50 border border-teal-200 rounded-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-teal-900 mb-2">¡Información Guardada!</h3>
                    <p class="text-teal-700 mb-6">Gracias por completar el Instrumento de Elicitación de Necesidades. Su participación es vital para definir el concepto de operaciones y evitar la "Trampa de los Indicadores".</p>
                    <a href="{{ route('home') }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-lg">
                        Volver al Inicio
                    </a>
                </div>
            @else
                <form wire:submit.prevent="save" class="space-y-8">
                    <p class="text-sm text-slate-500 mb-6 bg-slate-50 p-4 rounded-lg border border-slate-100">
                        <strong>Estándar de Referencia:</strong> INCOSE-TP-2021-002-01 (Guide to Needs and Requirements)<br>
                        <strong>Objetivo:</strong> Capturar las necesidades reales, miedos y expectativas de los participantes para definir el Concepto de Operaciones (ConOps) y evitar la "Trampa de los Indicadores".
                    </p>

                    <!-- SECCIÓN 1 -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-300 pb-2 mb-4">1. Identificación del Stakeholder y Perfil de Usuario</h3>
                        <p class="text-sm text-slate-500 mb-6">Este bloque permite entender la "Línea Base" del sistema humano.</p>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">ID Único (Anonimizado) <span class="text-red-500">*</span></label>
                                <p class="text-xs text-slate-500 mb-2">Ingrese el código que recibió en su correo al finalizar la encuesta inicial (FINDRISC).</p>
                                <input type="text" id="uuid-input" wire:model.live.debounce.500ms="uuid" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 font-mono" placeholder="Ej: 123e4567-e89b-12d3-a456-426614174000">
                                @if($isAlreadySubmitted)
                                    <div class="mt-2 p-3 bg-amber-50 border border-amber-200 text-amber-800 rounded-lg text-sm flex items-start gap-2">
                                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        <div class="w-full">
                                            <p class="mb-2">Este ID Único ya ha completado la encuesta. Los campos han sido deshabilitados.</p>
                                            <button type="button" wire:click="resendEmail" wire:loading.attr="disabled" wire:target="resendEmail" class="text-sm font-bold bg-amber-600 hover:bg-amber-700 active:scale-[.98] transition-all text-white py-1.5 px-4 rounded-lg shadow-sm disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                                                <svg wire:loading.remove wire:target="resendEmail" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <svg wire:loading wire:target="resendEmail" class="animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span wire:loading.remove wire:target="resendEmail">Reenviar Correo</span>
                                                <span wire:loading wire:target="resendEmail">En proceso de envío...</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @if (session()->has('resend_success'))
                                        <div class="mt-2 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg text-sm flex items-center gap-2" role="alert">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                            <span class="block sm:inline">{{ session('resend_success') }}</span>
                                        </div>
                                    @endif
                                @endif
                                
                                @error('uuid') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                                @error('rate_limit') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Rol en el Sistema <span class="text-red-500">*</span></label>
                                <select wire:model="role" @disabled($isAlreadySubmitted) class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 disabled:bg-slate-100 disabled:text-slate-500">
                                    <option value="">Seleccione su rol...</option>
                                    <option value="Estudiante">Estudiante</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Docente">Docente</option>
                                </select>
                                @error('role') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nivel de Riesgo (Resultado FINDRISC) <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model="risk_level" value="Bajo" @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm font-medium text-slate-700">Bajo</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model="risk_level" value="Moderado" @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm font-medium text-slate-700">Moderado</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model="risk_level" value="Alto" @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm font-medium text-slate-700">Alto</span>
                                    </label>
                                </div>
                                @error('risk_level') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Barrera Principal Identificada <span class="text-red-500">*</span></label>
                                <p class="text-xs text-slate-500 mb-3">¿Qué es lo que más le dificulta hoy mantener un hábito saludable en el campus?</p>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model.live="barrier" value="Falta de tiempo." @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm text-slate-700">Falta de tiempo.</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model.live="barrier" value="Oferta alimenticia limitada." @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm text-slate-700">Oferta alimenticia limitada.</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model.live="barrier" value="Olvido / Falta de recordatorios." @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm text-slate-700">Olvido / Falta de recordatorios.</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model.live="barrier" value="Falta de motivación social." @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm text-slate-700">Falta de motivación social.</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl {{ $isAlreadySubmitted ? 'opacity-50 cursor-not-allowed bg-slate-100' : 'cursor-pointer hover:bg-slate-100' }} transition-colors">
                                        <input type="radio" wire:model.live="barrier" value="Otro" @disabled($isAlreadySubmitted) class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                                        <span class="text-sm text-slate-700">Otro</span>
                                    </label>
                                </div>
                                @error('barrier') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror

                                @if($barrier === 'Otro')
                                <div class="mt-3 pl-8">
                                    <input type="text" wire:model="barrier_other" @disabled($isAlreadySubmitted) class="w-full px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm disabled:bg-slate-100 disabled:text-slate-500" placeholder="Especifique su barrera principal...">
                                    @error('barrier_other') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2 -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-300 pb-2 mb-4">2. Definición del Problema y "Gap" de Conciencia</h3>
                        <p class="text-sm text-slate-500 mb-6">Basado en el Paper "The Indicator Trap". Buscamos que el usuario identifique el territorio, no solo el mapa.</p>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Percepción vs. Realidad <span class="text-red-500">*</span></label>
                                <p class="text-xs text-slate-500 mb-4">En una escala de 1 a 10, ¿qué tan saludable cree que es su estilo de vida actual?</p>
                                <div class="flex items-center gap-4 {{ $isAlreadySubmitted ? 'opacity-50' : '' }}">
                                    <span class="text-xs font-bold text-slate-400">1 (Nada)</span>
                                    <input type="range" wire:model.live="perception_vs_reality" min="1" max="10" @disabled($isAlreadySubmitted) class="w-full h-2 bg-slate-200 rounded-lg appearance-none accent-teal-600 {{ $isAlreadySubmitted ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                                    <span class="text-xs font-bold text-slate-400">10 (Muy)</span>
                                </div>
                                <div class="text-center mt-2">
                                    <span class="inline-block bg-teal-100 text-teal-800 text-lg font-bold px-3 py-1 rounded-lg {{ $isAlreadySubmitted ? 'opacity-50' : '' }}">{{ $perception_vs_reality }}</span>
                                </div>
                                @error('perception_vs_reality') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">El "Bucle" de Fallo <span class="text-red-500">*</span></label>
                                <p class="text-xs text-slate-500 mb-2">Describa una situación reciente donde intentó mejorar un hábito y falló. ¿Qué información le faltó en ese momento preciso para no abandonar? (Apunta a LP6: Flujos de Información).</p>
                                <textarea wire:model="failure_loop" rows="4" @disabled($isAlreadySubmitted) class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm disabled:bg-slate-100 disabled:text-slate-500" placeholder="Ej: Intenté comer más ensalada la semana pasada, pero al medio día..."></textarea>
                                @error('failure_loop') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3 -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 border-b border-slate-300 pb-2 mb-4">3. Elicitación de Necesidades (Script: Hopes & Fears)</h3>
                        <p class="text-sm text-slate-500 mb-6">Este es el corazón del diseño participativo según INCOSE.</p>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Esperanzas (Hopes) <span class="text-red-500">*</span></label>
                            <p class="text-xs text-slate-500 mb-1">Si esta aplicación fuera un "aliado" perfecto en su salud, ¿qué transformación específica lograría en su rutina diaria en 3 meses?</p>
                            <p class="text-xs font-medium text-teal-600 mb-3">Instrucción: No mencione botones o colores, describa resultados.</p>
                            <textarea wire:model="hopes" rows="4" @disabled($isAlreadySubmitted) class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm disabled:bg-slate-100 disabled:text-slate-500" placeholder="Ej: Lograría que mi nivel de energía no cayera después del almuerzo, sintiéndome activo en mis clases de la tarde..."></textarea>
                            @error('hopes') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="pt-4 border-t border-slate-200 flex justify-end gap-4">
                        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50 transition-colors">Cancelar</a>
                        <button type="submit" @disabled($isAlreadySubmitted) wire:loading.attr="disabled" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-lg flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="save">Enviar Respuestas</span>
                            <span wire:loading wire:target="save">Enviando...</span>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    @script
    <script>
        $wire.on('focus-uuid', () => {
            const uuidInput = document.getElementById('uuid-input');
            if (uuidInput) {
                uuidInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                uuidInput.focus();
            }
        });
    </script>
    @endscript
</div>
