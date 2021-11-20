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

$    {{ parseFloat(totalventas.subtotal ).toFixed(2) }}
   

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
             <!--      <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"
                      ><i class="fa fa-arrow-up"></i> From </span
                    >
                    <span class="text-nowrap">Since last month</span>
                  </p> -->
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
                      <span class="h2 font-weight-bold mb-0"> {{totalventas.cliente}}</span>
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
                 <!--  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"
                      ><i class="fas fa-arrow-down"></i> 3.48%</span
                    >
                    <span class="text-nowrap">Since last week</span>
                  </p> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Mejor Venta
                      </h5>
                      <span class="h2 font-weight-bold mb-0">

    $ {{ parseFloat(totalventas.max_venta ).toFixed(2) }}

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
               <!--    <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"
                      ><i class="fas fa-arrow-down"></i> 1.10%</span
                    >
                    <span class="text-nowrap">Since yesterday</span>
                  </p> -->
                </div>
              </div>
            </div>
<!--             <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Crear nueva venta
                            <button @click="nuevaventa"> Crear</button>

                      </h5>
                
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-info
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"
                      ><i class="fas fa-arrow-up"></i> 12%</span
                    >
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- 
{{venId}} -->

    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Venta</h3>
                </div>
                <div class="col-4 text-right">
                <button class="btn btn-sm btn-primary"
                     @click="nuevaventa"> Nueva Venta</button> </div>

       
              </div>
            </div>

            <div class="col-12"></div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Metodo pago</th>
                    <th scope="col">Observaciones</th>
                   
                    <th scope="col">Valor</th>

                    <th scope="col">Accion</th>
                  </tr>
                </thead>

                <!--  {{detalleventa}}  -->
                <tbody>
                  <tr v-for="item in detalleventa">
                    <td>{{ item.nombre }}</td>
                    <td>
<!-- 
                   {{ moment(item.fecha).format( "MMM DD YYYY, ddd" ) }} -->
                   
                   {{item.fecha}}
                   </td>

                    <td>{{ item.tipo }}</td>
                      <td>{{ item.observacion }}</td>
                     <td>
$
    {{ parseFloat(item.totales ).toFixed(2) }}

                     </td>
                    <td class="text-center">
                      <a
                        class="btn btn-sm btn-icon-only text-light"
                           @click="downloadVenta(item.id)"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-file"
                          title="PDF"
                      
                        ></i>
                          
                      </a>
                           <a
                        class="btn btn-sm btn-icon-only text-light"
                         data-toggle="modal"
                    data-target="#ModalVentaObservaciones"
                    @click="captureitem(item)"
                 
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-eye"
                          title="Eliminar venta"
                        
                        ></i>
                          
                      </a>
                             <a
                        class="btn btn-sm btn-icon-only text-light"
                        @click="deleteVenta(item.id)"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-trash"
                          title="Eliminar venta"
                        
                        ></i>
                          
                      </a>
                      
                    </td>
                  </tr>
                </tbody>
              </table>
              


            <div
              class="modal fade"
              id="ModalVentaObservaciones"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Observaciones de venta</h5>
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
                   
               <!--     {{infoventa.id}}  -->
                   <b-form-textarea
      id="textarea"
      v-model="infoventa.observacion"
      placeholder="Enter something..."
      rows="3"
      max-rows="6"
    ></b-form-textarea>
    <br/>

     <b-button @click="updateObservacion(infoventa.id,infoventa.observacion)" size="md" variant="success">Guardar</b-button>
  
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

          <!--          Modal agregar editar producto -->
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

import Venta from "./Venta.vue";
import Conf from "../../services/conf.js";

const resource = "api/venta/";
const server = Conf.server;
import moment from "moment";
import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";

Vue.use(BootstrapVue);




export default  {
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      infocliente: [],
      loading: false,
      detalleventa: [],
      totalventas:"",
infoventa:[],
text:"",
      formadepago: "",
      venId: 10,
    };
  },
  mounted() {
    this.detalleVenta();
    this.totalDashboardVentas();
  },
  methods: {
    updateObservacion(id,texto){
      let data = {
        id: id,
        observacion: texto

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
    captureitem(item){
this.infoventa=item;
    },
      deleteVenta(id) {
   
this.$swal.fire({
  title: 'Estas seguro de cancelar esta venta?',
  showCancelButton: true,
  confirmButtonText: 'SI',
  
}).then((result) => {
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
})

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
    nuevaventa(){
      window.location.href = "../nuevaventa/";
    }
  },
};
</script>

