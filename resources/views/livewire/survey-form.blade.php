<div>
    <!-- FORM CARD -->
    <div class="bg-white rounded-3xl shadow-xl border border-blue-50 overflow-hidden">
        <!-- STEP INDICATOR -->
        <div class="step-indicator" id="stepIndicator" aria-label="Progreso del formulario">
            <!-- Step 1 -->
            <div class="step-item">
                <div class="step-circle {{ $currentStep >= 1 ? ($currentStep > 1 ? 'done' : 'active') : '' }}">1</div>
                <span
                    class="step-label {{ $currentStep >= 1 ? ($currentStep > 1 ? 'done' : 'active') : '' }}">Consentimiento</span>
            </div>
            <!-- Connector 1→2 -->
            <div class="step-connector">
                <div class="step-connector-fill" style="width: {{ $currentStep > 1 ? '100%' : '0%' }}"></div>
            </div>
            <!-- Step 2 -->
            <div class="step-item">
                <div class="step-circle {{ $currentStep >= 2 ? ($currentStep > 2 ? 'done' : 'active') : '' }}">2</div>
                <span
                    class="step-label {{ $currentStep >= 2 ? ($currentStep > 2 ? 'done' : 'active') : '' }}">Identificación</span>
            </div>
            <!-- Connector 2→3 -->
            <div class="step-connector">
                <div class="step-connector-fill" style="width: {{ $currentStep > 2 ? '100%' : '0%' }}"></div>
            </div>
            <!-- Step 3 -->
            <div class="step-item">
                <div
                    class="step-circle {{ $currentStep === 99 ? 'skipped' : ($currentStep >= 3 ? ($currentStep > 3 ? 'done' : 'active') : '') }}">
                    3</div>
                <span
                    class="step-label {{ $currentStep === 99 ? 'skipped' : ($currentStep >= 3 ? ($currentStep > 3 ? 'done' : 'active') : '') }}">Datos</span>
            </div>
            <!-- Connector 3→4 -->
            <div class="step-connector">
                <div class="step-connector-fill"
                    style="width: {{ $currentStep > 3 && $currentStep != 99 ? '100%' : '0%' }}"></div>
            </div>
            <!-- Step 4 -->
            <div class="step-item">
                <div
                    class="step-circle {{ $currentStep === 99 ? 'skipped' : ($currentStep >= 4 ? ($currentStep === 4 ? 'active' : 'done') : '') }}">
                    4</div>
                <span
                    class="step-label {{ $currentStep === 99 ? 'skipped' : ($currentStep >= 4 ? ($currentStep === 4 ? 'active' : 'done') : '') }}">Hábitos</span>
            </div>
        </div>

        <form wire:submit.prevent="save">
            <!-- CONSENTIMIENTO -->
            @if ($currentStep === 1)
                <section id="step-1" class="border-b border-slate-100">
                    <div class="bg-gradient-to-br from-blue-700 to-blue-900 px-8 py-6 text-white">
                        <div class="flex items-center gap-3 mb-1">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-blue-300 text-sm font-medium uppercase tracking-widest">Sección 1</span>
                        </div>
                        <h2 class="text-xl font-bold">Consentimiento Informado</h2>
                        <p class="text-blue-200 text-sm mt-1">Por favor, lea detenidamente antes de participar.</p>
                    </div>

                    <div class="p-8">
                        <div
                            class="consent-scroll bg-slate-50 rounded-2xl border border-slate-200 p-6 text-sm text-slate-600 leading-7 h-72 overflow-y-auto mb-6 space-y-4">
                            <!-- Consent content same as before -->
                            <div class="flex gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                    §</div>
                                <div><strong class="text-slate-700">Marco Normativo:</strong> El presente estudio se
                                    rige por la Declaración de Helsinki (1964, rev. 2002), la Resolución 008430 de 1993
                                    del Ministerio de Salud de Colombia (Investigación de Riesgo Mínimo) y la Ley 1581
                                    de 2012 de Protección de Datos Personales.</div>
                            </div>
                            <!-- ... rest of consent items ... -->
                            <div class="flex gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                    ✓</div>
                                <div><strong class="text-slate-700">Beneficios:</strong> Recibirá una estimación
                                    orientativa de su riesgo y contribuirá al conocimiento científico en salud pública
                                    colombiana.</div>
                            </div>
                            <div class="flex gap-3">
                                <div
                                    class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                    🔒</div>
                                <div><strong class="text-slate-700">Confidencialidad:</strong> Se le asignará un código
                                    anónimo automático. Sus datos serán protegidos y utilizados exclusivamente con fines
                                    académicos.</div>
                            </div>
                        </div>

                        <label
                            class="flex items-start gap-3 cursor-pointer p-4 rounded-xl border-2 {{ $errors->has('consent') ? 'border-red-300 bg-red-50' : 'border-slate-200 hover:border-blue-400 hover:bg-blue-50' }} transition-all duration-200 mb-6">
                            <input type="checkbox" wire:model="consent"
                                class="mt-0.5 h-5 w-5 rounded accent-blue-700 flex-shrink-0 cursor-pointer">
                            <div>
                                <p class="font-semibold text-slate-800 text-sm">He leído y comprendo el consentimiento
                                    informado</p>
                                <p class="text-xs text-slate-400 mt-0.5">Acepto participar voluntariamente en este
                                    estudio de investigación.</p>
                                @error('consent')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </label>

                        <div class="flex justify-end">
                            <button type="button" wire:click="nextStep"
                                class="bg-blue-700 hover:bg-blue-800 active:scale-[.98] text-white py-3 px-8 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-blue-100 flex items-center gap-2">
                                Siguiente
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </section>
            @endif

            <!-- IDENTIFICACIÓN -->
            @if ($currentStep === 2)
                <section id="step-2" class="border-b border-slate-100">
                    <div class="bg-gradient-to-br from-violet-700 to-indigo-800 px-8 py-6 text-white">
                        <div class="flex items-center gap-3 mb-1">
                            <svg class="w-5 h-5 text-violet-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-violet-300 text-sm font-medium uppercase tracking-widest">Sección 2</span>
                        </div>
                        <h2 class="text-xl font-bold">Datos del Participante</h2>
                        <p class="text-violet-200 text-sm mt-1">Ingrese su correo y responda la pregunta de
                            pre-diagnóstico.</p>
                    </div>

                    <div class="p-8 space-y-6">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Correo
                                Electrónico</label>
                            <input type="email" wire:model="mail" placeholder="ej. correo@ejemplo.com"
                                class="w-full border-2 {{ $errors->has('mail') ? 'border-red-300' : 'border-slate-200' }} rounded-xl px-4 py-3 text-slate-800 text-sm font-medium outline-none transition-all focus:border-blue-400">
                            @error('mail')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <fieldset>
                            <legend class="block text-sm font-semibold text-slate-700 mb-3">¿Ha sido diagnosticado/a
                                previamente con diabetes mellitus?</legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div>
                                    <input type="radio" id="diab_yes" wire:model="has_diabetes" value="1">
                                    <label for="diab_yes" class="justify-center text-sm font-medium text-slate-700">
                                        <span class="radio-dot"></span> Sí, tengo diagnóstico
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" id="diab_no" wire:model="has_diabetes" value="0">
                                    <label for="diab_no" class="justify-center text-sm font-medium text-slate-700">
                                        <span class="radio-dot"></span> No, no tengo diagnóstico
                                    </label>
                                </div>
                            </div>
                            @error('has_diabetes')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        @if ($has_diabetes == '1')
                            <div class="bg-amber-50 border border-amber-300 rounded-2xl p-5 flex gap-4">
                                <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="font-bold text-amber-800 text-sm">Como ya cuenta con diagnóstico, no es
                                    necesario completar el test FINDRISC.</p>
                            </div>
                        @endif

                        <div class="flex justify-between">
                            <button type="button" wire:click="prevStep"
                                class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-3 rounded-xl font-bold text-sm border">Anterior</button>
                            <button type="button" wire:click="nextStep"
                                class="bg-blue-700 hover:bg-blue-800 text-white py-3 px-8 rounded-xl font-bold text-sm">Siguiente</button>
                        </div>
                    </div>
                </section>
            @endif

            <!-- DATOS ANTROPOMÉTRICOS -->
            @if ($currentStep === 3)
                <section id="step-3" class="border-b border-slate-100">
                    <div class="bg-gradient-to-br from-cyan-700 to-blue-800 px-8 py-6 text-white">
                        <h2 class="text-xl font-bold">Datos Antropométricos</h2>
                        <p class="text-cyan-200 text-sm mt-1">Ingrese sus medidas corporales.</p>
                    </div>

                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-slate-500 mb-2">Sexo Biológico</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label
                                        class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer {{ $gender === 'M' ? 'border-blue-400 bg-blue-50' : 'border-slate-200' }}">
                                        <input type="radio" wire:model.live="gender" value="M"
                                            class="hidden">
                                        <span class="text-sm font-semibold text-slate-700">Hombre</span>
                                    </label>
                                    <label
                                        class="flex items-center gap-3 border-2 rounded-xl px-4 py-3 cursor-pointer {{ $gender === 'F' ? 'border-blue-400 bg-blue-50' : 'border-slate-200' }}">
                                        <input type="radio" wire:model.live="gender" value="F"
                                            class="hidden">
                                        <span class="text-sm font-semibold text-slate-700">Mujer</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-2">Edad (años)</label>
                                <input type="number" wire:model="age"
                                    class="w-full border-2 p-3 rounded-xl {{ $errors->has('age') ? 'border-red-300' : 'border-slate-200' }}">
                                @error('age')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-2">Peso (kg)</label>
                                <input type="number" step="0.1" wire:model="weight"
                                    class="w-full border-2 p-3 rounded-xl {{ $errors->has('weight') ? 'border-red-300' : 'border-slate-200' }}">
                                @error('weight')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-2">Estatura (cm)</label>
                                <input type="number" wire:model="height"
                                    class="w-full border-2 p-3 rounded-xl {{ $errors->has('height') ? 'border-red-300' : 'border-slate-200' }}">
                                @error('height')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-2">Cintura (cm)</label>
                                <input type="number" wire:model="waist"
                                    class="w-full border-2 p-3 rounded-xl {{ $errors->has('waist') ? 'border-red-300' : 'border-slate-200' }}">
                                @error('waist')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" wire:click="prevStep"
                                class="bg-slate-100 px-8 py-3 rounded-xl font-bold text-sm border">Anterior</button>
                            <button type="button" wire:click="nextStep"
                                class="bg-blue-700 text-white px-8 py-3 rounded-xl font-bold text-sm">Siguiente</button>
                        </div>
                    </div>
                </section>
            @endif

            <!-- HÁBITOS -->
            @if ($currentStep === 4)
                <section id="step-4">
                    <div class="bg-gradient-to-br from-indigo-700 to-blue-900 px-8 py-6 text-white">
                        <h2 class="text-xl font-bold">Hábitos y Antecedentes</h2>
                    </div>

                    <div class="p-8 space-y-6">
                        <fieldset>
                            <legend class="text-sm font-semibold text-slate-700 mb-3">¿Actividad física diaria (30
                                min)?</legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div><input type="radio" id="act_yes" wire:model="daily_activity"
                                        value="0"><label for="act_yes"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> Sí</label></div>
                                <div><input type="radio" id="act_no" wire:model="daily_activity"
                                        value="2"><label for="act_no"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> No</label></div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="text-sm font-semibold text-slate-700 mb-3">¿Consume frutas/verduras a
                                diario?</legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div><input type="radio" id="food_yes" wire:model="fruit_consumption"
                                        value="0"><label for="food_yes"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> Sí</label></div>
                                <div><input type="radio" id="food_no" wire:model="fruit_consumption"
                                        value="1"><label for="food_no"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> No</label></div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="text-sm font-semibold text-slate-700 mb-3">¿Toma medicación
                                antihipertensiva?</legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div><input type="radio" id="htn_yes" wire:model="antihypertensive_medication"
                                        value="2"><label for="htn_yes"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> Sí</label></div>
                                <div><input type="radio" id="htn_no" wire:model="antihypertensive_medication"
                                        value="0"><label for="htn_no"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> No</label></div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="text-sm font-semibold text-slate-700 mb-3">¿Niveles elevados de glucosa
                                previos?</legend>
                            <div class="choice-card grid grid-cols-2 gap-3">
                                <div><input type="radio" id="glu_yes" wire:model="elevated_glucose"
                                        value="5"><label for="glu_yes"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> Sí</label></div>
                                <div><input type="radio" id="glu_no" wire:model="elevated_glucose"
                                        value="0"><label for="glu_no"
                                        class="justify-center text-sm font-medium text-slate-700"><span
                                            class="radio-dot"></span> No</label></div>
                            </div>
                        </fieldset>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Antecedentes familiares de
                                diabetes</label>
                            <select wire:model="family_history"
                                class="w-full border-2 p-3 rounded-xl border-slate-200">
                                <option value="0">No</option>
                                <option value="3">Sí (2° grado)</option>
                                <option value="5">Sí (1° grado)</option>
                            </select>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" wire:click="prevStep"
                                class="bg-slate-100 px-8 py-3 rounded-xl font-bold text-sm border">Anterior</button>
                            <button type="submit"
                                class="bg-emerald-600 text-white px-8 py-3 rounded-xl font-bold text-sm">Enviar y
                                Calcular</button>
                        </div>
                    </div>
                </section>
            @endif

            <!-- CONFIRMACIÓN PARA DIAGNOSTICADOS -->
            @if ($currentStep === 99)
                <section id="step-diabetes">
                    <div class="bg-gradient-to-br from-amber-500 to-orange-700 px-8 py-6 text-white">
                        <h2 class="text-xl font-bold">Participante con Diagnóstico Previo</h2>
                    </div>

                    <div class="p-8 space-y-6">
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 flex gap-4">
                            <svg class="w-8 h-8 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4" />
                            </svg>
                            <p class="text-amber-800 text-sm">Dado que ya cuenta con un diagnóstico, su participación
                                será registrada directamente.</p>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" wire:click="prevStep"
                                class="bg-slate-100 px-8 py-3 rounded-xl font-bold text-sm border">Anterior</button>
                            <button type="submit"
                                class="bg-amber-600 text-white px-8 py-3 rounded-xl font-bold text-sm">Registrar
                                Participación</button>
                        </div>
                    </div>
                </section>
            @endif
        </form>
    </div>
</div>
