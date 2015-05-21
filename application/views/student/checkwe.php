<?php $this->load->view("template/header.php");?>
<script type="text/javascript" src='<?php echo base_url();?>public/js/highcharts-4.0.3/highcharts.js'></script>
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9">
        <div id="wpannel" class="panel panel-default">
        <!-- Default panel contents -->
        <div  class="panel-heading">用水统计
        <div class="btn-group btn-group-xs" role="group" style="float:right;">
          <a type="button" class="btn <?php echo $wunit_url['lastweek']['class']?>" href="<?php echo $wunit_url['lastweek']['url']?>">上个星期</a>
          <a type="button" class="btn <?php echo $wunit_url['lastmonth']['class']?>" href="<?php echo $wunit_url['lastmonth']['url']?>">上个月</a>
        </div>
        </div>
        <div class="panel-body" id="wcontainer">
          
        </div>
      </div>
      <div id="epart"></div>
        <div id="epannel" class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">用电统计
        <div class="btn-group btn-group-xs" role="group" aria-label="" style="float:right;">
          <a type="button" class="btn <?php echo $eunit_url['lastweek']['class']?>" href="<?php echo $eunit_url['lastweek']['url']?>#epart">上个星期</a>
          <a type="button" class="btn <?php echo $eunit_url['lastmonth']['class']?>" href="<?php echo $eunit_url['lastmonth']['url']?>#epart">上个月</a>
        </div>
        </div>
        <div class="panel-body" id="econtainer">
          
        </div>
      </div>

      </div>
      </div><!--/row-->

<script type="text/javascript">
$(function () {
 $('#wcontainer').highcharts({
        title: {
            text: '用水量图'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            // categories: ['04-05','04-06','04-07','04-08','04-09'],
            categories: <?php echo json_encode($wdata['date']);?>,
            title: {
              text: '日期'
            }
        },
        yAxis: {
            // min: 8,
            // tickInterval:0.5,
            title: {
                text: 'm³（吨）'
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true,
            valueSuffix: ' m³（吨）'
        },
        series: [{
            type: 'column',
            name: '用水量',
            // data: [12,10,15,16,14],
            data: <?php echo json_encode($wdata['useage']);?>,
        }, {
            type: 'spline',
            name: '费用',
            // data: [12,12,12,12,12],
            data: <?php echo json_encode($wdata['totalprize']);?>,
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            },
            tooltip: {
                valueSuffix: ' 元'
            }
        }]
    });


  $('#econtainer').highcharts({
        title: {
            text: '用电量图'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: <?php echo json_encode($edata['date']);?>,
            title: {
              text: '日期'
            }
        },
        yAxis: {
            // min: 8,
            // tickInterval:0.5,
            title: {
                text: 'KW/h（度）'
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true,
            valueSuffix: ' KW/h（度）'
        },
        series: [{
            type: 'column',
            name: '用电量',
            data: <?php echo json_encode($edata['useage']);?>,
        }, {
            type: 'spline',
            name: '费用',
            data: <?php echo json_encode($edata['totalprize']);?>,
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            },
            tooltip: {
                valueSuffix: ' 元'
            }
        }]
    });
});
</script>

<?php $this->load->view("template/footer.php");?>