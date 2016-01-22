<?php
require_once("primitive.php");
require_once("traitPrimitivizador.php");
class Teste {
    use Primitivizador;
    public $name = "Rogério";
    public $surName = "Pereira";
    public $idade = 38;
    public function __construct(){
        //aceita como parâmetro array com lista de campos
        //para serem primitivizados, caso contrário 
        //primitivizará todos
        $this->primitivizar();           
    }
}
$teste = new Teste();
echo "<pre>";
print_r($teste);
echo "</pre>";
echo "{$teste->name->toString()} <br />";
?>