(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/web/venda"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/venda/Venda.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/views/venda/Venda.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
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
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _vue_mixins_Localizacao__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @/vue/mixins/Localizacao */ "./resources/vue/mixins/Localizacao.js");
/* harmony import */ var _vue_mixins_Validacao__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @/vue/mixins/Validacao */ "./resources/vue/mixins/Validacao.js");
/* harmony import */ var _vue_mixins_ProdutosVenda__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @/vue/mixins/ProdutosVenda */ "./resources/vue/mixins/ProdutosVenda.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  mixins: [_vue_mixins_Localizacao__WEBPACK_IMPORTED_MODULE_8__["default"], _vue_mixins_Validacao__WEBPACK_IMPORTED_MODULE_9__["default"], _vue_mixins_ProdutosVenda__WEBPACK_IMPORTED_MODULE_10__["default"]],
  components: {
    httButton: _vue_components_httButton_HttButton_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    httInput: _vue_components_httInput_HttInput_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    httSelect: _vue_components_httSelect_HttSelect_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
    httCheckAtivo: _vue_components_httCheckAtivo_HttCheckAtivo_vue__WEBPACK_IMPORTED_MODULE_4__["default"],
    httTableColumn: _vue_components_httTableColumn_HttTableColumn_vue__WEBPACK_IMPORTED_MODULE_5__["default"],
    httMensagem: _vue_components_httMensagem_HttMensagem_vue__WEBPACK_IMPORTED_MODULE_6__["default"]
  },
  computed: {
    contatoComercial: function contatoComercial() {
      if (this.venda.contato_comercial.nome) {
        return this.venda.contato_comercial;
      } else {
        return {
          nome: '',
          email: "",
          telefone: "",
          celular: ""
        };
      }
    },
    isSuperUser: function isSuperUser() {
      return !!(this.$root.authenticated && this.$root.authenticated.usuario && this.$root.authenticated["super"] === true);
    }
  },
  data: function data() {
    return {
      money: {
        decimal: '.',
        thousands: '',
        prefix: '',
        suffix: '',
        precision: 2,
        masked: false
      },
      venda: {
        contato_comercial: {},
        produtos: {},
        predio_id: "",
        cliente: {},
        endereco_correspondencia: {},
        endereco_predio: {},
        vencimento: "",
        email_fatura: ""
      },
      clienteVerificacao: {
        mensagem: "Pendente de verificação",
        disabled: false
      },
      identificacoes: ['ramal', 'piloto'],
      tecnologia: ['Analógica', 'Digital', 'SIP'],
      tecnologia_sinalizacao: ['R2', 'ISDN'],
      portado: ["sim", "não"],
      vencimentos: [],
      btnDisabled: false,
      showCanEditVenda: false,
      showCanGenerateContract: false,
      canSave: true,
      contratadas: [],
      ciclos: [],
      endCorrespondenciaCidades: [],
      sucesso: false,
      messagemErro: '',
      dataContratoCustom: ''
    };
  },
  created: function created() {
    var _this = this;

    axios__WEBPACK_IMPORTED_MODULE_0___default.a.all([this.loadProdutos(), this.loadContratada(), this.loadVencimento(), this.loadCiclos()]).then(function () {
      if (_this.$route.params.id) {
        _this.loadContent().then(function () {
          _this.configureStatusCliente(_this.venda.cliente.status);
        });
      }
    });
  },
  watch: {
    'venda.endereco_correspondencia.uf': function vendaEndereco_correspondenciaUf() {
      var _this2 = this;

      this.loadCidades(this.venda.endereco_correspondencia.uf, true).then(function (data) {
        _this2.endCorrespondenciaCidades = data;
      });
    },
    'venda.endereco_predio.uf': function vendaEndereco_predioUf() {
      this.loadCidades(this.venda.endereco_predio.uf);
    },
    'venda.contratada': function vendaContratada() {
      var _this3 = this;

      if (this.venda.contratada_filial && this.venda.contratada && this.venda.contratada.filiais && !this.venda.contratada.filiais.find(function (filial) {
        return filial.cnpj == _this3.venda.contratada_filial.cnpj;
      })) this.venda.contratada_filial = null;
    }
  },
  methods: {
    downloadArquivo: function downloadArquivo(nome) {
      var _this4 = this;

      this.$axios.get("vendas/".concat(this.venda.codigo, "/documentos/").concat(nome), {
        responseType: 'arraybuffer'
      }).then(function (response) {
        var contentDisposition = response.headers['content-disposition'];
        var name = contentDisposition.split('filename=', contentDisposition.length)[1];
        var blob = new Blob([response.data], {
          type: ''
        });
        _this4.ready = true;
        var a = document.createElement('a');
        a.setAttribute("type", "hidden");
        a.href = URL.createObjectURL(blob);
        a.download = name;
        document.body.appendChild(a);
        a.click();
        a.remove();
      });
    },
    createContratoCustom: function createContratoCustom() {
      this.$root.downloading = {
        modulo: 'contrato',
        parameters: {
          tipo: 'generate',
          codigo: this.venda.codigo,
          data: this.dataContratoCustom
        },
        'documentos': this.venda.documentos
      };
    },
    createContrato: function createContrato() {
      this.$root.downloading = {
        modulo: 'contrato',
        parameters: {
          tipo: 'generate',
          codigo: this.venda.codigo
        },
        'documentos': this.venda.documentos
      };
    },
    createChecklist: function createChecklist() {
      this.$root.downloading = {
        modulo: 'contrato',
        parameters: {
          tipo: 'checklist',
          codigo: this.venda.codigo
        },
        'documentos': this.venda.documentos
      };
    },
    importFile: function importFile(event) {
      var _this5 = this;

      var form = new FormData();
      form.append('file', event.target.files[0]);
      this.btnDisabled = true;
      this.$axios.post("vendas/".concat(this.venda.codigo, "/upload"), form, {
        'Content-Type': 'multipart/form-data'
      }).then(function (response) {
        _this5.sucesso = true;

        _this5.venda.documentos.push(response.data.documento);
      })["catch"](function (error) {
        if (error.response.status == 500) {
          _this5.messagemErro = 'Erro ao enviar planilha';
        } else {
          _this5.messagemErro = error.response.data.error_validate.file[0];
        }

        _this5.sucesso = false;
      })["finally"](function () {
        setTimeout(function () {
          _this5.$refs.inputImport.value = null;
          _this5.btnDisabled = false;
          _this5.sucesso = false;
        }, 4500);
      });
    },
    clear: function clear(campos) {
      var _this6 = this;

      campos.forEach(function (campo) {
        if (lodash__WEBPACK_IMPORTED_MODULE_7___default.a.get(_this6.$data, campo)) {
          lodash__WEBPACK_IMPORTED_MODULE_7___default.a.unset(_this6.$data, campo);
        }
      });
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
      var _this7 = this;

      this.clienteVerificacao.disabled = true;
      this.$axios.get("clientes/".concat(this.venda.cliente.documento, "/verify")).then(function (response) {
        if (response.data.approved) _this7.configureStatusCliente('A');else _this7.configureStatusCliente('R');
      })["catch"](function (error) {
        _this7.clienteVerificacao.disabled = false;
        if (error.response.data.success != undefined) _this7.clienteVerificacao.mensagem = "Ocorreu um erro ao validar";else _this7.clienteVerificacao.mensagem = error.response.data.msg;
      });
    },
    loadVencimento: function loadVencimento() {
      var _this8 = this;

      return this.$axios.get('vendas/vencimentos').then(function (response) {
        _this8.vencimentos = response.data;
      });
    },
    loadCiclos: function loadCiclos() {
      var _this9 = this;

      return this.$axios.get('vendas/ciclos').then(function (response) {
        _this9.ciclos = response.data;
      });
    },
    loadContratada: function loadContratada() {
      var _this10 = this;

      return this.$axios.get('vendas/contratadas').then(function (response) {
        _this10.contratadas = response.data;
      });
    },
    loadContent: function loadContent() {
      var _this11 = this;

      return this.$axios.get("vendas/".concat(this.$route.params.id)).then(function (response) {
        _this11.venda = response.data;

        _this11.syncProdutosLoad();

        if (_this11.venda.contratada && _this11.venda.contratada.id) _this11.venda.contratada = _this11.contratadas.find(function (contratada) {
          return contratada.id = _this11.venda.contratada.id;
        });

        if (_this11.venda.status != "E" && _this11.venda.status != "A") {
          _this11.$refs.mensagem.showAviso('Esta venda não pode ser alterada!');

          _this11.canSave = false;
          if (_this11.$root.authenticated && _this11.$root.authenticated.usuario && _this11.$root.authenticated["super"] === true) _this11.showCanEditVenda = true;
        }
      });
    },
    idNumerico: function idNumerico(predioId) {
      var reg = new RegExp(/\d+/, "gi");
      return reg.exec(predioId)[0];
    },
    sendForm: function sendForm() {
      var _this12 = this;

      var aprovacao = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      this.venda.contato_comercial = this.contatoComercial;
      this.btnDisabled = true;
      this.canSave = false;
      this.syncProdutosSend();
      this.$axios.post("vendas/".concat(this.venda.codigo).concat(aprovacao ? '/aprovar' : ''), this.venda).then(function (response) {
        _this12.$refs.mensagem.toTop();

        _this12.$refs.mensagem.showSucesso(response.data.msg);
      })["catch"](function (error) {
        _this12.$refs.mensagem.toTop();

        if (error.response.status == 422) {
          _this12.$refs.mensagem.showErro(error.response.data.msg);

          _this12.errors = error.response.data.error_validate ? error.response.data.error_validate : {};
        }
      })["finally"](function () {
        _this12.btnDisabled = false;
        _this12.venda.produtos = {};
        setTimeout(function () {
          _this12.canSave = true;

          _this12.$refs.mensagem.hide();
        }, 3500);
      });
    },
    habilitarEdicao: function habilitarEdicao() {
      var _this13 = this;

      this.$refs.mensagem.hide();
      this.canSave = !this.canSave;
      setTimeout(function () {
        if (_this13.canSave) _this13.$refs.mensagem.showAviso('Esta venda pode, mas não deve ser alterada!');else _this13.$refs.mensagem.showAviso('Esta venda não pode ser alterada!');
      }, 1000);
    },
    habiltarCTRData: function habiltarCTRData() {
      this.showCanGenerateContract = !this.showCanGenerateContract;
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "h4[data-v-1796fb52] {\n  font-size: 0.875rem;\n  margin: 0 0 10px;\n  padding: 20px 15px;\n  width: 100%;\n}\n.message.error[data-v-1796fb52] {\n  color: #c00;\n}\ntextarea[data-v-1796fb52] {\n  resize: none;\n  margin: 0 15px 15px;\n  padding: 0.75rem 15px;\n  width: 100%;\n  border: 1px solid #ebebeb;\n  font-size: 1rem;\n  transition: all 0.2s ease-in-out;\n  height: 150px;\n  outline: 0;\n}\ntextarea[data-v-1796fb52]:focus {\n  border: 1px solid #e75629;\n}\n.verifyCliente[data-v-1796fb52] {\n  align-items: flex-end;\n  flex-direction: column;\n  justify-content: center;\n}\n.verifyCliente p[data-v-1796fb52] {\n  padding: 0 15px;\n}\n.verifyCliente .message[data-v-1796fb52] {\n  visibility: hidden;\n  opacity: 0;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n  transition: all 0.2s ease-in-out;\n  position: absolute;\n  top: -20px;\n  font-size: 0.75rem;\n  right: 15px;\n  white-space: nowrap;\n}\n.verifyCliente.error .message[data-v-1796fb52],\n.verifyCliente.success .message[data-v-1796fb52] {\n  visibility: visible;\n  opacity: 1;\n  -webkit-user-select: all;\n     -moz-user-select: all;\n      -ms-user-select: all;\n          user-select: all;\n}\n.verifyCliente.error .message[data-v-1796fb52] {\n  color: #c00;\n}\n.verifyCliente.success .message[data-v-1796fb52] {\n  color: #090;\n}\n.faixas[data-v-1796fb52] {\n  display: flex;\n  justify-content: space-between;\n  flex-flow: row wrap;\n}\n.faixas .faixa[data-v-1796fb52] {\n  display: flex;\n  flex-flow: row wrap;\n  width: 100%;\n  justify-content: flex-end;\n}\n.fieldset > .fieldset[data-v-1796fb52]:not(.produtos) {\n  padding: 0 20px;\n}\n.observacoes[data-v-1796fb52] {\n  padding: 0 35px;\n  list-style-type: disc;\n  margin-bottom: 35px;\n}\n.observacoes li[data-v-1796fb52] {\n  padding: 5px 0;\n}\n.import[data-v-1796fb52] {\n  background: #fff;\n  height: 30vh;\n  width: 70vw;\n  border-radius: 10px;\n  padding: 40px 40px;\n  position: relative;\n}\n.import label[data-v-1796fb52] {\n  width: 100%;\n  height: 70%;\n  border: 1px solid #e75629;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  position: relative;\n  cursor: pointer;\n}\n.import label input[data-v-1796fb52] {\n  display: none;\n}\n.import span[data-v-1796fb52] {\n  margin-top: 10px;\n  font-size: 1rem;\n  display: block;\n  vertical-align: middle;\n}\n.import span img[data-v-1796fb52] {\n  width: 50px;\n  margin: 0 20px;\n  display: inline;\n  vertical-align: middle;\n}\n.import p[data-v-1796fb52] {\n  text-align: right;\n  color: #c00;\n  font-size: 0.875rem;\n  margin-top: 10px;\n}\n.arquivos[data-v-1796fb52] {\n  justify-content: flex-start;\n  width: 100%;\n  flex-flow: row wrap;\n}\n.arquivos .arquivo[data-v-1796fb52] {\n  max-width: 30%;\n  padding: 15px;\n  box-shadow: 0 0 10px 10px rgba(0,0,0,0);\n  transition: all 0.2s ease-in-out;\n  margin: 15px;\n  cursor: pointer;\n  position: relative;\n}\n.arquivos .arquivo img[data-v-1796fb52] {\n  width: 40px;\n  margin: 0 auto;\n  margin-bottom: 15px;\n}\n.arquivos .arquivo img.download[data-v-1796fb52] {\n  top: 10px;\n  right: 10px;\n  position: absolute;\n  width: 20px;\n}\n.arquivos .arquivo p[data-v-1796fb52] {\n  font-size: 0.875rem;\n}\n.arquivos .arquivo[data-v-1796fb52]:hover {\n  box-shadow: 0 0 10px 10px rgba(0,0,0,0.04);\n}\n.buttonDownloadHidden[data-v-1796fb52] {\n  position: absolute;\n  visibility: hidden;\n  opacity: 0;\n  z-index: -99;\n  top: -999px;\n  left: -999px;\n}\n@media (max-width: 768px) {\n.faixas[data-v-1796fb52] {\n    max-width: 100%;\n}\n.faixas .faixa[data-v-1796fb52] {\n    max-width: 100%;\n}\n.totalWidth[data-v-1796fb52] {\n    max-width: 100%;\n}\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--10-2!./node_modules/stylus-loader!./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/venda/Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug&":
/*!***************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/pug-plain-loader!./node_modules/vue-loader/lib??vue-loader-options!./resources/vue/views/venda/Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug& ***!
  \***************************************************************************************************************************************************************************************************************************************************************/
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
    { attrs: { id: "pageVendaForm" } },
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
              _vm.showCanEditVenda
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Toggle Edição",
                      buttonDisabled: _vm.btnDisabled,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/edit_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/edit_branco.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.habilitarEdicao()
                      }
                    }
                  })
                : _vm._e()
            ],
            1
          ),
          _c("div", { staticClass: "fieldset" }, [
            _c("h3", { staticClass: "_100 totalWidth" }, [
              _vm._v("Observações do Auditor")
            ]),
            _c(
              "ul",
              { staticClass: "observacoes _100" },
              _vm._l(_vm.venda.observacoes_auditoria, function(observacao) {
                return observacao
                  ? _c("li", [_vm._v(_vm._s(observacao))])
                  : _vm._e()
              }),
              0
            )
          ]),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("httInput", {
                staticClass: "_30",
                class: { error: _vm.existError("codigo") },
                attrs: {
                  inputName: "venda.codigo",
                  inputLabel: "Código",
                  inputDisabled: true,
                  inputType: "text",
                  inputValue: _vm.venda.codigo,
                  inputMessage: _vm.getError("codigo")
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda, "codigo", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda, "codigo", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_45",
                class: { error: _vm.existError("cliente.nome") },
                attrs: {
                  inputName: "venda.cliente.nome",
                  inputLabel: "Nome",
                  inputDisabled: true,
                  inputType: "text",
                  inputValue: _vm.venda.cliente.nome,
                  inputMessage: _vm.getError("cliente.nome")
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda.cliente, "nome", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda.cliente, "nome", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_25 totalWidth",
                class: { error: _vm.existError("cliente.documento") },
                attrs: {
                  inputName: "venda.cliente.documento",
                  inputLabel: "Documento",
                  inputDisabled: true,
                  inputType: "text",
                  inputValue: _vm.venda.cliente.documento,
                  inputMessage: _vm.getError("cliente.documento")
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda.cliente, "documento", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda.cliente, "documento", $event)
                  }
                }
              }),
              !(_vm.venda.status == "V" || _vm.venda.status == "P")
                ? _c(
                    "div",
                    {
                      staticClass: "fieldset verifyCliente _100 totalWidth",
                      class: {
                        error:
                          _vm.existError("cliente.data_verificacao") ||
                          _vm.existError("cliente.status")
                      }
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
                          _c("strong", [_vm._v("Status do cliente: ")]),
                          _vm._v(_vm._s(_vm.clienteVerificacao.mensagem))
                        ])
                      ])
                    ],
                    1
                  )
                : _vm._e(),
              _c("httSelect", {
                staticClass: "_50 totalWidth",
                class: { error: _vm.existError("contratada.id") },
                attrs: {
                  sPlaceholder: "Selecione Contratada",
                  sOptions: _vm.contratadas,
                  sLabel: "nome",
                  sTrack: "id",
                  sValue: _vm.venda.contratada,
                  multiple: false,
                  selectMessage: _vm.getError("contratada.id"),
                  disabled: !_vm.canSave
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(_vm.venda, "contratada", $event)
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(_vm.venda, "contratada", $event)
                  }
                }
              }),
              _vm.venda.contratada
                ? _c("httSelect", {
                    staticClass: "_50 totalWidth",
                    class: { error: _vm.existError("contratada_filial.id") },
                    attrs: {
                      sPlaceholder: "Selecione Filial",
                      sOptions: _vm.venda.contratada.filiais,
                      sLabel: "nome",
                      sTrack: "id",
                      sValue: _vm.venda.contratada_filial,
                      multiple: false,
                      selectMessage: _vm.getError("contratada_filial.id"),
                      disabled: !_vm.canSave
                    },
                    on: {
                      "update:sValue": function($event) {
                        return _vm.$set(_vm.venda, "contratada_filial", $event)
                      },
                      "update:s-value": function($event) {
                        return _vm.$set(_vm.venda, "contratada_filial", $event)
                      }
                    }
                  })
                : _vm._e(),
              _c("textarea", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.venda.observacoes,
                    expression: "venda.observacoes"
                  }
                ],
                attrs: { placeholder: "Observações" },
                domProps: { value: _vm.venda.observacoes },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.venda, "observacoes", $event.target.value)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_20",
                class: { error: _vm.existError("campanha") },
                attrs: {
                  inputName: "venda.campanha",
                  inputLabel: "Campanha",
                  inputType: "text",
                  inputValue: _vm.venda.campanha,
                  inputMessage: _vm.getError("campanha"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("campanha")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda, "campanha", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda, "campanha", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_80",
                class: { error: _vm.existError("campanha_nome") },
                attrs: {
                  inputName: "venda.campanha_nome",
                  inputLabel: "Nome da Campanha",
                  inputType: "text",
                  inputValue: _vm.venda.campanha_nome,
                  inputMessage: _vm.getError("campanha_nome"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("campanha_nome")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda, "campanha_nome", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda, "campanha_nome", $event)
                  }
                }
              })
            ],
            1
          ),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("h3", { staticClass: "_100 totalWidth" }, [
                _vm._v("Contato Comercial")
              ]),
              _c("httSelect", {
                staticClass: "_100",
                attrs: {
                  sPlaceholder: "Selecionar Contato",
                  sOptions: _vm.venda.cliente.contato,
                  sLabel: "nome",
                  sValue: _vm.venda.contato_comercial,
                  multiple: false,
                  disabled: !_vm.canSave
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(_vm.venda, "contato_comercial", $event)
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(_vm.venda, "contato_comercial", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_50",
                class: { error: _vm.existError("contato_comercial.nome") },
                attrs: {
                  inputName: "venda.contato_comercial.nome",
                  inputLabel: "Nome",
                  inputType: "text",
                  inputValue: _vm.contatoComercial.nome,
                  inputMessage: _vm.getError("contato_comercial.nome"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("contato_comercial.nome")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.contatoComercial, "nome", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.contatoComercial, "nome", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_50",
                class: { error: _vm.existError("contato_comercial.email") },
                attrs: {
                  inputName: "venda.contato_comercial.email",
                  inputLabel: "Email",
                  inputType: "text",
                  inputValue: _vm.contatoComercial.email,
                  inputMessage: _vm.getError("contato_comercial.email"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("contato_comercial.email")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.contatoComercial, "email", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.contatoComercial, "email", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_50",
                class: { error: _vm.existError("contato_comercial.telefone") },
                attrs: {
                  inputName: "venda.contato_comercial.telefone",
                  inputLabel: "Telefone",
                  inputType: "text",
                  inputValue: _vm.contatoComercial.telefone,
                  inputMessage: _vm.getError("contato_comercial.telefone"),
                  inputMask: _vm.btnDisabled ? "##########" : "(##) ####-####",
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("contato_comercial.telefone")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.contatoComercial, "telefone", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.contatoComercial, "telefone", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_50",
                class: { error: _vm.existError("contato_comercial.celular") },
                attrs: {
                  inputName: "venda.contato_comercial.celular",
                  inputLabel: "Celular",
                  inputType: "text",
                  inputValue: _vm.contatoComercial.celular,
                  inputMessage: _vm.getError("contato_comercial.celular"),
                  inputMask: _vm.btnDisabled
                    ? "###########"
                    : "(##) #####-####",
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("contato_comercial.celular")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.contatoComercial, "celular", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.contatoComercial, "celular", $event)
                  }
                }
              })
            ],
            1
          ),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("h3", { staticClass: "_100 totalWidth" }, [
                _vm._v(
                  "Endereço " +
                    _vm._s(
                      _vm.venda.is_empreendimento ? "Empreendimento" : "Prédio"
                    )
                )
              ]),
              _c("httInput", {
                staticClass: "_20",
                attrs: {
                  inputDisabled: true,
                  inputName: "venda.endereco_predio.cep",
                  inputLabel: "CEP",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_predio.cep,
                  inputMask: _vm.btnDisabled ? "##########" : "#####-###"
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "cep", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "cep", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_40",
                attrs: {
                  inputDisabled: true,
                  inputName: "venda.endereco_predio.logradouro",
                  inputLabel: "Logradouro",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_predio.logradouro
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_predio,
                      "logradouro",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_predio,
                      "logradouro",
                      $event
                    )
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_20",
                attrs: {
                  inputDisabled: true,
                  inputName: "venda.endereco_predio.numero",
                  inputLabel: "Número",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_predio.numero,
                  inputMask: "#######"
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "numero", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "numero", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_20",
                attrs: {
                  inputDisabled: true,
                  inputName: "venda.endereco_predio.complemento",
                  inputLabel: "Complemento",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_predio.complemento
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_predio,
                      "complemento",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_predio,
                      "complemento",
                      $event
                    )
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_30",
                attrs: {
                  inputDisabled: true,
                  inputName: "venda.endereco_predio.bairro",
                  inputLabel: "Bairro",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_predio.bairro
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "bairro", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "bairro", $event)
                  }
                }
              }),
              _c("httSelect", {
                staticClass: "_10",
                attrs: {
                  disabled: true,
                  sOptions: _vm.ufs,
                  sLabel: "uf",
                  sTrack: "uf",
                  sValue: _vm.venda.endereco_predio.uf
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "uf", $event)
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "uf", $event)
                  }
                }
              }),
              _c("httSelect", {
                staticClass: "_30",
                attrs: {
                  disabled: true,
                  sOptions: _vm.cidades,
                  sLabel: "nome",
                  sTrack: "nome",
                  sValue: _vm.venda.endereco_predio.cidade
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "cidade", $event)
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(_vm.venda.endereco_predio, "cidade", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_30",
                class: { error: _vm.existError("predio_cliente_complemento") },
                attrs: {
                  inputName: "venda.predio_cliente_complemento",
                  inputLabel: "Complemento do cliente",
                  inputType: "text",
                  inputValue: _vm.venda.predio_cliente_complemento,
                  inputMessage: _vm.getError("predio_cliente_complemento"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda,
                      "predio_cliente_complemento",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda,
                      "predio_cliente_complemento",
                      $event
                    )
                  }
                }
              })
            ],
            1
          ),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("h3", { staticClass: "_100 totalWidth" }, [
                _vm._v("Endereço de Correspondencia")
              ]),
              _c("httInput", {
                staticClass: "_20",
                class: {
                  error: _vm.existError("endereco_correspondencia.cep")
                },
                attrs: {
                  inputName: "venda.endereco_correspondencia.cep",
                  inputLabel: "CEP",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_correspondencia.cep,
                  inputMessage: _vm.getError("endereco_correspondencia.cep"),
                  inputMask: _vm.btnDisabled ? "##########" : "#####-###",
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("endereco_correspondencia.cep")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "cep",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "cep",
                      $event
                    )
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_40",
                class: {
                  error: _vm.existError("endereco_correspondencia.logradouro")
                },
                attrs: {
                  inputName: "venda.endereco_correspondencia.logradouro",
                  inputLabel: "Logradouro",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_correspondencia.logradouro,
                  inputMessage: _vm.getError(
                    "endereco_correspondencia.logradouro"
                  ),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo(
                      "endereco_correspondencia.logradouro"
                    )
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "logradouro",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "logradouro",
                      $event
                    )
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_20",
                class: {
                  error: _vm.existError("endereco_correspondencia.numero")
                },
                attrs: {
                  inputName: "venda.endereco_correspondencia.numero",
                  inputLabel: "Número",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_correspondencia.numero,
                  inputMessage: _vm.getError("endereco_correspondencia.numero"),
                  inputMask: "#######",
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo(
                      "endereco_correspondencia.numero"
                    )
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "numero",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "numero",
                      $event
                    )
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_20",
                class: {
                  error: _vm.existError("endereco_correspondencia.complemento")
                },
                attrs: {
                  inputName: "venda.endereco_correspondencia.complemento",
                  inputLabel: "Complemento",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_correspondencia.complemento,
                  inputMessage: _vm.getError(
                    "endereco_correspondencia.complemento"
                  ),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo(
                      "endereco_correspondencia.complemento"
                    )
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "complemento",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "complemento",
                      $event
                    )
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_30",
                class: {
                  error: _vm.existError("endereco_correspondencia.bairro")
                },
                attrs: {
                  inputName: "venda.endereco_correspondencia.bairro",
                  inputLabel: "Bairro",
                  inputType: "text",
                  inputValue: _vm.venda.endereco_correspondencia.bairro,
                  inputMessage: _vm.getError("endereco_correspondencia.bairro"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo(
                      "endereco_correspondencia.bairro"
                    )
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "bairro",
                      $event
                    )
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "bairro",
                      $event
                    )
                  }
                }
              }),
              _c("httSelect", {
                staticClass: "_10",
                class: { error: _vm.existError("endereco_correspondencia.uf") },
                attrs: {
                  sPlaceholder: "Selecione Estado",
                  sOptions: _vm.ufs,
                  sLabel: "uf",
                  sTrack: "uf",
                  sValue: _vm.venda.endereco_correspondencia.uf,
                  selectMessage: _vm.getError("endereco_correspondencia.uf"),
                  disabled: !_vm.canSave
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "uf",
                      $event
                    )
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "uf",
                      $event
                    )
                  }
                }
              }),
              _c("httSelect", {
                staticClass: "_30",
                class: {
                  error: _vm.existError("endereco_correspondencia.cidade")
                },
                attrs: {
                  sPlaceholder: "Selecione Cidade",
                  sOptions: _vm.endCorrespondenciaCidades,
                  sLabel: "nome",
                  sTrack: "nome",
                  sValue: _vm.venda.endereco_correspondencia.cidade,
                  selectMessage: _vm.getError(
                    "endereco_correspondencia.cidade"
                  ),
                  disabled: !_vm.canSave
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "cidade",
                      $event
                    )
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(
                      _vm.venda.endereco_correspondencia,
                      "cidade",
                      $event
                    )
                  }
                }
              })
            ],
            1
          ),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _c("h3", { staticClass: "_100 totalWidth" }, [_vm._v("Fatura")]),
              _c("httSelect", {
                staticClass: "_20",
                class: { error: _vm.existError("vencimento") },
                attrs: {
                  sOptions: _vm.vencimentos,
                  sValue: _vm.venda.vencimento,
                  multiple: false,
                  inputMessage: _vm.getError("vencimento"),
                  disabled: !_vm.canSave
                },
                on: {
                  "update:sValue": function($event) {
                    return _vm.$set(_vm.venda, "vencimento", $event)
                  },
                  "update:s-value": function($event) {
                    return _vm.$set(_vm.venda, "vencimento", $event)
                  }
                }
              }),
              _c("httInput", {
                staticClass: "_50",
                class: { error: _vm.existError("email_fatura") },
                attrs: {
                  inputName: "venda.email_fatura",
                  inputLabel: "E-mail Fatura",
                  inputType: "text",
                  inputValue: _vm.venda.email_fatura,
                  inputMessage: _vm.getError("email_fatura"),
                  inputDisabled: !_vm.canSave
                },
                on: {
                  blur: function($event) {
                    return _vm.limparErroCampo("email_fatura")
                  },
                  "update:inputValue": function($event) {
                    return _vm.$set(_vm.venda, "email_fatura", $event)
                  },
                  "update:input-value": function($event) {
                    return _vm.$set(_vm.venda, "email_fatura", $event)
                  }
                }
              })
            ],
            1
          ),
          _vm.produtoSelecionado.pacotes
            ? _c("div", { staticClass: "fieldset" }, [
                _c("h3", { staticClass: "_100 totalWidth" }, [
                  _vm._v("Produtos")
                ]),
                _c(
                  "div",
                  { staticClass: "fieldset" },
                  [
                    _c("h4", { staticClass: "_100 totalWidth" }, [
                      _vm._v("Pacote Internet")
                    ]),
                    _c("httSelect", {
                      staticClass: "_30",
                      attrs: {
                        sOptions: _vm.produtos.pacotes,
                        sLabel: "nome",
                        sTrack: "produto_id",
                        sValue: _vm.produtoSelecionado.pacotes,
                        multiple: false,
                        disabled: !_vm.canSave
                      },
                      on: {
                        "update:sValue": function($event) {
                          return _vm.$set(
                            _vm.produtoSelecionado,
                            "pacotes",
                            $event
                          )
                        },
                        "update:s-value": function($event) {
                          return _vm.$set(
                            _vm.produtoSelecionado,
                            "pacotes",
                            $event
                          )
                        }
                      }
                    }),
                    _vm.produtoSelecionado.pacotes
                      ? _c(
                          "div",
                          { staticClass: "fieldset produtos" },
                          [
                            _c("httInput", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.pacotes.config.internet.valor"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.pacotes.config.internet.valor",
                                inputLabel: "Valor",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.pacotes.config.internet
                                    .valor,
                                inputMessage: _vm.getError(
                                  "produtos.pacotes.config.internet.valor"
                                ),
                                inputMoney: _vm.money,
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.pacotes.config.internet.valor"
                                  )
                                },
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "valor",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "valor",
                                    $event
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.pacotes.config.internet.desconto"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.pacotes.config.internet.desconto",
                                inputLabel: "Desconto",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.pacotes.config.internet
                                    .desconto,
                                inputMessage: _vm.getError(
                                  "produtos.pacotes.config.internet.desconto"
                                ),
                                inputMask: "###",
                                inputDisabled: !_vm.canSave,
                                inputShow:
                                  _vm.produtoConteudo.pacotes.config.internet
                                    .is_percent
                              },
                              on: {
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.pacotes.config.internet.desconto"
                                  )
                                },
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "desconto",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "desconto",
                                    $event
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.pacotes.config.internet.desconto"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.pacotes.config.internet.desconto",
                                inputLabel: "Desconto",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.pacotes.config.internet
                                    .desconto,
                                inputMessage: _vm.getError(
                                  "produtos.pacotes.config.internet.desconto"
                                ),
                                inputMoney: _vm.money,
                                inputDisabled: !_vm.canSave,
                                inputShow: !_vm.produtoConteudo.pacotes.config
                                  .internet.is_percent
                              },
                              on: {
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.pacotes.config.internet.desconto"
                                  )
                                },
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "desconto",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "desconto",
                                    $event
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_15",
                              attrs: {
                                inputDisabled: true,
                                inputName: "valorTotalPacote",
                                inputLabel: "Valor Total",
                                inputType: "text",
                                inputValue: _vm.valorTotalPacote
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  _vm.valorTotalPacote = $event
                                },
                                "update:input-value": function($event) {
                                  _vm.valorTotalPacote = $event
                                }
                              }
                            }),
                            _c("httCheckAtivo", {
                              staticClass: "_10",
                              attrs: {
                                nomeCheckbox: "Porcentagem",
                                checkboxValue:
                                  _vm.produtoConteudo.pacotes.config.internet
                                    .is_percent,
                                disabledCheckbox: !_vm.canSave
                              },
                              on: {
                                "update:checkboxValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "is_percent",
                                    $event
                                  )
                                },
                                "update:checkbox-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "is_percent",
                                    $event
                                  )
                                }
                              }
                            }),
                            _c("httSelect", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.pacotes.config.internet.quantidade_ciclos"
                                )
                              },
                              attrs: {
                                sPlaceholder: "Ciclos",
                                empty: true,
                                sOptions: _vm.ciclos,
                                sValue:
                                  _vm.produtoConteudo.pacotes.config.internet
                                    .quantidade_ciclos,
                                multiple: false,
                                selectMessage: _vm.getError(
                                  "produtos.pacotes.config.internet.quantidade_ciclos"
                                ),
                                disabled: !_vm.canSave
                              },
                              on: {
                                "update:sValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "quantidade_ciclos",
                                    $event
                                  )
                                },
                                "update:s-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.pacotes.config.internet,
                                    "quantidade_ciclos",
                                    $event
                                  )
                                }
                              }
                            })
                          ],
                          1
                        )
                      : _vm._e()
                  ],
                  1
                ),
                _c("div", { staticClass: "fieldset" }, [
                  _c("h4", { staticClass: "_100 totalWidth" }, [
                    _vm._v("Pacote Voz")
                  ]),
                  _vm.produtoSelecionado.pacotes
                    ? _c(
                        "div",
                        { staticClass: "fieldset produtos" },
                        [
                          _c("httInput", {
                            staticClass: "_25",
                            class: {
                              error: _vm.existError(
                                "produtos.pacotes.config.voz.valor"
                              )
                            },
                            attrs: {
                              inputName:
                                "produtoConteudo.pacotes.config.voz.valor",
                              inputMoney: _vm.money,
                              inputLabel: "Valor",
                              inputType: "text",
                              inputValue:
                                _vm.produtoConteudo.pacotes.config.voz.valor,
                              inputMessage: _vm.getError(
                                "produtos.pacotes.config.voz.valor"
                              ),
                              inputDisabled: !_vm.canSave
                            },
                            on: {
                              "update:inputValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "valor",
                                  $event
                                )
                              },
                              "update:input-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "valor",
                                  $event
                                )
                              },
                              blur: function($event) {
                                return _vm.limparErroCampo(
                                  "produtos.pacotes.config.voz.valor"
                                )
                              }
                            }
                          }),
                          _c("httInput", {
                            staticClass: "_25",
                            class: {
                              error: _vm.existError(
                                "produtos.pacotes.config.voz.desconto"
                              )
                            },
                            attrs: {
                              inputName:
                                "produtoConteudo.pacotes.config.voz.desconto",
                              inputMoney: _vm.money,
                              inputShow: !_vm.produtoConteudo.pacotes.config.voz
                                .is_percent,
                              inputLabel: "Desconto",
                              inputType: "text",
                              inputValue:
                                _vm.produtoConteudo.pacotes.config.voz.desconto,
                              inputMessage: _vm.getError(
                                "produtos.pacotes.config.voz.desconto"
                              ),
                              inputDisabled: !_vm.canSave
                            },
                            on: {
                              "update:inputValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "desconto",
                                  $event
                                )
                              },
                              "update:input-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "desconto",
                                  $event
                                )
                              },
                              blur: function($event) {
                                return _vm.limparErroCampo(
                                  "produtos.pacotes.config.voz.desconto"
                                )
                              }
                            }
                          }),
                          _c("httInput", {
                            staticClass: "_25",
                            class: {
                              error: _vm.existError(
                                "produtos.pacotes.config.voz.desconto"
                              )
                            },
                            attrs: {
                              inputName:
                                "produtoConteudo.pacotes.config.voz.desconto",
                              inputMask: "###",
                              inputShow:
                                _vm.produtoConteudo.pacotes.config.voz
                                  .is_percent,
                              inputLabel: "Desconto",
                              inputType: "text",
                              inputValue:
                                _vm.produtoConteudo.pacotes.config.voz.desconto,
                              inputMessage: _vm.getError(
                                "produtos.pacotes.config.voz.desconto"
                              ),
                              inputDisabled: !_vm.canSave
                            },
                            on: {
                              "update:inputValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "desconto",
                                  $event
                                )
                              },
                              "update:input-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "desconto",
                                  $event
                                )
                              },
                              blur: function($event) {
                                return _vm.limparErroCampo(
                                  "produtos.pacotes.config.voz.desconto"
                                )
                              }
                            }
                          }),
                          _c("httInput", {
                            staticClass: "_15",
                            attrs: {
                              inputDisabled: true,
                              inputName: "valorTotalVoz",
                              inputLabel: "Valor Total",
                              inputType: "text",
                              inputValue: _vm.valorTotalVoz
                            },
                            on: {
                              "update:inputValue": function($event) {
                                _vm.valorTotalVoz = $event
                              },
                              "update:input-value": function($event) {
                                _vm.valorTotalVoz = $event
                              }
                            }
                          }),
                          _c("httCheckAtivo", {
                            staticClass: "_10",
                            attrs: {
                              nomeCheckbox: "Porcentagem",
                              checkboxValue:
                                _vm.produtoConteudo.pacotes.config.voz
                                  .is_percent,
                              disabledCheckbox: !_vm.canSave
                            },
                            on: {
                              "update:checkboxValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "is_percent",
                                  $event
                                )
                              },
                              "update:checkbox-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "is_percent",
                                  $event
                                )
                              }
                            }
                          }),
                          _c("httSelect", {
                            staticClass: "_25",
                            class: {
                              error: _vm.existError(
                                "produtos.pacotes.config.voz.quantidade_ciclos"
                              )
                            },
                            attrs: {
                              sPlaceholder: "Ciclos",
                              empty: true,
                              sOptions: _vm.ciclos,
                              sValue:
                                _vm.produtoConteudo.pacotes.config.voz
                                  .quantidade_ciclos,
                              multiple: false,
                              selectMessage: _vm.getError(
                                "produtos.pacotes.config.voz.quantidade_ciclos"
                              ),
                              disabled: !_vm.canSave
                            },
                            on: {
                              "update:sValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "quantidade_ciclos",
                                  $event
                                )
                              },
                              "update:s-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "quantidade_ciclos",
                                  $event
                                )
                              }
                            }
                          }),
                          _c("httSelect", {
                            staticClass: "_50",
                            class: {
                              error: _vm.existError(
                                "produtos.pacotes.config.voz.tecnologia"
                              )
                            },
                            attrs: {
                              empty: true,
                              sPlaceholder: "Tecnologia",
                              sOptions: _vm.tecnologia,
                              sValue:
                                _vm.produtoConteudo.pacotes.config.voz
                                  .tecnologia,
                              multiple: false,
                              selectMessage: _vm.getError(
                                "produtos.pacotes.config.voz.tecnologia"
                              ),
                              disabled: !_vm.canSave
                            },
                            on: {
                              change: function($event) {
                                return _vm.clear([
                                  "produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao",
                                  "produtoConteudo.pacotes.config.voz.faixa_numeracao.piloto"
                                ])
                              },
                              "update:sValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "tecnologia",
                                  $event
                                )
                              },
                              "update:s-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "tecnologia",
                                  $event
                                )
                              }
                            }
                          }),
                          _vm.produtoConteudo.pacotes.config.voz.tecnologia ==
                          "Digital"
                            ? _c("httSelect", {
                                staticClass: "_50",
                                class: {
                                  error: _vm.existError(
                                    "produtos.pacotes.config.voz.tecnologia_sinalizacao"
                                  )
                                },
                                attrs: {
                                  empty: true,
                                  sPlaceholder: "Tecnologia de Sinalização",
                                  sOptions: _vm.tecnologia_sinalizacao,
                                  sValue:
                                    _vm.produtoConteudo.pacotes.config.voz
                                      .tecnologia_sinalizacao,
                                  multiple: false,
                                  selectMessage: _vm.getError(
                                    "produtos.pacotes.config.voz.tecnologia_sinalizacao"
                                  ),
                                  disabled: !_vm.canSave
                                },
                                on: {
                                  "update:sValue": function($event) {
                                    return _vm.$set(
                                      _vm.produtoConteudo.pacotes.config.voz,
                                      "tecnologia_sinalizacao",
                                      $event
                                    )
                                  },
                                  "update:s-value": function($event) {
                                    return _vm.$set(
                                      _vm.produtoConteudo.pacotes.config.voz,
                                      "tecnologia_sinalizacao",
                                      $event
                                    )
                                  }
                                }
                              })
                            : _vm._e(),
                          _c("httInput", {
                            staticClass: "_50",
                            class: {
                              error: _vm.existError(
                                "produtos.pacotes.config.voz.quantidade_linhas"
                              )
                            },
                            attrs: {
                              inputName:
                                "produtoConteudo.pacotes.config.voz.quantidade_linhas",
                              inputMask: "#####",
                              inputLabel: "Quantidade de Linhas",
                              inputType: "text",
                              inputValue:
                                _vm.produtoConteudo.pacotes.config.voz
                                  .quantidade_linhas,
                              inputMessage: _vm.getError(
                                "produtos.pacotes.config.voz.quantidade_linhas"
                              ),
                              inputDisabled: !_vm.canSave
                            },
                            on: {
                              "update:inputValue": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "quantidade_linhas",
                                  $event
                                )
                              },
                              "update:input-value": function($event) {
                                return _vm.$set(
                                  _vm.produtoConteudo.pacotes.config.voz,
                                  "quantidade_linhas",
                                  $event
                                )
                              },
                              blur: function($event) {
                                return _vm.limparErroCampo(
                                  "produtos.pacotes.config.voz.quantidade_linhas"
                                )
                              }
                            }
                          }),
                          _vm.produtoConteudo.pacotes.config.voz.tecnologia !=
                          "Analógica"
                            ? _c("httSelect", {
                                staticClass: "_50",
                                class: {
                                  error: _vm.existError(
                                    "produtos.pacotes.config.voz.faixa_numeracao.identificacao"
                                  )
                                },
                                attrs: {
                                  empty: true,
                                  sPlaceholder: "Identificação",
                                  sOptions: _vm.identificacoes,
                                  sValue:
                                    _vm.produtoConteudo.pacotes.config.voz
                                      .faixa_numeracao.identificacao,
                                  multiple: false,
                                  selectMessage: _vm.getError(
                                    "produtos.pacotes.config.voz.faixa_numeracao.identificacao"
                                  ),
                                  disabled: !_vm.canSave
                                },
                                on: {
                                  "update:sValue": function($event) {
                                    return _vm.$set(
                                      _vm.produtoConteudo.pacotes.config.voz
                                        .faixa_numeracao,
                                      "identificacao",
                                      $event
                                    )
                                  },
                                  "update:s-value": function($event) {
                                    return _vm.$set(
                                      _vm.produtoConteudo.pacotes.config.voz
                                        .faixa_numeracao,
                                      "identificacao",
                                      $event
                                    )
                                  },
                                  blur: function($event) {
                                    return _vm.limparErroCampo(
                                      "produtos.pacotes.config.voz.faixa_numeracao.identificacao"
                                    )
                                  }
                                }
                              })
                            : _vm._e(),
                          _vm.produtoConteudo.pacotes.config.voz.tecnologia !=
                          "Analógica"
                            ? _c("httInput", {
                                staticClass: "_50",
                                class: {
                                  error: _vm.existError(
                                    "produtos.pacotes.config.voz.faixa_numeracao.piloto"
                                  )
                                },
                                attrs: {
                                  inputName:
                                    "produtoConteudo.pacotes.config.voz.faixa_numeracao.piloto",
                                  inputMask: _vm.btnDisabled
                                    ? "##########"
                                    : "(##) ####-####",
                                  inputLabel: "Piloto",
                                  inputType: "text",
                                  inputValue:
                                    _vm.produtoConteudo.pacotes.config.voz
                                      .faixa_numeracao.piloto,
                                  inputMessage: _vm.getError(
                                    "produtos.pacotes.config.voz.faixa_numeracao.piloto"
                                  ),
                                  inputDisabled: !_vm.canSave
                                },
                                on: {
                                  "update:inputValue": function($event) {
                                    return _vm.$set(
                                      _vm.produtoConteudo.pacotes.config.voz
                                        .faixa_numeracao,
                                      "piloto",
                                      $event
                                    )
                                  },
                                  "update:input-value": function($event) {
                                    return _vm.$set(
                                      _vm.produtoConteudo.pacotes.config.voz
                                        .faixa_numeracao,
                                      "piloto",
                                      $event
                                    )
                                  },
                                  blur: function($event) {
                                    return _vm.limparErroCampo(
                                      "produtos.pacotes.config.voz.faixa_numeracao.piloto"
                                    )
                                  }
                                }
                              })
                            : _vm._e(),
                          _c(
                            "div",
                            { staticClass: "faixas _100 fieldset" },
                            [
                              _vm.existError(
                                "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros"
                              )
                                ? _c("span", { staticClass: "message error" }, [
                                    _vm._v(
                                      _vm._s(
                                        _vm.getError(
                                          "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros"
                                        )
                                      )
                                    )
                                  ])
                                : _vm._e(),
                              _vm._l(
                                _vm.produtoConteudo.pacotes.config.voz
                                  .faixa_numeracao.lista_numeros,
                                function(numeroLista, index) {
                                  return _c(
                                    "div",
                                    { staticClass: "faixa _100" },
                                    [
                                      _c("h4", { staticClass: "_100" }, [
                                        _vm._v("Faixa ")
                                      ]),
                                      _c("httInput", {
                                        staticClass: "_25",
                                        class: {
                                          error: _vm.existError(
                                            "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                              index +
                                              ".inicial"
                                          )
                                        },
                                        attrs: {
                                          inputName: "inicial-" + index,
                                          inputMask: _vm.btnDisabled
                                            ? "##########"
                                            : "(##) ####-####",
                                          inputLabel: "Inicial",
                                          inputType: "text",
                                          inputValue: numeroLista.inicial,
                                          inputMessage: _vm.getError(
                                            "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                              index +
                                              ".inicial"
                                          ),
                                          inputDisabled: !_vm.canSave
                                        },
                                        on: {
                                          "update:inputValue": function(
                                            $event
                                          ) {
                                            return _vm.$set(
                                              numeroLista,
                                              "inicial",
                                              $event
                                            )
                                          },
                                          "update:input-value": function(
                                            $event
                                          ) {
                                            return _vm.$set(
                                              numeroLista,
                                              "inicial",
                                              $event
                                            )
                                          },
                                          blur: function($event) {
                                            return _vm.limparErroCampo(
                                              "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                                index +
                                                ".inicial"
                                            )
                                          }
                                        }
                                      }),
                                      _c("httInput", {
                                        staticClass: "_25",
                                        class: {
                                          error: _vm.existError(
                                            "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                              index +
                                              ".final"
                                          )
                                        },
                                        attrs: {
                                          inputName: "final-" + index,
                                          inputMask: _vm.btnDisabled
                                            ? "##########"
                                            : "(##) ####-####",
                                          inputLabel: "Final",
                                          inputType: "text",
                                          inputValue: numeroLista.final,
                                          inputMessage: _vm.getError(
                                            "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                              index +
                                              ".final"
                                          ),
                                          inputDisabled: !_vm.canSave
                                        },
                                        on: {
                                          "update:inputValue": function(
                                            $event
                                          ) {
                                            return _vm.$set(
                                              numeroLista,
                                              "final",
                                              $event
                                            )
                                          },
                                          "update:input-value": function(
                                            $event
                                          ) {
                                            return _vm.$set(
                                              numeroLista,
                                              "final",
                                              $event
                                            )
                                          },
                                          blur: function($event) {
                                            return _vm.limparErroCampo(
                                              "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                                index +
                                                ".final"
                                            )
                                          }
                                        }
                                      }),
                                      _c("httSelect", {
                                        staticClass: "_25",
                                        class: {
                                          error: _vm.existError(
                                            "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                              index +
                                              ".portado"
                                          )
                                        },
                                        attrs: {
                                          sPlaceholder: "Portado",
                                          sOptions: _vm.portado,
                                          sValue: numeroLista.portado,
                                          multiple: false,
                                          selectMessage: _vm.getError(
                                            "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                              index +
                                              ".portado"
                                          ),
                                          disabled: !_vm.canSave
                                        },
                                        on: {
                                          "update:sValue": function($event) {
                                            return _vm.$set(
                                              numeroLista,
                                              "portado",
                                              $event
                                            )
                                          },
                                          "update:s-value": function($event) {
                                            return _vm.$set(
                                              numeroLista,
                                              "portado",
                                              $event
                                            )
                                          },
                                          blur: function($event) {
                                            return _vm.limparErroCampo(
                                              "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                                index +
                                                ".portado"
                                            )
                                          }
                                        }
                                      }),
                                      numeroLista.portado == "sim"
                                        ? _c("httInput", {
                                            staticClass: "_25",
                                            class: {
                                              error: _vm.existError(
                                                "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                                  index +
                                                  ".operadora_doadora"
                                              )
                                            },
                                            attrs: {
                                              inputName:
                                                "operadora_doadora-" + index,
                                              inputLabel: "Operadora Doadora",
                                              inputType: "text",
                                              inputValue:
                                                numeroLista.operadora_doadora,
                                              inputMessage: _vm.getError(
                                                "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                                  index +
                                                  ".operadora_doadora"
                                              ),
                                              inputDisabled: !_vm.canSave
                                            },
                                            on: {
                                              "update:inputValue": function(
                                                $event
                                              ) {
                                                return _vm.$set(
                                                  numeroLista,
                                                  "operadora_doadora",
                                                  $event
                                                )
                                              },
                                              "update:input-value": function(
                                                $event
                                              ) {
                                                return _vm.$set(
                                                  numeroLista,
                                                  "operadora_doadora",
                                                  $event
                                                )
                                              },
                                              blur: function($event) {
                                                return _vm.limparErroCampo(
                                                  "produtos.pacotes.config.voz.faixa_numeracao.lista_numeros." +
                                                    index +
                                                    ".operadora_doadora"
                                                )
                                              }
                                            }
                                          })
                                        : _vm._e(),
                                      _c("httButton", {
                                        staticClass: "_25",
                                        attrs: {
                                          buttonType: "button",
                                          buttonText: "Remover",
                                          buttonDisabled: !_vm.canSave
                                        },
                                        on: {
                                          click: function($event) {
                                            return _vm.removeFaixa(index)
                                          }
                                        }
                                      })
                                    ],
                                    1
                                  )
                                }
                              ),
                              _vm.maxNumberFaixa >
                              _vm.produtoConteudo.pacotes.config.voz
                                .faixa_numeracao.lista_numeros.length
                                ? _c("httButton", {
                                    staticClass: "_30",
                                    attrs: {
                                      buttonType: "button",
                                      buttonText: "Adicionar nova faixa",
                                      buttonDisabled: !_vm.canSave
                                    },
                                    on: {
                                      click: function($event) {
                                        return _vm.createFaixa()
                                      }
                                    }
                                  })
                                : _vm._e()
                            ],
                            2
                          )
                        ],
                        1
                      )
                    : _vm._e()
                ]),
                _c(
                  "div",
                  { staticClass: "fieldset" },
                  [
                    _c("h4", { staticClass: "_100 totalWidth" }, [
                      _vm._v("Cloud Backup")
                    ]),
                    _vm.produtos.cloudbackup
                      ? _c("httSelect", {
                          staticClass: "_30",
                          attrs: {
                            sOptions: _vm.produtos.cloudbackup,
                            sLabel: "nome",
                            sTrack: "produto_id",
                            sValue: _vm.produtoSelecionado.cloudbackup,
                            multiple: false,
                            empty: true,
                            disabled: !_vm.canSave
                          },
                          on: {
                            "update:sValue": function($event) {
                              return _vm.$set(
                                _vm.produtoSelecionado,
                                "cloudbackup",
                                $event
                              )
                            },
                            "update:s-value": function($event) {
                              return _vm.$set(
                                _vm.produtoSelecionado,
                                "cloudbackup",
                                $event
                              )
                            }
                          }
                        })
                      : _vm._e(),
                    _vm.produtoSelecionado.cloudbackup
                      ? _c(
                          "div",
                          { staticClass: "fieldset produtos" },
                          [
                            _c("httInput", {
                              staticClass: "_35",
                              class: {
                                error: _vm.existError(
                                  "produtos.cloudbackup.config.email"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.cloudbackup.config.email",
                                inputLabel: "Email",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.cloudbackup.config.email,
                                inputMessage: _vm.getError(
                                  "produtos.cloudbackup.config.email"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "email",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "email",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.cloudbackup.config.email"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_20",
                              class: {
                                error: _vm.existError(
                                  "produtos.cloudbackup.config.valor"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.cloudbackup.config.valor",
                                inputMoney: _vm.money,
                                inputLabel: "Valor",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.cloudbackup.config.valor,
                                inputMessage: _vm.getError(
                                  "produtos.cloudbackup.config.valor"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "valor",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "valor",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.cloudbackup.config.valor"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_20",
                              class: {
                                error: _vm.existError(
                                  "produtos.cloudbackup.config.desconto"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.cloudbackup.config.desconto",
                                inputMoney: _vm.money,
                                inputShow: !_vm.produtoConteudo.cloudbackup
                                  .config.is_percent,
                                inputLabel: "Desconto",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.cloudbackup.config
                                    .desconto,
                                inputMessage: _vm.getError(
                                  "produtos.cloudbackup.config.desconto"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "desconto",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "desconto",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.cloudbackup.config.desconto"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_20",
                              class: {
                                error: _vm.existError(
                                  "produtos.cloudbackup.config.desconto"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo.cloudbackup.config.desconto",
                                inputMask: "###",
                                inputShow:
                                  _vm.produtoConteudo.cloudbackup.config
                                    .is_percent,
                                inputLabel: "Desconto",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo.cloudbackup.config
                                    .desconto,
                                inputMessage: _vm.getError(
                                  "produtos.cloudbackup.config.desconto"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "desconto",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "desconto",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.cloudbackup.config.desconto"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_15",
                              attrs: {
                                inputDisabled: true,
                                inputName: "valorTotalCloud",
                                inputLabel: "Valor Total",
                                inputType: "text",
                                inputValue: _vm.valorTotalCloud
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  _vm.valorTotalCloud = $event
                                },
                                "update:input-value": function($event) {
                                  _vm.valorTotalCloud = $event
                                }
                              }
                            }),
                            _c("httCheckAtivo", {
                              staticClass: "_10",
                              attrs: {
                                nomeCheckbox: "Porcentagem",
                                checkboxValue:
                                  _vm.produtoConteudo.cloudbackup.config
                                    .is_percent,
                                disabledCheckbox: !_vm.canSave
                              },
                              on: {
                                "update:checkboxValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "is_percent",
                                    $event
                                  )
                                },
                                "update:checkbox-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "is_percent",
                                    $event
                                  )
                                }
                              }
                            }),
                            _c("httSelect", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.cloudbackup.config.quantidade_ciclos"
                                )
                              },
                              attrs: {
                                sPlaceholder: "Ciclos",
                                empty: true,
                                sOptions: _vm.ciclos,
                                sValue:
                                  _vm.produtoConteudo.cloudbackup.config
                                    .quantidade_ciclos,
                                multiple: false,
                                selectMessage: _vm.getError(
                                  "produtos.cloudbackup.config.quantidade_ciclos"
                                ),
                                disabled: !_vm.canSave
                              },
                              on: {
                                "update:sValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "quantidade_ciclos",
                                    $event
                                  )
                                },
                                "update:s-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo.cloudbackup.config,
                                    "quantidade_ciclos",
                                    $event
                                  )
                                }
                              }
                            })
                          ],
                          1
                        )
                      : _vm._e()
                  ],
                  1
                ),
                _c(
                  "div",
                  { staticClass: "fieldset" },
                  [
                    _c("h4", { staticClass: "_100 totalWidth" }, [
                      _vm._v("0800")
                    ]),
                    _c("httSelect", {
                      staticClass: "_30",
                      attrs: {
                        sOptions: _vm.produtos["0800"],
                        sLabel: "nome",
                        sTrack: "produto_id",
                        sValue: _vm.produtoSelecionado["0800"],
                        multiple: false,
                        empty: true,
                        disabled: !_vm.canSave
                      },
                      on: {
                        "update:sValue": function($event) {
                          return _vm.$set(
                            _vm.produtoSelecionado,
                            "0800",
                            $event
                          )
                        },
                        "update:s-value": function($event) {
                          return _vm.$set(
                            _vm.produtoSelecionado,
                            "0800",
                            $event
                          )
                        }
                      }
                    }),
                    _vm.produtoSelecionado["0800"]
                      ? _c(
                          "div",
                          { staticClass: "fieldset produtos" },
                          [
                            _c("httInput", {
                              staticClass: "_30",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.numero_0800"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo['0800'].config.numero_0800",
                                inputMask: _vm.btnDisabled
                                  ? "800#######"
                                  : "800-###-####",
                                inputLabel: "Numero 0800",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo["0800"].config
                                    .numero_0800,
                                inputMessage: _vm.getError(
                                  "produtos.0800.config.numero_0800"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "numero_0800",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "numero_0800",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.0800.config.numero_0800"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_30",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.numero_encaminhamento"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo['0800'].config.numero_encaminhamento",
                                inputMask: _vm.btnDisabled
                                  ? "##########"
                                  : "(##) ####-####",
                                inputLabel: "Numero Encaminhado",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo["0800"].config
                                    .numero_encaminhamento,
                                inputMessage: _vm.getError(
                                  "produtos.0800.config.numero_encaminhamento"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "numero_encaminhamento",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "numero_encaminhamento",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.0800.config.numero_encaminhamento"
                                  )
                                }
                              }
                            }),
                            _c("httSelect", {
                              staticClass: "_15",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.portado"
                                )
                              },
                              attrs: {
                                sPlaceholder: "Portado",
                                sOptions: _vm.portado,
                                sValue:
                                  _vm.produtoConteudo["0800"].config.portado,
                                multiple: false,
                                selectMessage: _vm.getError(
                                  "produtos.0800.config.portado"
                                ),
                                disabled: !_vm.canSave
                              },
                              on: {
                                "update:sValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "portado",
                                    $event
                                  )
                                },
                                "update:s-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "portado",
                                    $event
                                  )
                                }
                              }
                            }),
                            _vm.produtoConteudo["0800"].config.portado == "sim"
                              ? _c("httInput", {
                                  staticClass: "_25",
                                  class: {
                                    error: _vm.existError(
                                      "produtos.0800.config.operadora_doadora"
                                    )
                                  },
                                  attrs: {
                                    inputName:
                                      "produtoConteudo['0800'].config.operadora_doadora",
                                    inputLabel: "Operadora Doadora",
                                    inputType: "text",
                                    inputValue:
                                      _vm.produtoConteudo["0800"].config
                                        .operadora_doadora,
                                    inputMessage: _vm.getError(
                                      "produtos.0800.config.operadora_doadora"
                                    ),
                                    inputDisabled: !_vm.canSave
                                  },
                                  on: {
                                    "update:inputValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo["0800"].config,
                                        "operadora_doadora",
                                        $event
                                      )
                                    },
                                    "update:input-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo["0800"].config,
                                        "operadora_doadora",
                                        $event
                                      )
                                    },
                                    blur: function($event) {
                                      return _vm.limparErroCampo(
                                        "produtos.0800.config.operadora_doadora"
                                      )
                                    }
                                  }
                                })
                              : _vm._e(),
                            _c("httInput", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.valor"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo['0800'].config.valor",
                                inputMoney: _vm.money,
                                inputLabel: "Valor",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo["0800"].config.valor,
                                inputMessage: _vm.getError(
                                  "produtos.0800.config.valor"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "valor",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "valor",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.0800.config.valor"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.desconto"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo['0800'].config.desconto",
                                inputMoney: _vm.money,
                                inputShow: !_vm.produtoConteudo["0800"].config
                                  .is_percent,
                                inputLabel: "Desconto",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo["0800"].config.desconto,
                                inputMessage: _vm.getError(
                                  "produtos.0800.config.desconto"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "desconto",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "desconto",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.0800.config.desconto"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.desconto"
                                )
                              },
                              attrs: {
                                inputName:
                                  "produtoConteudo['0800'].config.desconto",
                                inputMask: "###",
                                inputShow:
                                  _vm.produtoConteudo["0800"].config.is_percent,
                                inputLabel: "Desconto",
                                inputType: "text",
                                inputValue:
                                  _vm.produtoConteudo["0800"].config.desconto,
                                inputMessage: _vm.getError(
                                  "produtos.0800.config.desconto"
                                ),
                                inputDisabled: !_vm.canSave
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "desconto",
                                    $event
                                  )
                                },
                                "update:input-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "desconto",
                                    $event
                                  )
                                },
                                blur: function($event) {
                                  return _vm.limparErroCampo(
                                    "produtos.0800.config.desconto"
                                  )
                                }
                              }
                            }),
                            _c("httInput", {
                              staticClass: "_15",
                              attrs: {
                                inputDisabled: true,
                                inputName: "valorTotal0800",
                                inputLabel: "Valor Total",
                                inputType: "text",
                                inputValue: _vm.valorTotal0800
                              },
                              on: {
                                "update:inputValue": function($event) {
                                  _vm.valorTotal0800 = $event
                                },
                                "update:input-value": function($event) {
                                  _vm.valorTotal0800 = $event
                                }
                              }
                            }),
                            _c("httCheckAtivo", {
                              staticClass: "_10",
                              attrs: {
                                nomeCheckbox: "Porcentagem",
                                checkboxValue:
                                  _vm.produtoConteudo["0800"].config.is_percent,
                                disabledCheckbox: !_vm.canSave
                              },
                              on: {
                                "update:checkboxValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "is_percent",
                                    $event
                                  )
                                },
                                "update:checkbox-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "is_percent",
                                    $event
                                  )
                                }
                              }
                            }),
                            _c("httSelect", {
                              staticClass: "_25",
                              class: {
                                error: _vm.existError(
                                  "produtos.0800.config.quantidade_ciclos"
                                )
                              },
                              attrs: {
                                sPlaceholder: "Ciclos",
                                empty: true,
                                sOptions: _vm.ciclos,
                                sValue:
                                  _vm.produtoConteudo["0800"].config
                                    .quantidade_ciclos,
                                multiple: false,
                                selectMessage: _vm.getError(
                                  "produtos.0800.config.quantidade_ciclos"
                                ),
                                disabled: !_vm.canSave
                              },
                              on: {
                                "update:sValue": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "quantidade_ciclos",
                                    $event
                                  )
                                },
                                "update:s-value": function($event) {
                                  return _vm.$set(
                                    _vm.produtoConteudo["0800"].config,
                                    "quantidade_ciclos",
                                    $event
                                  )
                                }
                              }
                            })
                          ],
                          1
                        )
                      : _vm._e()
                  ],
                  1
                ),
                !_vm.hideSmartBox
                  ? _c(
                      "div",
                      { staticClass: "fieldset" },
                      [
                        _c("h4", { staticClass: "_100 totalWidth" }, [
                          _vm._v("SmartBox")
                        ]),
                        _c("httSelect", {
                          staticClass: "_30",
                          attrs: {
                            sOptions: _vm.produtos.smartbox,
                            sLabel: "nome",
                            sTrack: "produto_id",
                            sValue: _vm.produtoSelecionado.smartbox,
                            multiple: false,
                            empty: true,
                            disabled: !_vm.canSave
                          },
                          on: {
                            "update:sValue": function($event) {
                              return _vm.$set(
                                _vm.produtoSelecionado,
                                "smartbox",
                                $event
                              )
                            },
                            "update:s-value": function($event) {
                              return _vm.$set(
                                _vm.produtoSelecionado,
                                "smartbox",
                                $event
                              )
                            }
                          }
                        }),
                        _vm.existError("produtos.smartbox")
                          ? _c("span", { staticClass: "message error" }, [
                              _vm._v(_vm._s(_vm.getError("produtos.smartbox")))
                            ])
                          : _vm._e(),
                        _vm.produtoSelecionado.smartbox
                          ? _c(
                              "div",
                              { staticClass: "fieldset produtos" },
                              [
                                _c("httInput", {
                                  staticClass: "_25",
                                  class: {
                                    error: _vm.existError(
                                      "produtos.smartbox.config.quantidade_ramais"
                                    )
                                  },
                                  attrs: {
                                    inputName:
                                      "produtoConteudo.smartbox.config.quantidade_ramais",
                                    inputMask: "####",
                                    inputLabel: "Quantidade de ramais",
                                    inputType: "text",
                                    inputValue:
                                      _vm.produtoConteudo.smartbox.config
                                        .quantidade_ramais,
                                    inputMessage: _vm.getError(
                                      "produtos.smartbox.config.quantidade_ramais"
                                    ),
                                    inputDisabled: !_vm.canSave
                                  },
                                  on: {
                                    "update:inputValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "quantidade_ramais",
                                        $event
                                      )
                                    },
                                    "update:input-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "quantidade_ramais",
                                        $event
                                      )
                                    },
                                    blur: function($event) {
                                      return _vm.limparErroCampo(
                                        "produtos.smartbox.config.quantidade_ramais"
                                      )
                                    }
                                  }
                                }),
                                _c("httInput", {
                                  staticClass: "_25",
                                  class: {
                                    error: _vm.existError(
                                      "produtos.smartbox.config.valor"
                                    )
                                  },
                                  attrs: {
                                    inputName:
                                      "produtoConteudo.smartbox.config.valor",
                                    inputMoney: _vm.money,
                                    inputLabel: "Valor por Ramal",
                                    inputType: "text",
                                    inputValue:
                                      _vm.produtoConteudo.smartbox.config.valor,
                                    inputMessage: _vm.getError(
                                      "produtos.smartbox.config.valor"
                                    ),
                                    inputDisabled: !_vm.canSave
                                  },
                                  on: {
                                    "update:inputValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "valor",
                                        $event
                                      )
                                    },
                                    "update:input-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "valor",
                                        $event
                                      )
                                    },
                                    blur: function($event) {
                                      return _vm.limparErroCampo(
                                        "produtos.smartbox.config.valor"
                                      )
                                    }
                                  }
                                }),
                                _c("httInput", {
                                  staticClass: "_25",
                                  class: {
                                    error: _vm.existError(
                                      "produtos.smartbox.config.desconto"
                                    )
                                  },
                                  attrs: {
                                    inputName:
                                      "produtoConteudo.smartbox.config.desconto",
                                    inputMoney: _vm.money,
                                    inputShow: !_vm.produtoConteudo.smartbox
                                      .config.is_percent,
                                    inputLabel: "Desconto",
                                    inputType: "text",
                                    inputValue:
                                      _vm.produtoConteudo.smartbox.config
                                        .desconto,
                                    inputMessage: _vm.getError(
                                      "produtos.smartbox.config.desconto"
                                    ),
                                    inputDisabled: !_vm.canSave
                                  },
                                  on: {
                                    "update:inputValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "desconto",
                                        $event
                                      )
                                    },
                                    "update:input-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "desconto",
                                        $event
                                      )
                                    },
                                    blur: function($event) {
                                      return _vm.limparErroCampo(
                                        "produtos.smartbox.config.desconto"
                                      )
                                    }
                                  }
                                }),
                                _c("httInput", {
                                  staticClass: "_25",
                                  class: {
                                    error: _vm.existError(
                                      "produtos.smartbox.config.desconto"
                                    )
                                  },
                                  attrs: {
                                    inputName:
                                      "produtoConteudo.smartbox.config.desconto",
                                    inputMask: "###",
                                    inputShow:
                                      _vm.produtoConteudo.smartbox.config
                                        .is_percent,
                                    inputLabel: "Desconto",
                                    inputType: "text",
                                    inputValue:
                                      _vm.produtoConteudo.smartbox.config
                                        .desconto,
                                    inputMessage: _vm.getError(
                                      "produtos.smartbox.config.desconto"
                                    ),
                                    inputDisabled: !_vm.canSave
                                  },
                                  on: {
                                    "update:inputValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "desconto",
                                        $event
                                      )
                                    },
                                    "update:input-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "desconto",
                                        $event
                                      )
                                    },
                                    blur: function($event) {
                                      return _vm.limparErroCampo(
                                        "produtos.smartbox.config.desconto"
                                      )
                                    }
                                  }
                                }),
                                _c("httInput", {
                                  staticClass: "_15",
                                  attrs: {
                                    inputDisabled: true,
                                    inputName: "valorTotalSmartbox",
                                    inputLabel: "Valor Total",
                                    inputType: "text",
                                    inputValue: _vm.valorTotalSmartbox
                                  },
                                  on: {
                                    "update:inputValue": function($event) {
                                      _vm.valorTotalSmartbox = $event
                                    },
                                    "update:input-value": function($event) {
                                      _vm.valorTotalSmartbox = $event
                                    }
                                  }
                                }),
                                _c("httCheckAtivo", {
                                  staticClass: "_10",
                                  attrs: {
                                    nomeCheckbox: "Porcentagem",
                                    checkboxValue:
                                      _vm.produtoConteudo.smartbox.config
                                        .is_percent,
                                    disabledCheckbox: !_vm.canSave
                                  },
                                  on: {
                                    "update:checkboxValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "is_percent",
                                        $event
                                      )
                                    },
                                    "update:checkbox-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "is_percent",
                                        $event
                                      )
                                    }
                                  }
                                }),
                                _c("httSelect", {
                                  staticClass: "_25",
                                  class: {
                                    error: _vm.existError(
                                      "produtos.smartbox.config.quantidade_ciclos"
                                    )
                                  },
                                  attrs: {
                                    sPlaceholder: "Ciclos",
                                    empty: true,
                                    sOptions: _vm.ciclos,
                                    sValue:
                                      _vm.produtoConteudo.smartbox.config
                                        .quantidade_ciclos,
                                    multiple: false,
                                    selectMessage: _vm.getError(
                                      "produtos.smartbox.config.quantidade_ciclos"
                                    ),
                                    disabled: !_vm.canSave
                                  },
                                  on: {
                                    "update:sValue": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "quantidade_ciclos",
                                        $event
                                      )
                                    },
                                    "update:s-value": function($event) {
                                      return _vm.$set(
                                        _vm.produtoConteudo.smartbox.config,
                                        "quantidade_ciclos",
                                        $event
                                      )
                                    }
                                  }
                                })
                              ],
                              1
                            )
                          : _vm._e()
                      ],
                      1
                    )
                  : _vm._e()
              ])
            : _vm._e(),
          _c("div", { staticClass: "fieldset" }, [
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
                      staticClass: "download",
                      attrs: {
                        src: __webpack_require__(/*! @/assets/images/web/icones/iconesLaranja/download_laranja.svg */ "./resources/assets/images/web/icones/iconesLaranja/download_laranja.svg")
                      }
                    }),
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
          ]),
          _vm.showCanGenerateContract
            ? _c(
                "div",
                { staticClass: "fieldset" },
                [
                  _c("h4", { staticClass: "_20 totalWidth" }, [
                    _vm._v("Gerar Contrato com data")
                  ]),
                  _c(
                    "div",
                    { staticClass: "fieldset" },
                    [
                      _c("httInput", {
                        staticClass: "_25",
                        class: { error: _vm.existError("dataContratoCustom") },
                        attrs: {
                          inputName: "dataContratoCustom",
                          inputMask: "##/##/#### ##:##:##",
                          inputLabel: "Data de Emissão",
                          inputType: "text",
                          inputValue: _vm.dataContratoCustom,
                          inputMessage: _vm.getError("dataContratoCustom")
                        },
                        on: {
                          "update:inputValue": function($event) {
                            _vm.dataContratoCustom = $event
                          },
                          "update:input-value": function($event) {
                            _vm.dataContratoCustom = $event
                          },
                          blur: function($event) {
                            return _vm.limparErroCampo("dataContratoCustom")
                          }
                        }
                      })
                    ],
                    1
                  ),
                  _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Gerar Contrato Venda com Data",
                      buttonDisabled: _vm.btnDisabled,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/file.svg */ "./resources/assets/images/web/icones/iconesBranco/file.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.createContratoCustom()
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
              _c("h4", { staticClass: "_20 totalWidth" }, [
                _vm._v("Upload Arquivos")
              ]),
              _c("httButton", {
                attrs: {
                  buttonType: "button",
                  buttonText: "Gerar Contrato Venda",
                  buttonDisabled: _vm.btnDisabled,
                  "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/file.svg */ "./resources/assets/images/web/icones/iconesBranco/file.svg")
                },
                on: {
                  click: function($event) {
                    return _vm.createContrato()
                  }
                }
              }),
              _c("httButton", {
                attrs: {
                  buttonType: "button",
                  buttonText: "Gerar Checklist Venda",
                  buttonDisabled: _vm.btnDisabled,
                  "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/file.svg */ "./resources/assets/images/web/icones/iconesBranco/file.svg")
                },
                on: {
                  click: function($event) {
                    return _vm.createChecklist()
                  }
                }
              }),
              _vm.isSuperUser
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Contrato com data",
                      buttonDisabled: _vm.btnDisabled,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/file.svg */ "./resources/assets/images/web/icones/iconesBranco/file.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.habiltarCTRData()
                      }
                    }
                  })
                : _vm._e(),
              _c("div", { staticClass: "import" }, [
                _c("label", { attrs: { for: "import" } }, [
                  _c("input", {
                    ref: "inputImport",
                    attrs: {
                      id: "import",
                      type: "file",
                      disabled: _vm.btnDisabled
                    },
                    on: { change: _vm.importFile }
                  }),
                  !_vm.sucesso
                    ? _c("span", [
                        _vm._v("Clique aqui e selecione seu arquivo"),
                        _c("img", {
                          attrs: {
                            src: __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/file.svg */ "./resources/assets/images/web/icones/iconesBranco/file.svg")
                          }
                        })
                      ])
                    : _c("span", { staticClass: "sucesso" }, [
                        _c("img", {
                          attrs: {
                            src: __webpack_require__(/*! @/assets/images/web/icones/iconesPreto/success.svg */ "./resources/assets/images/web/icones/iconesPreto/success.svg")
                          }
                        }),
                        _vm._v("Arquivo carregado com sucesso!")
                      ])
                ]),
                _vm.messagemErro
                  ? _c("div", [_c("p", [_vm._v(_vm._s(_vm.messagemErro))])])
                  : _vm._e()
              ])
            ],
            1
          ),
          _c(
            "div",
            { staticClass: "fieldset" },
            [
              _vm.$root.hasPermission("vendas", 3) ||
              _vm.$root.hasPermission("vendas", 2)
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Salvar Venda",
                      buttonDisabled: _vm.btnDisabled || !_vm.canSave,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/save_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/save_branco.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.sendForm()
                      }
                    }
                  })
                : _vm._e(),
              _vm.$root.hasPermission("vendas", 3) ||
              _vm.$root.hasPermission("vendas", 2)
                ? _c("httButton", {
                    attrs: {
                      buttonType: "button",
                      buttonText: "Auditoria",
                      buttonDisabled: _vm.btnDisabled || !_vm.canSave,
                      "button-icon": __webpack_require__(/*! @/assets/images/web/icones/iconesBranco/aprovar_branco.svg */ "./resources/assets/images/web/icones/iconesBranco/aprovar_branco.svg")
                    },
                    on: {
                      click: function($event) {
                        return _vm.sendForm(true)
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

/***/ "./resources/assets/images/web/icones/iconesBranco/edit_branco.svg":
/*!*************************************************************************!*\
  !*** ./resources/assets/images/web/icones/iconesBranco/edit_branco.svg ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/edit_branco.svg?e58ba8833224bb35475014bb9eb8ca4a";

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

/***/ "./resources/assets/images/web/icones/iconesPreto/success.svg":
/*!********************************************************************!*\
  !*** ./resources/assets/images/web/icones/iconesPreto/success.svg ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/success.svg?d4684fb9d747c7c3b57f9a286bb71e81";

/***/ }),

/***/ "./resources/vue/mixins/ProdutosVenda.js":
/*!***********************************************!*\
  !*** ./resources/vue/mixins/ProdutosVenda.js ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      produtos: {
        "0800": null,
        cloudbackup: null,
        pacotes: null,
        smartbox: null
      },
      produtoSelecionado: {
        "0800": null,
        cloudbackup: null,
        pacotes: null,
        smartbox: null
      },
      produtoConteudo: {
        "0800": {
          config: {
            numero_0800: null,
            numero_encaminhamento: null,
            portado: null,
            operadora_doadora: null,
            valor: null,
            desconto: null,
            is_percent: false,
            quantidade_ciclos: null
          }
        },
        cloudbackup: {
          config: {
            email: null,
            valor: null,
            desconto: null,
            is_percent: false,
            quantidade_ciclos: null
          }
        },
        pacotes: {
          config: {
            internet: {
              valor: null,
              desconto: null,
              is_percent: false,
              quantidade_ciclos: null
            },
            voz: {
              valor: null,
              desconto: null,
              is_percent: false,
              quantidade_ciclos: null,
              tecnologia: '',
              tecnologia_sinalizacao: null,
              quantidade_linhas: null,
              faixa_numeracao: {
                identificacao: '',
                lista_numeros: [],
                piloto: null
              }
            }
          }
        },
        smartbox: {
          config: {
            quantidade_ramais: null,
            valor: null,
            desconto: null,
            is_percent: false,
            quantidade_ciclos: null
          }
        }
      },
      hideSmartBox: false,
      maxNumberFaixa: 5
    };
  },
  computed: {
    valorTotalPacote: function valorTotalPacote() {
      if (!this.produtoConteudo.pacotes.config.internet.valor) return '';

      if (this.produtoConteudo.pacotes.config.internet.desconto) {
        return this.produtoConteudo.pacotes.config.internet.is_percent ? "".concat(this.produtoConteudo.pacotes.config.internet.valor * (100 - this.produtoConteudo.pacotes.config.internet.desconto) / 100) : "".concat(this.calculateValorTotal(this.produtoConteudo.pacotes.config.internet.valor, this.produtoConteudo.pacotes.config.internet.desconto));
      } else {
        return "".concat(this.produtoConteudo.pacotes.config.internet.valor);
      }
    },
    valorTotalVoz: function valorTotalVoz() {
      if (!this.produtoConteudo.pacotes.config.voz.valor) return '';

      if (this.produtoConteudo.pacotes.config.voz.desconto) {
        return this.produtoConteudo.pacotes.config.voz.is_percent ? "".concat(this.produtoConteudo.pacotes.config.voz.valor * (100 - this.produtoConteudo.pacotes.config.voz.desconto) / 100) : "".concat(this.calculateValorTotal(this.produtoConteudo.pacotes.config.voz.valor, this.produtoConteudo.pacotes.config.voz.desconto));
      } else {
        return "".concat(this.produtoConteudo.pacotes.config.voz.valor);
      }
    },
    valorTotalCloud: function valorTotalCloud() {
      if (!this.produtoConteudo.cloudbackup.config.valor) return '';

      if (this.produtoConteudo.cloudbackup.config.desconto) {
        return this.produtoConteudo.cloudbackup.config.is_percent ? "".concat(this.produtoConteudo.cloudbackup.config.valor * (100 - this.produtoConteudo.cloudbackup.config.desconto) / 100) : "".concat(this.calculateValorTotal(this.produtoConteudo.cloudbackup.config.valor, this.produtoConteudo.cloudbackup.config.desconto));
      } else {
        return "".concat(this.produtoConteudo.cloudbackup.config.valor);
      }
    },
    valorTotal0800: function valorTotal0800() {
      if (!this.produtoConteudo['0800'].config.valor) return '';

      if (this.produtoConteudo['0800'].config.desconto) {
        return this.produtoConteudo['0800'].config.is_percent ? "".concat(this.produtoConteudo['0800'].config.valor * (100 - this.produtoConteudo['0800'].config.desconto) / 100) : "".concat(this.calculateValorTotal(this.produtoConteudo['0800'].config.valor, this.produtoConteudo['0800'].config.desconto));
      } else {
        return "".concat(this.produtoConteudo['0800'].config.valor);
      }
    },
    valorTotalSmartbox: function valorTotalSmartbox() {
      if (!this.produtoConteudo.smartbox.config.valor && !this.produtoConteudo.smartbox.config.quantidade_ramais) return '';
      var tempValor = this.produtoConteudo.smartbox.config.quantidade_ramais * this.produtoConteudo.smartbox.config.valor;

      if (this.produtoConteudo.smartbox.config.desconto) {
        return this.produtoConteudo.smartbox.config.is_percent ? "".concat(tempValor * (100 - this.produtoConteudo.smartbox.config.desconto) / 100) : "".concat(this.calculateValorTotal(tempValor, this.produtoConteudo.smartbox.config.desconto));
      } else {
        return "".concat(tempValor);
      }
    }
  },
  watch: {
    'produtoConteudo.pacotes.config.voz.tecnologia': function produtoConteudoPacotesConfigVozTecnologia(val) {
      if (val !== 'SIP') {
        this.produtoConteudo.smartbox = {
          config: {
            quantidade_ramais: null,
            valor: null,
            desconto: null,
            is_percent: false,
            quantidade_ciclos: null
          }
        };
        this.produtoSelecionado.smartbox = null;
        this.hideSmartBox = true;
      } else {
        this.hideSmartBox = false;
      }

      if (val === 'Analógica') {
        this.maxNumberFaixa = 2;

        if (this.produtoConteudo.pacotes.config.voz.tecnologia.length > 2) {
          this.produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.splice(2);
        }
      } else {
        this.maxNumberFaixa = 5;
      }
    }
  },
  methods: {
    calculateValorTotal: function calculateValorTotal(valor, desconto) {
      return ((valor * 100 - desconto * 100) / 100).toFixed(2);
    },
    syncProdutosLoad: function syncProdutosLoad() {
      var _this = this;

      if (this.venda.produtos.pacotes) {
        // console.log(this.produtoConteudo.pacotes.config.voz, this.venda.produtos.pacotes.config.voz)
        this.produtoSelecionado.pacotes = this.produtos.pacotes.find(function (produto) {
          return produto.produto_id == _this.venda.produtos.pacotes.produto_id;
        });
        this.produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao = Object.assign(this.produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao, this.venda.produtos.pacotes.config.voz.faixa_numeracao.identificacao);
        this.produtoConteudo.pacotes.config.voz.faixa_numeracao = Object.assign(this.produtoConteudo.pacotes.config.voz.faixa_numeracao, this.venda.produtos.pacotes.config.voz.faixa_numeracao);
        this.produtoConteudo.pacotes.config.voz = Object.assign(this.produtoConteudo.pacotes.config.voz, this.venda.produtos.pacotes.config.voz);
        this.produtoConteudo.pacotes.config = Object.assign(this.produtoConteudo.pacotes.config, this.venda.produtos.pacotes.config);
        this.produtoConteudo.pacotes = Object.assign(this.produtoConteudo.pacotes, this.venda.produtos.pacotes);
      }

      if (this.venda.produtos["0800"]) {
        this.produtoSelecionado["0800"] = this.produtos["0800"].find(function (produto) {
          return produto.produto_id == _this.venda.produtos["0800"].produto_id;
        });
        this.produtoConteudo["0800"].config = Object.assign(this.produtoConteudo["0800"].config, this.venda.produtos["0800"].config);
        this.produtoConteudo["0800"] = Object.assign(this.produtoConteudo["0800"], this.venda.produtos["0800"]);
      }

      if (this.venda.produtos.cloudbackup) {
        this.produtoSelecionado.cloudbackup = this.produtos.cloudbackup.find(function (produto) {
          return produto.produto_id == _this.venda.produtos.cloudbackup.produto_id;
        });
        this.produtoConteudo.cloudbackup.config = Object.assign(this.produtoConteudo.cloudbackup.config, this.venda.produtos.cloudbackup.config);
        this.produtoConteudo.cloudbackup = Object.assign(this.produtoConteudo.cloudbackup, this.venda.produtos.cloudbackup);
      }

      if (this.venda.produtos.smartbox) {
        this.produtoSelecionado.smartbox = this.produtos.smartbox.find(function (produto) {
          return produto.produto_id == _this.venda.produtos.smartbox.produto_id;
        });
        this.produtoConteudo.smartbox.config = Object.assign(this.produtoConteudo.smartbox.config, this.venda.produtos.smartbox.config);
        this.produtoConteudo.smartbox = Object.assign(this.produtoConteudo.smartbox, this.venda.produtos.smartbox);
      }

      this.venda.produtos = {};
    },
    syncProdutosSend: function syncProdutosSend() {
      if (this.produtoSelecionado.pacotes) this.venda.produtos.pacotes = Object.assign({}, this.produtoSelecionado.pacotes, this.produtoConteudo.pacotes);
      if (this.produtoSelecionado["0800"]) this.venda.produtos["0800"] = Object.assign({}, this.produtoSelecionado["0800"], this.produtoConteudo["0800"]);
      if (this.produtoSelecionado.cloudbackup) this.venda.produtos.cloudbackup = Object.assign({}, this.produtoSelecionado.cloudbackup, this.produtoConteudo.cloudbackup);
      if (this.produtoSelecionado.smartbox) this.venda.produtos.smartbox = Object.assign({}, this.produtoSelecionado.smartbox, this.produtoConteudo.smartbox);
    },
    createFaixa: function createFaixa() {
      this.produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.push({});
    },
    removeFaixa: function removeFaixa(index) {
      this.produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.splice(index, 1);
    },
    loadProdutos: function loadProdutos() {
      var _this2 = this;

      return this.$axios.get("produtos/tipos").then(function (response) {
        response.data.forEach(function (element) {
          _this2.produtos[element.slug] = element.produtos;
        });
      });
    }
  }
});

/***/ }),

/***/ "./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true&":
/*!**********************************************************************************************************!*\
  !*** ./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true& ***!
  \**********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--10-2!../../../../node_modules/stylus-loader!./Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/stylus-loader/index.js!./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_10_2_node_modules_stylus_loader_index_js_Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/vue/views/venda/Venda.vue":
/*!*********************************************!*\
  !*** ./resources/vue/views/venda/Venda.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Venda_vue_vue_type_template_id_1796fb52_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug& */ "./resources/vue/views/venda/Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug&");
/* harmony import */ var _Venda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Venda.vue?vue&type=script&lang=js& */ "./resources/vue/views/venda/Venda.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Venda_styl_vue_type_style_index_0_id_1796fb52_lang_stylus_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true& */ "./resources/vue/views/venda/Venda.styl?vue&type=style&index=0&id=1796fb52&lang=stylus&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Venda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Venda_vue_vue_type_template_id_1796fb52_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Venda_vue_vue_type_template_id_1796fb52_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1796fb52",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/vue/views/venda/Venda.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/vue/views/venda/Venda.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/vue/views/venda/Venda.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Venda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Venda.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/venda/Venda.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Venda_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/vue/views/venda/Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug&":
/*!*************************************************************************************************!*\
  !*** ./resources/vue/views/venda/Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Venda_vue_vue_type_template_id_1796fb52_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/pug-plain-loader!../../../../node_modules/vue-loader/lib??vue-loader-options!./Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/pug-plain-loader/index.js!./node_modules/vue-loader/lib/index.js?!./resources/vue/views/venda/Venda.vue?vue&type=template&id=1796fb52&scoped=true&lang=pug&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Venda_vue_vue_type_template_id_1796fb52_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_pug_plain_loader_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_Venda_vue_vue_type_template_id_1796fb52_scoped_true_lang_pug___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=venda.js.map