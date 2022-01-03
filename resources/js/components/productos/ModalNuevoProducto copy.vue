<template>
  <div class="card">
    <div class="card-body">
      <div class="container">
        <form>
          <div class="row">
            <div class="col-6">
              <!--left side -->
              <div class="form-group row">
                <label for="fname" class="col-sm-4 col-form-label"
                  >Nombre</label
                >
                <div class="col-sm-8">
                  <input
                    v-model="nombre"
                    type="text"
                    class="form-control"
                    required
                    id="nombre"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="lname" class="col-sm-4 col-form-label"
                  >Unidades</label
                >
                <div class="col-sm-8">
                  <input
                    v-model="unidades"
                    type="text"
                    class="form-control"
                    id="unidades"
                  /> <small>Favor ingresar unidades en metros</small>
                </div>
              </div>

 <!--              <div class="form-group row">
                <label for="lname" class="col-sm-4 col-form-label">Iva</label>
                <div class="col-sm-8">
                  <div class="row"> -->
                <!--     <b-form-group id="input-group-2" label-for="input-2">
                      <b-form-radio v-model="iva" name="some-radios" value="12">
                        12
                      </b-form-radio>
                      <b-form-radio v-model="iva" name="some-radios" value="0">
                        0
                      </b-form-radio>
                    </b-form-group> -->
                    <!--     {{iva}} -->
<!--  <h2 v-if="this.PrecioVenta1" >El precio con iva es de <b-badge> {{this.PrecioVenta1*1.12}} </b-badge></h2> -->
<!--   <b-alert   v-if="this.PrecioVenta1" variant="success" show>PRECIO CON IVA 

      
   $ {{ parseFloat(this.PrecioVenta1*1.12).toFixed(2) }}
  </b-alert> -->
<!-- 
                  </div>
                </div>
              </div> -->
              <div class="form-group row">
                 <label
                  v-if="this.PrecioVenta1 "
                  for="lname"
                  class="col-sm-12 col-form-label"
                  >El precio con IVA es de                   <!-- {{ this.PrecioVenta1 - this.preciocompra }} -->
                    <strong> $ {{ parseFloat(this.PrecioVenta1*1.12).toFixed(2) }} </strong>  
                </label>
                <label
                  v-if="this.PrecioVenta1 && this.preciocompra"
                  for="lname"
                  class="col-sm-12 col-form-label"
                  >Su utilidad x metro es 
                  <!-- {{ this.PrecioVenta1 - this.preciocompra }} -->
                <strong>${{ parseFloat(this.PrecioVenta1 - this.preciocompra).toFixed(2) }} </strong>     
                </label>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group row">
                <label for="email" class="col-sm-6 col-form-label"
                  >Precio de compra
                </label>
                <div class="col-sm-6">
                  <input
                    @keypress="onlyNumber"
                    v-model="preciocompra"
                    type="text"
                    class="form-control"
                    id="preciocompra"
                  /> 
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-6 col-form-label"
                  >Precio x metro
                </label>
                <div class="col-sm-6">
                  <input
                    @keypress="onlyNumber"
                    v-model="PrecioVenta1"
                    type="text"
                    class="form-control"
                    id="PrecioVenta1"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-sm-6 col-form-label"
                  >Precio x rollo</label
                >
                <div class="col-sm-6">
                  <input
                    @keypress="onlyNumber"
                    v-model="PrecioVenta2"
                    type="text"
                    class="form-control"
                    id="PrecioVenta2"
                  /> 
                </div>
              </div>
              
              <div class="form-group row">
                <label for="password" class="col-sm-6 col-form-label"
                  >Precio especial x 25 /15 mtrs</label
                >
                <div class="col-sm-6">
                  <input
                    @keypress="onlyNumber"
                    v-model="PrecioVenta3"
                    type="text"
                    class="form-control"
                    id="PrecioVenta3"
                  /> 
                </div>
              </div>
            </div>
            <!--right side -->
          </div>
          <div class="row">
            <label for="password2" class="col-sm-12 col-form-label"
              >Descripcion</label
            >
            <div class="col-sm-12">
              <input
                v-model="descripcion"
                type="text"
                class="form-control"
                id="descripcion"
              />
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-sm-12 text-center">
              <b-button
                size="md"
                v-if="nombre && unidades && PrecioVenta1 && preciocompra"
                variant="primary"
                @click="createNewProducto()"
                >Guardar</b-button
              >
              <b-button size="md" v-else disabled variant="primary"
                >Guardar</b-button
              >
            </div>
          </div>

          <!-- form for teacher/student-->
        </form>
      </div>
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
      producto: "",
      infoproducto: [],
      nombre: "",
      codigo: "",
      descripcion: "",
      unidades: "",
      iva: 12,
      PrecioVenta1: "",
      PrecioVenta2: "",
      PrecioVenta3:"",
      Utilidad:"",
      preciocompra:"",
      
    };
  },
  mounted() {
  //  console.log("Component mounted.");
  },
  methods: {
    clearfields() {
      this.nombre = "";
      this.codigo = "";
      this.descripcion = "";
      this.unidades = "";
      this.iva = "";
      this.PrecioVenta3 = "";
      this.PrecioVenta1 = "";
      this.PrecioVenta2 = "";

      this.preciocompra="";
      
    },
    createNewProducto() {
      let data = {
        nombre: this.nombre,
        codigo: this.codigo,
        descripcion: this.descripcion,
        unidades: this.unidades,
        iva: this.iva,
        PrecioVenta1: this.PrecioVenta1,
        PrecioVenta2: this.PrecioVenta2,
        PrecioVenta3: this.PrecioVenta3,
        
        preciocompra: this.preciocompra,
        
      };
      ProductoServices.createNewProducto(data)
        .then((response) => {
          let mensaje = response.data.data;
     

     if (mensaje == 200) {

 this.$swal
        .fire({
 icon: 'success',
  title: 'Tu producto ha sido creado',
  showConfirmButton: false,
  timer: 1500
})

            this.$emit("updateProducto");
          }



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
  },
};
</script>
