<template>
  <div class="main-content">
    
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row"></div>

                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Cliente
                        <v-select
                          label="nombre"
                          v-model="clienteupdate"
                          :options="infocliente"
                          @click="actualizarVenta"
                          required
                        ></v-select>
                      </h5>
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
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                  </div>
                  <br /><br />
                </div>
              </div>
            </div>

            <div v-if="substr > 0" class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">
                        Total Venta
                      </h5>
                      <span class="h2 font-weight-bold mb-0">
                        {{ parseFloat(totalesventa.total).toFixed(2) }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <div
                        class="
                          icon icon-shape
                          bg-yellow
                          text-white
                          rounded-circle
                          shadow
                        "
                      >
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"
                      ><i class="fas fa-user"></i>
                      {{ detallegeneralventa.total[0].nombre }}
                    </span>
                    <span class="text-nowrap">{{ fecha }}</span>
                  </p>
                </div>
              </div>

              <br />
            </div>
          </div>
        </div>
      </div>
    </div>
<div id="ModalVentaProducto" class="modal" tabindex="-1">
  <div   class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <modal-venta-producto
                            @updateVenta="updateDatos"
                            :venta="substr"
                          />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <div v-if="substr > 0" class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Venta</h3>
                </div>
                <div class="col-4 text-right">
                  <a
                    href=""
                    class="btn btn-sm btn-primary"
                    data-toggle="modal"
                    data-target="#ModalVentaProducto"
                    ><i class="fas fa-search"></i>Buscar Productos</a
                  >

         <!--     <div
              id="ModalVentaProducto"
              class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Nuevo Item</h5>
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
                          <modal-venta-producto
                            @updateVenta="updateDatos"
                            :venta="substr"
                          />
                        </div>
                        <div class="modal-footer"></div>
                      </div>
                    </div>
                  </div>
 -->

                  
                </div>
              </div>
            </div>

            <!-- modal venta al contado -->

            <div
              class="modal fade"
              id="ModalVentaContado"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Terminar venta al contado</h5>
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
                    <div class="container d-lg-flex">
                      <div class="box-2">
                        <div class="box-inner-2">
                          <form action="">
                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">Cantidad recibida</p>
                              <input
                                class="form-control"
                                type="number"
                                v-model="pagorecibido"
                              />
                            </div>
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
                                        parseFloat(totalesventa.total).toFixed(
                                          2
                                        )
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
                                    <p>Pago</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span
                                      >{{ pagorecibido }}
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
                                    <p class="fw-bold">Cambio</p>
                                    <p class="fw-bold">
                                      <span class="fas fa-dollar-sign"></span
                                      >{{ parseFloat(total_cambio).toFixed(2) }}
                                    </p>
                                  </div>
                                  <div
                                    v-if="pagorecibido"
                                    @click="
                                      downloadVentaContado(
                                        pagorecibido,
                                        total_cambio,
                                        detallegeneralventa.total[0].cliId
                                      )
                                    "
                                    class="btn btn-primary mt-2"
                                  >
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                  <div v-else class="btn btn-primary mt-2">
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <!-- modal venta al contado -->

            <!-- modal venta transferencia -->

            <div
              class="modal fade"
              id="ModalVentaTransferencia"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">
                      Terminar venta como transferencia
                    </h5>
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
                    <div class="container d-lg-flex">
                      <div class="box-2">
                        <div class="box-inner-2">
                          <form action="">
                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">Cantidad recibida</p>
                              <input
                                class="form-control"
                                type="number"
                                v-model="pagorecibidotransferencia"
                              />
                            </div>
                            <div class="mb-3">
                              <p class="dis fw-bold mb-2">
                                Detalle de transferencia
                              </p>
                              <input
                                class="form-control"
                                v-model="detalletransferencia"
                                type="text"
                              />
                            </div>
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
                                        parseFloat(totalesventa.total).toFixed(
                                          2
                                        )
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
                                    <p>Pago</p>
                                    <p>
                                      <span class="fas fa-dollar-sign"></span
                                      >{{ pagorecibidotransferencia }}
                                    </p>
                                  </div>

                                  <div
                                    v-if="pagorecibidotransferencia"
                                    @click="
                                      downloadVentaTransferencia(
                                        pagorecibidotransferencia,
                                        detalletransferencia,
                                        detallegeneralventa.total[0].cliId
                                      )
                                    "
                                    class="btn btn-primary mt-2"
                                  >
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                  <div v-else class="btn btn-primary mt-2">
                                    <span class="fas fa-dollar-sign px-1"></span
                                    >Terminar Venta
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <!-- modal venta al transferencia -->

            <!-- modal venta abonos -->

            <div
              class="modal fade"
              id="ModalVentaAbono"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Terminar venta como abono</h5>
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
                    <div class="container">
                      <form action="">
                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Fecha maxima</p>
                          <input
                            class="form-control"
                            type="date"
                            v-model="fechamaxima"
                          />
                        </div>

                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Cantidad recibida</p>
                          <input
                            class="form-control"
                            type="number"
                            v-model="pagorecibido"
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
                                    parseFloat(totalesventa.total).toFixed(2)
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
                                  <span class="fas fa-dollar-sign"></span
                                  >{{ parseFloat(total_saldo).toFixed(2) }}
                                </p>
                              </div>

                              <!-- {{detallegeneralventa}} -->
                              <div
                                v-if="fechamaxima && pagorecibido"
                                @click="
                                  downloadVentaAbono(
                                    pagorecibido,
                                    fechamaxima,
                                    detallegeneralventa.total[0].cliId
                                  )
                                "
                                class="btn btn-primary mt-2"
                              >
                                <span class="fas fa-dollar-sign px-1"></span
                                >Terminar Venta
                              </div>
                              <div v-else class="btn btn-primary mt-2">
                                <span class="fas fa-dollar-sign px-1"></span
                                >Terminar Venta
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <!-- modal venta al abonos -->
  <!-- modal venta al cheque -->
            <div
              class="modal fade"
              id="ModalVentaCheque"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Terminar venta como cheque</h5>
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
                    <div class="container">
                      <form action="">
                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Fecha maxima</p>
                          <input
                            class="form-control"
                            type="date"
                            v-model="fechamaximacheque"
                          />
                        </div>

                        <div class="mb-3">
                          <p class="dis fw-bold mb-2">Detalle cheque</p>
                          <input
                            class="form-control"
                            type="text"
                            v-model="detallecheque"
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
                                <p>Cantidad de pago</p>
                                <p>
                                  <span class="fas fa-dollar-sign"></span>
                                  {{
                                    parseFloat(totalesventa.total).toFixed(2)
                                  }}
                                </p>
                              </div>
                        

                              <!-- {{detallegeneralventa}} -->
                              <div
                                v-if="fechamaximacheque && detallecheque"
                                @click="
                                  downloadVentaCheque(
                                    fechamaximacheque,
                                    detallecheque,
                                    detallegeneralventa.total[0].cliId
                                  )
                                "
                                class="btn btn-primary mt-2"
                              >
                                <span class="fas fa-dollar-sign px-1"></span
                                >Terminar Venta
                              </div>
                              <div v-else class="btn btn-primary mt-2">
                                <span class="fas fa-dollar-sign px-1"></span
                                >Terminar Venta
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>





            <!-- modal observaciones generales  -->

            <div
              class="modal fade"
              id="ModalObservacionesGenerales"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Observaciones Generales</h5>
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
                    <div class="container d-lg-flex">
                      <b-form-textarea
                        id="textarea"
                        v-model="observacion"
                        placeholder="Espacio para nota general de la venta"
                        rows="6"
                        max-rows="6"
                      ></b-form-textarea
                      ><br />
                      <b-button
                        @click="updateObservacion(observacion)"
                        size="sm"
                        variant="success"
                        >Guardar</b-button
                      >
                    </div>
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>

            <!-- modal venta observaciones -->

            <div class="col-12"></div>

            <b-table
          :items="detalleventa"
          :fields="fields"
          :filter="filter"
          show-empty
          responsive="sm"
          :per-page="perPage"
          :current-page="currentPage"
        >
          <template #cell(index)="data">
            <small> {{ data.index + 1 }} </small>
          </template>
      
              <template #cell(nombre)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            {{ data.item.nombre }}
          </template>
              <template #cell(cantidad)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
   
            <div v-if="data.item.opcion===2" >
         {{ data.item.cantidad }}   [rll]
</div>
<div v-else >
         {{ data.item.cantidad }}   [m]
</div>
          </template>
          <template #cell(descripcion)="data">
            <!--  <small class="mb-0 mr-2">{{ data.item.ruc }}</small> -->
            {{ data.item.descripcion }}
          </template>
         
          <template #cell(precioUnitario)="data">
          
                  $ 
             {{ parseFloat( data.item.precioUnitario).toFixed(2) }}

          </template>
          <template #cell(descuento)="data">
            <!--  <small class="mb-0 mr-2">{{ data.item.ruc }}</small> -->
        
             $ 
             {{ parseFloat( data.item.descuento).toFixed(2) }}
          </template>

          


          <template #cell(subTotal)="data">
         
           $ 
             {{ parseFloat( data.item.subTotal).toFixed(2) }}
          </template>
          <template #cell(actions)="data">
     
            <b-button
              variant="outline-danger default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
         @click="deleteDetalleVenta(data.item.id)"
            >
              <i class="fas fa-trash"></i>
            </b-button>
          </template>
        </b-table>
            <b-container class="bv-example-row">
              <b-row>
                <b-col></b-col>
                <b-col></b-col>
                <b-col>
                  <b-row class="pull-right">
                    <div class="pull-right">
                      <table class="table">
                        <thead class="thead-dark"></thead>
                        <tbody>
                          <tr>
                            <td>SUBTOTAL PRECIO</td>
                            <td>
                              {{ parseFloat(totalesventa.subtotalprecio).toFixed(2) }}
                            </td>
                          </tr>
                            <tr>
                            <td>DESCUENTO</td>
                            <td>
                              {{ parseFloat(totalesventa.descuentos).toFixed(2) }}
                            </td>
                          </tr>
                             <tr>
                            <td>SUBTOTAL SIN IMPUESTOS</td>
                            <td>
                              {{ parseFloat(totalesventa.subtotal_sin_impuestos).toFixed(2) }}
                            </td>
                          </tr>
                                <tr>
                            <td>SUBTOTAL 12%</td>
                            <td>
                              {{ parseFloat(totalesventa.subtotal_sin_impuestos).toFixed(2) }}
                            </td>
                          </tr>
                          <tr>
                            <td>VALOR IVA 12%</td>
                            <td>
                              {{ parseFloat(totalesventa.valorIva).toFixed(2) }}
                            </td>
                          </tr>
                          <tr>
                            <td>VALOR TOTAL</td>
                            <td>
                              {{ parseFloat(totalesventa.total).toFixed(2) }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </b-row>
                </b-col>
              </b-row>
            </b-container>

            <div class="row">
              <div class="col-xl-12 col-lg-12 pull-right">
                <br />

                <div @mouseover="onOver" @mouseleave="onLeave">
                  <b-dropdown
                    id="dropdown-1"
                    text="Continuar"
                    ref="dropdown"
                    class="m-md-2"
                  >
                    <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalVentaContado"
                      ><i class="fas fa-dollar-sign"></i> Al
                      contado</b-dropdown-item
                    >
                    <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalVentaTransferencia"
                      ><i class="fas fa-wallet"></i
                      >Transferencia</b-dropdown-item
                    >
                    <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalVentaAbono"
                      ><i class="fas fa-comments-dollar"></i
                      >Abono</b-dropdown-item
                    >
                       <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalVentaCheque"
                      ><i class="fas fa-money-check"></i
                      >Cheque</b-dropdown-item
                    >
                    <b-dropdown-item
                      data-toggle="modal"
                      data-target="#ModalObservacionesGenerales"
                      ><i class="fas fa-paper-plane"></i
                      >Observaciones</b-dropdown-item
                    >

                    <b-dropdown-item @click="deleteVenta"
                      ><i class="fas fa-ban"></i>Eliminar Venta</b-dropdown-item
                    >
                  </b-dropdown>
                  
                </div>
              </div>
            </div>

            <!--  {{totalesventa}} -->

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
import ClienteServices from "../../services/clienteServices";
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
       perPage: 10,
      currentPage: 1,
      filter: null,
    
       fields: [
     /*    {
          key: "index",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "index",
        }, */
      {
          key: "nombre",
          label: "Producto",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
            {
          key: "cantidad",
          label: "Cantidad",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "descripcion",
          label: "Descripcion",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
   /*         {
          key: "opcion",
          label: "Unidad",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        }, */
           {
          key: "precioUnitario",
          label: "Precio",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
                {
          key: "descuento",
          label: "Descuento",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
          {
          key: "subTotal",
          label: "Precio Total",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
       /*   {
          key: "Desc",
          label: "Desc",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
       
         */
       
    
 
        { key: "actions", label: "Acciones", tdClass: "text-center" },
      ],
      fecha: moment().format("MMMM Do YYYY"),
      cliente: "",
      clienteupdate: "",
      formadepagoupdate: "",
      infocliente: [],
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
      formadepago: "",
      substr: "",
      fechamaxima: "",
      fechamaximacheque:"",
      detallecheque:"",
      saldo: "",
    };
  },
  watch: {
    clienteupdate: function (newClient, oldClient) {
      this.actualizarVenta(newClient.id);
    },
  },
  computed: {
    total_cambio: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      let total = this.totalesventa.total;
      let pagorecibido = this.pagorecibido;
      let tt = pagorecibido - total;

      return tt;
    },
    total_saldo: function () {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      let total = this.totalesventa.total;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo = tt;

      return tt;
    },
  },
  created() {
    this.myFunction();
  },
  mounted() {
    this.getAllClientes();
    this.getInformacionVenta();
    this.totalesVenta();
    this.detalleGeneralVenta();
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
    deleteDetalleVenta(id) {
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
    },

    deleteVenta() {
      this.$swal
        .fire({
          title: "Estas seguro de eliminar esta venta?",
          showCancelButton: true,
          confirmButtonText: "Si",
        })
        .then((result) => {


          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            VentaServices.deleteVenta(this.substr)
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

    getAllClientes() {
      ClienteServices.getAllClientes()
        .then((response) => {
          this.infocliente = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getInformacionVenta() {
      VentaServices.getInformacionVenta(this.substr)
        .then((response) => {
          this.detalleventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    detalleGeneralVenta() {
      VentaServices.detalleGeneralVenta(this.substr)
        .then((response) => {
          this.detallegeneralventa = response.data.data;
          //   en caso que exista informacion de venta asignamos el cliente
          this.clienteupdate = this.detallegeneralventa["cliente"];
        })
        .catch((error) => {
          console.log(error);
        });
    },
    downloadVentaContado(pago, vuelto, cliId) {
      let data = {
        venId: this.substr,
        total: this.totalesventa.total,
        pago: pago,
        vuelto: vuelto,
        cliId: cliId,
      };
      VentaServices.registrarPagoContado(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {


   this.$swal
        .fire({
          title: "Su venta ha sido guardada, Desea imprimir la factura?",
          showCancelButton: true,
          confirmButtonText: "Si",
        })
        .then((result) => {


   if (result.isConfirmed) {

           let routeData = server + resource + `download-venta/` + this.substr;
      window.open(routeData);


          }
        });




            
          }
        })
        .catch((error) => {
          console.log(error);
        });

  
    },

downloadVentaCheque(fecha,detalle,cliId){
  let data = {
        venId: this.substr,
        total: this.totalesventa.total,
        fechamaxima: fecha,
        cheque: detalle,
        cliId: cliId,
      };
    VentaServices.registrarPagoCheque(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
   this.$swal
        .fire({
          title: "Su venta ha sido guardada, Desea imprimir la factura?",
          showCancelButton: true,
          confirmButtonText: "Si",
        })
        .then((result) => {


   if (result.isConfirmed) {

           let routeData = server + resource + `download-venta/` + this.substr;
      window.open(routeData);


          }
        });

          }
        })
        .catch((error) => {
          console.log(error);
        });


},

    downloadVentaTransferencia(pago, detalle, cliId) {
      let data = {
        venId: this.substr,
        total: this.totalesventa.total,
        pago: pago,
        numtransf: detalle,
        cliId: cliId,
      };
      VentaServices.registrarPagoTransferencia(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            
               this.$swal
        .fire({
          title: "Su venta ha sido guardada, Desea imprimir la factura?",
          showCancelButton: true,
          confirmButtonText: "Si",
        })
        .then((result) => {


   if (result.isConfirmed) {

           let routeData = server + resource + `download-venta/` + this.substr;
      window.open(routeData);


          }
        });

          }
        })
        .catch((error) => {
          console.log(error);
        });


    },

    downloadVentaAbono(pago, fechamaxima, cliId) {
      let data = {
        venId: this.substr,

        fechamaxima: fechamaxima,
        total: this.totalesventa.total,
        abono: pago,
        cliId: cliId,
        saldo: this.saldo,
      };
      VentaServices.registrarPagoAbono(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {

   this.$swal
        .fire({
          title: "Su venta ha sido guardada, Desea imprimir la factura?",
          showCancelButton: true,
          confirmButtonText: "Si",
        })
        .then((result) => {


   if (result.isConfirmed) {
 let routeData = server + resource + `download-venta/` + this.substr;
      window.open(routeData);



          }
        });


          }
        })
        .catch((error) => {
          console.log(error);
        });

 
    },

    totalesVenta() {
      VentaServices.totalesVenta(this.substr)
        .then((response) => {
          this.totalesventa = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateObservacion(texto) {
      let data = {
        id: this.substr,
        observacion: texto,
      };
      VentaServices.updateObservacion(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.detalleVenta();
            this.totalDashboardVentas();
          }
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


