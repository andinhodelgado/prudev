<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of ParadaDAO
 *
 * @author anderson
 */
class ParadaDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " MOTPARADA_CD AS \"codParada\" "
                    . " , CARACTER(MOTPARADA_DESCR) AS \"descrParada\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_PARADA "
                . " WHERE "
                    . " MOTPARADA_TIPO = 2 "
                . " ORDER BY "
                    . " MOTPARADA_CD "
                . " ASC ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

}
