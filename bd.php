 
 <?php
 
 class bd{
     private $servidor = "localhost:3307";
     private $usuario = "root";
     private $contrasenia = "";

     public function __construct(){
        try{
       $this->bd= new PDO("mysql:host=$this->servidor;dbname=album",$this->usuario,$this->contrasenia );
       $this->bd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         }catch(PDOException $error ){
             return "falla de conexion".$error;
        }
     }
    public function ejecutar($sql){// insertar/eliminar/actualizar
         $this->bd->exec($sql);
         return $this->bd->lastInsertId();
    }
    public function consultar($sql){

         $sentencia = $this->bd -> prepare($sql);
         $sentencia->execute();
         return $sentencia->fetchAll();
    }
 }
 
 ?>