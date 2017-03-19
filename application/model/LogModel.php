<?php

/**
 * LogModel is responsible for logging the exceptions and inserting the log to the database
 */
class LogModel
{
	/**
	 * LogModel constructor.
	 * @param $dbModel
	 */
    function __construct(DbModel $dbModel)
    {
        try
        {
            $this->dbModel = $dbModel;
        }
        catch (PDOException $e)
        {
            exit('Database connection could not be established.');
        }
    }

    public function logException($msg,  $exception)
    {
	    loggHeader($msg);
	    loggThis($msg, $exception, false);
	    $this->dbModel->insertLog($_COOKIE['PHPSESSID'], $_SERVER['REMOTE_ADDR'], getLog(true));
    }
}