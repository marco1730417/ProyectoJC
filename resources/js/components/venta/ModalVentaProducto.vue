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
            <small v-if="producto">
              {{ producto.descripcion }} - Disponible #
              {{ producto.unidades }} mtr
            </small>
          </div>
        </div>
        <br />

        <div v-if="producto.unidades >0" class="row">
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
                      >Precio Especial ( $ {{ producto.PrecioVenta3 }})
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
              </div>
            </div>
          </div>

          <!--right side -->
        </div>
        <div v-else>
          No existe stock del producto
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
