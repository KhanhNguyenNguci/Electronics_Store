<?php
include '../config/config.php';
?>
<?php
class Database
{
  public $host = DB_HOST;
  public $port = DB_PORT;
  public $dbname = DB_NAME;
  public $user = DB_USER;
  public $pass = DB_PASSWORD;

  public $link;
  public $error;

  public function __construct()
  {
    $this->connectDB();
  }

  public function connectDB()
  {
    $this->link = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" .
      $this->dbname . " user=" . $this->user . " password=" . $this->pass . " sslmode=prefer connect_timeout=10");

    if (!$this->link) {
      $this->error = "Connection fail: " . pg_last_error();
      return false;
    }
  }

  // Select or Read data
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
   $insert_row = pg_query($this->link, $query);
   if (!$insert_row) {
    die(pg_last_error($this->link) . " at line " . __LINE__);
   }
   if($insert_row){
     return $insert_row;
   } else {
     return false;
   }
 }

  
// Update data
 public function update($query){
   $update_row = pg_query($this->link, $query);
   if (!$update_row) {
    die(pg_last_error($this->link) . " at line " . __LINE__);
   }
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
