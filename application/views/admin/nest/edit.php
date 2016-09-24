
<?php

$datum = new DateTime($nest->geboortedatum);
$datum = $datum->format('d-m-Y');

$datum_beschikbaar = new DateTime($nest->beschikbaar);
$datum_beschikbaar = $datum_beschikbaar->format('d-m-Y');

?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($nest->id) ? 'Toevoegen' : 'Wijzigen ' . $nest->naam_vader .' & '.$nest->naam_moeder; ?></h5>
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

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Vader:</label>
                        <div class="col-md-10">
                            <?php echo form_input('naam_vader', set_value('naam_vader', $nest->naam_vader)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_moeder">Moeder:</label>
                        <div class="col-md-10">
                            <?php echo form_input('naam_moeder', set_value('naam_moeder', $nest->naam_moeder)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="geboortedatum">Geboortedatum:</label>
                        <div class="col-md-10">
                            <input id="datepicker" type="text" name="geboortedatum" value="<?php echo $datum; ?>" class="form-control datepicker">
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="beschikbaar">Beschikbaar:</label>
                        <div class="col-md-10">
                            <input id="datepicker" type="text" name="beschikbaar" value="<?php echo $datum_beschikbaar; ?>" class="form-control datepicker">
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','foto');">Selecteer</button></span>
                                <?php echo form_input('foto', set_value('foto', $nest->foto)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group">
                        <div class=" col-lg-12">
                            <button class="btn btn-success  dim" type="submit" name="submit_form" id="submit_form">
                                <i class="fa fa-check"></i>&nbsp;Bewaren
                            </button>
                        </div>
                    </div>
                    <!-- submitknop -->
                    <?php echo form_close();?>
                </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end wrapper -->

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'body' );
</script>
