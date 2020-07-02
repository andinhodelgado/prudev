<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/TipoApontaDAO.class.php');
/**
 * Description of TipoApontaCTR
 *
 * @author anderson
 */
class TipoApontaCTR {
    //put your code here
    
    public function dados() {
      
        $tipoApontaDAO = new TipoApontaDAO();
       
        $dados = array("dados"=>$tipoApontaDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
