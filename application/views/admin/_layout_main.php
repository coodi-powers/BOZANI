<?php $this->load->view('admin/components/page_head');
$class = "";
?>
    <?php $this->load->view($subview); ?>

<?php $this->load->view('admin/components/page_tail', $extra_js);?>