<?php $this->load->view('social/components/page_head');
$class = "";
?>
    <body>
    <!-- Top Nav Start -->
    <div class="dashboard-container">

        <div class="container">
            <div id='cssmenu'>
                <ul>
                        <?php
                        if($this->uri->segment(2) == 'dashboard')
                        {
                            $class = "active";
                        }
                        echo '<li class="'.$class.'">';
                        echo anchor('social/dashboard', '<i class="fa fa-dashboard"></i> Dashboard');
                        $class = "";
                        echo '<li>';

                        if($this->uri->segment(2) == 'chat')
                        {
                            $class = "active";
                        }
                        echo '<li class="'.$class.'">';
                        echo anchor('social/chat', '<i class="fa fa-comments"></i> Chat');
                        $class = "";
                        echo '<li>';

                        ?>
                </ul>
            </div>
            <!-- Top Nav End -->

            <?php
            if($submenu != '')
            {
                $this->load->view($submenu);
            }
            ?>

            <!-- Dashboard Wrapper Start -->
            <div class="dashboard-wrapper">

                <!-- Left Sidebar Start -->
                <div class="left-sidebar">

                    <!-- Row Start -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                            <?php $this->load->view($subview); ?>

                        </div>
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Left Sidebar End -->

                <!-- Right Sidebar Start -->
                <div class="right-sidebar">

                    <div class="wrapper">
                        <p style="width: 100%; text-align: center;"><i class="fa fa-user fa-5x"></i></p>
                        <h4 align="center"><?php echo $this->session->name ?></h4>

                        <hr class="hr-stylish-1">

                        <ul style="text-align: center;">
                            <li><?php echo anchor('social/user/logout', 'Logout'); ?></li>
                        </ul>
                    </div>



                </div>
                <!-- Right Sidebar End -->

            </div>
            <!-- Dashboard Wrapper End -->

            <footer>
                <p>© Bart Bollen <?php echo date('Y'); ?></p>
            </footer>
        </div>
    </div>

<?php $this->load->view('social/components/page_tail');?>