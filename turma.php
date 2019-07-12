<?php

require('./dao/TurmaDAO.class.php');

$turmaDAO = new TurmaDAO();

//cria o array associativo
$dados = array("dados"=>$turmaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
