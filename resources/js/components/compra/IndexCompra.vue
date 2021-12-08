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
                        Proveedor
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
                        Compras de este mes
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
           
         
              </div>





  <div class="row">
                <div class="col-8">
                   <b-form-input
                style="height: calc(1.3em + 0.5rem + 2px); font-size: 0.75rem"
                class="float-right"
                id="filter-input"
                v-model="filter"
                type="search"
                size="sm"
                placeholder="Buscar Compra"
              ></b-form-input>
                </div>
           
              <div class="col-4">
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

   <b-table
          :items="detallecompra"
          :fields="fields"
          :filter="filter"
          show-empty
          responsive="sm"
          :per-page="perPage"
          :current-page="currentPage"
        >
          <template #cell(index)="data">
            <small> {{ data.index + 1 }} </small>
          </template>
          <template #cell(fecha)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
         <!--    {{ data.item.fecha }} -->
              {{ moment(data.item.fecha , "YYYY-MM-DD").format("MMM DD YYYY, ddd")}}
           <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
          
          </template>
              <template #cell(comprobante)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            {{ data.item.comprobante }}
          </template>
              <template #cell(nombre)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            {{ data.item.nombre }}
          </template>
          <template #cell(ruc)="data">
            <!--  <small class="mb-0 mr-2">{{ data.item.ruc }}</small> -->
            {{ data.item.ruc }}
          </template>
          <template #cell(direccion)="data">
            <!--    <small class="mb-0 mr-2">{{ data.item.direccion }}</small> -->
            {{ data.item.direccion }}
          </template>
          <template #cell(valoriva)="data">
            {{ data.item.valoriva }}
          </template>

          <template #cell(total)="data">
            <!--     <b-badge variant="outline" class="p-1" size="sm">{{
              data.item.email
            }}</b-badge> -->
           $ {{ data.item.total }}
          </template>
          <template #cell(actions)="data">
            <b-button
              variant="outline-info default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
            @click="gotoEditCompra(data.item.id)"
            >
              <i class="fas fa-edit"></i>
            </b-button>

            <b-button
              variant="outline-danger default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
         @click="deleteCompra(data.item.id)"
            >
              <i class="fas fa-trash"></i>
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

import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";
    import moment from "moment";
    moment.locale('es');
    Vue.prototype.moment = moment;
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
    
       fields: [
        {
          key: "index",
          label: "Item",
          sortable: false,
          sortDirection: "desc",
          tdClass: "index",
        },
      {
          key: "comprobante",
          label: "Comprobante",
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
          key: "nombre",
          label: "Proveedor",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
     /*    {
          key: "valoriva",
          label: "Valor Iva",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        }, */
              {
          key: "total",
          label: "Total",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

 
        { key: "actions", label: "Acciones", tdClass: "text-center" },
      ],
      detallecompra: [],
      totalcompras: "",
      infocompra: [],
    };
  },
    computed: {
    //Paginación
    rows() {
      return this.detallecompra.length;
    },
  },
  
  mounted() {
    this.getCompras();

  },
  methods: {

 deleteCompra(id) {
      this.$swal
        .fire({
          title: "Estas seguro de eliminar esta compra?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            CompraServices.deleteCompra(id)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {a
                    this.$swal.fire({
              icon: "success",
              title: "Compra eliminada y stock actualizado",
              showConfirmButton: false,
              timer: 1500,
            });
             /*  window.location.href = "../compra/"; */
             this.getCompras();
                
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

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
      const comId = id;
     
      let routeData = this.$router.resolve({
        name: "editcompra",
        params: { id: comId },
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

