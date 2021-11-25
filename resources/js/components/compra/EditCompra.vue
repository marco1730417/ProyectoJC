<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
       

        
          </div>
        </div>
      </div>
    </div>



  </div>
</template>


<script>
import VentaServices from "../../services/ventaServices";
import ClienteServices from "../../services/clienteServices";
import ProveedorServices from "../../services/proveedorServices";
import Conf from "../../services/conf.js";

const resource = "api/venta/";
const server = Conf.server;
import moment from "moment";
import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";

Vue.use(BootstrapVue);
export default {
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      modeupdate: false,
      clienteupdate: "",
      formadepagoupdate: "",
      infoproveedor: [],
      loading: false,
      infoeditcliente: [],
      camposactivos: false,
      totalesventa: [],
      detalleventa: [],
      detallegeneralventa: [],
      pagorecibido: "",
      pagorecibidotransferencia: "",
      detalletransferencia: "",
      filter: null,
      substr: "",
    };
  },
  created() {
    this.myFunction();
  },

  mounted() {
    this.getAllProveedores();
      },
  methods: {
    updateDatos() {
      this.getInformacionVenta();
      this.totalesVenta();
    },
    onOver() {
      this.$refs.dropdown.visible = true;
    },
    onLeave() {
      this.$refs.dropdown.visible = false;
    },
 /*    deleteDetalleVenta(id) {
      VentaServices.deleteDetalleVenta(id)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.getInformacionVenta();
            this.totalesVenta();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, */

  

    getAllProveedores() {
      ProveedorServices.getAllProveedores()
        .then((response) => {
          this.infoproveedor = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

 
    

    actualizarVenta(cliente) {
      let data = {
        cliId: cliente,
        venId: this.substr,
      };

      VentaServices.updateVenta(data)
        .then((response) => {
          let mensaje = response.data.data;
      this.detalleGeneralVenta();
    
        })
        .catch((error) => {
          console.log(error);
        });
    },
    myFunction: function () {
      this.substr = this.$route.path;
      this.substr = this.substr.substring(11);
    },
  },
};
</script>


