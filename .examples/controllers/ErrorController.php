<?php

class ErrorController extends ControllerBase
{
    
    public function Index()
    {
        $this->statusCode = HttpStatusCode::$NotFound;
        
        $this->DataCollection['message'] = 'The object cannot be found.';
        $this->DataCollection['description'] =
            'The object you are looking for ' .
            '(or one of its dependencies) could have been removed, ' .
            'had its name changed, or is temporarily unavailable. ' .
            'Please review the requested URL ' .
            'and make sure that it is spelled correctly.';
        
        $this->DataCollection['version'] = Profile::Version;
        
        return $this->View('error/index.phtml');
    }

}
