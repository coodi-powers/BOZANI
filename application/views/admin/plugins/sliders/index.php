
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Overzicht sliders</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Naam</th>
                                <th style="width: 30%;">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($sliders)): foreach($sliders as $slider): ?>
                                <tr>
                                    <td><?php echo $slider->naam; ?></td>
                                    <td class="icons">
                                        <a href="<?php echo anchor('admin/plugins/sliders/index/'. $slider->slider_id, ''); ?>"><span class="label label-default"><i class="fa fa-list"></i></span></a>
                                        <a href="<?php echo anchor('admin/plugins/sliders/edit/'. $slider->slider_id, ''); ?>"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
                                        <a href="<?php echo anchor('admin/plugins/sliders/delete/'.$slider->slider_id, ''); ?>"><span class="label label-danger"><i class="fa fa-times"></i></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Er werden geen sliders gevonden</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <a class="btn btn-primary dim" href="<?php echo anchor('admin/plugins/sliders/edit', ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                    </div>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
        <?php if($slider_info->naam != '') { ?>
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Samenstelling van: <?php echo $slider_info->naam; ?></h5>
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
                    <a class="btn btn-primary dim" href="<?php echo anchor('admin/plugins/sliders/edit_box/'.$slider_info->slider_id, ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
        <?php } ?>
    </div><!-- END ROW -->

    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Overzicht slider items</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Naam</th>
                                <th style="width: 30%;">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($slideritems)): foreach($slideritems as $item): ?>
                                <tr>
                                    <td><?php echo $item->naam; ?></td>
                                    <td class="icons">
                                        <a href="<?php echo anchor('admin/plugins/sliders/edit_item/'. $item->item_id, ''); ?>"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
                                        <a href="<?php echo anchor('admin/plugins/sliders/delete_item/'.$item->item_id, ''); ?>"><span class="label label-danger"><i class="fa fa-times"></i></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Er werden geen items gevonden</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <a class="btn btn-primary dim" href="<?php echo anchor('admin/plugins/sliders/edit_item', ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                    </div>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
    </div><!-- END ROW -->

</div><!-- END WRAPPER -->
