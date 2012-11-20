<?php

class base {

    var $server;
    var $username;
    var $password;
    var $database_name;
    var $connection;
    var $select;
    var $query;

    protected function getPath() {
        return dirname(__FILE__);
    }

    /**
     * Function to render the output
     */
    protected function render($file_name, $variables_array = null) {
        if($variables_array)
            extract($variables_array);

        require($this->getPath() . '/../out/' . $file_name . '.php');
    }

    /**
     * Database Connection
     */
    protected function dbConnect()
    {
        require($this->getPath() . '/../conf/config.php');

        $connection = mysql_connect($server,$username,$password);
        $select = mysql_select_db($database_name,$connection);
    }

    /*
     * Database run query
     */
    protected function dbQuery($query)
    {
        $this->dbConnect();

        $result = mysql_query($query);
        if (!$result) {
            echo 'Database error: ' . mysql_error();
            exit;
        }
        else {
            return $result;
        }
    }

    /**
     * A helper function for creating/geting current date
     * @returns date in unix format
     */
    public function getCurrentDate(){
        $date = strtotime(date("Y-m-d"));
        return $date;
    }

    /**
     *  Deleting the records for no duplicates of the same date
     */
    protected function prepareUpdateForToday(){
       $date = $this->getCurrentDate();
       $this->dbQuery("DELETE FROM imdb_archive WHERE datestamp = $date");
    }

}