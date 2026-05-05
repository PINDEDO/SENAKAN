<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de gestión — {{ config('app.name') }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            color: #1A2533;
            margin: 0;
            padding: 24px;
            line-height: 1.45;
        }
        .masthead {
            background: #003770;
            color: #fff;
            padding: 14px 18px;
            margin: -24px -24px 0 -24px;
        }
        .masthead h1 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 0.02em;
        }
        .masthead p {
            margin: 6px 0 0 0;
            font-size: 9pt;
            opacity: 0.95;
        }
        .accent-bar {
            height: 5px;
            background: #39A900;
            margin: 0 -24px 20px -24px;
        }
        .meta {
            font-size: 9pt;
            color: #3D4F60;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #E8ECEF;
        }
        h2 {
            font-size: 11pt;
            color: #003770;
            margin: 20px 0 10px 0;
            padding-bottom: 4px;
            border-bottom: 2px solid #39A900;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 9pt;
        }
        table.data th {
            background: #003770;
            color: #fff;
            text-align: left;
            padding: 8px 10px;
            font-weight: bold;
        }
        table.data td {
            padding: 7px 10px;
            border-bottom: 1px solid #E8ECEF;
            vertical-align: top;
        }
        table.data tr:nth-child(even) td {
            background: #F4F6F8;
        }
        .pill {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: bold;
        }
        .pill-done { background: #EDF7E6; color: #2D8800; }
        .pill-progress { background: #EFF6FF; color: #1D4ED8; }
        .pill-pending { background: #FFFBEB; color: #B45309; }
        .metric-grid {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .metric-grid td {
            width: 33%;
            padding: 10px;
            text-align: center;
            border: 1px solid #E8ECEF;
            background: #F4F6F8;
        }
        .metric-grid .num {
            font-size: 18pt;
            font-weight: bold;
            color: #003770;
        }
        .metric-grid .lbl {
            font-size: 8pt;
            color: #8E9BAA;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .footer {
            margin-top: 28px;
            padding-top: 12px;
            border-top: 1px solid #E8ECEF;
            font-size: 8pt;
            color: #8E9BAA;
        }
    </style>
</head>
<body>
    <div class="masthead">
        <h1>Servicio Nacional de Aprendizaje — SENA</h1>
        <p>Informe de gestión institucional · {{ config('app.name') }}</p>
    </div>
    <div class="accent-bar"></div>

    <div class="meta">
        <strong>Generado:</strong> {{ $generatedAt }}<br>
        <strong>Usuario:</strong> {{ $generatedBy }}
    </div>

    <h2>Distribución global de tareas</h2>
    <table class="metric-grid">
        <tr>
            <td>
                <div class="num">{{ $task_distribution['done'] }}%</div>
                <div class="lbl">Completadas</div>
            </td>
            <td>
                <div class="num">{{ $task_distribution['progress'] }}%</div>
                <div class="lbl">En proceso</div>
            </td>
            <td>
                <div class="num">{{ $task_distribution['pending'] }}%</div>
                <div class="lbl">Pendientes</div>
            </td>
        </tr>
    </table>

    <h2>Cumplimiento por proyecto / ficha</h2>
    <table class="data">
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Ficha</th>
                <th style="width: 70px;">Cumplimiento</th>
                <th style="width: 50px;">Tareas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
                @php
                    $pct = $project->tasks_count > 0
                        ? round(($project->completed_tasks_count / $project->tasks_count) * 100)
                        : 0;
                @endphp
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->code }}</td>
                    <td><strong style="color: #39A900;">{{ $pct }}%</strong></td>
                    <td>{{ $project->completed_tasks_count }} / {{ $project->tasks_count }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No hay proyectos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Historial de actividad reciente</h2>
    <table class="data">
        <thead>
            <tr>
                <th style="width: 110px;">Actualización</th>
                <th style="width: 120px;">Responsable</th>
                <th>Tarea / proyecto</th>
                <th style="width: 85px;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_activities as $activity)
                @php
                    $pill = match ($activity->status) {
                        'done' => 'pill-done',
                        'progress' => 'pill-progress',
                        'pending' => 'pill-pending',
                        default => 'pill-pending',
                    };
                @endphp
                <tr>
                    <td>{{ $activity->updated_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $activity->creator?->name ?? '—' }}</td>
                    <td>
                        <strong>{{ $activity->title }}</strong><br>
                        <span style="font-size: 8pt; color: #8E9BAA;">{{ $activity->project?->name }}</span>
                    </td>
                    <td><span class="pill {{ $pill }}">{{ \App\Support\ReportFormat::taskStatusLabel($activity->status) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4">Sin registros de actividad.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Documento generado automáticamente por {{ config('app.name') }}. Los porcentajes de distribución son sobre el total de tareas del sistema.
    </div>
</body>
</html>
