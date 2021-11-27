<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>xxxx Telecom - Termo de Contratação</title>
        @include('documents.style')
    </head>
    <body>
        <div class="page">
            <header class="mainHeader">
                <img src="{{ url('images/web/logo/logo-longa.svg') }}" alt="xxxx Telecom" class="logo xxxx" width="100">
                <h1>Termo de contratação de Serviços Fastpack</h1>
                <img src="{{ url('images/web/logo/logo-longa.svg') }}" alt="Fastpack xxxx" class="logo fastpack" width="100">
            </header>

            <section class="identificacao">
                <div class="conteudo flex">
                    <div class="input _65">
                        <label>Formulário Número</label>
                        <span class="valor">{{$venda['codigo']}}</span>
                    </div>
                    <div class="input _35">
                        <label>Data de Emissão</label>
                        <span class="valor">{{date("d/m/Y H:i:s")}}</span>
                    </div>
                    <div class="input _80">
                        <label>Consultor de Vendas</label>
                        <span class="valor"> {{$venda['consultor']}} </span>
                    </div>
                </div>
            </section>

            <section class="box">
                <h2>Serviços solicitados</h2>
                <div class="conteudo">
                    <div class="check">
                        <span>  </span>
                        <label>Ativação</label>
                    </div>
                </div>
            </section>

            <section class="box">
                <h2>Contratante</h2>
                <div class="conteudo flex">
                    <div class="input _100">
                        <label>Nome</label>
                        <span class="valor"> {{$cliente['nome']}}  </span>
                    </div>
                    <div class="input _50">
                        <label>Documento</label>
                        <span class="valor"> {{$cliente['documento']}} </span>
                    </div>
                    <div class="input _50">
                        <label>Inscrição estadual</label>
                        <span class="valor"> {{$cliente['ie']}} </span>
                    </div>
                    <div class="input _75">
                        <label>Endereço documento</label>
                        <span class="valor"> {{$cliente['logradouro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>Número</label>
                        <span class="valor"> {{$cliente['numero']}} </span>
                    </div>
                    <div class="input _40">
                        <label>Complemento</label>
                        <span class="valor"> {{$cliente['complemento']}} </span>
                    </div>
                    <div class="input _35">
                        <label>Bairro</label>
                        <span class="valor"> {{$cliente['bairro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>CEP</label>
                        <span class="valor"> {{$cliente['cep']}} </span>
                    </div>
                    <div class="input _70">
                        <label>Cidade</label>
                        <span class="valor"> {{$cliente['cidade']}} </span>
                    </div>
                    <div class="input _20">
                        <label>UF</label>
                        <span class="valor"> {{$cliente['uf']}} </span>
                    </div>
                </div>
                <div class="box">
                    <div class="conteudo flex">
                        <p class="_100">Contato Comercial</p>
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

            <section class="box">
                <h2>Fatura</h2>
                <div class="conteudo flex">
                    <div class="check-group flex">
                        <p>Dia do Vencimento</p>
                        <div class="check">
                            <span> {{$venda['vencimento'] == '02' ? 'X' : ''}} </span>
                            <label>02</label>
                        </div>
                        <div class="check">
                            <span> {{$venda['vencimento'] == '08' ? 'X' : ''}} </span>
                            <label>08</label>
                        </div>
                        <div class="check">
                            <span> {{$venda['vencimento'] == '16' ? 'X' : ''}} </span>
                            <label>16</label>
                        </div>
                        <div class="check">
                            <span> {{$venda['vencimento'] == '22' ? 'X' : ''}} </span>
                            <label>22</label>
                        </div>
                    </div>
                    <div class="input _100">
                        <label>E-mail para envio da fatura</label>
                        <span class="valor"> {{$venda['email_fatura']}} </span>
                    </div>
                    <div class="input _75">
                        <label>Endereço correspondência</label>
                        <span class="valor"> {{$endereco_correspondencia['logradouro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>Número</label>
                        <span class="valor"> {{$endereco_correspondencia['numero']}} </span>
                    </div>
                    <div class="input _40">
                        <label>Complemento</label>
                        <span class="valor"> {{$endereco_correspondencia['complemento']}} </span>
                    </div>
                    <div class="input _35">
                        <label>Bairro</label>
                        <span class="valor"> {{$endereco_correspondencia['bairro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>CEP</label>
                        <span class="valor"> {{$endereco_correspondencia['cep']}} </span>
                    </div>
                    <div class="input _70">
                        <label>Cidade</label>
                        <span class="valor"> {{$endereco_correspondencia['cidade']}} </span>
                    </div>
                    <div class="input _20">
                        <label>UF</label>
                        <span class="valor"> {{$endereco_correspondencia['uf']}} </span>
                    </div>
                </div>
            </section>

            <section class="box pacotes">
                <h2>Planos de serviço/pacotes</h2>
                <div class="conteudo flex">
                    @foreach  ($produtos_internet as $produto)
                        <div class="pacote _30">
                            <div class="check">
                                <span> {{($venda['pacotes']['pacote'] == $produto->id) ? 'X' : '' }} </span>
                                <label>{{$produto->nome}}</label>
                            </div>
                            <p class="titulo">{{$produto->extra}}</p>
                            <p>Voz - Linhas</p>
                            <div class="check">
                                <span> {{($venda['pacotes']['pacote'] == $produto->id && isset($venda['pacotes']['voz']['analogica'])) ? $venda['pacotes']['voz']['analogica'] : ''}} </span>
                                <label>Analógicas (até 2)</label>
                            </div>
                            <div class="check">
                                <span> {{($venda['pacotes']['pacote'] == $produto->id && isset($venda['pacotes']['voz']['sip'])) ? $venda['pacotes']['voz']['sip'] : ''}} </span>
                                <label>Canais SIP (até 5)</label>
                            </div>
                            <div class="check">
                                <span> {{($venda['pacotes']['pacote'] == $produto->id && isset($venda['pacotes']['voz']['digital'])) ? $venda['pacotes']['voz']['digital'] : ''}} </span>
                                <label>Canais R2/ISDN (até 5)</label>
                            </div>
                            <div class="input total">
                                <label>Valor:</label>
                                <span class="valor"> {{($venda['pacotes']['pacote'] == $produto->id) ? $venda['pacotes']['valor'] : ''}} </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="box">
                <h2>Numeração</h2>
                <div class="conteudo flex">
                    <div class="check-group flex _60">
                        <p>Identificação (SIP ou R2/ISDN)</p>
                        <div class="input">
                            <span> {{$venda['pacotes']['voz']['tecnologia'] == "Digital" ? $venda['pacotes']['voz']['tecnologia']->identificacao->ramal : ''}} </span>
                            <label>Ramal</label>
                        </div>
                        <div class="check">
                            <span> {{$venda['pacotes']['voz']['tecnologia'] == "Digital" ? $venda['pacotes']['voz']['tecnologia']->identificacao->piloto ? 'X' : '' : ''}} </span>
                            <label>Piloto</label>
                        </div>
                    </div>
                    <div class="input _40">
                        <label>Número Piloto</label>
                        <span class="valor"> {{$venda['pacotes']['voz']['tecnologia'] == "Digital" ? $venda['pacotes']['voz']['tecnologia']->identificacao->piloto : ''}} </span>
                    </div>
                    @for ($i = 0; $i < 5; $i++)
                        <div class="faixa _100 flex">
                            <div class="input _25">
                                <label>Inicial</label>
                                <span class="valor"> {{isset($venda['pacotes']['voz']['numeros'][$i]) ? $venda['pacotes']['voz']['numeros'][$i]->inicial : '' }} </span>
                            </div>
                            <div class="input _25">
                                <label>Final</label>
                                <span class="valor"> {{isset($venda['pacotes']['voz']['numeros'][$i]) ? $venda['pacotes']['voz']['numeros'][$i]->final : '' }} </span>
                            </div>
                            <div class="check-group flex _30">
                                <p>Portado</p>
                                <div class="check">
                                    <span> {{isset($venda['pacotes']['voz']['numeros'][$i]) && $venda['pacotes']['voz']['numeros'][$i]->portado == 'sim' ? 'X' : '' }} </span>
                                    <label>Sim</label>
                                </div>
                                <div class="check">
                                    <span> {{isset($venda['pacotes']['voz']['numeros'][$i]) && $venda['pacotes']['voz']['numeros'][$i]->portado != 'sim' ? 'X' : '' }} </span>
                                    <label>Não</label>
                                </div>
                            </div>
                            <div class="input _20">
                                <span class="valor"> {{isset($venda['pacotes']['voz']['numeros'][$i]) && $venda['pacotes']['voz']['numeros'][$i]->portado == 'sim' ? $venda['pacotes']['voz']['numeros'][$i]->operadora_doadora : '' }} </span>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>
        </div>

        <div class="break"></div>

        <div class="page">
            <section class="box svas">
                <h2>SVA - Serviço de Valor Agregado</h2>
                <div class="conteudo flex">
                    <div class="pacote _30">
                        <p>CloudBackup</p>
                        @foreach($produtos_bkp as $produto)
                            @if(isset($venda['cloudbackup']))
                            <div class="check">
                                <span> {{$produto->id == $venda['cloudbackup']['produto_id'] ? 'X' : ''}} </span>
                                <label>{{$produto->nome.($produto->id == $venda['cloudbackup']['produto_id'] ? ' - '.$venda['cloudbackup']['valor'] : '')}}</label>
                            </div>
                            @else
                                <div class="check">
                                    <span>  </span>
                                    <label>{{$produto->nome}}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if(isset($venda['smartbox']))
                        <div class="pacote _30">
                            <div class="check">
                                <span> X </span>
                                <label>SmartBox</label>
                            </div>
                            <div class="input">
                                <label>Qtde. Ramais (até 5)</label>
                                <span class="valor"> {{$venda['smartbox']['quantidade_ramais']}} </span>
                            </div>
                            <p>{{$venda['smartbox']['valor']}}</p><!-- por Ramal-->
                        </div>
                    @else
                        <div class="pacote _30">
                            <div class="check">
                                <span>  </span>
                                <label>SmartBox</label>
                            </div>
                            <div class="input">
                                <label>Qtde. Ramais (até 5)</label>
                                <span class="valor">  </span>
                            </div>
                            <p></p><!-- por Ramal-->
                        </div>
                    @endif

                    @if(isset($venda['0800']))
                        <div class="pacote _30">
                            <div class="check">
                                <span> X </span>
                                <label>0800{{' - '.$venda['0800']['valor']}}</label>
                            </div>
                            <div class="input">
                                <label>Nº 0800</label>
                                <span class="valor"> {{$venda['0800']['numero']}} </span>
                            </div>
                            <div class="input flex">
                                <label class="_100">Nº Encaminhamento</label>
                                <span class="valor"> {{$venda['0800']['numero_encaminhamento']}} </span>
                            </div>
                            <div class="check-group flex">
                                <p>Portado</p>
                                <div class="check">
                                    <span> {{$venda['0800']['portado'] == 'sim' ? 'X': ''}} </span>
                                    <label>Sim</label>
                                </div>
                                <div class="check">
                                    <span> {{$venda['0800']['portado'] != 'sim' ? 'X': ''}} </span>
                                    <label>Não</label>
                                </div>
                            </div>
                            <div class="input">
                                <label>Operadora</label>
                                <span class="valor"> {{$venda['0800']['operadora_doadora'] == 'sim' ? 'X': ''}} </span>
                            </div>
                        </div>
                    @else
                        <div class="pacote _30">
                            <div class="check">
                                <span>  </span>
                                <label>0800</label>
                            </div>
                            <div class="input">
                                <label>Nº 0800</label>
                                <span class="valor">  </span>
                            </div>
                            <div class="input flex">
                                <label class="_100">Nº Encaminhamento</label>
                                <span class="valor">  </span>
                            </div>
                            <div class="check-group flex">
                                <p>Portado</p>
                                <div class="check">
                                    <span>  </span>
                                    <label>Sim</label>
                                </div>
                                <div class="check">
                                    <span>  </span>
                                    <label>Não</label>
                                </div>
                            </div>
                            <div class="input">
                                <label>Operadora</label>
                                <span class="valor">  </span>
                            </div>
                        </div>
                    @endif



                    <div class="input _65 emailEnvio">
                        <label>E-mail para envio do login</label>
                        <span class="valor"> {{isset($venda['cloudbackup']) ? $venda['cloudbackup']['email'] : ''}} </span>
                    </div>
                </div>
            </section>

            <section class="box">
                <h2>CPVI - Campanha Promocional de Vendas</h2>
                <div class="conteudo">
                    <div class="input">
                        <label>CPVI</label>
                        <span class="valor"> {{$venda['campanha']}} </span>
                    </div>
                </div>
            </section>

            <section class="box observacoes">
                <h2>Observações Gerais</h2>
                <div class="conteudo">
                    <ol type="I">
                        <li>Os valores expressos neste documento estão com impostos (ICMS + PIS + COFINS).</li>
                        <li>
                            O cliente, neste ato, declara que conhece e concorda, que este instrumento é parte integrante e vinculada ao CONTRATO DE ADESÃO
                            DE PRESTAÇÃO DO SERVIÇO TELEFÔNICO FIXO COMUTADO (STFC), DO SERVIÇO DE COMUNICAÇÃO MULTIMÍDIA (SCM) e SERVIÇO DE VALOR ADICIONADO (SVA),
                            registrado no 4º Ofício de Registro de Títulos e Documentos e Civil das Pessoas Jurídicas de Curitiba/PR, sob o nº 590560 e suas alterações
                            posteriores, comprometendo-se a cumpri-lo integralmente, assim como o Plano de Serviço indicado neste formulário, tendo pleno conhecimento
                            de todas as cláusulas e condições deste Termo e seus Anexos, quando aplicável, dos folhetos explicativos de serviços, preços e promoções, da
                            área de cobertura e das condições técnicas de contratação e uso dos serviços solicitados.
                        </li>
                        <li>A oferta contratada visa fornecer ao CONTRATANTE a fruição de velocidade de upload no percentual de 50% da velocidade de download.</li>
                    </ol>
                </div>
            </section>

            <section class="box">
                <h2>Endereço de Instalação</h2>
                <div class="conteudo flex">
                    <div class="input _75">
                        <label>Endereço de Instalação</label>
                        <span class="valor"> {{$endereco_predio['logradouro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>Número</label>
                        <span class="valor"> {{$endereco_predio['numero']}} </span>
                    </div>
                    <div class="input _40">
                        <label>Complemento</label>
                        <span class="valor"> {{$endereco_predio['complemento'].' - '.$cliente['predio_complemento']}} </span>
                    </div>
                    <div class="input _35">
                        <label>Bairro</label>
                        <span class="valor"> {{$endereco_predio['bairro']}} </span>
                    </div>
                    <div class="input _25">
                        <label>CEP</label>
                        <span class="valor"> {{$endereco_predio['cep']}} </span>
                    </div>
                    <div class="input _70">
                        <label>Cidade</label>
                        <span class="valor"> {{$endereco_predio['cidade']}} </span>
                    </div>
                    <div class="input _20">
                        <label>UF</label>
                        <span class="valor"> {{$endereco_predio['uf']}} </span>
                    </div>
                </div>
            </section>

            <section class="box contratante">
                <h2>Representante Legal do Contratante</h2>
                <div class="conteudo flex">
                    <div class="input _65">
                        <label>Nome</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _35">
                        <label>CPF</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="assinatura _60">
                        <hr>
                        <span>Assinatura do Contratante</span>
                    </div>
                    @for ($i = 0; $i < 2; $i++)
                        <div class="testemunha _50 flex">
                            <p>Testemunha 0{{$i+1}}</p>
                            <div class="input _100">
                                <label>Nome</label>
                                <span class="valor">  </span>
                            </div>
                            <div class="input _100">
                                <label>CPF</label>
                                <span class="valor">  </span>
                            </div>
                            <div class="assinatura _100 flex">
                                <span>Assinatura</span>
                                <hr class="_70">
                            </div>
                        </div>
                    @endfor
                </div>
            </section>

            <section class="box pb">
                <h2>Contratada</h2>
                <div class="conteudo">
                    <div class="input">
                        <label>Contratada</label>
                        <span class="valor"> {{$contratada->nome}} </span>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>CNPJ</th>
                                <th>Endereço xxxx</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratadas as $filial)
                                <tr>
                                    <td>
                                        <div class="check">
                                            <span> {{$filial['id'] == $venda['contratada_filial_id'] ? 'X' : ''}} </span>
                                            <label>{{$filial['nome']}}</label>
                                        </div>
                                    </td>
                                    <td colspan="2" class="cnpjEndereco">
                                        {{$filial->cnpj.'  '.$filial->endereco->logradouro.','.$filial->endereco->numero.(($filial->endereco->complemento != '') ? (', '.$filial->endereco->complemento) : '').' - '.$filial->endereco->bairro.' - CEP: '. $filial->endereco->cep }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="box pb xxxx">
                <h2>Representante Legal da xxxx Telecomunicações e Tecnologia S.A</h2>
                <div class="conteudo flex">
                    <div class="input _65">
                        <label>Nome</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="input _35">
                        <label>CPF</label>
                        <span class="valor">  </span>
                    </div>
                    <div class="assinatura">
                        <hr>
                        <span>Assinatura</span>
                        <p>xxxx TELECOMUNICAÇÕES E TECNOLOGIA S.A</p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
