<template>
    <div>
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
                        <button
                         type="button"
                        class="btn btn-primary"
                        @click="abrirModal('factura', 'registrar')"
                        >
                        <i class="fa fa-plus"></i> Registrar
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
                            <tr v-for="factura in arrayFacyura" :key="factura.id">
                                <td></td>
                                <td v-text="factura.id"></td>
                                <td v-text="factura.idUsuario"></td>
                                <td v-text="factura.fechaCreacion"></td>
                                <td v-text="factura.estado"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</template>