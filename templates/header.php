<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>maternal health care system </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/formValidation.css" rel="stylesheet">

    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

    <link href="bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet">

    <link href="<?=asset('/bower_components/sweetalert2/dist/sweetalert2.css')?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.1.1/css/buttons.dataTables.min.css" rel="stylesheet">



    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/formValidation.min.js"></script>
    <script src="js/framework/bootstrap.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>

    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

    <script src="<?=asset('/bower_components/sweetalert2/dist/sweetalert2.min.js')?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.1.1/js/buttons.flash.min.js"></script>
   <script src="//cdn.datatables.net/buttons/1.1.1/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.1.1/js/buttons.print.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=asset('')?>">Maternal</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['full_name']?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?=asset('/logout.php')?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>

        <?php
        require 'templates/menu.php';
        ?>