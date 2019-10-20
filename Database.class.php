<?php
class Database{
    public $isConnect;
    protected $datab;
    //To connect into the database
    public function __construct($username="phpmyadmin",$pass="entrepreneur2019",$host="localhost",$dbname="HOPITAL"){
        $isConnect=TRUE;
        try {
            $this->datab=new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username,$pass);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw newException ($e->getMessage());
        }
    }
    //Disconnect to the database
    public function Disconnect(){
        $this->datab=NULL;
        $this->isConnect=FALSE;
    }
    //get one row 
    public function getRow($query,$params=[]){
        try {
            $preparation=$this->datab->prepare($query);
            $preparation->execute($params);
            return $preparation->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            
        }

    }
    //get many rows
    public function getRows($query,$params=[]){
        try {
        $preparation=$this->datab->prepare($query);
        $preparation->execute($params);
        return $preparation->fetchAll();
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
    //Insert row
    public function insertRow($query,$params=[]){
        try {
            $preparation=$this->datab->prepare($query);
            $preparation->execute($params);
            return TRUE;
        }
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
            
        }
    }
    //Update Row
    public function updateRow($query,$params=[]){
        try {
            $preparation=$this->datab->prepare($query);
            $preparation->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

    }
    //Delete Row
    public function deleteRow($query,$params=[]){
        try {
            $preparation=$this->datab->prepare($query);
            $preparation->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
?>
