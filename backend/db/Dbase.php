<?php 

class Dbase {
    
    private $_port;
    private $_db_valid = false;
    
    public $host;
    public $user;
    public $password;
    public $database;
    public $mysqli = null;

    /**
     * Defines mysqli database connections from config
     */
    public function __construct() {
        
        $this->_port = ini_get('mysqli.default.port');
        
        $config = require ROOT .DS. 'backend' .DS. 'db' .DS. 'dbconfig.php';
        
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['dbname'];
        
        return $this->connect();
    }
    
    /**
     * Connects via mysqli to database
     */
    public function connect() {
        
        if(!empty($this->host) 
                && !empty($this->user)
                && !empty($this->database)
            ){
            
            mysqli_report(MYSQLI_REPORT_ERROR);
            $this->mysqli = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->_port);

            //set db checker
            $this->_db_valid = true;
            
            return $this->mysqli;
        }
    }
    
    /**
     * Runs the Mysql query string
     * 
     * @param type $querystr
     */
    public function run($querystr){
        
        $query = $this->mysqli->query($querystr);
        
        if ($this->mysqli->error) {
            
            try {
                throw new Exception("MySQL error ".$this->mysqli->error." <br> Query:<br> $query", $this->msqli->errno);    
            } 
            catch(Exception $e ) {
                
                echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
                echo nl2br($e->getTraceAsString());
            }
        }
        
        return $query;
    }
    
    /**
     * Processes the mysqli query using fetch_array
     * 
     * @param type $query
     * @return type
     */
    public function fetch($query){
        
        while($row = $query->fetch_array(MYSQLI_ASSOC)){
            $result[] = $row;
        }
        
        return $result;
    }
    
    /**
     * Closes the connections
     */
    public function close() {
        mysqli_close($this->mysqli);
    }
    
    /**
     * Checks if db connection is valid
     * @return type
     */
    public function isValid() {
        return $this->_db_valid;
    }
}
