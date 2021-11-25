import Axios from 'axios';
import Conf from './conf.js';
const axios = require('axios');
const resource = 'api/compras/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    getInformacionCompras() {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-informacion-compras';
        return Axios.get(url);
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
}
