import Axios from 'axios';
import Conf from './conf.js';
const axios = require('axios');
const resource = 'api/reportes/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    getInformacionHeaderCompras(comId) {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-informacion-header-compras';
        return Axios.get(url + "/" + comId);
    },
 
    reporteVentas(fechadesde,fechahasta) {
        //console.log(Axios.get(url));
        let url = server + resource + 'reporte-ventas';
        return Axios.get(url + "/" + fechadesde+ "/" + fechahasta);
    },
 
}
