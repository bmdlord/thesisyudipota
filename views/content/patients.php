<h4 class="page-title">My Patients</h4>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-border table-striped custom-table datatable mb-0">
                <thead>
                    <tr>
                        <th>Patient</th>
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
                                    <a href="<?= URL; ?>userinfo?id=<?= $key['patient_id']; ?>" class="dropdown-item">
                                        <i class="fa fa-eye m-r-5"></i> View Patient Information
                                    </a>
                                    <a href="<?= URL; ?>appointment/doctorappointment?patient=<?= $key['patient_id']; ?>&doctor=<?= get_session('userid'); ?>" class="dropdown-item">
                                        <i class="fa fa-calendar m-r-5"></i> Set Appointment
                                    </a>
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
