<?php
trait Primitivizador {
    private function primitivizar(){
        $campos = get_object_vars ($this);
        foreach ($campos as $key => $value) {
            $this->$key = new Primitive($value, $key);            
        }           
    }        
}
?>