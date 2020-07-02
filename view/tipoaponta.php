<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/TipoApontaCTR.class.php');

$tipoApontaCTR = new TipoApontaCTR();

echo $tipoApontaCTR->dados($versao);
