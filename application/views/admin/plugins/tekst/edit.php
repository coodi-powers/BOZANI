
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($tekst->id) ? 'Toevoegen' : 'Beerken ' . $tekst->naam; ?></h5>
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
                            <label class="col-md-2 control-label" for="tekstname">Naam:</label>
                            <div class="col-md-10">
                                <?php echo form_input('naam', set_value('naam', $tekst->naam)); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="titel">Titel:</label>
                            <div class="col-md-10">
                                <?php echo form_input('titel', set_value('titel', $tekst->titel)); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="inhoud">Inhoud:</label>
                            <div class="col-md-10">
                                <?php echo $this->ckeditor->editor("inhoud",$tekst->inhoud); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                            <div class="col-md-10">
                                <div class="input-group m-b">
                                    <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','foto');">Selecteer</button></span>
                                    <?php echo form_input('foto', set_value('foto', $tekst->foto)); ?>
                                </div>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="align">Uitlijning:</label>
                            <div class="col-md-10">
                                <?php echo form_dropdown('align', $align, $this->input->post('align') ? $this->input_post('align') : $tekst->align, 'class="select_2"'); ?>
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
