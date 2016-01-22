<?php
trait Primitivizador {
    private function primitivizar($params = ""){
        if (!is_array($params)){
            $campos = get_object_vars ($this);
            foreach ($campos as $key => $value) {
                $this->$key = new Primitive($value, $key);            
            }      
            echo "<br>Por Objeto<br>";          
        } else {
            foreach ($params as $key => $value) {
                $this->$key = new Primitive($value, $key);                        
            }
            echo "<br>Por Array<br>";                           
        }       
    }        
}
?>