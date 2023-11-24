    <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div id="site_info">
        <p>
         &copy; Copyright <a href="http://ElectronicsStoreGroup12.com">Training group 12</a>. All Rights Reserved.
        </p>
    </div>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery UI library -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
        $(
            function(){
                $("#datepicker_from").datepicker({
                    dateFormat: 'yy-mm-dd',
                    duration: "slow"
                });
                $("#datepicker_to").datepicker({
                    dateFormat: 'yy-mm-dd',
                    duration: "slow"
                });
            }
        );
    </script>
    <script>
        $(document).ready(function(){
            day365();

            var chart = new Morris.Bar({
                element: 'myfisrtchart',
                parseTime: false,
                xkey: 'date',
                ykeys: ['order', 'revenue', 'quantity'],
                labels: ['Số đơn hàng','Doanh thu','Số lượng']
            });

            $('.btn-locngay').click(function(){
                var from_date = $('.date_from').val();
                var from_to = $('.date_to').val();
                $.ajax({
                    url:"../ajax/thongke.php",
                    type:'post',
                    dataType:"JSON",
                    data:{from_date:from_date, from_to:from_to},
                    success:function(data){
                        chart.setData(data);
                    }
                });
            })

            $('.select-thongke').change(function(){
                var thoigian = $(this).val();
                if(thoigian == '7ngay'){
                    var text = '7 ngày qua';
                }else if(thoigian == '30ngay'){
                    var text = '30 ngày qua';
                }else if(thoigian == '90ngay'){
                    var text = '90 ngày qua';
                }else{
                    var text = '365 ngày qua';
                }
                $('#text-date').text(text);
                $.ajax({
                    url:"../ajax/thongke.php",
                    type:'post',
                    dataType:"JSON",
                    cache: false,
                    data: {thoigian:thoigian},
                    success:function(data){
                        chart.setData(data);
                    }
                });
            })

            function day365(){
                var text = '365 ngày qua';
                $('#text-date').text(text); //mặc định dữu liệu thống kê theo 365 ngày
                $.ajax({
                    url:"../ajax/thongke.php",
                    method:"POST",
                    dataType:"JSON",//return data type
                    cache: false,
                    success:function(data){
                        chart.setData(data);
                    }
                });
            }
        })
        
    </script>
</body>
</html>
