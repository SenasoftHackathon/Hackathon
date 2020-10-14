@extends('admin.admin')
@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestión de Facturación</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Gestión de Facturación</li>
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
                    Agregar
                </button>
            </div>
            <div class="col-md-5">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloModalBodega">Registrar factura</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="card-body">
                                        <!-- Formulario bodega -->
                                        <div class="form-group">
                                            <label>Usuario (*)</label>
                                            <input type="text" value="Sandra" class="form-control" id="exampleInputPassword1" placeholder="Stock bodega" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Fecha (*)</label>
                                            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Stock bodega">
                                        </div>
                                        <div class="form-group">
                                            <label>Estado (*)</label>
                                            <input type="text" value="En Proceso" class="form-control" id="exampleInputPassword1" placeholder="Stock bodega" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Producto (*)</label>
                                            <select class="form-control select2" id="producto" style="width: 100%;">
                                                <option selected="selected">Serrucho</option>
                                                <option>Martillo</option>
                                                <option>Pinzas</option>
                                                <option>Alicate</option>
                                                <option>Destornillador</option>
                                                <option>Tubo PVC</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad (*)</label>
                                            <input type="number"  class="form-control" id="txtCantidad" placeholder="Stock bodega" >
                                        </div>
                                        <button type="button" onclick="agregarProducto()" class="btn btn-secondary" data-dismiss="modal">Agregar</button>

                                        <!-- Fin formulario bodega -->
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>

                                            </thead>
                                            <tbody id="tblfactura">

                                            </tbody>
                                        </table>
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
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>1</td>
                        <td>Sandra</td>
                        <td>17/10/2020</td>
                        <td>En proceso</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>2</td>
                        <td>Sandra</td>
                        <td>20/10/2020</td>
                        <td>Finalizada</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>3</td>
                        <td>Florinda</td>
                        <td>25/10/2020</td>
                        <td>En cola</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>4</td>
                        <td>Florinda</td>
                        <td>30/10/2020</td>
                        <td>En proceso</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>5</td>
                        <td>Florinda</td>
                        <td>05/11/2020</td>
                        <td>Cancelada</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Editar</button>
                        </td>
                        <td>6</td>
                        <td>Luisa</td>
                        <td>10/11/2020</td>
                        <td>En proceso</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
@section('js')
<script>
function agregarProducto(){
    let idProducto = $("#producto option:selected").val();
    let txtProducto = $("#producto option:selected").text();
    let txtCantidad = $("#txtCantidad").val();

    $("#tblFactura").append(`
    <tr>
        <td>
        ${txtProducto}
        </td>
        <td>${txtCantidad} </td>
    </tr>
    `

    );
}
</script>

@endsection