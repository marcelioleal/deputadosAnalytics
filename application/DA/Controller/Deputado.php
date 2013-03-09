<?php

namespace DA\Controller;

class Deputado extends Controller
{

    public function profileAction($deputadoId)
    {
        $deputadoRepo = new \DA\Repository\Deputado($this->app);
        $deputado = $deputadoRepo->getDeputado($deputadoId);
        
        
        print_r($deputado);
        //pegar as presencas dele formatadas
        
        return array('deputado' => $deputado);
    }
    
    
}