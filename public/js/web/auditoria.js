(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/web/auditoria"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/auditoria/auditoria.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/views/auditoria/auditoria.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vue_components_httButton_HttButton_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/vue/components/httButton/HttButton.vue */ "./resources/vue/components/httButton/HttButton.vue");
/* harmony import */ var _vue_components_httInput_HttInput_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/vue/components/httInput/HttInput.vue */ "./resources/vue/components/httInput/HttInput.vue");
/* harmony import */ var _vue_components_httSelect_HttSelect_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/vue/components/httSelect/HttSelect.vue */ "./resources/vue/components/httSelect/HttSelect.vue");
/* harmony import */ var _vue_components_httCheckAtivo_HttCheckAtivo_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/vue/components/httCheckAtivo/HttCheckAtivo.vue */ "./resources/vue/components/httCheckAtivo/HttCheckAtivo.vue");
/* harmony import */ var _vue_components_httTableColumn_HttTableColumn_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/vue/components/httTableColumn/HttTableColumn.vue */ "./resources/vue/components/httTableColumn/HttTableColumn.vue");
/* harmony import */ var _vue_components_httMensagem_HttMensagem_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @/vue/components/httMensagem/HttMensagem.vue */ "./resources/vue/components/httMensagem/HttMensagem.vue");
/* harmony import */ var _vue_mixins_Localizacao__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @/vue/mixins/Localizacao */ "./resources/vue/mixins/Localizacao.js");
/* harmony import */ var _vue_mixins_Validacao__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @/vue/mixins/Validacao */ "./resources/vue/mixins/Validacao.js");
/* harmony import */ var _vue_mixins_Format__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @/vue/mixins/Format */ "./resources/vue/mixins/Format.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  mixins: [_vue_mixins_Localizacao__WEBPACK_IMPORTED_MODULE_6__["default"], _vue_mixins_Validacao__WEBPACK_IMPORTED_MODULE_7__["default"], _vue_mixins_Format__WEBPACK_IMPORTED_MODULE_8__["default"]],
  components: {
    httButton: _vue_components_httButton_HttButton_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
    httInput: _vue_components_httInput_HttInput_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    httSelect: _vue_components_httSelect_HttSelect_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    httCheckAtivo: _vue_components_httCheckAtivo_HttCheckAtivo_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
    httTableColumn: _vue_components_httTableColumn_HttTableColumn_vue__WEBPACK_IMPORTED_MODULE_4__["default"],
    httMensagem: _vue_components_httMensagem_HttMensagem_vue__WEBPACK_IMPORTED_MODULE_5__["default"]
  },
  data: function data() {
    return {
      auditoria: null,
      venda: null,
      cliente: null,
      predio: null,
      btnDisabled: false,
      canSave: true
    };
  },
  created: function created() {
    var _this = this;

    this.loadContent().then(function () {
      return _this.loadVenda();
    }).then(function () {
      return _this.loadCliente();
    }).then(function () {
      return _this.loadPredios();
    });
  },
  computed: {
    valorTotalPacote: function valorTotalPacote() {
      if (!this.venda.produtos.pacotes.config.internet.valor) return '';

      if (this.venda.produtos.pacotes.config.internet.desconto) {
        return this.venda.produtos.pacotes.config.internet.is_percent ? "".concat(this.venda.produtos.pacotes.config.internet.valor * (100 - this.venda.produtos.pacotes.config.internet.desconto) / 100) : "".concat(this.calculateValorTotal(this.venda.produtos.pacotes.config.internet.valor, this.venda.produtos.pacotes.config.internet.desconto));
      } else {
        return "".concat(this.venda.produtos.pacotes.config.internet.valor);
      }
    },
    valorTotalVoz: function valorTotalVoz() {
      if (!this.venda.produtos.pacotes.config.voz.valor) return '';

      if (this.venda.produtos.pacotes.config.voz.valor) {
        return this.venda.produtos.pacotes.config.voz.is_percent ? "".concat(this.venda.produtos.pacotes.config.voz.valor * (100 - this.venda.produtos.pacotes.config.voz.desconto) / 100) : "".concat(this.calculateValorTotal(this.venda.produtos.pacotes.config.voz.valor, this.venda.produtos.pacotes.config.voz.desconto));
      } else {
        return "".concat(this.venda.produtos.pacotes.config.voz.valor);
      }
    },
    valorTotalCloud: function valorTotalCloud() {
      if (!this.venda.produtos.cloudbackup.config.valor) return '';

      if (this.venda.produtos.cloudbackup.config.desconto) {
        return this.venda.produtos.cloudbackup.config.is_percent ? "".concat(this.venda.produtos.cloudbackup.config.valor * (100 - this.venda.produtos.cloudbackup.config.desconto) / 100) : "".concat(this.calculateValorTotal(this.venda.produtos.cloudbackup.config.valor, this.venda.produtos.cloudbackup.config.desconto));
      } else {
        return "".concat(this.venda.produtos.cloudbackup.config.valor);
      }
    },
    valorTotal0800: function valorTotal0800() {
      if (!this.venda.produtos['0800'].config.valor) return '';

      if (this.venda.produtos['0800'].config.desconto) {
        return this.venda.produtos['0800'].config.is_percent ? "".concat(this.venda.produtos['0800'].config.valor * (100 - this.venda.produtos['0800'].config.desconto) / 100) : "".concat(this.calculateValorTotal(this.venda.produtos['0800'].config.valor, this.venda.produtos['0800'].config.desconto));
      } else {
        return "".concat(this.venda.produtos['0800'].config.valor);
      }
    },
    valorTotalSmartbox: function valorTotalSmartbox() {
      if (!this.venda.produtos.smartbox.config.valor && !this.venda.produtos.smartbox.config.quantidade_ramais) return '';
      var tempValor = this.venda.produtos.smartbox.config.quantidade_ramais * this.venda.produtos.smartbox.config.valor;

      if (this.venda.produtos.smartbox.config.desconto) {
        return this.venda.produtos.smartbox.config.is_percent ? "".concat(tempValor * (100 - this.venda.produtos.smartbox.config.desconto) / 100) : "".concat(this.calculateValorTotal(tempValor, this.venda.produtos.smartbox.config.desconto));
      } else {
        return "".concat(tempValor);
      }
    }
  },
  watch: {
    '$route.params.id': function $routeParamsId() {
      var _this2 = this;

      this.loadContent().then(function () {
        return _this2.loadVenda();
      }).then(function () {
        return _this2.loadCliente();
      }).then(function () {
        return _this2.loadPredios();
      }).then(function () {
        document.querySelector('.content').scrollTo(0, 0);
      });
    }
  },
  methods: {
    calculateValorTotal: function calculateValorTotal(valor, desconto) {
      return ((valor * 100 - desconto * 100) / 100).toFixed(2);
    },
    downloadArquivo: function downloadArquivo(nome) {
      var _this3 = this;

      this.$axios.get("vendas/".concat(this.venda.codigo, "/documentos/").concat(nome), {
        responseType: 'arraybuffer'
      }).then(function (response) {
        var contentDisposition = response.headers['content-disposition'];
        var name = contentDisposition.split('filename=', contentDisposition.length)[1];
        var blob = new Blob([response.data], {
          type: ''
        });
        _this3.ready = true;
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = name;
        a.click();
      });
    },
    loadVenda: function loadVenda() {
      var _this4 = this;

      return this.$axios.get("vendas/".concat(this.auditoria.codigo)).then(function (response) {
        _this4.venda = response.data;
      });
    },
    loadCliente: function loadCliente() {
      var _this5 = this;

      return this.$axios.get("clientes/".concat(this.venda.cliente.documento)).then(function (response) {
        _this5.cliente = response.data;
      });
    },
    loadPredios: function loadPredios() {
      var _this6 = this;

      return this.$axios.get("clientes/".concat(this.venda.cliente.documento, "/").concat(this.venda.is_empreendimento ? 'empreendimentos' : 'predios', "/").concat(this.venda.predio_id)).then(function (response) {
        _this6.predio = response.data;
      });
    },
    loadContent: function loadContent() {
      var _this7 = this;

      return this.$axios.get("auditorias/".concat(this.$route.params.id)).then(function (response) {
        _this7.auditoria = response.data;
      });
    },
    idNumerico: function idNumerico(predioId) {
      var reg = new RegExp(/\d+/, "gi");
      return reg.exec(predioId)[0];
    },
    sendAuditoria: function sendAuditoria(route) {
      var _this8 = this;

      this.btnDisabled = true;
      this.canSave = false;
      this.$axios.post("auditorias/".concat(this.auditoria.id, "/").concat(route), this.auditoria).then(function (response) {
        setTimeout(function () {
          window.location.reload(true);
        }, 1500);

        _this8.$refs.mensagem.toTop();

        _this8.$refs.mensagem.showSucesso(response.data.msg);
      })["catch"](function (error) {
        _this8.$refs.mensagem.toTop();

        _this8.$refs.mensagem.showErro(error.response.data.msg);

        if (error.response.status == 422) {
          _this8.errors = error.response.data.error_validate;
        }
      })["finally"](function () {
        _this8.btnDisabled = false;
        setTimeout(function () {
          _this8.canSave = true;

          _this8.$refs.mensagem.hide();
        }, 3500);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "p[data-v-b685c82a] {\n  padding: 10px 15px;\n  width: 100%;\n}\n.campo[data-v-b685c82a] {\n  width: 100%;\n  display: flex;\n  align-items: flex-start;\n}\n.campo.faixas[data-v-b685c82a] {\n  flex-flow: row wrap;\n  padding: 0 20px;\n}\n.campo p[data-v-b685c82a]:first-child {\n  width: 30%;\n}\n.campo p.faixa[data-v-b685c82a] {\n  width: 100%;\n}\n.campo.text[data-v-b685c82a] {\n  flex-flow: row wrap;\n}\nh3[data-v-b685c82a] {\n  font-size: 1.125rem;\n}\nh4[data-v-b685c82a] {\n  font-size: 1rem;\n  margin: 0 0 10px;\n  padding: 20px 15px;\n  width: 100%;\n}\n.fieldset[data-v-b685c82a]:not(:last-child) {\n  border-bottom: 1px solid rgba(0,0,0,0.08);\n  padding: 10px 0;\n}\n.fieldset > .fieldset[data-v-b685c82a] {\n  padding: 0 10px;\n}\n.arquivos[data-v-b685c82a] {\n  justify-content: space-between;\n  width: 100%;\n  flex-flow: row wrap;\n}\n.arquivos .arquivo[data-v-b685c82a] {\n  max-width: 30%;\n  padding: 15px;\n  box-shadow: 0 0 10px 10px rgba(0,0,0,0);\n  transition: all 0.2s ease-in-out;\n  margin: 15px;\n  cursor: pointer;\n}\n.arquivos .arquivo img[data-v-b685c82a] {\n  width: 40px;\n  margin: 0 auto;\n  margin-bottom: 15px;\n}\n.arquivos .arquivo p[data-v-b685c82a] {\n  font-size: 0.875rem;\n}\n.arquivos .arquivo[data-v-b685c82a]:hover {\n  box-shadow: 0 0 10px 10px rgba(0,0,0,0.04);\n}\ntextarea[data-v-b685c82a] {\n  resize: none;\n  margin: 0 15px 15px;\n  padding: 0.75rem 15px;\n  width: 100%;\n  border: 1px solid #ebebeb;\n  font-size: 1rem;\n  transition: all 0.2s ease-in-out;\n  height: 150px;\n  outline: 0;\n}\ntextarea[data-v-b685c82a]:focus {\n  border: 1px solid #e75629;\n}\n.auditoriaTipo[data-v-b685c82a] {\n  justify-content: space-around;\n  width: 100%;\n}\n.auditoriaTipo .bolinha[data-v-b685c82a] {\n  width: 50px;\n  height: 50px;\n  border-radius: 50%;\n  background: #ccc;\n  border: 1px solid #aaa;\n  margin: 0 auto;\n}\n.auditoriaTipo .atual .bolinha[data-v-b685c82a] {\n  background: #e75629;\n  border: 1px solid #ab3713;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/auditoria/auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug&":
/*!***********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/pug-plain-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/views/auditoria/auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "section",
    { attrs: { id: "pageAuditoria" } },
    [
      _c("httMensagem", { ref: "mensagem" }),
      _c(
        "form",
        {
          attrs: { autocomplete: "off" },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.sendForm($event)
            }
          }
        },
        [
          _vm.venda
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Venda - " + _vm._s(_vm.venda.codigo))])
              ])
            : _vm._e(),
          _vm.cliente
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Cliente")]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(0),
                  _c("p", [_vm._v(_vm._s(_vm.cliente.documento))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(1),
                  _c("p", [_vm._v(_vm._s(_vm.cliente.inscricao_estadual))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(2),
                  _vm.cliente.endereco
                    ? _c("p", [
                        _vm._v(
                          _vm._s(_vm.cliente.endereco.logradouro) +
                            ", " +
                            _vm._s(_vm.cliente.endereco.numero) +
                            " - " +
                            _vm._s(_vm.cliente.endereco.bairro) +
                            "\n" +
                            _vm._s(
                              _vm.cliente.endereco.complemento
                                ? "- " + _vm.cliente.endereco.complemento
                                : ""
                            )
                        ),
                        _c("br"),
                        _vm._v(
                          _vm._s(_vm.cliente.endereco.cep) +
                            " - " +
                            _vm._s(_vm.cliente.endereco.cidade.nome) +
                            " - " +
                            _vm._s(_vm.cliente.endereco.uf.uf)
                        )
                      ])
                    : _vm._e()
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(3),
                  _c("p", [_vm._v(_vm._s(_vm.auditoria.consultor))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(4),
                  _c("p", [
                    _vm._v(_vm._s(_vm.formatDate(_vm.venda.created_at)))
                  ])
                ])
              ])
            : _vm._e(),
          _vm.venda && _vm.venda.contato_comercial
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Contato Comercial")]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(5),
                  _c("p", [_vm._v(_vm._s(_vm.venda.contato_comercial.nome))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(6),
                  _c("p", [_vm._v(_vm._s(_vm.venda.contato_comercial.email))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(7),
                  _c("p", [
                    _vm._v(_vm._s(_vm.venda.contato_comercial.telefone))
                  ])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(8),
                  _c("p", [_vm._v(_vm._s(_vm.venda.contato_comercial.celular))])
                ])
              ])
            : _vm._e(),
          _vm.predio
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [
                  _vm._v(
                    _vm._s(
                      _vm.predio.is_empreendimento ? "Empreendimento" : "Prédio"
                    )
                  )
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(9),
                  _c("p", [_vm._v(_vm._s(_vm.predio.id))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(10),
                  _c("p", [_vm._v(_vm._s(_vm.predio.nome))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _c("p", [
                    _c("strong", [
                      _vm._v(
                        "Consultor " +
                          _vm._s(
                            _vm.predio.is_empreendimento
                              ? "Empreendimento"
                              : "Prédio"
                          ) +
                          ":"
                      )
                    ])
                  ]),
                  _c("p", [_vm._v(_vm._s(_vm.predio.consultor.consultor))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _c("p", [
                    _c("strong", [
                      _vm._v(
                        "Gerente " +
                          _vm._s(
                            _vm.predio.is_empreendimento
                              ? "Empreendimento"
                              : "Prédio"
                          ) +
                          ":"
                      )
                    ])
                  ]),
                  _c("p", [_vm._v(_vm._s(_vm.predio.consultor.gerente))])
                ])
              ])
            : _vm._e(),
          _vm.venda && _vm.cliente
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Endereço de Instalação")]),
                _c("div", { staticClass: "campo _70" }, [
                  _vm._m(11),
                  _c("p", [
                    _vm._v(_vm._s(_vm.venda.endereco_predio.logradouro))
                  ])
                ]),
                _c("div", { staticClass: "campo _30" }, [
                  _vm._m(12),
                  _c("p", [_vm._v(_vm._s(_vm.venda.endereco_predio.numero))])
                ]),
                _c("div", { staticClass: "campo _60" }, [
                  _vm._m(13),
                  _c("p", [
                    _vm._v(_vm._s(_vm.venda.predio_cliente_complemento))
                  ])
                ]),
                _c("div", { staticClass: "campo _40" }, [
                  _vm._m(14),
                  _c("p", [_vm._v(_vm._s(_vm.venda.endereco_predio.bairro))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(15),
                  _c("p", [
                    _vm._v(_vm._s(_vm.venda.endereco_predio.cidade.nome))
                  ])
                ]),
                _c("div", { staticClass: "campo _10" }, [
                  _vm._m(16),
                  _c("p", [_vm._v(_vm._s(_vm.venda.endereco_predio.cidade.uf))])
                ]),
                _c("div", { staticClass: "campo _30" }, [
                  _vm._m(17),
                  _c("p", [_vm._v(_vm._s(_vm.venda.endereco_predio.cep))])
                ])
              ])
            : _vm._e(),
          _vm.venda
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Produtos")]),
                _vm.venda.campanha
                  ? _c("div", { staticClass: "campo _30" }, [
                      _vm._m(18),
                      _c("p", [_vm._v(_vm._s(_vm.venda.campanha))])
                    ])
                  : _vm._e(),
                _vm.venda.campanha_nome
                  ? _c("div", { staticClass: "campo _70" }, [
                      _vm._m(19),
                      _c("p", [_vm._v(_vm._s(_vm.venda.campanha_nome))])
                    ])
                  : _vm._e(),
                _vm.venda.produtos.pacotes
                  ? _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("Internet")]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(20),
                        _c("p", [
                          _vm._v(_vm._s(_vm.venda.produtos.pacotes.nome))
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(21),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.internet.valor
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(22),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.internet
                                .desconto
                                ? _vm.venda.produtos.pacotes.config.internet
                                    .desconto
                                : "Não se aplica"
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(23),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.internet
                                .quantidade_ciclos
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _100" }, [
                        _vm._m(24),
                        _c("p", [_vm._v(_vm._s(_vm.valorTotalPacote))])
                      ])
                    ])
                  : _vm._e(),
                _vm.venda.produtos.pacotes
                  ? _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("Voz")]),
                      _vm._m(25),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(26),
                        _c("p", [
                          _vm._v(
                            _vm._s(_vm.venda.produtos.pacotes.config.voz.valor)
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(27),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.voz.desconto
                                ? _vm.venda.produtos.pacotes.config.voz.desconto
                                : "Não se aplica"
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(28),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.voz
                                .quantidade_ciclos
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _100" }, [
                        _vm._m(29),
                        _c("p", [_vm._v(_vm._s(_vm.valorTotalVoz))])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(30),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.voz.tecnologia
                            ) +
                              " \n" +
                              _vm._s(
                                _vm.venda.produtos.pacotes.config.voz
                                  .tecnologia_sinalizacao
                                  ? "- " +
                                      _vm.venda.produtos.pacotes.config.voz
                                        .tecnologia_sinalizacao
                                  : ""
                              )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(31),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.pacotes.config.voz
                                .quantidade_linhas
                            ) + "\t\t\t"
                          )
                        ])
                      ]),
                      _vm.venda.produtos.pacotes.config.voz.tecnologia ==
                        "SIP" ||
                      _vm.venda.produtos.pacotes.config.voz.tecnologia ==
                        "Digital"
                        ? _c("div", { staticClass: "campo _50" }, [
                            _vm._m(32),
                            _c("p", [
                              _vm._v(
                                _vm._s(
                                  _vm.venda.produtos.pacotes.config.voz
                                    .faixa_numeracao.identificacao
                                )
                              )
                            ])
                          ])
                        : _c("div", { staticClass: "campo _50" }, [
                            _vm._m(33),
                            _c("p", [_vm._v("Não se Aplica")])
                          ]),
                      _vm.venda.produtos.pacotes.config.voz.tecnologia ==
                        "SIP" ||
                      _vm.venda.produtos.pacotes.config.voz.tecnologia ==
                        "Digital"
                        ? _c("div", { staticClass: "campo _50" }, [
                            _vm._m(34),
                            _c("p", [
                              _vm._v(
                                _vm._s(
                                  _vm.venda.produtos.pacotes.config.voz
                                    .faixa_numeracao.piloto
                                )
                              )
                            ])
                          ])
                        : _c("div", { staticClass: "campo _50" }, [
                            _vm._m(35),
                            _c("p", [_vm._v("Não se Aplica")])
                          ]),
                      _c(
                        "div",
                        { staticClass: "campo faixas _100" },
                        [
                          _vm._m(36),
                          _vm._l(
                            _vm.venda.produtos.pacotes.config.voz
                              .faixa_numeracao.lista_numeros,
                            function(listaNumeros) {
                              return _c("p", [
                                _c("strong", [_vm._v("Inicial: ")]),
                                _vm._v(_vm._s(listaNumeros.inicial) + " \n-  "),
                                _c("strong", [_vm._v("Final: ")]),
                                _vm._v(_vm._s(listaNumeros.final) + " | "),
                                _c("strong", [_vm._v("Portado: ")]),
                                _vm._v(
                                  _vm._s(
                                    listaNumeros.portado == "sim"
                                      ? listaNumeros.portado + " | "
                                      : listaNumeros.portado
                                  ) + " "
                                ),
                                listaNumeros.portado == "sim"
                                  ? _c("strong", [
                                      _vm._v("Operadora Doadora: ")
                                    ])
                                  : _vm._e(),
                                _vm._v(
                                  _vm._s(
                                    listaNumeros.portado == "sim"
                                      ? listaNumeros.operadora_doadora
                                      : ""
                                  )
                                )
                              ])
                            }
                          )
                        ],
                        2
                      )
                    ])
                  : _vm._e(),
                _vm.venda.produtos.cloudbackup
                  ? _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("Cloudbackup")]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(37),
                        _c("p", [
                          _vm._v(_vm._s(_vm.venda.produtos.cloudbackup.nome))
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(38),
                        _c("p", [
                          _vm._v(
                            _vm._s(_vm.venda.produtos.cloudbackup.config.email)
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(39),
                        _c("p", [
                          _vm._v(
                            _vm._s(_vm.venda.produtos.cloudbackup.config.valor)
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(40),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.cloudbackup.config.desconto
                                ? _vm.venda.produtos.cloudbackup.config.desconto
                                : "Não se aplica"
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(41),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.cloudbackup.config
                                .quantidade_ciclos
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _100" }, [
                        _vm._m(42),
                        _c("p", [_vm._v(_vm._s(_vm.valorTotalCloud))])
                      ])
                    ])
                  : _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("Cloudbackup")]),
                      _vm._m(43)
                    ]),
                _vm.venda.produtos["0800"]
                  ? _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("0800")]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(44),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos["0800"].config.numero_0800
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(45),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos["0800"].config
                                .numero_encaminhamento
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(46),
                        _c("p", [
                          _vm._v(
                            _vm._s(_vm.venda.produtos["0800"].config.portado)
                          )
                        ])
                      ]),
                      _vm.venda.produtos["0800"].config.portado == "sim"
                        ? _c("div", { staticClass: "campo _50" }, [
                            _vm._m(47),
                            _c("p", [
                              _vm._v(
                                _vm._s(
                                  _vm.venda.produtos["0800"].config
                                    .operadora_doadora
                                )
                              )
                            ])
                          ])
                        : _vm._e(),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(48),
                        _c("p", [
                          _vm._v(
                            _vm._s(_vm.venda.produtos["0800"].config.valor)
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(49),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos["0800"].config.desconto
                                ? _vm.venda.produtos["0800"].config.desconto
                                : "Não se aplica"
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(50),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos["0800"].config
                                .quantidade_ciclos
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _100" }, [
                        _vm._m(51),
                        _c("p", [_vm._v(_vm._s(_vm.valorTotal0800))])
                      ])
                    ])
                  : _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("0800")]),
                      _vm._m(52)
                    ]),
                _vm.venda.produtos.smartbox
                  ? _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("SmartBox")]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(53),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.smartbox.config
                                .quantidade_ramais
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(54),
                        _c("p", [
                          _vm._v(
                            _vm._s(_vm.venda.produtos.smartbox.config.valor)
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(55),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.smartbox.config.desconto
                                ? _vm.venda.produtos.smartbox.config.desconto
                                : "Não se aplica"
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _50" }, [
                        _vm._m(56),
                        _c("p", [
                          _vm._v(
                            _vm._s(
                              _vm.venda.produtos.smartbox.config
                                .quantidade_ciclos
                            )
                          )
                        ])
                      ]),
                      _c("div", { staticClass: "campo _100" }, [
                        _vm._m(57),
                        _c("p", [_vm._v(_vm._s(_vm.valorTotalSmartbox))])
                      ])
                    ])
                  : _c("div", { staticClass: "fieldset" }, [
                      _c("h4", [_vm._v("Smartbox")]),
                      _vm._m(58)
                    ])
              ])
            : _vm._e(),
          _vm.venda
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Faturamento")]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(59),
                  _c("p", [_vm._v(_vm._s(_vm.venda.vencimento))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(60),
                  _c("p", [_vm._v(_vm._s(_vm.venda.email_fatura))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(61),
                  _vm.venda.endereco_correspondencia
                    ? _c("p", [
                        _vm._v(
                          _vm._s(
                            _vm.venda.endereco_correspondencia.logradouro
                          ) +
                            ", " +
                            _vm._s(_vm.venda.endereco_correspondencia.numero) +
                            " - " +
                            _vm._s(
                              _vm.venda.endereco_correspondencia.complemento
                            ) +
                            " - " +
                            _vm._s(_vm.venda.endereco_correspondencia.bairro)
                        ),
                        _c("br"),
                        _vm._v(
                          _vm._s(_vm.venda.endereco_correspondencia.cep) +
                            " - " +
                            _vm._s(
                              _vm.venda.endereco_correspondencia.cidade.nome
                            ) +
                            " - " +
                            _vm._s(_vm.venda.endereco_correspondencia.uf.uf)
                        )
                      ])
                    : _vm._e()
                ])
              ])
            : _vm._e(),
          _vm.venda
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", [_vm._v("Contratada")]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(62),
                  _c("p", [_vm._v(_vm._s(_vm.venda.contratada.nome))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(63),
                  _c("p", [_vm._v(_vm._s(_vm.venda.contratada_filial.cnpj))])
                ]),
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(64),
                  _vm.venda.endereco_correspondencia
                    ? _c("p", [
                        _vm._v(
                          _vm._s(
                            _vm.venda.contratada_filial.endereco.logradouro
                          ) +
                            ", " +
                            _vm._s(
                              _vm.venda.contratada_filial.endereco.numero
                            ) +
                            " \n" +
                            _vm._s(
                              _vm.venda.contratada_filial.endereco.complemento
                                ? "- " +
                                    _vm.venda.contratada_filial.endereco
                                      .complemento +
                                    " - "
                                : "-"
                            ) +
                            "\n" +
                            _vm._s(_vm.venda.contratada_filial.endereco.bairro)
                        ),
                        _c("br"),
                        _vm._v(
                          _vm._s(_vm.venda.contratada_filial.endereco.cep) +
                            " - " +
                            _vm._s(_vm.venda.contratada_filial.nome)
                        )
                      ])
                    : _vm._e()
                ])
              ])
            : _vm._e(),
          _vm.auditoria
            ? _c("div", { staticClass: "fieldset" }, [
                _c("div", { staticClass: "campo _50" }, [
                  _vm._m(65),
                  _c("p", [_vm._v(_vm._s(_vm.auditoria.status_nome))])
                ]),
                _c("div", { staticClass: "campo text _100" }, [
                  _vm._m(66),
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.auditoria.observacoes,
                        expression: "auditoria.observacoes"
                      }
                    ],
                    attrs: {
                      placeholder: "Observações",
                      disabled: !_vm.canSave
                    },
                    domProps: { value: _vm.auditoria.observacoes },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.auditoria,
                          "observacoes",
                          $event.target.value
                        )
                      }
                    }
                  })
                ])
              ])
            : _vm._e(),
          _vm.auditoria
            ? _c("div", { staticClass: "fieldset" }, [
                _c("div", { staticClass: "auditoriaTipo flex" }, [
                  _vm.auditoria.previous
                    ? _c(
                        "div",
                        { staticClass: "previous" },
                        [
                          _c(
                            "router-link",
                            {
                              attrs: {
                                to: {
                                  name: "auditorias-edit",
                                  params: { id: _vm.auditoria.previous.id }
                                }
                              }
                            },
                            [
                              _c("div", { staticClass: "bolinha" }),
                              _c("p", [
                                _vm._v(_vm._s(_vm.auditoria.previous.tipo_nome))
                              ])
                            ]
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _c("div", { staticClass: "atual" }, [
                    _c("div", { staticClass: "bolinha" }),
                    _c("p", [_vm._v(_vm._s(_vm.auditoria.tipo_nome))])
                  ]),
                  _vm.auditoria.last
                    ? _c(
                        "div",
                        { staticClass: "last" },
                        [
                          _c(
                            "router-link",
                            {
                              attrs: {
                                to: {
                                  name: "auditorias-edit",
                                  params: { id: _vm.auditoria.last.id }
                                }
                              }
                            },
                            [
                              _c("div", { staticClass: "bolinha" }),
                              _c("p", [
                                _vm._v(_vm._s(_vm.auditoria.last.tipo_nome))
                              ])
                            ]
                          )
                        ],
                        1
                      )
                    : _vm._e()
                ])
              ])
            : _vm._e(),
          _vm.venda && _vm.venda.documentos.length > 0
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h4", { staticClass: "_100 totalWidth" }, [
                  _vm._v("Download Arquivos")
                ]),
                _c(
                  "div",
                  { staticClass: "arquivos flex" },
                  _vm._l(_vm.venda.documentos, function(documento, index) {
                    return _c(
                      "div",
                      {
                        staticClass: "arquivo",
                        on: {
                          click: function($event) {
                            return _vm.downloadArquivo(documento.nome)
                          }
                        }
                      },
                      [
                        _c("img", {
                          attrs: {
                            src: __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/file.svg */ "./resources/assets/images/web/icones/iconesBranco/file.svg")
                          }
                        }),
                        _c("p", [_vm._v(_vm._s(documento.nome))])
                      ]
                    )
                  }),
                  0
                )
              ])
            : _vm._e(),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _vm.$root.hasPermission("auditorias", 3)
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Reprovar",
                      buttonDisabled:
                        (_vm.auditoria && _vm.auditoria.status != "E") ||
                        !_vm.canSave,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/aprovar_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/aprovar_branco.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.sendAuditoria("nogo")
                      }
                    }
                  })
                : _vm._e(),
              _vm.$root.hasPermission("auditorias", 3)
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Aprovar",
                      buttonDisabled:
                        (_vm.auditoria && _vm.auditoria.status != "E") ||
                        !_vm.canSave,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/save_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/save_branco.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.sendAuditoria("go")
                      }
                    }
                  })
                : _vm._e()
            ],
            1
          )
        ]
      )
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Documento: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Inscricão Estadual: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Endereço: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Consultor de Venda:  ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Data da Venda:  ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Email:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Telefone:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Celular:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Identificador: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Logradouro:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Número:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Complemento:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Bairro:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Cidade:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("UF:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("CEP:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Campanha:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Nome da Campanha:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Plano de Internet: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Recorrência do desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor Total:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "campo _50" }, [
      _c("p", [_c("strong", [_vm._v("Plano de Voz: ")])]),
      _c("p", [_vm._v("xxxx Voz Fast")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Consumo Mínimo de Voz: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Recorrência do desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor Total:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Tecnologia de Voz: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Quantidade de linhas: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Identificação: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Identificação: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Piloto:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Piloto:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "faixa" }, [
      _c("strong", [_vm._v("Faixas de numeração: ")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Tipo Backup: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("E-mail login: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Recorrência do desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor Total:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "campo _50" }, [
      _c("p", [_vm._v("Não se Aplica")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Número do 0800: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Número Encaminhamento: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Portado: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Operadora Doadora: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Recorrência do desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor Total:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "campo _50" }, [
      _c("p", [_vm._v("Não se Aplica")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Qtd de Ramais:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor por Ramal:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Recorrência do desconto: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Valor Total:")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "campo _50" }, [
      _c("p", [_vm._v("Não se Aplica")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Vencimento: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("E-mail Fatura: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Endereço: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Razão Social")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("CNPJ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Endereço: ")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [_c("strong", [_vm._v("Status Auditoria")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "faixa" }, [
      _c("strong", [_vm._v("Observações:")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/assets/images/web/icones/iconesBranco/aprovar_branco.svg":
/*!****************************************************************************!*\
  !*** ./resources/assets/images/web/icones/iconesBranco/aprovar_branco.svg ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/aprovar_branco.svg?54a80c05f8e8ea74066d58807b859552";

/***/ }),

/***/ "./resources/assets/images/web/icones/iconesBranco/file.svg":
/*!******************************************************************!*\
  !*** ./resources/assets/images/web/icones/iconesBranco/file.svg ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/file.svg?651db13f1b94ea9b6894e236dee1af11";

/***/ }),

/***/ "./resources/assets/images/web/icones/iconesBranco/save_branco.svg":
/*!*************************************************************************!*\
  !*** ./resources/assets/images/web/icones/iconesBranco/save_branco.svg ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/save_branco.svg?b803266e9ce93a6f2371ec8854ab95ee";

/***/ }),

/***/ "./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true&":
/*!******************************************************************************************************************!*\
  !*** ./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true& ***!
  \******************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a);

/***/ }),

/***/ "./resources/vue/views/auditoria/auditoria.vue":
/*!*****************************************************!*\
  !*** ./resources/vue/views/auditoria/auditoria.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _auditoria_vue_vue_type_template_id_b685c82a_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug& */ "./resources/vue/views/auditoria/auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug&");
/* harmony import */ var _auditoria_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./auditoria.vue?vue&type=script&lang=js& */ "./resources/vue/views/auditoria/auditoria.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Auditoria_styl_vue_type_style_index_0_id_b685c82a_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true& */ "./resources/vue/views/auditoria/Auditoria.styl?vue&type=style&index=0&id=b685c82a&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _auditoria_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _auditoria_vue_vue_type_template_id_b685c82a_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"],
  _auditoria_vue_vue_type_template_id_b685c82a_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "b685c82a",
  null

)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/vue/views/auditoria/auditoria.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/vue/views/auditoria/auditoria.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/vue/views/auditoria/auditoria.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_auditoria_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./auditoria.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/auditoria/auditoria.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_auditoria_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./resources/vue/views/auditoria/auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug&":
/*!*********************************************************************************************************!*\
  !*** ./resources/vue/views/auditoria/auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_auditoria_vue_vue_type_template_id_b685c82a_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/pug-plain-loader!../../../../node_modules/vue-loader/lib??vue-loader-options!./auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/auditoria/auditoria.vue?vue&type=template&id=b685c82a&scoped=true&lang=pug&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_auditoria_vue_vue_type_template_id_b685c82a_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_auditoria_vue_vue_type_template_id_b685c82a_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=auditoria.js.map
