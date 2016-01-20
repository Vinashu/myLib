<?php
require_once("primitive.php");
class Teste {
    public $name = "Rogério";
    public $surName = "Pereira";
    private $idade = 38;
    public function __construct(){
        $this->name = new Primitive($this->name, "name");
        $this->surName = new Primitive($this->surName, "surName");
        $this->idade = new Primitive($this->idade, "idade");               
    }
}

$teste = new Teste();
echo "<pre>";
print_r($teste);
echo "</pre>";
echo "{$teste->name->toString()} <br />";
?>