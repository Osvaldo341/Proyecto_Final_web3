<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Salas</title>
</head>
<style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-custom {
            background-color: #1a3c5e;
        }
</style>
<body>
    <nav class="navbar navbar-dark navbar-custom px-4 py-3">
        <span class="navbar-brand fw-bold text-center">
            <h2 class="fw-bold text-center mt-3">Lista de Salas</h2>
        </span>
    </nav>
    <div class="d-flex justify-content-between align-items-center px-3 my-3">
        <a href="{{route('welcome')}}" class="btn btn-outline-dark me-md-2">← Inicio</a>
        <button class="btn btn-outline-dark me-md-2" data-bs-toggle="modal" data-bs-target="#crearSala">
            + Nuevo Paciente
        </button>
    </div>

    <div class="table-responsive mx-auto p-2" style="max-width:800px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sala as $h)
                    <tr>
                        <td>{{ $h->id }}</td>
                        <td>{{ $h->nombre}} </td>
                        <td>{{ $h->capacidad }}</td>
                        <td>
                           <a href="" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editarSala{{$h->id }}">EDITAR</a>                        
                           <a href="#" onclick="confirmarEliminar({{$h->id}})" class="btn btn-outline-danger btn-sm">ELIMINAR</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editarSala{{ $h->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/salas/actualizar/{{ $h->id }}" method="POST">
                                    @csrf
                                    
                                    
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Sala</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $h->nombre }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Capacidad</label>
                                            <input type="number" name="capacidad" class="form-control" value="{{ $h->capacidad }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-dark">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
            

        </table>
    </div>
    <div class="modal fade" id="crearSala" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/salas/guardar/" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Sala</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Capacidad</label>
                            <input type="number" name="capacidad" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script>
    function confirmarEliminar(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar esta sala",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#212529',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href =
                "salas/eliminar/" + id;
            }
        });
    }
    </script>
</body>
</html>
