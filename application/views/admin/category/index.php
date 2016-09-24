<?php

$arr_cat = array();

foreach($categories as $categorie)
{
    $arr_cat[$categorie->id] = $categorie->name;
}

?>



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
                            <th style="width:80%">
                                Name
                            </th>
                            <th style="width:20%">

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
                            <th style="width:80%">
                                Name
                            </th>
                            <th style="width:20%">

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

<!-- Row Start -->
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Project categories
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/category/editcat_project', '<i class="icon-plus"></i> Add a project category'); ?>
                        <i class="fa fa-plus"></i>
                    </span>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                        <thead>
                        <tr>
                            <th style="width:80%">
                                Name
                            </th>
                            <th style="width:20%">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($project_categories)): foreach($project_categories as $project_categorie): ?>
                            <tr>
                                <td>
                                    <?php echo $project_categorie->name; ?>
                                </td>
                                <td class="hidden-phone">
                                    <p style="text-align: center; margin-bottom: 0px;">
                                        <?php echo btn_edit_invoice('category/editcat_project/' . $project_categorie->id); ?>
                                        <?php echo btn_delete_invoice('category/delete_cat_project/' . $project_categorie->id); ?>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">We could not find any project category.</td>
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