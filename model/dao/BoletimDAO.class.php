<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of BoletimDAO
 *
 * @author anderson
 */
class BoletimDAO extends Conn {

    //put your code here

    public function verifBoletim($bol) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PRU_BOLETIM "
                . " WHERE "
                . " DTHR_INICIAL = TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " LIDER_MATRIC = " . $bol->idLiderBoletim;

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

    public function idBoletim($bol) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PRU_BOLETIM "
                . " WHERE "
                . " DTHR_INICIAL = TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " LIDER_MATRIC = " . $bol->idLiderBoletim;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insBoletimAberto($bol) {

        $sql = "INSERT INTO PRU_BOLETIM ("
                . " LIDER_MATRIC "
                . " , TURMA_ID "
                . " , OS_NRO "
                . " , ATIVAGR_PRINC_ID "
                . " , DTHR_INICIAL "
                . " , DTHR_TRANS_INICIAL "
                . " , STATUS "
                . " , SIT "
                . " ) "
                . " VALUES ("
                . " " . $bol->idLiderBoletim
                . " , " . $bol->idTurmaBoletim
                . " , " . $bol->osBoletim
                . " , " . $bol->ativPrincBoletim
                . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , 1 "
                . " , 0 "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function insBoletimFechado($bol) {

        $sql = "INSERT INTO PRU_BOLETIM ("
                . " LIDER_MATRIC "
                . " , TURMA_ID "
                . " , OS_NRO "
                . " , ATIVAGR_PRINC_ID "
                . " , DTHR_INICIAL "
                . " , DTHR_TRANS_INICIAL "
                . " , DTHR_FINAL "
                . " , DTHR_TRANS_FINAL "
                . " , STATUS "
                . " , SIT "
                . " ) "
                . " VALUES ("
                . " " . $bol->idLiderBoletim
                . " , " . $bol->idTurmaBoletim
                . " , " . $bol->osBoletim
                . " , " . $bol->ativPrincBoletim
                . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , TO_DATE('" . $bol->dthrFimBoletim . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , 2 "
                . " , 0 "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function altBoletimFechado($idBol, $bol) {

        $sql = "UPDATE PRU_BOLETIM "
                . " SET "
                . " STATUS = " . $bol->statusBoletim
                . " , DTHR_FINAL = TO_DATE('" . $bol->dthrFimBoletim . "','DD/MM/YYYY HH24:MI') "
                . " , DTHR_TRANS_FINAL = SYSDATE "
                . " WHERE "
                . " ID = " . $idBol;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
