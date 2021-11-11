import Axios from 'axios';
import Conf from './conf.js';

const axios = require('axios');
const resource = 'api/venta/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    createVenta(data) {
        let url = server + resource + "create-venta";
        return Axios.post(url, data);
    },
    createDetalleVenta(data) {
        let url = server + resource + "create-detalle-venta";
        return Axios.post(url, data);
    },
    getInformacionVenta(venId) {
        let url = server + resource + 'get-informacion-venta';
        return Axios.get(url + "/" + venId);
    },
    totalesVenta(venId) {
        let url = server + resource + 'totales-venta';
        return Axios.get(url + "/" + venId);
    },
    downloadVenta(venId) {
        let url = server + resource + 'download-venta';
        return Axios.get(url + "/" + venId);
    },

    

    deleteDetalleVenta(id) {
        let url = server + resource + "delete-detalle-venta";
        return Axios.post(url+ '/' + id);
    },
 
}
