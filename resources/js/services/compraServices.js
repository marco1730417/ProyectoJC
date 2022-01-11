import Axios from 'axios';
import Conf from './conf.js';
const axios = require('axios');
const resource = 'api/compras/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    getInformacionHeaderCompras(comId) {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-informacion-header-compras';
        return Axios.get(url + "/" + comId);
    },
 
    getCompras() {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-compras';
        return Axios.get(url);
    },
    createNuevaCompra() {
        let url = server + resource + "create-nueva-compra";
        return Axios.post(url);
    },
    updateCompra(data) {
        let url = server + resource + "update-compra";
        return Axios.post(url, data);
    },
    addProductosCompra(data) {
        let url = server + resource + "add-productos-compra";
        return Axios.post(url, data);
    },
    getInformacionCompra(comId) {
        let url = server + resource + 'get-informacion-compra';
        return Axios.get(url + "/" + comId);
    },
    deleteCompra(id) {
        let url = server + resource + "delete-compra";
        return Axios.post(url+ '/' + id);
    },
    
    deleteDetalleCompra(id) {
        let url = server + resource + "delete-detalle-compra";
        return Axios.post(url+ '/' + id);
    },
    
    totalDashboardCompras() {
        let url = server + resource + 'totales-dashboard-compras';
        return Axios.get(url);
    },
    updateDetalleCompra(data) {
        let url = server + resource + "update-detalle_compra";
        return Axios.post(url, data);
    },
}
