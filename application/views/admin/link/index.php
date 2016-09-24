

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Overzicht</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="dd" id="nestable2">
                        <ol class="dd-list">
                            <?php echo $nested_structure; ?>
                        </ol>
                    </div>
                    <br><br>
                    <a class="btn btn-primary dim" href="<?php echo anchor('admin/link/edit', ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
    </div><!-- END ROW -->
</div><!-- END WRAPPER -->
