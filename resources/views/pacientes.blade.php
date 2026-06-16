<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pacientes</title>
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
            <h2 class="fw-bold text-center mt-3">Lista de Pacientes</h2>
        </span>
    </nav>
    <div class="d-flex justify-content-between align-items-center px-3 my-3">
        <a href="{{route('welcome')}}" class="btn btn-outline-dark me-md-2">← Inicio</a>
        <button class="btn btn-outline-dark me-md-2" data-bs-toggle="modal" data-bs-target="#crearModal">
            + Nuevo Paciente
        </button>
    </div>
    
    <div class="table-responsive mx-auto p-2" style="max-width:800px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Diagnostico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $h)
                    <tr>
                        <td>{{ $h->id }}</td>
                        <td>{{ $h->nombre }}</td>
                        <td>{{ $h->apellido }}</td>
                        <td>{{ $h->diagnostico?->nombre }}</td>
                        <td>
                           <a href="" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editarPa{{$h->id}}">EDITAR</a>                        
                           <a href="#" onclick="confirmarEliminar({{$h->id}})" class="btn btn-outline-danger">ELIMINAR</a>
                        </td>
                    </tr>
                                {{-- modal para editar un paciente--}}
            <div class="modal fade" id="editarPa{{$h->id}}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/pacientes/actualizar/{{$h->id}}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Nuevo paciente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">  
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value = "{{$h->nombre}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" name="apellido" class="form-control" value = "{{$h->apellido}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Diagnostico</label>
                                    <select name="tipo_diagnostico_id" class="form-select" required>
                                        <option value="">-- Seleccionar --</option>
                                        @foreach ($diagnostico as $z)
                                            @if($z->id == $h->tipo_diagnostico_id)
                                                <option value="{{$z->id}}" selected>{{$z->nombre}}</option>
                                            @else
                                                <option value="{{$z->id}}" >{{$z->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
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
                @endforeach
            </tbody>
            


            

        </table>
    </div>


    {{-- modal para crear un nuevo paciente--}}
            <div class="modal fade" id="crearModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/pacientes/guardar/" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Nuevo paciente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">  
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" name="apellido" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Diagnostico</label>
                                    <select name="tipo_diagnostico_id" class="form-select" required>
                                        <option value="">-- Seleccionar --</option>
                                        @foreach ($diagnostico as $z)
                                            <option value="{{$z->id}}">{{$z->nombre}}</option>
                                        @endforeach
                                    </select>
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



    {{-- funcion para eliminar todo lo que es un Paciente dando una alerta, lo elimina usando su id y llamando al cotrolador de paciente y ejecutando el destroy --}}
    <script>
    function confirmarEliminar(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar este paciente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#212529',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href =  "/pacientes/eliminar/" + id;
            }
        });
    }
    </script>

    
</body>
</html>
