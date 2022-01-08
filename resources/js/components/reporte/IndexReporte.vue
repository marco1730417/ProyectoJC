<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
    <div class="card">
  <div class="card-header text-center">
 <strong>REPORTE DE VENTAS </strong>   
  </div>
  <div class="card-body">
  <!--   <h4 class="card-title">Por favor eliga las fechas previo a su reporte</h4> -->

  <div class="form-group">
     <label for="email">Fecha Inicial:</label>
    <input type="date"     v-model="fechadesde"
                             class="form-control" id="email">
  </div>
  <div class="form-group ">
  <label for="email">Fecha Final:</label>
    <input type="date"     v-model="fechahasta"
                             class="form-control" id="email">
 
  </div>
  <div class="text-center">
 
 <button @click="reporteVentas" class="btn btn-primary mb-2"><i class="fas fa-search"></i>GENERAR REPORTE</button>

  
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
                
                </div>
        
                <div class="col-4">
             
                </div>
              </div>
            </div>

            <div class="col-12"></div>

            <div v-if="infoventa" class="table-responsive">
              <b-table
                :items="infoventa.ventas_por_fecha"
                :fields="fields"
                show-empty
                responsive="sm"
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
                    <template #cell(fechamaxima)="data">
                  <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                  <!--  {{ data.item.fecha }} -->
                  {{
                    moment(data.item.fechamaxima).format(
                      "MMM DD YYYY"
                    )
                  }}
                  <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
                </template>
                  <template #cell(tipo)="data">
                  <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                  <!--  {{ data.item.fecha }} -->
                  <span v-if="data.item.tipo">{{
                  data.item.tipo
                  }} </span>   <span v-else> Pago no registrado </span> 
                  <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
                </template>
                             <template #cell(saldos)="data">
                  <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
                  <!--  {{ data.item.fecha }} -->
                  <span v-if="data.item.saldos>0">{{
                  data.item.saldos
                  }} </span>   <span v-else>0 </span> 
                  <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
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
                             
                        </tbody>
                      </table>
                    </div>
                  </b-row>
                </b-col>
              </b-row>
            </b-container>
            <div class="float-right">
  <button  @click="downloadVenta" type="button" class="btn btn-primary"><i class="fas fa-print"></i>EXPORTAR PDF</button>
     
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
                {
          key: "tipo",
          label: "Tipo",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },     {
          key: "abono",
          label: "Abono",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
             {
          key: "saldos",
          label: "Saldo",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
                    {
          key: "fechamaxima",
          label: "Fecha máxima",
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


