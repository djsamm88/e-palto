<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo config_item('app_client1')?> | <?php echo config_item('app_name')?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<!--<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/ionic/ionic.min.css">-->
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/dist/css/adminlte.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/morris/morris.css">

	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/DataTables/datatables.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/datepicker/datepicker3.css">
	Daterange picker 
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/daterangepicker/daterangepicker-bs3.css">-->
	<!-- jquery-ui -->
	<link rel="stylesheet" type="text/css" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/jquery-ui/1103/jquery-ui.css"/>
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo config_item('asset_url'); ?>assets/apps/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Google Font: Source Sans Pro -->
	

	<style type="text/css">

	label{
		padding: 2px 5px;
		font-size: 12px;
	}
	.nav-tabs{
		border-bottom: 8px solid #fff;
	}
	.nav-tabs li.nav-item a.nav-link{
		background-color: #fff;
		margin: 1px;
		border-top: 4px solid #d4edd9;
		border-left: 1px solid #d4edd9;
		border-right: 1px solid #d4edd9;
	}
	.nav-tabs li.nav-item:hover a.nav-link{
		border-top: 4px solid #28a745;
		border-left: 1px solid #28a745;
		border-right: 1px solid #28a745;
		border-bottom: none;
	}
	.nav-tabs li.nav-item a.active{
		border-top: 4px solid #28a745;
		border-left: 1px solid #28a745;
		border-right: 1px solid #28a745;
	}
	.table{
		margin: 0;
		padding:0;
	}
	.table th{
		background-color: #eee;
		padding: 8px 5px;
		border-top: 2px solid #ccc;
		text-transform: capitalize;
	}

	.table thead.thead2 th{
		padding: 2px;
	}
	.btn{
		text-transform: capitalize;
	}
	.tanggal{
		width: 100px;
		float: left;
	}
	.table-responsive{
		border-bottom: 1px solid #ddd;
		margin-bottom: 20px;
	}
	.line-h{
		margin-top: 15px;
		border-bottom: 5px solid #aaa;
	}

	#cssmenu > ul > li > ul > li > a.active{
		background-color: rgba(255,255,255,.2);
		color: #fff;
	}
</style>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">