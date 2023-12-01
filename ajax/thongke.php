<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    require_once('../carbon/autoload.php'); //sửa dụng carbon lấy ra thứ ngày tháng
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
?>
<?php
    $db = new Database();
    
    if(isset($_POST['thoigian'])){
        $thoigian = $_POST['thoigian']; //lấy ra thời gian
    }else{
        $thoigian = '';
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    if($thoigian == '7ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    }elseif($thoigian == '30ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
    }elseif($thoigian == '90ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
    }elseif($thoigian == '365ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); //lấy time hiện tại, chỉ lấy ngày
    if(isset($_POST['from_date']) && $_POST['from_to']){
        $from = $_POST['from_date'];
        $to = $_POST['from_to'];
        $query = "SELECT * FROM tbl_thongke WHERE date_thongke BETWEEN '$from' AND '$to' ORDER BY date_thongke ASC";
    }else{
        $query = "SELECT * FROM tbl_thongke WHERE date_thongke BETWEEN '$subdays' AND '$now' ORDER BY date_thongke ASC";
    }
    $result = $db->select($query);
    
    //echo $query;
    //dữ liệu là mảng gồm các phần tử phía dưới
    $chart_data = array();
    if($result){
        while ($row = pg_fetch_assoc($result)) {
            $chart_data[] = array(
                'date' => $row['date_thongke'],
                'order' => $row['donhang'],
                'revenue' => $row['doanhthu'],
                'quantity' => $row['soluong']
            );
        }
    }

    //print_r($chart_data);
    echo $data = json_encode($chart_data); //dữ liệu dạng JSON
?>