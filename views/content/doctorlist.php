<h4 class="page-title">Doctor List</h4>

<?php if(@get('status') == 'success'): ?>
<div class="alert alert-success">Successfully requested.</div>
<?php elseif(@get('status') == 'exists'): ?>
<div class="alert alert-danger">You are already requested to this psychiatrists.</div>
<?php endif; ?>

<div class="row doctor-grid">
    <?php if(sizeof(data()) > 0): ?>
    <?php foreach(data() as $key): ?>
    <div class="col-md-4 col-sm-4  col-lg-3">
        <div class="profile-widget">
            <div class="doctor-img">
                <a class="avatar" href=""><img alt="" src="<?= URL; ?>media/<?= $key['image']; ?>"></a>
            </div>
            <h4 class="doctor-name text-ellipsis"><a href="profile.html"><?= ucwords($key['fullname']); ?></a></h4>
            <div class="doc-prof">Psychiatrists</div>
            <div class="user-country">
                <i class="fa fa-map-marker"></i> <?= ucwords($key['address']); ?>
            </div>
            <form action="<?= URL; ?>doctors/post?action=request" method="post">
                <input type="hidden" name="patient" value="<?= get_session('userid'); ?>">
                <input type="hidden" name="doctor" value="<?= $key['id']; ?>">
                <button type="submit" class="btn btn-md btn-success form-control">Request</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>