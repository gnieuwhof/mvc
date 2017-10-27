<?php

class HomeController extends ControllerBase
{
    
    public function Index()
    {
        $this->DataCollection[ 'test' ] = 'test string';
        
        $this->DataCollection[ 'url' ] = $_GET;
        
        return $this->View( 'home/index.phtml' );
    }
    
    public function Test( $foo )
    {
        echo $foo;
        
        return $this->View( 'home/test.phtml' );
    }

}
