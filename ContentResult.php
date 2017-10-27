<?php

/**
 * @file
 * @brief This file contains the class ContentResult.
 */

/**
 * @brief Use this class to return simple content.
 */
class ContentResult extends ResultBase
{
    
    public function __construct( $content = null )
    {
        $this->Content = $content;
    }
    
    public function Render()
    {
    }
    
}
