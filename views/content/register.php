<?php if(@get('status') == 'success'): ?>
    <div class="alert alert-success">Your account is created! You may now <a href="<?= URL; ?>">Log in</a>.</div>
<?php elseif(@get('status') == 'fail'): ?>
    <div class="alert alert-danger">Something went wrong that could not register your account. Please try again.</div>
<?php elseif(@get('status') == 'exists'): ?>
    <div class="alert alert-danger">Email is already in use.</div>
<?php endif; ?>

<form action="<?= URL; ?>register/post" method="post" class="form-signin" enctype="multipart/form-data">
    <div class="account-logo">
        <a href=""><img src="<?= URL; ?>public/assets/img/logo-dark.png" alt=""></a>
    </div>
    <?php if(@get('type') == 'patients'): ?>
    <input type="hidden" name="level" id="level" value="2">
    <?php elseif(@get('type') == 'psychiatrists'): ?>
    <input type="hidden" name="level" id="level" value="1">
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" id="image" accept="image/*">
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label>Fullname</label>
        <input type="text" name="fullname" id="fullname" placeholder="Fullname" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" id="address" placeholder="Address" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Birthdate</label>
        <input type="date" name="birthdate" id="birthdate" value="1970-01-01" class="form-control" required>
    </div>
    <?php if(@get('type') == 'psychiatrists'): ?>
    <div class="form-group">
        <label>My Attainment</label>
        <textarea name="attainment" class="form-control" required></textarea>
    </div>
   	<?php endif; ?>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" class="form-control" required>
    </div>
    <div class="form-group text-center">
        <button class="btn btn-primary account-btn" type="submit">Create Account</button>
    </div>
    <div class="text-center login-link">
        Already have an account? <a href="<?= URL; ?>login">Login</a>
    </div>
</form>
