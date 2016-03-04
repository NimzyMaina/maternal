<?php require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
chk_lgn();
require 'templates/header.php';
?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard
                    <!-- <small>Add doctor</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                </ol>
            </div>
        </div>

        </div>
    </div>

<?php
require 'templates/footer.php';
?>
