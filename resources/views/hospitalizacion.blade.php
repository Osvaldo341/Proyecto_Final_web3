<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Hospitalizaciones</title>
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
            <h2 class="fw-bold text-center mt-3">Lista de Hospitalizaciones</h2>
        </span>
    </nav>
    <div class="d-flex justify-content-between align-items-center px-3 my-3">
        <a href="{{route('welcome')}}" class="btn btn-outline-dark me-md-2">← Inicio</a>
        <button class="btn btn-outline-dark me-md-2" data-bs-toggle="modal" data-bs-target="#crearHos">
            + Nueva Hospitalizacion
        </button>
    </div>



    <div class="table-responsive mx-auto p-2" style="max-width:1200px;">
        <table class="table table-striped table-hover align-middle border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Fecha de Ingreso</th>
                    <th>Fecha de Alta</th>
                    <th>Sala </th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hospitalizacion as $h)
                    <tr>
                        <td>{{ $h->id }}</td>
                        <td>{{ $h->paciente?->nombre }} {{ $h->paciente?->apellido }}</td>
                        <td>{{ $h->fecha_ingreso }}</td>
                        <td>{{ $h->fecha_alta ?? '—'}} </td>
                        <td>{{ $h->diegogay?->nombre }}</td>
                        <td>
                           <a href="" class="btn btn-outline-dark btn-sm"  data-bs-toggle="modal" data-bs-target="#editarHos{{$h->id}}">EDITAR</a>                        
                           <a href="#" onclick="confirmarEliminar({{$h->id}})" class="btn btn-outline-danger btn-sm">ELIMINAR</a>
                        </td>
                    </tr>



                        <div class="modal fade" id="editarHos{{$h->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="hospitalizacion/actualizar/{{$h->id}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Hospitalizacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Paciente</label>
                                                <select name="paciente_id" class="form-select"  required>
                                                    <option value="">-- Seleccionar --</option>
                                                    @foreach ($pacientes as $p)
                                                        @if($p->id == $h->paciente_id)
                                                            <option value="{{ $p->id }}" selected>
                                                                {{ $p->nombre }} {{ $p->apellido }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $p->id }}">
                                                                {{ $p->nombre }} {{ $p->apellido }}
                                                            </option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Fecha de Ingreso</label>
                                                <input type="date" name="fecha_ingreso" class="form-control" value= "{{$h->fecha_ingreso}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Fecha de Alta <small class="text-muted">(opcional)</small></label>
                                                <input type="date" name="fecha_alta" class="form-control" value= "{{$h->fecha_alta}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Sala</label>
                                                <select name="sala_id" class="form-select" required>
                                                    <option value="">-- Seleccionar --</option>
                                                    @foreach ($sala as $z)
                                                        @if($z->id == $h->sala_id)
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
    <div class="modal fade" id="crearHos" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="hospitalizacion/guardar" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Hospitalizacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Paciente</label>
                            <select name="paciente_id" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                @foreach ($pacientes as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->nombre }} {{ $p->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Alta <small class="text-muted">(opcional)</small></label>
                            <input type="date" name="fecha_alta" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sala</label>
                            <select name="sala_id" class="form-select" required>
                                <option value="">-- Seleccionar --</option>
                                 @foreach ($sala as $z)
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
</body>
<script>
    function confirmarEliminar(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar esta consulta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#212529',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href =
                "hospitalizacion/eliminar/" + id;
            }
        });
    }
</script>
</html>
