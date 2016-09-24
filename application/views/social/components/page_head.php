<!DOCTYPE html>
<html>
<head>
    <title><?php echo $meta_title; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">

    <link href="<?php echo base_url('style/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/css/datepicker.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('style/css/new_red.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/css/admin.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/css/social.css'); ?>" rel="stylesheet">
    <!-- Important. For Theming change primary-color variable in main.css  -->

    <link href="<?php echo base_url('style/fonts/font-awesome.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/fonts/wysihtml.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('style/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('style/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('style/js/jquery.scrollUp.js'); ?>"></script>
    <script src="<?php echo base_url('style/js/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url('style/js/menu.js'); ?>"></script>
    <script src="<?php echo base_url('style/js/windowready.js'); ?>"></script>

    <?php if(isset($sortable) && $sortable === TRUE): ?>
        <script src="<?php echo base_url('style/js/jquery-ui-1.9.1.custom.min.js'); ?>"></script>
        <script src="<?php echo base_url('style/js/jquery.mjs.nestedSortable.js'); ?>"></script>
    <?php endif; ?>
</head>