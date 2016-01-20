<?php 
header("Content-Type: text/html; charset=UTF-8",true);
class Primitive {
    private $value;
    private $type;
    private $sql;
    const INTEGER = 1;
    const STRING = 2;
    const FLOAT = 3;
    const BOOL = 4;
    public function __construct($value = ""){
        $this->value = $value;
        $this->setType();
    }
    public function getValue(){
        return $this->value;
    }
    public function setValue($value){
        $this->value = $value;
    }
    public function getType(){
        return $this->type;
    }
    private function setType(){      
        $this->type = $this->isString() ? 'String' : 
            ($this->isInteger() ? 'Integer' : 
                ($this->isFloat() ? 'Float' :
                    ($this->isBool() ? 'Bool' :'Undefined')));
    }
    public function isInteger(){
        return is_int($this->value);
    }
    public function isString(){
        return is_string($this->value);
    }
    public function isFloat(){
        return is_float($this->value);
    }
    public function isBool(){
        return is_bool($this->value);
    }            
}

$pri = new Primitive(10.1);
echo "String: {$pri->isString()} <br />";
echo "Integer: {$pri->isInteger()} <br />";
echo "Float: {$pri->isFloat()} <br />";
echo "Type: {$pri->getType()}";
echo "<pre>";
print_r($pri);
echo "</pre>";
?>