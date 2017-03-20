<?php

/**
 * Class FrontController
 */
class FrontController
{
	/** @var null The controller */
	private $url_controller = null;

	/** @var null The method (of the above controller), often also named "action" */
	private $url_action = null;

	/** @var array URL parameters */
	private $url_params = array();

	public function __construct()
	{
        // Split the url
		$this->splitUrl();

		// Check if any controller is requested
		if (!$this->url_controller)
		{
			require APP . 'controller/start.php';
			$page = new Start();
			$page->index();
		}
		elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php'))
		{
			require APP . 'controller/' . $this->url_controller . '.php';
			$this->url_controller = new $this->url_controller();

			if (method_exists($this->url_controller, $this->url_action))
			{
				if (!empty($this->url_params))
				{
					call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
				}
				else
				{
					$this->url_controller->{$this->url_action}();
				}
			}
			else
			{
				if (strlen($this->url_action) == 0)
				{
					$this->url_controller->index();
				}
				else
				{
					header('Location: ' . URL . 'problem');
				}
			}
		}
		else
		{
			header('Location: ' . URL . 'problem');
		}
	}

	/**
	 * Get the URL and split it into (controller, action, parameter)
	 */
	private function splitUrl()
	{
		if (isset($_GET['url']))
		{
			// Split the URL
			$url = trim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			// Put URL parts into according properties
			$this->url_controller = isset($url[0]) ? $url[0] : null;
			$this->url_action = isset($url[1]) ? $url[1] : null;

			// Remove controller and action from the split URL
			unset($url[0], $url[1]);

			$this->url_params = array_values($url);

			/* Used when debugging.
			echo 'Controller: ' . $this->url_controller . '<br>';
			echo 'Action: ' . $this->url_action . '<br>';
			echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
			*/
		}
	}
}
