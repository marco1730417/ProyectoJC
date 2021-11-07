<template>
<div class="card">
  <div class="card-body">
    <b-form v-if="show">
      <b-form-group id="input-group-2" label="Nombre del Producto" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="infoeditproducto.nombre"
          placeholder="Ingrese el nombre"
          required
        ></b-form-input>
    <!--     {{ nombre }} -->
      </b-form-group>
           <b-form-group id="input-group-3"   label="Codigo:" label-for="input-3"  >
        <b-form-input
          id="input-2"
          v-model="infoeditproducto.codigo"
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
          v-model="infoeditproducto.unidades"
          placeholder="Enter unidades"
           @keypress="onlyNumber"
          required
        ></b-form-input>
      </b-form-group>

       <b-form-group
        id="input-group-2"
        label="PrecioVenta1:"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="infoeditproducto.PrecioVenta1"
          placeholder="Enter unidades"
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
          v-model="infoeditproducto.iva"
          placeholder="Enter iva"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-1" label="Direccion" label-for="input-3">
        <b-form-textarea
          id="textarea"
          v-model="infoeditproducto.descripcion"
          placeholder="Ingrese la descripcion"
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>
     <!--  {{infoeditproducto}}
 -->
      <b-button  size="sm"  variant="primary" @click="UpdateProducto(infoeditproducto)">Actualizar</b-button>
    </b-form>
  </div>
    </div>
</template>


<script>
import ProductoServices from "../../services/productoServices";

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  props:['infoeditproducto'],
  data() {
    return {
      show: true,
      producto: "",
      infoproducto: [],
      nombre: "",
      codigo: "",
      descripcion: "",
      unidades: "",
      PrecioVenta1:"",
      iva: "",
    };
  },
  mounted() {

  },
  methods: {
      clearfields(){
this.nombre="";
this.codigo="";
this.descripcion="";
this.unidades="";
this.iva="";
this.PrecioVenta1="";

    },
    UpdateProducto(infoedicionproducto) {
      let data = {
        informacionedicionproducto: infoedicionproducto
      };
      ProductoServices.UpdateProducto(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$emit("updateProductos");
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
