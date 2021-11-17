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
    updateVenta(data) {
        let url = server + resource + "update-venta";
        return Axios.post(url, data);
    },
    createNuevaVenta() {
        let url = server + resource + "create-nueva-venta";
        return Axios.post(url);
    },
    createDetalleVenta(data) {
        let url = server + resource + "create-detalle-venta";
        return Axios.post(url, data);
    },
    getInformacionVenta(venId) {
        let url = server + resource + 'get-informacion-venta';
        return Axios.get(url + "/" + venId);
    },
    detalleGeneralVenta(venId) {
        let url = server + resource + 'get-detalle-general-venta';
        return Axios.get(url + "/" + venId);
    },
    detalleVenta() {
        let url = server + resource + 'get-detalle-venta';
        return Axios.get(url);
    },

    totalDashboardVentas() {
        let url = server + resource + 'totales-dashboard-ventas';
        return Axios.get(url);
    },

    totalesVenta(venId) {
        let url = server + resource + 'totales-venta';
        return Axios.get(url + "/" + venId);
    },
    downloadVenta(venId) {
        let url = server + resource + 'download-venta';
        return Axios.get(url + "/" + venId);
    },

    updateObservacion(data) {
        let url = server + resource + "update-observacion";
        return Axios.post(url, data);
    },

    

    deleteDetalleVenta(id) {
        let url = server + resource + "delete-detalle-venta";
        return Axios.post(url+ '/' + id);
    },

    deleteVenta(id) {
        let url = server + resource + "delete-venta";
        return Axios.post(url+ '/' + id);
    },
 
}
