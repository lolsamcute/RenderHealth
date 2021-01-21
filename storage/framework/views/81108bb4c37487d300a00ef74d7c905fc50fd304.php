<?php 
//~ echo '<pre>'; print_r($appointments); die('here');
 ?>


<?php $__env->startSection('content'); ?>


                <main class="col-12 col-md-12 col-xl-12 bd-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="page_head">
                                <h1 class="heading">
                                    Disputed Billing
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content main_div">
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
                                        <?php if(count($disputed_billing) > 0): ?>

                                <?php $__currentLoopData = $disputed_billing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                      
                                      <tr <?php if($billing_det['seen_status'] == 0){ ?> class="recent" <?php } else if($billing_det['payable_amount'] - $billing_det['paid_amount'] > 0){ ?> class="pending" <?php } ?>>
                                           <td><?php echo e(date('j F Y',$billing_det['billing_date'])); ?></td>
                                           <td><?php echo e($billing_det['invoice_number']); ?></td>
                                           <td><?php echo e($billing_det['hospital']['hosp_name']); ?></td>
                                           <td>Mrs. Rosetta Potter</td>
                                           <td>₦ <?php echo e($billing_det['payable_amount']); ?></td>
                                           <td>₦ <?php echo e($billing_det['paid_amount']); ?></td>
                                           <td>₦ <?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?></td>
                                           <td><a href="<?php echo e(asset('doctor/dispute_billing_detail/'.$billing_det['billing_id'])); ?>" class="btn btn-light btn-xs" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a></td>
                                       </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php else: ?>
                              <tr>
                              <td colspan="7" class="text-center">No Disputed Bills Found</td>
                              </tr>
                                          <?php endif; ?> 
                                   </table>
                                 </div>
                                 <div class="table_pagination">
                                       <button type="button" class="btn btn-light btn-xs pre_bill" <?php if($disputed_billing->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $disputed_billing->previousPageUrl(); ?>">Previous Page</button>
                           <input type="hidden" class="all_hidden" value="<?php echo e($disputed_billing->currentPage()); ?>">
                           <span>Page <?php echo e($disputed_billing->currentPage()); ?> of <?php echo e($disputed_billing->lastPage()); ?> Pages</span>
                           <button type="button" class="btn btn-light btn-xs next_bill"  <?php if($disputed_billing->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $disputed_billing->nextPageUrl(); ?>">Next Page</button>
                                   </div> 
                                </div>
                              </div>
                        </div>
                    </div>
                </main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.doctor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>