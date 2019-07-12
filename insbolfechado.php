<?php

require('./dao/InsBolFechadoDAO.class.php');

$insBolFechadoDAO = new InsBolFechadoDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"boletim":[{"dthrFimBoletim":"29/11/2017 09:27","dthrInicioBoletim":"29/11/2017 09:22","idBoletim":1,"idExtBoletim":12,"idLiderBoletim":115232,"idTurmaBoletim":169,"statusBoletim":2}]}_{"aponta":[]}|{"alocafunc":[]}';
    
    $dados = $info['dado'];
    $pos1 = strpos($dados, "_") + 1;
    $pos2 = strpos($dados, "|") + 1;
    $c = substr($dados, 0, ($pos1 - 1));
    $a = substr($dados, $pos1, (($pos2 - 1) - $pos1));
    $af = substr($dados, $pos2);
    
    $jsonObjBoletim = json_decode($c);
    $jsonObjAponta = json_decode($a);
    $jsonObjAlocaFunc = json_decode($af);
    $dadosBoletim = $jsonObjBoletim->boletim;
    $dadosAponta = $jsonObjAponta->aponta;
    $dadosAlocaFunc = $jsonObjAlocaFunc->alocafunc;

    $insBolFechadoDAO->salvarDados($dadosBoletim, $dadosAponta, $dadosAlocaFunc);

endif;

echo 'GRAVOU-BOLFECHADO';