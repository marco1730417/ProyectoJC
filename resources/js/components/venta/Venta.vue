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
                  <div class="row"></div>

                  <div class="row">
                    <div class="col">
                      <h5
                        v-if="!modeupdate"
                        class="card-title text-uppercase text-muted mb-0"
                      >
                        Elija un cliente
                        <v-select
                          :disabled="venId > 0"
                          label="nombre"
                          v-model="cliente"
                          :options="infocliente"
                          required
                        ></v-select>
                      </h5>
                      <h5
                        v-if="modeupdate"
                        class="card-title text-uppercase text-muted mb-0"
                      >
                        Elija un cliente
                        <v-select
                          label="nombre"
                          v-model="clienteupdate"
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
                  <button
                    v-if="venId && !camposactivos"
                    class="btn btn-primary btn-sm btn-block"
                    @click="updateVenta"
                  >
                    Cambiar datos
                  </button>
                  <button
                    v-if="modeupdate && camposactivos"
                    class="btn btn-primary btn-sm btn-block"
                    @click="actualizarVenta"
                  >
                    Actualizar
                  </button>

                  <!--     <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"> {{ cliente.email }} </span>
                    <span class="text-nowrap"> {{ cliente.direccion }} </span>
                  </p> -->
                </div>
              </div>
            </div>

            <div v-if="venId > 0" class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Total Venta
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        {{ parseFloat(totalesventa.total).toFixed(2) }}
                      </span>
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
                      ><i class="fas fa-user"></i> {{ cliente.nombre }}
                    </span>
                    <span class="text-nowrap">{{ fecha }}</span>
                  </p>
                </div>
              </div>

              <br />

              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Notas
                      </h5>
                      <div>
                        <b-form-textarea
                          id="textarea"
                          v-model="observacion"
                          placeholder="Enter something..."
                          rows="3"
                          max-rows="6"
                        ></b-form-textarea>
                      </div>
                    </div>
                    <div class="col-auto">
                      <b-button
                        @click="updateObservacion(observacion)"
                        size="sm"
                        variant="success"
                        >Guardar</b-button
                      >
                    </div>
                  </div>
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

            <!-- modal venta al contado -->

            <div
              class="modal fade"
              id="ModalVentaContado"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Terminar venta al contado</h5>
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
                    <div class="container d-lg-flex">
                      <div class="box-2">
                        <div class="box-inner-2">
                          <form action="">
                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">Cantidad recibida</p>
                              <input
                                  @keypress="onlyNumber"
                        
                                class="form-control"
                                type="number"
                                v-model="pagorecibido"
                              />
                            </div>
                            <div>
                              <div class="address">
                                <div class="d-flex flex-column dis">
                                  <div
                                    class="
                                      d-flex
                                      align-items-center
                                      justify-content-between
                                      mb-2
                                    "
                                  >
                                    <p>Total</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span>
                                      {{
                                        parseFloat(totalesventa.total).toFixed(
                                          2
                                        )
                                      }}
                                    </p>
                                  </div>
                                  <div
                                    class="
                                      d-flex
                                      align-items-center
                                      justify-content-between
                                      mb-2
                                    "
                                  >
                                    <p>Pago</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span
                                      >{{ pagorecibido }}
                                    </p>
                                  </div>
                                  <div
                                    class="
                                      d-flex
                                      align-items-center
                                      justify-content-between
                                      mb-2
                                    "
                                  >
                                    <p class="fw-bold">Cambio</p>
                                    <p class="fw-bold">
                                      <span class="fas fa-dollar-sign"></span
                                      >{{ parseFloat(total_cambio).toFixed(2) }}
                                    </p>
                                  </div>
                                  <div
                                    v-if="pagorecibido"
                                    @click="
                                      downloadVentaContado(
                                        pagorecibido,
                                        total_cambio,
                                        cliente.id
                                      )
                                    "
                                    class="btn btn-primary mt-2"
                                  >
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                  <div v-else class="btn btn-primary mt-2">
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <!-- modal venta al contado -->

            <!-- modal venta transferencia -->

            <div
              class="modal fade"
              id="ModalVentaTransferencia"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">
                      Terminar venta como transferencia
                    </h5>
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
                    <div class="container d-lg-flex">
                      <div class="box-2">
                        <div class="box-inner-2">
                          <form action="">
                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">Cantidad recibida</p>
                              <input
                                  @keypress="onlyNumber"
                        
                                class="form-control"
                                type="number"
                                v-model="pagorecibidotransferencia"
                              />
                            </div>
                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">
                                Detalle de transferencia
                              </p>
                              <input
                                class="form-control"
                                v-model="detalletransferencia"
                                type="text"
                              />
                            </div>
                            <div>
                              <div class="address">
                                <div class="d-flex flex-column dis">
                                  <div
                                    class="
                                      d-flex
                                      align-items-center
                                      justify-content-between
                                      mb-2
                                    "
                                  >
                                    <p>Total</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span>
                                      {{
                                        parseFloat(totalesventa.total).toFixed(
                                          2
                                        )
                                      }}
                                    </p>
                                  </div>
                                  <div
                                    class="
                                      d-flex
                                      align-items-center
                                      justify-content-between
                                      mb-2
                                    "
                                  >
                                    <p>Pago</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span
                                      >{{ pagorecibidotransferencia }}
                                    </p>
                                  </div>

                                  <div
                                    v-if="pagorecibidotransferencia"
                                    @click="
                                      downloadVentaTransferencia(
                                        pagorecibidotransferencia,
                                        detalletransferencia,
                                        cliente.id
                                      )
                                    "
                                    class="btn btn-primary mt-2"
                                  >
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                  <div v-else class="btn btn-primary mt-2">
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <!-- modal venta al transferencia -->

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
                    <td>
                      {{ parseFloat(item.precioUnitario).toFixed(2) }}
                    </td>

                    <td>
                      {{ parseFloat(item.subTotal).toFixed(2) }}
                    </td>
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
                              {{ parseFloat(totalesventa.subtotal).toFixed(2) }}
                            </td>
                          </tr>
                          <tr>
                            <td>Iva ({{ totalesventa.iva }})</td>
                            <td>
                              {{ parseFloat(totalesventa.valorIva).toFixed(2) }}
                            </td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>
                              {{ parseFloat(totalesventa.total).toFixed(2) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </b-row>
                </b-col>
              </b-row>
            </b-container>

            <div class="row">
              <div class="col-xl-12 col-lg-12 pull-right">
                <br />

                <div @mouseover="onOver" @mouseleave="onLeave">
                  <b-dropdown
                    id="dropdown-1"
                    text="Continuar"
                    ref="dropdown"
                    class="m-md-2"
                  >
                    <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalVentaContado"
                      ><i class="fas fa-dollar-sign"></i> Al
                      contado</b-dropdown-item
                    >
                    <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalVentaTransferencia"
                      ><i class="fas fa-wallet"></i
                      >Transferencia</b-dropdown-item
                    >

                    <b-dropdown-item @click="deleteVenta"
                      ><i class="fas fa-ban"></i>Cancelar Venta</b-dropdown-item
                    >
                  </b-dropdown>
                </div>
              </div>
            </div>

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
  props: ["venId"],
  data() {
    return {
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      modeupdate: false,
      clienteupdate: "",
      formadepagoupdate: "",
      infocliente: [],
      loading: false,
      infoeditcliente: [],
      camposactivos: false,
      totalesventa: [],
      detalleventa: [],
      detallegeneralventa: [],
      pagorecibido: "",
      pagorecibidotransferencia: "",
      detalletransferencia: "",
      filter: null,
      formadepago: "",
 
    };
  },
  computed: {
    total_cambio: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      let total = this.totalesventa.total;
      let pagorecibido = this.pagorecibido;
      let tt = pagorecibido - total;

      return tt;
    },
  },
  created(){
  

  },
  mounted() {
    this.getAllClientes();
    this.getInformacionVenta();
    this.totalesVenta();
    /* function to detect if localstorage is supported*/
   /*  if (localStorage.getItem('VentaId'))  {
   this.venId=localStorage.getItem('VentaId');

   }
    localStorage.removeItem('VentaId') */

    //refactorizar por que actualmente al momento de crear una venta se almacena en el local storage un venId. en caso que 
    // se recargue la pagina mantiene el venId . pero para una 2 recarga se pierde el valo


  },
  methods: {
      onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
    },
    updateDatos() {
      this.getInformacionVenta();
      this.totalesVenta();
    },
    onOver() {
      this.$refs.dropdown.visible = true;
    },
    onLeave() {
      this.$refs.dropdown.visible = false;
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

    deleteVenta() {
      this.$swal
        .fire({
          title: "Estas seguro de cancelar esta venta?",
          showCancelButton: true,
          confirmButtonText: "Save",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            VentaServices.deleteVenta(this.venId)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {
                  window.location.href = "../venta/";
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
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
    downloadVentaContado(pago, vuelto, cliId) {
      let data = {
        venId: this.venId,
        total: this.totalesventa.total,
        pago: pago,
        vuelto: vuelto,
        cliId: cliId,
      };
      VentaServices.registrarPagoContado(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.detalleVenta();
            this.totalDashboardVentas();
          }
        })
        .catch((error) => {
          console.log(error);
        });

      let routeData = server + resource + `download-venta/` + this.venId;
      window.open(routeData);
    },

    downloadVentaTransferencia(pago, detalle, cliId) {
      let data = {
        venId: this.venId,
        total: this.totalesventa.total,
        pago: pago,
        numtransf: detalle,
        cliId: cliId,
      };
      VentaServices.registrarPagoTransferencia(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.detalleVenta();
            this.totalDashboardVentas();
          }
        })
        .catch((error) => {
          console.log(error);
        });

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
    updateObservacion(texto) {
      let data = {
        id: this.venId,
        observacion: texto,
      };
      VentaServices.updateObservacion(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.detalleVenta();
            this.totalDashboardVentas();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    createVenta() {
      let data = {
        cliId: this.cliente["id"],
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

    updateVenta() {
      this.modeupdate = true;
      this.camposactivos = true;
    },

    actualizarVenta() {
      let data = {
        cliId: this.clienteupdate["id"],
        metodopago: this.formadepagoupdate,
        venId: this.venId,
      };

      VentaServices.updateVenta(data)
        .then((response) => {
          let mensaje = response.data.data;

          this.modeupdate = false;
          this.camposactivos = false;
          this.cliente = this.clienteupdate;
          this.formadepago = this.formadepagoupdate;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>


