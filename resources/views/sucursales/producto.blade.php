@extends('admin.admin')
@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestión de productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Gestión de productos</li>
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
                                <h5 class="modal-title" id="tituloModalBodega">Registrar producto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="card-body">
                                        <!-- Formulario bodega -->
                                        <div class="form-group">
                                            <label>Proveedor (*)</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">CAT</option>
                                                <option>Ferretería Jungla</option>
                                                <option>René</option>
                                                <option>FerreLujos</option>0
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nombre producto (*)</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Precio (*)</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">IVA</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control text-right" value="19" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
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
                        <th>Proveedor</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Precio/IVA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>1</td>
                        <td>CAT</td>
                        <td>Martillo</td>
                        <td>3000</td>
                        <td>3570</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>2</td>
                        <td>FerreLujos</td>
                        <td>Serrucho</td>
                        <td>3000</td>
                        <td>3570</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>3</td>
                        <td>Ferreteria Jungla</td>
                        <td>Martillo</td>
                        <td>3000</td>
                        <td>3570</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>4</td>
                        <td>CAT</td>
                        <td>Serrucho</td>
                        <td>3000</td>
                        <td>3570</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection