@extends('admin.admin')
@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Roles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <table class="table table-bordered col-md-8">
                <thead>
                    <tr>
                        <th style="width: 20px">id</th>
                        <th>Rol</th>
                        <th>Permisos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Administrador</td>
                        <td>Permiso de administrador</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bodega</td>
                        <td>Permiso gestionar bodega</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Facturación</td>
                        <td>Permiso gestionar facturación</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection