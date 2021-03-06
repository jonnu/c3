<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="author" content="Creative Insight">
		<title>Administration</title>
		<link rel="canonical" href="<?php echo site_url(); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('styles/core.css', 'core'); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/jcrop-0.9.9/jquery.jcrop-0.9.9.css', 'core'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/fileuploader-1.0.0/fileuploader-1.0.0.css', 'core'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/fancybox-1.3.4/jquery.fancybox-1.3.4.css', 'core'); ?>" />		
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/uploadify-3.0.0/uploadify.css', 'core'); ?>" />
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
		<script src="<?php echo $this->uri->skin('scripts/modernizr-2.0.6.min.js', 'core'); ?>"></script>
		<style>
		
		.qq-upload-list { display: none; }
		.qq-upload-list .ui-state-highlight { background: #ffd07f !important; height: 20px; }
		</style>
	</head>
	<body>
		
		<div id="admin">
			
			<div id="header">
				
				<div class="constrain">
				
					<h1><?php echo $this->lang->line('admin_title'); ?></h1>
					
					<h6>Logged in as <span><?php echo $this->administrator->name(); ?></span></h6>
					
					<ul id="menu-admin" class="clearfix">
						<li<?php echo $this->router->fetch_class() == 'main' ? ' class="selected"' : ''; ?>><?php echo anchor('admin', 'Home'); ?></li>
						<?php foreach($this->insight->modules() as $module_name => $module_title): ?>
						<li<?php echo $this->router->fetch_module() == $module_name ? ' class="selected"' : ''; ?>><?php echo anchor('admin/' . $module_name, $module_title); ?></li>
						<?php endforeach; ?>
						<li<?php echo $this->router->fetch_class() == 'settings' ? ' class="selected"' : ''; ?>><?php echo anchor('admin/settings', 'Settings'); ?></li>
						<li class="right-child last-child"><?php echo anchor('admin/logout', $this->lang->line('admin_auth_logout')); ?></li>
					</ul>
					
				</div>
				
			</div>
			
			<div id="submenu" style="background: #f9f9f9; box-shadow: 0 2px 8px #ddd; display: none;" class="clearfix">
				<div class="constrain">
					<ul id="menu-admin-sub" style="list-style: none; float: right; position: relative; right: 50%; padding: 4px 0 8px 0;">
						<li style="position: relative; left: 50%; float: left; margin-right: 8px;"><a href="#" style="display: block;">x</a></li>
						<li style="position: relative; left: 50%; float: left; margin-right: 8px;"><a href="#" style="display: block;">x</a></li>
						<li style="position: relative; left: 50%; float: left;"><a href="#" style="display: block;">x</a></li>
					</ul>
				</div>
			</div>
			
			<div id="main">
				
				<div class="constrain">
			
					<?php if(false !== $this->session->flashdata('admin/message', false)): ?>
					<div class="flash-message">
						<?php echo $this->session->flashdata('admin/message'); ?>
						<a class="icon-close" href="javascript:;">x</a>
					</div>
					<?php endif; ?>
				
