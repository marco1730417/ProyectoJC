"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["availability"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/venta/EditVenta.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/venta/EditVenta.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/ventaServices */ "./resources/js/services/ventaServices.js");
/* harmony import */ var _services_clienteServices__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/clienteServices */ "./resources/js/services/clienteServices.js");
/* harmony import */ var _services_conf_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/conf.js */ "./resources/js/services/conf.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var bootstrap_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! bootstrap-vue */ "./node_modules/bootstrap-vue/esm/index.js");
/* harmony import */ var vue_select__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vue-select */ "./node_modules/vue-select/dist/vue-select.js");
/* harmony import */ var vue_select__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(vue_select__WEBPACK_IMPORTED_MODULE_4__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



var resource = "api/venta/";
var server = _services_conf_js__WEBPACK_IMPORTED_MODULE_2__["default"].server;



Vue.use(bootstrap_vue__WEBPACK_IMPORTED_MODULE_5__.BootstrapVue);
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    "v-select": (vue_select__WEBPACK_IMPORTED_MODULE_4___default())
  },
  props: ["venId"],
  data: function data() {
    return {
      fecha: moment__WEBPACK_IMPORTED_MODULE_3___default()().format("MMMM Do YYYY"),
      cliente: "",
      modeupdate: false,
      clienteupdate: "",
      formadepagoupdate: "",
      infocliente: [],
      loading: false,
      infoeditcliente: [],
      camposactivos: false,
      totalesventa: [],
      detalleventa: [],
      detallegeneralventa: [],
      pagorecibido: "",
      pagorecibidotransferencia: "",
      detalletransferencia: "",
      filter: null,
      formadepago: "",
      ventaindex: this.$route.params.venId
    };
  },
  computed: {
    total_cambio: function total_cambio() {
      //console.log(this.productosSelected.tarVenta + "valor unitario");
      var total = this.totalesventa.total;
      var pagorecibido = this.pagorecibido;
      var tt = pagorecibido - total;
      return tt;
    }
  },
  mounted: function mounted() {
    this.getAllClientes();
    this.getInformacionVenta();
    this.totalesVenta();
    this.ventaindex = this.venId;
    console.log(this.ventaindex + 'asdasdasdgg');
  },
  methods: {
    updateDatos: function updateDatos() {
      this.getInformacionVenta();
      this.totalesVenta();
    },
    onOver: function onOver() {
      this.$refs.dropdown.visible = true;
    },
    onLeave: function onLeave() {
      this.$refs.dropdown.visible = false;
    },
    deleteDetalleVenta: function deleteDetalleVenta(id) {
      var _this = this;

      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].deleteDetalleVenta(id).then(function (response) {
        var mensaje = response.data.data;

        if (mensaje == 200) {
          _this.getInformacionVenta();

          _this.totalesVenta();
        }
      })["catch"](function (error) {
        console.log(error);
      });
    },
    deleteVenta: function deleteVenta() {
      var _this2 = this;

      this.$swal.fire({
        title: "Estas seguro de cancelar esta venta?",
        showCancelButton: true,
        confirmButtonText: "Save"
      }).then(function (result) {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].deleteVenta(_this2.venId).then(function (response) {
            var mensaje = response.data.data;

            if (mensaje == 200) {
              window.location.href = "../venta/";
            }
          })["catch"](function (error) {
            console.log(error);
          });
        }
      });
    },
    getAllClientes: function getAllClientes() {
      var _this3 = this;

      _services_clienteServices__WEBPACK_IMPORTED_MODULE_1__["default"].getAllClientes().then(function (response) {
        _this3.infocliente = response.data.data;
      })["catch"](function (error) {
        console.log(error);
      });
    },
    getInformacionVenta: function getInformacionVenta() {
      var _this4 = this;

      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].getInformacionVenta(this.venId).then(function (response) {
        _this4.detalleventa = response.data.data;
      })["catch"](function (error) {
        console.log(error);
      });
    },
    detalleGeneralVenta: function detalleGeneralVenta() {
      var _this5 = this;

      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].detalleGeneralVenta(this.venId).then(function (response) {
        _this5.detallegeneralventa = response.data.data;
        _this5.detallegeneralventa = _this5.detallegeneralventa.shift();
      })["catch"](function (error) {
        console.log(error);
      });
    },
    downloadVentaContado: function downloadVentaContado(pago, vuelto, cliId) {
      var _this6 = this;

      var data = {
        venId: this.venId,
        total: this.totalesventa.total,
        pago: pago,
        vuelto: vuelto,
        cliId: cliId
      };
      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].registrarPagoContado(data).then(function (response) {
        var mensaje = response.data.data;

        if (mensaje == 200) {
          _this6.detalleVenta();

          _this6.totalDashboardVentas();
        }
      })["catch"](function (error) {
        console.log(error);
      });
      var routeData = server + resource + "download-venta/" + this.venId;
      window.open(routeData);
    },
    downloadVentaTransferencia: function downloadVentaTransferencia(pago, detalle, cliId) {
      var _this7 = this;

      var data = {
        venId: this.venId,
        total: this.totalesventa.total,
        pago: pago,
        numtransf: detalle,
        cliId: cliId
      };
      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].registrarPagoTransferencia(data).then(function (response) {
        var mensaje = response.data.data;

        if (mensaje == 200) {
          _this7.detalleVenta();

          _this7.totalDashboardVentas();
        }
      })["catch"](function (error) {
        console.log(error);
      });
      var routeData = server + resource + "download-venta/" + this.venId;
      window.open(routeData);
    },
    totalesVenta: function totalesVenta() {
      var _this8 = this;

      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].totalesVenta(this.venId).then(function (response) {
        _this8.totalesventa = response.data;
      })["catch"](function (error) {
        console.log(error);
      });
    },
    updateObservacion: function updateObservacion(texto) {
      var _this9 = this;

      var data = {
        id: this.venId,
        observacion: texto
      };
      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].updateObservacion(data).then(function (response) {
        var mensaje = response.data.data;

        if (mensaje == 200) {
          _this9.detalleVenta();

          _this9.totalDashboardVentas();
        }
      })["catch"](function (error) {
        console.log(error);
      });
    },
    createVenta: function createVenta() {
      var _this10 = this;

      var data = {
        cliId: this.cliente["id"]
      };
      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].createVenta(data).then(function (response) {
        var mensaje = response.data.data;
        _this10.venId = mensaje;

        _this10.totalesVenta();

        _this10.detalleGeneralVenta();
      })["catch"](function (error) {
        console.log(error);
      });
    },
    updateVenta: function updateVenta() {
      this.modeupdate = true;
      this.camposactivos = true;
    },
    actualizarVenta: function actualizarVenta() {
      var _this11 = this;

      var data = {
        cliId: this.clienteupdate["id"],
        metodopago: this.formadepagoupdate,
        venId: this.venId
      };
      _services_ventaServices__WEBPACK_IMPORTED_MODULE_0__["default"].updateVenta(data).then(function (response) {
        var mensaje = response.data.data;
        _this11.modeupdate = false;
        _this11.camposactivos = false;
        _this11.cliente = _this11.clienteupdate;
        _this11.formadepago = _this11.formadepagoupdate;
      })["catch"](function (error) {
        console.log(error);
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/components/venta/EditVenta.vue":
/*!*****************************************************!*\
  !*** ./resources/js/components/venta/EditVenta.vue ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _EditVenta_vue_vue_type_template_id_fe75a178___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EditVenta.vue?vue&type=template&id=fe75a178& */ "./resources/js/components/venta/EditVenta.vue?vue&type=template&id=fe75a178&");
/* harmony import */ var _EditVenta_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditVenta.vue?vue&type=script&lang=js& */ "./resources/js/components/venta/EditVenta.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _EditVenta_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _EditVenta_vue_vue_type_template_id_fe75a178___WEBPACK_IMPORTED_MODULE_0__.render,
  _EditVenta_vue_vue_type_template_id_fe75a178___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/venta/EditVenta.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/venta/EditVenta.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/venta/EditVenta.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EditVenta_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./EditVenta.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/venta/EditVenta.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_EditVenta_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/venta/EditVenta.vue?vue&type=template&id=fe75a178&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/venta/EditVenta.vue?vue&type=template&id=fe75a178& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditVenta_vue_vue_type_template_id_fe75a178___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditVenta_vue_vue_type_template_id_fe75a178___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_EditVenta_vue_vue_type_template_id_fe75a178___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./EditVenta.vue?vue&type=template&id=fe75a178& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/venta/EditVenta.vue?vue&type=template&id=fe75a178&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/venta/EditVenta.vue?vue&type=template&id=fe75a178&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/venta/EditVenta.vue?vue&type=template&id=fe75a178& ***!
  \***************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "main-content" }, [
    _c("div", { staticClass: "header bg-gradient-primary pb-8 pt-5 pt-md-8" }, [
      _c("div", { staticClass: "container-fluid" }, [
        _c("div", { staticClass: "header-body" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-xl-6 col-lg-6" }, [
              _c("div", { staticClass: "card card-stats mb-4 mb-xl-0" }, [
                _c("div", { staticClass: "card-body" }, [
                  _c("div", { staticClass: "row" }),
                  _vm._v(" "),
                  _c("div", { staticClass: "row" }, [
                    _c("div", { staticClass: "col" }, [
                      !_vm.modeupdate
                        ? _c(
                            "h5",
                            {
                              staticClass:
                                "card-title text-uppercase text-muted mb-0",
                            },
                            [
                              _vm._v(
                                "\n                        Elija un cliente\n                        "
                              ),
                              _c("v-select", {
                                attrs: {
                                  disabled: _vm.venId > 0,
                                  label: "nombre",
                                  options: _vm.infocliente,
                                  required: "",
                                },
                                model: {
                                  value: _vm.cliente,
                                  callback: function ($$v) {
                                    _vm.cliente = $$v
                                  },
                                  expression: "cliente",
                                },
                              }),
                            ],
                            1
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modeupdate
                        ? _c(
                            "h5",
                            {
                              staticClass:
                                "card-title text-uppercase text-muted mb-0",
                            },
                            [
                              _vm._v(
                                "\n                        Elija un cliente\n                        "
                              ),
                              _c("v-select", {
                                attrs: {
                                  label: "nombre",
                                  options: _vm.infocliente,
                                  required: "",
                                },
                                model: {
                                  value: _vm.clienteupdate,
                                  callback: function ($$v) {
                                    _vm.clienteupdate = $$v
                                  },
                                  expression: "clienteupdate",
                                },
                              }),
                            ],
                            1
                          )
                        : _vm._e(),
                    ]),
                    _vm._v(" "),
                    _vm._m(0),
                  ]),
                  _vm._v(" "),
                  _c("br"),
                  _c("br"),
                  _vm._v(" "),
                  !_vm.venId
                    ? _c(
                        "button",
                        {
                          staticClass: "btn btn-primary btn-md btn-block",
                          on: { click: _vm.createVenta },
                        },
                        [
                          _vm._v(
                            "\n                    Continuar\n                  "
                          ),
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.venId && !_vm.camposactivos
                    ? _c(
                        "button",
                        {
                          staticClass: "btn btn-primary btn-sm btn-block",
                          on: { click: _vm.updateVenta },
                        },
                        [
                          _vm._v(
                            "\n                    Cambiar datos\n                  "
                          ),
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.modeupdate && _vm.camposactivos
                    ? _c(
                        "button",
                        {
                          staticClass: "btn btn-primary btn-sm btn-block",
                          on: { click: _vm.actualizarVenta },
                        },
                        [
                          _vm._v(
                            "\n                    Actualizar\n                  "
                          ),
                        ]
                      )
                    : _vm._e(),
                ]),
              ]),
            ]),
            _vm._v(" "),
            _vm.venId > 0
              ? _c("div", { staticClass: "col-xl-6 col-lg-6" }, [
                  _c("div", { staticClass: "card card-stats mb-4 mb-xl-0" }, [
                    _c("div", { staticClass: "card-body" }, [
                      _c("div", { staticClass: "row" }, [
                        _c("div", { staticClass: "col" }, [
                          _c(
                            "h5",
                            {
                              staticClass:
                                "card-title text-uppercase text-muted mb-0",
                            },
                            [
                              _vm._v(
                                "\n                        Total Venta\n                      "
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "span",
                            { staticClass: "h2 font-weight-bold mb-0" },
                            [
                              _vm._v(
                                "\n                        " +
                                  _vm._s(
                                    parseFloat(_vm.totalesventa.total).toFixed(
                                      2
                                    )
                                  ) +
                                  "\n                      "
                              ),
                            ]
                          ),
                        ]),
                        _vm._v(" "),
                        _vm._m(1),
                      ]),
                      _vm._v(" "),
                      _c("p", { staticClass: "mt-3 mb-0 text-muted text-sm" }, [
                        _c("span", { staticClass: "text-warning mr-2" }, [
                          _c("i", { staticClass: "fas fa-user" }),
                          _vm._v(
                            " " +
                              _vm._s(_vm.cliente.nombre) +
                              "\n                    "
                          ),
                        ]),
                        _vm._v(" "),
                        _c("span", { staticClass: "text-nowrap" }, [
                          _vm._v(_vm._s(_vm.fecha)),
                        ]),
                      ]),
                    ]),
                  ]),
                  _vm._v(" "),
                  _c("br"),
                  _vm._v(" "),
                  _c("div", { staticClass: "card card-stats mb-4 mb-xl-0" }, [
                    _c("div", { staticClass: "card-body" }, [
                      _c("div", { staticClass: "row" }, [
                        _c("div", { staticClass: "col" }, [
                          _c(
                            "h5",
                            {
                              staticClass:
                                "card-title text-uppercase text-muted mb-0",
                            },
                            [
                              _vm._v(
                                "\n                        Notas\n                      "
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            [
                              _c("b-form-textarea", {
                                attrs: {
                                  id: "textarea",
                                  placeholder: "Enter something...",
                                  rows: "3",
                                  "max-rows": "6",
                                },
                                model: {
                                  value: _vm.observacion,
                                  callback: function ($$v) {
                                    _vm.observacion = $$v
                                  },
                                  expression: "observacion",
                                },
                              }),
                            ],
                            1
                          ),
                        ]),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "col-auto" },
                          [
                            _c(
                              "b-button",
                              {
                                attrs: { size: "sm", variant: "success" },
                                on: {
                                  click: function ($event) {
                                    return _vm.updateObservacion(
                                      _vm.observacion
                                    )
                                  },
                                },
                              },
                              [_vm._v("Guardar")]
                            ),
                          ],
                          1
                        ),
                      ]),
                    ]),
                  ]),
                ])
              : _vm._e(),
          ]),
        ]),
      ]),
    ]),
    _vm._v(" "),
    _vm.venId > 0
      ? _c("div", { staticClass: "container-fluid mt--7" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col" }, [
              _c(
                "div",
                { staticClass: "card shadow" },
                [
                  _c("div", { staticClass: "card-header border-0" }, [
                    _c("div", { staticClass: "row align-items-center" }, [
                      _vm._m(2),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-4 text-right" }, [
                        _vm._m(3),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "modal fade",
                            attrs: {
                              id: "ModalVentaProducto",
                              tabindex: "-1",
                              role: "dialog",
                              "aria-hidden": "true",
                            },
                          },
                          [
                            _c(
                              "div",
                              {
                                staticClass: "modal-dialog",
                                attrs: { role: "document" },
                              },
                              [
                                _c("div", { staticClass: "modal-content" }, [
                                  _vm._m(4),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "modal-body" },
                                    [
                                      _c("modal-venta-producto", {
                                        attrs: { venta: _vm.venId },
                                        on: { updateVenta: _vm.updateDatos },
                                      }),
                                    ],
                                    1
                                  ),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "modal-footer" }),
                                ]),
                              ]
                            ),
                          ]
                        ),
                      ]),
                    ]),
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "modal fade",
                      attrs: {
                        id: "ModalVentaContado",
                        tabindex: "-1",
                        role: "dialog",
                        "aria-hidden": "true",
                      },
                    },
                    [
                      _c(
                        "div",
                        {
                          staticClass: "modal-dialog modal-sm",
                          attrs: { role: "document" },
                        },
                        [
                          _c("div", { staticClass: "modal-content" }, [
                            _vm._m(5),
                            _vm._v(" "),
                            _c("div", { staticClass: "modal-body" }, [
                              _c(
                                "div",
                                { staticClass: "container d-lg-flex" },
                                [
                                  _c("div", { staticClass: "box-2" }, [
                                    _c("div", { staticClass: "box-inner-2" }, [
                                      _c("form", { attrs: { action: "" } }, [
                                        _c("div", { staticClass: "mb-3" }, [
                                          _c(
                                            "p",
                                            { staticClass: "dis fw-bold mb-2" },
                                            [_vm._v("Cantidad recibida")]
                                          ),
                                          _vm._v(" "),
                                          _c("input", {
                                            directives: [
                                              {
                                                name: "model",
                                                rawName: "v-model",
                                                value: _vm.pagorecibido,
                                                expression: "pagorecibido",
                                              },
                                            ],
                                            staticClass: "form-control",
                                            attrs: { type: "number" },
                                            domProps: {
                                              value: _vm.pagorecibido,
                                            },
                                            on: {
                                              input: function ($event) {
                                                if ($event.target.composing) {
                                                  return
                                                }
                                                _vm.pagorecibido =
                                                  $event.target.value
                                              },
                                            },
                                          }),
                                        ]),
                                        _vm._v(" "),
                                        _c("div", [
                                          _c(
                                            "div",
                                            { staticClass: "address" },
                                            [
                                              _c(
                                                "div",
                                                {
                                                  staticClass:
                                                    "d-flex flex-column dis",
                                                },
                                                [
                                                  _c(
                                                    "div",
                                                    {
                                                      staticClass:
                                                        "\n                                      d-flex\n                                      align-items-center\n                                      justify-content-between\n                                      mb-2\n                                    ",
                                                    },
                                                    [
                                                      _c("p", [
                                                        _vm._v("Total"),
                                                      ]),
                                                      _vm._v(" "),
                                                      _c("p", [
                                                        _c("span", {
                                                          staticClass:
                                                            "fas fa-dollar-sign",
                                                        }),
                                                        _vm._v(
                                                          "\n                                      " +
                                                            _vm._s(
                                                              parseFloat(
                                                                _vm.totalesventa
                                                                  .total
                                                              ).toFixed(2)
                                                            ) +
                                                            "\n                                    "
                                                        ),
                                                      ]),
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _c(
                                                    "div",
                                                    {
                                                      staticClass:
                                                        "\n                                      d-flex\n                                      align-items-center\n                                      justify-content-between\n                                      mb-2\n                                    ",
                                                    },
                                                    [
                                                      _c("p", [_vm._v("Pago")]),
                                                      _vm._v(" "),
                                                      _c("p", [
                                                        _c("span", {
                                                          staticClass:
                                                            "fas fa-dollar-sign",
                                                        }),
                                                        _vm._v(
                                                          _vm._s(
                                                            _vm.pagorecibido
                                                          ) +
                                                            "\n                                    "
                                                        ),
                                                      ]),
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _c(
                                                    "div",
                                                    {
                                                      staticClass:
                                                        "\n                                      d-flex\n                                      align-items-center\n                                      justify-content-between\n                                      mb-2\n                                    ",
                                                    },
                                                    [
                                                      _c(
                                                        "p",
                                                        {
                                                          staticClass:
                                                            "fw-bold",
                                                        },
                                                        [_vm._v("Cambio")]
                                                      ),
                                                      _vm._v(" "),
                                                      _c(
                                                        "p",
                                                        {
                                                          staticClass:
                                                            "fw-bold",
                                                        },
                                                        [
                                                          _c("span", {
                                                            staticClass:
                                                              "fas fa-dollar-sign",
                                                          }),
                                                          _vm._v(
                                                            _vm._s(
                                                              parseFloat(
                                                                _vm.total_cambio
                                                              ).toFixed(2)
                                                            ) +
                                                              "\n                                    "
                                                          ),
                                                        ]
                                                      ),
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _vm.pagorecibido
                                                    ? _c(
                                                        "div",
                                                        {
                                                          staticClass:
                                                            "btn btn-primary mt-2",
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              return _vm.downloadVentaContado(
                                                                _vm.pagorecibido,
                                                                _vm.total_cambio,
                                                                _vm.cliente.id
                                                              )
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _c("span", {
                                                            staticClass:
                                                              "fas fa-dollar-sign px-1",
                                                          }),
                                                          _vm._v(
                                                            "Terminar Venta\n                                  "
                                                          ),
                                                        ]
                                                      )
                                                    : _c(
                                                        "div",
                                                        {
                                                          staticClass:
                                                            "btn btn-primary mt-2",
                                                        },
                                                        [
                                                          _c("span", {
                                                            staticClass:
                                                              "fas fa-dollar-sign px-1",
                                                          }),
                                                          _vm._v(
                                                            "Terminar Venta\n                                  "
                                                          ),
                                                        ]
                                                      ),
                                                ]
                                              ),
                                            ]
                                          ),
                                        ]),
                                      ]),
                                    ]),
                                  ]),
                                ]
                              ),
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "modal-footer" }),
                          ]),
                        ]
                      ),
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "modal fade",
                      attrs: {
                        id: "ModalVentaTransferencia",
                        tabindex: "-1",
                        role: "dialog",
                        "aria-hidden": "true",
                      },
                    },
                    [
                      _c(
                        "div",
                        {
                          staticClass: "modal-dialog modal-sm",
                          attrs: { role: "document" },
                        },
                        [
                          _c("div", { staticClass: "modal-content" }, [
                            _vm._m(6),
                            _vm._v(" "),
                            _c("div", { staticClass: "modal-body" }, [
                              _c(
                                "div",
                                { staticClass: "container d-lg-flex" },
                                [
                                  _c("div", { staticClass: "box-2" }, [
                                    _c("div", { staticClass: "box-inner-2" }, [
                                      _c("form", { attrs: { action: "" } }, [
                                        _c("div", { staticClass: "mb-3" }, [
                                          _c(
                                            "p",
                                            { staticClass: "dis fw-bold mb-2" },
                                            [_vm._v("Cantidad recibida")]
                                          ),
                                          _vm._v(" "),
                                          _c("input", {
                                            directives: [
                                              {
                                                name: "model",
                                                rawName: "v-model",
                                                value:
                                                  _vm.pagorecibidotransferencia,
                                                expression:
                                                  "pagorecibidotransferencia",
                                              },
                                            ],
                                            staticClass: "form-control",
                                            attrs: { type: "number" },
                                            domProps: {
                                              value:
                                                _vm.pagorecibidotransferencia,
                                            },
                                            on: {
                                              input: function ($event) {
                                                if ($event.target.composing) {
                                                  return
                                                }
                                                _vm.pagorecibidotransferencia =
                                                  $event.target.value
                                              },
                                            },
                                          }),
                                        ]),
                                        _vm._v(" "),
                                        _c("div", { staticClass: "mb-3" }, [
                                          _c(
                                            "p",
                                            { staticClass: "dis fw-bold mb-2" },
                                            [
                                              _vm._v(
                                                "\n                                Detalle de transferencia\n                              "
                                              ),
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _c("input", {
                                            directives: [
                                              {
                                                name: "model",
                                                rawName: "v-model",
                                                value: _vm.detalletransferencia,
                                                expression:
                                                  "detalletransferencia",
                                              },
                                            ],
                                            staticClass: "form-control",
                                            attrs: { type: "text" },
                                            domProps: {
                                              value: _vm.detalletransferencia,
                                            },
                                            on: {
                                              input: function ($event) {
                                                if ($event.target.composing) {
                                                  return
                                                }
                                                _vm.detalletransferencia =
                                                  $event.target.value
                                              },
                                            },
                                          }),
                                        ]),
                                        _vm._v(" "),
                                        _c("div", [
                                          _c(
                                            "div",
                                            { staticClass: "address" },
                                            [
                                              _c(
                                                "div",
                                                {
                                                  staticClass:
                                                    "d-flex flex-column dis",
                                                },
                                                [
                                                  _c(
                                                    "div",
                                                    {
                                                      staticClass:
                                                        "\n                                      d-flex\n                                      align-items-center\n                                      justify-content-between\n                                      mb-2\n                                    ",
                                                    },
                                                    [
                                                      _c("p", [
                                                        _vm._v("Total"),
                                                      ]),
                                                      _vm._v(" "),
                                                      _c("p", [
                                                        _c("span", {
                                                          staticClass:
                                                            "fas fa-dollar-sign",
                                                        }),
                                                        _vm._v(
                                                          "\n                                      " +
                                                            _vm._s(
                                                              parseFloat(
                                                                _vm.totalesventa
                                                                  .total
                                                              ).toFixed(2)
                                                            ) +
                                                            "\n                                    "
                                                        ),
                                                      ]),
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _c(
                                                    "div",
                                                    {
                                                      staticClass:
                                                        "\n                                      d-flex\n                                      align-items-center\n                                      justify-content-between\n                                      mb-2\n                                    ",
                                                    },
                                                    [
                                                      _c("p", [_vm._v("Pago")]),
                                                      _vm._v(" "),
                                                      _c("p", [
                                                        _c("span", {
                                                          staticClass:
                                                            "fas fa-dollar-sign",
                                                        }),
                                                        _vm._v(
                                                          _vm._s(
                                                            _vm.pagorecibidotransferencia
                                                          ) +
                                                            "\n                                    "
                                                        ),
                                                      ]),
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _vm.pagorecibidotransferencia
                                                    ? _c(
                                                        "div",
                                                        {
                                                          staticClass:
                                                            "btn btn-primary mt-2",
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              return _vm.downloadVentaTransferencia(
                                                                _vm.pagorecibidotransferencia,
                                                                _vm.detalletransferencia,
                                                                _vm.cliente.id
                                                              )
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _c("span", {
                                                            staticClass:
                                                              "fas fa-dollar-sign px-1",
                                                          }),
                                                          _vm._v(
                                                            "Terminar Venta\n                                  "
                                                          ),
                                                        ]
                                                      )
                                                    : _c(
                                                        "div",
                                                        {
                                                          staticClass:
                                                            "btn btn-primary mt-2",
                                                        },
                                                        [
                                                          _c("span", {
                                                            staticClass:
                                                              "fas fa-dollar-sign px-1",
                                                          }),
                                                          _vm._v(
                                                            "Terminar Venta\n                                  "
                                                          ),
                                                        ]
                                                      ),
                                                ]
                                              ),
                                            ]
                                          ),
                                        ]),
                                      ]),
                                    ]),
                                  ]),
                                ]
                              ),
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "modal-footer" }),
                          ]),
                        ]
                      ),
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-12" }),
                  _vm._v(" "),
                  _c("div", { staticClass: "table-responsive" }, [
                    _c(
                      "table",
                      { staticClass: "table align-items-center table-flush" },
                      [
                        _vm._m(7),
                        _vm._v(" "),
                        _c(
                          "tbody",
                          _vm._l(_vm.detalleventa, function (item) {
                            return _c("tr", [
                              _c("td", [_vm._v(_vm._s(item.nombre))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(item.descripcion))]),
                              _vm._v(" "),
                              _c("td", [_vm._v(_vm._s(item.cantidad))]),
                              _vm._v(" "),
                              _c("td", [
                                _vm._v(
                                  "\n                      " +
                                    _vm._s(
                                      parseFloat(item.precioUnitario).toFixed(2)
                                    ) +
                                    "\n                    "
                                ),
                              ]),
                              _vm._v(" "),
                              _c("td", [
                                _vm._v(
                                  "\n                      " +
                                    _vm._s(
                                      parseFloat(item.subTotal).toFixed(2)
                                    ) +
                                    "\n                    "
                                ),
                              ]),
                              _vm._v(" "),
                              _c("td", { staticClass: "text-center" }, [
                                _c(
                                  "a",
                                  {
                                    staticClass:
                                      "btn btn-sm btn-icon-only text-light",
                                    attrs: {
                                      href: "#",
                                      role: "button",
                                      "data-toggle": "dropdown",
                                      "aria-haspopup": "true",
                                      "aria-expanded": "false",
                                    },
                                  },
                                  [
                                    _c("i", {
                                      staticClass: "fas fa-trash",
                                      on: {
                                        click: function ($event) {
                                          return _vm.deleteDetalleVenta(item.id)
                                        },
                                      },
                                    }),
                                  ]
                                ),
                              ]),
                            ])
                          }),
                          0
                        ),
                      ]
                    ),
                  ]),
                  _vm._v(" "),
                  _c(
                    "b-container",
                    { staticClass: "bv-example-row" },
                    [
                      _c(
                        "b-row",
                        [
                          _c("b-col"),
                          _vm._v(" "),
                          _c("b-col"),
                          _vm._v(" "),
                          _c(
                            "b-col",
                            [
                              _c("b-row", { staticClass: "pull-right" }, [
                                _c("div", { staticClass: "pull-right" }, [
                                  _c("table", { staticClass: "table" }, [
                                    _c("thead", { staticClass: "thead-dark" }),
                                    _vm._v(" "),
                                    _c("tbody", [
                                      _c("tr", [
                                        _c("td", [_vm._v("SubTotal")]),
                                        _vm._v(" "),
                                        _c("td", [
                                          _vm._v(
                                            "\n                              " +
                                              _vm._s(
                                                parseFloat(
                                                  _vm.totalesventa.subtotal
                                                ).toFixed(2)
                                              ) +
                                              "\n                            "
                                          ),
                                        ]),
                                      ]),
                                      _vm._v(" "),
                                      _c("tr", [
                                        _c("td", [
                                          _vm._v(
                                            "Iva (" +
                                              _vm._s(_vm.totalesventa.iva) +
                                              ")"
                                          ),
                                        ]),
                                        _vm._v(" "),
                                        _c("td", [
                                          _vm._v(
                                            "\n                              " +
                                              _vm._s(
                                                parseFloat(
                                                  _vm.totalesventa.valorIva
                                                ).toFixed(2)
                                              ) +
                                              "\n                            "
                                          ),
                                        ]),
                                      ]),
                                      _vm._v(" "),
                                      _c("tr", [
                                        _c("td", [_vm._v("Total")]),
                                        _vm._v(" "),
                                        _c("td", [
                                          _vm._v(
                                            "\n                              " +
                                              _vm._s(
                                                parseFloat(
                                                  _vm.totalesventa.total
                                                ).toFixed(2)
                                              ) +
                                              "\n                            "
                                          ),
                                        ]),
                                      ]),
                                    ]),
                                  ]),
                                ]),
                              ]),
                            ],
                            1
                          ),
                        ],
                        1
                      ),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "row" }, [
                    _c(
                      "div",
                      { staticClass: "col-xl-12 col-lg-12 pull-right" },
                      [
                        _c("br"),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            on: {
                              mouseover: _vm.onOver,
                              mouseleave: _vm.onLeave,
                            },
                          },
                          [
                            _c(
                              "b-dropdown",
                              {
                                ref: "dropdown",
                                staticClass: "m-md-2",
                                attrs: { id: "dropdown-1", text: "Continuar" },
                              },
                              [
                                _c(
                                  "b-dropdown-item",
                                  {
                                    attrs: {
                                      "data-toggle": "modal",
                                      "data-target": "#ModalVentaContado",
                                    },
                                  },
                                  [
                                    _c("i", {
                                      staticClass: "fas fa-dollar-sign",
                                    }),
                                    _vm._v(
                                      " Al\n                      contado"
                                    ),
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-dropdown-item",
                                  {
                                    attrs: {
                                      "data-toggle": "modal",
                                      "data-target": "#ModalVentaTransferencia",
                                    },
                                  },
                                  [
                                    _c("i", { staticClass: "fas fa-wallet" }),
                                    _vm._v("Transferencia"),
                                  ]
                                ),
                                _vm._v(" "),
                                _c(
                                  "b-dropdown-item",
                                  { on: { click: _vm.deleteVenta } },
                                  [
                                    _c("i", { staticClass: "fas fa-ban" }),
                                    _vm._v("Cancelar Venta"),
                                  ]
                                ),
                              ],
                              1
                            ),
                          ],
                          1
                        ),
                      ]
                    ),
                  ]),
                  _vm._v(" "),
                  _vm._m(8),
                ],
                1
              ),
            ]),
          ]),
        ])
      : _vm._e(),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-auto" }, [
      _c(
        "div",
        {
          staticClass:
            "\n                          icon icon-shape\n                          bg-danger\n                          text-white\n                          rounded-circle\n                          shadow\n                        ",
        },
        [_c("i", { staticClass: "fas fa-user" })]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-auto" }, [
      _c(
        "div",
        {
          staticClass:
            "\n                          icon icon-shape\n                          bg-yellow\n                          text-white\n                          rounded-circle\n                          shadow\n                        ",
        },
        [_c("i", { staticClass: "fas fa-users" })]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-8" }, [
      _c("h3", { staticClass: "mb-0" }, [_vm._v("Venta")]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "a",
      {
        staticClass: "btn btn-sm btn-primary",
        attrs: {
          href: "",
          "data-toggle": "modal",
          "data-target": "#ModalVentaProducto",
        },
      },
      [_c("i", { staticClass: "fas fa-search" }), _vm._v("Buscar Productos")]
    )
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c("h5", { staticClass: "modal-title" }, [_vm._v("Nuevo Item")]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close",
          },
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c("h5", { staticClass: "modal-title" }, [
        _vm._v("Terminar venta al contado"),
      ]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close",
          },
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c("h5", { staticClass: "modal-title" }, [
        _vm._v(
          "\n                      Terminar venta como transferencia\n                    "
        ),
      ]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close",
          },
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", { staticClass: "thead-light" }, [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Producto")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Descripcion")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Cantidad")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Precio Unitario")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("SubTotal")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Accion")]),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-footer py-4" }, [
      _c("nav", {
        staticClass: "d-flex justify-content-end",
        attrs: { "aria-label": "..." },
      }),
    ])
  },
]
render._withStripped = true



/***/ })

}]);