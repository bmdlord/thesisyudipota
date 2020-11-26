<h4 class="page-title">Set Appointment</h4>

<?php if(@get('status') == 'success'): ?>
<div class="alert alert-success">Successfully set an appointment, wait for the doctor approval.</div>
<?php elseif(@get('status') == 'notavailable'): ?>
<div class="alert alert-danger">Sorry date and time availability is already taken by another patient.</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <form action="<?= URL; ?>appointment/post" method="post">
                    <input type="hidden" name="patient_id" value="<?= get_session('userid'); ?>">
                    <input type="hidden" name="doctor_id" value="<?= get('doctor'); ?>">
                    <div class="form-group">
                        <label>Patient Name</label>
                        <input type="text" class="form-control" name="patient_name" value="<?= ucwords(get_session('userfullname')); ?>" readonly />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="cal-icon">
                                    <input type="text" name="date" class="form-control datetimepicker">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="time-icon">
                                    <input type="text" name="time" class="form-control" id="datetimepicker3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <input type="text" name="doctor_name" value="<?= ucwords(get('name')); ?>" class="form-control" readonly />
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" class="btn btn-primary submit-btn form-control">Set Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

