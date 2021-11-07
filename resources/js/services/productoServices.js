import Axios from 'axios';
import Conf from './conf.js';
const axios = require('axios');
const resource = 'api/producto/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    getAllProductos() {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-productos';
        return Axios.get(url);
    },
    createNewProducto(data) {
        let url = server + resource + "add-producto";
        return Axios.post(url, data);
    },
    UpdateProducto(data) {
        let url = server + resource + "update-producto";
        return Axios.post(url, data);
    },

    DeleteProducto(id) {
        let url = server + resource + "delete-producto";
        return Axios.post(url+ '/' + id);
    },

 
}
