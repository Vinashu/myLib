<?php
header("Content-Type: text/html; charset=UTF-8",true);
require_once("classEntity.php");
class Banco extends Entity{
      protected static $db;
      protected static $server = "localhost";
      protected static $user = "root";
      protected static $pwd = "";
      protected static $nameDB = "lol";
      protected static $res;
      protected static $db_selected;
      
      public Function connect(){
             $this->db = mysql_connect(self::$server, self::$user, self::$pwd);
             if (!$this->db) {
                 die('Não foi possível conectar: ' . mysql_error());
             }
             //echo utf8_encode("Conexão efetuada com sucesso<br>");
             //echo ("Conexão efetuada com sucesso<br>");
      }

      public function disconnect(){
             mysql_close($this->db);
             //echo utf8_encode("Desconexão efetuada com sucesso<br>");
             //echo ("Desconexão efetuada com sucesso<br>");
      }
      
      public function selectDb(){
              $this->db_selected = mysql_select_db(self::$nameDB, $this->db);
              if (!$this->db_selected) {
                  die ('Impossível abrir o banco : ' . mysql_error());
              }
              //echo utf8_encode("Banco selecionado com sucesso<br>");
              //echo ("Banco selecionado com sucesso<br>");
      }
      public function executeQuery($sql,$type){
             $this->res = mysql_query($sql);
             if (!$this->res) {
                die('Query inválida: ' . mysql_error());
             }
             switch($type){
                 //0 - insert
                 //1 - localiza id
                 case 1:
                     $linha = mysql_fetch_assoc($this->res);
                     mysql_free_result($this->res);
                     return($linha["id"]);
                 break;
                 //2 - update
                 //3 - localiza por id
                 case 3:
                     $linha = mysql_fetch_assoc($this->res);
                     mysql_free_result($this->res);
                     return($linha);
                 break;
                 //4 - deletar
                 //5 - listar todas
                 case 5:
                     //while($linha = mysql_fetch_array($this->res,MYSQLI_ASSOC))
                     while($linha = mysql_fetch_object($this->res,get_class($this)))
                     {
                          $linhas[] = $linha;
                     }
                     mysql_free_result($this->res);
                     return($linhas);
                 break;
             }
      }
    public function listar($table){
          $sql = "Select * from $table";
          $this->connect();
          $this->selectDb();
          $this->res = mysql_query($sql);
          $this->disconnect();
          while($linha = mysql_fetch_object($this->res,get_class($this)))
          {
              $linhas[] = $linha;
          }
          mysql_free_result($this->res);
          return($linhas);
    }
    public function carregar($dados){
           $dados = explode("|", trim($dados));
           $campos = get_object_vars ($this);
           $i = 0;
           foreach ($campos as $key => $value) {
             call_user_func(array(__CLASS__, "set$key"),$dados[$i]) ;
             $i++;
           }
    }
    public function salvar($table){
           $campos = get_object_vars ($this);
           $sql = "Insert into " . $table . " (";
           $sqlI = "";
           $sqlF = "";
           foreach ($campos as $key => $value) {
             $sqlI .= "$key,";
             $sqlF .= "'" . "$value" . "',";
           }
           $sqlI = substr($sqlI,0,strlen($sqlI)-1) . ") values (";
           $sqlF = substr($sqlF,0,strlen($sqlF)-1) . ")";
           $sql .= $sqlI . $sqlF;
           //echo $sql . "<br />";

           $this->connect();
           $this->selectDb();
           //$this->executeQuery($sql,0);
           $this->res = mysql_query($sql);
           $this->disconnect();

           /*
           $campos = get_object_vars ($this);
           $sql = "Insert into " . $table . " (";
           foreach ($campos as $key => $value) {
               $sql .= "$key,";
           }
           $sql = substr($sql,0,strlen($sql)-1) . ") values (";
           foreach ($campos as $key => $value) {
             //$sql .= "'" . call_user_func(array(__CLASS__, "get$key")) . "',";
             $sql .= "'" . "$value" . "',";
           }
           $sql = substr($sql,0,strlen($sql)-1) . ")";
           echo $sql . "<br />";
           */
    }
    public function gerarSQL($table){
           $campos = get_object_vars ($this);
           $sql = "Insert into " . $table . " (";
           $sqlI = "";
           $sqlF = "";
           foreach ($campos as $campo) {
             $sqlI .= "{$campo->getName()},";
             $sqlF .= "{$campo->getSql()},";             
           }
           $sqlI = substr($sqlI,0,strlen($sqlI)-1) . ") values (";
           $sqlF = substr($sqlF,0,strlen($sqlF)-1) . ")";
           $sql .= $sqlI . $sqlF;
           echo $sql . "<br />";                    
    }
      //mysql_num_rows() para obter quantas linhas foram retornadas para um comando SELECT ou
      //mysql_affected_rows() para obter quantas linhas foram afetadas por um comando DELETE, INSERT, REPLACE, ou UPDATE.
}

?>

