
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Overzicht partners</h5>
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

                            <?php if(count($partners)): foreach($partners as $partner): ?>
                                <tr>
                                    <td><?php echo $partner->naam; ?></td>
                                    <td class="icons">
                                        <a href="<?php echo anchor('admin/partners/index/'. $partner->partner_id, ''); ?>"><span class="label label-default"><i class="fa fa-list"></i></span></a>
                                        <a href="<?php echo anchor('admin/partners/edit/'. $partner->partner_id, ''); ?>"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Er werden geen partners gevonden</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
        <?php if($partner_info->naam != '') { ?>
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Samenstelling van: <?php echo $partner_info->naam; ?></h5>
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
                    <a class="btn btn-primary dim" href="<?php echo anchor('admin/partners/edit_box/'.$partner_info->partner_id, ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
        <?php } ?>
    </div><!-- END ROW -->

    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Overzicht partner items</h5>
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

                            <?php if(count($partneritems)): foreach($partneritems as $item): ?>
                                <tr>
                                    <td><?php echo $item->naam; ?></td>
                                    <td class="icons">
                                        <a href="<?php echo anchor('admin/partners/edit_item/'. $item->item_id, ''); ?>"><span class="label label-warning"><i class="fa fa-pencil"></i></span></a>
                                        <a href="<?php echo anchor('admin/partners/delete_item/'.$item->item_id, ''); ?>"><span class="label label-danger"><i class="fa fa-times"></i></span></a>
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
                        <a class="btn btn-primary dim" href="<?php echo anchor('admin/partners/edit_item', ''); ?>"><i class="fa fa-plus"></i>&nbsp;Toevoegen</a>
                    </div>
                </div><!-- END CONTENT -->
            </div><!-- END IBOX -->
        </div><!-- END COL -->
    </div><!-- END ROW -->

</div><!-- END WRAPPER -->
