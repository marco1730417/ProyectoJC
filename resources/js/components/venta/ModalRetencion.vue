<template>
  <div class="container">
    <form action="">
      <!--   {{retencion}} {{ivaretencion}} -->
      <div class="mb-3">
        <p class="dis fw-bold mb-2">Retencion IVA</p>
        <input
          class="form-control"
          type="number"
          v-model="retencioniva"
          @keypress="onlyNumber"
        />
      </div>
      <!-- {{venId}} -->
      <div class="mb-3">
        <p class="dis fw-bold mb-2">Impuesto Renta</p>
        <input
          class="form-control"
          type="number"
          v-model="impuestorenta"
          @keypress="onlyNumber"
        />
      </div>
      <div class="mb-3"></div>
      <div>
        <div class="address">
          <div class="d-flex flex-column dis">
            <!--  {{retencion}} -->
            <div
              v-if="!retencion"
              class="d-flex align-items-center justify-content-between mb-2"
            >
              <!--   {{totaldetallegeneral.cliId}}  -->
              <div
                v-if="retencioniva "
                @click="GuardarRetencion()"
                class="btn btn-primary mt-2"
              >
                <span class="fas fa-dollar-sign px-1"></span>Guardar Retencion
              </div>
              <div v-else class="btn btn-secondary mt-2">
                <span class="fas fa-dollar-sign px-1"></span>Guardar Retencion
              </div>
            </div>
                       <div
             v-else
              class="d-flex align-items-center justify-content-between mb-2"
            >
              <!--   {{totaldetallegeneral.cliId}}  -->
              <div
                @click="deleteRetencion(retencion.id)"
                class="btn btn-warning mt-2"
              >
                <span class="fas fa-trash"></span>Borrar Retencion
              </div>
             </div>
          </div>
        </div>
      </div>
    </form>
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
  props: ["venId"],
  data() {
    return {
      retencioniva: 0,
      impuestorenta: 0,
      retencion: [],
      ivaretencion: "",
    };
  },
  mounted() {
    //  console.log("Component mounted.");
    this.retencionporventa();
  },
  computed: {},
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

    retencionporventa() {
      VentaServices.retencionporventa(this.venId)
        .then((response) => {
          this.retencion = response.data.data;
          this.retencion = this.retencion.shift();
          this.retencioniva = this.retencion.retencioniva;
          this.impuestorenta = this.retencion.impuestorenta;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  deleteRetencion(id) {
      this.$swal
        .fire({
          title: "Estas seguro de eliminar esta retencion?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            VentaServices.deleteRetencion(id)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {
              location.reload();
              }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },

    GuardarRetencion() {
      let data = {
        retencioniva: this.retencioniva,
        venId: this.venId,
        impuestorenta: this.impuestorenta,
      };
      VentaServices.registrarRetencion(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Retencion registrada",
              showConfirmButton: false,
              timer: 1500,
            });

            this.retencionporventa();
          }
        })
        .catch((error) => {
          this.$swal.fire({
            icon: "error",
            title: "Retencion no agregado",
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },
  },
};
</script>
