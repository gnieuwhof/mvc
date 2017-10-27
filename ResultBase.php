<?php

/**
 * @file
 * @brief This file contains the class ResultBase.
 */

/**
 * @brief This class is the base class of all views.
 */
abstract class ResultBase
{

    private $headers = array();
    
    public $Content = null;

    abstract public function Render();
    
    public function AddHeader( HttpHeader $header )
    {
        $this->headers[] = $header;
    }
    
    public function GetHeaders()
    {
        return $this->headers;
    }
    
}
