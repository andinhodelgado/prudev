<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LiderDAO.class.php');
/**
 * Description of LiderCTR
 *
 * @author anderson
 */
class LiderCTR {
    //put your code here
    
    public function dados() {
        
        $liderDAO = new LiderDAO();
       
        $dados = array("dados"=>$liderDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
