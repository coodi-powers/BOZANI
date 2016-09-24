
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/bozanifavicon.png'); ?>">
    <meta name=’description’ content="Bozani is gespecialiseerd in diamantboringen, zaag- en slijpwerken in gewapende beton.Klik hier voor meer info!"/>
    <meta name="robots" content="index, follow, noarchive, nosnippet">
    <meta name="copyright" content="COODI-Webservices">

    <meta property="og:image" content="<?php echo base_url('assets/images/bozaniLogo.png'); ?>"/>
    <meta property="og:title" content="Bozani"/>
    <meta property="og:description" content="Gespecialiseerd in diamantboringen, zaag- en slijpwerken in gewapende beton. Voor meer info neem een kijkje op onze website!"/>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bozani</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- font awesome for icons -->
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- flex slider css -->
    <link href="<?php echo base_url('assets/css/flexslider.css')?>" rel="stylesheet" type="text/css" media="screen">
    <!-- animated css  -->
    <link href="<?php echo base_url('assets/css/animate.css')?>" rel="stylesheet" type="text/css" media="screen">
    <!-- Revolution Style-sheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/rs-plugin/css/settings.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/rev-style.css')?>">
    <!--owl carousel css-->
    <link href="<?php echo base_url('assets/owl-carousel/owl.carousel.css')?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo base_url('assets/owl-carousel/owl.theme.css')?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo base_url('assets/owl-carousel/owl.transitions.css')?>" rel="stylesheet" type="text/css" media="screen">
    <!--mega menu -->
    <link href="<?php echo base_url('assets/css/yamm.css')?>" rel="stylesheet" type="text/css">
    <!--cube css-->
    <link href="<?php echo base_url('assets/cubeportfolio/css/cubeportfolio.min.css')?>" rel="stylesheet" type="text/css">
    <!-- custom css-->
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" media="screen">

    <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="top-bar-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-8 text-right">
                <ul class="list-inline top-dark-right">
                    <li class="hidden-sm hidden-xs"><i class="fa fa-envelope"></i><a href="mailto:info@bozani.be">info@bozani.be</a></li>
                    <li class="hidden-sm hidden-xs"><i class="fa fa-phone"></i><a href="callto:+32498531757">+32 498 53 17 57</a></li>

                </ul>
            </div>
        </div>
    </div>
</div><!--top-bar-dark end here-->


        <div class="navbar navbar-default navbar-static-top yamm sticky" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?php echo base_url('assets/images/bozaniLogo.png'); ?>" alt="Bozani"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/"><?php echo $homepage->title; ?></a></li>
                        <?php
                        foreach($menu_items as $menu_item)
                        {
                            if(empty($menu_item['children']))
                            {
                                $active = '';
                                if(($page->id == $menu_item['id']) || ($page->parent_id == $menu_item['id']))
                                {
                                    $active = 'active';
                                }
                                echo '<li class="'.$active.'"><a href="'.base_url('index.php/'.$menu_item['slug']).'">'.$menu_item['title'].'</a></li>';
                            }
                            else
                            {
                                $active = '';
                                if(($page->id == $menu_item['id']) || ($page->parent_id == $menu_item['id']))
                                {
                                    $active = 'active';
                                }
                                echo '
                                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">'.$menu_item['title'].' <span class="caret"></span></a>
                                    <ul class="dropdown-menu">';

                                foreach ($menu_item['children'] as $child)
                                {
                                    echo '<li><a href="'.base_url('index.php/'.$child['slug']).'">'.$child['title'].'</a></li>';
                                }

                                echo '
                                    </ul>
                                </li>';
                            }

                        }

                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--container-->
        </div><!--navbar-default-->
