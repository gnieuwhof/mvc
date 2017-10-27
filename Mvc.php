<?php

/**
 * @file
 * @brief This file contains the class Mvc.
 */

/**
 * @brief Class used to process incoming requests.
 */
class Mvc
{

    const BufferSize = 8192;
    
	
    public function ProcessRequest()
    {
        // Convert all keys to lowercase.
        $_GET = array_change_key_case( $_GET );
        
        if( !empty( $_GET[ 'controller' ] ) )
        {
            $controllerPrefix = $_GET[ 'controller' ];
        }
        else
        {
            // Default controller.
            $controllerPrefix = Config::MVC_DEFAULT_CONTROLLER;
        }
        
        try
        {
            $controllerName = self::FindController( $controllerPrefix );
        }
        catch( Exception $e )
        {
            // Controller not found.
            $controllerName = self::FindController( 'error' );
            
            $_GET[ 'action' ] = 'notfound';
        }
        
        if( !empty( $_GET[ 'action' ] ) )
        {
            $action = $_GET[ 'action' ];
        }
        else
        {
            // Default action.
            $action = 'index';
        }
        
        try
        {
            $method = self::FindAction( $action, $controllerName );
        }
        catch( Exception $e )
        {
            $controllerName = self::FindController( 'error' );
            
            $method = self::FindAction( 'index', $controllerName );
        }
        
        $arguments = array();
        
        foreach( $_GET as $key => $value )
        {
            if( ( strcasecmp( $key, 'controller' ) != 0 ) &&
                ( strcasecmp( $key, 'action' ) != 0 ) )
            {
                $arguments[] = $value;
            }
        }
        
        try
        {
            self::CheckParameters(
                $controllerName,
                $method,
                count( $arguments )
                );
        }
        catch( Exception $e )
        {
            $controllerName = self::FindController( 'error' );
            
            $method = self::FindAction( 'index', $controllerName );
        }
        
        // Instantiate controller.
        $controller = new $controllerName;

        $resultBase = call_user_func_array(
            array( $controller, $method ),
            $arguments
            );
        
        $resultBase->Render();
        
        $headers = $resultBase->GetHeaders();
        
        foreach( $headers as $header )
        {
            header(
                $header->GetString(),
                $header->GetReplace(),
                $header->GetResponseCode()
                );
        }
        
        if( $resultBase->Content != null )
        {
            self::Send( $resultBase );
        }
    }
    
    private static function FindController( $name, $reloadCache = true )
    {
        $files = array_keys( $GLOBALS[ 'files' ] );
        
        foreach( $files as $file )
        {
            if( strcasecmp( $file, $name . 'controller' ) == 0 )
            {
                return $file;
            }
        }
        
        if( $reloadCache )
        {
            ReloadFileCache();
            
            return self::FindController( $name, false );
        }
        
        throw new Exception( "Controller '$name' not found!" );
    }
    
    private static function FindAction( $name, $controller )
    {
        $methods = get_class_methods( $controller );
        
        foreach( $methods as $method )
        {
            if( strcasecmp( $method, $name ) == 0 )
            {
                return $method;
            }
        }
        
        throw new Exception(
            "Action: '$name' not found on controller: '$controller'"
            );
    }
    
    private static function CheckParameters(
        $classname,
        $methodname,
        $argumentCount
        )
    {
        $reflectionMethod = new ReflectionMethod( $classname, $methodname );
        
        if( $reflectionMethod->getNumberOfRequiredParameters() >
            $argumentCount
            )
        {
            throw new Exception(
                "Missing arguments for action: '{$classname}->{$methodname}()'."
                );
        }
    }
    
    private static function Send( $resultBase )
    {        
        if( isset( $resultBase->Content[ Config::BUFFER_SIZE ] ) )
        {
            // The content is larger than the buffer size.
            // Output the content in chunks.

            $index = 0;
            $length = strlen( $resultBase->Content );
            
            while( $index < $length )
            {
                echo substr( $resultBase->Content, $index, Config::BUFFER_SIZE );
                
                $index += Config::BUFFER_SIZE;
            }
        }
        else
        {
            // Send the entire content at once.
            echo $resultBase->Content;
        }
    }

}
