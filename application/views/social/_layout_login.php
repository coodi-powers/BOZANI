<?php $this->load->view('social/components/page_head');
$class = "";
?>
    <body>
    <!-- Top Nav Start -->
    <!-- Main Container start -->
    <div class="dashboard-container">

        <div class="container">

            <?php $this->load->view($subview); ?>

        </div>
    </div>
    <!-- Main Container end -->

<?php $this->load->view('social/components/page_tail');?>