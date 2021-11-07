<template>
<div class="card">
  <div class="card-body">
{{venta}}


  </div>
    </div>
</template>


<script>
import ProductoServices from "../../services/productoServices";

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  props:["venta"],
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
