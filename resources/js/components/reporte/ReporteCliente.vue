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
                <label for="email">Escoja un Cliente:</label>

                <v-select
                  label="nombre"
                  v-model="cliente"
                  :options="infocliente"
                  @click="reporteVentas"
                  required
                ></v-select>
              </div>
              <div class="float-right">
                <!-- 
 <button @click="downloadReporteCliente" class="btn btn-primary mb-2"><i class="fas fa-print"></i>EXPORTAR PDF</button>
 -->
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
                <div class="col-12 text-left">
                  <div v-if="infoventascliente.length > 0" class="container">
                    <h3 class="text-center">Reportes de ventas de cliente</h3>

                    <div class="row">
                      <div class="col-md-12">
                        <!-- {{infoventa}} -->
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

                        <!--   <b-col class="text-center" sm="12">
                <b-button
                  v-if="cliente "
                  size="sm"
                  @click="downloadReporteCliente"
                  variant="warning"
                  ><i class="fas fa-print" title="Reporte"></i> Descargar
                  PDF</b-button
                >
              </b-col> -->
                      </div>
                    </div>
                  </div>
                  <div v-if="infodeudascliente.length > 0" class="container">
                    <h3 class="text-center">Valores Adeudados</h3>

                    <div class="row">
                      <div class="col-md-12">
                        <!-- {{infoventa}} -->
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
                          <template #cell(saldos)="data">
                            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                            <!--  {{ data.item.fecha }} -->
                            <span v-if="data.item.saldos > 0"
                              >
                              
                                {{ parseFloat(data.item.saldos).toFixed(2) }}

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
          key: "nombre",
          label: "Cliente",
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
    reporteDeudasporCliente(id) {
      ReporteServices.reporteDeudasporCliente(id)
        .then((response) => {
          this.infodeudascliente = response.data.data;
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

    reporteVentas(id) {
      ReporteServices.reporteVentasporCliente(id)
        .then((response) => {
          this.infoventascliente = response.data.data;
          this.reporteDeudasporCliente(id);
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


