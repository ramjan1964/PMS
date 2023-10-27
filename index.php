<?php


require_once 'header.php';
?>
  <div class="content">
    <!-- content HEADER -->

<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
        <!--folding location of form--->
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row animated fadeInUp">
        <div class="col-sm-12">
 <?php
echo $page;
 ?>

    </div>
    </div>
    </div>
    </div>
    <?php
    require_once 'footer.php';
    ?>