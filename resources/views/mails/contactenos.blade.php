<html>
    <head>
        <title>Contacto</title>
    </head>
    <body>
        <h2>Nuevo mensaje</h2>
        El usuario: {{$data['uname']}} se contacta para lo siguiente:{{$data['asunto']}}
        <br>
        <h3>Mensaje:</h3>
        <br>
        <p>{{$data['mensaje']}}</p>

    </body>
</html>


