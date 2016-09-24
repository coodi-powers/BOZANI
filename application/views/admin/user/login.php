<div class="sulu-login">
    <div class="media-container">
        <div class="media-logo">
            C<pan style="color: #fbbf10;">M</pan>S
        </div>
        <div class="media-background">
            <div class="darkener"></div>
        </div>
    </div>
    <div class="content-container">
        <div class="content-box">
            <div class="content-logo navigatorwebsite-switch">
                <div class="media-logo">
                    C<pan style="color: #000000;">M</pan>S
                </div>
            </div>
            <div class="frame-slider" style="left: 0px;">
                <div class="box-frame login">
                    <?php echo form_open('', array('class' => 'grid inputs'));?>
                        <span class="error-message">This Email/Password combination is wrong. Please try again.</span>
                        <div class="grid-row">
                            <input class="form-element input-large husky-validate" type="text" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="grid-row">
                            <input class="form-element input-large husky-validate" type="password" name="password" id="password" placeholder="Wachtwoord">
                        </div>
                        <div class="grid-row">
                            <input type="submit" id="login-submit" value="Login" class="btn action large fit">
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
        <div class="grid-row login-content-footer">
            <span class="navigator website-switch">Terug naar de website</span>
        </div>
        <div class="success-overlay">
            <div class="success-icon"></div>
        </div><div class="login-loader">
            <div class="spinner" style="width: 40px; height: 40px;">
                <div class="double-bounce1" style="background-color: rgb(255, 255, 255);"></div>
                <div class="double-bounce2" style="background-color: rgb(255, 255, 255);"></div>
            </div>
        </div>
    </div>
</div>