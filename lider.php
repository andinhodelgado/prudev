<?php

require('./dao/LiderDAO.class.php');

$liderDAO = new LiderDAO();

//cria o array associativo
$dados = array("dados"=>$liderDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
