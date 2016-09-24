<?php

$datum = new DateTime($reportage->datum);
$datum = $datum->format('d-m-Y');
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($reportage->id) ? 'Toevoegen' : 'Wijzigen ' . $reportage->naam; ?></h5>
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
                        <label class="col-md-2 control-label" for="username">Type:</label>
                        <div class="col-md-10">
                            <?php echo form_dropdown('type', $arr_types, $this->input->post('type') ? $this->input_post('type') : $reportage->type, 'class="select_2"'); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Naam:</label>
                        <div class="col-md-10">
                            <?php echo form_input('naam', $reportage->naam); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Titel:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_nl', $reportage->titel_nl); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Auteur:</label>
                        <div class="col-md-10">
                            <?php echo form_input('auteur', $reportage->auteur); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="geboortedatum">Datum:</label>
                        <div class="col-md-10">
                            <input id="datepicker" type="text" name="datum" value="<?php echo $datum; ?>" class="form-control datepicker">
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="foto">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','afbeelding');">Selecteer</button></span>
                                <?php echo form_input('afbeelding', $reportage->afbeelding); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="foto">Album:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','album');">Selecteer</button></span>
                                <?php echo form_input('album', $reportage->album); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="vader">Intro:</label>
                        <div class="col-md-10">
                            <?php echo $this->ckeditor->editor("intro_nl",$reportage->intro_nl); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="vader">Inhoud:</label>
                        <div class="col-md-10">
                            <?php echo $this->ckeditor->editor("inhoud_nl",$reportage->inhoud_nl); ?>
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
    CKEDITOR.replace( 'beschrijving' );
</script>
