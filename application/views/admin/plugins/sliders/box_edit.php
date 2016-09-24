

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo 'Wijzigen ' . $slider_info->naam ; ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open('', $attributes); ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th style="width: 1%;">&nbsp;</th>
                                <th>Naam</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($all_boxes)): foreach($all_boxes as $slider_item): ?>
                                <tr>
                                    <td>
                                        <?php
                                        $checked = FALSE;
                                        if(in_array($slider_item->item_id, $linked))
                                        {
                                            $checked = TRUE;
                                        }
                                        ?>
                                        <?php echo form_checkbox('checked_'.$slider_item->item_id, '1', $checked); ?>
                                    </td>
                                    <td><?php echo $slider_item->naam; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Er werden geen items gevonden</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class=" col-lg-12">
                                <button class="btn btn-success  dim" type="submit" name="submit_form" id="submit_form">
                                    <i class="fa fa-check"></i>&nbsp;Bewaren
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div><!-- END CONTENT -->
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end wrapper -->

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'body' );
</script>
