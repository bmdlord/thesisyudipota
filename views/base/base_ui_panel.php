<!DOCTYPE html>
<html lang="en">

<!-- blank-page24:04-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= URL; ?>public/assets/img/favicon.ico">
    <title>Mental Health Monitoring</title>
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= URL; ?>public/assets/css/style.css">
    <script src="<?= URL; ?>public/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?= URL; ?>public/assets/js/popper.min.js"></script>
    <script src="<?= URL; ?>public/assets/js/bootstrap.min.js"></script>
    <script src="<?= URL; ?>public/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= URL; ?>public/assets/js/Chart.bundle.js"></script>
    <script src="<?= URL; ?>public/assets/js/moment.min.js"></script>
    <script src="<?= URL; ?>public/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= URL; ?>public/assets/js/app.js"></script>
    <!--[if lt IE 9]>
		<script src="<?= URL; ?>public/assets/js/html5shiv.min.js"></script>
		<script src="<?= URL; ?>public/assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="" class="logo">
					<img src="<?= URL; ?>public/assets/img/logo.png" width="35" height="35" alt=""> <span style="font-size: 10px;">Mental Health Monitoring</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                        <span>Hello, <?= ucwords(get_session('userfullname')); ?> (<?= (get_session('level') == 1) ? 'Doctor' : 'Patient'; ?>)</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?= URL; ?>logout">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= URL; ?>logout">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="<?= URL; ?>panel"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <?php if(get_session('level') == 2): ?>
                        <li>
                            <a href="<?= URL; ?>doctors?view=my"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                            <a href="<?= URL; ?>dairy"><i class="fa fa-pencil"></i> <span>Dairy</span></a>
                            <a href="<?= URL; ?>question/patienttask"><i class="fa fa-pencil"></i> <span>Task / Evaluation</span></a>
                        </li>
                        <?php elseif(get_session('level') == 1): ?>
                        <li>
                            <a href="<?= URL; ?>userinfo?id=<?= get_session('userid'); ?>&level=1"><i class="fa fa-user"></i> <span>My Info</span></a>
                        </li>
                        <li>
                            <a href="<?= URL; ?>patients"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <li>
                            <a href="<?= URL; ?>question"><i class="fa fa-table"></i> <span>Question / Evaluation</span></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <?php pagecontent(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    
    <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });
    </script>
</body>


<!-- blank-page24:04-->
</html>
