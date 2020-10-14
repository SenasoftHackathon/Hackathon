<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gestión de sucursal</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Gestión de sucursal
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
                <div class="row">
                    <div class="col-md-4">
                        <!-- Button trigger modal -->
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="abrirModal('sucursal', 'registrar')"
                        >
                            Registrar
                        </button>
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
                                                        >Nombre sucursal
                                                        (*)</label
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
                                                <div v-show="errorSucursal" class="form-group row errores">
                                                    <div class="text-center"
                                                    v-for="error in errorMsjSucursal" :key="error" v-text="error"
                                                    >
                                                    </div>
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
                                            @click="registrarSucursal()"
                                        >
                                            Registrar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            v-if="tipoAccion == 2"
                                            @click="actualizarSucursal()"
                                        >
                                            Actualizar
                                        </button>
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
                                <th>Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="sucursal in arraySucursal"
                                :key="sucursal.id"
                            >
                                <td>
                                    <button
                                        type="button"
                                        class="btn-primary btn-sm"
                                        data-toggle="modal"
                                        data-target="#exampleModal"
                                    >
                                        Editar
                                    </button>
                                </td>
                                <td v-text="sucursal.id"></td>
                                <td v-text="sucursal.nombre"></td>
                                <td v-text="sucursal.direccion"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->
</template>

<script>
export default {
    data() {
        return {
            sucursal_id: 0,
            nombre: "",
            direccion: "",
            arraySucursal: [],
            tituloModal: "",
            tipoAccion: 0,
            modal: 0,
            errorSucursal: 0,
            errorMsjSucursal: []
        };
    },
    methods: {
        listarSucursal() {
            let me = this;
            // Make a request for a user with a given ID
            axios
                .get("/sucursal")
                .then(function(response) {
                    // handle success
                    me.arraySucursal = response.data;
                    return me.arraySucursal;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        registrarSucursal() {
            if(this.validarSucursal()){
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .post("/sucursal/registrar", {
                    nombre: this.nombre,
                    direccion: this.direccion
                })
                .then(function(response) {
                    // handle success
                    me.cerrarModal();
                    me.listarSucursal();
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        validarSucursal(){
            this.errorSucursal = 0;
            this.errorMsjSucursal = [];
            if (!this.nombre) {
                this.errorMsjSucursal.push('El nombre no puede estar vacio.');
            }
            if (!this.direccion) {
                this.errorMsjSucursal.push('La dirección no puede estar vacia.');
            }
            if (this.errorMsjSucursal.length) {
                this.errorSucursal = 1;
            }
            return this.errorSucursal;
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "sucursal": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registrar sucursal";
                            this.tipoAccion = 1;
                            this.nombre = "";
                            this.direccion = "";
                            break;
                        }
                        case "actualizar": {
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
        this.listarSucursal();
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
</style>
