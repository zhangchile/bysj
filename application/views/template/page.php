<nav>
  <ul class="pagination">
    <li  <?php if($currpage == 1) echo ' class="disabled" '?>><a href="#<?php echo $base_url;?>">&laquo;</a></li>
    <?php foreach ($variable as $key => $value) :?>
    <li <?php if() echo ' class="active" '?>class="active"><a href="#<?php echo $base_url;?>">1</a></li>
    <li <?php if() echo ' class="active" '?>><a href="#<?php echo $base_url;?>">2</a></li>
    <li <?php if() echo ' class="active" '?>><a href="#<?php echo $base_url;?>">3</a></li>
    <li <?php if() echo ' class="active" '?>><a href="#<?php echo $base_url;?>">4</a></li>
    <li <?php if() echo ' class="active" '?>><a href="#<?php echo $base_url;?>">5</a></li>
    <?php endforeach;?>
    <li><a href="#">&raquo;</a></li>
  </ul>
</nav>