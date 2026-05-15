<!DOCTYPE html>
<html>
<head>
    <title>Resultados de tu Encuesta FINDRISC</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; border-bottom: 3px solid #007bff; }
        .content { padding: 20px 0; }
        .result-box { background-color: #e9ecef; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #6c757d; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #f8f9fa; }
        .section-header { background-color: #0d6efd; color: white; padding: 8px 10px; font-weight: bold; font-size: 13px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .badge-ok    { background-color: #d1fae5; color: #065f46; }
        .badge-warn  { background-color: #ffedd5; color: #9a3412; }
        .badge-danger { background-color: #fee2e2; color: #991b1b; }
        .badge-info  { background-color: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Resultados de tu Encuesta de Riesgo (FINDRISC)</h2>
        </div>

        <div class="content">
            <p>Hola,</p>
            <p>Gracias por completar la encuesta de empoderamiento saludable. Aquí están tus resultados:</p>

            <div class="result-box">
                @if($survey->has_diabetes)
                    <h3 style="color: #dc3545; margin-top: 0;">Nivel de Riesgo: {{ $survey->risk_level }}</h3>
                    <p>Has indicado que ya has sido diagnosticado con diabetes.</p>
                @else
                    <h3 style="margin-top: 0;">Puntuación FINDRISC: <strong>{{ $survey->score }}</strong></h3>
                    <h3 style="margin-bottom: 0;">Nivel de Riesgo: <strong>{{ $survey->risk_level }}</strong></h3>
                @endif
            </div>

            <div style="background-color: #e8f4fd; padding: 15px; border-left: 4px solid #007bff; margin: 20px 0;">
                <h4 style="margin-top: 0; color: #0056b3;">Información Importante para el Paso 2</h4>
                <p style="margin-bottom: 5px;">Su <strong>ID Único (Anonimizado)</strong> es el siguiente código. Cópielo y péguelo cuando ingrese a responder el Instrumento de Elicitación de Necesidades:</p>
                <p style="font-family: monospace; font-size: 16px; font-weight: bold; background: #fff; padding: 10px; border: 1px dashed #007bff; text-align: center; margin-bottom: 0;">{{ $survey->uuid }}</p>
            </div>

            @if(!$survey->has_diabetes)
            @php
                $bmi   = $survey->bmi;
                $icc   = $survey->icc;
                $gen   = $survey->gender;
                $waist = $survey->waist;

                // IMC label
                [$imcLabel, $imcClass] = match(true) {
                    $bmi < 18.5 => ['Bajo peso',                    'badge-info'],
                    $bmi < 25   => ['Peso saludable',               'badge-ok'],
                    $bmi < 30   => ['Sobrepeso',                    'badge-warn'],
                    $bmi < 35   => ['Obesidad Clase I',             'badge-warn'],
                    $bmi < 40   => ['Obesidad Clase II',            'badge-danger'],
                    default     => ['Obesidad Clase III (Mórbida)',  'badge-danger'],
                };

                // CC risk label
                if ($gen === 'F') {
                    [$ccLabel, $ccClass] = match(true) {
                        $waist > 88  => ['Riesgo muy elevado (>88 cm)',  'badge-danger'],
                        $waist >= 80 => ['Riesgo elevado (≥80 cm)',      'badge-warn'],
                        default      => ['Sin riesgo elevado (<80 cm)',  'badge-ok'],
                    };
                } else {
                    [$ccLabel, $ccClass] = match(true) {
                        $waist > 102  => ['Riesgo muy elevado (>102 cm)', 'badge-danger'],
                        $waist >= 94  => ['Riesgo elevado (≥94 cm)',      'badge-warn'],
                        default       => ['Sin riesgo elevado (<94 cm)',  'badge-ok'],
                    };
                }

                // ICC label
                if ($icc !== null) {
                    if ($gen === 'F') {
                        [$iccLabel, $iccClass] = $icc >= 0.85
                            ? ['Riesgo alto / Obesidad abdominal (≥0.85)', 'badge-danger']
                            : ['Saludable / Bajo riesgo (<0.85)',           'badge-ok'];
                    } else {
                        [$iccLabel, $iccClass] = $icc >= 0.95
                            ? ['Riesgo alto / Obesidad abdominal (≥0.95)', 'badge-danger']
                            : ['Saludable / Bajo riesgo (<0.95)',           'badge-ok'];
                    }
                }
            @endphp

            <h3>Tus Respuestas:</h3>
            <table>
                <tbody>
                    <tr><td colspan="2" class="section-header">Datos Personales</td></tr>
                    <tr>
                        <th>Género</th>
                        <td>{{ $survey->gender == 'M' ? 'Masculino' : 'Femenino' }}</td>
                    </tr>
                    <tr>
                        <th>Edad</th>
                        <td>{{ $survey->age }} años</td>
                    </tr>
                    <tr>
                        <th>Peso / Estatura</th>
                        <td>{{ $survey->weight }} kg / {{ $survey->height }} cm</td>
                    </tr>
                    <tr>
                        <th>Circunferencia de cintura (CC)</th>
                        <td>{{ $survey->waist }} cm</td>
                    </tr>
                    <tr>
                        <th>Circunferencia de cadera</th>
                        <td>{{ $survey->hip }} cm</td>
                    </tr>

                    <tr><td colspan="2" class="section-header">Indicadores Antropométricos</td></tr>
                    <tr>
                        <th>IMC</th>
                        <td>{{ $bmi }} kg/m² &nbsp;<span class="badge {{ $imcClass }}">{{ $imcLabel }}</span></td>
                    </tr>
                    <tr>
                        <th>Riesgo CC</th>
                        <td>{{ $waist }} cm &nbsp;<span class="badge {{ $ccClass }}">{{ $ccLabel }}</span></td>
                    </tr>
                    @if($icc !== null)
                    <tr>
                        <th>ICC (cintura/cadera)</th>
                        <td>{{ (float) $icc }} &nbsp;<span class="badge {{ $iccClass }}">{{ $iccLabel }}</span></td>
                    </tr>
                    @endif

                    <tr><td colspan="2" class="section-header">Hábitos y Antecedentes</td></tr>
                    <tr>
                        <th>Actividad Física Diaria</th>
                        <td>{{ ucfirst($survey->daily_activity) }}</td>
                    </tr>
                    <tr>
                        <th>Consumo de Frutas/Verduras</th>
                        <td>{{ ucfirst($survey->fruit_consumption) }}</td>
                    </tr>
                    <tr>
                        <th>Medicación Antihipertensiva</th>
                        <td>{{ ucfirst($survey->antihypertensive_medication) }}</td>
                    </tr>
                    <tr>
                        <th>Glucosa Elevada Previa</th>
                        <td>{{ ucfirst($survey->elevated_glucose) }}</td>
                    </tr>
                    <tr>
                        <th>Antecedentes Familiares</th>
                        <td>{{ ucfirst($survey->family_history) }}</td>
                    </tr>
                </tbody>
            </table>
            @endif

            <p style="margin-top: 20px;">
                <a href="{{ route('surveys.show', $survey->uuid) }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                    Ver resultados completos en línea
                </a>
            </p>
        </div>

        <div class="footer">
            <p>Este es un correo automático, por favor no respondas a esta dirección.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
