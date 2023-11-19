<?php
  include '../config/config.php';
?>
<?php
Class Database{
  public $host = DB_HOST;
  public $port = DB_PORT;
  public $dbname = DB_NAME;
  public $user = DB_USER;
  public $pass = DB_PASSWORD;
 
   public $link;
   public $error;
 
 public function __construct(){
  $this->connectDB();
 }
 private function connectDB() {
  $this->link = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" . 
      $this->dbname . " user=" . $this->user . " password=" . $this->pass . " sslmode=prefer connect_timeout=10");
  
  if(!$this->link) {
      $this->error = "Connection fail: " . pg_last_error();
      return false;
  }
}
// private function connectDB(){
//    $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname, intval($this->port));
//    if(!$this->link){
//      $this->error ="Connection fail".$this->link->connect_error;
//     return false;
//    }
//  }

 
public function select($query) {
  $result = pg_query($this->link, $query);
  if (!$result) {
      die(pg_last_error($this->link) . " at line " . __LINE__);
  }
  if (pg_num_rows($result) > 0) {
      return $result;
  } else {
      return false;
  }
}

// Insert data
public function insert($query){
   $insert_row = $this->link->query($query) or 
     die($this->link->error.__LINE__);
   if($insert_row){
     return $insert_row;
   } else {
     return false;
    }
 }
  
// Update data
 public function update($query){
   $update_row = $this->link->query($query) or 
     die($this->link->error.__LINE__);
   if($update_row){
    return $update_row;
   } else {
    return false;
    }
 } 
  
// Delete data
 public function delete($query){
   $delete_row = $this->link->query($query) or 
     die($this->link->error.__LINE__);
   if($delete_row){
     return $delete_row;
   } else {
     return false;
    }
   }
 
}
