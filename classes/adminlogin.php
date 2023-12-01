<?php
    include '../lib/session.php';
    Session::checkLogin();
    include '../lib/database.php';
    include '../helpers/format.php';
?>
<?php
    class adminlogin
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminUser, $adminPass)
        {
            $adminUser = $this->fm->validation($adminUser); //check valid value
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = pg_escape_string($this->db->link, $adminUser); //connect DB
            $adminPass = pg_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass))
            {
                $alert = "User and Passsword must be not empty";
                return $alert;
            }
            else
            {
                //echo "Database connection established.<br>";
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'"; //CONNECT DB
                //echo "Database connection established.<br>";
                $result = $this->db->select($query); //Process DB
                //echo "Database connection established.<br>";
                if($result != false)
                {
                    
                    $value = pg_fetch_assoc($result); //only return arr[char] # fetch_array: arr[char] or arr[number]
                    
                    Session::set('adminlogin', true);
                    Session::set('adminId', $value['adminid']);
                    Session::set('adminUser', $value['adminuser']);
                    Session::set('adminName', $value['adminname']);

                    header('Location:index.php'); //true => back location
                }
                else
                {
                    $alert = "User and Passsword not match";
                    return $alert;
                }
            }
        }
    }
?>