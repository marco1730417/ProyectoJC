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
<!--             <div class="col-xl-3 col-lg-6">
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
                       <div class="col-8">
                   <b-form-input
                style="height: calc(1.3em + 0.5rem + 2px); font-size: 0.75rem"
                class="float-right"
                id="filter-input"
                v-model="filter"
                type="search"
                size="sm"
                placeholder="Buscar Venta"
              ></b-form-input>
                </div>
                <div class="col-4">
              
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
             <b-table
          :items="detalleventa"
          :fields="fields1"
          :filter="filter"
          show-empty
          responsive="sm"
          :per-page="perPage"
          :current-page="currentPage"
        >
     <!--      <template #cell(index)="data">
            <small> {{ data.index + 1 }} </small>
          </template> -->
          <template #cell(fecha)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            <!--  {{ data.item.fecha }} -->
              {{ moment(data.item.fecha ).format("MMM DD YYYY, ddd, h:mm:ss a")}} 
           <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
          
          </template>
              <template #cell(nombre)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
<!--             <small> </small> -->
             <div class="left" id="center">
            <small> {{ data.item.nombre }}<br/></small>
            <small> {{data.item.ruc}}</small>
              
        </div>
          </template>
              <template #cell(observacion)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            {{ data.item.observacion }}
          </template>
    
    
          <template #cell(actions)="data">
               <b-button
              variant="outline-success default actions"
              @click="gotoEditVenta(data.item.id)"
              size="sm"
              title="venta"
          
            >
              <i class="fas fa-arrow-circle-right"></i>
            </b-button>
            <b-button
              variant="outline-info default actions"
              data-toggle="modal"
                        data-target="#ModalVentaObservaciones"
              size="sm"
              title="observaciones"
              @click="captureitem(data.item)"
          
            >
              <i class="fas fa-eye"></i>
            </b-button>
     <b-button
              variant="outline-warning default actions"
              size="sm"
                      @click="downloadVenta(data.item.id)"
              data-placement="top"
              title="Descargar"
            >
              <i class="fas fa-print" title="Descargar"></i>
            </b-button>
              <b-button v-if="data.item.pagoabonos>0"
              variant="outline-warning default actions"
              size="sm"
             data-toggle="modal"
                        data-target="#ModalAbonos"
                        @click="obtenerabonos(data.item.id)"
              data-placement="top"
              title="Abonos"
            >
              <i class="fas fa-balance-scale" title="Abonos"></i>
            </b-button>
                <b-button 
              variant="outline-warning default actions"
              size="sm"
             data-toggle="modal"
                        data-target="#ModalPagos"
                        @click="captureventa(data.item.id)"
              data-placement="top"
              title="Pagos"
            >
              <i class="fas fa-dollar-sign" title="Pagos"></i>
            </b-button>
            
            <b-button
              variant="outline-danger default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="Anular"
         @click="deleteVenta(data.item.id)"
            >
              <i class="fas fa-window-close"></i>
            </b-button>
       
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
<!-- {{infoventa}} -->
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
                      <div>
                      <!--   <h5>Total a cobrar : $ {{ infoabonos.totalcobrar }}</h5> -->
                       <h5>Total a cobrar : ${{ parseFloat(infoabonos.totalcobrar).toFixed(2) }}</h5>
                           <h5>Fecha maxima :  {{ moment(infoabonos.fechamaxima , "YYYY-MM-DD").format("MMM DD YYYY, ddd")}} </h5>
                        <b-progress
                          :value="infoabonos.total_abonos"
                          :max="infoabonos.totalcobrar"
                          show-progress
                          animated
                        ></b-progress>
                        <b-table
                          striped
                          hover
                          :items="infoabonos.detalle_venta"
                          :fields="fields"
                        >
                              <template #cell(fecha)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            <!--  {{ data.item.fecha }} -->
              {{ moment(data.item.fecha , "YYYY-MM-DD, h:mm:ss a").format("MMM DD YYYY, ddd, h:mm:ss a")}} 
           <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
          
          </template>
                        
                        </b-table>

                        <form action="">
                          <div class="mb-3">
                            <p class="dis fw-bold mb-2">Cantidad recibida</p>
                            <input
                              class="form-control"
                              type="number"
                              v-model="pagorecibido"
                            />
                          </div>
                          <div class="mb-3"></div>
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
                                      parseFloat(infoabonos.saldo).toFixed(2)
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
                                     <!--  {{
                                      parseFloat(pagorecibido).toFixed(2)
                                    }} -->
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
                                    <span class="fas fa-dollar-sign"></span>
                                    {{ parseFloat(total_saldo).toFixed(2) }}
                                  </p>
                                </div>

                                <div
                                  v-if="pagorecibido"
                                  @click="
                                    registrarabono(
                                      pagorecibido,
                                      infoabonos.detalle_venta
                                    )
                                  "
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
                 <modal-pagos-venta :venId="venta" ></modal-pagos-venta>
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

import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";
    import moment from "moment";
    moment.locale('es');
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
          key: "observacion",
          label: "Nota",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
   
 
        { key: "actions", label: "Acciones",   tdClass: "list-item-enddate", },
      ],


      fields: [
        {
          key: "abono",
          label: "Abono",
        },
        {
          key: "fecha",
          label: "Fecha",
        },
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
      infoabonos: "",
      pagorecibido: "",
      saldo: "",
       venta:"",
    };
  },
  computed: {
    total_saldo: function () {
      let total = this.infoabonos.saldo;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo = tt;

      return tt;
    },
       rows() {
      return this.detalleventa.length;
    },
  },
  mounted() {
    this.detalleVenta();
    this.totalDashboardVentas();
  },
  methods: {
    	    captureventa(id){
this.venta=id;
    },
    registrarabono(pago, info) {
      let data = {
        info: info,
        pago: pago,
        saldo: this.saldo,
      };
      VentaServices.registrarabono(data)
        .then((response) => {
          let mensaje = response.data.data;
      if (mensaje == 200) {
                              this.$swal
        .fire({
  icon: 'success',
  title: 'Abono registrado',
  showConfirmButton: false,
  timer: 1500
});
location.reload();
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
    obtenerabonos(id) {
      VentaServices.getInformacionPagosVentaAbonos(id)
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

