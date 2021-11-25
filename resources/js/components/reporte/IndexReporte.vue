<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
     <div class="row">
       

            <div  class="col-xl-6 col-lg-6">
       
            </div>

       
          </div>
        </div>
      </div>
    </div>



 <div  class="container-fluid mt--7">
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
      
      <p>Ingrese la informacion de la compra</p>
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
      <b-form-input id="input-small" size="sm" type="date" v-model="fecha" ></b-form-input>
      <small v-if="detallegeneralcompra.length>0"> {{detallegeneralcompra.detalle_compra.fecha}} </small>
    </b-col>
  </b-row>
     <b-row class="my-1">
    <b-col sm="4">
      <label for="input-small">Comprobante:</label>
    </b-col>
    <b-col sm="8">
      <b-form-input id="input-small" size="sm" v-model="comprobante" ></b-form-input>
    </b-col>
  </b-row>
       <b-row class="my-1">
    <b-col sm="4">
      <label for="input-small">Total:</label>
    </b-col>
    <b-col sm="8">
      <b-form-input id="input-small" size="sm"          @keypress="onlyNumber" v-model="totalcompra" ></b-form-input>
    </b-col>
  </b-row>
       <b-row class="my-1">
 <br/>
    <b-col class="text-center" sm="12">
      <b-button size="sm" @click="updateCompra" variant="primary">Guardar Informacion</b-button>
    </b-col>
  </b-row>
  </b-container>

    
      <p>Ingrese los productos adquiridos</p>
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
      <label for="input-small">Cantidad:</label>
    </b-col>
    <b-col sm="8">
      <b-form-input id="input-small"          @keypress="onlyNumber" size="sm" v-model="cantidad" ></b-form-input>
    </b-col>
  </b-row>
     <b-row class="my-1">
    <b-col sm="4">
      <label for="input-small">Precio:</label>
    </b-col>
    <b-col sm="8">
      <b-form-input id="input-small" size="sm"          @keypress="onlyNumber" v-model="precio" ></b-form-input>
    </b-col>
  </b-row>
    <b-row class="my-1">
 <br/>
    <b-col class="text-center" sm="12">
      <b-button size="sm" @click="addProductosCompra" variant="primary">Guardar Producto</b-button>
    </b-col>
  </b-row>
  </b-container>


    </div>
    <div class="col-md-6">
 
  <!--  {{detallecompra}} -->
    <b-table striped hover :items="detallecompra" :fields="fields"></b-table>
    <b-alert v-if="producto" variant="success" show>El producto {{producto.nombre}}  tiene actualmente {{producto.unidades}} mtrs en stock  </b-alert>     
      </div>


    </div>
  </div>
</div>
                </div>
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


      fecha: "",
      cliente: "",
      totalcompra: "",
      modeupdate: false,
      proveedor: "",
      formadepagoupdate: "",
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
  },

  mounted() {

  },
  methods: {
   
        onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
    },




  },
};
</script>


