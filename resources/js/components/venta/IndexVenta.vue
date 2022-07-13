<template>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Ventas Totales
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        $ {{ parseFloat(totalventas.subtotal).toFixed(2) }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-danger
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Clientes activos
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        {{ totalventas.cliente }}</span
                      >
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-warning
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Venta</h3>
                </div>
                <div class="col-8">
                  <b-form-input
                    style="
                      height: calc(1.3em + 0.5rem + 2px);
                      font-size: 0.75rem;
                    "
                    class="float-right"
                    id="filter-input"
                    v-model="filter"
                    type="search"
                    size="sm"
                    placeholder="Buscar Venta"
                  ></b-form-input>
                </div>
                <div class="col-4">
                  <a
                    href="#"
                    @click="gotoNuevaVenta()"
                    class="badge badge-primary"
                    >Nueva Venta</a
                  >
                  <button
                    class="btn btn-success btn-sm"
                    title="Recargar"
                    @click="detalleVenta"
                  >
                    <i class="fas fa-sync"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="col-12"></div>

            <div class="table-responsive">
              <b-table
                :items="detalleventa"
                :fields="fields1"
                :filter="filter"
                show-empty
                responsive="sm"
                :per-page="perPage"
                :current-page="currentPage"
              >
                <template #cell(fecha)="data">
                  {{
                    moment(data.item.fecha).format(
                      "MMM DD YYYY, ddd, h:mm:ss a"
                    )
                  }}
                </template>
                <template #cell(nombre)="data">
                  <div class="left" id="center">
                    <small> {{ data.item.nombre }}<br /></small>
                    <small> {{ data.item.ruc }}</small>
                  </div>
                </template>
                <template #cell(observacion)="data">
                  <span v-if="data.item.observacion">
                    {{ data.item.observacion }}</span
                  >
                  <span v-else> N/A</span>
                </template>
                <template #cell(total)="data">
                  <span v-if="data.item.total">
                    $ {{ parseFloat(data.item.total).toFixed(2) }}
                  </span>
                  <span v-else> Pago no registrado</span>
                </template>

                <template #cell(actions)="data">
                  <b-button
                    variant="outline-success default actions"
                    @click="gotoEditVenta(data.item.id)"
                    size="sm"
                    title="venta"
                  >
                    <i class="fas fa-arrow-circle-right"></i>
                  </b-button>
                  <!--     <b-button
                    variant="outline-info default actions"
                    data-toggle="modal"
                    data-target="#ModalVentaObservaciones"
                    size="sm"
                    title="observaciones"
                    @click="captureitem(data.item)"
                  >
                    <i class="fas fa-eye"></i>
                  </b-button> -->
                  <b-button
                    variant="outline-warning default actions"
                    size="sm"
                    @click="downloadVenta(data.item.id)"
                    data-placement="top"
                    title="Descargar"
                  >
                    <i class="fas fa-print" title="Descargar"></i>
                  </b-button>
                 
                  <b-button
                    v-if="data.item.pagoabonos > 0"
                    variant="outline-info default actions"
                    size="sm"
                    data-toggle="modal"
                    data-target="#ModalAbonos"
                    @click="obtenerabonos(data.item.id)"
                    data-placement="top"
                    title="Abonos"
                  >
                    <i class="fas fa-balance-scale" title="Abonos"></i>
                  </b-button>
                 <!--  {{data.item.pagoabonoscreditos}} -->
                      <b-button
                    v-if="data.item.pagoabonoscreditos > 0"
                    variant="outline-light default actions"
                    size="sm"
                    data-toggle="modal"
                    data-target="#ModalCreditos"
                    @click="obtenerabonoscreditos(data.item.id)"
                    data-placement="top"
                    title="Creditos"
                  >
                    <i class="fas fa-wallet" title="Creditos"></i>
                  </b-button>
                  <b-button
                    variant="outline-success default actions"
                    size="sm"
                    data-toggle="modal"
                    data-target="#ModalPagos"
                    @click="obtenerpagos(data.item.id)"
                    data-placement="top"
                    title="Pagos"
                  >
                    <i class="fas fa-dollar-sign" title="Pagos"></i>
                  </b-button>

                  <b-button
                    variant="outline-danger default actions"
                    size="sm"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Anular"
                    @click="deleteVenta(data.item.id)"
                  >
                    <i class="fas fa-window-close"></i>
                  </b-button>
                </template>
              </b-table>
              <!-- PAGINACION -->
              <div v-if="rows > 2">
                <b-pagination
                  class="text-center"
                  v-model="currentPage"
                  :total-rows="rows"
                  :per-page="perPage"
                  aria-controls="my-table"
                  size="sm"
                  align="center"
                ></b-pagination>
              </div>
              <!-- FIN PAGINACION -->
              <!--          Modal agregar editar producto -->
              <div
                class="modal fade"
                id="ModalVentaObservaciones"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Observaciones de venta</h5>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!--     {{infoventa.id}}  -->
                      <b-form-textarea
                        id="textarea"
                        v-model="infoventa.observacion"
                        placeholder="Enter something..."
                        rows="3"
                        max-rows="6"
                      ></b-form-textarea>
                      <br />
                      <!-- {{infoventa}} -->
                      <b-button
                        @click="
                          updateObservacion(infoventa.id, infoventa.observacion)
                        "
                        size="md"
                        variant="success"
                        >Guardar</b-button
                      >
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

              <!--          Modal agregar editar producto -->
              <!--          Modal agregar un abono a venta abono -->
              <div
                class="modal fade"
                id="ModalAbonos"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Abonos</h5>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!--   {{infoabonos}} -->
                      <div>
                        <!--   <h5>Total a cobrar : $ {{ infoabonos.totalcobrar }}</h5> -->
                        <h5>
                          Total a cobrar : ${{
                            parseFloat(infoabonos.totalcobrar).toFixed(2)
                          }}
                        </h5>
                        <h5>
                          Fecha maxima :
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
                          <span v-if="data.item.tipoabono==1">
                          Efectivo
                          </span>
                          <span v-else>
                          Transferencia
                          </span>
                          
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
                                  <p>Total</p>
                                  <p>
                                    <span class="fas fa-dollar-sign"></span>
                                    {{
                                      parseFloat(infoabonos.saldo).toFixed(2)
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
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

   <!--          Modal agregar un abono a venta credito -->
              <div
                class="modal fade"
                id="ModalCreditos"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Credito</h5>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!--   {{infoabonos}} -->
                      <div>
                        <!--   <h5>Total a cobrar : $ {{ infoabonos.totalcobrar }}</h5> -->
                        <h5>
                          Total a cobrar : ${{
                            parseFloat(infoabonoscreditos.totalcobrar).toFixed(2)
                          }}
                        </h5>
                        <h5>
                          Fecha maxima :
                          {{
                            moment(infoabonoscreditos.fechamaxima, "YYYY-MM-DD").format(
                              "MMM DD YYYY, ddd"
                            )
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
                          <template #cell(fecha)="data">
                            {{
                              moment(
                                data.item.fecha,
                                "YYYY-MM-DD, h:mm:ss a"
                              ).format("MMM DD YYYY, ddd, h:mm:ss a")
                            }}
                          </template>
                               <template #cell(tipoabono)="data">
                          <span v-if="data.item.tipoabono==1">
                          Efectivo
                          </span>
                          <span v-else>
                          Transferencia
                          </span>
                          
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
                                  <p>Total</p>
                                  <p>
                                    <span class="fas fa-dollar-sign"></span>
                                    {{
                                      parseFloat(infoabonoscreditos.saldo).toFixed(2)
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
                                    {{ parseFloat(total_saldo_credito).toFixed(2) }}
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
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>


              <!--          Modal agregar editar producto -->
              <div
                class="modal fade"
                id="ModalPagos"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Pagos</h5>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <!--   {{infoabonos}} -->
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
                          <template  #cell(pago)="data">
                            $ {{ parseFloat(data.item.pago).toFixed(2) }}
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
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                </div>
              </div>

              <!--          Modal agregar editar producto -->
            </div>

            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="..."></nav>
            </div>
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
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
        tipoabono: '1',
        tipoabonocredito: '1',
        
  detalleabono:"",
  detalleabonocredito:"",
  
        options: [
          { text: 'Efectivo', value: '1' },
          { text: 'Transferencia', value: '2' },
        
        ],
              optionscredito: [
          { text: 'Efectivo', value: '1' },
          { text: 'Transferencia', value: '2' },
        
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
        /*   {
          key: "total",
          label: "Total",
        }, */

        { key: "actions", label: "Acciones", tdClass: "list-item-enddate" },
      ],
      fields1: [
        {
          key: "id",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "index",
        },
        {
          key: "fecha",
          label: "Fecha",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "nombre",
          label: "Cliente",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        /*   {
          key: "observacion",
          label: "Observacion",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        }, */
        {
          key: "total",
          label: "Total",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        { key: "actions", label: "Acciones", tdClass: "list-item-enddate" },
      ],

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
      infoabonoscreditos: "",
      
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
      total_saldo_credito: function () {
      let total = this.infoabonoscreditos.saldo;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo = tt;

      return tt;
    },
    rows() {
      return this.detalleventa.length;
    },
  },
  
  mounted() {
    this.detalleVenta();
    this.totalDashboardVentas();
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
        tipoabono:this.tipoabono,
        detalleabono:this.detalleabono
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
      registrarcredito(pago, info) {
      let data = {
        info: info,
        pago: pago,
        saldo: this.saldo,
        tipoabono:this.tipoabonocredito,
        detalleabono:this.detalleabonocredito
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
    updateObservacion(id, texto) {
      let data = {
        id: id,
        observacion: texto,
      };
      VentaServices.updateObservacion(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.detalleVenta();
            this.totalDashboardVentas();
            this.$swal.fire({
              icon: "success",
              title: "Observacion guardada",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        })
        .catch((error) => {
          this.$swal.fire({
            icon: "error",
            title: "Observacion no agregado",
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },
    captureitem(item) {
      this.infoventa = item;
    },
    obtenerabonos(id) {
      VentaServices.getInformacionPagosVentaAbonos(id)
        .then((response) => {
          this.infoabonos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
       obtenerabonoscreditos(id) {
      VentaServices.getInformacionPagosVentaCreditos(id)
        .then((response) => {
          this.infoabonoscreditos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    obtenerpagos(id) {
      VentaServices.getInformacionPagosVenta(id)
        .then((response) => {
          this.infopagosventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteVenta(id) {
      this.$swal
        .fire({
          title: "Estas seguro de anular esta venta?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            VentaServices.deleteVenta(id)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {
                  window.location.href = "../venta/";
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
    downloadVenta(id) {
      let routeData = server + resource + `download-venta/` + id;
      window.open(routeData);
    },
    detalleVenta() {
      VentaServices.detalleVenta()
        .then((response) => {
          this.detalleventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    totalDashboardVentas() {
      VentaServices.totalDashboardVentas()
        .then((response) => {
          this.totalventas = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    gotoEditVenta(id) {
      const userId = id;
      /* this.$router.push({ name: 'nuevaventa', params: { venId:userId }})
       */
      let routeData = this.$router.resolve({
        name: "editventa",
        params: { id: userId },
      });
      //window.open(routeData.href, "_blank");
      window.open(routeData.href, "_self");
    },
    gotoNuevaVenta() {
      VentaServices.createNuevaVenta()
        .then((response) => {
          let mensaje = response.data.data;

          let routeData = this.$router.resolve({
            name: "editventa",
            params: { id: mensaje },
          });
          //  window.open(routeData.href, "_blank");
          window.open(routeData.href, "_self");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

