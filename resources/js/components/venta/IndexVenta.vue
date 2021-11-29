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
                        $ {{ parseFloat(totalventas.max_venta).toFixed(2) }}
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
                  <!--      <button class="btn btn-sm btn-primary"
                     @click="nuevaventa"> Nueva Venta</button> 
                     
                     
                      -->
                  <a
                    href="#"
                    @click="gotoNuevaVenta()"
                    class="badge badge-primary"
                    >Nueva Venta</a
                  >
                </div>
              </div>
            </div>

            <div class="col-12"></div>

            <div class="table-responsive">
              <table  class="table align-items-center table-flush">
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
                    <td>
                      <!-- <router-link to="/nuevaventa" target="_blank">Contact</router-link>
 -->
                      <!-- <button @click="gotoVenta" >+</button>
     -->
                      <!--  <router-link to="/nuevaventa" target="_blank">Contact</router-link>
 -->
                      <!-- <router-link :to="{name: 'nuevaventa', params: { venId: 101 }   } ">Places, but 101</router-link>
  -->

                      <a
                        href="#"
                        @click="gotoEditVenta(item.id)"
                        class="badge badge-primary"
                        >{{ item.nombre }}</a
                      >
                      <!--   <router-link :to="{ name: 'editventa', params: { id: item.id }  } " target="_blank">
  
    {{ item.id }}

</router-link>  -->
                    </td>
                    <td>
                      <!-- 
                   {{ moment(item.fecha).format( "MMM DD YYYY, ddd" ) }} -->

                      {{ item.fecha }}
                    </td>

                    <td>{{ item.tipo }}</td>
                    <td>{{ item.observacion }}</td>
                    <td>
                      $
                      {{ parseFloat(item.totales).toFixed(2) }}
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
                        <i class="fas fa-file" title="PDF"></i>
                      </a>
                      <a
                        class="btn btn-sm btn-icon-only text-light"
                        data-toggle="modal"
                        data-target="#ModalVentaObservaciones"
                        @click="captureitem(item)"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="fas fa-eye" title="Eliminar venta"></i>
                      </a>
                      <a
                        class="btn btn-sm btn-icon-only text-light"
                        @click="deleteVenta(item.id)"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="fas fa-trash" title="Eliminar venta"></i>
                      </a>
                 <!--      {{item}} -->
                         <a v-if="item.tipo == 'Abono' "
                        class="btn btn-sm btn-icon-only text-light"
                        data-toggle="modal"
                        data-target="#ModalAbonos"
                        @click="obtenerabonos(item.id)"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="fas fa-dollar-sign" title="Abonos"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!--          Modal agregar editar producto -->
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
                      <br />

                      <b-button
                        @click="
                          updateObservacion(infoventa.id, infoventa.observacion)
                        "
                        size="md"
                        variant="success"
                        >Guardar</b-button
                      >
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

              <!--          Modal agregar editar producto -->
                 <!--          Modal agregar editar producto -->
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
  <div> <h5>Total a cobrar : $ {{infoabonos.totalcobrar}}  </h5><h5>Fecha maxima :  {{infoabonos.fechamaxima}}  </h5>
    <b-progress :value="infoabonos.total_abonos" :max="infoabonos.totalcobrar" show-progress animated></b-progress>
    <b-table striped hover :items="infoabonos.detalle_venta" :fields="fields"></b-table>

    <form action="">


                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">Cantidad recibida</p>
                              <input
                                class="form-control"
                                type="number"
                                v-model="pagorecibido"
                              />
                            </div>
                            <div class="mb-3">
                         


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
                                        parseFloat(infoabonos.saldo).toFixed(
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
                                    <p>Abono</p>
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
                                    <p>Saldo</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span
                                      > {{ parseFloat(total_saldo).toFixed(2) }} 
                                    </p>
                                  </div>
                                     

                                  <div
                                    v-if=" pagorecibido"
                                    @click="registrarabono(pagorecibido,infoabonos.detalle_venta)"
                              
                                    class="btn btn-primary mt-2"
                                  >
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Guardar Abono
                                  </div>
                             
                                </div>
                              </div>
                            </div>
                          </form>
                      
</div>



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

export default {
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
           fields: [
        
          {
            key: 'abono',
            label: 'Abono',
          },
               {
            key: 'fecha',
            label: 'Fecha',
          }
        ],
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      infocliente: [],
      loading: false,
      detalleventa: [],
      totalventas: "",
      infoventa: [],
      text: "",
      formadepago: "",
      infoabonos:"",
      pagorecibido:"",
      saldo:"",
    };
  },
    computed: {
   
      total_saldo: function () {
   
      let total = this.infoabonos.saldo;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo= tt;

      return tt;
    },
    
  },
  mounted() {
    this.detalleVenta();
    this.totalDashboardVentas();
  },
  methods: {
    registrarabono(pago,info){

      let data = {
        info: info,
        pago: pago,
        saldo:this.saldo,
 
      };
      VentaServices.registrarabono(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
        this.obtenerabonos();
          }
        })
        .catch((error) => {
          console.log(error);
        });


          },
    updateObservacion(id, texto) {
      let data = {
        id: id,
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
    captureitem(item) {
      this.infoventa = item;
    },
    obtenerabonos(id){
 VentaServices.getInformacionPagosVenta(id)
        .then((response) => {
          this.infoabonos = response.data.data;


        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteVenta(id) {
      this.$swal
        .fire({
          title: "Estas seguro de eliminar esta venta?",
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
    nuevaventa() {
      window.location.href = "../nuevaventa/";
    },
    gotoVenta(id) {
      const userId = id;
      /* this.$router.push({ name: 'nuevaventa', params: { venId:userId }})
       */
      let routeData = this.$router.resolve({
        name: "nuevaventa",
        params: { venId: userId },
      });
      window.open(routeData.href, "_blank");
    },
    gotoEditVenta(id) {
      const userId = id;
      /* this.$router.push({ name: 'nuevaventa', params: { venId:userId }})
       */
      let routeData = this.$router.resolve({
        name: "editventa",
        params: { id: userId },
      });
      window.open(routeData.href, "_blank");
    },
    gotoNuevaVenta() {
      VentaServices.createNuevaVenta()
        .then((response) => {
          let mensaje = response.data.data;

          let routeData = this.$router.resolve({
            name: "editventa",
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

