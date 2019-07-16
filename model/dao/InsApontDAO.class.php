<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of InsApontamentoMMDAO
 *
 * @author anderson
 */
class InsApontDAO extends ConnDEV {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosAponta, $dadosAlocaFunc) {

        $this->Conn = parent::getConn();
        
        foreach ($dadosAlocaFunc as $alocfunc) {

            $sql = "INSERT INTO PRU_ALOCA_FUNC ("
                    . " BOLETIM_ID "
                    . " , FUNC_MATRIC "
                    . " , TIPO "
                    . " , DTHR "
                    . " , DTHR_TRANS "
                    . " ) "
                    . " VALUES ("
                    . " " . $alocfunc->idExtBolAlocaFunc
                    . " , " . $alocfunc->codFuncionarioAlocaFunc
                    . " , " . $alocfunc->tipoAlocaFunc
                    . " , TO_DATE('" . $alocfunc->dthrAlocaFunc . "','DD/MM/YYYY HH24:MI') "
                    . " , SYSDATE "
                    . " )";

            $this->Create = $this->Conn->prepare($sql);
            $this->Create->execute();

        }
        
        foreach ($dadosAponta as $apont) {

            $insert = "INSERT INTO PRU_APONTAMENTO ("
                    . " BOLETIM_ID "
                    . " , OS_NRO "
                    . " , ATIVAGR_ID "
                    . " , MOTPARADA_ID "
                    . " , DTHR "
                    . " , DTHR_TRANS "
                    . " ) "
                    . " VALUES ("
                    . " " . $apont->idExtBolAponta
                    . " , " . $apont->osAponta
                    . " , " . $apont->ativAponta
                    . " , " . $apont->paradaAponta
                    . " , TO_DATE('" . $apont->dthrAponta . "','DD/MM/YYYY HH24:MI') "
                    . " , SYSDATE "
                    . " )";

            $this->Create = $this->Conn->prepare($insert);
            $this->Create->execute();
            
        }
        
    }

}
