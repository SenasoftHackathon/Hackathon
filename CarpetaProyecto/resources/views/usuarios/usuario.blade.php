@extends('admin.admin')
@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestión de usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Gestión de usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Registrar
                </button>
                <hr>
            </div>
            <div class="col-md-5">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloModalBodega">Registrar usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="card-body">
                                        <!-- Formulario bodega -->
                                        <div class="form-group">
                                            <label>Sucursal (*)</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Sucursal minorista</option>
                                                <option>Sucursal prado centro</option>
                                                <option>Sucursal Colombia con la 80</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Rol (*)</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Administrador</option>
                                                <option>Bodega</option>
                                                <option>Facturación</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email (*)</label>
                                            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Contraseña (*)</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Estado (*)</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Activo</option>
                                                <option>Inactivo</option>
                                            </select>
                                        </div>
                                        <!-- Fin formulario bodega -->
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal -->
            </div>

            <div class="container-fluid">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 40px">Opciones</th>
                            <th style="width: 20px">id</th>
                            <th>Sucursal</th>
                            <th>Rol</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                            </td>
                            <td>1</td>
                            <td>Sucursal minorista</td>
                            <td>Administrador</td>
                            <td>cristian@email.com</td>
                            <td><span class="badge bg-success">Activo</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                            </td>
                            <td>2</td>
                            <td>Sucursal minorista</td>
                            <td>Bodega</td>
                            <td>sergio@email.com</td>
                            <td><span class="badge bg-success">Activo</span></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                            </td>
                            <td>3</td>
                            <td>Sucursal minorista</td>
                            <td>Facturación</td>
                            <td>jaime@email.com</td>
                            <td><span class="badge bg-danger">Inactivo</span></td>
                        </tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>3</td>
                        <td>Sucursal minorista</td>
                        <td>Facturación</td>
                        <td>andres@email.com</td>
                        <td><span class="badge bg-success">Activo</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection