<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/LiderCTR.class.php');

$liderCTR = new LiderCTR();

echo $liderCTR->dados($versao);