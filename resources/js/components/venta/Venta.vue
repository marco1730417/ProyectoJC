<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Elija un metodo de pago
                      </h5>
                      <b-form-group>
                        <b-form-radio
                          v-model="formadepago"
                          name="some-radios"
                          value="Efectivo"
                          >Efectivo</b-form-radio
                        >
                        <b-form-radio
                          v-model="formadepago"
                          name="some-radios"
                          value="Transferencia"
                          >Transferencia</b-form-radio
                        >

                        <!--       <p>  {{formadepago}} </p> -->
                      </b-form-group>
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-danger
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-wallet"></i>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Elija un cliente
                        <v-select
                          label="nombre"
                          v-model="cliente"
                          :options="infocliente"
                          required
                        ></v-select>
                      </h5>
                      <!--        <span class="h2 font-weight-bold mb-0"
                        >{{ cliente.nombre }}
                      </span> -->
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-danger
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                  </div>
                  <br /><br />
                  <button
                    v-if="!venId"
                    class="btn btn-primary btn-md btn-block"
                    @click="createVenta"
                  >
                    Continuar
                  </button>

                  <!--     <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"> {{ cliente.email }} </span>
                    <span class="text-nowrap"> {{ cliente.direccion }} </span>
                  </p> -->
                </div>
              </div>
            </div>


      <div  v-if="venId>0" class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Total Venta
                      </h5>
                      <span class="h2 font-weight-bold mb-0">   {{ totalesventa.total }}</span>
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-yellow
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"
                      ><i class="fas fa-user"></i>  {{cliente.nombre}} </span
                    >
                    <span class="text-nowrap">{{fecha}}</span>
                  </p> <br/>
                        <button
                    class="btn btn-primary btn-sm btn-block"
                    @click="downloadVenta"
                  >
                    Imprimir venta
                  </button>
                     <button
                    class="btn btn-danger btn-sm btn-block"
                  >
                    Cancelar venta
                  </button>
                </div>
              </div>

            </div>


          </div>
        </div>
      </div>
    </div>

    <!-- 
{{venId}} -->

    <div v-if="venId > 0" class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Venta</h3>
                </div>
                <div class="col-4 text-right">
                  <a
                    href=""
                    class="btn btn-sm btn-primary"
                    data-toggle="modal"
                    data-target="#ModalVentaProducto"
                    ><i class="fas fa-search"></i>Buscar Productos</a
                  >

                  <div
                    class="modal fade"
                    id="ModalVentaProducto"
                    tabindex="-1"
                    role="dialog"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <!--      <h5 class="modal-title"> Cliente {{cliente.nombre}} - Fecha {{fecha}}  </h5> -->
                          <h5 class="modal-title">Nuevo Item</h5>
                          <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                          >
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <modal-venta-producto
                            @updateVenta="updateDatos"
                            :venta="venId"
                          />
                        </div>
                        <div class="modal-footer"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12"></div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">SubTotal</th>

                    <th scope="col">Accion</th>
                  </tr>
                </thead>

                <!--  {{detalleventa}}  -->
                <tbody>
                  <tr v-for="item in detalleventa">
                    <td>{{ item.nombre }}</td>
                    <td>{{ item.descripcion }}</td>
                    <td>{{ item.cantidad }}</td>
                    <td>{{ item.precioUnitario }}</td>
                    <td>{{ item.subTotal }}</td>
                    <td class="text-center">
                      <a
                        class="btn btn-sm btn-icon-only text-light"
                        href="#"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-trash"
                          @click="deleteDetalleVenta(item.id)"
                        ></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <b-container class="bv-example-row">
              <b-row>
                <b-col></b-col>
                <b-col></b-col>
                <b-col>
                  <b-row class="pull-right">
                    <div class="pull-right">
                      <table class="table">
                        <thead class="thead-dark"></thead>
                        <tbody>
                          <tr>
                            <td>SubTotal</td>
                            <td>
                              {{ totalesventa.subtotal }}
                            </td>
                          </tr>
                          <tr>
                            <td>Iva ({{ totalesventa.iva }})</td>
                            <td>
                              {{ totalesventa.valorIva }}
                            </td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>
                              {{ totalesventa.total }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </b-row>
                </b-col>
              </b-row>
           
            </b-container>
            

            

            <!--  {{totalesventa}} -->

            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="..."></nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import VentaServices from "../../services/ventaServices";
import ClienteServices from "../../services/clienteServices";
import Conf from "../../services/conf.js";

const resource = "api/venta/";
const server = Conf.server;
import moment from "moment";
import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";

Vue.use(BootstrapVue);
export default {
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      fecha: moment().format("MMMM Do YYYY, h:mm:ss a"),
      cliente: "",
      infocliente: [],
      loading: false,
      infoeditcliente: [],
      totalesventa: [],
      detalleventa: [],
      detallegeneralventa: [],

      filter: null,
      formadepago: "",
      venId: "",
    };
  },

  mounted() {
    this.getAllClientes();
    this.getInformacionVenta();
  },
  methods: {
    updateDatos() {
      this.getInformacionVenta();
      this.totalesVenta();
    },

    deleteDetalleVenta(id) {
      VentaServices.deleteDetalleVenta(id)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.getInformacionVenta();
            this.totalesVenta();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getAllClientes() {
      ClienteServices.getAllClientes()
        .then((response) => {
          this.infocliente = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getInformacionVenta() {
      VentaServices.getInformacionVenta(this.venId)
        .then((response) => {
          this.detalleventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    detalleGeneralVenta() {
      VentaServices.detalleGeneralVenta(this.venId)
        .then((response) => {
          this.detallegeneralventa = response.data.data;
          this.detallegeneralventa = this.detallegeneralventa.shift();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    downloadVenta() {
      let routeData = server + resource + `download-venta/` + this.venId;
      window.open(routeData);
    },
    totalesVenta() {
      VentaServices.totalesVenta(this.venId)
        .then((response) => {
          this.totalesventa = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    createVenta() {
      let data = {
        cliId: this.cliente["id"],
        metodopago: this.formadepago,
      };

      VentaServices.createVenta(data)
        .then((response) => {
          let mensaje = response.data.data;

          this.venId = mensaje;
          this.totalesVenta();
          this.detalleGeneralVenta();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
