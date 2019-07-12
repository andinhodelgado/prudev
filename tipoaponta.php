<?php

require('./dao/TipoApontaDAO.class.php');

$tipoApontaDAO = new TipoApontaDAO();

//cria o array associativo
$dados = array("dados"=>$tipoApontaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
