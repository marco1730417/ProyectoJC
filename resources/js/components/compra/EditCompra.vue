<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <!--      <b-col>Informacion de la Compra
 -->
                      <div>
                        <h2>Información General</h2>
                        <b-form>
                          <div class="row">
                            <div class="col">
                              <b-form-group
                                id="input-group-3"
                                label="Proveedor"
                                label-for="input-3"
                              >
                                <v-select
                                  label="nombre"
                                  v-model="proveedor"
                                  :options="infoproveedor"
                                  required
                                ></v-select>
                              </b-form-group>
                            </div>
                            <div class="col">
                              <b-form-group
                                id="input-group-1"
                                label="Comprobante"
                                label-for="input-1"
                              >
                                <b-form-input
                                  v-model="comprobante"
                                  type="email"
                                  placeholder="Ingrese el numero de comprobante"
                                  required
                                ></b-form-input>
                              </b-form-group>
                            </div>

                            <div class="col">
                              <div>
                                <label
                                  class="mr-sm-2"
                                  for="inline-form-custom-select-pref"
                                  >Fecha</label
                                >
                                <b-form inline>
                                  <b-form-input
                                    id="inline-form-input-name"
                                    class="mb-2 mr-sm-2 mb-sm-0"
                                    type="date"
                                    v-model="fecha"
                                  ></b-form-input>

                                  <label
                                    class="sr-only"
                                    for="inline-form-input-username"
                                    >Actual Date</label
                                  >

                                  <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
                                    <b-form-input
                                      type="text"
                                      id="inline-form-input-username"
                                      disabled
                                      :placeholder="fecha"
                                    ></b-form-input>
                                  </b-input-group>
                                </b-form>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <b-form-group
                                id="input-group-1"
                                label="SubTotal"
                                label-for="input-1"
                              >
                                <b-form-input
                                  @keypress="onlyNumber"
                                  type="number"
                                  v-model="subtotal"
                                  required
                                ></b-form-input>
                              </b-form-group>
                            </div>
                            <div class="col">
                              <b-form-group
                                id="input-group-1"
                                label="Descuentos"
                                label-for="input-1"
                              >
                                <b-form-input
                                  @keypress="onlyNumber"
                                  type="number"
                                  v-model="descuento"
                                  required
                                ></b-form-input>
                              </b-form-group>
                            </div>

                            <div class="col">
                              <b-form-group
                                id="input-group-1"
                                label="SubTotal 0"
                                label-for="input-1"
                              >
                                <b-form-input
                                  @keypress="onlyNumber"
                                  type="number"
                                  v-model="subtotalcero"
                                  required
                                ></b-form-input>
                              </b-form-group>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <b-form-group
                                id="input-group-1"
                                label="SubTotal 12"
                                label-for="input-1"
                              >
                                <b-form-input
                                  @keypress="onlyNumber"
                                  type="number"
                                  v-model="subtotaldoce"
                                  required
                                ></b-form-input>
                              </b-form-group>
                            </div>
                            <div class="col">
                              <b-form-group
                                id="input-group-1"
                                label="Valor Iva"
                                label-for="input-1"
                              >
                                <b-form-input
                                  @keypress="onlyNumber"
                                  type="number"
                                  v-model="valoriva"
                                  required
                                ></b-form-input>
                              </b-form-group>
                            </div>

                            <div class="col">
                           <!--    <b-button @click="updateCompra" variant="primary"
                                >Guardar Información</b-button
                              > -->
                                     <b-form-group
                                id="input-group-1"
                                label="Total"
                                label-for="input-1"
                              >
                                <b-form-input
                                  @keypress="onlyNumber"
                                  type="number"
                                  v-model="totalcompra"
                                  required
                                ></b-form-input>
                              </b-form-group>
                           <!--    <b-button @click="updateCompra" variant="primary"
                                >Guardar Información</b-button
                              > -->




                            </div>
                            
      
                          </div>

<div class="row">  <b-col class="text-center float-center" >
                              <b-button
                             @click="updateCompra" 
                                variant="primary"
                                >Guardar Información</b-button
                              >
                            </b-col> </div>

                        </b-form>
                      </div>
                             <h2>Productos adquiridos</h2>
                    </div>
                    <!--  </b-col> -->
                    <b-col>
                      <div>
                        <b-form>
                                             <div class="b" style="float:right">
        <div class="form-check form-check-inline">
  <input class="form-check-input" v-model="busqueda" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="nombre">
  <label class="form-check-label" for="inlineRadio1">Código</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" v-model="busqueda" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="descripcion">
  <label class="form-check-label" for="inlineRadio2">Descripción</label>
</div></div>
                          <b-form-group
                            id="input-group-3"
                            label="Producto"
                            label-for="input-3"
                          >
          
                            <v-select
                              :label="busqueda"
         
                              v-model="producto"
                              :options="infoproducto"
                              required
                            ></v-select>
                            <small class="text-primary text-center">
                              {{ producto.descripcion }}
                            </small>
                          </b-form-group>

                          <b-row class="my-1">
                            <b-col sm="12">
                              <div>
                                <b-form-group
                                  label="Escoja la unidad adquirida"
                                >
                                  <b-form-radio-group
                                    id="radio-group-1"
                                    name="radio-sub-component1"
                                  >
                                    <b-form-radio
                                      v-for="item in options"
                                      v-model="tipocompra"
                                      :key="item.value"
                                      :value="item.value"
                                      >{{ item.text }}</b-form-radio
                                    >
                                    <!-- {{selectedpv1}} -->
                                  </b-form-radio-group>
                                </b-form-group>
                              </div>
                              <b-row
                                v-if="tipocompra === 'mt' || tipocompra === 'u'"
                                class="my-1"
                              >
                                <b-col sm="4">
                                  <label for="input-small"
                                    >Cantidad de {{ tipocompra }}
                                  </label>
                                </b-col>
                                <b-col sm="8">
                                  <b-form-input
                                    id="input-small"
                                    @keypress="onlyNumber"
                                    size="sm"
                                    v-model="cantidad"
                                    type="number"
                                  ></b-form-input>
                                </b-col>
                              </b-row>

                              <b-row v-if="tipocompra === 'rll'" class="my-1">
                                <b-col sm="4">
                                  <label for="input-small"
                                    >Numero de {{ tipocompra }}
                                  </label>
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
                                <b-col sm="4">
                                  <label for="input-small"
                                    >Cantidad de mt por cada {{tipocompra}}
                                  </label>
                                </b-col>
                                <b-col sm="8">
                                  <b-form-input
                                    id="input-small"
                                    @keypress="onlyNumber"
                                    size="sm"
                                    v-model="cantidad"
                                    type="number"
                                  ></b-form-input>
                            <!--       <small>
                                    <strong
                                      >Favor ingrese la cantidad de mt por
                                      {{ tipocompra }}
                                    </strong>
                                  </small> -->
                                </b-col>
                              </b-row>

                              <b-row v-if="tipocompra === 'cj'" class="my-1">
                                <b-col sm="4">
                                  <label for="input-small"
                                    >Numero de {{ tipocompra }}
                                  </label>
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
                                <b-col sm="4">
                                  <label for="input-small"
                                    >Cantidad  de u por cada {{tipocompra}}
                                  </label>
                                </b-col>
                                <b-col sm="8">
                                  <b-form-input
                                    id="input-small"
                                    @keypress="onlyNumber"
                                    size="sm"
                                    v-model="cantidad"
                                    type="number"
                                  ></b-form-input>
                           <!--        <small>
                                    <strong
                                      >Favor ingrese la cantidad de u por
                                      {{ tipocompra }}
                                    </strong>
                                  </small> -->
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
                                    type="number"
                                    @keypress="onlyNumber"
                                    v-model="precio"
                                  ></b-form-input>
                                </b-col>
                              </b-row>
                            </b-col>
                          </b-row>
                          <b-row class="my-1">
                            <br />
                            <b-col class="text-center" sm="12">
                              <b-button
                                v-if="producto"
                                @click="addProductosCompra"
                                variant="primary"
                                >Agregar Producto</b-button
                              > <b-button
                                v-if="!producto"
                              disabled
                                variant="primary"
                                >Agregar Producto</b-button
                              >
                              <b-button
                                data-toggle="modal"
                                data-target="#ModalNuevoProducto"
                                variant="secondary"
                                >Nuevo Producto</b-button
                              >
                            </b-col>
                          </b-row>
                          <!--          Modal agregar editar producto -->

                          <div class="row">
                            <b-container fluid>
                              <p>Productos de compra {{ comprobante }}</p>

                              <b-table
                                striped
                                :items="detallecompra"
                                :fields="fields"
                              >
                                <template #cell(index)="data">
                                  <small>
                                    {{ data.index + 1 }}
                                    <!-- {{data.item}}  --></small
                                  >
                                </template>
                                <template #cell(proNombre)="data">
                                  <small v-if="data.item.proNombre">
                                    {{ data.item.proNombre }}
                                  </small>
                                  <small v-else> No data </small>
                                </template>
                                <template #cell(rollos)="data">
                                  <small v-if="data.item.rollos">
                                    {{ data.item.rollos }}
                                  </small>
                                  <small v-else>0 </small>
                                </template>
                                <template #cell(cantidad)="data">
                                  <small v-if="data.item.cantidad">
                                    {{ data.item.cantidad }}
                                  </small>
                                  <small v-else> No data </small>
                                </template>
                                <template #cell(unidades)="data">
                                  <small v-if="data.item.unidades">
                                    {{ data.item.unidades }}
                                  </small>
                                  <small v-else> No data </small>
                                </template>
                                <template #cell(precio)="data">
                                  <small v-if="data.item.precio">
                                    $ {{ data.item.precio }}
                                  </small>
                                  <small v-else> No data </small>
                                </template>
                                <template #cell(actions)="data">
                                          <b-button
                                    variant="outline-success default actions"
                                    size="sm"
                                    data-toggle="modal"
                                    data-target="#ModalEditarProducto"
                                    @click="obtenerdatosproducto(data.item)"
                                    data-placement="top"
                                    title="editar compra"
                                  >
                                    <i class="fas fa-edit" title="Editar precio"></i>
                                  </b-button>
                                  <b-button
                                    variant="outline-danger default actions"
                                    size="sm"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="eliminar producto"
                                    @click="deleteDetalleCompra(data.item.id)"
                                  >
                                    <i class="fas fa-trash"></i>
                                  </b-button>
                          
                                </template>
                              </b-table>
                              <br /><br /><br />
            
                            </b-container>
                          </div>
                        </b-form>
                      </div>
                    </b-col>
                  </div>
                </div>
              </div>
            </div>

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
                      <b-alert show> <strong>IMPORTANTE </strong>  <br/> Si se va a agregar un producto nuevo , se recomienda ingresar las cantidades con valor 0 para evitar
                        un doble ingreso de stock al momento de registrar la compra
                      </b-alert>
                    <modal-nuevo-producto @updateProducto="updateProducto" />
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <div
              class="modal fade"
              id="ModalEditarProducto"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edicion de producto</h5>
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
                    <!--       {{ productoinfo }} -->
                    <form>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Producto</label>
                        <input
                          type="email"
                          class="form-control"
                          disabled
                          id="exampleFormControlInput1"
                          v-model="productoinfo.proDescripcion"
                        />
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Precio</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleFormControlInput1"
                          v-model="productoinfo.precio"
                        />
                      </div>
                      <div class="col-12 text-center">
                        <div
                          v-if="productoinfo.precio"
                          @click="updateDetalleCompra(productoinfo)"
                          class="btn btn-primary payment"
                        >
                          Editar
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import CompraServices from "../../services/compraServices";
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
       busqueda:"nombre",

      options: [
        { text: "mt", value: "mt" },
        { text: "rll", value: "rll" },
        { text: "u", value: "u" },
        { text: "cj", value: "cj" },
      ],
      fields: [
        {
          key: "index",
          label: "#",
          sortable: false,
          sortDirection: "Dates",
          tdClass: "index",
        },
        {
          key: "proNombre",
          label: "Producto",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "rollos",
          label: "RLL / CJ",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "cantidad",
          label: "MT / U",
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
        { key: "actions", label: "Accion" },
      ],

      tipocompra: "",
      fecha: "",
      rollos: 0,
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
      cantidad: 0,
      precio: 0,
      filter: null,
      comId: "",
      comprobante: "",
      infoproducto: "",
      producto: "",
      productoinfo: [],
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
    updateProducto() {
      /*    $("#ModalNuevoProducto").modal("hide");
      this.getAllProductos(); */
      location.reload();
    },

    updateDetalleCompra(datosproducto) {
      let data = {
        infoproducto: datosproducto,
      };
      CompraServices.updateDetalleCompra(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Valores actualizados",
              showConfirmButton: false,
              timer: 1500,
            });

            this.getInformacionCompra();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

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
                    title: "Detalle de compra eliminado y stock actualizado",
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
    obtenerdatosproducto(item) {
      this.productoinfo = item;
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
        tipo: this.tipocompra,
        rollos: this.rollos,
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


