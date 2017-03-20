<?php

/**
 * Class Controller
 */
class CoreController
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Database Model
     */
    public $dbModel = null;

    /**
     * @var null Log Model
     */
    public $logModel = null;

    /**
     * When a controller is created, the "model" is also created
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    /**
     * Open the database connection with credentials from the config.php file
     */
    private function openDatabaseConnection()
    {
        // Set the options of the PDO connection
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // Creates a new PDO database connection
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "models".
     * @return object model
     */
    public function loadModel()
    {
        require APP . 'model/DbModel.php';
        require APP . 'model/LogModel.php';

        // Create new "db model" (and pass the database connection)
        $this->dbModel = new DBModel($this->db);

        // Create new "log model" (and pass database model)
        $this->logModel = new LogModel($this->dbModel);
    }
}
