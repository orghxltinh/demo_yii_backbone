<?php
    $cs = Yii::app()->clientScript;
    $start = strtotime('today');
    $customer = Customer::model()->findAll();
    $num = 0; $total=0;
    
    foreach($customer as $item):
        $total++;
        if ($item->create_date > $start) $num ++;
    endforeach;
    
    $question = Question::model()->findAll();
    $arrName = array(); $arrNum = array();
    foreach ($question as $item):
        $arrName[] ='"'. $item->text.'"';
        $cus_ques = $item->customerQuestions;
        $arrNum[] =  count($cus_ques);
    endforeach;
    $strName = implode(',',$arrName);
    $strNum = implode(',',$arrNum);
    
    $cs->registerScript('adminPanel_global','
        window.ap = {};
        ap.todayCus = '.$num.';
        ap.totalCus = '.$total.';
        ap.quesName = ['.$strName.'];        
        ap.quesNum = ['.$strNum.'];            
            ',  CClientScript::POS_HEAD);
?>
<div id="adminpanel" class="one-clear">    
    <div id="customer-infos" class="one-left">
        <div id="new-custom-num" class="btn btn-danger">
            <span id="num">0</span><span id="text">Today New Customers</span>
            <i class="fa fa-users fa-4x"></i>
        </div>
        <div id="total-custom" class="btn btn-danger">
            <span id="num">0</span><span id="text">Total Customers</span>
            <i class="fa fa-bar-chart-o fa-4x"></i>
        </div>
    </div>
    <div id="chart-cus-nums" class="one-left canvas-wrapper">
        <div id="line-title" class="one-clear title"><b>Ghests visited our page</b></div>
        <canvas width="500px" height="300px"></canvas>
    </div>
    
    <div id="bar-title" class="one-clear title"><b>Question's information:</b></div>
    <div id="chart-bar" class="one-clear canvas-wrapper">
        <canvas width="900px" height="500px"></canvas>
        
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    var $adminpanel = $('#adminpanel'),
        $cus_nums = $adminpanel.find('#chart-cus-nums'), canvas = $cus_nums.find('canvas'),
        $chart_bar = $adminpanel.find('#chart-bar'), cbcanvas = $chart_bar.find('canvas'),
        ctx = canvas[0].getContext('2d'), $todayNum = $adminpanel.find('#new-custom-num #num'),
        $totalNum = $adminpanel.find('#total-custom #num');
        
       
    var dataToday = [20, 30, 40, 32, 30, ap.todayCus];
        dataLine = {
            labels: ["5 days before", "4 days before", "3 days before", "2 days before", "1 day before", "Today"],
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: dataToday
                }
            ]
        };
    var myLineChart = new Chart(ctx).Line(dataLine, { responsive: true });
    
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var barChartData = {
            labels : ap.quesName,
            datasets : [
                    
                    {
                            fillColor : "rgba(151,187,205,0.5)",
                            strokeColor : "rgba(151,187,205,0.8)",
                            highlightFill : "rgba(151,187,205,0.75)",
                            highlightStroke : "rgba(151,187,205,1)",
                            data : ap.quesNum
                    }
            ]

    };
    var cbctx = cbcanvas[0].getContext('2d');
    var mybarChart = new Chart(cbctx).Bar(barChartData, {
            responsive : true
    });
    
    inscreaseNum($todayNum,ap.todayCus,1000);
    inscreaseNum($totalNum,ap.totalCus,1000);
            
    function inscreaseNum($num,to,time){
        var eachtime = time/to;
        var num = 0;
        setTimeout(function(){
            var loop = setInterval(function(){
                if(num <= to){
                    $num[0].innerHTML = num++;
                }
                else clearInterval(loop);
            },eachtime);
        },400);
    }
});
</script>