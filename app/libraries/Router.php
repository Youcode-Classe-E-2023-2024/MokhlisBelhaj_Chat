<?php
class Router
{
    protected $currentController ;
    protected $currentMethod='index' ;
    protected $params = [];

    public function __construct()
    {
        
        $urlData = $this->getUrl();
        
        if ($urlData['controller']=='index.php' ) { 
            $urlData['controller']  = 'dashboard';
        } 
     
        
        
       
        
        
        
        if (file_exists('controllers/' . ($urlData['controller']) . '.php')) {
            $currentController = $urlData['controller'];
            require_once('controllers/' . $currentController . '.php');
            
            $this->currentController = new $currentController;
            if(method_exists($this->currentController, $urlData['method'])){
                $this->currentMethod = $urlData['method'];
              }
        } else {
            
            require_once '../app/controllers/ErrorCustom.php';
            $error = new ErrorCustom();
        }
        $this->params =  $urlData['params'];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        $urlData = array();
 
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
         

            // Set controller
            $urlData['controller'] = isset($url[0]) ? $url[0] : null;

            // Set method
            $urlData['method'] = isset($url[1]) ? $url[1] : null;

            // Set params
            $urlData['params'] = array_slice($url, 2);
           
            
            return $urlData;
        }
    }
}
