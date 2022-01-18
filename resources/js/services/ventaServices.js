import Axios from 'axios';
import Conf from './conf.js';

const axios = require('axios');
const resource = 'api/venta/'
const server = Conf.server;
const url = server + resource;

export default {

    /************************** STANDARS API ********************************/

  
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
    getInformacionPagosVenta(venId) {
        let url = server + resource + 'get-informacion-pagos-venta';
        return Axios.get(url + "/" + venId);
    },
    getInformacionPagosVentaAbonos(venId) {
        let url = server + resource + 'get-informacion-pagos-venta-abonos';
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
    UpdateDescuento(data) {
        let url = server + resource + "update-descuento";
        return Axios.post(url, data);
    },
    
    registrarabono(data) {
        let url = server + resource + "registrar-abono";
        return Axios.post(url, data);
    },

    registrarPagoContado(data) {
        let url = server + resource + "registrar-pago-contado";
        return Axios.post(url, data);
    },
    registrarRetencion(data) {
        let url = server + resource + "registrar-retencion";
        return Axios.post(url, data);
    },
    retencionporventa(venId) {
        let url = server + resource + 'retencion-venta';
        return Axios.get(url + "/" + venId);
    },
    observacionporventa(venId) {
        let url = server + resource + 'observacion-venta';
        return Axios.get(url + "/" + venId);
    },
    registrarPagoTransferencia(data) {
        let url = server + resource + "registrar-pago-transferencia";
        return Axios.post(url, data);
    },
    registrarPagoAbono(data) {
        let url = server + resource + "registrar-pago-abono";
        return Axios.post(url, data);
    }, 
    
    registrarPagoCheque(data) {
        let url = server + resource + "registrar-pago-cheque";
        return Axios.post(url, data);
    },
    registrarPagoCredito(data) {
        let url = server + resource + "registrar-pago-credito";
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
    deleteRetencion(id) {
        let url = server + resource + "delete-retencion";
        return Axios.post(url+ '/' + id);
    },
 
}
