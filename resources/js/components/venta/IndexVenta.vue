<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Ventas Totales
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        $ {{ parseFloat(totalventas.subtotal).toFixed(2) }}
                      </span>
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
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Clientes activos
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        {{ totalventas.cliente }}</span
                      >
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-warning
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Venta</h3>
                </div>
                <div class="col-8">
                  <b-form-input
                    style="
                      height: calc(1.3em + 0.5rem + 2px);
                      font-size: 0.75rem;
                    "
                    class="float-right"
                    id="filter-input"
                    v-model="filter"
                    type="search"
                    size="sm"
                    placeholder="Buscar Venta"
                  ></b-form-input>
                </div>
                <div class="col-4">
                  <button
                    class="btn btn-primary btn-sm"
                    @click="gotoNuevaVenta()"
                  >
                    <i class="fas fa-shopping-cart"></i> NUEVA VENTA
                  </button>
                  <button
                    class="btn btn-info btn-sm"
                    title="Recargar"
                    @click="detalleVenta"
                  >
                    <i class="fas fa-sync"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="col-12"></div>

            <div class="table-responsive">
              <b-table
                :items="detalleventa"
                :fields="fields1"
                :filter="filter"
                show-empty
                responsive="sm"
                :per-page="perPage"
                :current-page="currentPage"
              >
                <template #cell(fecha)="data">
                  {{
                    moment(data.item.fecha).format(
                      "MMM DD YYYY, ddd, h:mm:ss a"
                    )
                  }}
                </template>
                <template #cell(nombre)="data">
                  <div v-if="data.item.nombre" class="left" id="center">
                    <small> {{ data.item.nombre }}<br /></small>
                    <small> {{ data.item.ruc }}</small>
                  </div>
                  <div v-else class="left" id="center">
                    <small> N/A </small><br />
                  </div>
                </template>

                <template #cell(total)="data">
                  <span v-if="data.item.total">
                    $ {{ parseFloat(data.item.total).toFixed(2) }}
                  </span>
                  <span v-else> Pago no registrado</span>
                </template>

                <template #cell(actions)="data">
                  <div>
                    <b-dropdown size="sm" text="Acciones" class="m-2">
                      <b-dropdown-item-button
                        variant="success"
                        @click="gotoEditVenta(data.item.id)"
                      >
                        <i class="fas fa-arrow-circle-right"></i>
                        Venta</b-dropdown-item-button
                      >
                      <b-dropdown-item-button
                        @click="downloadVenta(data.item.id)"
                      >
                        <i class="fas fa-print" title="Descargar"></i>
                        Descargar</b-dropdown-item-button
                      >
                      <b-dropdown-item-button
                        variant="info"
                        v-if="data.item.pagoabonos > 0"
                        data-toggle="modal"
                        data-target="#ModalAbonos"
                        @click="obtenerabonos(data.item.id)"
                      >
                        <i class="fas fa-balance-scale" title="Abonos"></i>
                        Registrar Abono</b-dropdown-item-button
                      >
                      <b-dropdown-item-button
                        variant="warning"
                        v-if="data.item.pagoabonoscreditos > 0"
                        data-toggle="modal"
                        data-target="#ModalCreditos"
                        @click="obtenerabonoscreditos(data.item.id)"
                        ><i class="fas fa-wallet" title="Creditos"></i>Registrar
                        Crédito</b-dropdown-item-button
                      >
                      <b-dropdown-item-button
                        variant="primary"
                        data-toggle="modal"
                        data-target="#ModalPagos"
                        @click="obtenerpagos(data.item.id)"
                        ><i class="fas fa-dollar-sign" title="Pagos"></i
                        >Historial Pagos</b-dropdown-item-button
                      >
                      <b-dropdown-item-button
                        variant="danger"
                        @click="deleteVenta(data.item.id)"
                        ><i class="fas fa-window-close"></i
                        >Anular</b-dropdown-item-button
                      >
                    </b-dropdown>
                  </div>
                </template>
              </b-table>
              <!-- PAGINACION -->
              <div v-if="rows > 2">
                <b-pagination
                  class="text-center"
                  v-model="currentPage"
                  :total-rows="rows"
                  :per-page="perPage"
                  aria-controls="my-table"
                  size="sm"
                  align="center"
                ></b-pagination>
              </div>
              <!-- FIN PAGINACION -->

              <!--          Modal agregar editar producto -->
              <!--          Modal agregar un abono a venta abono -->
              <div
                class="modal fade"
                id="ModalAbonos"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Abonos</h5>
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
                      <!--   {{infoabonos}} -->

                      <abonos-abono :infoabonos="infoabonos"></abonos-abono>
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

              <!--          Modal agregar un abono a venta credito -->
              <div
                class="modal fade"
                id="ModalCreditos"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Credito</h5>
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
                      <abonos-credito
                        :infoabonoscreditos="infoabonoscreditos"
                      ></abonos-credito>
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

              <!--          Modal agregar editar producto -->
              <div
                class="modal fade"
                id="ModalPagos"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Pagos</h5>
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
                      <historial-pagos
                        :infopagosventa="infopagosventa"
                      ></historial-pagos>
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

              <!--          Modal agregar editar producto -->
            </div>

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
import pagoServices from "../../services/pagoServices";
import Conf from "../../services/conf.js";

const resource = "api/venta/";
const server = Conf.server;

import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";
import moment from "moment";
moment.locale("es");
Vue.use(BootstrapVue);

export default {
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      perPage: 10,
      currentPage: 1,
      filter: null,

      fields1: [
        {
          key: "id",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "index",
        },
        {
          key: "fecha",
          label: "Fecha",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "nombre",
          label: "Cliente",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "total",
          label: "Total",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        { key: "actions", label: "Acciones", tdClass: "list-item-enddate" },
      ],

      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",

      detalleventa: [],
      totalventas: "",

      infoventa: [],

      infopagosventa: [],

      infoabonos: "",
      infoabonoscreditos: "",
      venta: "",
    };
  },
  computed: {
    rows() {
      return this.detalleventa.length;
    },
  },

  mounted() {
    this.detalleVenta();
    this.totalDashboardVentas();
  },
  methods: {
    obtenerabonos(id) {
      VentaServices.getInformacionPagosVentaAbonos(id)
        .then((response) => {
          this.infoabonos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    obtenerabonoscreditos(id) {
      VentaServices.getInformacionPagosVentaCreditos(id)
        .then((response) => {
          this.infoabonoscreditos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    obtenerpagos(id) {
      VentaServices.getInformacionPagosVenta(id)
        .then((response) => {
          this.infopagosventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteVenta(id) {
      this.$swal
        .fire({
          title: "Estas seguro de anular esta venta?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            VentaServices.deleteVenta(id)
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
    downloadVenta(id) {
      let routeData = server + resource + `download-venta/` + id;
      window.open(routeData);
    },
    detalleVenta() {
      VentaServices.detalleVenta()
        .then((response) => {
          this.detalleventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    totalDashboardVentas() {
      VentaServices.totalDashboardVentas()
        .then((response) => {
          this.totalventas = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    gotoEditVenta(id) {
      const userId = id;
      /* this.$router.push({ name: 'nuevaventa', params: { venId:userId }})
       */
      let routeData = this.$router.resolve({
        name: "editventa",
        params: { id: userId },
      });
      //window.open(routeData.href, "_blank");
      window.open(routeData.href, "_self");
    },
    gotoNuevaVenta() {
      VentaServices.createNuevaVenta()
        .then((response) => {
          let mensaje = response.data.data;

          let routeData = this.$router.resolve({
            name: "editventa",
            params: { id: mensaje },
          });
          //  window.open(routeData.href, "_blank");
          window.open(routeData.href, "_self");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

