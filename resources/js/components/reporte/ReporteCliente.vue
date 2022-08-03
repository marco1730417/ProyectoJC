<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="card">
            <div class="card-header text-center">
              <strong>REPORTE DE CLIENTES </strong>
            </div>
            <div class="card-body">
              <!--   <h4 class="card-title">Por favor eliga las fechas previo a su reporte</h4> -->

              <div class="form-group">
                <label for="email">ELIJA UN CLIENTE:</label>

                <v-select
                  label="nombre"
                  v-model="cliente"
                  :options="infocliente"
                  @click="reporteVentas"
                  required
                ></v-select>
              </div>
              <div class="float-right">
        
        <button v-if="cliente" @click="downloadReporteCliente" class="btn btn-primary mb-2"><i class="fas fa-print"></i>EXPORTAR PDF</button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      v-if="infoventascliente.length > 0"
      class="header bg-gradient-primary pb-1 pt-3 pt-md-2"
    >
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="card">
            <div class="card-header text-center">
              <strong>
                REPORTE DE VENTAS DE CLIENTE - VENTAS NO ADEUDADAS
              </strong>
            </div>
            <div class="card-body">
              <b-table
                striped
                hover
                :items="infoventascliente"
                :fields="fields"
              >
                <template #cell(fecha)="data">
                  <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                  <!--  {{ data.item.fecha }} -->
                  {{
                    moment(data.item.fecha).format(
                      "MMM DD YYYY, ddd, h:mm:ss a"
                    )
                  }}
                  <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
                </template>
                <template #cell(detalle)="data">
                  <span v-if="data.item.tipo == 'Contado'">
                    {{ data.item.detallecontado }}
                  </span>
                  <span v-if="data.item.tipo == 'Transferencia'">
                    {{ data.item.numtransf }}
                  </span>
                  <span v-if="data.item.tipo == 'Credito'">
                    {{ data.item.cheque }}
                  </span>
                  <span v-if="data.item.tipo == 'Cheque'">
                    {{ data.item.cheque }}
                  </span>
                    <span v-if="data.item.tipo == 'Abono'">
                    {{ data.item.detalleabono }}
                  </span>
                </template>

                <template #cell(total)="data">
                  <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                  <!--  {{ data.item.fecha }} -->
                  <span v-if="data.item.total"
                    >$
                    {{ parseFloat(data.item.total).toFixed(2) }}
                  </span>
                  <span v-else>0 </span>
                  <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
                </template>
              </b-table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      v-if="infodeudascliente.length > 0"
      class="header bg-gradient-primary pb-1 pt-3 pt-md-2"
    >
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="card">
            <div class="card-header text-center">
              <strong> REPORTE DE VENTAS DE CLIENTE - VENTAS ADEUDADAS -
           TOTAL ADEUDADO   $ {{ parseFloat(totaldeudacliente).toFixed(2) }}  </strong>
            </div>
            <div class="card-body">
              <b-table
                striped
                hover
                :items="infodeudascliente"
                :fields="fields1"
              >
                <template #cell(fecha)="data">
                  <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                  <!--  {{ data.item.fecha }} -->
                  {{
                    moment(data.item.fecha).format(
                      "MMM DD YYYY, ddd, h:mm:ss a"
                    )
                  }}
                  <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
                </template>
                <template #cell(tipo)="data">
                  <span> {{ data.item.tipo }} </span>
                </template>

                <template #cell(saldos)="data">
                  <span v-if="data.item.saldos"
                    >$
                    {{ parseFloat(data.item.saldos).toFixed(2) }}
                  </span>
                  <span v-else>0 </span>
                </template>
              </b-table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import ReporteServices from "../../services/reporteServices";

import ClienteServices from "../../services/clienteServices";
import Conf from "../../services/conf.js";

const resource = "api/reportes/";
const server = Conf.server;
import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";

Vue.use(BootstrapVue);
export default {
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      fields: [
        {
          key: "venId",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "detalle",
          label: "Detalle",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "fecha",
          label: "Fecha",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "tipo",
          label: "Tipo",
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
      ],
      fields1: [
        {
          key: "venId",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "fecha",
          label: "Fecha",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "tipo",
          label: "Tipo",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "saldos",
          label: "Saldos",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
      ],
      fechadesde: "",
      fechahasta: "",
      cliente: "",
      infoventascliente: [],
      infocliente: "",
      producto: "",
      clientecapturado: "",
      infodeudascliente: [],
      totaldeudacliente:"",
    };
  },
  watch: {
    cliente: function (newClient, oldClient) {
      this.reporteVentas(newClient.id);
      this.clientecapturado = newClient.id;
    },
  },
  mounted() {
    this.getAllClientes();
  },
  methods: {

  reporteVentas(id) {
      ReporteServices.reporteVentasporCliente(id)
        .then((response) => {
          this.infoventascliente = response.data;
          console.log(this.infoventascliente);
          this.reporteDeudasporCliente(id);
          this.reporteTotalVentasCliente(id);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    reporteDeudasporCliente(id) {
      ReporteServices.reporteDeudasporCliente(id)
        .then((response) => {
          this.infodeudascliente = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
       reporteTotalVentasCliente(id) {
      ReporteServices.reporteTotalDeudasporCliente(id)
        .then((response) => {
          this.totaldeudacliente = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
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

  

    downloadReporteCliente() {
      let routeData =
        server + resource + `download-reporte-cliente/` + this.clientecapturado;
      window.open(routeData);
    },
  },
};
</script>


