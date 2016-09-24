

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($page->id) ? 'Toevoegen' : 'Wijzigen ' . $page->title; ?></h5>
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
                        <label class="col-md-2 control-label" for="username">Parent:</label>
                        <div class="col-md-10">
                            <?php echo form_dropdown('parent_id', $pages_no_parent, $this->input->post('parent_id') ? $this->input_post('parent_id') : $page->parent_id, 'class="select_2"'); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="username">Template:</label>
                        <div class="col-md-10">
                            <?php echo form_dropdown('template', array('page' =>'Pagina met inhoud', 'homepage' => 'Homepage', 'content_right'=> 'Foto links - tekst rechts', 'contact' => 'Contact'), $this->input->post('template') ? $this->input_post('template') : $page->template, 'class="select_2"'); ?>

                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="menu">Menu:</label>
                        <div class="col-md-10">
                            <?php echo form_dropdown('menu', $menus, $this->input->post('menu') ? $this->input_post('menu') : $page->menu, 'class="select_2"'); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam" class="mandatory">Naam:</label>
                        <div class="col-md-10">
                            <?php echo form_input('naam', $page->naam); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="email" class="mandatory">Titel:</label>
                        <div class="col-md-10">
                            <?php echo form_input('title', $page->title); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="email" class="mandatory">Titel 2 :</label>
                        <div class="col-md-10">
                            <?php echo form_input('title2', $page->title2); ?>
                        </div>
                    </div> <!-- formrow -->


                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="wachtwoord">URL:</label>
                        <div class="col-md-10">
                            <?php echo form_input('slug', $page->slug); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','afbeelding');">Selecteer</button></span>
                                <?php echo form_input('afbeelding', set_value('afbeelding', $page->afbeelding)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="wachtwoord">Body:</label>
                        <div class="col-md-10">
                            <?php echo $this->ckeditor->editor("body",$page->body); ?>
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
