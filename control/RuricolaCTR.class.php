<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LogDAO.class.php');
require_once('../model/dao/BoletimDAO.class.php');
require_once('../model/dao/ApontDAO.class.php');
require_once('../model/dao/AlocaFuncDAO.class.php');
/**
 * Description of RuricolaCTR
 *
 * @author anderson
 */
class RuricolaCTR {
    //put your code here
    

    //put your code here
    public function salvarDadosBolAberto($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $pos1 = strpos($dados, "_") + 1;
        $pos2 = strpos($dados, "|") + 1;

        $bol = substr($dados, 0, ($pos1 - 1));
        $apont = substr($dados, $pos1, (($pos2 - 1) - $pos1));
        $alocFunc = substr($dados, $pos2);

        $jsonObjBoletim = json_decode($bol);
        $jsonObjAponta = json_decode($apont);
        $jsonObjAlocaFunc = json_decode($alocFunc);

        $dadosBoletim = $jsonObjBoletim->boletim;
        $dadosAponta = $jsonObjAponta->aponta;
        $dadosAlocaFunc = $jsonObjAlocaFunc->alocafunc;

        $idBol = $this->salvarBolAberto($dadosBoletim, $dadosAponta, $dadosAlocaFunc);

        return "GRAVOU+id=" . $idBol . "_";
    }

    public function salvarDadosApont($info, $pagina) {

        $dados = $info['dado'];
        $pos1 = strpos($dados, "|") + 1;

        $apont = substr($dados, 0, ($pos1 - 1));
        $alocFunc = substr($dados, $pos1);

        $jsonObjAponta = json_decode($apont);
        $jsonObjAlocaFunc = json_decode($alocFunc);

        $dadosAponta = $jsonObjAponta->aponta;
        $dadosAlocaFunc = $jsonObjAlocaFunc->alocafunc;

        $this->salvarApont($dadosAponta, $dadosAlocaFunc);

        return 'GRAVOU-APONTAMM';
    }

    public function salvarDadosBolFechado($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $pos1 = strpos($dados, "_") + 1;
        $pos2 = strpos($dados, "|") + 1;

        $bol = substr($dados, 0, ($pos1 - 1));
        $apont = substr($dados, $pos1, (($pos2 - 1) - $pos1));
        $alocFunc = substr($dados, $pos2);

        $jsonObjBoletim = json_decode($bol);
        $jsonObjAponta = json_decode($apont);
        $jsonObjAlocaFunc = json_decode($alocFunc);

        $dadosBoletim = $jsonObjBoletim->boletim;
        $dadosAponta = $jsonObjAponta->aponta;
        $dadosAlocaFunc = $jsonObjAlocaFunc->alocafunc;

        $this->salvarBolFechado($dadosBoletim, $dadosAponta, $dadosAlocaFunc);

        return 'GRAVOU-BOLFECHADO';
    }

    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    private function salvarBolAberto($dadosBoletim, $dadosAponta, $dadosAlocaFunc) {
        $boletimDAO = new BoletimDAO();
        foreach ($dadosBoletim as $bol) {
            $v = $boletimDAO->verifBoletim($bol);
            if ($v == 0) {
                $boletimDAO->insBoletimAberto($bol);
            }
            $idBol = $boletimDAO->idBoletim($bol);
            $this->salvarApontBol($idBol, $bol->idBoletim, $dadosAponta);
            $this->salvarAlocFunc($idBol, $bol->idBoletim, $dadosAlocaFunc);
        }
        return $idBol;
    }

    private function salvarBolFechado($dadosBoletim, $dadosAponta, $dadosAlocaFunc) {
        $boletimDAO = new BoletimDAO();
        foreach ($dadosBoletim as $bol) {
            $v = $boletimDAO->verifBoletim($bol);
            if ($v == 0) {
                $boletimDAO->insBoletimFechado($bol);
                $idBol = $boletimDAO->idBoletim($bol);
            } else {
                $idBol = $boletimDAO->idBoletim($bol);
                $boletimDAO->altBoletimFechado($idBol, $bol);
            }
            $this->salvarApontBol($idBol, $bol->idBoletim, $dadosAponta);
            $this->salvarAlocFunc($idBol, $bol->idBoletim, $dadosAlocaFunc);
        }
    }

    private function salvarApont($dadosAponta, $dadosAlocaFunc) {
        $alocaFuncDAO = new AlocaFuncDAO();
        foreach ($dadosAlocaFunc as $alocaFunc) {
            $v = $alocaFuncDAO->verifAlocaFunc($alocaFunc->idExtBolAlocaFunc, $alocaFunc);
            if ($v == 0) {
                $alocaFuncDAO->insAlocaFunc($alocaFunc->idExtBolAlocaFunc, $alocaFunc);
            }
        }
        $apontDAO = new ApontDAO();
        foreach ($dadosAponta as $apont) {
            $v = $apontDAO->verifApont($apont->idExtBolAponta, $apont);
            if ($v == 0) {
                $apontDAO->insApont($apont->idExtBolAponta, $apont);
            }
        }
    }

    private function salvarApontBol($idBolBD, $idBolCel, $dadosAponta) {
        $apontDAO = new ApontDAO();
        foreach ($dadosAponta as $apont) {
            if ($idBolCel == $apont->idBolAponta) {
                $v = $apontDAO->verifApont($idBolBD, $apont);
                if ($v == 0) {
                    $apontDAO->insApont($idBolBD, $apont);
                }
            }
        }
    }

    private function salvarAlocFunc($idBolBD, $idBolCel, $dadosAlocaFunc) {
        $alocaFuncDAO = new AlocaFuncDAO();
        foreach ($dadosAlocaFunc as $alocaFunc) {
            if ($idBolCel == $alocaFunc->idBolAlocaFunc) {
                $v = $alocaFuncDAO->verifAlocaFunc($idBolBD, $alocaFunc);
                if ($v == 0) {
                    $alocaFuncDAO->insAlocaFunc($idBolBD, $alocaFunc);
                }
            }
        }
    }
    
}
