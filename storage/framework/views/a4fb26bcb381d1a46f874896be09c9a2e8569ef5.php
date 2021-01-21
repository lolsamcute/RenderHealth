<div class="table_hospital pagination_fixed_bottom">
                <div class="table-responsive">
                    <table class="table" cellspacing="10">
                        <tr>
                            <th>Image</th>
                            <th>Name of facility</th>
                            <th>Deal Category</th>
                            <th>Deal Start Date</th>
                            <th>Deal End Date</th>
                            <th>Deal Status</th>
                            <th>Action</th>
                        </tr>
                        <?php if(count($deals) > 0): ?>
                        <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="photo_profile_place">
                                    <img src="<?php echo e($deal->image ? asset('dealsimages/'.$deal->image) : asset('admin/adminimages/thumb.svg')); ?>" alt="image" id="preview-image" width="100px" height="100px">
                                </div>
                            </td>
                            <td><?php echo e($deal->facility_details['hosp_name']); ?></td>
                            <td><?php echo e($deal->categories_details['name']); ?></td>
                            <td><?php if(!empty($deal->start_date)): ?> <?php echo e(date('d M, Y', strtotime($deal->start_date))); ?> <?php else: ?> <?php echo e("--"); ?> <?php endif; ?> </td>
                            <td><?php if(!empty($deal->end_date)): ?> <?php echo e(date('d M, Y', strtotime($deal->end_date))); ?> <?php else: ?> <?php echo e("--"); ?> <?php endif; ?> </td>
                            <td>
                                <span class="badge badge-pill 
                                    <?php if ($deal['status'] == 'Active') {
                                    echo 'badge-success';
                                    } else if ($deal['status'] == 'Approved') {
                                    echo 'badge-success';
                                    }else if ($deal['status'] == 'New') {
                                        echo 'badge-secondary';
                                    }?>" id="status_row_<?php echo e($deal['id']); ?>">
                                    
                                    <?php if ($deal['status'] == 'Active') {
                                    echo 'Active';
                                    } else if ($deal['status'] == 'Approved') {
                                    echo 'Approved';
                                    }else if ($deal['status'] == 'New') {
                                        echo 'New';
                                    }?>
                                </span>
                            </td>
                            <td>
                                <a href="#" onclick="viewDeal(<?php echo $deal['id'] ?>)" class="btn btn-light btn-xs btn_view_deal" name="button">
                                    <img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View
                                </a>
                                <a href="#" onclick="removeDeal(<?php echo $deal['id'] ?>)" class="btn btn-light btn-xs btn_delete_deal" name="button">
                                    <img class="icon" src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Delete
                                </a>
                                <a href="#" onclick="editDeal(<?php echo $deal['id'] ?>)" class="btn btn-light btn-xs btn_edit_deal" name="button">
                                    <img class="icon" src="<?php echo e(asset('admin/adminimages/btn-edit.svg')); ?>" alt="icon">Edit
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No Deals Found</td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="table_pagination">
                    <button type="button" class="btn btn-light btn-xs pre_emp" 
                    <?php if ($deals->previousPageUrl()) {
                    }else {
                        echo "disabled";
                    } ?> data-url="<?php echo $deals->previousPageUrl(); ?>&type=doc_page">Previous Page
                    </button>
                    <input type="hidden" class="doc_page_hidden" value="<?php echo e($deals->currentPage()); ?>">
                    <span>Page <?php echo e($deals->currentPage()); ?> of <?php echo e($deals->lastPage()); ?> Pages</span>
                    <button type="button" class="btn btn-light btn-xs next_emp" 
                        <?php if ($deals->nextPageUrl()) {
                        } else {
                        echo "disabled";
                        } ?> data-url="<?php echo $deals->nextPageUrl(); ?>&type=doc_page">Next Page
                    </button>
                </div> 
            </div>