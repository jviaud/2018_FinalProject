<?php 
class Validate{
    private $_passed=false,
            $_errors=array(),
            $_db=null;
            
    public function __construct(){
        $this->_db = DB::getInstance();
    }//end construct method
    
    public function check($source, $items = array()){
        
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
               
               $value = trim($source[$item]);
               $item = escape($item);//escapes special chars
               
               if($rule === 'required' && empty($value)){
                   //$this->addError("{$item} is required");
                   $this->addError($item.'_error=reqerror&');
                     
               }else if(!empty($value)){
                   switch($rule){
                       case 'min':
                       if(strlen($value) < $rule_value){
                           //$this->addError("{$item} must ne a minimum of {$rule_value} characters.");
                           $this->addError($item.'_error=minerror&');
                       }
                       break;
                       
                       case 'max':
                           if(strlen($value) > $rule_value){
                           //$this->addError("{$item} must ne a maximum of {$rule_value} characters.");
                           $this->addError($item.'_error=maxerror&');
                       }
                       break;
                       
                       case'matches':
                           if($value !=$source[$rule_value]){
                              // $this->addError("Passwords must match");
                               $this->addError($item.'_error=matcherror&');
                           }
                       break;
                       
                       case'unique':
                           $check = $this->_db->get($rule_value, array($item, '=',$value ));
                            if($check->count()){
                                //$this->addError("Username is Taken");
                                $this->addError($item.'_error=exsisterror&');
                            }
                       
                       break;
                       
                       case'nospace':
                           if(strpos($value, $rule_value) !== false){
                               $this->addError($item.'_error=wspace&');
                           }
                           break;
                       
                   }
               }
               
               
               
            }//end inner foreach
        }//end outter foreach
        
        if(empty($this->_errors)){
            $this->_passed=true;
        }
        return $this;
        
        
    }//end check methhod
    
    private function addError($error){
        $this->_errors[] =$error;
    }//end addError method
    
    public function errors(){
        return $this->_errors;
    }
    
    public function passed(){
        return $this->_passed;
    }
    
}//end Validate class

?>