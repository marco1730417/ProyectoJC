<template>
  <div>
    <b-card>
      <div class="card-title mb-0">
        <div class="d-flex">

          <div class="w-50">
            <b-form-group inline size="sm">
              <b-form-input
                style="height: calc(1.3em + 0.5rem + 2px); font-size: 0.75rem"
                class="float-right"
                id="filter-input"
                v-model="filter"
                type="search"
                size="sm"
                placeholder="Buscar Producto"
              ></b-form-input>
            </b-form-group>

            <!--          Modal agregar nuevo producto -->

            <div
              class="modal fade"
              id="ModalNuevoProducto"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
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
                    <modal-nuevo-producto @updateProducto="updateProducto" />
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
          </div>
          <!--          Modal agregar nuevo producto -->

          <!--          Modal agregar nuevo producto -->

          <div
            class="modal fade"
            id="ModalEditProducto"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Producto</h5>
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
                  <modal-edit-producto
                    :infoeditproducto="infoeditproducto"
                    @updateProductos="updateProductosUpdate"
                  />
                </div>
                <div class="modal-footer"></div>
              </div>
            </div>
          </div>

          <!--          Modal agregar nuevo producto -->

          <b-button
            size="xs"
            variant="primary"
            data-toggle="modal"
            data-target="#ModalNuevoProducto"
            >Nuevo Producto</b-button
          >
        </div>
      </div>

      <!-- {{infoproducto}} -->
      <div class="col-md-6 float-right">
        <!--a href="#" @click="this.getActiveQuotes" > <i style="float:right" 
           
            class="glyph-icon iconsminds-refresh mr-1"
          ></i></a-->

        <div class="text-center" v-if="loading">
          <b-button variant="dark" disabled>
            <b-spinner small></b-spinner>
            <span class="sr-only">Loading...</span>
          </b-button>

          <b-button variant="dark" disabled>
            <b-spinner small type="grow"></b-spinner>
            Loading...
          </b-button>
        </div>
      </div>

      <vue-perfect-scrollbar
        :class="
          infoproducto.lenght > 0 || infoproducto.lenght < 7 ? 'inactive' : ''
        "
        class="scroll dashboard dashboard-list-with-thumbs"
        :settings="{ suppressScrollX: true, wheelPropagation: false }"
      >
        <b-table
          :items="infoproducto"
          :fields="fields"
          :filter="filter"
          show-empty
          small
          bordered
          class="dsh-resent"
        >
          <template #cell(nombre)="data">
            <small class="mb-0 mr-2">{{ data.item.nombre }}</small>
          </template>
          <template #cell(codigo)="data">
            <small class="mb-0 mr-2">{{ data.item.codigo }}</small>
          </template>
          <template #cell(descripcion)="data">
            <small class="mb-0 mr-2">{{ data.item.descripcion }}</small>
          </template>
          <template #cell(unidades)="data">
            <small class="mb-0 mr-2">{{ data.item.unidades }}</small>
          </template>

          <template #cell(iva)="data">
            <b-badge variant="outline" class="p-1" size="sm">{{
              data.item.iva
            }}</b-badge>
          </template>
          <template #cell(PrecioVenta1)="data">
            <b-badge variant="outline" class="p-1" size="sm">{{
              data.item.PrecioVenta1
            }}</b-badge>
          </template>
          <template #cell(actions)="data">
            <b-button
              variant="outline-info default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
              @click="openModalEditProducto(data.item)"
            >
              <i class="fas fa-save"></i>
            </b-button>

            <b-button
              variant="outline-danger default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
              @click="DeleteProducto(data.item.id)"
            >
              <i class="fas fa-trash"></i>
            </b-button>
          </template>
        </b-table>
      </vue-perfect-scrollbar>
    </b-card>
  </div>
</template>


<script>
import ProductoServices from "../../services/productoServices";

import { BootstrapVue } from "bootstrap-vue";
import ModalNuevoProducto from "./ModalNuevoProducto.vue";
Vue.use(BootstrapVue);
export default {
  components: { ModalNuevoProducto },
  data() {
    return {
      producto: "",
      infoproducto: [],
      loading: false,
      infoeditproducto: [],
      filter: null,
      fields: [
        {
          key: "nombre",
          label: "Producto",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "codigo",
          label: "Codigo",
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

        {
          key: "unidades",
          label: "Unidades",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "iva",
          label: "Iva",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        },

        {
          key: "PrecioVenta1",
          label: "PrecioVenta1",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        },

        { key: "actions", label: "Acciones", tdClass: "text-center" },
      ],
    };
  },
  mounted() {
    this.getAllProductos();
  },
  methods: {
    updateProducto() {
      this.getAllProductos();

      $("#ModalNuevoProducto").modal("hide");
    },

    updateProductosUpdate() {
      this.getAllProductos();

      $("#ModalEditProducto").modal("hide");
    },
    openModalEditProducto(infoproducto) {
      this.infoeditproducto = infoproducto;
      $("#ModalEditProducto").modal("show");
    },

    getAllProductos() {
      ProductoServices.getAllProductos(this.cofId)
        .then((response) => {
          this.infoproducto = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    DeleteProducto(id) {
      ProductoServices.DeleteProducto(id)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.getAllProductos();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
