<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gestión de Existencias</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Gestión de Existencias
                            </li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-5">
                    <!-- Modal -->
                    <div
                        class="modal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                        role="dialog"
                        :class="{ mostrar: modal }"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5
                                        class="modal-title"
                                        v-text="tituloModal"
                                    ></h5>
                                    <button
                                        type="button"
                                        class="close"
                                        aria-label="Close"
                                        @click="cerrarModal()"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form">
                                        <div class="card-body">
                                            <!-- Formulario bodega -->
                                            <div class="form-group">
                                                <label for="">Sucursal</label>
                                                <select
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="idSucursal"
                                                    disabled
                                                >
                                                    <option value="0"
                                                        >Seleccione
                                                    </option>
                                                    <option
                                                        v-for="selectSucursal in arraySucursal"
                                                        :key="selectSucursal.id"
                                                        :value="
                                                            selectSucursal.id
                                                        "
                                                        v-text="
                                                            selectSucursal.nombre
                                                        "
                                                    ></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Producto</label>
                                                <select
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="idProducto"
                                                    disabled
                                                >
                                                    <option value="0"
                                                        >Seleccione
                                                    </option>
                                                    <option
                                                        v-for="selectProducto in arrayProducto"
                                                        :key="selectProducto.id"
                                                        :value="
                                                            selectProducto.id
                                                        "
                                                        v-text="
                                                            selectProducto.nombre
                                                        "
                                                    ></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for=""
                                                    >Stock Sucursal (*)</label
                                                >
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="stockSucursal"
                                                />
                                            </div>
                                            <div
                                                v-show="errorExistencia"
                                                class="form-group row errores"
                                            >
                                                <label
                                                    class="text-center"
                                                    v-for="error in errorMsjExistencia"
                                                    :key="error"
                                                    v-text="error"
                                                ></label>
                                            </div>
                                            <!-- Fin formulario bodega -->
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        @click="cerrarModal()"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        v-if="tipoAccion == 1"
                                        @click="actualizarExistencia()"
                                    >
                                        Actualizar stock
                                    </button>
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
                                <option value="nombre">Producto</option>
                            </select>
                            <input
                                type="text"
                                class="form-control float-right"
                                v-model="buscar"
                                placeholder="Buscar"
                                @keyup.enter="
                                    listarExistencia('1', buscar, criterio)
                                "
                            />

                            <div class="input-group-append">
                                <button
                                    type="submit"
                                    class="btn btn-default"
                                    @click="
                                        listarExistencia('1', buscar, criterio)
                                    "
                                >
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped col-md-10">
                        <thead>
                            <tr>
                                <th style="width: 120px">Editar stock</th>
                                <th style="width: 20px">id</th>
                                <th>Id Sucursal</th>
                                <th>Sucursal</th>
                                <th>Producto</th>
                                <th>Stock en Sucursal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="existencia in arrayExistencia"
                                :key="existencia.id"
                            >
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn-primary btn-sm"
                                        @click="
                                            abrirModal(
                                                'existencia',
                                                'actualizar',
                                                existencia
                                            )
                                        "
                                    >
                                        <i class="fa fa-pen"></i>
                                    </button>
                                </td>
                                <td v-text="existencia.id"></td>
                                <td v-text="existencia.idSucursal"></td>
                                <td v-text="existencia.nombre_sucursal"></td>
                                <td v-text="existencia.nombre_producto"></td>
                                <td v-text="existencia.stockSucursal"></td>
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
            <!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->
</template>

<script>
export default {
    data() {
        return {
            existencia_id: 0,
            idSucursal: "",
            idProducto: "",
            stockBodega: 0,
            stockSucursal: 0,
            arrayExistencia: [],
            tituloModal: "",
            tipoAccion: 0,
            modal: 0,
            errorExistencia: 0,
            errorMsjExistencia: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "existencias.id",
            buscar: "",
            arrayProducto: [],
            arraySucursal: []
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
            me.listarExistencia(page, buscar, criterio);
        },
        listarExistencia(page, buscar, criterio) {
            let me = this;
            var url =
                "/existencia?page=" +
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
                    me.arrayExistencia = respuesta.existencias.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        selectSucursal() {
            let me = this;
            var url = "/existencia/selectSucursal";
            // Make a request for a user with a given ID
            axios
                .get(url)
                .then(function(response) {
                    // handle success
                    var respuesta = response.data;
                    me.arraySucursal = respuesta;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        selectProducto() {
            let me = this;
            var url = "/existencia/selectProducto";
            // Make a request for a user with a given ID
            axios
                .get(url)
                .then(function(response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayProducto = respuesta;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        actualizarExistencia() {
            if (this.validarExistencia()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .put("/existencia/actualizar", {
                    stockSucursal: this.stockSucursal,
                    id: this.existencia_id
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarExistencia(1, "", "id");
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        validarExistencia() {
            this.errorExistencia = 0;
            this.errorMsjExistencia = [];
            if (!this.stockSucursal) {
                this.errorMsjExistencia.push(
                    "* El stock sucursal no puede estar vacio"
                );
            }
            if (this.errorMsjExistencia.length) {
                this.errorExistencia = 1;
            }
            return this.errorExistencia;
        },
        abrirModal(modelo, accion, data = []) {
            this.selectSucursal();
            this.selectProducto();
            switch (modelo) {
                case "existencia": {
                    switch (accion) {
                        case "actualizar": {
                            this.modal = 1;
                            this.tituloModal = "Actualizar existencia";
                            this.tipoAccion = 1;
                            this.idSucursal = data['idSucursal'];
                            this.idProducto = data['idProducto'];
                            this.stockSucursal = 0;
                            this.existencia_id = data['id'];
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
            this.idSucursal = "";
            this.idProducto = "";
            this.stockSucursal = "";
        }
    },
    mounted() {
        this.listarExistencia(1, "", "existencias.id");
    }
};
</script>
<style>
.modal-content {
    width: 100%;
}
.mostrar {
    display: list-item !important;
    opacity: 1 !important;
    background-color: rgba(0, 0, 0, 0.233);
}
.errores {
    color: red;
}
</style>
