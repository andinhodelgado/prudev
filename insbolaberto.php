<?php

require('./dao/InsBolAbertoDAO.class.php');

$insBolAbertoDAO = new InsBolAbertoDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$retorno = '';

if (isset($info)):

    //$dados = '{"boletim":[{"dthrInicioBoletim":"28/11/2017 10:48","idBoletim":1,"idExtBoletim":0,"idLiderBoletim":115232,"idTurmaBoletim":169,"statusBoletim":1}]}_{"aponta":[]}|{"alocafunc":[{"codFuncionarioAlocaFunc":18754,"dthrAlocaFunc":"28/11/2017 10:48","idAlocaFunc":1,"idBolAlocaFunc":1,"idExtBolAlocaFunc":0,"tipoAlocaFunc":1},{"codFuncionarioAlocaFunc":111295,"dthrAlocaFunc":"28/11/2017 10:48","idAlocaFunc":2,"idBolAlocaFunc":1,"idExtBolAlocaFunc":0,"tipoAlocaFunc":1}]}';
    
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
    
    $retorno = $insBolAbertoDAO->salvarDados($dadosBoletim, $dadosAponta, $dadosAlocaFunc);

endif;

echo $retorno;