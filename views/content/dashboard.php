<h4 class="page-title">Dashboard</h4>

<div class="row">

    <?php if(get_session('level') == 2): ?>
    <a href="<?= URL; ?>doctors?view=my" class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?= data()['doctor']; ?></h3>
                <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </a>

    <?php elseif(get_session('level') == 1): ?>
    <a href="<?= URL; ?>patients" class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?= data()['patient']; ?></h3>
                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </a>

    <a href="<?= URL; ?>request" class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?= data()['request']; ?></h3>
                <span class="widget-title4">Request <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </a>
    <?php endif; ?>
</div>
<!--
<?php if(get_session('level') == 2): ?>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Patient Score</h4>
                    <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
                </div>
                <canvas id="linegraph"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>My Health Monitoring Graph Analysis</h4>
                    <div class="float-right">
                        <ul class="chat-user-total">
                            <li><i class="fa fa-circle current-users" aria-hidden="true"></i>IMPROVING</li>
                            <li><i class="fa fa-circle old-users" aria-hidden="true"></i> NOT IMPROVING</li>
                        </ul>
                    </div>
                </div>
                <canvas id="bargraph"></canvas>
            </div>
        </div>
    </div>
</div>
-->
<?php endif; ?>
