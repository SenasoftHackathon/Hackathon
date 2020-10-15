<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gestión de Facturación</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Gestión de Facturación
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
            <!--ESTILO FACTURACION-->
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Facturas
                <button
                    type="button"
                    @click="mostrarDetalle()"
                    class="btn btn-secondary"
                >
                    <i class="icon-plus"></i>&nbsp;Nueva Factura
                </button>
            </div>
            <!-- Listado-->
            <template v-if="listado == 1">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha Hora</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="factura in arrayFactura"
                                :key="factura.id"
                            >
                                <td v-text="factura.name"></td>
                                <td v-text="factura.fechaCreacion"></td>
                                <td v-text="factura.total"></td>
                                <td v-text="factura.estado"></td>
                                <td>
                                    <button
                                        type="button"
                                        @click="verFactura(factura.id)"
                                        class="btn btn-success btn-sm"
                                    >
                                        Detallar Factura
                                    </button>
                                    &nbsp;
                                    <template
                                        v-if="factura.estado == 'Facturado'"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            @click="
                                                desactivarFactura(factura.id)
                                            "
                                        >
                                            Desactivar
                                        </button>
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
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
            </template>

            <!-- Ver ingreso -->
            <template v-if="listado == 2">
                <div class="card-body">
                    <div class="form-group row border">
                        <div class="col-md-3">
                            <label for="">Id</label>
                            <p v-text="idFactura"></p>
                        </div>
                    </div>
                    <div class="form-group row border">
                        <div class="table-responsive col-md-12">
                            <table
                                class="table table-bordered table-striped table-sm"
                            >
                                <thead>
                                    <tr>
                                        <th>Prducto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody v-if="arrayDetalle.length">
                                    <tr
                                        v-for="detalle in arrayDetalle"
                                        :key="detalle.id"
                                    >
                                        <td v-text="detalle.producto"></td>
                                        <td v-text="detalle.precio"></td>
                                        <td v-text="detalle.cantidad"></td>
                                        <td>
                                            {{
                                                detalle.precio *
                                                    detalle.cantidad
                                            }}
                                        </td>
                                    </tr>
                                    <!--<tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Parcial:</strong></td>
                                            <td>$ {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>$ {{totalImpuesto=((total*impuesto)).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{total}}</td>
                                        </tr>
                                        -->
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="5">
                                            NO hay productos agregados
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button
                                type="button"
                                @click="ocultarDetalle()"
                                class="btn btn-secondary"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </template>
            <!-- fin ver ingreso -->

            <template v-else-if="listado == 0">
                <div class="card-body">
                    <div class="form-group row border">
                        <div class="col-md-12">
                            <div
                                v-show="errorFactura"
                                class="form-group row div-error"
                            >
                                <div class="text-center text-error">
                                    <div
                                        v-for="error in errorMsjFactura"
                                        :key="error"
                                        v-text="error"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row border">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label
                                >Producto
                                <span
                                    style="color:red;"
                                    v-show="idProducto == 0"
                                    >(*Seleccione)</span
                                ></label
                            >
                            <div class="form-inline">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="nombreProducto"
                                    @keyup.enter="buscarProducto()"
                                    placeholder="Ingrese producto"
                                />
                                <input
                                    type="text"
                                    readonly
                                    class="form-control"
                                    v-model="idProducto"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label
                                >Cantidad
                                <span style="color:red;" v-show="cantidad == 0"
                                    >(*Ingrese)</span
                                ></label
                            >
                            <input
                                type="number"
                                value="0"
                                class="form-control"
                                v-model="cantidad"
                            />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button
                                @click="agregarDetalle()"
                                class="btn btn-success form-control btnagregar"
                            >
                                Agregar
                            </button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="registrarFactura()"
                            >
                                Registrar Venta
                            </button>
                        </div>
                    </div>

                    <div class="form-group row border">
                        <div class="table-responsive col-md-12">
                            <table
                                class="table table-bordered table-striped table-sm"
                            >
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody v-if="arrayDetalle.length">
                                    <tr
                                        v-for="(detalle, index) in arrayDetalle"
                                        :key="detalle.id"
                                    >
                                        <td>
                                            <button
                                                @click="eliminarDetalle(index)"
                                                type="button"
                                                class="btn btn-danger btn-sm"
                                            >
                                                <i class="icon-close"></i>
                                            </button>
                                        </td>
                                        <td v-text="detalle.producto"></td>
                                        <td>
                                            <input
                                                v-model="detalle.precio"
                                                type="number"
                                                class="form-control"
                                            />
                                        </td>
                                        <td>
                                            <span
                                                style="color:red;"
                                                v-show="
                                                    detalle.cantidad >
                                                        detalle.stock
                                                "
                                                >Stock:
                                                {{ detalle.stock }}</span
                                            >
                                            <input
                                                v-model="detalle.cantidad"
                                                type="number"
                                                class="form-control"
                                            />
                                        </td>
                                        <td>
                                            {{
                                                detalle.precio *
                                                    detalle.cantidad
                                            }}
                                        </td>
                                    </tr>
                                    <!--
                        <tr style="background-color: #CEECF5;">
                            <td colspan="5" align="right"><strong>Total Parcial:</strong></td>
                            <td>$ {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                        </tr>
                        <tr style="background-color: #CEECF5;">
                            <td colspan="5" align="right"><strong>Total Impuesto:</strong></td>
                            <td>$ {{totalImpuesto=((total*impuesto)/(1+impuesto)).toFixed(2)}}</td>
                        </tr>
                        <tr style="background-color: #CEECF5;">
                            <td colspan="5" align="right"><strong>Total Neto:</strong></td>
                            <td>$ {{total=calcularTotal}}</td>
                        </tr>
                        -->
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="6">
                                            No hay productos agregados
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </template>

            <!--FIN ESTILO FACTURACION-->
        </div>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    props: ["ruta"],
    data() {
        return {
            idFactura: 0,
            idUsuario: 0,
            idProducto: 0,
            codigo: 0,
            fechaCreacion: 0,
            arrayFactura: [],
            arrayProducto: [],
            arrayDetalle: [],
            nombreProducto: "",
            precio: 0,
            cantidad: 0,
            stock: 0,
            stockSucursal: 0,
            total: 0,
            listado: 1,
            //tituloModal: "",
            //tipoAccion: 0,
            //modal: 0,
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
                "/facturacion?page=" +
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
        buscarProducto() {
            let me = this;
            var url =
                "/producto/buscarProductoFactura?filtro=" + me.nombreProducto;

            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    me.arrayProducto = respuesta.productos;

                    if (me.arrayProducto.length > 0) {
                        me.nombreProducto = me.arrayProducto[0]["nombre"];
                        me.idProducto = me.arrayProducto[0]["id"];
                        me.precio = me.arrayProducto[0]["precio"];
                        me.stock = me.arrayProducto[0]["stockTienda"];
                    } else {
                        me.nombreProducto = "No existe producto";
                        me.idProducto = 0;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        agregarDetalle() {
            let me = this;
            if (me.idProducto == 0 || me.cantidad == 0 || me.precio == 0) {
            } else {
                if (me.encuentra(me.idProducto)) {
                    swal({
                        type: "error",
                        title: "Error...",
                        text: "Ese Producto ya se encuentra agregado!"
                    });
                } else {
                    if (me.cantidad > me.stock) {
                        swal({
                            type: "error",
                            title: "Error...",
                            text: "NO hay stock disponible!"
                        });
                    } else {
                        me.arrayDetalle.push({
                            idproducto: me.idProducto,
                            name: me.name,
                            cantidad: me.cantidad,
                            precio: me.precio,
                            stock: me.stock
                        });
                        me.codigo = "";
                        me.idProducto = 0;
                        me.name = "";
                        me.cantidad = 0;
                        me.precio = 0;
                        me.stock = 0;
                    }
                }
            }
        },
        encuentra(id) {
            var sw = 0;
            for (var i = 0; i < this.arrayDetalle.length; i++) {
                if (this.arrayDetalle[i].idProducto == id) {
                    sw = true;
                }
            }
            return sw;
        },
        registrarFactura() {
            if (this.validarFactura()) {
                return;
            }
            let me = this;
            // Make a request for a user with a given ID
            axios
                .post("/facturacion/registrar", {
                    idUsuario: this.idUsuario,
                    fechaCreacion: this.fechaCreacion
                })
                .then(function(response) {
                    // handle success
                    me.listado = 1;
                    me.listarFactura(1, "", "id");
                    me.idUsuario = 0;
                    me.total = 0.0;
                    me.idProducto = 0;
                    me.name = "";
                    me.cantidad = 0;
                    me.precio = 0;
                    me.stock = 0;
                    me.codigo = "";
                    me.arrayDetalle = [];
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        verFactura(id) {
            let me = this;
            me.listado = 2;

            //Obtener los datos del ingreso
            var arrayFacturaT = [];
            var url = "/facturacion/obtenerEncabezado?id=" + id;

            axios
                .get(url)
                .then(function(response) {
                    var respuesta = response.data;
                    arrayFacturaT = respuesta.factura;

                    me.idFactura = arrayFacturaT[0]["id"];
                    me.usuario = arrayFacturaT[0]["usuario"];
                    me.total = arrayFacturaT[0]["total"];
                })
                .catch(function(error) {
                    console.log(error);
                });
            //Obtener los datos de los detalles
            var url = "/facturacion/obtenerDetalles?id=" + id;

            axios
                .get(urld)
                .then(function(response) {
                    console.log(response);
                    var respuesta = response.data;
                    me.arrayDetalle = respuesta.detalles;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        ocultarDetalle() {
            this.listado = 1;
        },
        mostrarDetalle() {
            let me = this;
            me.listado = 0;
            me.idProducto = 0;
            me.name = "";
            me.cantidad = 0;
            me.precio = 0;
            me.iva = 0.2;
            me.total = 0.0;
            me.arrayDetalle = [];
        },

        validarFactura() {
            this.errorFactura = 0;
            this.errorMsjFactura = [];
            if (!this.idUsuario) {
                this.errorMsjFactura.push("El Usuario no puede estar vacio.");
            }
            if (this.errorMsjFactura.length) {
                this.errorFactura = 1;
            }
            return this.errorFactura;
        },
        validarVenta() {
            let me = this;
            me.errorFactura = 0;
            me.errorMsjFactura = [];
            var art;
            me.arrayDetalle.map(function(x) {
                if (x.cantidad > x.stock) {
                    art = x.idProducto + " con stock insuficiente";
                    me.errorMsjFactura.push(art);
                }
            });

            if (me.arrayDetalle.length <= 0)
                me.errorMsjFactura.push("Ingrese detalles");

            if (me.errorMsjFactura.length) me.errorFactura = 1;
            return me.errorFactura;
        }
        /*
        abrirModal(modelo, accion) {
            switch (modelo) {
                case "factura": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registrar IVA";
                            this.tipoAccion = 1;
                            this.idUsuario = "";
                            this.fechaCreacion = "";
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
            this.idUsuario = "";
            this.fechaCreacion = "";
        }
        */
    },
    mounted() {
        this.listarFactura(1, "", "id");
    }
};
</script>
