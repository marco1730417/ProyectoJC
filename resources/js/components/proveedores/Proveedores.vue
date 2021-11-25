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
                placeholder="Buscar Proveedor"
              ></b-form-input>
            </b-form-group>

            <!--          Modal agregar nuevo proveedor -->

            <div
              class="modal fade"
              id="ModalNuevoProveedor"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Nuevo Proveedor</h5>
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
                    <modal-nuevo-proveedor @updateProveedores="updateProveedores" />
                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
          </div>
          <!--          Modal agregar nuevo proveedor -->

          <!--          Modal agregar nuevo proveedor -->

          <div
            class="modal fade"
            id="ModalEditProveedor"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Proveedor</h5>
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
                  <modal-edit-proveedor
                    :infoeditproveedor="infoeditproveedor"
                    @updateProveedores="updateProveedoresUpdate"
                  />
                </div>
                <div class="modal-footer"></div>
              </div>
            </div>
          </div>

          <!--          Modal agregar nuevo proveedor -->

    

             <div class="col-4 text-right">
                  <a
                    href=""
                    class="btn btn-sm btn-primary"
                    data-toggle="modal"
                    data-target="#ModalNuevoProveedor"
                    >Nuevo Proveedor</a
                  >  </div>


        </div>
      </div>

      <!-- {{infoproveedor}} -->
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
          infoproveedor.lenght > 0 || infoproveedor.lenght < 7 ? 'inactive' : ''
        "
        class="scroll dashboard dashboard-list-with-thumbs"
        :settings="{ suppressScrollX: true, wheelPropagation: false }"
      >
        <b-table
          :items="infoproveedor"
          :fields="fields"
          :filter="filter"
          responsive="sm"
        >
          <template #cell(nombre)="data">
            <small class="mb-0 mr-2">{{ data.item.nombre }}</small>
          </template>
          <template #cell(ruc)="data">
            <small class="mb-0 mr-2">{{ data.item.ruc }}</small>
          </template>
          <template #cell(direccion)="data">
            <small class="mb-0 mr-2">{{ data.item.direccion }}</small>
          </template>
          <template #cell(telefono)="data">
            <small class="mb-0 mr-2">{{ data.item.telefono }}</small>
          </template>

          <template #cell(email)="data">
            <b-badge variant="outline" class="p-1" size="sm">{{
              data.item.email
            }}</b-badge>
          </template>
          <template #cell(actions)="data">
            <b-button
              variant="outline-info default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
              @click="openModalEditProveedor(data.item)"
            >
              <i class="fas fa-save"></i>
            </b-button>

            <b-button
              variant="outline-danger default actions"
              size="sm"
              data-toggle="tooltip"
              data-placement="top"
              title="save"
              @click="DeleteProveedor(data.item.id)"
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
import ProveedorServices from "../../services/proveedorServices";

import { BootstrapVue } from "bootstrap-vue";
import ModalNuevoProveedor from "./ModalNuevoProveedor.vue";
Vue.use(BootstrapVue);
export default {
  components: { ModalNuevoProveedor },
  data() {
    return {
      proveedor: "",
      infoproveedor: [],
      loading: false,
      infoeditproveedor: [],
      filter: null,
      fields: [
        {
          key: "nombre",
          label: "Proveedor",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "ruc",
          label: "Ruc",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "direccion",
          label: "Direccion",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "telefono",
          label: "Telefono",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },

        {
          key: "email",
          label: "Email",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        },
        { key: "actions", label: "Acciones", tdClass: "text-center" },
      ],
    };
  },
  mounted() {
    this.getAllProveedores();
  },
  methods: {
    updateProveedores() {
      this.getAllProveedores();

      $("#ModalNuevoProveedor").modal("hide");
    },
    updateProveedoresUpdate() {
      this.getAllProveedores();

      $("#ModalEditProveedor").modal("hide");
    },
    openModalEditProveedor(infoproveedor) {
      this.infoeditproveedor = infoproveedor;
      $("#ModalEditProveedor").modal("show");
    },

    getAllProveedores() {
      ProveedorServices.getAllProveedores()
        .then((response) => {
          this.infoproveedor = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    DeleteProveedor(id) {
      ProveedorServices.DeleteProveedor(id)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.getAllProveedores();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
