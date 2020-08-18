<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespFitoDAO
 *
 * @author anderson
 */
class RespFitoDAO {
    //put your code here
    
        public function verifResp($idCabec, $resp) {

        $select = " SELECT "
                . " COUNT(ITIMPFEST_ID) AS QTDE "
                . " FROM "
                . " USINAS.ITEM_IMPORT_INFEST "
                . " WHERE "
                . " ITAMOSORGA_ID = " . $resp->idAmostraRespItem
                . " AND "
                . " NRO_PONTO = " . $resp->pontoRespItem
                . " AND "
                . " IMPFEST_ID = " . $idCabec;

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
    
    public function insResp($idCabec, $resp) {

        $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
            . " IMPFEST_ID "
            . " , NRO_PONTO "
            . " , ITAMOSORGA_ID "
            . " , VL "
            . " ) "
            . " VALUES ("
            . " " . $idCabec
            . " , " . $resp->pontoRespItem
            . " , " . $resp->idAmostraRespItem
            . " , " . $resp->valorRespItem
            . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    
}
