<?php

/**
 * @file
 * @brief This file contains the class ViewResult.
 */

/**
 * @brief This class is used to render views.
 */
class ViewResult extends ResultBase
{
    
    private $path;
    
    private $DataCollection;
    
    private $StatusCode;
    
    
    public function __construct( $path, $dataCollection, $statusCode = null )
    {
        $this->path = $path;
        
        $this->DataCollection = $dataCollection;
        
        $this->StatusCode = $statusCode;
            
        if( $statusCode !== null )
        {
            $header = new HttpHeader(
                $_SERVER[ 'SERVER_PROTOCOL' ] . ' ' . $statusCode .
                ' ' . HttpStatusCode::GetDescription( $statusCode ),
                true,
                $statusCode
                );
            
            $this->AddHeader( $header );
        }
    }

    public function Render()
    {
        ob_start();

        require 'views/' . $this->path;
        
        $this->Content = ob_get_contents();
        
        ob_end_clean();
    }
    
}
