
<!-- Row Start -->
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Categories
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/category/editcat', '<i class="icon-plus"></i> Add a category'); ?>
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
                    <?php if(count($categories)): foreach($categories as $category): ?>
                        <tr>
                            <td>
                                <?php echo $category->name; ?>
                            </td>
                            <td class="hidden-phone">
                                <p style="text-align: center; margin-bottom: 0px;">
                                    <?php echo btn_edit_invoice('category/editcat/' . $category->id); ?>
                                    <?php echo btn_delete_invoice('category/deletecat/' . $category->id); ?>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">We could not find any categories.</td>
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
