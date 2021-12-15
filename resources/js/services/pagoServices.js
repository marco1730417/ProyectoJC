import Axios from 'axios';
import Conf from './conf.js';

const axios = require('axios');
const resource = 'api/pagos/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

  

    PagosPendientes() {
        let url = server + resource + 'get-pagos-pendientes';
        return Axios.get(url);
    },


    

}
