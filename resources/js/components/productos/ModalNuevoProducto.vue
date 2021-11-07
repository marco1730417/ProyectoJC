<template>
<div class="card">
  <div class="card-body">
    <b-form v-if="show">
      <b-form-group id="input-group-2" label="Nombre del Producto" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="nombre"
          placeholder="Ingrese el nombre"
          required
        ></b-form-input>
    <!--     {{ nombre }} -->
      </b-form-group>
           <b-form-group id="input-group-3"   label="Codigo:" label-for="input-3"  >
        <b-form-input
          id="input-2"
          v-model="codigo"
          placeholder="Ingrese Codigo"
           @keypress="onlyNumber"
          
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group
        id="input-group-2"
        label="Unidades:"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="unidades"
          placeholder="Ingrese unidades"
           @keypress="onlyNumber"
          required
        ></b-form-input>
      </b-form-group>


         <b-form-group
        id="input-group-2"
        label="Precio Venta1:"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="PrecioVenta1"
          placeholder="Ingrese precio venta1"
           @keypress="onlyNumber"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-1"
        label="Iva"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="iva"
          type="iva"
          placeholder="Ingrese iva"
           @keypress="onlyNumber"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-1" label="Direccion" label-for="input-3">
        <b-form-textarea
          id="textarea"
          v-model="descripcion"
          placeholder="Ingrese la descripcion"
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>

      <b-button  size="sm"  variant="primary" @click="createNewProducto()">Guardar</b-button>
    </b-form>
  </div>
    </div>
</template>


<script>
import ProductoServices from "../../services/productoServices";

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  data() {
    return {
      show: true,
      producto: "",
      infoproducto: [],
      nombre: "",
      codigo: "",
      descripcion: "",
      unidades: "",
      iva: "",
      PrecioVenta1: "",
      
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
      clearfields(){
this.nombre="";
this.codigo="";
this.descripcion="";
this.unidades="";
this.iva="";
this.PrecioVenta1=""

    },
    createNewProducto() {
      let data = {
        nombre: this.nombre,
        codigo: this.codigo,
        descripcion: this.descripcion,
        unidades: this.unidades,
        iva: this.iva,
PrecioVenta1:this.PrecioVenta1,
      };
      ProductoServices.createNewProducto(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.clearfields();
            this.$emit("updateProducto");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
         onlyNumber ($event) {
          //console.log($event.keyCode); //keyCodes value
          let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
          if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
              $event.preventDefault();
          }
      },
  },
};
</script>
