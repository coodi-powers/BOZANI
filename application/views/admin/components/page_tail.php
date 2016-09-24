<div class="footer">
    <div class="pull-right">
    </div>
    <div>
        <strong>Copyright</strong> COODI &copy; <?php echo date("Y"); ?>
    </div>
</div>
</div>
</div>

</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url('assets_admin/js/jquery-2.1.1.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

<!-- Flot -->
<script src="<?php echo base_url('assets_admin/js/plugins/flot/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/flot/jquery.flot.tooltip.min.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/flot/jquery.flot.spline.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/flot/jquery.flot.resize.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/flot/jquery.flot.pie.js'); ?>"></script>

<!-- Peity -->
<script src="<?php echo base_url('assets_admin/js/plugins/peity/jquery.peity.min.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/demo/peity-demo.js'); ?>"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets_admin/js/inspinia.js'); ?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/pace/pace.min.js'); ?>"></script>

<!-- jQuery UI -->
<script src="<?php echo base_url('assets_admin/js/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>

<!-- GITTER -->
<script src="<?php echo base_url('assets_admin/js/plugins/gritter/jquery.gritter.min.js'); ?>"></script>

<!-- Sparkline -->
<script src="<?php echo base_url('assets_admin/js/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>

<!-- Sparkline demo data  -->
<script src="<?php echo base_url('assets_admin/js/demo/sparkline-demo.js'); ?>"></script>

<!-- ChartJS-->
<script src="<?php echo base_url('assets_admin/js/plugins/chartJs/Chart.min.js'); ?>"></script>

<!-- Toastr -->
<script src="<?php echo base_url('assets_admin/js/plugins/toastr/toastr.min.js'); ?>"></script>

<!-- Select2 -->
<script src="<?php echo base_url('assets_admin/js/plugins/select2/select2.full.min.js'); ?>"></script>

<!-- Data picker -->
<script src="<?php echo base_url('assets_admin/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>

<script src="<?php echo base_url('assets_admin/js/custom.js'); ?>"></script>


<script>
    $(".select_2").select2({
        allowClear: true
    });

</script>

<?php echo $extra_js; ?>


</body>
</html>
