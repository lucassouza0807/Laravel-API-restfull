<?php 

$dados = [
    "nome" => "lucas",
    "senha" => "MD11nice"
];

$ss = base64_encode(json_encode(["dados" =>$dados]));


echo base64_encode($_ENV['API_SECRET']);