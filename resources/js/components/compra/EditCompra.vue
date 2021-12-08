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
                    <h3 class="text-center">Informacion de compra</h3>

                    <div class="row">
                      <div class="col-md-6">
                        <p>Informacion de la compra</p>
                        <b-container fluid>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Proveedor:</label>
                            </b-col>
                            <b-col sm="8">
                              <v-select
                                label="nombre"
                                v-model="proveedor"
                                :options="infoproveedor"
                                required
                              ></v-select>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Fecha:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                type="date"
                                v-model="fecha"
                              ></b-form-input>
                              <small v-if="detallegeneralcompra.length > 0">
                                {{ detallegeneralcompra.detalle_compra.fecha }}
                              </small>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Comprobante:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                v-model="comprobante"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">SubTotal:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                @keypress="onlyNumber"
                                type="number"
                                v-model="subtotal"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Descuentos:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                 type="number"
                                @keypress="onlyNumber"
                                v-model="descuento"
                              ></b-form-input>
                            </b-col>
                          </b-row>

                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">SubTotal 0:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                 type="number"
                                @keypress="onlyNumber"
                                v-model="subtotalcero"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">SubTotal 12:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                
                                 type="number"                                @keypress="onlyNumber"
                                v-model="subtotaldoce"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Valor iva:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                @keypress="onlyNumber"
                                v-model="valoriva"
                                 type="number"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Total:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                @keypress="onlyNumber"
                                v-model="totalcompra"
                                 type="number"
                              ></b-form-input>
                            </b-col>
                          </b-row>

                          <b-row class="my-1">
                            <br />
                            <b-col class="text-center" sm="12">
                              <b-button
                                size="sm"
                                @click="updateCompra"
                                variant="primary"
                                >Guardar Informacion</b-button
                              >
                            </b-col>
                          </b-row>
                        </b-container>

             
                      
                      </div>
                      <div class="col-md-6">
             
                <p>Productos adquiridos</p>
                        <b-container fluid>
                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Producto:</label>
                            </b-col>
                            <b-col sm="8">
                              <v-select
                                label="descripcion"
                                v-model="producto"
                                :options="infoproducto"
                                required
                              ></v-select>
                            </b-col>
                          </b-row>

                          <b-row class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Tipo de compra:</label>
                            </b-col>
                            <b-col sm="8">
                              <div>
                                <b-form-group>
                                  <b-form-radio
                                    v-model="tipocompra"
                                    value="rollo"
                                    >Rollo
                                  </b-form-radio>
                                  <b-form-radio
                                    v-model="tipocompra"
                                    value="metro"
                                    >Metros</b-form-radio
                                  >
                                </b-form-group>
                              </div>
                            </b-col>
                          </b-row>
                          <b-row v-if="tipocompra === 'rollo'" class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Numero de rollos:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                @keypress="onlyNumber"
                                size="sm"
                                v-model="rollos"
                                type="number"
                              ></b-form-input>
                            </b-col>
                          </b-row>

                          <b-row v-if="tipocompra" class="my-1">
                            <b-col sm="4">
                              <label for="input-small"
                                >Cantidad de metros
                              </label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                @keypress="onlyNumber"
                                size="sm"
                                type="number"
                                v-model="cantidad"
                              ></b-form-input>
                              <small v-if="tipocompra === 'rollo'">Favor ingrese la cantidad de metros por rollo</small>
                            </b-col>
                          </b-row>
                          <b-row v-if="tipocompra" class="my-1">
                            <b-col sm="4">
                              <label for="input-small">Precio:</label>
                            </b-col>
                            <b-col sm="8">
                              <b-form-input
                                id="input-small"
                                size="sm"
                                @keypress="onlyNumber"
                                v-model="precio"
                              ></b-form-input>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <br />
                            <b-col class="text-center" sm="12">
                              <b-button
                                size="sm"
                                @click="addProductosCompra"
                                variant="primary"
                                >Guardar Producto</b-button
                              >
                              <b-button
                                size="sm"
                                data-toggle="modal"
                                data-target="#ModalNuevoProducto"
                                variant="secondary"
                                >Nuevo Producto</b-button
                              >
                            </b-col>
                          </b-row>







                          
                        </b-container>
                      </div>
                    </div>











      <div class="row">
                      <div class="col-md-12">
                        <p>Detalle General de la compra</p>
                        <b-container fluid>
                            <b-table
                          striped
                          hover
                          :items="detallecompra"
                          :fields="fields"
                        >
<template #cell(index)="data">
              <small> {{ data.index + 1 }} </small>
            </template>
               <template #cell(proNombre)="data">
              <small v-if="data.item.proDescripcion"
                >
               
                {{ data.item.proNombre }}
              </small>
              <small v-else> No data </small>
            </template>
              <template #cell(rollos)="data">
              <small v-if="data.item.rollos"
                >
               
                {{ data.item.rollos }}
              </small>
              <small v-else>0 </small>
            </template>
              <template #cell(cantidad)="data">
              <small v-if="data.item.cantidad"
                >
               
                {{ data.item.cantidad }}
              </small>
              <small v-else> No data </small>
            </template>
                 <template #cell(unidades)="data">
              <small v-if="data.item.unidades"
                >
               
                {{ data.item.unidades }}
              </small>
              <small v-else> No data </small>
            </template>
                <template #cell(precio)="data">
              <small v-if="data.item.precio"
                >
               
               $ {{ data.item.precio }}
              </small>
              <small v-else> No data </small>
            </template>
                     <template #cell(actions)="data">
      

            <b-button
              variant="outline-danger default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
              @click="deleteDetalleCompra(data.item.id)"
            >
              <i class="fas fa-trash"></i>
            </b-button>
          </template>
                        </b-table>
                        </b-container>

             
                      
                      </div>
                 
                    </div>



                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--          Modal agregar nuevo producto -->

          <div
            class="modal fade"
            id="ModalNuevoProducto"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Registrar nuevo producto</h5>
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
                  <modal-nuevo-producto @updateProducto="getAllProductos" />
                </div>
                <div class="modal-footer"></div>
              </div>
            </div>
          </div>

          <!--          Modal agregar editar producto -->

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
      fields: [
 {
          key: "index",
          label: "#",
          sortable: false,
          sortDirection: "Dates",
          tdClass: "index",
        },
        {
          key: "proDescripcion",
          label: "Producto",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
            {
          key: "rollos",
          label: "Rollos",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "cantidad",
          label: "Metros",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
     {
          key: "unidades",
          label: "Stock",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        }, 
           {
          key: "precio",
          label: "Precio",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
         { key: "actions", label: "Accion", tdClass: "text-center" },
      ],
         
      tipocompra: "",
      fecha: "",
      rollos:0,
      cliente: "",
      totalcompra: 0,
      subtotalcero: 0,
      subtotaldoce: 0,
      descuento: 0,
      subtotal: 0,
      modeupdate: false,
      proveedor: "",
      formadepagoupdate: "",
      valoriva: 0,
      infoproveedor: [],
      loading: false,
      infoeditcliente: [],
      camposactivos: false,
      totalesventa: [],
      detallecompra: [],
      detallegeneralcompra: [],
      cantidad: "",
      precio: "",
      filter: null,
      comId: "",
      comprobante: "",
      infoproducto: "",
      producto: "",
    };
  },
  created() {
    this.myFunction();
  },

  mounted() {
    this.getAllProveedores();
    this.getAllProductos();
    this.getInformacionCompra();
    this.getInformacionHeaderCompras();
  },
  methods: {
    onOver() {
      this.$refs.dropdown.visible = true;
    },
    onLeave() {
      this.$refs.dropdown.visible = false;
    },

    getAllProductos() {
      ProductoServices.getAllProductos()
        .then((response) => {
          this.infoproducto = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getAllProveedores() {
      ProveedorServices.getAllProveedores()
        .then((response) => {
          this.infoproveedor = response.data.data;
        })
        .catch((error) => {
          console.log(error);
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
    deleteDetalleCompra(id) {
 
    this.$swal
        .fire({
          title: "Estas seguro de eliminar esta compra?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            CompraServices.deleteDetalleCompra(id)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {
          
             this.$swal.fire({
              icon: "success",
              title: "Compra eliminada y stock actualizado",
              showConfirmButton: false,
              timer: 1500,
            });

  this.getInformacionCompra();

                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });




        
    },
    updateCompra() {
      let data = {
        comId: this.comId,
        total: this.totalcompra,
        prvId: this.proveedor["id"],
        fecha: this.fecha,
        comprobante: this.comprobante,
        subtotal: this.subtotal,
        subtotalcero: this.subtotalcero,
        subtotaldoce: this.subtotaldoce,
        valoriva: this.valoriva,
        descuento: this.descuento,
      };
      CompraServices.updateCompra(data)
        .then((response) => {
          let mensaje = response.data.data;

          if (mensaje == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Informacion de compra actualizada",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        })
        .catch((error) => {
          this.$swal.fire({
            icon: "success",
            title: "Cliente no actualizado",
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },

    addProductosCompra() {
      let data = {
        comId: this.comId,

        proId: this.producto["id"],
        cantidad: this.cantidad,
        precio: this.precio,
        tipo:this.tipocompra,
        rollos:this.rollos,
      };
      CompraServices.addProductosCompra(data)
        .then((response) => {
          let mensaje = response.data.data;
          this.getInformacionCompra();
          this.getAllProductos();
          this.cantidad = "";
          this.precio = "";
          this.producto = "";
          this.rollos = "";
          this.tipo = "";
          
          if (mensaje == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Stock actualizado",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getInformacionCompra() {
      CompraServices.getInformacionCompra(this.comId)
        .then((response) => {
          this.detallecompra = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
/* 
    INformacion de la parte superior */
    getInformacionHeaderCompras() {
      CompraServices.getInformacionHeaderCompras(this.comId)
        .then((response) => {
          this.detallegeneralcompra = response.data.data;
          if (this.detallegeneralcompra) {
            this.proveedor = this.detallegeneralcompra.proveedor;
            this.fecha = this.detallegeneralcompra.detalle_compra.fecha;
            this.comprobante =
              this.detallegeneralcompra.detalle_compra.comprobante;
            this.totalcompra = this.detallegeneralcompra.detalle_compra.total;
            this.subtotal = this.detallegeneralcompra.detalle_compra.subtotal;
            this.valoriva = this.detallegeneralcompra.detalle_compra.valoriva;
            this.subtotalcero =
              this.detallegeneralcompra.detalle_compra.subtotalcero;
            this.subtotaldoce =
              this.detallegeneralcompra.detalle_compra.subtotaliva;
            this.descuento = this.detallegeneralcompra.detalle_compra.descuento;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    myFunction: function () {
      this.comId = this.$route.path;
      this.comId = this.comId.substring(12);
    },
  },
};
</script>


