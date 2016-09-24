<div class="divide60"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 margin30 wow animated fadeInUp">
            <h3 class="heading">Een vraag? Offerte nodig?</h3>
            <p>Vraag vrijblijvend een offerte aan.</p>
            <div class="divide30"></div>
            <div class="form-contact">
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('', $attributes); ?>

                <form action="contact.php" class="form-horizontal" method="post" accept-charset="utf-8" _lpchecked="1">

                    <?php

                    if($succes_messages != '')
                    {
                        echo '<div class="alert alert-success" role="alert">'.$succes_messages.'</div>';
                    }
                    if($error_messages != '')
                    {
                        echo '<div class="alert alert-danger" role="alert">'.$error_messages.'</div>';
                    }

                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class=" control-group">
                                <div class="form-group col-xs-12 controls">
                                    <label>Naam</label>
                                    <input type="text" class="form-control" name="naam" id="name" required data-validation-required-message="Vul uw naam in.">
                                    <input type="hidden" class="form-control" name="middelnaam" id="middelnaam">
                                    <p class="help-block"></p>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class=" control-group">
                                <div class="form-group col-xs-12 controls">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required data-validation-required-message="Vul uw emailadres in.">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class=" control-group">
                                <div class="form-group col-xs-12  controls">
                                    <label>Telefoon</label>
                                    <input type="tel" class="form-control" name="telefoon" id="phone" required data-validation-required-message="Vul uw telefoonnummer in.">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class=" control-group">
                                <div class="form-group col-xs-12  controls">
                                    <label>Onderneming</label>
                                    <input type="text" class="form-control" name="onderneming" id="onderneming" required data-validation-required-message="Vul uw ondernemingsnummer in.">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class=" control-group">
                                <div class="form-group col-xs-12 controls">
                                    <label>Bericht</label>
                                    <textarea rows="5" class="form-control" name="bericht" id="message" required data-validation-required-message="Vul uw bericht in."></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="col-md-6">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-theme-bg btn-lg">Verzenden</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php echo form_close();?>
            </div><!--contact form-->
        </div>
        <div class="col-md-4 wow animated fadeInUp">
            <h3 class="heading">Contact info</h3>
            <ul class="list-unstyled contact contact-info">
                <li><p><strong><i class="fa fa-map-marker"></i> Adres:</strong>Senator Alfons Jeurissenlaan 1020 , 3520 Zonhoven</p></li>
                <li><p><strong><i class="fa fa-envelope"></i>E-mail:</strong> <a href="mailto:info@bozani.be">info@bozani.be</a></p></li>
                <li> <p><strong><i class="fa fa-phone"></i> Tel.:</strong><a href="callto:+32498531757">+32 498 53 17 57</a></p></li>
                <li> <p><strong> BTW-nr:</strong>BE 0654 794 639</p></li>
            </ul>
            <div class="divide40"></div>
            <h4>Social media</h4>
            <div class=" margin10">
                <a href="https://www.facebook.com/Bozani-BVBA-1593620887603218/?fref=ts&__mref=message_bubble" target="_blank" class="social-icon si-dark si-colored-facebook">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-facebook"></i>
                </a>
            </div><!--socials-->
        </div>
    </div>
</div>
<div class="divide40"></div>