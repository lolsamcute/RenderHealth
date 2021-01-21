<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">Create New Deal
                    <a class="add_schedule" data-toggle="modal" data-target="#add_deal" href="javascript:;" onclick="$('#dealTitle,#submit_deal_btn').html('Add Deal')">
                        <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
                    </a>
                </h1>
                <div class="select_box col-md-2">
                    <select class="form-control" name="filterDeals" id="filterDeals" onChange="filterDeals(this.value)">
                        <option value="0" selected>Filter By Status</option>
                        <option value="All" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'All' ? 'selected' : '' ?>>All</option>
                        <option value="Active" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Expired" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Expired' ? 'selected' : '' ?>>Expired</option>
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
        </div>
</main>

<!-- Add Deal -->
<div class="modal fade" id="add_deal">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
        <div class="modal-content">
            <div class="modal-header">
                <h3><span id="dealTitle">Add Deal</span></h3>
                <button type="button" class="close" data-dismiss="modal">
                    <img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger-outline alert-danger-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-col">
                            <span class="fa fa-warning"></span>
                        </div>
                        <div class="alert_text adddr_danger_pop"></div>
                        <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
                            <i class="fa fa-close"></i>
                        </a>
                    </div>
                </div>
                <div class="alert alert-success-outline alert-success-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-col">
                            <span class="fa fa-check"></span>
                        </div>
                        <div class="alert_text adddr_success_pop"></div>
                        <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
                            <i class="fa fa-close"></i>
                        </a>
                    </div>
                </div>

                <form id="addDeal" name="addDeal" enctype="multipart/form-data">

                <Input type="hidden" readonly class="form-control" name="deal_id" id="deal_id" />
                <Input type="hidden" readonly class="form-control" name="mode" id="mode" value="ADD" />

                    <div class="row col-sm-12">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="facility_id">Facility</label>
                                <div class="select_box">
                                    <select class="form-control" name="facility_id" id="deal_facility" >
                                        <option value="0" selected>Select Facility</option>
                                        <?php if($facilities): ?>
                                            <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($facility->id); ?>"><?php echo e($facility->hosp_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- First row -->
                    <div class="row col-sm-12">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="title">Deal Title
                                </label>
                                <input type="text" placeholder="Akintude" class="form-control" name="title" id="title">
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label for="previous_price">Previous Price
                            </label>
                            <input type="text" placeholder="500.00" class="form-control" name="previous_price" id="previous_price">
                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-group">
                            <label for="current_price">Current Price
                            </label>
                            <input type="text" placeholder="500.00" class="form-control" name="current_price" id="current_price">
                        </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <!-- Start Date -->
                        <div class="col-sm-2">
                            <label>Start Date </label>
                            <div class="select_box">
                                <select id="select_num" class="form-control" name="day1" style="background-color: #fff;">
                                <option value="">Select Day</option>
                                <?php for ($i = 1; $i <= 31; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }   ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 px-0">
                            <label>&nbsp;</label>
                            <div class="select_box">
                                <select id="select_day" class="form-control" name="month1" style="background-color: #fff;">
                                <option value="">Select Month</option>
                                <?php for ($m = 1; $m <= 12; $m++) {
                                    $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                    echo '<option value="' . $m . '">' . $month . '</option>';
                                } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>&nbsp;</label>
                            <div class="select_box">
                                <select class="form-control" id="year" name="years1" style="background-color: #fff;">
                                <option value="">Select Year</option>
                                <?php
                                $date = date('Y');
                                $new_date =$date+5;
                                $range = 1980;
                                for($i=$range;$i<=$new_date; $i++){ $year=$range++; ?> <option id="year_get" value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-sm-2">
                            <label>End Date </label>
                            <div class="select_box">
                                <select id="deal_select_num" class="form-control" name="day2" style="background-color: #fff;">
                                <option value="">Select Day</option>
                                <?php for ($i = 1; $i <= 31; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }   ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>&nbsp;</label>
                            <div class="select_box">
                                <select id="deal_select_day" class="form-control" name="month2" style="background-color: #fff;">
                                <option value="">Select Month</option>
                                <?php for ($m = 1; $m <= 12; $m++) {
                                    $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                    echo '<option value="' . $m . '">' . $month . '</option>';
                                } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>&nbsp;</label>
                            <div class="select_box">
                                <select class="form-control" id="deal_year" name="years2" style="background-color: #fff;">
                                <option value="">Select Year</option>
                                <?php
                                $date = date('Y');
                                $new_date =$date+5;
                                $range = 1980;
                                for($i=$range;$i<=$new_date; $i++){ $year=$range++; ?> <option id="deal_year_get" value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="form-group col-sm-8">
                            <label for="categories">Categories</label>
                            <div class="select_box">
                                <select class="form-control" name="category_id" id="deal_categories">
                                    <option value="">Select Categories</option>
                                    <?php if($deal_category): ?>
                                            <?php $__currentLoopData = $deal_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="details">Deal Detail</label>
                                <textarea class="form-control" name="details" id="details"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="restriction">Restriction</label>
                                <textarea class="form-control" name="restriction" id="restriction"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="about_us">About Us</label>
                                <textarea class="form-control" name="about_us" id="about_us"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-sm-12">
                            <div class="add_photo_profile mt-2">
                                <div class="photo_profile_place">
                                    <img src="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>" alt="image" id="preview-image_admin" width="100px" height="100px">
                                </div>
                                <div class="add_pro_picture">
                                    <h3>Add Image</h3>
                                    <span>jpg/png with size maximum 500kb</span>
                                    <label class="btn btn-light btn-sm" for="select_photo_file_admin">Select Photo File</label>
                                    <input type="file" id="select_photo_file_admin" accept="image/jpeg,image/jpg,image/png" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mb-3 mt-3" id="submit_deal_btn" name="button">Add Deal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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