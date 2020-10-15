<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gestión de Productos</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Gestión de Productos
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
                        @click="abrirModal('producto', 'registrar')"
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
                                            <!-- Formulario  -->
                                            <div class="form-group">
                                                <label for=""
                                                    >Proveedor (*)</label
                                                >
                                                <select
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="proveedor"
                                                >
                                                    <option value="0"
                                                        >Seleccione
                                                    </option>
                                                    <option
                                                        v-for="selectProveedor in arrayProveedor"
                                                        :key="
                                                            selectProveedor.id
                                                        "
                                                        :value="
                                                            selectProveedor.id
                                                        "
                                                        v-text="
                                                            selectProveedor.proveedor
                                                        "
                                                    ></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for=""
                                                    >Nombre producto (*)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="nombre"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="">Precio (*)</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder=""
                                                    v-model="precio"
                                                />
                                            </div>
                                            <div
                                                v-show="errorProducto"
                                                class="form-group row errores"
                                            >
                                                <label
                                                    class="text-center"
                                                    v-for="error in errorMsjProducto"
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
                                        @click="registrarProducto()"
                                    >
                                        Registrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        v-if="tipoAccion == 2"
                                        @click="actualizarProducto()"
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
                                <option value="proveedor">Proveedor</option>
                            </select>
                            <input
                                type="text"
                                class="form-control float-right"
                                v-model="buscar"
                                placeholder="Buscar"
                                @keyup.enter="
                                    listarProducto('1', buscar, criterio)
                                "
                            />

                            <div class="input-group-append">
                                <button
                                    type="submit"
                                    class="btn btn-default"
                                    @click="
                                        listarProducto('1', buscar, criterio)
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
                                <th style="width: 100px">Opciones</th>
                                <th style="width: 20px">id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Proveedor</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="producto in arrayProducto"
                                :key="producto.id"
                            >
                                <td>
                                    <button
                                        type="button"
                                        class="btn-primary btn-sm"
                                        @click="
                                            abrirModal(
                                                'producto',
                                                'actualizar',
                                                producto
                                            )
                                        "
                                    >
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button
                                        title="Desactivar proveedor"
                                        v-if="producto.estado"
                                        type="button"
                                        class="btn-danger btn-sm"
                                        @click="desactivarProducto(producto.id)"
                                    >
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                    <button
                                        v-else
                                        title="Activar proveedor"
                                        type="button"
                                        class="btn-success btn-sm"
                                        @click="activarProducto(producto.id)"
                                    >
                                        <i class="fa fa-check-circle"></i>
                                    </button>
                                </td>
                                <td v-text="producto.id"></td>
                                <td v-text="producto.nombre"></td>
                                <td v-text="producto.precio"></td>
                                <td v-text="producto.proveedor"></td>
                                <td v-if="producto.estado">
                                    <span class="badge bg-success">Activo</span>
                                </td>
                                <td v-else>
                                    <span class="badge bg-danger"
                                        >Inactivo</span
                                    >
                                </td>
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
            producto_id: 0,
            nombre: "",
            precio: "",
            proveedor: 0,
            arrayProducto: [],
            tituloModal: "",
            tipoAccion: 0,
            modal: 0,
            errorProducto: 0,
            errorMsjProducto: [],
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
            buscar: "",
            arrayProveedor: [],
            arrayIva: []
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
            me.listarProducto(page, buscar, criterio);
        },
        listarProducto(page, buscar, criterio) {
            let me = this;
            var url =
                "/producto?page=" +
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
                    me.arrayProducto = respuesta.productos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        selectProveedor() {
            let me = this;
            var url = "/producto/selectProveedor";
            // Make a request for a user with a given ID
            axios
                .get(url)
                .then(function(response) {
                    // handle success
                    var respuesta = response.data;
                    me.arrayProveedor = respuesta;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        registrarProducto() {
            if (this.validarProducto()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .post("/producto/registrar", {
                    nombre: this.nombre,
                    precio: this.precio,
                    idProveedor: this.proveedor
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarProducto(1, "", "id");
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        actualizarProducto() {
            if (this.validarProducto()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .put("/producto/actualizar", {
                    nombre: this.nombre,
                    precio: this.precio,
                    idProveedor: this.proveedor,
                    id: this.producto_id
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarProducto(1, "", "id");
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        activarProducto(id) {
            let me = this;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons
                .fire({
                    title: "¿Desea activar este proveedor?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Sí, seguro",
                    cancelButtonText: "No, cancelar",
                    reverseButtons: true
                })
                .then(result => {
                    if (result.isConfirmed) {
                        axios
                            .put("/producto/activar", {
                                id: id
                            })
                            .then(function(response) {
                                // handle success
                                me.cerrarModal();
                                me.listarProducto(1, "", "id");
                            })
                            .catch(function(error) {
                                // handle error
                                console.log(error);
                            });
                        swalWithBootstrapButtons.fire("Activado!");
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                });
        },
        desactivarProducto(id) {
            let me = this;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons
                .fire({
                    title: "¿Desea desactivar este proveedor?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Sí, seguro",
                    cancelButtonText: "No, cancelar",
                    reverseButtons: true
                })
                .then(result => {
                    if (result.isConfirmed) {
                        axios
                            .put("/producto/desactivar", {
                                id: id
                            })
                            .then(function(response) {
                                // handle success
                                me.cerrarModal();
                                me.listarProducto(1, "", "id");
                            })
                            .catch(function(error) {
                                // handle error
                                console.log(error);
                            });
                        swalWithBootstrapButtons.fire("Desactivada!");
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                });
        },
        validarProducto() {
            this.errorProducto = 0;
            this.errorMsjProducto = [];
            if (!this.nombre) {
                this.errorMsjProducto.push("* El nombre no puede estar vacio.");
            }
            if (!this.precio) {
                this.errorMsjProducto.push("* El precio no puede estar vacio.");
            }
            if (this.proveedor == 0) {
                this.errorMsjProducto.push("* Debe seleccionar un proveedor");
            }
            if (this.errorMsjProducto.length) {
                this.errorProducto = 1;
            }
            return this.errorProducto;
        },
        abrirModal(modelo, accion, data = []) {
            this.selectProveedor();
            switch (modelo) {
                case "producto": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registrar producto";
                            this.tipoAccion = 1;
                            this.nombre = "";
                            this.precio = "";
                            this.proveedor = "0";
                            break;
                        }
                        case "actualizar": {
                            this.modal = 1;
                            this.tituloModal = "Actualizar producto";
                            this.tipoAccion = 2;
                            this.nombre = data["nombre"];
                            this.precio = data["precio"];
                            this.proveedor = data["idProveedor"];
                            this.producto_id = data['id'];
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
            this.precio = "";
            this.proveedor = "0";
        }
    },
    mounted() {
        this.listarProducto(1, "", "id");
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
