<?php

require('./control/TipoApontaCTR.class.php');

$tipoApontaCTR = new TipoApontaCTR();

echo $tipoApontaCTR->dados();
