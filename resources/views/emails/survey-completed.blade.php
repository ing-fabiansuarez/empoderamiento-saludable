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
            <h3>Tus Respuestas:</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Género</th>
                        <td>{{ $survey->gender == 'M' ? 'Masculino' : 'Femenino' }}</td>
                    </tr>
                    <tr>
                        <th>Edad</th>
                        <td>{{ $survey->age }} años</td>
                    </tr>
                    <tr>
                        <th>Peso / Estatura / Cintura</th>
                        <td>{{ $survey->weight }} kg / {{ $survey->height }} cm / {{ $survey->waist }} cm</td>
                    </tr>
                    <tr>
                        <th>IMC Calculado</th>
                        <td>{{ $survey->bmi }}</td>
                    </tr>
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
