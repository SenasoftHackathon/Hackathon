@extends('admin.admin')
@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permisos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Permisos</li>
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
                        <th>Permiso</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Administrador</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci tempora numquam, perspiciatis amet eaque rem debitis ipsum excepturi iusto commodi mollitia vitae quasi earum, eius, magnam odio reiciendis. Excepturi, aspernatur?</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Gestionar bodega</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae amet, ab dignissimos at nemo placeat natus, nam dicta sequi labore asperiores, necessitatibus dolorum maxime corporis laboriosam aspernatur. Laudantium, ratione dolorum!</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Facturación</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi dolorem illo fuga ipsam ratione laboriosam quo ducimus veniam nam sit, voluptatem reprehenderit nesciunt inventore porro, in, corrupti velit cum voluptate!</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection