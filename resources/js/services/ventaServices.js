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


 
}
