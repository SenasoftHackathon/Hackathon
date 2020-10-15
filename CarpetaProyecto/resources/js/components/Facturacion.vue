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

                <div class="row justify-content-md-center">
                    <div class="card-tools col-md-10">
                        <div class="input-group" style="width: 500px;">
                            <select
                                name=""
                                id=""
                                class="form-control"
                                v-model="criterio"
                            >
                                <option value="id">Código</option>
                                <option value="porcentaje">Iva</option>
                            </select>
                            <input
                                type="text"
                                class="form-control float-right"
                                v-model="buscar"
                                placeholder="Buscar"
                                @keyup.enter="listarFactura('1', buscar, criterio)"
                            />

                            <div class="input-group-append">
                                <button
                                        type="submit"                                        class="btn btn-default"
                                    @click="listarFactura('1', buscar, criterio)"
                                >
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
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
                            <tr v-for="factura in arrayFactura" :key="factura.id">
                                <td></td>
                                <td v-text="factura.id"></td>
                                <td v-text="factura.idUsuario"></td>
                                <td v-text="factura.fechaCreacion"></td>
                                <td v-text="factura.estado"></td>
                            </tr>
                        </tbody>
                    </table>
                    <nav class="col-md-10">
                        <ul class="pagination">
                            <li
                                class="page-item"
                                v-if="pagination.current_page > 1"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page - 1,
                                            buscar,
                                            criterio
                                        )
                                    "
                                    >Ant</a
                                >
                            </li>
                            <li
                                class="page-item"
                                v-for="page in pagesNumber"
                                :key="page"
                                :class="[page == isActived ? 'active' : '']"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prevent="
                                        cambiarPagina(page, buscar, criterio)
                                    "
                                    v-text="page"
                                ></a>
                            </li>
                            <li
                                class="page-item"
                                v-if="
                                    pagination.current_page <
                                        pagination.last_page
                                "
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page + 1,
                                            buscar,
                                            criterio
                                        )
                                    "
                                    >Sig</a
                                >
                            </li>
                        </ul>
                    </nav>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            factura_id: 0,
            idSucursal: 0,
            idProducto: 0,
            stockBodega: 0,
            stockSucursal: 0,
            arrayFactura: [],
            tituloModal: "",
            tipoAccion: 0,
            modal: 0,
            errorFactura: 0,
            errorMsjFactura: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "id",
            buscar: ""
        };
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page; //Retornar la página activa
        },
        //Calcular los elementos de la paginación
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        cambiarPagina(page, buscar, criterio) {
            //Método para cambiar de página en la paginación
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarFactura(page, buscar, criterio);
        },
        listarFactura(page, buscar, criterio) {
            let me = this;
            var url =
                "/factura?page=" +
                page +
                "&buscar=" +
                buscar +
                "&criterio=" +
                criterio;
            // Make a request for a user with a given ID
            axios
                .get(url)
                .then(function(response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayFactura = respuesta.facturas.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        registrarIva() {
            if (this.validarIva()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .post("/iva/registrar", {
                    porcentaje: this.porcentaje,
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarFactura(1, "", "id");
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        validarIva() {
            this.errorIva = 0;
            this.errorMsjIva = [];
            if (!this.porcentaje) {
                this.errorMsjIva.push("El IVA no puede estar vacio.");
            }
            if (this.errorMsjIva.length) {
                this.errorIva = 1;
            }
            return this.errorIva;
        },
        abrirModal(modelo, accion) {
            switch (modelo) {
                case "iva": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registrar IVA";
                            this.tipoAccion = 1;
                            this.porcentaje = "";
                            break;
                        }
                    }
                }
            }
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.tipoAccion = 0;
            this.porcentaje = "";
        }
    },
    mounted() {
        this.listarFactura(1, "", "id");
    }
};
</script>