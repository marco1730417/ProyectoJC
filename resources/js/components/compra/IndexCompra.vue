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
                        Compras Totales
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                 123123
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
                      <span class="h2 font-weight-bold mb-0">
                    asdasd</span
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
                        Mejor Compra
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                   121221
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
     
                </div>
              </div>
            </div>
          
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
                  <h3 class="mb-0">Compra</h3>
                </div>
                <div class="col-4 text-right">
                  <!--      <button class="btn btn-sm btn-primary"
                     @click="nuevacompra"> Nueva Compra</button> 
                     
                     
                      -->
                  <a
                    href="#"
                    @click="gotoNuevaCompra()"
                    class="badge badge-primary"
                    >Nueva Compra</a
                  >
                </div>
              </div>
            </div>

            <div class="col-12"></div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Valor Iva</th>
                    <th scope="col">Total</th>

                    <th scope="col">Accion</th>
                  </tr>
                </thead>

                <!--  {{detallecompra}}  -->
                <tbody>
                  <tr v-for="item in detallecompra">
                    <td>


                      <a
                        href="#"
                        @click="compraServices(item.id)"
                        class="badge badge-primary"
                        >{{ item.nombre }}</a
                      >
          
                    </td>
                    <td>
                      <!-- 
                   {{ moment(item.fecha).format( "MMM DD YYYY, ddd" ) }} -->

                      {{ item.fecha }}
                    </td>

                    <td>{{ item.valoriva }}</td>
                    <td>{{ item.total }}</td>
                
                    <td class="text-center">
                      <a
                        class="btn btn-sm btn-icon-only text-light"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="fas fa-file" title="PDF"></i>
                      </a>
                     
                    </td>
                  </tr>
                </tbody>
              </table>
              <!--          Modal agregar editar producto -->
        

              <!--          Modal agregar editar producto -->
                 <!--          Modal agregar editar producto -->
         

              <!--          Modal agregar editar producto -->
            </div>

            <!--  {{totalescompra}} -->

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
import CompraServices from "../../services/compraServices";
import Conf from "../../services/conf.js";

const resource = "api/compra/";
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
    
      fecha: moment().format("MMMM Do YYYY"),
      detallecompra: [],
      totalcompras: "",
      infocompra: [],
    };
  },
    computed: {
   
   
    
  },
  mounted() {
    this.getCompras();

  },
  methods: {
    getCompras() {
      CompraServices.getCompras()
        .then((response) => {
          this.detallecompra = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    captureitem(item) {
      this.infocompra = item;
    },


   
  
    gotoEditCompra(id) {
      const userId = id;
      /* this.$router.push({ name: 'nuevacompra', params: { venId:userId }})
       */
      let routeData = this.$router.resolve({
        name: "editcompra",
        params: { id: userId },
      });
      window.open(routeData.href, "_blank");
    },
    gotoNuevaCompra() {
      CompraServices.createNuevaCompra()
        .then((response) => {
          let mensaje = response.data.data;

          let routeData = this.$router.resolve({
            name: "editcompra",
            params: { id: mensaje },
          });
          window.open(routeData.href, "_blank");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

