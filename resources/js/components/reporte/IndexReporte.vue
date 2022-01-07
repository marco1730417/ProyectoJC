<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
    <div class="card">
  <div class="card-header">
    REPORTE DE VENTAS
  </div>
  <div class="card-body">
  <!--   <h4 class="card-title">Por favor eliga las fechas previo a su reporte</h4> -->
<form >
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
  <button @click="reporteVentas" class="btn btn-primary mb-2"><i class="fas fa-search"></i>Buscar</button>
</form>
  
  
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


