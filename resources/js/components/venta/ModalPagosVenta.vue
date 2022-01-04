<template>
  <div class="card">
    <div class="card-body">
      <div class="container">
<!-- {{infopagosventa.detalle_venta}} -->
{{infopagosventa}}
          <h5>Total de venta : ${{ parseFloat(infopagosventa.totalcobrar).toFixed(2) }}</h5>
                
<b-table      show-empty
          responsive="sm"
      striped hover :items="infopagosventa.detalle_venta" :fields="fields">

     <template #cell(fecha)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            <!--  {{ data.item.fecha }} -->
              {{ moment(data.item.fecha , "YYYY-MM-DD").format("MMM DD YYYY, ddd")}} 
           <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
          
          </template>

    <template #cell(total)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            <!--  {{ data.item.fecha }} -->
        <!--       {{ data.item.total}}  -->
                 $ {{ parseFloat(data.item.total).toFixed(2) }}
           <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
          
          </template>
           <template #cell(pago)="data">
            <!--     <small class="mb-0 mr-2">{{ data.item.nombre }}</small> -->
            <!--  {{ data.item.fecha }} -->
        <!--       {{ data.item.total}}  -->
                 $ {{ parseFloat(data.item.pago).toFixed(2) }}
           <!--    {{ moment(data.item.fecha).format("MMM DD YYYY, ddd") }} -->
          
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
  </div>
</template>


<script>
import VentaServices from "../../services/ventaServices";

import pagoServices from "../../services/pagoServices";
import { BootstrapVue } from "bootstrap-vue";
Vue.use(BootstrapVue);
    import moment from "moment";
    moment.locale('es');
export default {
    props:['venId'],
  data() {
    return {
      infopagosventa: [],
      unidades: "",
      pagorecibido:"",
      saldo:"",
      venta:"",
        fields: [
            {
          key: "fecha",
          label: "Fecha",
        },
        {
          key: "tipo",
          label: "Forma de Pago",
        },
           {
          key: "pago",
          label: "Pago",
        },
        {
          key: "total",
          label: "Total",
        },
        
        { key: "actions", label: "Acciones",   tdClass: "list-item-enddate", },
      ],
      
    };
  },
    computed: {
    total_saldo: function () {
      let total = this.infopagosventa.saldo;
      let pagorecibido = this.pagorecibido;
      let tt = total - pagorecibido;
      this.saldo = tt;

      return tt;
    },
    
   
  },


  watch: {

    venId: function (val) {
      this.venta = val 
           this.getInformacionPagosVenta1(this.venta);
      }
 
    },
  

 
  mounted() {
  //  console.log("Component mounted.");
  //  this.getInformacionPagosVenta1();
  },
  methods: {
    registrarabono(pago, info) {
      let data = {
        info: info,
        pago: pago,
        saldo: this.saldo,
      };
      VentaServices.registrarabono(data)
        .then((response) => {
          let mensaje = response.data.data;
          if (mensaje == 200) {
            this.obtenerabonos();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
      getInformacionPagosVenta1(id) {
      VentaServices.getInformacionPagosVenta(id)
        .then((response) => {
          this.infopagosventa = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
        deletePago(id) {
      pagoServices.deletePago(id)
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

    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
    },
  },
};
</script>
