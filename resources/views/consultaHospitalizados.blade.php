<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pacientes Hospitalizados</title>
    <style>
        body { background-color: #f0f4f8; font-family: 'Segoe UI', sans-serif; }
        .navbar-custom { background-color: #1a3c5e; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark navbar-custom px-4 py-3">
        <span class="navbar-brand fw-bold">Cantidad de dias que esta un paciente hospitalizado </span>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('welcome') }}" class="btn btn-outline-dark me-md-2">← Inicio</a>

        </div>
        <div class="table-responsive mx-auto p-2" style="max-width:800px;">
            <table class="table table-striped table-hover align-middle border">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Diagnóstico</th>
                        <th>Fecha Ingreso</th>
                        <th>Sala</th>
                        <th>Dias Hospitalizado</th>
                        <th>Estado</th>
                        
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse reemplaza al if/empty y al foreach en una sola directiva limpia --}}
                    @forelse ($lista as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->apellido }}</td>
                            <td>{{ $item->diagnostico}}</td>
                            <td>{{ $item->fecha_ingreso }}</td>
                            <td>{{ $item->sala }}</td>
                            <td>{{ $item->dias_internado }}</td>
                            <td>{{ $item->estado }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay pacientes hospitalizados actualmente</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>