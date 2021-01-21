<?php $__env->startSection('content'); ?>                
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">
                    <div class="dropdown sorting">
                      <span class="sortby">Sort by:</span>
                      <a class="nav-link dropdown-toggle sort_bill" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Newest Billing
                      </a>
                      <div class="dropdown-menu dropdown-menu-right sort_options" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="javascript:;" onclick="sortbillings(this); return false;" data-id="1">Newest Billings</a>
                          <a class="dropdown-item" href="javascript:;" onclick="sortbillings(this); return false;" data-id="2">Highest Amount</a>
                          <a class="dropdown-item" href="javascript:;" onclick="sortbillings(this); return false;" data-id="3">Lowest Amount</a>
                      </div>
                    </div>
                </h1>
                <div class="appointment_type billing_type">
                    <ul class="nav nav-pills" role="tablist">
                        <li><a class="active" role="tab"  data-toggle="pill" data-type="all_page" href="#all_billings">All Billings <?php if($billing_count >0): ?><span><?php echo e($billing_count); ?> </span><?php endif; ?></a></li>
                        <li><a role="tab" data-toggle="pill"  href="#outstanding_billings" data-type="out_billings">Outstanding Billings <?php if($outstanding_count >0): ?><span><?php echo e($outstanding_count); ?></span><?php endif; ?></a></li>
                        <li><a role="tab" data-toggle="pill"  href="#paid_billings" data-type="paid_billings">Paid Billings <?php if($paid_count >0): ?><span><?php echo e($paid_count); ?></span><?php endif; ?></a></li>
                     </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">            
            <div class="tab-content main_div">
                <div id="all_billings" class="tab-pane fade show active">
                    <div class="table_hospital pagination_fixed_bottom">
                          <div class="table-responsive">
                       <table class="table" cellspacing="10" id="biling_table">                          
                           <tr>
                               <th>DATE CREATED</th>
                               <th>INVOICE ID</th>
                               <th>HOSPITAL / LABS</th>
                               <th>HMO OFFICER</th>
                               <th>AMOUNT</th>
                               <th>PAID</th>
                               <th>BALANCE</th>
                               <th></th>
                           </tr>                          
                           <?php if(count($billing_detail) > 0): ?>
                            <?php $__currentLoopData = $billing_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr <?php if($billing_det['seen_status'] == 0){ ?> class="recent" <?php } else if($billing_det['payable_amount'] - $billing_det['paid_amount'] > 0){ ?> class="pending" <?php } ?>>
                                    <td><?php echo e(date('j F Y',$billing_det['billing_date'])); ?></td>
                                    <td><?php echo e($billing_det['invoice_number']); ?></td>
                                    <td><?php echo e($billing_det['hospital']['hosp_name']); ?></td>
                                    <td>Mrs. Rosetta Potter</td>
                                    <td>₦ <?php echo e($billing_det['payable_amount']); ?></td>
                                    <td>₦ <?php echo e($billing_det['paid_amount']); ?></td>
                                    <td>₦ <?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?></td>  
                                    <td><a href="<?php echo e(asset('doctor/billing_detail/'.$billing_det['billing_id'].'/'.$id)); ?>" class="btn btn-light btn-xs" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a></td>                                  
                               </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                              <tr>
                                  <td colspan="7" class="text-center">No Bills Found</td>
                              </tr>
                            <?php endif; ?>                                                 
                        </table>
                      </div>
                       <div class="table_pagination">
                           <button type="button" class="btn btn-light btn-xs pre_bill" <?php if($billing_detail->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $billing_detail->previousPageUrl(); ?>&type=all_page">Previous Page</button>
                           <input type="hidden" class="all_hidden" value="<?php echo e($billing_detail->currentPage()); ?>">
                           <span>Page <?php echo e($billing_detail->currentPage()); ?> of <?php echo e($billing_detail->lastPage()); ?> Pages</span>
                           <button type="button" class="btn btn-light btn-xs next_bill"  <?php if($billing_detail->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $billing_detail->nextPageUrl(); ?>&type=all_page">Next Page</button>
                       </div>
                    </div>
                </div>
                <div id="outstanding_billings" class="tab-pane fade">
                    <div class="table_hospital pagination_fixed_bottom">
                              <div class="table-responsive">
                       <table class="table" cellspacing="10">                          
                         <tr>
                             <th>DATE CREATED</th>
                             <th>INVOICE ID</th>
                             <th>HOSPITAL / LABS</th>
                             <th>HMO OFFICER</th>
                             <th>AMOUNT</th>
                             <th>PAID</th>
                             <th>BALANCE</th>
                         </tr>                          
                        <?php if(count($outstanding_detail) > 0): ?>
                          <?php $__currentLoopData = $outstanding_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outstanding_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr <?php if($outstanding_det['seen_status'] == 0){ ?> class="recent" <?php } else if($outstanding_det['payable_amount'] - $outstanding_det['paid_amount'] > 0){ ?> class="pending" <?php } ?>>
                                  <td><?php echo e(date('j F Y',$outstanding_det['billing_date'])); ?></td>
                                  <td><?php echo e($outstanding_det['invoice_number']); ?></td>
                                  <td>Geo Medical Center</td>
                                  <td>Mrs. Rosetta Potter</td>
                                  <td>₦ <?php echo e($outstanding_det['payable_amount']); ?></td>
                                  <td>₦ <?php echo e($outstanding_det['paid_amount']); ?></td>
                                  <td>₦ <?php echo e($outstanding_det['payable_amount'] - $outstanding_det['paid_amount']); ?></td>  
                                  <td><a href="<?php echo e(asset('doctor/billing_detail/'.$outstanding_det['billing_id'])); ?>" class="btn btn-light btn-xs" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a></td>                                  
                             </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No Outstanding Bills Found</td>
                            </tr>
                          <?php endif; ?>                                                  
                       </table>
                     </div>
                       <div class="table_pagination">
                           <button type="button" class="btn btn-light btn-xs pre_bill" <?php if($outstanding_detail->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $outstanding_detail->previousPageUrl(); ?>&type=out_billings">Previous Page</button>
                           <input type="hidden" class="out_hidden" value="<?php echo e($outstanding_detail->currentPage()); ?>">
                           <span>Page <?php echo e($outstanding_detail->currentPage()); ?> of <?php echo e($outstanding_detail->lastPage()); ?> Pages</span>
                           <button type="button" class="btn btn-light btn-xs next_bill"  <?php if($outstanding_detail->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $outstanding_detail->nextPageUrl(); ?>&type=out_billings">Next Page</button>
                       </div>
                    </div>
                </div>
                <div id="paid_billings" class="tab-pane fade">
                    <div class="table_hospital pagination_fixed_bottom">
                              <div class="table-responsive">
                       <table class="table" cellspacing="10">                        
                         <tr>
                             <th>DATE CREATED</th>
                             <th>INVOICE ID</th>
                             <th>HOSPITAL / LABS</th>
                             <th>HMO OFFICER</th>
                             <th>AMOUNT</th>
                             <th>PAID</th>
                             <th>BALANCE</th>
                         </tr>                            
                         <?php if(count($paid_detail) > 0): ?>
                          <?php $__currentLoopData = $paid_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paid_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <tr <?php if($paid_det['seen_status'] == 0){ ?> class="recent" <?php } else if($paid_det['payable_amount'] - $paid_det['paid_amount'] > 0){ ?> class="pending" <?php } ?>>
                                  <td><?php echo e(date('j F Y',$paid_det['billing_date'])); ?></td>
                                  <td><?php echo e($paid_det['invoice_number']); ?></td>
                                  <td>Geo Medical Center</td>
                                  <td>Mrs. Rosetta Potter</td>
                                  <td>₦ <?php echo e($paid_det['payable_amount']); ?></td>
                                  <td>₦ <?php echo e($paid_det['paid_amount']); ?></td>
                                  <td>₦ <?php echo e($paid_det['payable_amount'] - $paid_det['paid_amount']); ?></td>    
                                  <td><a href="<?php echo e(asset('doctor/billing_detail/'.$paid_det['billing_id'])); ?>" class="btn btn-light btn-xs" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a></td>                                
                             </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No Paid Bills Found</td>
                            </tr>
                          <?php endif; ?>                            
                        </table>
                      </div>
                       <div class="table_pagination">
                           <button type="button" class="btn btn-light btn-xs pre_bill" <?php if($paid_detail->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $paid_detail->previousPageUrl(); ?>&type=paid_billings">Previous Page</button>
                           <input type="hidden" class="paid_hidden" value="<?php echo e($paid_detail->currentPage()); ?>">
                           <span>Page <?php echo e($paid_detail->currentPage()); ?> of <?php echo e($paid_detail->lastPage()); ?> Pages</span>
                           <button type="button" class="btn btn-light btn-xs next_bill"  <?php if($paid_detail->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $paid_detail->nextPageUrl(); ?>&type=paid_billings">Next Page</button>
                       </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.doctor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>