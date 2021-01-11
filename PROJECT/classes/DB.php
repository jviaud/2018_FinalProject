<?php 
//So I dont have to reconnect on every page
class DB{
    private static $_instance = null; //stores instance of database
    private $_pdo, //instance of database
    $_query, //last quesry executed
    $_error=false, //error with query
    $_results, //results of query
    $_count=0; //count results
    protected $DB_class='';
    
    
    private function __construct(){
    //made private to force use of getInstance and prevent multiple connections to DB
        
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname='. Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            
           // echo 'Connected';
            
        }catch(PDOException $e){
            die($e->getMessage());
        }
        
    }//end construct method
    
    
    
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
            
        }
        return self::$_instance;
        
    
    }//end getInstace method

    
    public function query($sql, $params = array() ){
        $this-> error = false; //prevents current query from showing error from previous query
        if($this->_query=$this->_pdo->prepare($sql)){
            //echo 'Sucess';
            $x=1;//counter
            if(count($params)){
                foreach($params as $param){
                    $this-> _query -> bindValue($x, $param);
                    $x++;
                }//end foreach
            }//end 1st inner if
            
            if($this->_query->execute()){
               $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
               $this->_count =$this->_query->rowCount();
               
            }//end 2nd inner if
            else{
                $this->_error = true;
            }//end else
            
        }//end outter if
        return $this;
    }//end query method
    
    ////Methods to make queries easier
    public function action($action, $table, $where = array() ){
        if(count($where)=== 3){
            $operators = array('=','>','<','>='.'<=');
            $field      =$where[0];
            $operator   =$where[1];
            $value      =$where[2]; 
            
            if(in_array($operator,$operators)){
                $sql="{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }//end innermost if
            
            }//end inner if
            
        }//end outter if
        return false;
    }//end action method
    
    
    
    //passes info to action method
    public function get($table,$where){
        return $this->action('SELECT *', $table, $where);
    }
    
    
    //passes info to action method
    public function delete($table,$where){
        return $this->action('DELETE', $table, $where);
    }
    
    //METHODS TO MODIFY TABLE
    public function insert($table, $fields = array() ){
            $keys = array_keys($fields);
            $values = '';
            $x= 1; //counter
            
            foreach($fields as $field){
                $values .= '?';
                if($x < count($fields)){//adds commas to seperate fields as long as we are not at the end
                    $values .= ',';
                }
                $x++;
            }
           
            
            $sql = "INSERT INTO $table (`" . implode('`,`',$keys) . "`) VALUES ({$values}) ";
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
            
            
        
        return false;
    }
    
    
    public function update($table,$id,$fields){
        $set ='';
        $x=1;
        
        foreach($fields as $name => $value){
            $set.= "{$name} = ?";
            if($x < count($fields)){
                $set.=', ';
            }
            $x++;
            
        }
        
        $sql="UPDATE {$table} SET {$set} WHERE id={$id}";
        if(!$this->query($sql,$fields)->error()){
            return true;
        }
        return false;
    }
    
    
    

    public function __toString() {

    return (string)$this->DB_class;
    }
    
    //Methods to Return Results
    public function results(){
        return $this->_results;
    }
    
    public function first(){
        return $this->results()[0];
    }
    
    
    
    
    //Methods to Return Error/Size of returning table
    public function error(){
        return $this->_error;
    }
    
    public function count(){
        return $this->_count;
    }
    

}//end class DB


?>