<template>
  <div class="card">
    <div class="card-body">
      <form>
        <div class="row">
          <div class="col-6">
            <!--left side -->
            <div class="form-group row">
              <label for="fname" class="col-sm-4 col-form-label">Nombre</label>
              <div class="col-sm-8">
                <input
                  v-model="infoeditproducto.nombre"
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
                  v-model="infoeditproducto.unidades"
                  type="text"
                  class="form-control"
                  id="unidades"
                /><small>Favor ingresar unidades en metros</small>
              </div>
            </div>

            <div class="form-group row">
              <label for="lname" class="col-sm-4 col-form-label">Iva</label>
              <div class="col-sm-8">
                <div class="row">
                  <b-form-group id="input-group-2" label-for="input-2">
                    <b-form-radio
                      v-model="infoeditproducto.iva"
                      name="some-radios"
                      value="12"
                    >
                      12
                    </b-form-radio>
                    <b-form-radio
                      v-model="infoeditproducto.iva"
                      name="some-radios"
                      value="0"
                    >
                      0
                    </b-form-radio>
                  </b-form-group>
                  <!--     {{iva}} -->
                </div>
              </div>
            </div>

                 <div class="form-group row">
                <label
                  v-if="infoeditproducto.PrecioVenta1 && infoeditproducto.preciocompra"
                  for="lname"
                  class="col-sm-12 col-form-label"
                  >Su utilidad x metro es $
           <!--        {{ infoeditproducto.PrecioVenta1 - infoeditproducto.preciocompra }} -->
                    {{ parseFloat(infoeditproducto.PrecioVenta1 - infoeditproducto.preciocompra).toFixed(2) }}
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
                  v-model="infoeditproducto.preciocompra"
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
                  v-model="infoeditproducto.PrecioVenta1"
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
                  v-model="infoeditproducto.PrecioVenta2"
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
                    v-model="infoeditproducto.PrecioVenta3"
                    type="text"
                    class="form-control"
                    id="PrecioVenta3"
                  /> <small> Este precio aplica por metro </small>
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
              v-model="infoeditproducto.descripcion"
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
              variant="primary"
              @click="UpdateProducto(infoeditproducto)"
              >Guardar</b-button
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

import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
export default {
  props: ["infoeditproducto"],
  data() {
    return {
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
