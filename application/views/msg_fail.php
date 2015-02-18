<?php include('template/header.php');?>

<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-md-4 "></div>
    <div class="col-md-4 ">
        <h1>
        <span class="glyphicon glyphicon-remove"></span>
        <?php echo $msg;?>
        </h1>
        <p><a href="#" onclick = "window.location.href=<?php echo "'".$url."'";?>"><span id="sec">3秒</span>后自动返回</a></p>
    </div>
</div>
<script type="text/javascript">
function count(sec)
{
    var time = document.getElementById("sec")
    time.innerHTML = sec+" 秒";
    sec-=1;
    var id = setTimeout("count("+sec+")",1000);
    if(sec < 0)
    {
        clearTimeout(id);
        window.location.href=<?php echo "'".$url."'";?>
    }    
}
count(3);
</script>
<?php include('template/footer.php');?>