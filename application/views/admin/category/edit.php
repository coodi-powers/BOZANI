
<!-- Row Start -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo empty($object->id) ? 'Add a new ' : 'Edit'; ?>
                </div>
            </div>
            <div class="widget-body">
                <?php echo validation_errors(); ?>
                <?php echo form_open('', array('class' => 'form-horizontal no-margin')); ?>
                <div class="form-group">
                    <label for="userName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <?php echo form_input('name', set_value('name', $object->name)); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<!-- Row End -->


