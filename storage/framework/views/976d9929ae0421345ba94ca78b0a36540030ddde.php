<div id="pending_hospital_labs" class="tab-pane fade <?php if($_GET['type'] == 'pen_page') { ?> show active <?php } ?>"">
<div class="table_hospital pagination_fixed_bottom">
                        <div class="table-responsive">
                            <table class="table" cellspacing="10">
                                <tr>
                                    <th>MEMBER DATA</th>
                                    <th>ADDRESS</th>
                                    <th>PHONE NUMBER</th>
                                    <th>DATE CREATED</th>
                                    <th></th>
                                </tr>
                                <?php if(count($pending_hospitals) > 0): ?>
                                <?php $__currentLoopData = $pending_hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending_hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d_profile">
                                            <div class="d_pro_text">
                                                <h4><?php echo e($pending_hospital['hosp_name']); ?></h4>
                                                <a href="javascript:;"><?php echo e($pending_hospital['hosp_state']); ?>, <?php echo e($pending_hospital['hosp_country']); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e($pending_hospital['hosp_address']); ?></td>
                                    <td><?php echo e($pending_hospital['hosp_phone']); ?></td>
                                    <td><?php echo e(date('d M Y',$pending_hospital['hosp_created_date'])); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-blue btn-sm mr-2" name="button" onclick="accept_hosp('<?php echo e($pending_hospital->id); ?>','<?php echo e($pending_hospital->hosp_id); ?>');">Accept</button>
                                        <button type="button" class="btn btn-danger btn-sm" name="button" onclick="ignore_hosp('<?php echo e($pending_hospital->id); ?>','<?php echo e($pending_hospital->hosp_id); ?>');">Ignore</button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Pending Hospitals Found</td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="table_pagination">
                            <button type="button" class="btn btn-light btn-xs pre_labs" <?php if ($pending_hospitals->previousPageUrl()) {
                                                                                        } else {
                                                                                            echo "disabled";
                                                                                        } ?> data-url="<?php echo $pending_hospitals->previousPageUrl(); ?>&type=pen_page">Previous Page</button>
                            <input type="hidden" class="pen_page_hidden" value="<?php echo e($pending_hospitals->currentPage()); ?>">
                            <span>Page <?php echo e($pending_hospitals->currentPage()); ?> of <?php echo e($pending_hospitals->lastPage()); ?> Pages</span>
                            <button type="button" class="btn btn-light btn-xs next_labs" <?php if ($pending_hospitals->nextPageUrl()) {
                                                                                            } else {
                                                                                                echo "disabled";
                                                                                            } ?> data-url="<?php echo $pending_hospitals->nextPageUrl(); ?>&type=pen_page">Next Page</button>
                        </div>
                    </div>
</div>
<div id="search_hospital" class="tab-pane fade <?php if($_GET['type'] == 'all_page') { ?> show active <?php } ?>">
<div class="table_hospital pagination_fixed_bottom">
                        <div class="table-responsive">
                            <table class="table" cellspacing="10">
                                <tr>
                                    <th>MEMBER DATA</th>
                                    <th>HOSPITAL ID</th>
                                    <th class="text-center">DOCTORS</th>
                                    <th class="text-center">NURSES</th>
                                    <th class="text-center">ADMIN</th>
                                    <th class="text-right"></th>
                                </tr>
                                <?php if(count($all_hospitals) > 0): ?>
                                <?php $__currentLoopData = $all_hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d_profile">
                                            <div class="d_pro_text">
                                                <h4><?php echo e($all_hospital['hosp_name']); ?></h4>
                                                <a href="javascript:;"><?php echo e($all_hospital['hosp_state']); ?>, <?php echo e($all_hospital['hosp_country']); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Hospital-<?php echo e($all_hospital['hosp_id']); ?></td>
                                    <td class="text-center"><?php echo e($all_hospital['doctorsCount']); ?></td>
                                    <td class="text-center"><?php echo e($all_hospital['nurseCount']); ?></td>
                                    <td class="text-center"><?php echo e($all_hospital['administratorsCount']); ?></td>
                                    <td class="text-right">
                                        <a href="#" onclick="viewHospital(<?php echo $all_hospital['hosp_id'] ?>)" class="btn btn-light btn-xs btn_view_deal" name="button">
                                            <img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View
                                        </a>
                                        <a href="#" onclick="editHospital(<?php echo $all_hospital['hosp_id'] ?>)" class="btn btn-light btn-xs btn_edit_deal" name="button">
                                            <img class="icon" src="<?php echo e(asset('admin/adminimages/btn-edit.svg')); ?>" alt="icon">Edit
                                        </a>
                                        <a href="#" onclick="removeHospital(<?php echo $all_hospital['hosp_id'] ?>)" class="btn btn-light btn-xs btn_delete_deal" name="button">
                                            <img class="icon" src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Delete
                                        </a>
                                        <a class="btn btn-light btn-xs" href="<?php echo e(url('admin/hospital_detail/'.$all_hospital['hosp_id'])); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">More</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Hospitals Found</td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="table_pagination">
                            <button type="button" class="btn btn-light btn-xs pre_labs" <?php if ($all_hospitals->previousPageUrl()) {
                                                                                        } else {
                                                                                            echo "disabled";
                                                                                        } ?> data-url="<?php echo $all_hospitals->previousPageUrl(); ?>&type=all_page">Previous Page</button>
                            <input type="hidden" class="all_page_hidden" value="<?php echo e($all_hospitals->currentPage()); ?>">
                            <span>Page <?php echo e($all_hospitals->currentPage()); ?> of <?php echo e($all_hospitals->lastPage()); ?> Pages</span>
                            <button type="button" class="btn btn-light btn-xs next_labs" <?php if ($all_hospitals->nextPageUrl()) {
                                                                                            } else {
                                                                                                echo "disabled";
                                                                                            } ?> data-url="<?php echo $all_hospitals->nextPageUrl(); ?>&type=all_page">Next Page</button>
                        </div>
                    </div>
</div>