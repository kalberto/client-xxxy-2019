<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "auth"],function (){
	Route::post("login", "Fastpack\AuthController@login")->name('login');
	Route::group(['middleware' => ['auth:api']], function (){
		Route::get("logout", "Fastpack\AuthController@logout")->name('logout');
	});
});

Route::group(['middleware' => ['auth:api']], function (){

	Route::get("dashboard", "Fastpack\DashboardController@dashboard");

	Route::get("predios", "Fastpack\PredioController@index");
	Route::post("predios", "Fastpack\PredioController@store");
	Route::get("predios/relatorio", "Fastpack\PredioController@relatorio");
	Route::get("predios/{id}", "Fastpack\PredioController@show")->where('id', '[0-9]+');
	Route::post("predios/{id}", "Fastpack\PredioController@update")->where('id', '[0-9]+');
	Route::patch("predios/{id}/abordar", "Fastpack\PredioController@abordar");
	Route::get("predios/{id}/ativo", "Fastpack\PredioController@active")->where('id', '[0-9]+');
	Route::post("predios/upload", "Fastpack\PredioController@upload");
	Route::get("predios/select","Fastpack\PredioController@getForSelect");

	Route::get("usuarios/consultores","Fastpack\UsuarioController@consultores");

	Route::get("clientes", "Fastpack\ClienteController@index");
	Route::post("clientes", "Fastpack\ClienteController@store");
	Route::get("clientes/relatorio", "Fastpack\ClienteController@relatorio");
	Route::get("clientes/{documento}", "Fastpack\ClienteController@show")->where('documento', '[0-9]+');
	Route::post("clientes/{documento}", "Fastpack\ClienteController@update")->where('documento', '[0-9]+');
	Route::get("clientes/{documento}/verify", "Fastpack\ClienteController@verify")->where('documento', '[0-9]+');
	Route::get("clientes/{documento}/predios", "Fastpack\ClienteController@predios")->where('documento', '[0-9]+');
	Route::get("clientes/{documento}/empreendimentos", "Fastpack\ClienteController@empreendimentos")->where('documento', '[0-9]+');
	Route::get("clientes/{documento}/predios/{id}", "Fastpack\ClienteController@predio")->where('documento', '[0-9]+');
	Route::get("clientes/{documento}/empreendimentos/{id}", "Fastpack\ClienteController@empreendimento")->where('documento', '[0-9]+');

	Route::post("clientes/upload", "Fastpack\ClienteController@upload");
	Route::get("clientes/select","Fastpack\ClienteController@getForSelect");
	Route::get("produtos", "Fastpack\ProdutoController@index");
	Route::get("produtos/{id}/ativo", "Fastpack\ProdutoController@active")->where('id', '[0-9]+');
	Route::get("produtos/tipos", "Fastpack\ProdutoController@tipos");

	Route::get("prospeccoes", "Fastpack\ProspeccaoController@index");
	Route::get("prospeccoes/status", "Fastpack\ProspeccaoController@status");
	Route::get("prospeccoes/relatorio", "Fastpack\ProspeccaoController@relatorio");
	Route::get("prospeccoes/status-negociacao", "Fastpack\ProspeccaoController@statusNegociacao");
	Route::get("prospeccoes/venda-perdida/motivos", "Fastpack\ProspeccaoController@vendaPerdidaMotivos");
	Route::post("prospeccoes", "Fastpack\ProspeccaoController@store");
	Route::get("prospeccoes/{codigo}", "Fastpack\ProspeccaoController@show");
	Route::post("prospeccoes/{codigo}", "Fastpack\ProspeccaoController@update");
	//Route::get("prospeccoes/{codigo}/rejeitar","Fastpack\ProspeccaoController@reject");

	Route::get("vendas","Fastpack\VendaController@index");
	Route::get("vendas/contratadas","Fastpack\VendaController@contratadas");
	Route::get("vendas/vencimentos","Fastpack\VendaController@vencimentos");
	Route::get("vendas/ciclos","Fastpack\VendaController@ciclos");
	Route::get("vendas/relatorio", "Fastpack\VendaController@relatorio");
	Route::post("vendas/{codigo}/converter","Fastpack\VendaController@store");
	Route::get("vendas/{codigo}","Fastpack\VendaController@show");
	Route::get("vendas/{codigo}/generate","Fastpack\VendaController@generateContrato");
	Route::get("vendas/{codigo}/checklist","Fastpack\VendaController@generateChecklist");
	Route::get("vendas/{codigo}/rejeitar","Fastpack\VendaController@reject");
	Route::get("vendas/{codigo}/documentos/{nome}","Fastpack\VendaController@downloadDocumento");
	Route::post("vendas/{codigo}","Fastpack\VendaController@update");
	Route::post("vendas/{codigo}/upload","Fastpack\VendaController@uploadDocumento");
	Route::post("vendas/{codigo}/aprovar","Fastpack\VendaController@conclude");

	Route::get("auditorias","Fastpack\AuditoriaController@index");
	Route::post("vendas/{codigo}/auditar","Fastpack\AuditoriaController@store");
	Route::get("auditorias/relatorio", "Fastpack\AuditoriaController@relatorio");
	Route::get("auditorias/{id}","Fastpack\AuditoriaController@show")->where('id', '[0-9]+');
	Route::post("auditorias/{id}/go","Fastpack\AuditoriaController@go")->where('id', '[0-9]+');
	Route::post("auditorias/{id}/nogo","Fastpack\AuditoriaController@noGo")->where('id', '[0-9]+');

	Route::get("empreendimentos", "Fastpack\EmpreendimentoController@index");
	Route::post("empreendimentos", "Fastpack\EmpreendimentoController@store");
	Route::get("empreendimentos/relatorio", "Fastpack\EmpreendimentoController@relatorio");
	Route::get("empreendimentos/{id}", "Fastpack\EmpreendimentoController@show")->where('id', '[0-9]+');
	Route::post("empreendimentos/{id}", "Fastpack\EmpreendimentoController@update")->where('id', '[0-9]+');
	Route::patch("empreendimentos/{id}/abordar", "Fastpack\EmpreendimentoController@abordar");
	Route::get("empreendimentos/{id}/ativo", "Fastpack\EmpreendimentoController@active")->where('id', '[0-9]+');
	Route::get("empreendimentos/select","Fastpack\EmpreendimentoController@getForSelect");

	//GENERICOS
	Route::get("localizacao/ufs","Fastpack\LocalizacaoController@ufs");
	Route::get("localizacao/ufs/{uf}/cidades","Fastpack\LocalizacaoController@cidades");
});

Route::group([], function () {

	Route::get("predios/download", "Fastpack\PredioController@download");
	Route::get("clientes/download", "Fastpack\ClienteController@download");

});

