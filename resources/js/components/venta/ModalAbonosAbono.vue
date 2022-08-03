<template>
    
                  <div>
                        <!--   <h5>Total a cobrar : $ {{ infoabonos.totalcobrar }}</h5> -->
                        <h5>
                          TOTAL A COBRAR : ${{
                            parseFloat(infoabonos.totalcobrar).toFixed(2)
                          }}
                        </h5>
                        <h5>
                          FECHA MÁXIMA :
                          {{
                            moment(infoabonos.fechamaxima, "YYYY-MM-DD").format(
                              "MMM DD YYYY, ddd"
                            )
                          }}
                        </h5>
                        <b-progress
                          :value="infoabonos.total_abonos"
                          :max="infoabonos.totalcobrar"
                          show-progress
                          animated
                        ></b-progress>
                        <b-table
                          striped
                          hover
                          :items="infoabonos.detalle_venta"
                          :fields="fields"
                        >
                          <template #cell(fecha)="data">
                            {{
                              moment(
                                data.item.fecha,
                                "YYYY-MM-DD, h:mm:ss a"
                              ).format("MMM DD YYYY, ddd, h:mm:ss a")
                            }}
                          </template>
                          <template #cell(tipoabono)="data">
                            <span v-if="data.item.tipoabono == 1">
                              Efectivo
                            </span>
                            <span v-if="data.item.tipoabono == 2">
                              Transferencia
                            </span>
                            <span v-if="data.item.tipoabono == 3">
                              Cheque
                            </span>
                          </template>
                        </b-table>

                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Cantidad recibida</p>
                          <input
                           @keypress="onlyNumber"
                            class="form-control"
                            type="number"
                            v-model="pagorecibido"
                          />
                        </div>

                        <div class="mb-3">
                          <b-form-group>
                            <b-form-radio-group
                              v-model="tipoabono"
                              :options="options"
                              name="radio-inline"
                            ></b-form-radio-group>
                          </b-form-group>
                        </div>

                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Detalle Abono</p>
                          <input
                            class="form-control"
                            type="text"
                            v-model="detalleabono"
                          />
                        </div>

                        <div class="mb-3"></div>
                        <div>
                          <div class="address">
                            <div class="d-flex flex-column dis">
                              <div
                                class="
                                  d-flex
                                  align-items-center
                                  justify-content-between
                                  mb-2
                                "
                              >
                                <p>Pendiente</p>
                                <p>
                                  <span class="fas fa-dollar-sign"></span>
                                  {{ parseFloat(infoabonos.saldo).toFixed(2) }}
                                </p>
                              </div>

                              <div
                                class="
                                  d-flex
                                  align-items-center
                                  justify-content-between
                                  mb-2
                                "
                              >
                                <p>Abono</p>
                                <p>
                                  <span class="fas fa-dollar-sign"></span
                                  >{{ pagorecibido }}
                                  <!--  {{
                                      parseFloat(pagorecibido).toFixed(2)
                                    }} -->
                                </p>
                              </div>
                              <div
                                class="
                                  d-flex
                                  align-items-center
                                  justify-content-between
                                  mb-2
                                "
                              >
                                <p>Saldo</p>
                                <p>
                                  <span class="fas fa-dollar-sign"></span>
                                  {{ parseFloat(total_saldo).toFixed(2) }}
                                </p>
                              </div>

                              <div
                                v-if="pagorecibido"
                                @click="
                                  registrarabono(
                                    pagorecibido,
                                    infoabonos.detalle_venta
                                  )
                                "
                                class="btn btn-primary mt-2"
                              >
                                <span class="fas fa-dollar-sign px-1"></span
                                >Guardar Abono
                              </div>
                            </div>
                          </div>
                        </div>
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
  props:['infoabonos'],
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
  

      fields: [
        {
          key: "abono",
          label: "Abono",
        },
        {
          key: "fecha",
          label: "Fecha",
        },
        {
          key: "tipoabono",
          label: "Tipo",
        },
        {
          key: "detalleabono",
          label: "Detalle",
        },
      ],
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      infocliente: [],
      loading: false,
      detalleventa: [],
      totalventas: "",
      infoventa: [],
      infopagosventa: [],
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
  onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
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

