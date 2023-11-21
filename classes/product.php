<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php'
?>
<?php
    class product
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_product($data, $files)
        {
            $productName = pg_escape_string($this->db->link, $data['productName']); //connect DB
            $category = pg_escape_string($this->db->link, $data['category']); //connect DB
            $brand = pg_escape_string($this->db->link, $data['brand']); //connect DB
            $product_desc = pg_escape_string($this->db->link, $data['product_desc']); //connect DB
            $price = pg_escape_string($this->db->link, $data['price']); //connect DB
            $type = pg_escape_string($this->db->link, $data['type']); //connect DB
            //kiem tra hinh anh va lay hinh anh cho vao folder uploads
            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName =="" || $category =="" || $brand =="" || $product_desc =="" || $price =="" || $type =="" || $file_name =="")
            {
                $alert = "<span class= 'error'>Fields must be not empty</span>";
                return $alert;
            }
            else
            {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, type, price, image) VALUES('$productName','$category','$brand','$product_desc','$type','$price','$unique_image')"; //CONNECT DB
                $result = $this->db->insert($query); //Process DB
                if($result)
                {
                    $alert = "<span class= 'success'>Insert Product Successfully</span>";
                    return $alert;
                }
                else
                {
                    $alert = "<span class= 'error'>Insert Product Not Success</span>";
                    return $alert;
                }
            }
        }
        public function show_product()
        {
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
            FROM tbl_product 
            INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
            order by tbl_product.productId desc";

            //$query = "SELECT * FROM tbl_product order by productId desc"; //CONNECT DB
            $result = $this->db->select($query); //Process DB
            return $result;
        }
        public function update_product($data, $files, $id){

            $productName = pg_escape_string($this->db->link, $data['productName']); //connect DB
            $category = pg_escape_string($this->db->link, $data['category']); //connect DB
            $brand = pg_escape_string($this->db->link, $data['brand']); //connect DB
            $product_desc = pg_escape_string($this->db->link, $data['product_desc']); //connect DB
            $price = pg_escape_string($this->db->link, $data['price']); //connect DB
            $type = pg_escape_string($this->db->link, $data['type']); //connect DB
            //kiem tra hinh anh va lay hinh anh cho vao folder uploads
            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName =="" || $category =="" || $brand =="" || $product_desc =="" || $price =="" || $type =="")
            {
                $alert = "<span class= 'error'>Fields must be not empty</span>";
                return $alert;
            }
            else
            {
                if(!empty($file_name)){ //neu nguoi dung chon anh
                    if($file_size > 20480){ //20MB
                        $alert = "<span class= 'error'>Image Size should be less then 20MB!</span>";
                        return $alert;
                    }elseif(in_array($file_ext, $permited) === false){
                        //echo "<span class='error'>You can upload only:-".implode(',', $permited)."</span>";
                        $alert = "<span class= 'error'>You can upload only:-".implode(',', $permited)."</span>";
                        return $alert;
                    }
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName', 
                    brandId = '$brand', 
                    catId = '$category', 
                    type = '$type', 
                    price = '$price', 
                    image = '$unique_image', 
                    product_desc = '$product_desc' 
                    WHERE productId = '$id'";

                }
                else{ //neu nguoi dung khong chon anh
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName', 
                    brandId = '$brand', 
                    catId = '$category', 
                    type = '$type', 
                    price = '$price', 
                    product_desc = '$product_desc' 
                    WHERE productId = '$id'";
                }
            }
            $result = $this->db->update($query); //Process DB
            if($result)
            {
                $alert = "<span class= 'success'>Product Updated Successfully</span>";
                return $alert;
            }
            else
            {
                $alert = "<span class= 'error'>Product Updated Not Success</span>";
                return $alert;
            }

        }
        public function del_product($id){
            $query = "DELETE FROM tbl_product where productId = '$id' "; //CONNECT DB
            $result = $this->db->delete($query); //Process DB
            if($result)
            {
                $alert = "<span class= 'success'>Product Deleted Successfully</span>";
                return $alert;
            }
            else
            {
                $alert = "<span class= 'error'>Product Deleted Not Success</span>";
                return $alert;
            }
        }
        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product where productId = '$id' "; //CONNECT DB
            $result = $this->db->select($query); //Process DB
            return $result;
        }
    }
?>