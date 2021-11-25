import Axios from 'axios';
import Conf from './conf.js';
const axios = require('axios');
const resource = 'api/proveedor/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    getAllProveedores() {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-proveedor';
        return Axios.get(url);
    },
    createNewProveedor(data) {
        let url = server + resource + "add-proveedor";
        return Axios.post(url, data);
    },
    UpdateProveedor(data) {
        let url = server + resource + "update-proveedor";
        return Axios.post(url, data);
    },

    DeleteProveedor(id) {
        let url = server + resource + "delete-proveedor";
        return Axios.post(url+ '/' + id);
    },

 
}
