<?php 

  /**
   * App Core Class
   * Creates URL & loads controller
   * URL FORMAT - /contoller/method/params
   */
  class Core
  {

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
      // Get URl
      $url = $this->getUrl();
      // GET CONTROLLER
      // First part of the URL
      if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        //if exists, set as controller
        $this->currentController = ucwords($url[0]);
        //Unset 0 Index
        unset($url[0]);
      }
      // Require the controller
      require_once '../app/controllers/'. $this->currentController . '.php';
      // Instantiate Controller Class
      // Pages = new Pages (example format)
      $this->currentController = new $this->currentController;
      // GET METHOD
      // Check for second part of URL
      if (isset($url[1])) {
        // check to see if method exist in controller
        if (method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          // Unset 1 index
          unset($url[1]);
        }
      }
      // GET PARAMS
      $this->params = $url ? array_values($url) : [];
      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    } // __construct

    // Get the URL
    public function getUrl()
    {
      if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    } // getUrl

  } // Core


 ?>