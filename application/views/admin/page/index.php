

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
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
                    <a class="btn btn-primary dim" href="<?php echo anchor('admin/page/edit', ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
        <?php if($page_info->title != '') { ?>
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Plugins van: <?php echo $page_info->naam; ?></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                <?php echo $nested_structure_plugins; ?>
                            </ol>
                        </div>
                        <br><br>
                        <a class="btn btn-primary dim" href="<?php echo anchor('admin/page/edit_plugins/'.$page_info->id, ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                    </div><!-- END CONTENT -->
                </div><!-- END IBOX -->
            </div><!-- END COL -->
        <?php } ?>
    </div><!-- END ROW -->
</div><!-- END WRAPPER -->
