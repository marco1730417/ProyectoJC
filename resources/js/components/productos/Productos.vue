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
          </div>
          <!--          Modal agregar nuevo producto -->

          <div
            class="modal fade"
            id="ModalNuevoProducto"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Registrar nuevo producto</h5>
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
<!--          Modal agregar editar producto -->

          <div
            class="modal fade"
            id="ModalEditProducto"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-lg" role="document">
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

          <!--    <b-button
            size="xs"
            variant="primary"
            data-toggle="modal"
            data-target="#ModalNuevoProducto"
            >Nuevo Producto</b-button
          >
 -->
          <div class="col-4 text-right">
            <a
              href=""
              class="btn btn-sm btn-primary"
              data-toggle="modal"
              data-target="#ModalNuevoProducto"
              >Nuevo Producto</a
            > 
            
<button class="btn btn-success btn-sm" title="Recargar" @click="getAllProductos" ><i class="fas fa-sync"></i></button>
          
          </div>
        </div>
      </div>

      <div class="col-md-6 float-right"></div>
      <b-table
        id="my-table"
        sticky-header
        striped
        show-empty
        small
          :filter="filter"
        
        fixed
        hover
        :items="infoproducto"
        :fields="fields"
        :per-page="perPage"
        :current-page="currentPage"
        responsive="sm"
      >
        <template #cell(index)="data">
          <small> {{ data.index + 1 }} </small>
        </template>
        <template #cell(nombre)="data">
          <small class="mb-0 mr-2">{{ data.item.nombre }}</small>
        </template>

        <template #cell(descripcion)="data">
          {{ data.item.descripcion }}
     <!--      {{data.item}} -->
         <!--  <small class="mb-0 mr-2">{{ data.item.descripcion }}</small> -->
        </template>
        <template #cell(unidades)="data">
          {{ data.item.unidades }} {{data.item.uniPrecioVenta1}}
        <!--   <small class="mb-0 mr-2">{{ data.item.unidades }}</small> -->
        </template>
                <template #cell(PrecioVenta1)="data">
       
 $ {{ parseFloat(data.item.PrecioVenta1).toFixed(2) }}
        </template>

             <template #cell(PrecioVenta2)="data">
       
 $ {{ parseFloat(data.item.PrecioVenta2).toFixed(2) }}
        </template>


             <template #cell(PrecioVenta3)="data">
       
 $ {{ parseFloat(data.item.PrecioVenta3).toFixed(2) }}
        </template>

 

         <template #cell(Utilidad)="data">
          <b-badge variant="outline" class="p-1" size="sm">{{
            data.item.Utilidad
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
      <!-- PAGINACION -->
      <div v-if="rows > 5">
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
      perPage: 10,
      currentPage: 1,
      fields: [
        {
          key: "id",
          label: "#",
          sortable: false,
          sortDirection: "desc",
          tdClass: "index",
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
          label: "Stock",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate",
        },
        {
          key: "PrecioVenta1",
          label: "PV1",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        },

        {
          key: "PrecioVenta2",
          label: "PV2",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        },
          {
          key: "PrecioVenta3",
          label: "PV3",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        },
     /*    {
          key: "Utilidad",
          label: "Utilidad",
          sortable: false,
          sortDirection: "desc",
          tdClass: "list-item-enddate text-center",
        }, */

        { key: "actions", label: "Acciones", tdClass: "text-center" },
      ],
    };
  },
  mounted() {
    this.getAllProductos();
  },
  computed: {
    //Paginación
    rows() {
      return this.infoproducto.length;
    },
  },
  methods: {
    updateProducto() {
   /*    $("#ModalNuevoProducto").modal("hide");
      this.getAllProductos(); */
      location.reload();
    },

    updateProductosUpdate() {
    /*   this.getAllProductos();

      $("#ModalEditProducto").modal("hide"); */
         location.reload();
    },
    openModalEditProducto(infoproducto) {
      this.infoeditproducto = infoproducto;
      $("#ModalEditProducto").modal("show");
    },

    getAllProductos() {
      ProductoServices.getAllProductos()
        .then((response) => {
          this.infoproducto = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    DeleteProducto(id) {
      this.$swal
        .fire({
          title: "Estas seguro de eliminar este producto?",
          showCancelButton: true,
          confirmButtonText: "SI",
        })
        .then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            ProductoServices.DeleteProducto(id)
              .then((response) => {
                let mensaje = response.data.data;
                if (mensaje == 200) {



       this.$swal.fire({
              icon: "success",
              title: "Producto eliminado",
              showConfirmButton: false,
              timer: 1500,
            });

                  this.getAllProductos();
                }
              })
              .catch((error) => {
                             this.$swal
        .fire({
  icon: 'error',
  title: 'Este producto forma parte de una venta o compra asociada',
  showConfirmButton: false,
  timer: 1500
})
              });
          }
        });
    },
  },
};
</script>
