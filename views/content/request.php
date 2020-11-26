<h4 class="page-title">Request</h4>

<?php if(@get('status') == 'success'): ?>
<div class="alert alert-success">Patient approved.</div>
<?php elseif(@get('status') == 'remove'): ?>
<div class="alert alert-success">Successfully removed.</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-border table-striped custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th>Apply Patient</th>
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
                                    <form action="<?= URL; ?>request/post?action=deny" method="post" onsubmit="return confirm('Are you sure to remove this request?');">
                                        <input type="hidden" name="id" value="<?= $key['id']; ?>">
                                        <button type="submit" class="dropdown-item"><i class="fa fa-window-close m-r-5"></i> Remove</button>
                                    </form>
                                    <form action="<?= URL; ?>request/post?action=approve" method="post">
                                        <input type="hidden" name="id" value="<?= $key['id']; ?>">
                                        <button type="submit" class="dropdown-item"><i class="fa fa-check m-r-5"></i> Approve</button>
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