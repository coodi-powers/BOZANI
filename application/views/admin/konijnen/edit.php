<?php
$datum = new DateTime($konijn->geboortedatum);
$geboortedatum = $datum->format('d-m-Y');

$datum = new DateTime($konijn->beschikbaar);
$beschikbaar = $datum->format('d-m-Y');
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($konijn->id) ? 'Toevoegen' : 'Wijzigen ' . $konijn->naam; ?></h5>
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
                        <label class="col-md-2 control-label" for="naam_vader">Naam:</label>
                        <div class="col-md-10">
                            <?php echo form_input('naam', set_value('naam', $konijn->naam)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="geslacht">Geslacht:</label>
                        <div class="col-md-10">
                            <?php echo form_dropdown('geslacht', $geslachten, $this->input->post('geslacht') ? $this->input_post('geslacht') : $konijn->geslacht, 'class="select_2"'); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="geboortedatum">Geboortedatum:</label>
                        <div class="col-md-10">
                            <input id="datepicker" type="text" name="geboortedatum" value="<?php echo $geboortedatum; ?>" class="form-control datepicker">
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_moeder">Prijs:</label>
                        <div class="col-md-10">
                            <?php echo form_input('prijs', set_value('prijs', $konijn->prijs)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','foto');">Selecteer</button></span>
                                <?php echo form_input('foto', set_value('foto', $konijn->foto)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="nest_id">Nest:</label>
                        <div class="col-md-10">
                            <?php echo form_dropdown('nest_id', $nesten, $this->input->post('nest_id') ? $this->input_post('nest_id') : $konijn->nest_id, 'class="select_2"'); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="moeder">Moeder:</label>
                        <div class="col-md-10">
                            <?php echo form_input('moeder', set_value('moeder', $konijn->moeder)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="vader">Vader:</label>
                        <div class="col-md-10">
                            <?php echo form_input('vader', set_value('vader', $konijn->vader)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="beschikbaar">Beschikbaar vanaf:</label>
                        <div class="col-md-10">
                            <input id="datepicker" type="text" name="beschikbaar" value="<?php echo $beschikbaar; ?>" class="form-control datepicker">
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="gereserveerd">Gereserveerd:</label>
                        <div class="col-md-10">
                            <?php echo form_input('vadgereserveerder', set_value('gereserveerd', $konijn->gereserveerd)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="vader">Beschrijving:</label>
                        <div class="col-md-10">
                            <?php echo $this->ckeditor->editor("beschrijving",$konijn->beschrijving); ?>
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
