@php
    $valores = [11,12,13,14,15,16,17,18,19,21,22,24,27,28,31,32,33,34,35,37,38,41,42,43,44,45,46,47,48,49,51,53,54,55,61,62,63,64,65,66,67,68,69,71,73,74,75,77,79,81,82,83,84,85,86,87,88,89,91,92,93,94,95,96,97,98,99];
    $valores2 = $valores;
@endphp

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>xxxx Telecom - Checklist Smartbox e 0800</title>
        @include('documents.style')
    </head>
    <body>
        <div class="page">
            <header class="mainHeader">
                <img src="{{ url('images/web/logo/logo-longa.svg') }}" alt="xxxx Telecom" class="logo xxxx" width="100">
                <h1>Checklist Smartbox e 0800</h1>
                <img src="{{ url('images/web/logo/logo-longa.svg') }}" alt="Fastpack xxxx" class="logo fastpack" width="100">
            </header>

            <section class="box noIdentificacao">
                <h2>Contratante</h2>
                <div class="conteudo flex">
                    <div class="input _55">
                        <label>Nome</label>
                        <span class="valor"> {{$cliente['nome']}} </span>
                    </div>
                    <div class="input _45">
                        <label>Documento</label>
                        <span class="valor"> {{$cliente['documento']}} </span>
                    </div>
                    <div class="input _75">
                        <label>Endereço de Instalação</label>
                        <span class="valor"> {{$endereco['logradouro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>Número</label>
                        <span class="valor"> {{$endereco['numero']}} </span>
                    </div>
                    <div class="input _40">
                        <label>Complemento</label>
                        <span class="valor"> {{$endereco['complemento'].' - '.$cliente['predio_complemento']}} </span>
                    </div>
                    <div class="input _35">
                        <label>Bairro</label>
                        <span class="valor"> {{$endereco['bairro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>CEP</label>
                        <span class="valor"> {{$endereco['cep']}}  </span>
                    </div>
                    <div class="input _70">
                        <label>Cidade</label>
                        <span class="valor"> {{$endereco['cidade']}} </span>
                    </div>
                    <div class="input _20">
                        <label>UF</label>
                        <span class="valor"> {{$endereco['uf']}} </span>
                    </div>
                </div>
                <div class="box">
                    <div class="conteudo flex">
                        <p class="_100">Contato</p>
                        <div class="input _45">
                            <label>Nome</label>
                            <span class="valor"> {{$contato_comercial->nome}} </span>
                        </div>
                        <div class="input _25">
                            <label>Celular</label>
                            <span class="valor"> {{$contato_comercial->celular}} </span>
                        </div>
                        <div class="input _30">
                            <label>Fixo</label>
                            <span class="valor"> {{$contato_comercial->telefone}} </span>
                        </div>
                        <div class="input _100">
                            <label>E-mail</label>
                            <span class="valor"> {{$contato_comercial->email}} </span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="box observacoesCheck">
                <h2>Observações</h2>
                <div class="conteudo flex">
                    <p></p>
                </div>
            </section>

            <section class="box">
                <h2>Checklist 0800</h2>
                <div class="conteudo flex">
                    <div class="input _50">
                        <label>Número 0800</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _50">
                        <label>Número de Encaminhamento</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="check-group flex _60">
                        <p>Bloqueio de chamadas</p>
                        <div class="check">
                            <span>  </span>
                            <label>Fixo</label>
                        </div>
                        <div class="check">
                            <span>  </span>
                            <label>Móvel</label>
                        </div>
                    </div>
                </div>
                <div class="box cb chamadasBloqueio">
                    <h2>Bloqueio de Chamadas Origem - Fixo</h2>
                    <div class="conteudo flex">
                        <p class="_100">Códigos de Área a bloquear</p>
                        @foreach ($valores as $i)
                            <div class="check">
                                <span>  </span>
                                <label>{{ $i }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="box cb chamadasBloqueio">
                    <h2>Bloqueio de Chamadas Origem - Móvel</h2>
                    <div class="conteudo flex">
                        <p class="_100">Códigos de Área a bloquear</p>
                        @foreach ($valores2 as $i)
                            <div class="check">
                                <span>  </span>
                                <label>{{ $i }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="box">
                <h2>Checklist - Configurações PABX - Link digital R2/ISDN</h2>
                <div class="conteudo flex">
                    <div class="input _100">
                        <label>Números parte do agrupamento</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _100">
                        <label>Marca e Modelo do PABX</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _100">
                        <label>Mantenedor PABX</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _55">
                        <label>Contato mantenedor</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _45">
                        <label>Telefone Mantenedor</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _100">
                        <label>Interface cliente</label>
                        <span class="valor">  </span>
                    </div>
                </div>
            </section>

            <section class="box">
                <h2>Produto Smartbox</h2>
                <div class="conteudo flex">
                    <div class="check-group flex">
                        <div class="check">
                            <span>  </span>
                            <label>URA</label>
                        </div>
                        <div class="check">
                            <span>  </span>
                            <label>Sala de Conferência</label>
                        </div>
                        <div class="check">
                            <span>  </span>
                        </div>
                        <div class="check">
                            <span>  </span>
                            <label>URA + Sala de Conferência</label>
                        </div>
                        <div class="check">
                            <span>  </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="break"></div>

        <div class="page">
            <section class="box cb">
                <h2>Smartbox - Configuração URA</h2>
                <div class="conteudo flex">
                    <div class="check-group flex _100">
                        <p>Mensagem de Atendimento</p>
                        <div class="check">
                            <span>  </span>
                            <label>Sim</label>
                        </div>
                        <div class="check">
                            <span>  </span>
                            <label>Não</label>
                        </div>
                        <div class="check flex">
                            <label>Quantidade de opções do menu</label>
                            <span>  </span>
                        </div>
                    </div>
                    @foreach ([1,6,2,7,3,8,4,9,5] as $i)
                        <div class="check-group flex _50">
                            <p> {{ $i }}. </p>
                            <div class="check">
                                <span>  </span>
                                <label>Ramal</label>
                            </div>
                            <div class="check">
                                <span>  </span>
                                <label>Grupo</label>
                            </div>
                            <div class="check flex">
                                <span>  </span>
                                <label>Mensagem</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="box cb">
                <h2>Smartbox - Configuração Sala de Conferência</h2>
                <div class="conteudo flex">
                    <div class="input _60">
                        <label>Sala 1. Número Chave sala</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _40">
                        <label>Senha</label>
                        <span class="valor">  </span>
                    </div>
                </div>
            </section>

            <section class="box cb">
                <h2>Domínio cliente</h2>
                <div class="conteudo flex">
                    <div class="input _60">
                        <label>Dominio do cliente</label>
                        <span class="valor">  </span>
                    </div>
                </div>
            </section>

            <section class="box cb">
                <h2>Smartbox - Direcionamento</h2>
                <div class="conteudo">
                    <table class="direcionamento">
                        <thead>
                            <tr>
                                <th width="50">Ramal</th>
                                <th width="100">DDR</th>
                                <th width="150">Hunt Group</th>
                                <th>
                                    Grupo URA
                                    <br>
                                    (1 a 9)
                                </th>
                                <th>Modo</th>
                                <th>Nome do ramal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 11; $i++)
                                <tr>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="check">
                                            <span>  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="check-group flex _100">
                                            <div class="check">
                                                <span>  </span>
                                                <label>Estatístico</label>
                                            </div>
                                            <div class="check">
                                                <span>  </span>
                                                <label>Paralelo</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="box cb">
                <h2>Smartbox - Equipamentos</h2>
                <div class="conteudo flex">
                    <div class="input flex _25 topLabel">
                        <label class="_100">TIPO</label>
                        <span class="valor"> IP </span>
                    </div>
                    <div class="input flex _25 topLabel">
                        <label class="_100">FABRICANTE</label>
                        <span class="valor"> Yealink </span>
                    </div>
                    <div class="input flex _25 topLabel">
                        <label class="_100">MODELO</label>
                        <span class="valor"> T19 </span>
                    </div>
                    <div class="input flex _25 topLabel">
                        <label class="_100">Quantidade</label>
                        <span class="valor">  </span>
                    </div>
                </div>
            </section>

            <section class="box">
                <h2>Range de numeração</h2>
                <div class="conteudo flex">
                    <table class="direcionamento">
                        <thead>
                            <tr>
                                <th width="50"></th>
                                <th width="100">Quantidade</th>
                                <th width="100">Inicial</th>
                                <th width="100">Final</th>
                                <th width="50">
                                    Portabilidade
                                    <br>
                                    (Sim ou Não)
                                </th>
                                <th>Prestadora doadora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 6; $i++)
                                <tr>
                                    <td>Range {{ $i }}</td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input">
                                            <span class="valor">  </span>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </body>
</html>
