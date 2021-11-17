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
                </div>
              </div>
            </div>
                    <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Productos 
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        {{ totalventas.numero_productos }}</span
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
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Sales value</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                <h2 class="mb-0">Total orders</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Productos bajo stock</h3>
                            </div>
                         
                        </div>
                    </div>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Producto </th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Ultima actualizacion</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in totalventas['productos_stock'] ">
                                    <th scope="row">
                                       {{item.nombre}}
                                    </th>
                                 
                                    <td>
                                       {{item.unidades}}
                                    </td>
                                        <td>
                                       {{item.updated_at}}
                                    </td>
                                 
                                </tr>
                         
                             
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Social traffic</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Referral</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        1,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        5,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">70%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Google
                                    </th>
                                    <td>
                                        4,807
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Instagram
                                    </th>
                                    <td>
                                        3,678
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        twitter
                                    </th>
                                    <td>
                                        2,645
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">30%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      infocliente: [],
      loading: false,
      detalleventa: [],
      totalventas: "",
      infoventa: [],
      text: "",
      formadepago: "",
      venId: 10,
    };
  },
  mounted() {
    this.detalleVenta();
    this.totalDashboardVentas();
  },
  methods: {
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
    deleteVenta(id) {
      this.$swal
        .fire({
          title: "Estas seguro de cancelar esta venta?",
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
  },
};
</script>

<style scoped>
.my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>
