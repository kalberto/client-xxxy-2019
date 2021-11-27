(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/web/auditorias-listagem~js/web/clientes-listagem~js/web/predios-listagem"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: {},
  data: function data() {
    return {
      inicioLista: 1,
      finalLista: 1,
      totalLista: 1,
      pagina: 1,
      paginaUltima: 1,
      ultima: false,
      primeira: false
    };
  },
  methods: {
    setPaginacao: function setPaginacao(response) {
      var listName = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "lista";
      this.pagina = response.data.registros.current_page;
      this.paginaUltima = response.data.registros.last_page;
      this.inicioLista = response.data.registros.from;
      this.finalLista = response.data.registros.to;
      this.totalLista = response.data.registros.total;
      if (this.pagina < this.paginaUltima) this.ultima = false;else this.ultima = true;
      if (this.pagina > 1) this.primeira = false;else this.primeira = true;
      localStorage.setItem(listName, JSON.stringify({
        page: this.pagina
      }));
    },
    doPaginacao: function doPaginacao($event, callback) {
      switch ($event) {
        case "first":
          callback(1);
          break;

        case "previous":
          if (this.pagina > 1) callback(this.pagina - 1);else callback(1);
          break;

        case "next":
          if (this.pagina < this.paginaUltima) callback(this.pagina + 1);else callback(this.paginaUltima);
          break;

        case "last":
          callback(this.paginaUltima);
          break;

        default:
          callback(1);
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".paginacao[data-v-20b82217] {\n  justify-content: space-between;\n  padding: 50px 15px;\n  align-items: center;\n}\n.paginacao .total[data-v-20b82217] {\n  font-size: 0.9375rem;\n  color: rgba(0,0,0,0.7);\n}\n.paginacao .paginas button[data-v-20b82217] {\n  border: 1px solid #e75629;\n  font-size: 1.25rem;\n  background: transparent;\n  border-radius: 2px;\n  outline: 0;\n  cursor: pointer;\n  transition: all 0.2s ease-in-out;\n  color: rgba(0,0,0,0.7);\n  height: 26px;\n  width: 26px;\n  margin: 0 5px;\n  line-height: 1.25rem;\n  text-align: center;\n  padding: 0 0 2px;\n  -webkit-appearance: none;\n     -moz-appearance: none;\n          appearance: none;\n}\n.paginacao .paginas button[data-v-20b82217]:not(:disabled):hover {\n  background: #e75629;\n  color: #fff;\n}\n.paginacao .paginas button[data-v-20b82217]:last-child {\n  margin-right: 0;\n}\n.paginacao .paginas button[data-v-20b82217]:disabled {\n  border-color: #d1d1d1;\n  cursor: default;\n}\n.paginacao .paginas span[data-v-20b82217] {\n  font-size: 0.9375rem;\n  color: rgba(0,0,0,0.7);\n  min-width: 26px;\n  display: inline-block;\n  text-align: center;\n  font-weight: 900;\n  margin: 0 5px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/pug-plain-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "paginacao flex" }, [
    _c("div", { staticClass: "total" }, [
      _c("p", [
        _vm._v(
          "Exibindo " +
            _vm._s(_vm.inicioLista) +
            " a " +
            _vm._s(_vm.finalLista) +
            " de " +
            _vm._s(_vm.totalLista) +
            " registros"
        )
      ])
    ]),
    _c("div", { staticClass: "paginas" }, [
      _c(
        "button",
        {
          attrs: { type: "button", disabled: _vm.primeira },
          on: {
            click: function($event) {
              return _vm.$emit("togglePage", "first")
            }
          }
        },
        [_vm._v("«")]
      ),
      _c(
        "button",
        {
          attrs: { type: "button", disabled: _vm.primeira },
          on: {
            click: function($event) {
              return _vm.$emit("togglePage", "previous")
            }
          }
        },
        [_vm._v("‹")]
      ),
      _c("span", { staticClass: "numeroPagina" }, [_vm._v(_vm._s(_vm.pagina))]),
      _c(
        "button",
        {
          attrs: { type: "button", disabled: _vm.ultima },
          on: {
            click: function($event) {
              return _vm.$emit("togglePage", "next")
            }
          }
        },
        [_vm._v("›")]
      ),
      _c(
        "button",
        {
          attrs: { type: "button", disabled: _vm.ultima },
          on: {
            click: function($event) {
              return _vm.$emit("togglePage", "last")
            }
          }
        },
        [_vm._v("»")]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true&":
/*!*****************************************************************************************************************************!*\
  !*** ./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true& ***!
  \*****************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/vue/components/httPaginacao/HttPaginacao.vue":
/*!****************************************************************!*\
  !*** ./resources/vue/components/httPaginacao/HttPaginacao.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _HttPaginacao_vue_vue_type_template_id_20b82217_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug& */ "./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug&");
/* harmony import */ var _HttPaginacao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./HttPaginacao.vue?vue&type=script&lang=js& */ "./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _HttPaginacao_styl_vue_type_style_index_0_id_20b82217_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true& */ "./resources/vue/components/httPaginacao/HttPaginacao.styl?vue&type=style&index=0&id=20b82217&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _HttPaginacao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _HttPaginacao_vue_vue_type_template_id_20b82217_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"],
  _HttPaginacao_vue_vue_type_template_id_20b82217_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "20b82217",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/vue/components/httPaginacao/HttPaginacao.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HttPaginacao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./HttPaginacao.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_HttPaginacao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug&":
/*!********************************************************************************************************************!*\
  !*** ./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug& ***!
  \********************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_HttPaginacao_vue_vue_type_template_id_20b82217_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/pug-plain-loader!../../../../node_modules/vue-loader/lib??vue-loader-options!./HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/components/httPaginacao/HttPaginacao.vue?vue&type=template&id=20b82217&scoped=true&lang=pug&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_HttPaginacao_vue_vue_type_template_id_20b82217_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_HttPaginacao_vue_vue_type_template_id_20b82217_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/vue/mixins/Listagem.js":
/*!******************************************!*\
  !*** ./resources/vue/mixins/Listagem.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      routeName: '',
      search: '',
      lista: []
    };
  },
  methods: {
    loadLista: function loadLista() {
      var _this = this;

      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      this.$axios.get("".concat(this.routeName).concat(page ? "?page=" + page : "").concat(this.search ? "&q=" + this.search : "")).then(function (response) {
        return _this.loadResponse(response);
      });
    },
    searchLista: function searchLista() {
      var _this2 = this;

      this.$axios.get("".concat(this.routeName).concat(this.search ? "?q=" + this.search : "")).then(function (response) {
        return _this2.loadResponse(response);
      });
    },
    loadResponse: function loadResponse(response) {
      this.lista = response.data.registros.data;
      if (this.$refs.pagination) this.$refs.pagination.setPaginacao(response, "lista-".concat(this.routeName));
    }
  }
});

/***/ })

}]);