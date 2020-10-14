@extends('admin.admin')
@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestión de sucursal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Gestión de sucursal</li>
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
            </div>
            <div class="col-md-5">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloModalBodega">Registrar sucursal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="card-body">
                                        <!-- Formulario bodega -->
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nombre sucursal (*)</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Descripción</label>
                                            <textarea class="form-control" rows="12" placeholder="Descripción de la sucursal ..." style="margin-top: 0px; margin-bottom: 0px; height: 163px;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Dirección</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Teléfono</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
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

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 40px">Opciones</th>
                        <th style="width: 20px">id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>1</td>
                        <td>Sucursal minorista</td>
                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem impedit reiciendis voluptate quia nisi sint! Eligendi, totam illum, illo ratione, odit nihil recusandae mollitia voluptatum a unde repellendus! Aspernatur, aliquam.</td>
                        <td>Carrera 56 # 89 - 54</td>
                        <td>5674398</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>2</td>
                        <td>Sucursal colombia con la 80</td>
                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem impedit reiciendis voluptate quia nisi sint! Eligendi, totam illum, illo ratione, odit nihil recusandae mollitia voluptatum a unde repellendus! Aspernatur, aliquam.</td>
                        <td>Carrera 56 # 89 - 54</td>
                        <td>5674398</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>3</td>
                        <td>Sucursal prado centro</td>
                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem impedit reiciendis voluptate quia nisi sint! Eligendi, totam illum, illo ratione, odit nihil recusandae mollitia voluptatum a unde repellendus! Aspernatur, aliquam.</td>
                        <td>Carrera 56 # 89 - 54</td>
                        <td>5674398</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>4</td>
                        <td>Sucursal suramericana</td>
                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem impedit reiciendis voluptate quia nisi sint! Eligendi, totam illum, illo ratione, odit nihil recusandae mollitia voluptatum a unde repellendus! Aspernatur, aliquam.</td>
                        <td>Carrera 56 # 89 - 54</td>
                        <td>5674398</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>5</td>
                        <td>Sucursal robledo</td>
                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem impedit reiciendis voluptate quia nisi sint! Eligendi, totam illum, illo ratione, odit nihil recusandae mollitia voluptatum a unde repellendus! Aspernatur, aliquam.</td>
                        <td>Carrera 56 # 89 - 54</td>
                        <td>5674398</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>6</td>
                        <td>Sucursal bello</td>
                        <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem impedit reiciendis voluptate quia nisi sint! Eligendi, totam illum, illo ratione, odit nihil recusandae mollitia voluptatum a unde repellendus! Aspernatur, aliquam.</td>
                        <td>Carrera 98 DA # 56 - 54</td>
                        <td>5896114</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection