<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/FuncDAO.class.php');
/**
 * Description of FuncCTR
 *
 * @author anderson
 */
class FuncCTR {
    //put your code here
    
    public function dados() {
        
        $funcDAO = new FuncDAO();
       
        $dados = array("dados"=>$funcDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
