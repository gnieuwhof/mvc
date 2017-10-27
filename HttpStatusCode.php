<?php

/**
 * @file
 * @brief This file contains the class HttpStatusCode.
 */

/**
 * @brief Class used to get HTTP status code description.
 */
class HttpStatusCode
{
    
    /**
     * List of HTTP status codes.
     * @var int
     */
    public static $Accepted = 202;
    public static $BadGateway = 502;
    public static $BadRequest = 400;
    public static $Conflict = 409;
    public static $Continue = 100;
    public static $Created = 201;
    public static $ExpectationFailed = 417;
    public static $Forbidden = 403;
    public static $Found = 302;
    public static $GatewayTimeout = 504;
    public static $Gone = 410;
    public static $HttpVersionNotSupported = 505;
    public static $InternalServerError = 500;
    public static $LengthRequired = 411;
    public static $MethodNotAllowed = 405;
    public static $MovedPermanently = 301;
    public static $MultipleChoices = 300;
    public static $NoContent = 204;
    public static $NonAutoritativeInformation = 203;
    public static $NotAcceptable = 406;
    public static $NotFound = 404;
    public static $NotImplemented = 501;
    public static $NotModified = 304;
    public static $OK = 200;
    public static $PartialContent = 206;
    public static $PaymentRequired = 402;
    public static $PreconditionFailed = 412;
    public static $ProxyAuthenticationRequired = 407;
    public static $RequestedRangeNotSatisfiable = 416;
    public static $RequestEntityTooLarge = 413;
    public static $RequestTimeout = 408;
    public static $RequestUriTooLong = 414;
    public static $ResetContent = 205;
    public static $SeeOther = 303;
    public static $ServiceUnavailable = 503;
    public static $SwitchingProtocols = 101;
    public static $TemporaryRedirect = 307;
    public static $Unauthorized = 401;
    public static $UnsupportedMediaType = 415;
    public static $Unused = 306;
    public static $UseProxy = 305;
    
    /**
     * Description of HTTP status codes
     * @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     * @var string[]
     */
    private static $statusCodes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
        );
    
    /**
     * Get HTTP status code description.
     * 
     * @param int $code The code.
     * @return string Description of the status code.
     */
    public static function GetDescription( $code )
    {
        if( !isset( self::$statusCodes[ $code ] ) )
        {
            throw new Exception( "Unknown HTTP status code: {$code}." );
        }
        
        return self::$statusCodes[ $code ];
    }
    
}
