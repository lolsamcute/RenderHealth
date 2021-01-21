<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget ">
                <div class="widget_header widget_flex_header mb-4">
                    <div class="widget_flex">
                        <h2>Billing</h2>
                        <div class="select_box select_black">
                            <?php date_default_timezone_set($time_zone); ?>
                            <?php if(isset($start_date->billing_date)): ?>    
                                <?php                                     
                                    $startDate = $start_date->billing_date; 
                                    $endDate = date("Y-m-t 23:59:59",strtotime('now'));
                                    $presentStartDate = date("Y-m-01 00:00:00",strtotime('now'));    
                                    $dates = array();                                            
                                ?>                                               
                                <?php while($startDate <= strtotime($endDate)): ?> 
                                <?php    $dates[] = $startDate;
                                        $startDate = strtotime("+1 month", $startDate); 
                                        $final_dates = array_reverse($dates);
                                        
                                ?>
                                <?php endwhile; ?>
                                <select class="form-control" name="" onchange="monthlyBillingList(this); return false;">                                   
                                    <?php $__currentLoopData = $final_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date_arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(date('Y-m-01',$date_arr)); ?>" <?php if($date_arr >= strtotime($presentStartDate) &&  $date_arr <= strtotime($endDate)){ echo 'selected' ; } ?>><?php echo e(date('F',$date_arr)); ?> <?php echo e(date('Y',$date_arr)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                                </select>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
                <div class="main_bill_div">
                    <div class="widget_body mb-3 minheight500">
                          <div class="table-responsive">
                        <table class="table theme_table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                        <th scope="col">Hospital</th>
                                        <th scope="col">Invoice Number</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Paid</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col" class="text-center">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($billing_detail) > 0): ?>
                                    <?php $__currentLoopData = $billing_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="cursor_pointer" data-id="<?php echo e($billing_det['billing_id']); ?>" onclick="billingdetail(this); return false;">
                                            <td><?php echo e(date('D, j F Y',$billing_det['billing_date'])); ?></td>
                                            <td>
                                               	<div class="table_profile_header">
                                                	<div class="tprofile_text">
                                                     <?php if(isset($billing_det->doctor)): ?>
                                                	<h3><?php echo e($billing_det->doctor->doctor_hospital_details->hosp_name); ?></h3>
                                                	<p>Dr. <?php echo e($billing_det->doctor->doctor_first_name); ?> <?php echo e($billing_det->doctor->doctor_last_name); ?>, <?php echo e($billing_det->doctor->doctor_degree); ?></p>
                                                    <?php endif; ?>
                                                	</div>
                                                </div>
                                            </td>
                                            <td><?php echo e($billing_det['invoice_number']); ?></td>
                                            <td>₦ <?php echo e($billing_det['payable_amount']); ?></td>
                                            <td>₦ <?php echo e($billing_det['paid_amount']); ?></td>
                                            <td>₦ <?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?></td>
                                            <?php if(($billing_det['payable_amount'] - $billing_det['paid_amount']) == 0): ?>
                                                <td class="text-center">
                                                    <button type="button" class="button_sm button_approved">Paid</button>
                                                </td>                                        
                                            <?php else: ?>                                            
                                                <td class="text-center">
                                                    <a href="<?php echo e(url('/patient/paybill/'.$billing_det['billing_id'])); ?>" class="btn btn-black btn-xs text-capitalize">Paybill</a>
                                                </td>
                                            <?php endif; ?>                                        
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                  <tr>
                                    <td colspan="6" class="text-center">No Bills Found</td>
                                  </tr>
                                <?php endif; ?>                                                           
                            </tbody>
                        </table>
                    </div>
                        <?php if(count($billing_detail) > 0): ?>
                            <div class="showing_data">
                                 Showing you <?php echo e(count($billing_detail)); ?> datas from your billing, stay health! <img src="<?php echo e(asset('admin/doctor/images/raised-hand.png')); ?>" alt="icon">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                     <?php if($billing_detail->lastPage() > 1): ?>
                        <div class="widget_footer">
                            <?php if($billing_detail->hasPages()): ?>
                              <ul class="pagination">
                                  
                                  <?php if($billing_detail->onFirstPage()): ?>
                                      <li class="disable"><a href="javascript:;"><img src="<?php echo e(asset('images/left_page.svg')); ?>" alt="icon"></a></li>
                                  <?php else: ?>
                                      <li><a href="<?php echo e($billing_detail->previousPageUrl()); ?>"><img src="<?php echo e(asset('images/left_page.svg')); ?>" alt="icon"></a></li>
                                  <?php endif; ?>
                                  
                                  <?php if($billing_detail->hasMorePages()): ?>
                                      <li><a href="<?php echo e($billing_detail->nextPageUrl()); ?>"><img src="<?php echo e(asset('images/right_page.svg')); ?>" alt="icon"></a></li>        
                                  <?php else: ?>
                                      <li class="disable"><a href="javascript:;"><img src="<?php echo e(asset('images/right_page.svg')); ?>" alt="icon"></a></li>
                                  <?php endif; ?>
                            </ul><?php endif; ?>
                        </div>
                      <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>