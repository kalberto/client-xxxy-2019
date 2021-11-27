(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/web/prospeccao"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _vue_components_httButton_HttButton_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/vue/components/httButton/HttButton.vue */ "./resources/vue/components/httButton/HttButton.vue");
/* harmony import */ var _vue_components_httInput_HttInput_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/vue/components/httInput/HttInput.vue */ "./resources/vue/components/httInput/HttInput.vue");
/* harmony import */ var _vue_components_httSelect_HttSelect_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/vue/components/httSelect/HttSelect.vue */ "./resources/vue/components/httSelect/HttSelect.vue");
/* harmony import */ var _vue_components_httCheckAtivo_HttCheckAtivo_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/vue/components/httCheckAtivo/HttCheckAtivo.vue */ "./resources/vue/components/httCheckAtivo/HttCheckAtivo.vue");
/* harmony import */ var _vue_components_httTableColumn_HttTableColumn_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @/vue/components/httTableColumn/HttTableColumn.vue */ "./resources/vue/components/httTableColumn/HttTableColumn.vue");
/* harmony import */ var _vue_components_httMensagem_HttMensagem_vue__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @/vue/components/httMensagem/HttMensagem.vue */ "./resources/vue/components/httMensagem/HttMensagem.vue");
/* harmony import */ var _vue_mixins_Localizacao__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @/vue/mixins/Localizacao */ "./resources/vue/mixins/Localizacao.js");
/* harmony import */ var _vue_mixins_Validacao__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @/vue/mixins/Validacao */ "./resources/vue/mixins/Validacao.js");
/* harmony import */ var _vue_mixins_Format__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @/vue/mixins/Format */ "./resources/vue/mixins/Format.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  mixins: [_vue_mixins_Localizacao__WEBPACK_IMPORTED_MODULE_7__["default"], _vue_mixins_Validacao__WEBPACK_IMPORTED_MODULE_8__["default"], _vue_mixins_Format__WEBPACK_IMPORTED_MODULE_9__["default"]],
  components: {
    httButton: _vue_components_httButton_HttButton_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    httInput: _vue_components_httInput_HttInput_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    httSelect: _vue_components_httSelect_HttSelect_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
    httCheckAtivo: _vue_components_httCheckAtivo_HttCheckAtivo_vue__WEBPACK_IMPORTED_MODULE_4__["default"],
    httTableColumn: _vue_components_httTableColumn_HttTableColumn_vue__WEBPACK_IMPORTED_MODULE_5__["default"],
    httMensagem: _vue_components_httMensagem_HttMensagem_vue__WEBPACK_IMPORTED_MODULE_6__["default"]
  },
  data: function data() {
    return {
      btnDisabled: false,
      canSave: true,
      prospeccao: {
        predio_id: "",
        data_contato: "",
        observacoes: "",
        produtos: {},
        venda_perdida: {},
        cliente_documento: "",
        is_empreendimento: false
      },
      clienteVerificacao: {
        mensagem: "Pendente de verificação",
        disabled: false
      },
      produtos: {
        pacotes: [],
        cloudbackup: [],
        smartbox: [],
        "0800": []
      },
      cliente: null,
      clientes: [],
      predio: null,
      predios: [],
      empreendimento: null,
      empreendimentos: [],
      status: [],
      statusId: null,
      statusNegociacao: [],
      statusNegociacaoId: null,
      motivosVendaPerdida: [],
      vendaPerdidaId: null,
      pacotes: null,
      cloudbackup: null,
      smartbox: null,
      "0800": null
    };
  },
  created: function created() {
    var _this = this;

    axios__WEBPACK_IMPORTED_MODULE_0___default.a.all([this.loadProdutos(), this.loadClientes(), this.loadStatus(), this.loadStatusNegociacao(), this.loadMotivosVendaPerdida()]).then(function () {
      return _this.$route.params.id ? _this.loadContent().then(function () {
        return Promise.resolve(true);
      }) : Promise.resolve(false);
    }).then(function (hasContent) {
      if (hasContent) Promise.resolve();

      _this.configureProspeccao();
    });
  },
  watch: {
    'cliente': function cliente(oldValue, newValue) {
      var _this2 = this;

      if (oldValue != newValue) {
        this.predio = null;
        this.empreendimento = null;
        this.loadPredios(this.cliente.documento).then(function () {
          if (_this2.prospeccao.predio_id) _this2.predio = _this2.predios.find(function (element) {
            return element.predio_id == _this2.prospeccao.predio_id;
          });
        });
        this.loadEmpreendimentos(this.cliente.documento).then(function () {
          if (_this2.prospeccao.predio_id) _this2.empreendimento = _this2.empreendimentos.find(function (element) {
            return element.predio_id == _this2.prospeccao.predio_id;
          });
        });
        this.clienteVerificacao.mensagem = "Pendente de verificação";
        this.clienteVerificacao.disabled = false;
      }
    },
    'is_empreendimento': function is_empreendimento() {
      this.predio = null;
      this.empreendimento = null;
    }
  },
  methods: {
    configureProspeccao: function configureProspeccao() {
      var _this3 = this;

      if (this.prospeccao.cliente_documento) this.cliente = this.clientes.find(function (element) {
        return element.documento == _this3.prospeccao.cliente_documento;
      });
      if (this.prospeccao.status) this.statusId = this.status.find(function (element) {
        return element.id == _this3.prospeccao.status;
      });
      if (this.prospeccao.status_negociacao) this.statusNegociacaoId = this.statusNegociacao.find(function (element) {
        return element.id == _this3.prospeccao.status_negociacao;
      });
      if (this.prospeccao.venda_perdida && this.prospeccao.venda_perdida.id) this.vendaPerdidaId = this.prospeccao.venda_perdida;

      if (this.prospeccao.produtos) {
        this.pacotes = this.prospeccao.produtos.pacotes || null;
        this.cloudbackup = this.prospeccao.produtos.cloudbackup || null;
        this.smartbox = this.prospeccao.produtos.smartbox || null;
        this.$data['0800'] = this.prospeccao.produtos['0800'] || null;
        this.prospeccao.produtos = {};
      }

      if (this.prospeccao.status == "V" || this.prospeccao.status == "P") {
        this.$refs.mensagem.showAviso('Esta prospecção não pode ser alterada!');
        this.btnDisabled = true;
      }
    },
    loadMotivosVendaPerdida: function loadMotivosVendaPerdida() {
      var _this4 = this;

      return this.$axios.get("prospeccoes/venda-perdida/motivos").then(function (response) {
        _this4.motivosVendaPerdida = response.data;
      });
    },
    loadClientes: function loadClientes() {
      var _this5 = this;

      return this.$axios.get("clientes/select").then(function (response) {
        _this5.clientes = response.data;
      });
    },
    loadPredios: function loadPredios(documento) {
      var _this6 = this;

      return this.$axios.get("clientes/".concat(documento, "/predios")).then(function (response) {
        _this6.predios = response.data;
      });
    },
    loadEmpreendimentos: function loadEmpreendimentos(documento) {
      var _this7 = this;

      return this.$axios.get("clientes/".concat(documento, "/empreendimentos")).then(function (response) {
        _this7.empreendimentos = response.data;
      });
    },
    loadProdutos: function loadProdutos() {
      var _this8 = this;

      return this.$axios.get("produtos/tipos").then(function (response) {
        response.data.forEach(function (element) {
          _this8.produtos[element.slug] = element.produtos;
        });
      });
    },
    loadStatus: function loadStatus() {
      var _this9 = this;

      return this.$axios.get("prospeccoes/status").then(function (response) {
        _this9.status = response.data;
      });
    },
    loadStatusNegociacao: function loadStatusNegociacao() {
      var _this10 = this;

      return this.$axios.get("prospeccoes/status-negociacao").then(function (response) {
        _this10.statusNegociacao = response.data;
      });
    },
    loadContent: function loadContent() {
      var _this11 = this;

      return this.$axios.get("prospeccoes/".concat(this.$route.params.id)).then(function (response) {
        _this11.prospeccao = response.data;
      });
    },
    idNumerico: function idNumerico(predioId) {
      var reg = new RegExp(/\d+/, "gi");
      return reg.exec(predioId)[0];
    },
    configureStatusCliente: function configureStatusCliente(validacao) {
      switch (validacao) {
        case 'A':
          this.clienteVerificacao.mensagem = "Aprovado";
          break;

        case 'E':
          this.clienteVerificacao.mensagem = "Expirado";
          break;

        case 'R':
          this.clienteVerificacao.mensagem = "Reprovado";
          break;

        default:
          this.clienteVerificacao.mensagem = "Não verificado";
      }
    },
    verifyCliente: function verifyCliente() {
      var _this12 = this;

      this.clienteVerificacao.disabled = true;
      this.$axios.get("clientes/".concat(this.cliente.documento, "/verify")).then(function (response) {
        if (response.data.approved) _this12.configureStatusCliente('A');else _this12.configureStatusCliente('R');
      })["catch"](function (error) {
        _this12.clienteVerificacao.disabled = false;
        if (error.response.data.success != undefined) _this12.clienteVerificacao.mensagem = "Ocorreu um erro ao validar";else _this12.clienteVerificacao.mensagem = error.response.data.msg;
      });
    },
    sendForm: function sendForm() {
      var _this13 = this;

      var id = this.$route.params.id || null;
      if (this.cliente) this.prospeccao.cliente_documento = this.cliente.documento;

      if (this.prospeccao.is_empreendimento) {
        if (this.empreendimento) this.prospeccao.predio_id = this.empreendimento.predio_id;
      } else {
        if (this.predio) this.prospeccao.predio_id = this.predio.predio_id;
      }

      if (this.vendaPerdidaId) this.prospeccao.venda_perdida = this.vendaPerdidaId;

      if (this.statusId) {
        this.prospeccao.status = this.statusId.id;
        if (this.statusId.id == "N" && this.statusNegociacaoId) this.prospeccao.status_negociacao = this.statusNegociacaoId.id;
      }

      if (this.pacotes) this.prospeccao.produtos.pacotes = this.pacotes;
      if (this.cloudbackup) this.prospeccao.produtos.cloudbackup = this.cloudbackup;
      if (this.smartbox) this.prospeccao.produtos.smartbox = this.smartbox;
      if (this.$data['0800']) this.prospeccao.produtos['0800'] = this.$data['0800'];
      this.btnDisabled = true;
      this.canSave = false;
      this.$axios.post("prospeccoes".concat(id ? '/' + id : ''), this.prospeccao).then(function (response) {
        if (!_this13.$route.params.id) {
          setTimeout(function () {
            _this13.$router.push({
              name: "prospeccoes-edit",
              params: {
                id: response.data.codigo
              }
            });

            setTimeout(function () {
              window.location.reload(true);
            }, 1500);
          }, 1000);
        }

        _this13.$refs.mensagem.toTop();

        _this13.$refs.mensagem.showSucesso(response.data.msg);
      })["catch"](function (error) {
        _this13.$refs.mensagem.toTop();

        if (error.response.status == 422) {
          if (error.response.data.error_validate) {
            _this13.errors = error.response.data.error_validate;

            _this13.$refs.mensagem.showErro();
          } else {
            _this13.$refs.mensagem.showErro(error.response.data.msg);
          }
        } else _this13.$refs.mensagem.showErro();
      })["finally"](function () {
        _this13.btnDisabled = false;
        setTimeout(function () {
          _this13.canSave = true;

          _this13.$refs.mensagem.hide();
        }, 3500);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "textarea[data-v-53cb24fd] {\n  resize: none;\n  margin: 0 15px 15px;\n  padding: 0.75rem 15px;\n  width: 100%;\n  border: 1px solid #ebebeb;\n  font-size: 1rem;\n  transition: all 0.2s ease-in-out;\n  height: 150px;\n  outline: 0;\n}\ntextarea[data-v-53cb24fd]:focus {\n  border: 1px solid #e75629;\n}\n.verifyCliente[data-v-53cb24fd] {\n  align-items: flex-end;\n  flex-direction: column;\n  justify-content: center;\n}\n.verifyCliente p[data-v-53cb24fd] {\n  padding: 0 15px;\n}\n.verifyCliente .message[data-v-53cb24fd] {\n  visibility: hidden;\n  opacity: 0;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n  transition: all 0.2s ease-in-out;\n  position: absolute;\n  top: -20px;\n  font-size: 0.75rem;\n  right: 15px;\n  white-space: nowrap;\n}\n.verifyCliente.error .message[data-v-53cb24fd],\n.verifyCliente.success .message[data-v-53cb24fd] {\n  visibility: visible;\n  opacity: 1;\n  -webkit-user-select: all;\n     -moz-user-select: all;\n      -ms-user-select: all;\n          user-select: all;\n}\n.verifyCliente.error .message[data-v-53cb24fd] {\n  color: #c00;\n}\n.verifyCliente.success .message[data-v-53cb24fd] {\n  color: #090;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug&":
/*!*************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/pug-plain-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************/
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
    { attrs: { id: "pageClienteForm" } },
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
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("span", [_vm._v("Prédio")]),
              _c("httCheckAtivo", {
                staticClass: "_10",
                attrs: {
                  nomeCheckbox: "",
                  checkboxValue: _vm.prospeccao.is_empreendimento,
                  disabledCheckbox:
                    (_vm.$route.params.id ? true : false) || !_vm.canSave
                },
                on: {
                  "update:checkboxValue": function($event) {
                    return _vm.$set(_vm.prospeccao, "is_empreendimento", $event)
                  },
                  "update:checkbox-value": function($event) {
                    return _vm.$set(_vm.prospeccao, "is_empreendimento", $event)
                  }
                }
              }),
              _c("span", [_vm._v("Empreendimento")])
            ],
            1
          ),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("httSelect", {
                staticClass: "_50",
                class: { error: _vm.existError("cliente_documento") },
                attrs: {
                  sPlaceholder: "Selecione um cliente",
                  disabled:
                    (_vm.$route.params.id ? true : false) || !_vm.canSave,
                  sOptions: _vm.clientes,
                  sLabel: "nome",
                  sTrack: "documento",
                  sValue: _vm.cliente,
                  multiple: false,
                  selectMessage: _vm.getError("cliente_documento")
                },
                on: {
                  "update:sValue": function($event) {
                    _vm.cliente = $event
                  },
                  "update:s-value": function($event) {
                    _vm.cliente = $event
                  }
                }
              }),
              !_vm.prospeccao.is_empreendimento
                ? _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("predio_id") },
                    attrs: {
                      sPlaceholder: "Selecione um prédio",
                      disabled:
                        (_vm.$route.params.id ? true : false) || !_vm.canSave,
                      sOptions: _vm.predios,
                      sLabel: "nome",
                      sTrack: "predio_id",
                      sValue: _vm.predio,
                      multiple: false,
                      selectMessage: _vm.getError("predio_id")
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.predio = $event
                      },
                      "update:s-value": function($event) {
                        _vm.predio = $event
                      }
                    }
                  })
                : _vm._e(),
              _vm.prospeccao.is_empreendimento
                ? _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("predio_id") },
                    attrs: {
                      sPlaceholder: "Selecione um Empreendimento",
                      disabled:
                        (_vm.$route.params.id ? true : false) || !_vm.canSave,
                      sOptions: _vm.empreendimentos,
                      sLabel: "nome",
                      sTrack: "predio_id",
                      sValue: _vm.empreendimento,
                      multiple: false,
                      selectMessage: _vm.getError("predio_id")
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.empreendimento = $event
                      },
                      "update:s-value": function($event) {
                        _vm.empreendimento = $event
                      }
                    }
                  })
                : _vm._e(),
              _c("httInput", {
                staticClass: "_50",
                class: { error: _vm.existError("data_contato") },
                attrs: {
                  inputName: "data_contato",
                  inputMask: "##-##-####",
                  inputLabel: "Data Contato",
                  inputType: "text",
                  inputValue: _vm.prospeccao.data_contato,
                  inputMessage: _vm.getError("data_contato"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.prospeccao, "data_contato", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.prospeccao, "data_contato", $event)
                  },
                  blur: function($event) {
                    return _vm.limparErroCampo("data_contato")
                  }
                }
              }),
              _c("httSelect", {
                staticClass: "_50",
                class: { error: _vm.existError("status") },
                attrs: {
                  sPlaceholder: "Selecione um status",
                  sOptions: _vm.status,
                  sLabel: "nome",
                  sTrack: "id",
                  sValue: _vm.statusId,
                  multiple: false,
                  selectMessage: _vm.getError("status"),
                  disabled: !_vm.canSave
                },
                on: {
                  "update:sValue": function($event) {
                    _vm.statusId = $event
                  },
                  "update:s-value": function($event) {
                    _vm.statusId = $event
                  }
                }
              }),
              _vm.cliente &&
              _vm.cliente.documento &&
              _vm.statusId &&
              _vm.statusId.id == "V"
                ? _c(
                    "div",
                    {
                      staticClass: "fieldset verifyCliente _100 totalWidth",
                      class: {
                        error:
                          _vm.existError("cliente.data_verificacao") ||
                          _vm.existError("cliente.status")
                      },
                      staticStyle: { "margin-bottom": "15px" }
                    },
                    [
                      _vm.existError("cliente.data_verificacao")
                        ? _c("span", { staticClass: "message" }, [
                            _vm._v(
                              _vm._s(_vm.getError("cliente.data_verificacao"))
                            )
                          ])
                        : _vm._e(),
                      !_vm.existError("cliente.data_verificacao") &&
                      _vm.existError("cliente.status")
                        ? _c("span", { staticClass: "message" }, [
                            _vm._v(_vm._s(_vm.getError("cliente.status")))
                          ])
                        : _vm._e(),
                      _c("httButton", {
                        attrs: {
                          buttonType: "button",
                          buttonText: "Verificar Cliente",
                          buttonDisabled: _vm.clienteVerificacao.disabled,
                          "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/aprovar_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/aprovar_branco.svg")
                        },
                        on: {
                          click: function($event) {
                            return _vm.verifyCliente()
                          }
                        }
                      }),
                      _c("div", [
                        _c("p", [
                          _c("strong", [_vm._v("Status do cliente:")]),
                          _vm._v(_vm._s(_vm.clienteVerificacao.mensagem))
                        ])
                      ])
                    ],
                    1
                  )
                : _vm._e(),
              _c("textarea", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.prospeccao.observacoes,
                    expression: "prospeccao.observacoes"
                  }
                ],
                attrs: { placeholder: "Observações", disabled: !_vm.canSave },
                domProps: { value: _vm.prospeccao.observacoes },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.prospeccao, "observacoes", $event.target.value)
                  }
                }
              })
            ],
            1
          ),
          _vm.statusId && _vm.statusId.id == "N"
            ? _c(
                "div",
                { staticClass: "fieldset" },
                [
                  _c("h3", { staticClass: "_100" }, [
                    _vm._v("Status de Negociação")
                  ]),
                  _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("status_negociacao") },
                    attrs: {
                      sPlaceholder: "Selecione um status de Negociação",
                      sOptions: _vm.statusNegociacao,
                      sLabel: "nome",
                      sTrack: "id",
                      sValue: _vm.statusNegociacaoId,
                      multiple: false,
                      selectMessage: _vm.getError("status_negociacao"),
                      empty: true,
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.statusNegociacaoId = $event
                      },
                      "update:s-value": function($event) {
                        _vm.statusNegociacaoId = $event
                      }
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm.statusId && _vm.statusId.id == "P"
            ? _c(
                "div",
                { staticClass: "fieldset" },
                [
                  _c("h3", { staticClass: "_100" }, [_vm._v("Motivos")]),
                  _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("venda_perdida") },
                    attrs: {
                      sPlaceholder: "Selecione um motivo",
                      sOptions: _vm.motivosVendaPerdida,
                      sLabel: "motivo",
                      sTrack: "id",
                      sValue: _vm.vendaPerdidaId,
                      multiple: false,
                      selectMessage: _vm.getError("venda_perdida"),
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.vendaPerdidaId = $event
                      },
                      "update:s-value": function($event) {
                        _vm.vendaPerdidaId = $event
                      }
                    }
                  }),
                  _vm.vendaPerdidaId && _vm.vendaPerdidaId.motivo == "Outros"
                    ? _c("httInput", {
                        staticClass: "_50",
                        class: {
                          error: _vm.existError("venda_perdida.comentario")
                        },
                        attrs: {
                          inputName: "comentario",
                          inputLabel: "Comentário",
                          inputType: "text",
                          inputValue: _vm.vendaPerdidaId.comentario,
                          inputMessage: _vm.getError(
                            "venda_perdida.comentario"
                          ),
                          inputDisabled: !_vm.canSave
                        },
                        on: {
                          "update:inputValue": function($event) {
                            return _vm.$set(
                              _vm.vendaPerdidaId,
                              "comentario",
                              $event
                            )
                          },
                          "update:input-value": function($event) {
                            return _vm.$set(
                              _vm.vendaPerdidaId,
                              "comentario",
                              $event
                            )
                          },
                          blur: function($event) {
                            return _vm.limparErroCampo(
                              "venda_perdida.comentario"
                            )
                          }
                        }
                      })
                    : _vm._e()
                ],
                1
              )
            : _vm._e(),
          _vm.statusId && _vm.statusId.id != "C" && _vm.statusId.id != "P"
            ? _c(
                "div",
                { staticClass: "fieldset" },
                [
                  _c("h3", { staticClass: "_100" }, [_vm._v("Itens")]),
                  _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("produtos.pacotes") },
                    attrs: {
                      sPlaceholder: "Selecione um Pacote",
                      sOptions: _vm.produtos.pacotes,
                      sLabel: "nome",
                      sTrack: "produto_id",
                      sValue: _vm.pacotes,
                      multiple: false,
                      empty: true,
                      selectMessage: _vm.getError("produtos.pacotes"),
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.pacotes = $event
                      },
                      "update:s-value": function($event) {
                        _vm.pacotes = $event
                      }
                    }
                  }),
                  _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("produtos.cloudbackup") },
                    attrs: {
                      sPlaceholder: "Selecione um Cloudbackup",
                      sOptions: _vm.produtos.cloudbackup,
                      sLabel: "nome",
                      sTrack: "produto_id",
                      sValue: _vm.cloudbackup,
                      multiple: false,
                      empty: true,
                      selectMessage: _vm.getError("produtos.cloudbackup"),
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.cloudbackup = $event
                      },
                      "update:s-value": function($event) {
                        _vm.cloudbackup = $event
                      }
                    }
                  }),
                  _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("produtos.smartbox") },
                    attrs: {
                      sPlaceholder: "Selecione um Smartbox",
                      sOptions: _vm.produtos.smartbox,
                      sLabel: "nome",
                      sTrack: "produto_id",
                      sValue: _vm.smartbox,
                      multiple: false,
                      empty: true,
                      selectMessage: _vm.getError("produtos.smartbox"),
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        _vm.smartbox = $event
                      },
                      "update:s-value": function($event) {
                        _vm.smartbox = $event
                      }
                    }
                  }),
                  _c("httSelect", {
                    staticClass: "_50",
                    class: { error: _vm.existError("produtos.0800") },
                    attrs: {
                      sPlaceholder: "Selecione um 0800",
                      sOptions: _vm.produtos["0800"],
                      sLabel: "nome",
                      sTrack: "produto_id",
                      sValue: _vm.$data["0800"],
                      multiple: false,
                      empty: true,
                      selectMessage: _vm.getError("produtos.0800"),
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        return _vm.$set(_vm.$data, "0800", $event)
                      },
                      "update:s-value": function($event) {
                        return _vm.$set(_vm.$data, "0800", $event)
                      }
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _vm.$root.hasPermission("prospeccoes", 3) ||
              _vm.$root.hasPermission("prospeccoes", 2)
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Salvar Prospecção",
                      buttonDisabled: _vm.btnDisabled || !_vm.canSave,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/save_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/save_branco.svg")
                    },
                    on: { click: _vm.sendForm }
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
var staticRenderFns = []
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

/***/ "./resources/assets/images/web/icones/iconesBranco/save_branco.svg":
/*!*************************************************************************!*\
  !*** ./resources/assets/images/web/icones/iconesBranco/save_branco.svg ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/save_branco.svg?b803266e9ce93a6f2371ec8854ab95ee";

/***/ }),

/***/ "./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true&":
/*!********************************************************************************************************************!*\
  !*** ./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true& ***!
  \********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/vue/views/prospeccao/Prospeccao.vue":
/*!*******************************************************!*\
  !*** ./resources/vue/views/prospeccao/Prospeccao.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Prospeccao_vue_vue_type_template_id_53cb24fd_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug& */ "./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug&");
/* harmony import */ var _Prospeccao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Prospeccao.vue?vue&type=script&lang=js& */ "./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Prospeccao_styl_vue_type_style_index_0_id_53cb24fd_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true& */ "./resources/vue/views/prospeccao/Prospeccao.styl?vue&type=style&index=0&id=53cb24fd&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Prospeccao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Prospeccao_vue_vue_type_template_id_53cb24fd_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Prospeccao_vue_vue_type_template_id_53cb24fd_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "53cb24fd",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/vue/views/prospeccao/Prospeccao.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Prospeccao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Prospeccao.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Prospeccao_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug&":
/*!***********************************************************************************************************!*\
  !*** ./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Prospeccao_vue_vue_type_template_id_53cb24fd_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/pug-plain-loader!../../../../node_modules/vue-loader/lib??vue-loader-options!./Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/prospeccao/Prospeccao.vue?vue&type=template&id=53cb24fd&scoped=true&lang=pug&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Prospeccao_vue_vue_type_template_id_53cb24fd_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Prospeccao_vue_vue_type_template_id_53cb24fd_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=prospeccao.js.map