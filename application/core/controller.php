<?php

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $dbModel = null;

    /**
     * @var null
     */
    public $logModel = null;

    /**
     * Whenever controller is created, the "model" is created and ready to use from within the controllers.
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // Set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // Generate a database connection, using the PDO connector
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel()
    {
        require APP . 'model/DbModel.php';

        require APP . 'model/logmodel.php';

        // create new "db model" (and pass the database connection)
        $this->dbModel = new DBModel($this->db);

        // create new "log model"
        $this->logModel = new LogModel($this->dbModel);
    }
}
