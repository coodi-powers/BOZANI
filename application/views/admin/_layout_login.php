
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $meta_title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link href="<?php echo base_url('style/css/login/login.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/css/login/main.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/css/login/custom.css'); ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
<div id="main" class="login">
    <?php $this->load->view($subview); ?>

    <div id="labels-container" class='login-label-container' data-aura-component="labels@suluadmin"></div>
</div>
<script type="text/javascript">
    var SULU = {
        debug: false,
        locales: ["de","en"],
        translatedLocales: {"de":"Deutsch","en":"English"},
        translations: ["de","en"],
        fallbackLocale: 'en'
    };
</script>

<script src="<?php echo base_url('style/js/login/functions.js'); ?>"></script>
</body>
</html>
