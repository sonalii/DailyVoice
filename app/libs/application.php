<?php

/**
 * Application class 
 * 1) splits the request URL http://localhost/voting/like/10
 *    as 
 *    controller: voting.php
 *    action:     like()
 *    param1:     10 (image id)
 * 
 * 2) invokes action "like" from controller "voting.php" with parameter "10"
 *
 *
 * there is support for upto 3 parameters for now
 * if no action is passed, default "index" action would be used
 */

class Application
{
    private $url_controller  = null;
    private $url_action      = null;
    private $url_parameter_1 = null;
    private $url_parameter_2 = null;
    private $url_parameter_3 = null;

    public function __construct()
    {
        $this->splitUrl();

        // controller exists ?
        if (file_exists('./app/controller/' . $this->url_controller . '.php')) {

            // load controller
            require './app/controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            // action exists?
            if (method_exists($this->url_controller, $this->url_action)) {

				// check number of parameters passed and accordingly invoke action
                if (isset($this->url_parameter_3)) {
                    $this->url_controller->{$this->url_action}(
						$this->url_parameter_1, 
						$this->url_parameter_2, 
						$this->url_parameter_3
					);
                } elseif (isset($this->url_parameter_2)) {
                    $this->url_controller->{$this->url_action}(
						$this->url_parameter_1, 
						$this->url_parameter_2
					);
                } elseif (isset($this->url_parameter_1)) {
                    $this->url_controller->{$this->url_action}(
						$this->url_parameter_1
					);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                // call index if action not found
                $this->url_controller->index();
            }
        } else {
            // invalid URL, show index
            require './app/controller/home.php';
            $home = new Home();
            $home->index();
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
		$url = $_SERVER['REQUEST_URI'];
        if (strlen ($url) > 1) {

            // split URL

            $url = ltrim($url, '/');
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller  = (isset($url[0]) ? $url[0] : null);
            $this->url_action      = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);

            // to debug
            /*echo 'Controller: '  . $this->url_controller  . '<br />';
            echo 'Action: '      . $this->url_action      . '<br />';
            echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
            echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
            echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';*/
        }
    }
}
