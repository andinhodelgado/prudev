<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of AtualizaAplicDAO
 *
 * @author anderson
 */
class AtualAplicDAO extends ConnDEV {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function pesqInfo($dados) {

        foreach ($dados as $d) {

            $celular = $d->idCelularAtual;
            $va = $d->versaoAtual;
        }
        
        $retorno = 'N'; 
        
        $select = "SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PRU_ATUALIZACAO "
                    . " WHERE "
                        . " NUMERO_LINHA = " . $celular;    
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        if ($v == 0) {
            
            $sql = "INSERT INTO PRU_ATUALIZACAO ("
                    . " NUMERO_LINHA "
                    . " , VERSAO_ATUAL "
                    . " , VERSAO_NOVA "
                    . " , DTHR_ULT_ATUAL "
                    . " ) "
                    . " VALUES ("
                    . " " . $celular
                    . " , " . $va
                    . " , " . $va
                    . " , SYSDATE "
                    . " )";

            $this->Create = $this->Conn->prepare($sql);
            $this->Create->execute();
            
        }
        else{
            
            $select = " SELECT "
                            . " VERSAO_NOVA "
                        . " FROM "
                            . " PRU_ATUALIZACAO "
                        . " WHERE "
                            . " NUMERO_LINHA = " . $celular;
            
            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $vn = $item['VERSAO_NOVA'];
            }
            
            if($va != $vn){
                $retorno = 'S'; 
            }
            else{
                
                $retorno = 'N'; 
                
                $select = " SELECT "
                            . " VERSAO_ATUAL "
                        . " FROM "
                            . " PRU_ATUALIZACAO "
                        . " WHERE "
                            . " NUMERO_LINHA = " . $celular;
                        ;
                
                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $vab = $item['VERSAO_ATUAL'];
                }
                
                if($va != $vab){
                    
                    $sql = "UPDATE PRU_ATUALIZACAO "
                        . " SET "
                        . " VERSAO_ATUAL = " . $va
                        . " , DTHR_ULT_ATUAL = SYSDATE "
                        . " WHERE "
                            . " NUMERO_LINHA = " . $celular;

                    $this->Create = $this->Conn->prepare($sql);
                    $this->Create->execute();
                    
                }
                
            }
        
        }

        return $retorno;
    }
    
}
