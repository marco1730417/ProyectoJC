<template>
    
                      <div>
                        <!--   <h5>Total a cobrar : $ {{ infoabonos.totalcobrar }}</h5> -->
                        <h5>
                          Total a cobrar : ${{
                            parseFloat(infoabonoscreditos.totalcobrar).toFixed(
                              2
                            )
                          }}
                        </h5>
                        <h5>
                          Fecha maxima :
                          {{
                            moment(
                              infoabonoscreditos.fechamaxima,
                              "YYYY-MM-DD"
                            ).format("MMM DD YYYY, ddd")
                          }}
                        </h5>
                        <b-progress
                          :value="infoabonoscreditos.total_abonos"
                          :max="infoabonoscreditos.totalcobrar"
                          show-progress
                          animated
                        ></b-progress>
                        <b-table
                          striped
                          hover
                          :items="infoabonoscreditos.detalle_venta"
                          :fields="fields"
                        >
                          <template #cell(abono)="data">
                            <span v-if="data.item.abono > 0">
                              {{ parseFloat(data.item.abono).toFixed(2) }}
                            </span>

                            <span v-else>0</span>
                          </template>
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
                            <span v-if="data.item.tipoabono == null">
                              N/A
                            </span>
                          </template>

                          <template #cell(detalleabono)="data">
                            <span v-if="data.item.detalleabono">
                              {{ data.item.detalleabono }}
                            </span>
                            <span v-else> N/A </span>
                          </template>
                        </b-table>

                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Cantidad recibida</p>
                          <input
                            class="form-control"
                            type="number"
                            v-model="pagorecibido"
                          />
                        </div>

                        <div class="mb-3">
                          <b-form-group>
                            <b-form-radio-group
                              v-model="tipoabonocredito"
                              :options="optionscredito"
                              name="radio-inline"
                            ></b-form-radio-group>
                          </b-form-group>
                        </div>

                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Detalle Abono</p>
                          <input
                            class="form-control"
                            type="text"
                            v-model="detalleabonocredito"
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
                                  {{
                                    parseFloat(
                                      infoabonoscreditos.saldo
                                    ).toFixed(2)
                                  }}
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
                                  {{
                                    parseFloat(total_saldo_credito).toFixed(2)
                                  }}
                                </p>
                              </div>

                              <div
                                v-if="pagorecibido"
                                @click="
                                  registrarcredito(
                                    pagorecibido,
                                    infoabonoscreditos.detalle_venta
                                  )
                                "
                                class="btn btn-primary mt-2"
                              >
                                <span class="fas fa-dollar-sign px-1"></span
                                >Guardar Abono Credito
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
  props:['infoabonoscreditos'],
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      tipoabono: "1",
      tipoabonocredito: "1",

      detalleabono: "",
      detalleabonocredito: "",
      optionscredito: [
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
      infoabonos: "",
      pagorecibido: "",
      saldo: "",
      venta: "",
    };
  },
  computed: {

    total_saldo_credito: function () {
      let total = this.infoabonoscreditos.saldo;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo = tt;

      return tt;
    },
 
  },

  methods: {

    registrarcredito(pago, info) {
      let data = {
        info: info,
        pago: pago,
        saldo: this.saldo,
        tipoabono: this.tipoabonocredito,
        detalleabono: this.detalleabonocredito,
      };
      VentaServices.registrarcredito(data)
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

