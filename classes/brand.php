<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
?>
<?php
    class brand
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_brand($brandName)
        {
            $brandName = $this->fm->validation($brandName); //check valid value
            $brandName = mysqli_real_escape_string($this->db->link, $brandName); //connect DB

            if(empty($brandName))
            {
                $alert = "<span class= 'error'>Brand must be not empty</span>";
                return $alert;
            }
            else
            {
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')"; //CONNECT DB
                $result = $this->db->insert($query); //Process DB
                if($result)
                {
                    $alert = "<span class= 'success'>Insert Brand Successfully</span>";
                    return $alert;
                }
                else
                {
                    $alert = "<span class= 'error'>Insert Brand Not Success</span>";
                    return $alert;
                }
            }
        }
        public function show_brand()
        {
            $query = "SELECT * FROM tbl_brand order by brandId desc"; //CONNECT DB
            $result = $this->db->select($query); //Process DB
            return $result;
        }
        public function getbrandbyId($id){
            $query = "SELECT * FROM tbl_brand where brandId = '$id' "; //CONNECT DB
            $result = $this->db->select($query); //Process DB
            return $result;
        }
        public function update_brand($brandName, $id){
            $brandName = $this->fm->validation($brandName); //check valid value
            $brandName = mysqli_real_escape_string($this->db->link, $brandName); //connect DB
            $id = mysqli_real_escape_string($this->db->link, $id); //connect DB

            if(empty($brandName))
            {
                $alert = "<span class= 'error'>Brand must be not empty</span>";
                return $alert;
            }
            else
            {
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'"; //CONNECT DB
                $result = $this->db->update($query); //Process DB
                if($result)
                {
                    $alert = "<span class= 'success'>Brand Updated Successfully</span>";
                    return $alert;
                }
                else
                {
                    $alert = "<span class= 'error'>Brand Updated Not Success</span>";
                    return $alert;
                }
            }
        }
        public function del_brand($id){
            $query = "DELETE FROM tbl_brand where brandId = '$id' "; //CONNECT DB
            $result = $this->db->delete($query); //Process DB
            if($result)
            {
                $alert = "<span class= 'success'>Brand Deleted Successfully</span>";
                return $alert;
            }
            else
            {
                $alert = "<span class= 'error'>Brand Deleted Not Success</span>";
                return $alert;
            }
        }
        
    }
?>