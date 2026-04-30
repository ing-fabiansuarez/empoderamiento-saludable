<!DOCTYPE html>
<html>
<head>
    <title>Tus respuestas — Instrumento de Necesidades</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #1e40af, #0e7490); padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { color: #fff; margin: 0; font-size: 20px; }
        .header p { color: #bfdbfe; margin: 6px 0 0; font-size: 13px; }
        .content { background: #fff; padding: 30px; border: 1px solid #e2e8f0; border-top: none; }
        .greeting { font-size: 17px; font-weight: bold; color: #1e3a8a; margin-bottom: 8px; }
        .uuid-box { background: #f0f9ff; border: 1px dashed #38bdf8; padding: 12px 16px; border-radius: 6px; margin: 20px 0; text-align: center; }
        .uuid-box span { font-family: monospace; font-size: 15px; font-weight: bold; color: #0369a1; letter-spacing: 1px; }
        .section-title { font-size: 14px; font-weight: bold; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #bfdbfe; padding-bottom: 6px; margin: 24px 0 12px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #eff6ff; color: #1e40af; font-size: 12px; text-align: left; padding: 10px 12px; font-weight: 600; width: 40%; }
        td { padding: 10px 12px; font-size: 13px; color: #374151; border-bottom: 1px solid #f1f5f9; vertical-align: top; }
        .scale-bar { display: flex; gap: 2px; margin-top: 4px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-orange { background: #fed7aa; color: #9a3412; }
        .badge-red { background: #fee2e2; color: #991b1b; }
        .footer { text-align: center; font-size: 11px; color: #94a3b8; padding: 20px; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Instrumento de Elicitación de Necesidades</h1>
            <p>Proyecto Empoderamiento Saludable · Red Mutis · INCOSE-TP-2021-002-01</p>
        </div>

        <div class="content">
            <p class="greeting">{{ $survey->names }}, ¡gracias por tu participación!</p>
            <p>Has respondido exitosamente el <strong>Instrumento de Elicitación de Necesidades de Stakeholders</strong>. A continuación encontrarás un resumen de tus respuestas para que puedas conservarlas.</p>

            <div class="uuid-box">
                <p style="margin:0 0 4px; font-size:12px; color:#64748b;">Tu ID Único (Anonimizado)</p>
                <span>{{ $instrument->uuid }}</span>
            </div>

            <div class="section-title">1. Identificación y Perfil</div>
            <table>
                <tr>
                    <th>Rol en el Sistema</th>
                    <td>{{ $instrument->role }}</td>
                </tr>
                <tr>
                    <th>Nivel de Riesgo (FINDRISC)</th>
                    <td>
                        @php
                            $riskClass = match(strtolower($instrument->risk_level)) {
                                'bajo' => 'badge-green',
                                'moderado' => 'badge-orange',
                                'alto' => 'badge-red',
                                default => 'badge-blue',
                            };
                        @endphp
                        <span class="badge {{ $riskClass }}">{{ $instrument->risk_level }}</span>
                    </td>
                </tr>
            </table>

            <div class="section-title">2. Barrera Principal</div>
            <table>
                <tr>
                    <th>Barrera identificada</th>
                    <td>
                        {{ $instrument->barrier }}
                        @if($instrument->barrier === 'Otro' && $instrument->barrier_other)
                            — <em>{{ $instrument->barrier_other }}</em>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="section-title">3. Percepción vs. Realidad</div>
            <table>
                <tr>
                    <th>Puntuación</th>
                    <td>
                        <strong>{{ $instrument->perception_vs_reality }} / 10</strong>
                        <div style="margin-top:6px; background:#e2e8f0; border-radius:4px; height:8px; width:100%;">
                            <div style="background:#2563eb; border-radius:4px; height:8px; width:{{ $instrument->perception_vs_reality * 10 }}%;"></div>
                        </div>
                        <small style="color:#64748b;">
                            @if($instrument->perception_vs_reality <= 3)
                                Bajo nivel de brecha percibida
                            @elseif($instrument->perception_vs_reality <= 6)
                                Brecha percibida moderada
                            @else
                                Alta brecha entre percepción y realidad
                            @endif
                        </small>
                    </td>
                </tr>
            </table>

            <div class="section-title">4. Bucle de Fallo</div>
            <table>
                <tr>
                    <th>Descripción</th>
                    <td>{{ $instrument->failure_loop }}</td>
                </tr>
            </table>

            <div class="section-title">5. Esperanzas y Expectativas</div>
            <table>
                <tr>
                    <th>¿Qué esperas lograr?</th>
                    <td>{{ $instrument->hopes }}</td>
                </tr>
            </table>

            <p style="margin-top:28px; font-size:13px; color:#64748b;">
                Tus respuestas contribuyen directamente a la definición del <strong>Concepto de Operaciones (ConOps)</strong> del proyecto y ayudan a evitar la "Trampa de los Indicadores". ¡Tu perspectiva es muy valiosa!
            </p>
        </div>

        <div class="footer">
            <p>Este es un correo automático, por favor no respondas a esta dirección.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
