<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
     <div class="row">
       

            <div  class="col-xl-6 col-lg-6">
       
            </div>

       
          </div>
        </div>
      </div>
    </div>



 <div  class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
             
                <div class="col-12 text-left">
             
<div class="container">
  <h3 class="text-center">Reportes de cliente</h3>


  <div class="row">
    <div class="col-md-4">
      
      <p>Seleccione el cliente</p>
   <b-container fluid>
 

      Cliente
                        <v-select
                          label="nombre"
                          v-model="cliente"
                          :options="infocliente"
                          @click="reporteVentas"
                          required
                        ></v-select>
     <b-row class="my-1">
 <br/>
 
  </b-row>
  </b-container>

    
    </div>
    <div class="col-md-8">
 <!-- {{infoventa}} -->
    <b-table striped hover :items="infoventascliente" :fields="fields"></b-table>
  
          <b-col class="text-center" sm="12">
                <b-button
                  v-if="cliente "
                  size="sm"
                  @click="downloadReporteCliente"
                  variant="warning"
                  ><i class="fas fa-file" title="Reporte"></i> Descargar
                  PDF</b-button
                >
              </b-col>
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
      fechadesde: "",
        fechahasta: "",
      cliente: "",
      infoventascliente:"",
    infocliente:"",
      producto: "",
      clientecapturado:"",
    };
  },
   watch: {
    cliente: function (newClient, oldClient) {
      this.reporteVentas(newClient.id);
      this.clientecapturado=newClient.id;
    },
  },
  created() {
  },

  mounted() {
this.getAllClientes();
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
        })
        .catch((error) => {
          console.log(error);
        });
    },

        downloadReporteCliente() {
      let routeData =
        server +
        resource +
        `download-reporte-cliente/` +
        this.clientecapturado;
      window.open(routeData);
    },


  },
};
</script>


