
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($user->id) ? 'Toevoegen' : 'Beerken ' . $user->name; ?></h5>
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
                            <label class="col-md-2 control-label" for="username">Naam:</label>
                            <div class="col-md-10">
                                <?php echo form_input('username', set_value('userame', $user->username)); ?>
                            </div>
                        </div> <!-- formrow -->


                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="email" class="mandatory">E-mailadres:</label>
                            <div class="col-md-10">
                                <?php echo form_input('email', set_value('email', $user->email)); ?>
                            </div>
                        </div> <!-- formrow -->


                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="wachtwoord">Wachtwoord:</label>
                            <div class="col-md-10">
                                <?php echo form_password('wachtwoord'); ?>
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
