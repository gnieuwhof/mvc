<?php

/**
 * @file
 * @brief This file contains the class XmlResult.
 */

/**
 * @brief Use this class to return XML content.
 */
class XmlResult extends ResultBase
{
    
    public function __construct( $content = null )
    {
        $this->AddHeader( new HttpHeader( 'Content-type: text/xml' ) );
        
        $this->Content = $content;
    }
    
    public function Render()
    {
    }
    
}
