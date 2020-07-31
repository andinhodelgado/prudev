<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of OSDAO
 *
 * @author anderson
 */
class OSDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                . " NRO_OS AS \"nroOS\" "
                . " , PROPRAGR_CD AS \"codSecao\" "
                . " , PROPRAGR_DESCR AS \"descrSecao\" "
                . " , FRENTE_ID AS \"idFrente\" "
                . " , FRENTE_DESCR AS \"descrFrente\" "
                . " FROM "
                . " USINAS.V_SIMOVA_OS_MANUAL ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
    public function verif($os) {

        $select = " SELECT DISTINCT "
                    . " NRO_OS AS \"nroOS\" "
                    . " , PROPRAGR_CD AS \"codSecao\" "
                    . " , PROPRAGR_DESCR AS \"descrSecao\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_OS_MANUAL "
                . " WHERE "
                    . " NRO_OS = " . $os;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
