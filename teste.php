<?php
require_once("primitive.php");
require_once("traitPrimitivizador.php");
class Teste {
    use Primitivizador;
    public $name = "Rogério";
    public $surName = "Pereira";
    private $idade = 38;
    public function __construct(){
        /*
        $this->name = new Primitive($this->name, "name");
        $this->surName = new Primitive($this->surName, "surName");
        $this->idade = new Primitive($this->idade, "idade");
        */           
        /*
        $campos = get_object_vars ($this);
        foreach ($campos as $key => $value) {
            $this->$key = new Primitive($value, $key);            
        } 
        */
        $this->primitivizar();           
    }
}

$teste = new Teste();
echo "<pre>";
print_r($teste);
echo "</pre>";
echo "{$teste->name->toString()} <br />";
?>