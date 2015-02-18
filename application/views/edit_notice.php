<?php include("template/header.php");?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php echo $sidebar;?>
        <!--end 左侧栏-->
      <div class="col-md-8">
<?php //var_dump(($notice['id']));?>
        <form class="form-horizontal" role="form" action="<?php echo site_url("notice/update")?>" method="post">
            <input type="hidden" name="id" value="<?php echo $notice['id'];?>">
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $notice['title']?>">
            </div>
          </div>
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">内容</label>
            <div class="col-sm-offset-2 col-sm-10">
              <textarea id="content_area" name="content" class="form-control" rows="12"><?php echo $notice['content'];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">更新</button>
              <a href="<?php echo site_url("notice")?>" type="button" class="btn btn-primary">返回</a>
            </div>
          </div>
        </form>
<script type="text/javascript" src="<?php echo base_url();?>public/js/nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { 
    new nicEditor({iconsPath : '<?php echo base_url();?>public/js/nicEditorIcons.gif'}).panelInstance('content_area');
  });
</script>
<?php include("template/footer.php");?>