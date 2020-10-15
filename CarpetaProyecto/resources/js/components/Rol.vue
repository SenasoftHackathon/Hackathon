<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Roles</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Roles
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
                                <option value="nombreRol">Rol</option>
                            </select>
                            <input
                                type="text"
                                class="form-control float-right"
                                v-model="buscar"
                                placeholder="Buscar"
                                @keyup.enter="listarRol('1', buscar, criterio)"
                            />

                            <div class="input-group-append">
                                <button
                                    type="submit"
                                    class="btn btn-default"
                                    @click="listarRol('1', buscar, criterio)"
                                >
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped col-md-10">
                        <thead>
                            <tr>
                                <th style="width: 20px">Id</th>
                                <th>Rol</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rol in arrayRol" :key="rol.id">
                                <td v-text="rol.id"></td>
                                <td v-text="rol.nombreRol"></td>
                                <td v-text="rol.descripcion"></td>
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
            arrayRol: [],
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
            me.listarRol(page, buscar, criterio);
        },
        listarRol(page, buscar, criterio) {
            let me = this;
            var url =
                "/rol?page=" +
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
                    me.arrayRol = respuesta.roles.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }
    },
    mounted() {
        this.listarRol(1, "", "id");
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
.errores{
    color: red;
}
</style>
