<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pacientes por Sala</title>
    <style>
        body { background-color: #f0f4f8; font-family: 'Segoe UI', sans-serif; }
        .navbar-custom { background-color: #1a3c5e; }
        .card-sala {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark navbar-custom px-4 py-3">
        <span class="navbar-brand fw-bold">Ocupación por Sala</span>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('welcome') }}" class="btn btn-dark">← Inicio</a>
            <span></span>
        </div>

        <div class="row g-3 mb-4 justify-content-center">
            @foreach ($lista as $item)
            <div class="col-md-3">
                <div class="card card-sala p-3 text-center">
                    <div class="fs-2 fw-bold text-primary">{{ $item->total }}</div>
                    <div class="fw-semibold">{{ $item->sala }}</div>
                    <div class="text-muted small">pacientes activos</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="table-responsive mx-auto p-2" style="max-width:800px;">
            <table class="table table-striped table-hover align-middle border">
                <thead>
                    <tr>
                        <th>Sala</th>
                        <th class="text-center">Pacientes Hospitalizados</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lista as $item)
                        <tr>
                            <td>{{ $item->sala }}</td>
                            <td class="text-center">
                                <span class="badge bg-dark fs-6">{{ $item->total }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">No hay datos disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 