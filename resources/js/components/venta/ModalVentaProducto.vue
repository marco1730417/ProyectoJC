<template>
  <div class="card">
    <div class="card-body">
      <form>
        <div class="row">
          <label for="password2" class="col-sm-12 col-form-label text-center"
            >Producto</label
          >
          <div class="col-sm-12">
            <v-select
              label="nombre"
              v-model="producto"
              :options="infoproducto"
              required
            ></v-select>
          </div>
        </div>
        <br />

        <div class="row">
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
                  >Metros Totales</label
                >
                <input
                  v-model="metrosrollo"
                  @keypress="onlyNumber"
                  type="number"
                  class="form-control"
                  id="metrosrollo"
                />
              </div>
            </div>
          </div>

          <div class="col-8">
            <!--left side -->
            <div class="form-group row">
              <label for="lname" class="col-sm-12 col-form-label text-center"
                >Precio</label
              >
              <div class="col-sm-12">
                <!-- 
                <div style="float: left" class="form-check">
                   <label class="form-check-label" for="flexRadioDefault1">
      
                  </label>
                  <input
                    class="form-check-input"
                    type="radio"
                    v-model="precioUnitario"
                    checked
                    :value="1"
                  />
                  <label class="form-check-label" for="flexRadioDefault1">
                    {{ producto.PrecioVenta1 }}
                  </label>
                </div> -->

                <b-row class="my-1">
                  <b-col sm="9  ">
                    <label for="input-none">Precio Venta 1 (  $   {{ producto.PrecioVenta1 }}) </label>
                  </b-col>
                  <b-col sm="3" >
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
                <b-row class="my-1">
                  <b-col sm="9">
                     <label for="input-none">Precio Venta 2 (  $  {{ producto.PrecioVenta2 }}) </label>
                
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
                <b-row class="my-1">
                  <b-col sm="9">
                       <label for="input-none">Precio Venta 3 (  $   {{ producto.PrecioVenta3 }}) </label>
                
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

                <!--      <br />
                <div style="float: left" class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    v-model="precioUnitario"
                    :value="2"
                  />
                  <label class="form-check-label" for="flexRadioDefault2">
                    {{ producto.PrecioVenta2 }}
                  </label>
                </div>
                <br />
                <div style="float: left" class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    v-model="precioUnitario"
                    :value="3"
                  />
                  <label class="form-check-label" for="flexRadioDefault2">
                    {{ producto.PrecioVenta3 }}
                  </label>
                </div> -->
                <!-- 
                 {{precioUnitario}}  -->
              </div>
            </div>
          </div>

          <!--right side -->
        </div>

        <div class="row" v-if="precioUnitario == 1 || precioUnitario == 3">
          <div class="col-sm-12 text-center">
            <b-button
              v-if="producto && cantidad && precioUnitario"
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

        <div class="row" v-if="precioUnitario == 2">
          <div class="col-sm-12 text-center">
            <b-button
              v-if="producto && cantidad && precioUnitario && metrosrollo"
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
    };
  },
  mounted() {
    //  console.log("Component mounted.");
    this.getAllProductos();
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
    clearfields() {
      this.cantidad = "";
      this.precioUnitario = "";
      this.producto = "";
      this.metrosrollo = "";
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
      };
      VentaServices.createDetalleVenta(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$emit("updateVenta");
            this.clearfields();
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
