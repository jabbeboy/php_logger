<?php

/**
 * Class DBModel
 */
class DBModel
{
    /**
     *
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try
        {
            $this->db = $db;
        }
        catch (PDOException $e)
        {
            exit('Database connection could not be established.');
        }
    }

    /**
     *
     * @param $username
     * @return mixed
     */
    public function getUser($username)
    {
        $query = "SELECT username, password, salt FROM users WHERE username = :username";
        $param = array(':username' => $username);
        $stmt = $this->db->prepare($query);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param $session_id
     * @param $address
     * @param $html
     * @return mixed
     */
    public function insertLog($session_id, $address, $html)
    {
        $query = "INSERT INTO logfiles (session_id, address, date_time, html) VALUES (:session_id, :address, now(), :html)";
        $query = $this->db->prepare($query);
        $param = array('session_id' => $session_id, 'address' => $address, 'html' => $html);
        return $query->execute($param);
    }

    /**
     * Deletes the log from logfiles table
     * @param $session_id
     * @param $id
     * @return mixed
     */
    public function deleteLog($session_id, $id)
    {
        $query = "DELETE FROM logfiles WHERE session_id = :session_id AND id = :id";
        $query = $this->db->prepare($query);
        $parameters = array(':session_id' => $session_id, ':id' => $id);
        return $query->execute($parameters);
    }

	/**
	 *
	 * @param $address
	 * @return mixed
	 */
    public function getLogsByAddress($address)
    {
        $query = "SELECT id, session_id, address, date_time FROM logfiles WHERE address = :address ORDER BY date_time DESC";
        $stmt = $this->db->prepare($query);
        $param = array(':address' => $address);
        $stmt->execute($param);
        return $stmt->fetchAll();
    }

	/**
	 *
	 * @param $session_id
	 * @return mixed
	 */
    public function getLogsBySession($session_id)
    {
        $query = "SELECT id, session_id, address, date_time FROM logfiles WHERE session_id = :session_id ORDER BY date_time DESC";
        $stmt = $this->db->prepare($query);
        $param = array(':session_id' => $session_id);
        $stmt->execute($param);
        return $stmt->fetchAll();
    }

    /**
     * Select one of each column without any duplicates
     * @return mixed returns the session_id and address
     */
    public function getAddresses()
    {
        $query = "SELECT DISTINCT address FROM logfiles ORDER BY date_time DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Select one of each column without any duplicates
     * @return mixed returns the session_id and address
     */
    public function getSessions()
    {
        $query = "SELECT DISTINCT session_id FROM logfiles ORDER BY date_time DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Selects fields from database table
     * @return mixed returns id, session_id, address, date_time
     */
    public function getLogFields()
    {
        $query = "SELECT DISTINCT id, session_id, address, date_time FROM logfiles ORDER BY date_time DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get the HTML BLOB data of specified session_id and id.
     * @param $session_id the session id from the log
     * @return mixed blob object
     */
    public function getLogHtml($session_id, $id)
    {
        $query = "SELECT html FROM logfiles WHERE session_id = :session_id AND id = :id";
        $stmt = $this->db->prepare($query);
        $param = array(':session_id' => $session_id, ':id' => $id);
        $stmt->execute($param);
        $stmt->bindColumn(1, $html, PDO::PARAM_LOB);
        return $stmt->fetch();
    }
}
