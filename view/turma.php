<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/TurmaCTR.class.php');

$turmaCTR = new TurmaCTR();

echo $turmaCTR->dados($versao);
