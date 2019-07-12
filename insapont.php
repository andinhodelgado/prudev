<?php

require('./dao/InsApontDAO.class.php');

$insApontDAO = new InsApontDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$retorno = '';

if (isset($info)):

    $dados = $info['dado'];
    $pos1 = strpos($dados, "|") + 1;
    $a = substr($dados, 0, ($pos1 - 1));
    $af = substr($dados, $pos1);
    
    $jsonObjAponta = json_decode($a);
    $jsonObjAlocaFunc = json_decode($af);
    $dadosAponta = $jsonObjAponta->aponta;
    $dadosAlocaFunc = $jsonObjAlocaFunc->alocafunc;

    $insApontDAO->salvarDados($dadosAponta, $dadosAlocaFunc);
    
endif;

echo 'GRAVOU-APONTAMM';
