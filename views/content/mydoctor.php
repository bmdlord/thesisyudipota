<h4 class="page-title">My Doctor <a href="<?= URL; ?>doctors?view=list" class="btn btn-md btn-primary">Doctor List</a></h4>

<?php if(@get('status') == 'success'): ?>
<div class="alert alert-success">Successfully removed.</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-border table-striped custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(data() as $key): ?>
                    <tr>
                        <td><?= ucwords($key['fullname']); ?></td>
                        <td><span class="<?= ($key['status'] == 'pending') ? 'bg-warning' : 'bg-success'; ?> text-white"><?= ucfirst($key['status']); ?></span></td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?= URL; ?>userinfo?id=<?= $key['doctor_id']; ?>" class="dropdown-item">
                                        <i class="fa fa-eye m-r-5"></i> View Doctor Information
                                    </a>
                                    <form action="<?= URL; ?>doctors/post?action=remove" method="post" onsubmit="return confirm('Are you sure to remove this psychiatrists?');">
                                        <input type="hidden" name="id" value="<?= $key['id']; ?>">
                                        <button type="submit" class="dropdown-item"><i class="fa fa-window-close m-r-5"></i> Remove</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>