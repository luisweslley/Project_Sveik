<!DOCTYPE html>
<html>
{{-- <head>
    <title>Determinados</title>
    <meta charset="utf-8">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            margin: auto;
            width: 80%;
            font-family: "Nunito", sans-serif;
            font-size: 12px;
            display: flex;
            justify-content: center;
            background-color: #e1e1e1;
        }
        main {
            width: 510px;
        }
        h1 {
            font-size: 20px;
            font-weight: normal;
        }
        h2 {
            font-size: 16px;
            font-weight: normal;
        }
        h1 strong {
            color: #05879d;
        }
    </style>
</head> --}}
<body>
    <main>
        <h1>
            Olá {{$nome}}, esse é o email de confirmação de cadastro Sveik.
        </h1>
        <br>
        <h2>
            Link: {{$link}}
        </h2>
        <br>
    </main>
</body>
</html>
