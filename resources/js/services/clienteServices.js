import Axios from 'axios';
import Conf from './conf.js';
const axios = require('axios');
const resource = 'api/cliente/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

    getAllClientes() {
        //console.log(Axios.get(url));
        let url = server + resource + 'get-clientes';
        return Axios.get(url);
    },
    createNewClient(data) {
        let url = server + resource + "add-cliente";
        return Axios.post(url, data);
    },
    UpdateCliente(data) {
        let url = server + resource + "update-cliente";
        return Axios.post(url, data);
    },

    DeleteCliente(id) {
        let url = server + resource + "delete-cliente";
        return Axios.post(url+ '/' + id);
    },

 
}
