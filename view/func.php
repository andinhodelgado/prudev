<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/FuncCTR.class.php');

$funcCTR = new FuncCTR();

echo $funcCTR->dados($versao);
