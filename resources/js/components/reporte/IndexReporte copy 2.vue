<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-6 col-lg-6"></div>
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
                  <div class="container">
                    <h3 class="text-center">Reportes de ventas</h3>

                    <div class="row">
                      <div class="col-md-4">
                        <p>Seleccione la fecha</p>
                        <b-container fluid>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Desde:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                type="date"
                                v-model="fechadesde"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Hasta:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                type="date"
                                v-model="fechahasta"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <br />
                            <b-col class="text-center" sm="12">
                              <b-button
                                size="sm"
                                @click="reporteVentas"
                                variant="primary"
                                >Generar</b-button
                              >
                            </b-col>
                          </b-row>
                        </b-container>
                      </div>
                      <div class="col-md-8">
                    
                      </div>
                    </div>

                       <b-table
          :items="infoventa.ventas_por_fecha"
          :fields="fields"
          show-empty
          responsive="sm"
          :per-page="perPage"
          :current-page="currentPage"
        >
          <template #cell(index)="data">
            <small> {{ data.index + 1 }} </small>
          </template>
      
        </b-table>
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
                            <td>CONTADO</td>
                            <td>
                              {{ parseFloat(infoventa.ventas_contado).toFixed(2) }}
                            </td>
                          </tr>
                            <tr>
                            <td>TRANSFERENCIA</td>
                            <td>
                              {{ parseFloat(infoventa.ventas_transferencia).toFixed(2) }}
                            </td>
                          </tr>
                             <tr>
                            <td>ABONOS</td>
                            <td>
                              {{ parseFloat(infoventa.ventas_abono).toFixed(2) }}
                            </td>
                          </tr>
                                <tr>
                            <td>CHEQUE</td>
                            <td>
                              {{ parseFloat(infoventa.ventas_cheque).toFixed(2) }}
                            </td>
                          </tr>
                     
                        </tbody>
                      </table>
                    </div>
                  </b-row>
                </b-col>
              </b-row>
            </b-container>
                  </div>
                </div>
              </div>
  
              <!-- <button @click="downloadVenta">Descargar pdf</button> -->
              <b-col class="text-center" sm="12">
                <b-button
                  v-if="fechadesde && fechahasta"
                  size="sm"
                  @click="downloadVenta"
                  variant="warning"
                  ><i class="fas fa-print" title="Reporte"></i> Descargar
                  PDF</b-button
                >
              </b-col>
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
import VentaServices from "../../services/ventaServices";
import CompraServices from "../../services/compraServices";
import ReporteServices from "../../services/reporteServices";

import ClienteServices from "../../services/clienteServices";
import ProveedorServices from "../../services/proveedorServices";
import Conf from "../../services/conf.js";
import ProductoServices from "../../services/productoServices";

const resource = "api/reportes/";
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
      fields: [
        {
          key: "id",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "index",
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
      ],
      fechadesde: "",
      fechahasta: "",
      cliente: "",
      infoventa: "",

      producto: "",
    };
  },
  created() {},

  mounted() {},
  methods: {
    downloadVenta() {
      let routeData =
        server +
        resource +
        `download-reporte-venta/` +
        this.fechadesde +
        "/" +
        this.fechahasta;
      window.open(routeData);
    },
    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
    },

    reporteVentas() {
      ReporteServices.reporteVentas(this.fechadesde, this.fechahasta)
        .then((response) => {
          this.infoventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>


