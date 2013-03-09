<?php

namespace DA\Controller;

class Home extends Controller
{

    public function indexAction()
    {
        $deputadoRepo = new \DA\Repository\Deputado($this->app);
        
        $deputados = $deputadoRepo->getDeputadosAtuais();
        
        $data = array('deputados' => $deputados);
        
        return $data;
    }
    
    
}