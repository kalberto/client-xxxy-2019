<style>
    ._5 { width: 5%; }
    ._10 { width: 10%; }
    ._15 { width: 15%; }
    ._20 { width: 20%; }
    ._25 { width: 25%; }
    ._30 { width: 30%; }
    ._35 { width: 35%; }
    ._40 { width: 40%; }
    ._45 { width: 45%; }
    ._50 { width: 50%; }
    ._55 { width: 55%; }
    ._60 { width: 60%; }
    ._65 { width: 65%; }
    ._70 { width: 70%; }
    ._75 { width: 75%; }
    ._80 { width: 80%; }
    ._85 { width: 85%; }
    ._90 { width: 90%; }
    ._95 { width: 95%; }
    ._100 { width: 100%; }
</style>

<style>
    *, *:before, *:after {
        box-sizing: border-box;
    }

    body {
        max-width: 715px;
        margin: 0 auto;
        font-size: 16px;
        font-family: Arial, Helvetica, sans-serif;
        font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
    }

    .mainHeader {
        display: flex; justify-content: space-between; align-items: center;
    }

    .page {
        border: 3px solid #000;
        padding: 5px;
    }

    .break {
        page-break-after: always;
    }

    .flex {
        display: flex;
        flex-flow: row wrap;
    }

    .conteudo {
        padding: 10px 10px 5px;;
    }

    .box {
        border: 1px solid #000;
    }

    .box.pb h2 {
        background: #3a3a3a;
    }

    .box.cb h2 {
        background: #ccc;
        color: #000;
    }

    .box > .box {
        border: none;
        border-top: 1px solid #000;
    }

    .box .conteudo {
        padding: 5px 20px 0 20px;
    }

    .input, .check {
        padding: 0 0 0 20px;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
    }

    .input label, .check label {
        font-size: .75rem;
    }

    .input label {
        text-align: right;
        margin-right: 10px;
        white-space: nowrap;
    }

    .input span {
        border: 2px solid #000;
        padding: 0 5px;
        font-size: .75rem;
        line-height: 16px;
        display: inline-block;
        height: 20px;
        width: 100%;
    }

    .check-group {
        align-items: center;
    }

    .check {
        justify-content: center;
    }

    .check label {
        font-weight: 700;
        margin-left: 10px;
    }

    .check span {
        border: 2px solid #000;
        padding: 0 5px;
        font-size: .75rem;
        width: 20px;
        text-align: center;
        text-transform: uppercase;
        line-height: 16px;
        font-weight: 700;
        height: 20px;
        display: inline-block;
    }

    .mainHeader {
        padding: 5px;
        border: 2px solid #000;
    }

    h1, h2, h3, h4, h5, h6 {
        text-transform: uppercase;
        font-weight: 700;
        text-align: center;
        margin: 0;
    }

    p {
        margin: 0;
        font-size: .875rem;
        line-height: .875rem;
    }

    h1 {
        font-size: 1rem;
    }

    h2 {
        font-size: .875rem;
        background: #910a0a;
        color: #fff;
        padding: 5px 0;
    }

    ol {
        margin: 0;
        font-size: .625rem;
        padding-left: 0;
    }

    .observacoes.box .conteudo {
        padding: 5px 20px;
    }

    .faixa {
        align-items: center;
    }

    .faixa .input, .faixa .check, .faixa .check-group {
        padding-left: 5px;
    }

    .pacotes .conteudo, .svas .conteudo {
        padding: 5px 20px;
        justify-content: space-between;
    }

    .svas .conteudo {
        padding: 5px 20px 0;
    }

    .pacotes .pacote, .svas .pacote {
        border: 1px solid #000;
        padding: 10px;
    }

    .svas .pacote {
        align-self: flex-start;
    }

    .svas .input {
        padding: 0;
    }

    .svas .input label {
        text-align: center;
    }

    .pacotes p, .svas p {
        padding: 2px 0;
        text-align: center;
    }

    .pacotes .titulo {
        border-bottom: 1px solid #000;
    }

    .pacotes .check, .svas .check {
        padding: 0;
        justify-content: flex-start;
    }

    .pacotes .total {
        font-weight: 700;
        text-align: center;
        padding: 0;
    }

    .svas .check {
        padding: 0 0 0 5px
    }

    .svas .emailEnvio {
        margin-top: -20px;
    }

    .assinatura {
        text-align: center;
    }

    .assinatura hr {
        margin: 24px 0 8px;
        border-color: #000;
    }

    .contratante .conteudo {
        justify-content: center;
    }

    .testemunha {
        padding: 5px 0;
        justify-content: center;
    }

    .testemunha p {
        margin-bottom: 5px;
    }

    .testemunha .assinatura {
        align-items: flex-end;
    }

    .testemunha .assinatura hr {
        margin-bottom: 0;
    }

    table {
        font-size: .75rem;
        width: 100%;
        text-align: left;
    }

    th {
        font-weight: 400;
    }

    table .check {
        padding: 0;
    }

    .cnpjEndereco {
        border: 1px solid #000;
        padding: 0 10px;
    }

    .xxxx .conteudo {
        justify-content: center;
    }

    .noIdentificacao {
        margin-top: 10px;
    }

    .observacoesCheck .conteudo {
        padding: 5px 20px;
    }

    .observacoesCheck p {
        font-size: .75rem;
    }

    .chamadasBloqueio p {
        margin-bottom: 10px;
    }

    .chamadasBloqueio .conteudo {
        padding: 5px;
    }

    .chamadasBloqueio .check {
        padding-left: 5px;
    }

    .direcionamento .check, .direcionamento .input {
        padding: 0 5px;
        margin: 0;
    }

    .direcionamento th {
        text-align: center;
        font-size: .6rem;
        font-weight: 700
    }

    .topLabel label {
        text-align: center;
    }

    .topLabel span {
        text-align: center;
    }
</style>
