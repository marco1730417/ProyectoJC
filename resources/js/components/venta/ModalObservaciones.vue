<template>
  <div class="container">
    <form action="">
      <!--   {{retencion}} {{ivaretencion}} -->
      <div class="mb-3">
         <b-form-textarea
      id="textarea"
      v-model="observacion"
      placeholder="Enter something..."
      rows="3"
      max-rows="6"
    ></b-form-textarea>
      </div>

      <div class="mb-3"></div>
      <div>
        <div class="address">
          <div class="d-flex flex-column dis">
            <!--  {{retencion}} -->
            <div
              class="d-flex align-items-center justify-content-between mb-2"
            >
              <!--   {{totaldetallegeneral.cliId}}  -->
              <div
                v-if="observacion"
                @click="updateObservacion()"
                class="btn btn-primary mt-2"
              >
                <span class="fas fa-dollar-sign px-1"></span>Guardar Observacion
              </div>
              <div v-else class="btn btn-primary mt-2">
                <span class="fas fa-dollar-sign px-1"></span>Guardar Observacion
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>


<script>
import VentaServices from "../../services/ventaServices";
import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";
Vue.use(BootstrapVue);
export default {
  components: {
    "v-select": vSelect,
  },
  props: ["venId"],
  data() {
    return {
      retencioniva: 0,
      impuestorenta: 0,
      venta: [],
      observacion: "",
    };
  },
  mounted() {
    this.observacionporventa();
  },
  computed: {

  },
  watch:{

  },
  methods: {
    clear() {
      this.retencioniva = "";
      this.impuestorenta = "";
    },
    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
    },

    observacionporventa() {
      VentaServices.observacionporventa(this.venId)
        .then((response) => {
          this.observacion = response.data.data;
          this.observacion= this.observacion.shift();
       })
        .catch((error) => {
          console.log(error);
        });
    },



        updateObservacion() {
      let data = {
        id: this.venId,
        observacion: this.observacion,
      };
      VentaServices.updateObservacion(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
           this.$swal
        .fire({
  icon: 'success',
  title: 'Observacion registrada',
  showConfirmButton: false,
  timer: 1500
})

          }
        })
        .catch((error) => {
              this.$swal
        .fire({
  icon: 'error',
  title: 'Observacion no agregado',
  showConfirmButton: false,
  timer: 1500
})
        });
    },

  },
};
</script>
