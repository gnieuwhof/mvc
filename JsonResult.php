<?php

/**
 * @file
 * @brief This file contains the class JsonResult.
 */

/**
 * @brief Use this class to return JSON content.
 */
class JsonResult extends ResultBase
{
    
    public function __construct( $content = null )
    {
        $this->AddHeader( new HttpHeader( 'Content-type: application/json' ) );
        
        $this->Content = $content;
    }
    
    public function Render()
    {
        $this->Content = json_encode( $this->Content );
    }
    
}
