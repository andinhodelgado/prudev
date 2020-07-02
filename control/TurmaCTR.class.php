<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/TurmaDAO.class.php');
/**
 * Description of TurmaCTR
 *
 * @author anderson
 */
class TurmaCTR {
    //put your code here
    
    public function dados() {
        
        $turmaDAO = new TurmaDAO();
       
        $dados = array("dados"=>$turmaDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
