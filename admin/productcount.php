<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include_once '../classes/category.php'; ?>
<?php include_once '../classes/product.php'; ?>
<?php include_once '../lib/database.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thống kê số lượng sản phẩm</h2>
        <div class="block">
            <?php
            $db = new Database();
            $query = "SELECT catname, (SELECT COUNT(*) FROM tbl_product WHERE catid = c.catid) as product_count FROM tbl_category c ";
            $result = $db->select($query);

            $queryCount = "SELECT COUNT(*) FROM tbl_product;";
            $countProduct = $db->select($queryCount);
            $sumProduct = 0;
            $rowOdd = true;
            if($countProduct ){
                while ($row = pg_fetch_assoc($countProduct)) {
                    $sumProduct = $row['count'];
                }
            }

            if ($result) {
                echo "<table style='border-collapse: collapse; border: 1px solid black; margin: 0 auto; width: 30%;'>
                    <tr style='background-color: #c5d1fa'>
                    <th style='border: 1px solid black; text-align: left;
                    padding: 8px;'>Loại sản phẩm</th>
                    <th style='border: 1px solid black; text-align: center;
                    padding: 8px;'>Số lượng</th>
                    </tr>";
                while ($row = pg_fetch_assoc($result)) {
                    if($rowOdd == true){
                        echo "<tr>";
                        $rowOdd = false;
                    }
                    else {
                        echo "<tr style='background-color: #dcdcdc'>";
                        $rowOdd = true;
                    }
                    // echo "<tr>";
                    echo "<td style='border: 1px solid black; text-align: left;
                    padding: 8px;'>" . $row['catname'] . "</td>";
                    echo "<td style='border: 1px solid black;text-align: center;
                    padding: 8px;'>" . $row['product_count'] . "</td>";
                    echo "</tr>";
                }
                if($rowOdd == true){
                    echo "<tr>";
                }
                else {
                    echo "<tr style='background-color: #dcdcdc'>";
                }
                echo "<td style='border: 1px solid black; text-align: left;
                    padding: 8px;'>Tổng</td>";
                echo "<td style='border: 1px solid black; text-align: center;
                    padding: 8px;'>" . $sumProduct . "</td>";
                echo "<tr>";
                echo "</table>";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
