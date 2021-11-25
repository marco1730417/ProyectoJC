<template>
<div class="card">
  <div class="card-body">
    <b-form v-if="show">
      <b-form-group id="input-group-2" label="Nombre del Cliente" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="infoeditproveedor.nombre"
          placeholder="Ingrese el nombre"
          required
        ></b-form-input>
    <!--     {{ nombre }} -->
      </b-form-group>
           <b-form-group id="input-group-3"   label="Ruc:" label-for="input-3"  >
        <b-form-input
          id="input-2"
          v-model="infoeditproveedor.ruc"
          placeholder="Ingrese Ruc"
           @keypress="onlyNumber"
          
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group
        id="input-group-2"
        label="Telefono:"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="infoeditproveedor.telefono"
          placeholder="Enter telefono"
           @keypress="onlyNumber"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-1"
        label="Email"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="infoeditproveedor.email"
          type="email"
          placeholder="Enter email"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-1" label="Direccion" label-for="input-3">
        <b-form-textarea
          id="textarea"
          v-model="infoeditproveedor.direccion"
          placeholder="Ingrese la direccion"
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>
     <!--  {{infoeditproveedor}}
 -->
      <b-button  size="sm"  variant="primary" @click="UpdateProveedor(infoeditproveedor)">Actualizar</b-button>
    </b-form>
  </div>
    </div>
</template>


<script>
import ProveedorServices from "../../services/proveedorServices";

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  props:['infoeditproveedor'],
  data() {
    return {
      show: true,
      cliente: "",
      infocliente: [],
      nombre: "",
      ruc: "",
      direccion: "",
      telefono: "",
      email: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
      clearfields(){
this.nombre="";
this.ruc="";
this.direccion="";
this.telefono="";
this.email="";

    },
    UpdateProveedor(infoedicioncliente) {
      let data = {
        informacionedicionproveedor: infoedicioncliente
      };
      ProveedorServices.UpdateProveedor(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$emit("updateClientes");
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
