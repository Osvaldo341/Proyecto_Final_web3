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
        <span class="navbar-brand fw-bold">Pacientes Ordenados Alfabeticamente      </span>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('welcome') }}" class="btn btn-outline-dark me-md-2">← Inicio</a>
            <span></span>
        </div>

        <div class="table-responsive mx-auto p-2" style="max-width:700px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <tr>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Diagnostico</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lista as $h)
                    <tr>
                        <td>{{ $h->apellido }}</td>
                        <td>{{ $h->  nombre}}</td>
                        <td>{{ $h-> diagnostico }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
            

        </table>
    </div>
    </div>
</body>
</html> 