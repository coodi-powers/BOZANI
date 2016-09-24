<?php

$arr_cat = array();

foreach($categories as $categorie)
{
    $arr_cat[$categorie->id] = $categorie->name;
}


$arr_map = array();

foreach($maps as $map)
{
    $arr_map[$map->id] = $map->name;
}

?>


<!-- Row Start -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Invoice #<?php echo $invoice->id; ?>
                </div>
                    <span class="tools">
                        <?php echo anchor('admin/invoice/edit/'.$invoice->id, '<i class="icon-plus"></i> Edit '); ?>
                        <i class="fa fa-pencil-square-o"></i>
                    </span>
            </div>
            <div class="widget-body">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                        <span style="font-weight: bold;">Title:</span>
                    </div>
                    <div class="col-md-7">
                        <?php echo $invoice->title; ?>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                        <span style="font-weight: bold;">Date:</span>
                    </div>
                    <div class="col-md-7">
                        <?php echo $invoice->date; ?>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                        <span style="font-weight: bold;">Map:</span>
                    </div>
                    <div class="col-md-7">
                        <?php echo $arr_map[$invoice->map]; ?>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                        <span style="font-weight: bold;">Category:</span>
                    </div>
                    <div class="col-md-7">
                        <?php echo $arr_cat[$invoice->cat]; ?>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                        <span style="font-weight: bold;">Extra:</span>
                    </div>
                    <div class="col-md-7">
                        <?php echo $invoice->extra; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Files
                </div>
                    <span class="tools">
                        <a onclick="$('#upload_tr').toggleClass('hide');" style="cursor: pointer;">Add a file
                        <i class="fa fa-plus"></i></a>
                    </span>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                        <thead>
                            <tr>
                                <th style="width:10%">
                                    #
                                </th>
                                <th style="width:80%">
                                    File
                                </th>
                                <th style="width:10%">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($files as $file)
                        { ?>

                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('../uploads/'.$this->session->id).'/'.$invoice->id.'/'.$file->file_path;  ?>" target="_blank"><?php echo $file->file_path; ?></a>
                                </td>
                                <td>
                                    <?php echo btn_delete_invoice(site_url("admin/invoice/deletefile/") .'/'.$file->file_path.'/'.$invoice->id);?>
                                </td>
                            </tr>

                        <?php
                            $i++;
                        }
                        ?>
                        <tr class="hide" id="upload_tr">
                            <td colspan="3">
                                <div class="row">
                                    <?php echo form_open_multipart(); ?>
                                    <div class="col-lg-8">
                                        <input type="file" name="userfile" size="20" />
                                    </div>
                                    <div class="col-lg-4" style="text-align: right;">
                                        <?php echo form_submit('submit', 'Save', 'class="btn btn-primary" id="submit_rotate"'); ?>
                                    </div>

                                    <?php echo form_close();?>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row End -->