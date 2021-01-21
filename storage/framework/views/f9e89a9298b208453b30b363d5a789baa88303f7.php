 <?php if(count($doctors_availability) > 0): ?>
    <?php           
        $count = 0;                                                     
        date_default_timezone_set($timezone);
    ?>
        <?php $__currentLoopData = $doctors_availability; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$availability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <?php

                      
              
    ?>
                                <li>
                                   sssssss
                                    <label for=""></label>
                                     <i class="fas fa-trash-alt availability_delete" id=""></i>
                                </li>
    <?php                             
           
                      
                
           
    ?>                                                             
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <!--  <li>
        <span>No available time set by doctor yet</span>
        
    </li> -->
<?php endif; ?>                                                          
