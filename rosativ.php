<?php

require('./dao/ROSAtivDAO.class.php');

$rOSAtivDAO = new ROSAtivDAO();

//cria o array associativo
$dados = array("dados"=>$rOSAtivDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
