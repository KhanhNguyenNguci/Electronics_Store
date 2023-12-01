<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../lib/database.php';?>

<div class="grid_10">
    <div class="box round first grid">
    <h2>Thống kê số lượng sản phẩm</h2>
        <div class="block">
            <?php
                $db = new Database();
                $query = "SELECT catname, (SELECT COUNT(*) FROM tbl_product WHERE catid = c.catid) as product_count FROM tbl_category c ";
                $result = $db->select($query);
                
                if($result){
                    echo "<table style='border-collapse: collapse; border: 1px solid black; margin: 0 auto;'>
                    <tr>
                    <th style='border: 2px solid black;'>Danh mục</th>
                    <th style='border: 2px solid black;'>Số lượng</th>
                    </tr>";
                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td style='border: 1px solid black;'>" . $row['catname'] . "</td>";
                        echo "<td style='border: 1px solid black;'>" . $row['product_count'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
       </div>
    </div>
</div>

<?php include 'inc/footer.php';?>