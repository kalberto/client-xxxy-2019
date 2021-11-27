<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$subject}}</title>
</head>
<body>

    <div style="font-size:12.8px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial;font-family:calibri,serif">
        <p>{{$mensagem}}</p>
        @if(isset($venda))
            <br>
            <a href="{{$venda}}">{{isset($codigo_venda) ? $codigo_venda : "Link venda"}}</a>
            <br>
        @endif
        <p><br><br><br>(Não Responder este E-<span class="il">Mail</span>) - {{date('d/m/Y')}} {{date('H:i:s')}}</p>
    </div>
</body>
</html>