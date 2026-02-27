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
                            class="consent-scroll bg-slate-50 rounded-2xl border border-slate-200 p-6 text-sm text-slate-600 leading-7 h-96 overflow-y-auto mb-6 space-y-6">
                            <div class="text-center mb-6">
                                <h3 class="text-lg font-bold text-slate-900 leading-tight">CONSENTIMIENTO INFORMADO PARA
                                    LA PARTICIPACIÓN EN PROYECTO DE INVESTIGACIÓN</h3>
                            </div>

                            <div class="space-y-2 p-4 bg-white rounded-xl border border-slate-100 shadow-sm">
                                <p><strong class="text-blue-900">Título del Proyecto:</strong> Empoderamiento Saludable:
                                    Desarrollo de una aplicación digital con un enfoque de informática participativa
                                    para el desarrollo de hábitos saludables y conciencia de la enfermedad en personas
                                    con diabetes y alto riesgo de diabetes</p>
                                <p><strong class="text-blue-900">Investigador Principal:</strong> JORGE ANDRICK PARRA
                                    VALENCIA.</p>
                                <p><strong class="text-blue-900">Vinculación institucional:</strong> DOCENTE
                                    INVESTIGADOR. DOCTORADO EN INGENIERÍA</p>
                                <p><strong class="text-blue-900">Entidad:</strong> Universidad Autónoma de Bucaramanga.
                                </p>
                            </div>

                            <p class="italic text-slate-500 bg-slate-100 p-4 rounded-xl">
                                Usted ha sido invitado a participar de esta investigación porque es una persona con
                                riesgo alto conforme test de Findrisk ó diagnosticados con Diabetes Mellitus en Colombia
                                en la población universitaria de las universidades Autónoma de Manizales, Autónoma de
                                Occidente y Autónoma de Bucaramanga, por adhesión voluntaria. Se presenta a continuación
                                el Consentimiento Informado el cual le será leído por un integrante del proyecto. Podrá
                                hacer todas las preguntas que estime necesarias para tener completa claridad de su
                                participación, confidencialidad de la información personal y retroalimentación de
                                resultados.
                            </p>

                            <div class="space-y-4">
                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">1</span>
                                        Objetivo del Proyecto:
                                    </h4>
                                    <p class="pl-8">El presente proyecto pretende “Desarrollar y evaluar una app con
                                        informática participativa para fomentar hábitos saludables y conciencia de la
                                        diabetes en personas con alto riesgo o diagnosticadas, midiendo su adopción a
                                        corto plazo”</p>
                                </section>

                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">2</span>
                                        Procedimiento:
                                    </h4>
                                    <div class="pl-8 space-y-2">
                                        <p>Como participante en este estudio, se le pedirá:</p>
                                        <ul class="list-decimal pl-5 space-y-2">
                                            <li>Completar formularios escritos o electrónicos que contengan preguntas
                                                sobre sus experiencias, opiniones, comportamientos o características
                                                demográficas y clínicas relevantes para el estudio.</li>
                                            <li>Participar en entrevistas individualmente o en grupos para obtener
                                                información más detallada sobre sus experiencias, actitudes, o
                                                percepciones relacionadas con el tema de investigación.</li>
                                            <li>Utilizar dispositivos de monitoreo o registradores de datos en la
                                                aplicación diseñada desde un dispositivo de mi propiedad para registrar
                                                datos relevantes para el estudio</li>
                                            <li>Permitir el acceso a registros de la aplicación la que incluye
                                                información personal, uso de la aplicación, funcionalidades, resultados
                                                de acciones reportadas.</li>
                                            <li>Asistir a sesiones de capacitación o talleres educativos de forma libre
                                                y voluntaria</li>
                                        </ul>
                                        <p class="mt-4">Esta actividad será coordinada por el equipo de investigación
                                            del proyecto. La recolección de información se realizará por medio de
                                            instrumentos electrónicos con almacenamiento seguro de datos conforme las
                                            etapas del proyecto.</p>
                                        <p>En una primera etapa, se le aplicarán unas encuestas para determinar su nivel
                                            de riesgo en Diabetes Mellitus que incluyen información personal sobre
                                            condiciones de salud, factores hereditarios, aspectos de vida y condición
                                            física. Posteriormente se aplicarán encuestas específicas sobre el proceso
                                            de desarrollo de la aplicación enfocado a comprender su visión de la misma
                                            para participar con sus comentarios en el diseño. En una tercera etapa, se
                                            le solicitará instalar y utilizar a mi criterio una aplicación móvil de
                                            salud, recibiendo información particular sobre el uso de la aplicación y
                                            condiciones de cuidado de la salud y la enfermedad por diversos medios tales
                                            como correo electrónico, avisos de la aplicación, llamadas telefónicas o
                                            encuentros presenciales o virtuales. Finalmente recibirá una información del
                                            progreso en el uso de la herramienta y una retroalimentación para
                                            información personal y aprovechamiento propio en mi cuidado personal a
                                            través de la aplicación y por correo electrónico.</p>
                                        <p><strong class="text-slate-700">Duración:</strong> Este proceso tendrá una
                                            duración mínima de seis (6) meses, máximo ocho (8) con posibilidad de
                                            abandono voluntario cuando lo desee hacer sin requerir notificación o
                                            información al grupo investigador.</p>
                                    </div>
                                </section>

                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">3</span>
                                        Riesgos y beneficios:
                                    </h4>
                                    <div class="pl-8 space-y-4">
                                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                                            <p class="text-xs text-blue-800 leading-relaxed">De acuerdo con la <strong
                                                    class="text-blue-900">Resolución 8430 de 1993</strong> del
                                                Ministerio de Salud de Colombia, esta investigación se clasifica como
                                                una <strong>investigación de riesgo mínimo</strong>, ya que utiliza
                                                encuestas, entrevistas, herramientas digitales y análisis de información
                                                sin intervención directa sobre la salud del participante.</p>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-emerald-700">Beneficios informados:</p>
                                            <ul class="list-disc pl-5 space-y-1">
                                                <li><strong class="text-slate-700">Contribuir al avance del
                                                        conocimiento:</strong> Al participar en el estudio, podré
                                                    contribuir a la comprensión del uso de las aplicaciones móviles para
                                                    el beneficio de la salud, lo que puede ayudar a mejorar la calidad
                                                    de vida de otras personas en el futuro.</li>
                                                <li><strong class="text-slate-700">Aprendizaje y conciencia:</strong>
                                                    Participar en el estudio me dará la oportunidad de aprender más
                                                    sobre su salud, diabetes, lo que puede aumentar mi conciencia y
                                                    conocimiento sobre temas importantes relacionados con mi bienestar.
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-red-700">Posibles riesgos asociados:</p>
                                            <ul class="list-disc pl-5 space-y-2">
                                                <li><strong class="text-slate-700">Riesgos físicos mínimos:</strong> Si
                                                    la aplicación incluye recomendaciones de actividad física, podría
                                                    haber un riesgo mínimo de lesiones asociadas con el aumento de la
                                                    actividad física, como esguinces musculares o fatiga.</li>
                                                <li><strong class="text-slate-700">Riesgos emocionales:</strong> Los
                                                    participantes podrían experimentar angustia emocional si la
                                                    aplicación aborda temas relacionados con la diabetes que les
                                                    resultan sensibles o estresantes. Por ejemplo, la visualización de
                                                    información sobre los posibles riesgos de salud asociados con la
                                                    diabetes podría generar ansiedad.</li>
                                                <li><strong class="text-slate-700">Riesgos de privacidad y
                                                        confidencialidad:</strong> La recopilación de datos personales o
                                                    médicos a través de la aplicación podría plantear riesgos de
                                                    privacidad si la información se ve comprometida o si los
                                                    participantes no están completamente informados sobre cómo se
                                                    utilizarán y protegerán sus datos.</li>
                                                <li><strong class="text-slate-700">Riesgos sociales:</strong> Algunos
                                                    participantes podrían experimentar estigmatización o discriminación
                                                    relacionada con su condición de diabetes si otros descubren su
                                                    participación en el estudio a través de la aplicación o si comparten
                                                    información sobre su salud en redes sociales vinculadas a la
                                                    aplicación.</li>
                                                <li><strong class="text-slate-700">Riesgos de seguridad
                                                        informática:</strong> Existe el riesgo de que la aplicación
                                                    pueda verse comprometida por ciberataques, lo que podría resultar en
                                                    la pérdida o divulgación no autorizada de datos personales o médicos
                                                    de los participantes.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">4</span>
                                        Confidencialidad:
                                    </h4>
                                    <p class="pl-8">Toda la información recopilada durante el estudio se mantendrá en
                                        estricta confidencialidad. Los datos serán almacenados de manera segura en el
                                        Drive de la UNAB y solo el equipo de investigación tendrá acceso a ellos. En los
                                        informes o publicaciones que resulten de esta investigación, los datos se
                                        presentarán de manera agregada y anonimizada para proteger su identidad. Este
                                        Consentimiento permite el cumplimiento de la <strong class="text-slate-700">Ley
                                            1581 de 2012</strong> y sus decretos reglamentarios 1377 de 2013 y 886 de
                                        2014.</p>
                                </section>

                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">5</span>
                                        Propiedad intelectual
                                    </h4>
                                    <ul class="list-disc pl-13 space-y-1">
                                        <li>Los derechos morales sobre la información personal pertenecen a los
                                            participantes.</li>
                                        <li>Los derechos patrimoniales sobre los resultados agregados del estudio
                                            pertenecen a la Universidad Autónoma de Bucaramanga conforme a su política
                                            institucional.</li>
                                        <li>La información será utilizada únicamente con fines académicos y científicos.
                                        </li>
                                    </ul>
                                </section>

                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">6</span>
                                        Voluntariedad:
                                    </h4>
                                    <p class="pl-8">Mi participación en este proyecto es completamente voluntaria. Si
                                        decido participar, tengo el derecho de retirarme en cualquier momento sin
                                        necesidad de proporcionar una explicación y sin que esto afecte sus relaciones
                                        con la entidad o el equipo de investigación. El equipo investigador también
                                        podrá suspender la participación de un participante en caso de presentarse
                                        situaciones que lo justifiquen, informando oportunamente al participante.</p>
                                </section>

                                <section>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs">7</span>
                                        Contacto:
                                    </h4>
                                    <div class="pl-8 space-y-2">
                                        <p><strong class="text-slate-700">Investigador Principal:</strong> Jorge Andrick
                                            Parra Valencia (<a href="mailto:japarra@unab.edu.co"
                                                class="text-blue-600 hover:underline">japarra@unab.edu.co</a>)</p>
                                        <p><strong class="text-slate-700">Consultas Éticas (CIEI UNAB):</strong> <a
                                                href="mailto:ciei@unab.edu.co"
                                                class="text-blue-600 hover:underline">ciei@unab.edu.co</a></p>
                                    </div>
                                </section>
                            </div>

                            <div class="border-t border-slate-200 pt-6 mt-8">
                                <p class="text-center font-bold text-slate-900 mb-4 uppercase tracking-tighter">
                                    Declaración de Consentimiento</p>
                                <p class="text-slate-600 leading-relaxed text-center italic">
                                    "Al aceptar este documento, manifiesto que he leído y comprendido la información
                                    proporcionada. Entiendo que mi participación es voluntaria y que puedo retirarme en
                                    cualquier momento. Doy mi consentimiento para participar en este proyecto de
                                    investigación e identificado/a con mi correo electrónico, acepto voluntariamente
                                    participar."
                                </p>
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
                            <svg class="w-5 h-5 text-violet-300" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-violet-300 text-sm font-medium uppercase tracking-widest">Sección
                                2</span>
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
