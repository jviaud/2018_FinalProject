<?php 
class User{
    private $_db,
            $_data,
            $_sessionName,
            $_isloggedin;
    
    
    public function __construct($user=null){
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        
        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
                
                if($this->find($user)){
                    $this->_isloggedin = true;
                }else{
                    
                }
            }
        }else{
            $this->find($user);
        }
        
    }
    
    public function create($fields = array() ){
        
        if($this->_db->insert('users',$fields)){
            
            $data = $this->_db->get('users', array('username', '=', $fields['username']));
            $this->_data = $data->first();
            $id=$this->data()->id;
                
            //An initial stats entry is created when an account is made
            date_default_timezone_set('America/New_York');
            $date=date('Y-m-d H:i:s');
            $table = DB::getInstance()->insert('stats', array(
            'id'=>$id,     
            'fintime' => $date
             ));
             
        }else{throw new Exception('Problem Creating New Account');}
       
        
    }
    
    
    public function find($user = null){
        if($user){
            $field = (strlen($user)<5) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));
            
            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
            
        }
        return false;
    }
    
    public function login($username=null,$password=null){
       
       $user = $this->find($username);
       
       if($user){
           if($this->data()->password === Hash::make($password,$this->data()->salt)){
               Session::put($this->_sessionName, $this->data()->id);
               $date=date('Y-m-d H:i:s');
               $table = DB::getInstance()->update('users', id, array(
                'lastonline' => $date
                ));

               return true;    
               
           }
       }
       
       
       
       
       return false;
    }
    
 

    
    public function data(){
        return $this->_data;
    }
    
    public function isLoggedIn(){
        return $this->_isloggedin;
    }
}

?>