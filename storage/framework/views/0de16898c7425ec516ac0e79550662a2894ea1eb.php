<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
	<div class="row">
		<div class="col-12">
			<div class="page_head">
				<h1 class="heading">Health Record List
					<!-- <a class="add_schedule" data-toggle="modal" data-target="#add_deal" href="javascript:;" onclick="$('#dealTitle,#submit_deal_btn').html('Add Deal')">
                        <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
                    </a> -->
				</h1>
				<div class="select_box col-md-2">
					<select class="form-control" name="filterHealthRecord" id="filterHealthRecord" onChange="filterHealthRecord(this.value)">
						<option value="0" selected>Filter By Status</option>
						<option value="All" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'All' ? 'selected' : '' ?>>All</option>
						<option value="Employee" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Employee' ? 'selected' : '' ?>>Employee</option>
						<option value="Hospital" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Hospital' ? 'selected' : '' ?>>Hospital</option>
						<option value="Doctor" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Doctor' ? 'selected' : '' ?>>Doctor</option>
						<option value="Patient" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Patient' ? 'selected' : '' ?>>Patient</option>
						<option value="Nurse" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Nurse' ? 'selected' : '' ?>>Nurse</option>
						<option value="Date" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Date' ? 'selected' : '' ?>>Created At</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12 main_div">
			<div class="table_hospital pagination_fixed_bottom">
				<div class="table-responsive">
				<table class="table" cellspacing="10">
                           <tr>
							   <th>DATE</th>
							   <th>PATIENT </th>
                               <th>HOSPITAL </th>
                               <th>DOCTOR NAME</th>
                               <th>MEDICAL RECORD NUMBER</th>
                               <th></th>
                           </tr>
                           <?php $__currentLoopData = $health_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $health_his): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr>

                                   <td><?php if(date('Y-m-d' ,$health_his['created_date'])==date('Y-m-d')): ?>
                                    <?php echo e('Today'); ?><br>
                                    <?php elseif(date('Y-m-d' ,$health_his['created_date'])==date('Y-m-d',strtotime('+1 day'))): ?>
                                    <?php echo e('Tomorrow'); ?><br>
                                    <?php endif; ?>
                                    <?php echo e(date('d F Y' ,$health_his['created_date'])); ?>

								</td>
								<td>PATIENT-<?php echo e($health_his->patient_id); ?></td>
                                   <?php if(!empty($health_his->doctor_id)): ?>                                
                                    <td><?php echo e(@$health_his->doctor->doctor_hospital_details->hosp_name); ?></td>
                                  <?php elseif(!empty($health_his->nurse_id)): ?>
                                    <td><?php echo e(@$health_his->nurse->nurse_hospital_details->hosp_name); ?></td>
                                  <?php elseif(!empty($health_his->employee_id)): ?>
                                    <td><?php echo e(@$health_his->employee->employee_hospital_details->hosp_name); ?></td>
                                  <?php elseif(!empty($health_his->hospital_id)): ?>
                                    <td><?php echo e(@$health_his->hospital->hosp_name); ?></td> 
                                  <?php endif; ?>
                                   <td>

                                       <div class="d_profile">
                                          <?php if(!empty($health_his->doctor_id)): ?>
                                           <div class="d_pro_img">
                                                <?php
                                    if(!empty($health_his->doctor->doctor_picture)){
                                       if(file_exists(getcwd().'/doctorimages/'.$health_his->doctor->doctor_picture)){
                                        ?>
                                                        <img src="<?php echo e(asset('/doctorimages/'.$health_his->doctor->doctor_picture)); ?>" alt="image">
                                                <?php     }
                                                     else { ?>
                                                           <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="image">
                                                  <?php   }
                                                  }
                                                  else { ?>
                                                           <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="image">
                                                  <?php   }

                                                   ?>
                                           </div>
                                           <div class="d_pro_text">
                                               <h4> <?php if($health_his->doctor->doctor_gender === 0): ?> Mr.
                                               <?php elseif($health_his->doctor->doctor_gender== 1 && $health_his->doctor->marital_status== 1): ?>Mrs
                                               <?php elseif($health_his->doctor->doctor_gender== 1): ?> Miss
                                                 <?php endif; ?> 
                                                 <?php echo e($health_his->doctor->doctor_first_name); ?> <?php echo e($health_his->doctor->doctor_last_name); ?></h4>
                                              <!--  <a href="javascript:;">View Profile</a> -->
                                           </div>
                                          <?php elseif(!empty($health_his->nurse_id)): ?>
                                            <div class="d_pro_img">
                                                <?php if(!empty($health_his->nurse->nurse_picture)): ?>
                                                    <img src="<?php echo e(asset('admin/nurse/uploads/profile/'.$health_his->nurse->nurse_picture)); ?>" alt="image">                               
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('admin/nurse/images/profile.svg')); ?>" alt="image">                                                
                                                <?php endif; ?>
                                           </div>
                                           <div class="d_pro_text">
                                               <h4>Mr. <?php echo e(@$health_his->nurse->nurse_first_name); ?> <?php echo e(@$health_his->nurse->nurse_last_name); ?></h4>
                                               <a href="javascript:;">View Profile</a>
                                           </div>
                                          <?php elseif(!empty($health_his->employee_id)): ?>
                                            <div class="d_pro_img">
                                                <?php if(!empty($health_his->employee->employee_picture)): ?>
                                                    <img src="<?php echo e(asset('admin/employee/uploads/profile/'.$health_his->employee->employee_picture)); ?>" alt="image">                               
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('admin/employee/images/profile.svg')); ?>" alt="image">                                                
                                                <?php endif; ?>
                                           </div>
                                           <div class="d_pro_text">
                                               <h4>Mr. <?php echo e($health_his->employee->first_name); ?> <?php echo e($health_his->employee->last_name); ?></h4>
                                               <a href="javascript:;">View Profile</a>
                                           </div>
                                          <?php elseif(!empty($health_his->hospital_id)): ?>
                                             <div class="d_pro_img">
                                                <?php if(!empty($health_his->hospital->hospital_picture)): ?>
                                                    <img src="<?php echo e(asset('admin/hospital/uploads/profile/'.$health_his->hospital->hospital_picture)); ?>" alt="image">                               
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('admin/hospital/images/profile.svg')); ?>" alt="image">                                                
                                                <?php endif; ?>
                                           </div>
                                           <div class="d_pro_text">
                                               <h4><?php echo e(@$health_his->hospital->hosp_name); ?></h4>
                                               <a href="javascript:;">View Profile</a>
                                           </div>
                                          <?php endif; ?>
                                     </div>
                                   </td>
                                    <td>MRN-<?php echo e($health_his->history_id); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('admin/view_record/'.$health_his->history_id)); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a>
                                         <div class="dropdown d-inline-block">
                                          <a class="option no_caret btn-xs dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?php echo e(asset('admin/doctor/images/options.svg')); ?>" alt="icon"/>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                              <a class="dropdown-item" href="javascript:;" onclick="billingInfo(this); return false;" data-id="<?php echo e($health_his->history_id); ?>"><span><img src="<?php echo e(asset('admin/doctor/images/billling.svg')); ?>" alt="icon"></span>Billing Info</a>
                                              <a class="dropdown-item" href="<?php echo e(url('admin/search_patient')); ?>"><span><img src="<?php echo e(asset('admin/doctor/images/schedule.svg')); ?>" alt="icon"></span>Schedule Appointment</a>
                                          </div>
                                      </div>
                                    </td>
                               </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                       
                       </table>
				</div>

				<div class="table_pagination">
					<button type="button" class="btn btn-light btn-xs pre1" <?php if($health_history->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $health_history->previousPageUrl(); ?>">Previous Page</button>
					<span>Page <?php echo e($health_history->currentPage()); ?> of <?php echo e($health_history->lastPage()); ?> Pages</span>
					<button type="button" class="btn btn-light btn-xs next1"  <?php if($health_history->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $health_history->nextPageUrl(); ?>">Next Page</button>
				</div>
			</div>
		</div>
</main>


<!-- Modal -->
<div class="modal fade" id="view_user" role="dialog">
	<div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
		<div class="modal-content">
			<div class="modal-header">
				<h3>View Details
				</h3>
				<button type="button" class="close" data-dismiss="modal">
					<img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
				</button>
			</div>

			<div class="modal-body">
				<div class="alert alert-danger-outline alert-danger-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
					<div class="d-flex align-items-center">
						<div class="alert-icon-col">
							<span class="fa fa-warning">
							</span>
						</div>
						<div class="alert_text adddr_danger_pop">
						</div>
						<a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
							<i class="fa fa-close">
							</i>
						</a>
					</div>
				</div>
				<div class="alert alert-success-outline alert-success-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
					<div class="d-flex align-items-center">
						<div class="alert-icon-col">
							<span class="fa fa-check">
							</span>
						</div>
						<div class="alert_text adddr_success_pop">
						</div>
						<a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
							<i class="fa fa-close">
							</i>
						</a>
					</div>
				</div>

				<div class="row" id="view_user_body">

				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>