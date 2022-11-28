<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body>

    <div class="container h-[900px] w-[700px] flex flex-col justify-center items-center">
        <h1 class="text-[2rem]">Registrar produto falso </h1>
        <form class="flex flex-col" method="post" action="/fake/register.product">
            @csrf
            <button class="bg-black w-[300px] text-white rounded-lg flex flex-row items-center justify-center font-bold mt-3 h-[40px]">Rodar mock</button>
        </form>
    </div>
</body>

</html>
