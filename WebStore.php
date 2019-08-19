<?php
require ROOT .DS. 'backend' .DS.'db' .DS. 'Dbase.php';
require ROOT .DS. 'client' .DS. 'Client.php';

class WebStore {
    
    public $database;
    
    public function __construct() {
        $this->database = new Dbase();
    }
    
    /**
     * Loads the core sample test files into the Sample Test
     */
    public function loadEngine(){
        
        $engine = ROOT .DS. 'backend' .DS. 'engine';
        
        if(!$this->_isEngineEmpty($engine)){
            
            $directory = opendir($engine);

            while(false!==$file=readdir($directory)){

                if($file!='.'&&$file!='..'&&$file!='_notes'){
                    require_once(ROOT .DS. 'backend' .DS. 'engine' .DS. $file);
                }
            }

            closedir($directory);
        }
        else{
            echo '<blockquote>'
                    . '<h2>Step 2 of 2</h2>'
                    . '<h3>Please create the required classes for the engine</h3>'
                . '</blockquote>';
            exit();
        }
    }
    
    public function load($io){
        
        //load the engine
        $this->loadEngine();
        
        $customers = new Customers();
        $products = new Products();
        $invoices = new Invoices();
        
        $client = new Client($customers, $products, $invoices);
        
        if(count($io) == 0)
            $client->showAll();
        
        elseif(array_key_exists ('invoice', $io))
            $client->show('invoice', $io['invoice']);
        
    }
    
    /**
     * Checks if db is correctly installed
     * @return boolean
     */
    public function checkInstallation() {
        
        if(!$this->database->isValid())
            echo '<blockquote>'
                    . '<h2>Step 1 of 2</h2>'
                    . '<h3>Please configure the MySQL database.</h3>'
                    . '<small>1. Create your new database</small>'
                    . '<small>2. Import the <strong>sampletestdb.sql</strong> into your new database</small>'
                    . '<small>3. Edit <strong>dbconfig.php</strong> in <strong>backend/db</strong> folder and include the databse connection settings</small>'
                . '</blockquote>';
        else
            return true;
    }
    
    /**
     * Checks for empty engine
     * @param type $dir
     * @return type
     */
    private function _isEngineEmpty($dir) {
        
      if (!is_readable($dir)) return NULL; 
      
      $handle = opendir($dir);
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          return FALSE;
        }
      }
      return TRUE;
    }
}

