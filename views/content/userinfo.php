<?php
   (array)$data = [];

   foreach(data()['info'] as $key) {
       $data = $key;
   }

   ?>

<?php 

$graph = '';
$months = array(
            "Jan" => 0,
            "Feb" => 0,
            "Mar" => 0,
            "Apr" => 0,
            "May" => 0,
            "Jun" => 0,
            "Jul" => 0,
            "Aug" => 0,
            "Sep" => 0,
            "Oct" => 0,
            "Nov" => 0,
            "Dec" => 0,
          );

$set_score = 0;

foreach(data()['graph'] as $key) {
    $set_score = $key['total_score'] / $key['total_task'];
    $months[$key["month"]] = (float)$set_score;
}

$implode_months = '"' . implode(array_keys($months), '", "') . '"';
$graph  = implode(array_values($months), ', ');

?>
<h4 class="page-title">Info</h4>
<div class="card-box profile-header">
   <div class="row">
      <div class="col-md-12">
         <div class="profile-view">
            <div class="profile-img-wrap" style="width: 100px; height: 100px;">
               <div class="profile-img">
                  <a href=""><img class="avatar" src="<?= ($data['image'] != null) ? URL . 'media/' . $data['image'] : URL . 'public/images/sys_no_photo.png'; ?>" style="width: 130px; height: 130px;" alt=""></a>
               </div>
            </div>
            <div class="profile-basic">
               <div class="row">
                  <div class="col-md-5">
                     <div class="profile-info-left">
                        <h3 class="user-name m-t-0 mb-0"><?= ucwords($data['fullname']); ?></h3>
                        <a href="<?= URL; ?>chat/thread?doctor=<?php if(get_session('level') == 1): ?><?= get_session('userid'); ?><?php else: ?><?= $data['id']; ?><?php endif; ?>&patient=<?php if(get_session('level') == 2): ?><?= get_session('userid'); ?><?php else: ?><?= $data['id']; ?><?php endif; ?>" class="btn btn-sm btn-primary">Chat <i class="fa fa-send"></i></a>
                        <?php if($data['level'] == 1): ?>
                        <h5>Popularity: <?= number_format($data['popularity']); ?></h5>
                        <?php else: ?>
                            <a href="<?= URL; ?>dairy?id=<?= $data['id']; ?>" class="btn btn-primary"><i class="fa fa-book"></i> <span>Dairy</span></a>
                            <a href="<?= URL; ?>question/patienttask?id=<?= $data['id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> <span>Evaluation Score</span></a>
                        <?php endif; ?>
                        <small class="text-muted"><?= ($data['level'] == 1) ? 'Doctor' : 'Patient'; ?></small>
                        <?php if(get_session('level') == 2 && $data['level'] == 1): ?>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                <a href="<?= URL; ?>userinfo/popular?id=<?= $data['id']; ?>" class="btn btn-sm btn-primary">Give Like <i class="fa fa-thumbs-up"></i></a>
                                </li>
                                <li class="list-inline-item">
                                <div class="staff-msg"><a href="<?= URL; ?>appointment?doctor=<?= $data['id']; ?>&name=<?= $data['fullname']; ?>" class="btn btn-sm btn-primary">Set Appointment</a></div>
                                </li>
                            </ul>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-md-7">
                     <ul class="personal-info">
                        <li>
                           <span class="title">Email:</span>
                           <span class="text"><a href=""><?= $data['email']; ?></a></span>
                        </li>
                        <li>
                           <span class="title">Birthday:</span>
                           <span class="text"><?= date('M d, Y', strtotime($data['birthdate'])); ?></span>
                        </li>
                        <?php if($data['level'] == 1): ?>
                        <li>
                           <span class="title">Attainment:</span>
                           <span class="text"><?= $data['attainment']; ?></span>
                        </li>
                        <?php endif; ?>
                        <li>
                           <span class="title">Address:</span>
                           <span class="text"><?= ucwords($data['address']); ?></span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php if(!@get('level') == 1): ?>
<div class="profile-tabs">
   <ul class="nav nav-tabs nav-tabs-bottom">
      <li class="nav-item"><a class="nav-link active" href="#bottom-tab1" data-toggle="tab">Pending Appointment</a></li>
      <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Approved Schedule</a></li>
      <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Cancel Schedule</a></li>
      <?php if(get_session('level') == 1): ?>
      <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-toggle="tab">Patient Statistic</a></li>
      <?php endif; ?>
   </ul>
   <div class="tab-content">
      <div class="tab-pane show active" id="bottom-tab1">
         <div class="row">
            <div class="col-md-12">
               <div class="card-box">
               <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <?php if(get_session('level') == 1): ?>
                                <th>Doctor</th>
                                <?php endif; ?>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach(data()['appointment'] as $key): ?>
                                <?php if($key['status'] == 'pending'): ?>
                                <tr>
                                    <?php if(get_session('level') == 1): ?>
                                    <td><?= $key['doctor_name']; ?></td>
                                    <?php endif; ?>
                                    <td><?= $key['date']; ?></td>
                                    <td><?= $key['time']; ?></td>
                                    <td>
                                        <?php if($key['status'] == 'pending'): ?>
                                        <span class="bg-warning text-white">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <?php if(get_session('level') == 2): ?>
                                        <a href="<?= URL; ?>userinfo/post?appointmentid=<?= $key['id']; ?>&status=cancel&userid=<?= get('id'); ?>" class="btn btn-md btn-danger">Cancel Appointment</a>
                                        <?php elseif(get_session('level') == 1): ?>
                                        <?php if(get_session('userid') == $key['doctor']): ?>
                                        <a href="<?= URL; ?>userinfo/post?appointmentid=<?= $key['id']; ?>&status=approve&userid=<?= get('id'); ?>" class="btn btn-md btn-success">Approve</a>
                                        <a href="<?= URL; ?>userinfo/post?appointmentid=<?= $key['id']; ?>&status=cancel&userid=<?= get('id'); ?>" class="btn btn-md btn-warning">Cancel</a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane" id="bottom-tab2">
        <div class="card-box">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <?php if(get_session('level') == 1): ?>
                        <th>Doctor</th>
                        <?php endif; ?>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(data()['appointment'] as $key): ?>
                        <?php if($key['status'] == 'approve'): ?>
                        <tr>
                            <?php if(get_session('level') == 1): ?>
                            <td><?= $key['doctor_name']; ?></td>
                            <?php endif; ?>
                            <td><?= $key['date']; ?></td>
                            <td><?= $key['time']; ?></td>
                            <td>
                                <?php if($key['status'] == 'approve'): ?>
                                <span class="bg-success text-white">Accepted</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
      </div>
      <div class="tab-pane" id="bottom-tab3">
        <div class="card-box">
        <div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <?php if(get_session('level') == 1): ?>
                        <th>Doctor</th>
                        <?php endif; ?>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(data()['appointment'] as $key): ?>
                        <?php if($key['status'] == 'cancel'): ?>
                        <tr>
                            <?php if(get_session('level') == 1): ?>
                            <td><?= $key['doctor_name']; ?></td>
                            <?php endif; ?>
                            <td><?= $key['date']; ?></td>
                            <td><?= $key['time']; ?></td>
                            <td>
                                <?php if($key['status'] == 'cancel'): ?>
                                <span class="bg-danger text-white">Cancel Schedule</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
      </div>
      <div class="tab-pane" id="bottom-tab4">
        <div class="card-box">
          <div class="row">
          <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Patient Total</h4>
                            <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> Health Line Monitor</span>
                        </div>	
                        <canvas id="bargraph"></canvas>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>
<script>
$(document).ready(function() {

    // Line Chart

	// var lineChartData = {
	// 	labels: [<?= $implode_months; ?>],
	// 	datasets: [{
	// 		label: "Progress",
	// 		backgroundColor: "rgba(0, 158, 251, 0.5)",
	// 		data: [<?= $graph; ?>]
	// 	}]
	// };
	
	// var linectx = document.getElementById('linegraph').getContext('2d');
	// window.myLine = new Chart(linectx, {
	// 	type: 'line',
	// 	data: lineChartData,
	// 	options: {
	// 		responsive: true,
	// 		legend: {
	// 			display: false,
	// 		},
	// 		tooltips: {
	// 			mode: 'index',
	// 			intersect: false,
	// 		}
	// 	}
	// });
	
	// Bar Chart

	var barChartData = {
		labels: [<?= $implode_months; ?>],
		datasets: [{
			label: 'Patient Improvement Progress %',
			backgroundColor: 'rgba(0, 158, 251, 0.5)',
			borderColor: 'rgba(0, 158, 251, 1)',
			borderWidth: 1,
			data: [<?= $graph; ?>]
		}]
	};

	var ctx = document.getElementById('bargraph').getContext('2d');
	window.myBar = new Chart(ctx, {
		type: 'bar',
		data: barChartData,
		options: {
			responsive: true,
			legend: {
				display: false,
			}
		}
	});

	// Bar Chart 2
	
    barChart();
    
    $(window).resize(function(){
        barChart();
    });
    
    function barChart(){
        $('.bar-chart').find('.item-progress').each(function(){
            var itemProgress = $(this),
            itemProgressWidth = $(this).parent().width() * ($(this).data('percent') / 100);
            itemProgress.css('width', itemProgressWidth);
        });
    };
});
</script>
<?php endif; ?>
