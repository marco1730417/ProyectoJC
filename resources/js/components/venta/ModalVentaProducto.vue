<template>
  <div class="card">
    <div class="card-body">
      <form>
        <div class="row">
          <label for="password2" class="col-sm-12 col-form-label text-center"
            >Producto</label
          >
          <div class="col-sm-12">
            <i @click="clear" class="fas fa-eraser"></i>
            <v-select
              label="descripcion"
              v-model="producto"
              :options="infoproducto"
              required
            ></v-select>
            <small v-if="producto">
              {{ producto.descripcion }} - Disponible #
              {{ producto.unidades }} mtrs
            </small>
          </div>
        </div>
        <br />

        <div  class="row">
          <div class="col-4">
            <!--left side -->
            <div class="form-group row">
              <label for="lname" class="col-sm-12 col-form-label text-center"
                >Cantidad</label
              >
              <div class="col-sm-12">
                <input
                  v-model="cantidad"
                  @keypress="onlyNumber"
                  type="number"
                  class="form-control"
                  id="cantidad"
                />
              </div>
              <br />
              <div v-if="precioUnitario == 2" class="col-sm-12">
                <label for="lname" class="col-sm-12 col-form-label text-center"
                  >Metros x rollo</label
                >
                <input
                  v-model="metrosrollo"
                  @keypress="onlyNumber"
                  type="number"
                  class="form-control"
                  id="metrosrollo"
                /> <small>Favor ingrese cuantos metros tiene cada rollo</small>
              </div>
            </div>
          </div>

          <div v-if="producto" class="col-8">
            <!--left side -->
            <div class="form-group row">
              <label for="lname" class="col-sm-12 col-form-label text-center"
                >Escoja un precio</label
              >
              <div class="col-sm-12">
                <b-row v-if="producto.PrecioVenta1" class="my-1">
                  <b-col sm="9  ">
                    <label for="input-none"
                      >Precio x metro ( $ {{ producto.PrecioVenta1 }})
                    </label>
                  </b-col>
                  <b-col sm="3">
                    <input
                      class="form-check-input"
                      type="radio"
                      v-model="precioUnitario"
                      :value="1"
                    />
                    <!--      <label class="form-check-label" for="flexRadioDefault2">
                 
                    </label> -->
                  </b-col>
                </b-row>
                <b-row v-if="producto.PrecioVenta2" class="my-1">
                  <b-col sm="9">
                    <label for="input-none"
                      >Precio x rollo ( $ {{ producto.PrecioVenta2 }})
                    </label>
                  </b-col>
                  <b-col sm="3">
                    <input
                      class="form-check-input"
                      type="radio"
                      v-model="precioUnitario"
                      :value="2"
                    />
                    <!--        <label class="form-check-label" for="flexRadioDefault2">
                      {{ producto.PrecioVenta2 }}
                    </label> -->
                  </b-col>
                </b-row>
                <b-row v-if="producto.PrecioVenta3" class="my-1">
                  <b-col sm="9">
                    <label for="input-none"
                      >Precio x (25/15m) ( $ {{ producto.PrecioVenta3 }})
                    </label>
                  </b-col>
                  <b-col sm="3">
                    <input
                      class="form-check-input"
                      type="radio"
                      v-model="precioUnitario"
                      :value="3"
                    />
                    <!--     <label class="form-check-label" for="flexRadioDefault2">
                      {{ producto.PrecioVenta3 }}
                    </label> -->
                  </b-col>
                </b-row>
                   <b-row  class="my-1">
                  <b-col sm="6">
                    <label for="input-none"
                      >Precio Especial 
                    </label>
                  </b-col>
                  <b-col sm="6">
              <input
                      class="form-check-input"
                      type="radio"
                      v-model="precioUnitario"
                      :value="4"
                    />
                     <b-form-input v-if="precioUnitario==4" v-model="precioEspecial" type="number" ></b-form-input>
                    <!--     <label class="form-check-label" for="flexRadioDefault2">
                      {{ producto.PrecioVenta3 }}
                    </label> -->
                  </b-col>
                </b-row>
              </div>

                  <div  class="col-sm-12">
                <label v-if="total_metro_rollo==false" for="lname" class="col-sm-12 col-form-label text-center"
                  >No existe suficiente stock (Existen maximo  {{ producto.unidades }} mtrs )</label
                >
                  <label v-if="validacion_metro==false" for="lname" class="col-sm-12 col-form-label text-center"
                  >No existe suficiente stock (Existen maximo  {{ producto.unidades }} mtrs )</label
                >
        
              </div>


            </div>


          </div>

          <!--right side -->
        </div>
      <!--   <div >
          No existe stock del producto
        </div> -->

        <div class="row" v-if="precioUnitario == 1 || precioUnitario == 3 ">
          <div class="col-sm-12 text-center">
            <b-button
              v-if="producto && cantidad && precioUnitario &&validacion_metro===true"
              size="md"
              variant="primary"
              @click="createDetalleVenta(producto.id)"
              >Agregar</b-button
            >
            <b-button v-else disabled size="md" variant="primary"
              >Agregar</b-button
            >
          </div>
        </div>
      <!--   {{total_metro_rollo}} -->

        <div class="row" v-if="precioUnitario == 2">
          <div class="col-sm-12 text-center">
            <b-button
              v-if="producto && cantidad && precioUnitario && metrosrollo && total_metro_rollo===true"
              size="md"
              variant="primary"
              @click="createDetalleVenta(producto.id)"
              >Agregar</b-button
            >
            <b-button v-else disabled size="md" variant="primary"
              >Agregar</b-button
            >
          </div>
        </div>


<div class="row" v-if="precioUnitario == 4">
          <div class="col-sm-12 text-center">
            <b-button
              v-if="producto && cantidad && precioEspecial && validacion_metro "
              size="md"
              variant="primary"
              @click="createDetalleVentaEspecial(producto.id)"
              >Agregar</b-button
            >
            <b-button v-else disabled size="md" variant="primary"
              >Agregar</b-button
            >
          </div>
        </div>


  <!--      {{validacion_metro}}  -->

        <!-- form for teacher/student-->
      </form>
    </div>
  </div>
</template>


<script>
import ProductoServices from "../../services/productoServices";
import VentaServices from "../../services/ventaServices";
import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";
Vue.use(BootstrapVue);
export default {
  components: {
    "v-select": vSelect,
  },
  props: ["venta"],
  data() {
    return {
      producto: "",
      infoproducto: [],
      cantidad: "",
      precioUnitario: "",
      proId: "",
      unidades: "",
      iva: "",
      PrecioVenta1: "",
      metrosrollo: "",
      precioEspecial:"",      
    };
  },
  mounted() {
    //  console.log("Component mounted.");
    this.getAllProductos();
  }, computed: {

   total_metro_rollo: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      if(this.cantidad>0  && this.metrosrollo>0){ 
      
      let stock = this.producto.unidades;
      let totalxrollo = parseFloat(this.cantidad) * parseFloat(this.metrosrollo);
       if (stock < totalxrollo)  return false; 
       if (stock >= totalxrollo) return true; 

      
       
      }
    },
       validacion_metro: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      if(this.cantidad>0 ){ 
      
      let stock = this.producto.unidades;
      let cantidades = this.cantidad;
       if (stock < cantidades)  return false; 
       if (stock >= cantidades) return true; 

      
       
      }
    },

    

 
  },
  methods: {
    clear(){
this.producto="";
this.metrosrollo="";
this.cantidad="";
this.precioUnitario="";

    },
    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
    },
    clearfields() {
      this.cantidad = "";
      this.precioUnitario = "";
      this.producto = "";
      this.metrosrollo = "";
      this.precioEspecial = "";
      
    },
    getAllProductos() {
      ProductoServices.getAllProductos(this.cofId)
        .then((response) => {
          this.infoproducto = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    createDetalleVenta(id) {
      let data = {
        cantidad: this.cantidad,
        precioUnitario: this.precioUnitario,
        proId: id,
        venId: this.venta,
        metrosrollo: this.metrosrollo,
         precioEspecial: 0,
      };
      VentaServices.createDetalleVenta(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$emit("updateVenta");
            this.clearfields();
            this.getAllProductos();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
       createDetalleVentaEspecial(id) {
      let data = {
        cantidad: this.cantidad,
        precioUnitario: this.precioUnitario,
        proId: id,
        venId: this.venta,
        metrosrollo: this.metrosrollo,
        precioEspecial: this.precioEspecial,
      };
      VentaServices.createDetalleVenta(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$emit("updateVenta");
            this.clearfields();
            this.getAllProductos();
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
