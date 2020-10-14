<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gestión de proveedores</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Gestión de proveedores
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
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="abrirModal('proveedor', 'registrar')"
                    >
                        <i class="fa fa-plus"></i> Registrar
                    </button>
                    <hr />
                </div>
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
                                                <label for=""
                                                    >Nombre proveedor (*)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="nombre"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for=""
                                                    >Dirección (*)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="direccion"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email (*)</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="correo"
                                                />
                                            </div>
                                            <div
                                                v-show="errorProveedor"
                                                class="form-group row errores"
                                            >
                                                <label
                                                    class="text-center"
                                                    v-for="error in errorMsjProveedor"
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
                                        @click="registrarProveedor()"
                                    >
                                        Registrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        v-if="tipoAccion == 2"
                                        @click="actualizarProveedor()"
                                    >
                                        Actualizar
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
                                <option value="nombre">Nombre</option>
                                <option value="correo"
                                    >Correo electronico</option
                                >
                            </select>
                            <input
                                type="text"
                                class="form-control float-right"
                                v-model="buscar"
                                placeholder="Buscar"
                                @keyup.enter="
                                    listarProveedor('1', buscar, criterio)
                                "
                            />

                            <div class="input-group-append">
                                <button
                                    type="submit"
                                    class="btn btn-default"
                                    @click="
                                        listarProveedor('1', buscar, criterio)
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
                                <th style="width: 40px">Opciones</th>
                                <th style="width: 20px">id</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Correo electronico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="proveedor in arrayProveedor"
                                :key="proveedor.id"
                            >
                                <td>
                                    <button
                                        type="button"
                                        class="btn-primary btn-sm"
                                        @click="
                                            abrirModal(
                                                'proveedor',
                                                'actualizar',
                                                proveedor
                                            )
                                        "
                                    >
                                        <i class="fa fa-pen"></i>
                                    </button>
                                </td>
                                <td v-text="proveedor.id"></td>
                                <td v-text="proveedor.nombre"></td>
                                <td v-text="proveedor.direccion"></td>
                                <td v-text="proveedor.correo"></td>
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
            proveedor_id: 0,
            nombre: "",
            direccion: "",
            correo: "",
            celular: 0,
            arrayProveedor: [],
            tituloModal: "",
            tipoAccion: 0,
            modal: 0,
            errorProveedor: 0,
            errorMsjProveedor: [],
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
            me.listarProveedor(page, buscar, criterio);
        },
        listarProveedor(page, buscar, criterio) {
            let me = this;
            var url =
                "/proveedor?page=" +
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
                    me.arrayProveedor = respuesta.proveedores.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        registrarProveedor() {
            if (this.validarProveedor()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .post("/proveedor/registrar", {
                    nombre: this.nombre,
                    direccion: this.direccion,
                    correo: this.correo
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarProveedor(1, "", "id");
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        actualizarProveedor() {
            if (this.validarProveedor()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .put("/proveedor/actualizar", {
                    nombre: this.nombre,
                    direccion: this.direccion,
                    correo: this.correo,
                    id: this.proveedor_id
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarProveedor(1, "", "id");
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        validarProveedor() {
            this.errorProveedor = 0;
            this.errorMsjProveedor = [];
            if (!this.nombre) {
                this.errorMsjProveedor.push(
                    "* El nombre no puede estar vacio."
                    );
            }
            if (!this.direccion) {
                this.errorMsjProveedor.push(
                    "* La dirección no puede estar vacia."
                );
            }
            if (!this.correo) {
                this.errorMsjProveedor.push(
                    "* El correo no puede estar vacio"
                    );
            }
            if (this.errorMsjProveedor.length) {
                this.errorProveedor = 1;
            }
            return this.errorProveedor;
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "proveedor": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registrar sucursal";
                            this.tipoAccion = 1;
                            this.nombre = "";
                            this.direccion = "";
                            this.correo = "";
                            this.celular = 0;
                            break;
                        }
                        case "actualizar": {
                            this.modal = 1;
                            this.tituloModal = "Actualizar sucursal";
                            this.tipoAccion = 2;
                            this.nombre = data["nombre"];
                            this.direccion = data["direccion"];
                            this.proveedor_id = data["id"];
                            this.correo = data["correo"];
                            this.celular = data["celular"];
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
            this.nombre = "";
            this.direccion = "";
        }
    },
    mounted() {
        this.listarProveedor(1, "", "id");
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
