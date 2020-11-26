<form  action="<?= URL; ?>login/post" method="post" class="form-signin">
    <div class="account-logo">
        <a href=""><img src="<?= URL; ?>public/assets/img/logo-dark.png" alt=""></a>
    </div>

    <?php if(@get('status') == 'error'): ?>
        <div class="alert alert-danger">Invalid credentials!</div>
    <?php endif; ?>

    <div class="form-group">
        <label>Patient / Doctor Account</label>
        <input type="email" name="email" id="email" placeholder="Account" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" class="form-control" required>
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary account-btn">Login</button>
    </div>
    <div class="text-center register-link">
        Don’t have an account? Register Now, <br/><a href="<?= URL; ?>register?type=patients">Patients</a> 
        <a href="<?= URL; ?>register?type=psychiatrists">Psychiatrists</a>
    </div>
</form>