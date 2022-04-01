<template>
<main class="container">
<!--   <p>Observaciones</p> -->

  <div class="input-group">
      <textarea    v-model="observacion" class="form-control custom-control" rows="2" style="resize:none"></textarea>     
      <span    v-if="observacion"
                @click="updateObservacion()" class="input-group-addon btn btn-primary">Send</span>
                 <span   v-else class="input-group-addon btn btn-primary">Send</span>

  </div>
</main>
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
