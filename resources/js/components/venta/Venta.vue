<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
       
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                     Elija un cliente
                        <v-select
                          label="ruc"
                         
                          v-model="cliente"
                          :options="infocliente"
                          required
                        ></v-select>
                      </h5>
               <!--        <span class="h2 font-weight-bold mb-0"
                        >{{ cliente.nombre }}
                      </span> -->
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
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                  </div>
              <!--     <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"> {{ cliente.email }} </span>
                    <span class="text-nowrap"> {{ cliente.direccion }} </span>
                  </p> -->
                </div>
              </div>
            </div>
                    <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                     Elija un metodo de pago
                    
                      </h5>
                  <b-form-group  >
      <b-form-radio v-model="formadepago"  name="some-radios" value="Efectivo">Efectivo</b-form-radio>
      <b-form-radio v-model="formadepago"  name="some-radios" value="Transferencia">Transferencia</b-form-radio>

<!--       <p>  {{formadepago}} </p> -->
    </b-form-group>
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
                        <i class="fas fa-wallet"></i>
                      </div>
                    </div>
                  </div>
               
                </div>
              </div>
            </div>

     <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Crear Venta 
                      </h5>
                      <span class="h4 font-weight-bold mb-0">  {{cliente.nombre}}  </span>
                        <span class="h4 font-weight-bold mb-0">  {{cliente.ruc}}  </span>
                        <span class="h4 font-weight-bold mb-0"> Forma de pago {{formadepago}}  </span>
                        
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
                        <i class="fas fa-cart-plus"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"
                      ><i class="fa fa-calendar"></i> {{ fecha }}</span
                    >
  <b-button variant="primary" @click="createVenta" >Crear Venta</b-button>

                  <!--   <span class="text-nowrap">Since last month</span> -->
                  </p>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>

<!-- 
{{venId}} -->

    <div v-if="venId>0" class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Venta</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="" class="btn btn-sm btn-primary"
                   data-toggle="modal"
            data-target="#ModalVentaProducto"
           
                  >+ producto</a>

           <div
              class="modal fade"
              id="ModalVentaProducto"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
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
                    <modal-venta-producto :venta="venId" />
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

                </div>
              </div>
            </div>

            <div  class="col-12"></div>

            <div  class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Total</th>

                    <th scope="col">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Admin Admin</td>
                    <td>
                      <a href="mailto:admin@argon.com">admin@argon.com</a>
                    </td>
                    <td>12/02/2020 11:00</td>
                    <td>12/02/2020 11:00</td>
                    <td>12/02/2020 11:00</td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a
                          class="btn btn-sm btn-icon-only text-light"
                          href="#"
                          role="button"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div
                          class="
                            dropdown-menu
                            dropdown-menu-right
                            dropdown-menu-arrow
                          "
                        >
                          <a class="dropdown-item" href="">Edit</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
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
import ClienteServices from "../../services/clienteServices";

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
      fecha: moment().format("MMMM Do YYYY, h:mm:ss a"),
      cliente: "",
      infocliente: [],
      loading: false,
      infoeditcliente: [],
      filter: null,
      formadepago:"",
      venId:"",
      };
  },
  mounted() {
    this.getAllClientes();
  },
  methods: {
    
    getAllClientes() {
      ClienteServices.getAllClientes()
        .then((response) => {
          this.infocliente = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateClients() {
      this.getAllClientes();

      $("#ModalNuevoCliente").modal("hide");
    },
    updateClientsUpdate() {
      this.getAllClientes();

      $("#ModalEditCliente").modal("hide");
    },
    openModalEditCliente(infocliente) {
      this.infoeditcliente = infocliente;
      $("#ModalEditCliente").modal("show");
    },

     createVenta() {
      let data = {
        cliId: this.cliente['id'],
        metodopago: this.formadepago,

      };



      VentaServices.createVenta(data)
        .then((response) => {
          let mensaje = response.data.data;
        
        this.venId=mensaje;


        })
        .catch((error) => {
          console.log(error);
        });
    },


  },
};
</script>
