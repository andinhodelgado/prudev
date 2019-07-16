<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of VerOSDAO
 *
 * @author anderson
 */
class VerOSDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($valor) {

        $select = " SELECT DISTINCT "
                    . " NRO_OS AS \"nroOS\" "
                    . " , PROPRAGR_CD AS \"codSecao\" "
                    . " , PROPRAGR_DESCR AS \"descrSecao\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_OS_MANUAL "
                . " WHERE "
                    . " NRO_OS = " . $valor;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r1 = $this->Read->fetchAll();

        $dados = array("dados"=>$r1);
        $res1 = json_encode($dados);
        
        $select = " SELECT "
                    . " ROWNUM AS \"idROSAtiv\" "
                    . " , NRO_OS AS \"nroOS\" "
                    . " , ATIVAGR_CD AS \"codAtiv\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_OS_MANUAL "
                . " WHERE "
                    . " NRO_OS = " . $valor
                ;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r2 = $this->Read->fetchAll();
        
        $dados = array("dados"=>$r2);
        $res2 = json_encode($dados);
        
        return $res1 . "_" . $res2;
    }
    
}
