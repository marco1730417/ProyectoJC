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
                    <h3 class="text-center">Pagos Pendientes- {{ fecha }}</h3>
                  </div>
                </div>
                       <b-form-group >
              <b-form-input
                class="float-right"
                id="filter-input"
                v-model="filter"
                type="search"
                size="sm"
                placeholder="Buscar Cliente"
              ></b-form-input>
            </b-form-group>
              </div>
              <!--  {{pagospendientes}} -->
              <b-table
                id="my-table"
                sticky-header
                striped
                show-empty
                small
                :filter="filter"
                fixed
                hover
                :items="pagospendientes"
                :fields="fields"
                :per-page="perPage"
                :current-page="currentPage"
                responsive="sm"
              >
                <template #cell(id)="data">
               
   <b-badge href=""   @click="gotoEditVenta(data.item.id)"
                   variant="primary">{{ data.item.id }}</b-badge> 
                     <span v-if="data.item.cheque || data.item.numtransf ">      {{
                          data.item.cheque
                            }}  {{data.item.numtransf}}  </span>     <span v-else>  N/A</span> 

<!--  <b-badge href="#" variant="primary">Primary</b-badge> -->

                </template>
                <template #cell(nombre)="data">
                  <small class="mb-0 mr-2">{{ data.item.nombre }}</small>
                </template>
                <template #cell(venfecha)="data">
                  {{
                    moment(data.item.venfecha).format(
                      "MMM DD YYYY, ddd, h:mm:ss a"
                    )
                  }}
                </template>
                     <template #cell(fechamaxima)="data">
                  {{
                    moment(data.item.fechamaxima).format(
                      "MMM DD YYYY"
                    )
                  }}
                </template>
                 <template #cell(saldo)="data">
                     $ {{ parseFloat(data.item.saldo).toFixed(2) }}
                  </template>
                        <template #cell(total)="data">
                     $ {{ parseFloat(data.item.total).toFixed(2) }}
                  </template>

                <template #cell(actions)="data">
                  <!--   {{data.item}} -->
                  <b-button
                    variant="outline-success default actions"
                    @click="changestatus(data.item.id)"
                    size="sm"
                    title="venta"
                  >
                    <i class="fas fa-check"></i>
                  </b-button>
                </template>
              </b-table>
              <!-- PAGINACION -->
              <div v-if="rows > 5">
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
import pagoServices from "../../services/pagoServices";
import CompraServices from "../../services/compraServices";
import ReporteServices from "../../services/reporteServices";

import ClienteServices from "../../services/clienteServices";
import ProveedorServices from "../../services/proveedorServices";
import Conf from "../../services/conf.js";
import ProductoServices from "../../services/productoServices";

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
      fecha: moment().format("MMMM Do YYYY"),
      filter: null,
      perPage: 10,
      currentPage: 1,
      fields: [
        {
          key: "id",
          label: "# Venta",
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
          key: "venfecha",
          label: "Fecha Venta",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "fechamaxima",
          label: "Fecha Maxima",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "saldo",
          label: "Saldo",
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
        { key: "actions", label: "Acciones", tdClass: "text-center" },
      ],
      fechadesde: "",
      fechahasta: "",
      cliente: "",
      pagospendientes: "",

      producto: "",
    };
  },
  created() {},
  computed: {
    //Paginación
    rows() {
      return this.pagospendientes.length;
    },
  },
  mounted() {
    this.PagosPendientes();
  },
  methods: {
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
    /*         changestatus(id) {
      pagoServices.updatePago(id)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
  location.reload();
  
      }
        })
        .catch((error) => {
          console.log(error);
        });
    },
 */

    changestatus(id) {
      this.$swal
        .fire({
          title: "Venta cancelada en su totalidad?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            pagoServices
              .updatePago(id)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {
                  location.reload();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
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

    PagosPendientes() {
      pagoServices
        .PagosPendientes()
        .then((response) => {
          this.pagospendientes = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>


