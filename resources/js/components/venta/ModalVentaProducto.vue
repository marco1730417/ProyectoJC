<template>
  <div class="container">
    <div class="row">
      <div class="float-end">
      <button title="Actualizar Productos" @click="getAllProductos" class="btn  btn-sm"><i  class="fas fa-sync"></i></button>

<button  title="Limpiar" @click="clear" class="btn  btn-sm"><i  class="fas fa-broom"></i></button>
</div>
      <label for="password2" class="col-sm-12 col-form-label text-center"
        >Producto</label
      >
      <div class="col-sm-12">
    <!--     <i @click="clear" class="fas fa-eraser"></i> -->
<!-- <button type="button" @click="clear" class="btn btn-outline-primary">Limpiar</button> -->
<!-- <button type="button" class="btn btn-primary btn-sm">Small button</button> </br> -->
<!-- <a href="#" @click="clear" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Limpiar</a>
<a href="#" @click="clear" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Actualizar</a> -->
<!-- <button class="btn"><i class="fa fa-home"></i></button> -->
<!-- <i class="fa fa-home" style="font-size:24px"></i> -->

        <v-select
          label="descripcion"
          v-model="producto"
          :options="infoproducto"
          required
        ></v-select>
        <small v-if="producto"> 
            <strong class="text-info"> Codigo:  </strong>  {{ producto.nombre }}
        <strong class="text-info"> Stock:  </strong>  {{ producto.unidades }} mtrs
<!--        {{producto}} -->
        </small>
      </div>

      <div class="col-12">
        <div v-if="producto" class="card p-3">
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
                <span class="fw-bold">Detalles</span>
              </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">
              <div v-if="producto" class="row">
                <div class="col-lg-5 mb-lg-0 mb-3">
                  <label
                    for="lname"
                    class="col-sm-12 col-form-label text-center"
                    >Cantidad</label
                  >
                  <div class="col-sm-8">
                    <input
                      v-model="cantidad"
                      @keypress="onlyNumber"
                      type="number"
                      class="form-control"
                      id="cantidad"
                    />
                  </div>
              
                  <div v-if="status === 'accepted'" class="col-sm-8">
                    <label
                      for="lname"
                      class="col-sm-12 col-form-label text-center"
                      >Descuento</label
                    >
                    <input
                      v-model="descuento"
                      @keypress="onlyNumber"
                      type="number"
                      class="form-control"
                      id="metrosrollo"
                    />
                  </div>
                </div>
                <div class="col-lg-7">
                  <form action="" class="form">
                    <div class="row">
                      <div v-if="producto" class="col-8">
                        <!--left side -->
                        <div class="form-group row">
                          <label
                            for="lname"
                            class="col-sm-12 col-form-label text-center"
                            >Escoja un precio</label
                          >
                          <div class="col-sm-12">
                            <b-row v-if="producto.PrecioVenta1" class="my-1">
                              <b-col sm="9  ">
                                <label for="input-none"
                                  >Precio x {{producto.uniPrecioVenta1}} ( $
                                  {{ producto.PrecioVenta1 }})
                                </label>
                              </b-col>
                              <b-col sm="3">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  v-model="precioUnitario"
                                  :value="1"
                                />
                              </b-col>
                            </b-row>
                            <b-row v-if="producto.PrecioVenta2" class="my-1">
                              <b-col sm="9">
                                <label for="input-none"
                                  >Precio x {{producto.uniPrecioVenta2}} ( $
                                  {{ producto.PrecioVenta2 }})
                                </label>
                              </b-col>
                              <b-col sm="3">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  v-model="precioUnitario"
                                  :value="2"
                                />
                          
                              </b-col>
                            </b-row>
                            <b-row v-if="producto.PrecioVenta3" class="my-1">
                              <b-col sm="9">
                                <label for="input-none"
                                  >Precio esp x {{producto.uniPrecioVenta3}} ( $
                                  {{ producto.PrecioVenta3 }})
                                </label>
                              </b-col>
                              <b-col sm="3">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  v-model="precioUnitario"
                                  :value="3"
                                />
                              </b-col>
                            </b-row>
                          </div>

                          <div class="col-sm-12">
                            <label
                              v-if="total_metro_rollo == false"
                              for="lname"
                              class="col-sm-12 col-form-label text-danger "
                              >No existe suficiente stock (Existen maximo
                              {{ producto.unidades }} mtrs )</label
                            >
                            <label
                              v-if="validacion_metro == false"
                              for="lname"
                              class="col-sm-12 col-form-label text-danger "
                              >No existe suficiente stock (Existen maximo
                              {{ producto.unidades }} mtrs )</label
                            >
                               <label
                              v-if="precioUnitario == 2"
                              for="lname"
                              class="col-sm-12 col-form-label text-info "
                              >Cantidad de {{producto.uniPrecioVenta1}}  por {{producto.uniPrecioVenta2}} es de {{producto.metrosrollo}}  
                           </label
                            >
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
         <div v-if="producto" class="col-12">
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
                <span class="fw-bold">Descuento Extra    </span>
              </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">

              <div  class="col-sm-6">
                    <label
                      for="lname"
                      class="col-sm-6 col-form-label text-center"
                      >Descuento</label
                    >
                    <input
                      v-model="descuento"
                      @keypress="onlyNumber"
                      type="number"
                      class="form-control"
                      id="metrosrollo"
                    />
                  </div>
                  
              <div  class="col-sm-4">
                    <label v-if="descuento"
                      for="lname"
                      class="col-sm-12 col-form-label text-center"
                      >Total descuento:$ {{descuento*cantidad}}  </label
                    >
                
                  </div>


            </div>
          </div>
        </div>

 



      </div>

      <div v-if="precioUnitario == 1 || precioUnitario == 3 " class="col-12">
        <div
          v-if="
            producto && cantidad && precioUnitario && validacion_metro === true  
          "
          @click="createDetalleVenta(producto.id)"
          class="btn btn-primary payment"
        >
          Agregar Producto
        </div>
      </div>
      <div v-if="precioUnitario == 2" class="col-12">
        <div
          v-if="
            producto &&
            cantidad &&
            precioUnitario &&
            total_metro_rollo === true
          "
          @click="createDetalleVenta(producto.id)"
          class="btn btn-primary payment"
        >
          Agregar Producto
        </div>
      </div>

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
      status: "not_accepted",
      producto: "",
      infoproducto: [],
      cantidad: 0,
      precioUnitario: "",
      descuento: 0,
      proId: "",
      unidades: "",
      iva: "",
      PrecioVenta1: "",
      metrosrollo: "",
      precioEspecial: "",
    };
  },
  mounted() {
    //  console.log("Component mounted.");
    this.getAllProductos();
  },
  computed: {
    total_metro_rollo: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      if (this.cantidad > 0 && this.precioUnitario==2 ) {
        let stock = this.producto.unidades;
        let totalxrollo =
          parseFloat(this.cantidad) * parseFloat(this.producto.metrosrollo);
        if (stock < totalxrollo) return false;
        if (stock >= totalxrollo) return true;
      }
    },
    validacion_metro: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      if (this.cantidad > 0) {
        let stock = this.producto.unidades;
        let cantidades = this.cantidad;
        if (stock < cantidades) return false;
        if (stock >= cantidades) return true;
      }
    },
  },
  methods: {
    clear() {
      this.producto = "";
      this.metrosrollo = "";
      this.cantidad = "";
      this.precioUnitario = "";
  
    },
    recargarproductos(){
    this.getAllProductos();
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
      this.cantidad = 0;
      this.precioUnitario = "";
      this.producto = "";
      this.metrosrollo = 0;
      this.precioEspecial = "";
      this.descuento = 0;
      
    },
    getAllProductos() {
      ProductoServices.getAllProductos()
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
        descuento:this.descuento,

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
<style scoped>
import 'font-awesome/scss/font-awesome.scss'

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.container {
  margin: 30px auto;
}

.container .card {
  width: 100%;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  background: #fff;
  border-radius: 0px;
}

body {
  background: #eee;
}

.btn.btn-primary {
  background-color: #ddd;
  color: black;
  box-shadow: none;
  border: none;
  font-size: 20px;
  width: 100%;
  height: 100%;
}

.btn.btn-primary:focus {
  box-shadow: none;
}

.container .card .img-box {
  width: 80px;
  height: 50px;
}

.container .card img {
  width: 100%;
  object-fit: fill;
}

.container .card .number {
  font-size: 24px;
}

.container .card-body .btn.btn-primary .fab.fa-cc-paypal {
  font-size: 32px;
  color: #3333f7;
}

.fab.fa-cc-amex {
  color: #1c6acf;
  font-size: 32px;
}

.fab.fa-cc-mastercard {
  font-size: 32px;
  color: red;
}

.fab.fa-cc-discover {
  font-size: 32px;
  color: orange;
}

.c-green {
  color: green;
}

.box {
  height: 40px;
  width: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ddd;
}

.btn.btn-primary.payment {
  background-color: #1c6acf;
  color: white;
  border-radius: 0px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 24px;
}

.form__div {
  height: 50px;
  position: relative;
  margin-bottom: 24px;
}

.form-control {
  width: 100%;
  height: 45px;
  font-size: 14px;
  border: 1px solid #dadce0;
  border-radius: 0;
  outline: none;
  padding: 2px;
  background: none;
  z-index: 1;
  box-shadow: none;
}

.form__label {
  position: absolute;
  left: 16px;
  top: 10px;
  background-color: #fff;
  color: #80868b;
  font-size: 16px;
  transition: 0.3s;
  text-transform: uppercase;
}

.form-control:focus + .form__label {
  top: -8px;
  left: 12px;
  color: #1a73e8;
  font-size: 12px;
  font-weight: 500;
  z-index: 10;
}

.form-control:not(:placeholder-shown).form-control:not(:focus) + .form__label {
  top: -8px;
  left: 12px;
  font-size: 12px;
  font-weight: 500;
  z-index: 10;
}

.form-control:focus {
  border: 1.5px solid #1a73e8;
  box-shadow: none;
}
</style>