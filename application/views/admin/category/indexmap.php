
<!-- Row Start -->
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Maps
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/category/editmap', '<i class="icon-plus"></i> Add a map'); ?>
                        <i class="fa fa-plus"></i>
                    </span>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th style="width:70%">
                                Name
                            </th>
                            <th style="width:30%">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($maps)): foreach($maps as $map): ?>
                            <tr>
                                <td>
                                    <?php echo $map->name; ?>
                                </td>
                                <td class="hidden-phone">
                                    <p style="text-align: center; margin-bottom: 0px;">
                                        <?php echo btn_edit_invoice('category/editmap/' . $map->id); ?>
                                        <?php echo btn_delete_invoice('category/deletemap/' . $map->id); ?>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">We could not find any maps.</td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row End -->