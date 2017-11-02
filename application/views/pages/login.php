 <!-- Start view -->
    <div class="flex-page">
        <div class="form-container">
            <div class="form-group text-center">
                <h4><span class="oi oi-person"></span></span> Login checker</h4>
            </div>
            <hr>
           <?php echo form_open('login'); ?>
                <?php if($this->session->flashdata('invalid')): ?>
                        <div class="alert alert-danger"> <?php echo $this->session->flashdata('invalid'); ?> </div>
                <?php endif; ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"><span class="oi oi-person"></span></span>
                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="Username" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"><span class="oi oi-key"></span></span>
                        <input type="password" class="form-control" placeholder="Password" name="password" aria-label="Username" required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block btn-success"><span class="oi oi-account-login"></span> Login</button>
                </div>

        <?php echo form_close(); ?>
        </div>
    </div>