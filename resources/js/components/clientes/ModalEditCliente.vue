<template>
<div class="card">
  <div class="card-body">
    <b-form v-if="show">
      <b-form-group id="input-group-2" label="Nombre del Cliente" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="infoeditcliente.nombre"
              :maxlength="maxnombre"
     
          placeholder="Ingrese el nombre"
          required
        ></b-form-input>
    <!--     {{ nombre }} -->
      </b-form-group>
           <b-form-group id="input-group-3"   label="Ruc" label-for="input-3"  >
        <b-form-input
          id="input-2"
          v-model="infoeditcliente.ruc"
            :maxlength="maxruc"
        
          placeholder="Ingrese Ruc"
           @keypress="onlyNumber"
          
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group
        id="input-group-2"
        label="Telefono"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="infoeditcliente.telefono"
             :maxlength="maxtelefono"
        
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
          v-model="infoeditcliente.email"
          type="email"
          placeholder="Enter email"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-1" label="Direccion" label-for="input-3">
        <b-form-textarea
          id="textarea"
          v-model="infoeditcliente.direccion"
          :maxlength="maxdireccion"
     
          placeholder="Ingrese la direccion"
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>
     <!--  {{infoeditcliente}}
 -->
      <b-button v-if="infoeditcliente.nombre&&infoeditcliente.ruc" size="sm"  variant="primary" @click="UpdateCliente(infoeditcliente)">Actualizar</b-button>
      
      <b-button v-else  size="sm"  variant="primary" disabled>Actualizar</b-button>
    </b-form>
  </div>
    </div>
</template>


<script>
import ClienteServices from "../../services/clienteServices";

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  props:['infoeditcliente'],
  data() {
    return {
         maxruc: 13,
      maxnombre: 50,
      maxtelefono: 10,
      maxdireccion: 150,
   
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
  /*   console.log("Component mounted."); */
  },
  methods: {
      clearfields(){
this.nombre="";
this.ruc="";
this.direccion="";
this.telefono="";
this.email="";

    },
    UpdateCliente(infoedicioncliente) {
      let data = {
        informacionedicioncliente: infoedicioncliente
      };
      ClienteServices.UpdateCliente(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$emit("updateClientes");
                              this.$swal
        .fire({
  icon: 'success',
  title: 'Cliente actualizado',
  showConfirmButton: false,
  timer: 1500
})
          }
        })
        .catch((error) => {
                   this.$swal
        .fire({
  icon: 'success',
  title: 'Cliente no actualizado',
  showConfirmButton: false,
  timer: 1500
})
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
