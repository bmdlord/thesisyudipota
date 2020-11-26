<h4 class="page-title">Assign Patients</h4>

<div class="row">
    <div class="col-md-12">
        <?php if(@get('status') == 'success'): ?>
          <div class="alert alert-success">
            Successfully Assign.
          </div>
        <?php elseif(@get('status') == 'reassign'): ?>
          <div class="alert alert-success">
            Question / Eveluation re - assigned.
          </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-border table-striped custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(data() as $key): ?>
                    <tr>
                        <td><?= ucwords($key['fullname']); ?></td>
                        <td class="text-right">
                          <a href="<?= URL; ?>question/assign?title=<?= get('question'); ?>&u=<?= $key['patient_id']; ?>" class="btn btn-sm btn-primary">Assign</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
