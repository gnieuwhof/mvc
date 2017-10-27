<?php

/**
 * @file
 * @brief This file contains the class HttpHeader.
 */

/**
 * @brief Class used to send HTTP headers to the client.
 * 
 * Instances of this class can be added to a ResultBase derived class.
 * Before any content is returned to the client the HttpHeader
 * instances are used to send the headers.
 * 
 * @see http://php.net/manual/en/function.header.php
 */
class HttpHeader
{
    
    private $string;
    private $replace;
    private $responseCode;
    
    public function __construct(
        $string,
        $replace = true,
        $responseCode = null
        )
    {
        $this->string = $string;
        $this->replace = $replace;
        $this->responseCode = $responseCode;
    }
    
    public function GetString()
    {
        return $this->string;
    }
    
    public function GetReplace()
    {
        return $this->replace;
    }
    
    public function GetResponseCode()
    {
        return $this->responseCode;
    }
    
}
