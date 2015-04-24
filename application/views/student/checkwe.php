<?php $this->load->view("template/header.php");?>
<script type="text/javascript" src='<?php echo base_url();?>public/js/highcharts-4.0.3/highcharts.js'></script>
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">用水统计
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>
        <div class="panel-body" id="wcontainer">
          
        </div>
      </div>

        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">用电统计
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
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
            categories: ['04-05','04-06','04-07','04-08','04-09'],
            title: {
              text: '日期'
            }
        },
        yAxis: {
            min: 8,
            tickInterval:0.5,
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
            name: '你',
            data: [12,10,15,16,14],
        }, {
            type: 'spline',
            name: '平均',
            data: [12,12,12,12,12],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
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
            categories: ['04-05','04-06','04-07','04-08','04-09'],
            title: {
              text: '日期'
            }
        },
        yAxis: {
            min: 8,
            tickInterval:0.5,
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
            name: '你',
            data: [12,10,15,16,14],
        }, {
            type: 'spline',
            name: '平均',
            data: [12,12,12,12,12],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]
    });
});
</script>

<?php $this->load->view("template/footer.php");?>