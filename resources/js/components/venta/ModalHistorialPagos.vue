<template>
    
         <div>
                        <h5>
                          Total Venta :
                          <span v-if="infopagosventa.totalcobrar">
                            ${{
                              parseFloat(infopagosventa.totalcobrar).toFixed(2)
                            }}
                          </span>
                          <span v-else>0</span>
                        </h5>

                        <b-progress
                          :value="infopagosventa.total_abonos"
                          :max="infopagosventa.totalcobrar"
                          show-progress
                          animated
                        ></b-progress>
                        <b-table
                          striped
                          hover
                          :items="infopagosventa.detalle_venta"
                          :fields="fields2"
                        >
                          <template #cell(pago)="data">
                            <span v-if="data.item.pago > 0"
                              >$ {{ parseFloat(data.item.pago).toFixed(2) }}
                            </span>
                            <span v-else>0</span>
                          </template>

                          <template #cell(total)="data">
                            $ {{ parseFloat(data.item.total).toFixed(2) }}
                          </template>

                          <template #cell(fecha)="data">
                            {{
                              moment(
                                data.item.fecha,
                                "YYYY-MM-DD, h:mm:ss a"
                              ).format("MMM DD YYYY, ddd")
                            }}
                          </template>
                          <template #cell(cheque)="data">
                            <span
                              v-if="data.item.cheque || data.item.numtransf"
                            >
                              {{ data.item.cheque }} {{ data.item.numtransf }}

                              <strong v-if="data.item.fechamaxima"
                                >- Fecha máxima
                              </strong>
                              <span v-if="data.item.fechamaxima">
                                {{
                                  moment(data.item.fechamaxima).format(
                                    "MMM DD YYYY"
                                  )
                                }}
                              </span>
                            </span>

                            <span v-else> N/A</span>
                          </template>

                          <template #cell(actions)="data">
                            <!--  {{data.item}} -->
                            <b-button
                              variant="outline-danger default actions"
                              size="sm"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Eliminar"
                              @click="deletePago(data.item.id)"
                            >
                              <i class="fas fa-trash"></i>
                            </b-button>
                          </template>
                        </b-table>
                      </div>

</template>


<script>
import VentaServices from "../../services/ventaServices";
import pagoServices from "../../services/pagoServices";
import Conf from "../../services/conf.js";

const resource = "api/venta/";
const server = Conf.server;

import { BootstrapVue } from "bootstrap-vue";
import vSelect from "vue-select";
import moment from "moment";
moment.locale("es");
Vue.use(BootstrapVue);

export default {
  props:['infopagosventa'],
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      tipoabono: "1",
      tipoabonocredito: "1",

      detalleabono: "",
      detalleabonocredito: "",
      options: [
        { text: "Efectivo", value: "1" },
        { text: "Transferencia", value: "2" },
        { text: "Cheque", value: "3" },
      ],
      perPage: 10,
      currentPage: 1,
      filter: null,
  
      fields2: [
        {
          key: "fecha",
          label: "Fecha",
        },
        {
          key: "tipo",
          label: "Forma de Pago",
        },
        {
          key: "cheque",
          label: "Detalle",
        },

        {
          key: "pago",
          label: "Pago",
        },
   

        { key: "actions", label: "Acciones", tdClass: "list-item-enddate" },
      ],
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      infocliente: [],
      loading: false,
      detalleventa: [],
      totalventas: "",
      infoventa: [],
      text: "",
      formadepago: "",
      pagorecibido: "",
      saldo: "",
      venta: "",
    };
  },
  computed: {

  total_saldo: function () {
      let total = this.infoabonos.saldo;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo = tt;

      return tt;
    },
 
  },

  methods: {
    deletePago(id) {
      pagoServices
        .deletePago(id)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            location.reload();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

     registrarabono(pago, info) {
      let data = {
        info: info,
        pago: pago,
        saldo: this.saldo,
        tipoabono: this.tipoabono,
        detalleabono: this.detalleabono,
      };
      VentaServices.registrarabono(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Abono registrado",
              showConfirmButton: false,
              timer: 1500,
            });
            location.reload();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  


  },
};
</script>

