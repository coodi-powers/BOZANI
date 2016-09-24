
<!-- Row Start -->
<div class="row">
    <div class="col-lg-4 col-md-4 col-md-offset-1 col-sm-7 col-sm-offset-1">
        <div class="sign-in-container">
            <?php echo form_open('', array('class' => 'login-wrapper'));?>
                <div class="header">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <h3>Login to acces</h3>
                            <p>Fill out the form below to login.</p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label for="userName">Email</label>
                        <?php echo form_input('email', '', 'class="form-control" placeholder="Email"'); ?>
                    </div>
                    <div class="form-group">
                        <label for="Password1">Password</label>
                        <?php echo form_password('password', '', 'class="form-control" placeholder="Password"'); ?>
                    </div>
                </div>
                <div class="actions">
                    <?php echo form_submit('submit', 'Log in', 'class="btn btn-danger"'); ?>
                    <div class="clearfix"></div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Row End -->