<?php 
header("Content-Type: text/html; charset=UTF-8",true);
class Primitive {
    //nome da primitiva
    private $name;
    //valor da primitiva
    private $value;
    //descritor do tipo da primitiva
    private $type;
    //código do tipo da primitiva
    private $typeValue;
    //retorno padrão para geração de SQL
    private $sql;
    //constantes de codificação do tipo de primitiva
    const INTEGER = 1;
    const STRING = 2;
    const FLOAT = 3;
    const BOOL = 4;
    const UNDEFINED = 9;    
    //construtor
    public function __construct($value = "", $name = ""){
        $this->setName($name);
        $this->setValue($value);
    }
    public function getValue(){
        return $this->value;
    }
    public function setValue($value){
        $this->value = $value;
        $this->setType();
        $this->setTypeValue();
        $this->setSql();        
    }
    public function setName($name){
        $this->name = $name; 
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
    private function setTypeValue(){      
        $this->typeValue = $this->isString() ? self::STRING : 
            ($this->isInteger() ? self::INTEGER : 
                ($this->isFloat() ? self::FLOAT :
                    ($this->isBool() ? self::BOOL : self::UNDEFINED)));
                    
    }   
    private function setSql(){
        switch($this->typeValue){
            case self::STRING :
                $this->sql = ("'{$this->value}'");
            break;
            default:
                $this->sql = $this->value;
        }
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
    public function name(){
        return get_class();
    }
    public function nameThis(){
        return get_class($this);
    }              
    public function toString(){
        return $this->value;
    }
}
/*
$pri = new Primitive(10,"pri");
echo "String: {$pri->isString()} <br />";
echo "Integer: {$pri->isInteger()} <br />";
echo "Float: {$pri->isFloat()} <br />";
echo "Type: {$pri->getType()}";
echo "<pre>";
print_r($pri);
echo "</pre>";
echo "{$pri->name()}<br />";
echo "{$pri->nameThis()}";
$pri = new Primitive(10);
echo "<pre>";
print_r($pri);
echo "</pre>";
$pri = new Primitive("0","pri");
echo "<pre>";
print_r($pri);
echo "</pre>";
*/
//http://php.net/manual/pt_BR/book.classobj.php
?>