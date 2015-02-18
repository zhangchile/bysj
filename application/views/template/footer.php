      <hr>

      <footer>
        <p>&copy; 张智励 2015</p>
      </footer>

    </div><!--/.container-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $("#delete,a[type=button]").click(function(){
        $("#del_ok").attr("href",$(this).attr('data'));
     });
    $("#add,a[type=button]").click(function(){
      $("#add_groupid").attr("value",$(this).attr("data-groupid"));
    });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
          $('.row-offcanvas').toggleClass('active');
        });
      });
    </script>
  </body>
</html>