<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');

/**
 * Description of ApontDAO
 *
 * @author anderson
 */
class ApontDAO extends Conn {

    //put your code here

    public function verifApont($idBol, $apont) {

        $select = " SELECT "
                . " COUNT(ID) AS QTDE "
                . " FROM "
                . " PRU_APONTAMENTO "
                . " WHERE "
                . " DTHR = TO_DATE('" . $apont->dthrAponta . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_MATRIC = " . $apont->funcAponta
                . " AND "
                . " BOLETIM_ID = " . $idBol;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insApont($idBol, $apont) {

        if (!isset($apont->paradaAponta) || empty($apont->paradaAponta)) {
            $apont->paradaAponta = "null";
        } else {
            if ($apont->paradaAponta == 0) {
                $apont->paradaAponta = "null";
            }
        }

        if (!isset($apont->ativAponta) || empty($apont->ativAponta)) {
            $apont->ativAponta = "null";
        }

        if (!isset($apont->osAponta) || empty($apont->osAponta)) {
            $apont->osAponta = "null";
        }

        $sql = "INSERT INTO PRU_APONTAMENTO ("
                . " BOLETIM_ID "
                . " , OS_NRO "
                . " , ATIVAGR_ID "
                . " , MOTPARADMO_ID "
                . " , DTHR "
                . " , DTHR_TRANS "
                . " , FUNC_MATRIC "
                . " ) "
                . " VALUES ("
                . " " . $idBol
                . " , " . $apont->osAponta
                . " , " . $apont->ativAponta
                . " , " . $apont->paradaAponta
                . " , TO_DATE('" . $apont->dthrAponta . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $apont->funcAponta
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
