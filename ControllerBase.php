<?php

/**
 * @file
 * @brief This file contains the class ControllerBase.
 */

/**
 * @brief This is the controller base class.
 * 
 * Controllers shoulds extend this class to create a ViewResult.
 * This makes the DataCollection member available in the view.
 */
class ControllerBase
{
    
    protected $StatusCode = null;

    protected $DataCollection = array();
    
    protected static function HttpStatusCode( $statusCode )
    {
        $result = new ContentResult();
        
        $result->StatusCode = $statusCode;
        
        return $result;
    }
    
    protected function View( $path )
    {
        return new ViewResult(
            $path,
            $this->DataCollection,
            $this->StatusCode
            );
    }
    
    protected static function Content( $content )
    {
        return new ContentResult( $content );
    }
    
    protected static function Json( $content )
    {
        return new JsonResult( $content );
    }
    
    protected static function Xml( $content )
    {
        return new XmlResult( $content );
    }

    /*
     * E.g. parent::Redirect( "controllerName" , "actionName" );
     */
    protected static function Redirect( $controller, $action )
    {
        $urlPath = dirname( $_SERVER[ "PHP_SELF" ] );
        
        $query = "/?controller=" . $controller . "&action=" . $action;
        
        header( "Location: " . $urlPath . $query );
        
        exit();
    }
    
}
