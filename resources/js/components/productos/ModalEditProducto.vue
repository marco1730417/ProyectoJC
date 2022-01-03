<template>
  <div class="container">
    <div class="row">
<!--    {{infoeditproducto}} -->
    <div class="col-12">
        <div  class="card p-3">
          <div class="card-body border p-0">
            <p>
              <a
                class="
                  btn btn-primary
                  p-2
                  w-100
                  h-100
                  d-flex
                  align-items-center
                  justify-content-between
                "
                data-bs-toggle="collapse"
                href="#collapseExample"
                role="button"
                aria-expanded="true"
                aria-controls="collapseExample"
              >
                <span class="fw-bold">Informacion General</span>
              </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">
              <div  class="row">
                <div class="col-lg-12 mb-lg-0 mb-3">
              
              <b-row class="my-1">
    <b-col sm="2">
      <label for="input-small">Codigo:</label>
    </b-col>
    <b-col sm="10">
      <b-form-input  v-model="infoeditproducto.nombre" id="input-small" size="sm" placeholder="Ingrese el codigo"></b-form-input>
    </b-col>
  </b-row>
  <b-row class="my-1">
    <b-col sm="2">
      <label for="input-small">Descripcion:</label>
    </b-col>
    <b-col sm="10">
      <b-form-input  v-model="infoeditproducto.descripcion" id="input-small" size="sm" placeholder="Ingrese la descripcion"></b-form-input>
    </b-col>
  </b-row>
                </div>
            
              </div>
            </div>
          </div>
        </div>
      </div>





      <div class="col-12">
        <div  class="card p-3">
          <div class="card-body border p-0">
            <p>
              <a
                class="
                  btn btn-primary
                  p-2
                  w-100
                  h-100
                  d-flex
                  align-items-center
                  justify-content-between
                "
                data-bs-toggle="collapse"
                href="#collapseExample"
                role="button"
                aria-expanded="true"
                aria-controls="collapseExample"
              >
                <span class="fw-bold">Precios</span>
              </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">
              <div  class="row">
                <div class="col-lg-4 mb-lg-0 mb-3">
                  <label
                    for="lname"
                    class="col-sm-12 col-form-label text-center"
                    >PV1</label
                  >
                  <div class="col-sm-12">
                    <input
                    v-model="infoeditproducto.PrecioVenta1"
                      @keypress="onlyNumber"
                      type="number"
                      class="form-control"
                      id="cantidad"
                    />
               <!--       <small
                  v-if="PrecioVenta1 "
                  for="lname"
                  class="col-sm-12 col-form-label"
                  >Precio IVA: $ {{ parseFloat(PrecioVenta1*1.12).toFixed(2) }}
                </small> -->
                  </div>
            
                   <label
                    for="lname"
                    class="col-sm-12 col-form-label text-center"
                    >PV2</label
                  >
                  <div class="col-sm-12">
                    <input
                    v-model="infoeditproducto.PrecioVenta2"
                      @keypress="onlyNumber"
                      type="number"
                      class="form-control"
                      id="cantidad"
                    />
                       
                  </div> 
                        <label
                    for="lname"
                    class="col-sm-12 col-form-label text-center"
                    >PV3</label
                  >
                  <div class="col-sm-12">
                    <input
                    v-model="infoeditproducto.PrecioVenta3"
                      @keypress="onlyNumber"
                      type="number"
                      class="form-control"
                      id="cantidad"
                    />
                  </div>
             
                </div>
                <div class="col-lg-8 mb-lg-0 mb-3">
                  <form action="" class="form">
                    <div class="row">
                      <div  class="col-8">
                        <!--left side -->
                        <div class="form-group row">


    <div class="col-lg-12 mb-lg-0 mb-3">
  
    <b-form-group label="Escoja la unidad para el PV1" >
  <b-form-radio-group  id="radio-group-1"  
    name="radio-sub-component1">
    <b-form-radio v-for="item in options"  v-model="infoeditproducto.uniPrecioVenta1" :key="item.value" :value="item.value" >{{item.text}}</b-form-radio>
<!-- {{selectedpv1}} -->
  </b-form-radio-group>
</b-form-group>
                </div>
       <div class="col-lg-12 mb-lg-0 mb-3">
    
    <b-form-group label="Escoja la unidad para el PV2" >
  <b-form-radio-group  id="radio-group-2"  
    name="radio-sub-component2">
    <b-form-radio v-for="item in options"  v-model="infoeditproducto.uniPrecioVenta2" :key="item.value" :value="item.value" >{{item.text}}</b-form-radio>
<!-- {{selectedpv2}} -->
  </b-form-radio-group>
</b-form-group>
                </div>
                     <div class="col-lg-12 mb-lg-0 mb-3">
    
    <b-form-group label="Escoja la unidad para el PV3" >
  <b-form-radio-group  id="radio-group-2"  
    name="radio-sub-component3">
    <b-form-radio v-for="item in options"  v-model="infoeditproducto.uniPrecioVenta3" :key="item.value" :value="item.value" >{{item.text}}</b-form-radio>
<!-- {{selectedpv3}} -->
  </b-form-radio-group>
</b-form-group>
                </div>
                



             


                    
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- 
      UNIDADES -->
         <div class="col-12">
        <div class="card p-3">
          <div class="card-body border p-0">
            <p>
              <a
                class="
                  btn btn-primary
                  p-2
                  w-100
                  h-100
                  d-flex
                  align-items-center
                  justify-content-between
                "
                data-bs-toggle="collapse"
                href="#collapseExample"
                role="button"
                aria-expanded="true"
                aria-controls="collapseExample"
              >
                <span class="fw-bold">Cantidades    </span>
              </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">

          <b-container fluid>
 
  <b-row class="my-1">
    <b-col sm="5">
      <label for="input-small">Cantidad total de {{infoeditproducto.uniPrecioVenta1}} :</label>
    </b-col>
    <b-col sm="7">
      <b-form-input  v-model="infoeditproducto.unidades" id="input-small" size="md" :placeholder="'Ingrese el numero total de '+selectedpv1"></b-form-input>
    </b-col>
  </b-row>

     <b-row class="my-1">
    <b-col sm="5">
      <label for="input-small">Cantidad de {{infoeditproducto.uniPrecioVenta1}} por cada {{infoeditproducto.uniPrecioVenta2}}   :</label>
    </b-col>
    <b-col sm="7">
      <b-form-input  v-model="infoeditproducto.metrosrollo" id="input-small" size="md" :placeholder="'Ingrese el numero de '+selectedpv1+'por cada '+selectedpv2" ></b-form-input>
    </b-col>
  </b-row>
<!--   {{infoeditproducto}} -->

</b-container>

                  
     


            </div>
          </div>
        </div>

 



      </div>

      
      <div  class="col-12 text-center ">
        <div
        v-if="infoeditproducto.unidades && infoeditproducto.PrecioVenta1 && infoeditproducto.nombre"
        
          @click="UpdateProducto(infoeditproducto)"
          class="btn btn-primary payment"
        >
          Editar Producto
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import ProductoServices from "../../services/productoServices";

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  props: ["infoeditproducto"],
  data() {
    return {
         selectedpv1: "",
        selectedpv2:"",
        selectedpv3: "",
        metrosrollo:"",
          uniPrecioVenta1:"",
      uniPrecioVenta2:"",
      uniPrecioVenta3:"",
    
      rollos:"",
        options: [
          { text: 'mt', value: 'mt' },
          { text: 'rll', value: 'rll' },
          { text: 'u', value: 'u' },
          { text: 'cj', value: 'cj' },
          
        ],
      show: true,
      producto: "",
      infoproducto: [],
      nombre: "",
      codigo: "",
      descripcion: "",
      unidades: "",
      PrecioVenta1: "",
      iva: "",
    };
  },
  mounted() {},
  methods: {
    clearfields() {
      this.nombre = "";
      this.codigo = "";
      this.descripcion = "";
      this.unidades = "";
      this.iva = "";
      this.PrecioVenta1 = "";
    },
    UpdateProducto(infoedicionproducto) {
      let data = {
        informacionedicionproducto: infoedicionproducto,
      };
      ProductoServices.UpdateProducto(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {

 this.$swal
        .fire({
 icon: 'success',
  title: 'Tu producto ha sido actualizado',
  showConfirmButton: false,
  timer: 1500
})

            this.$emit("updateProductos");
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
