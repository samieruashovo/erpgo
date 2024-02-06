<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Visa Clients')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('employee.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import employee CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('employee.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>
        <a href="<?php echo e(route('employee.create')); ?>"
            data-title="<?php echo e(__('Create New Employee')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
        <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Passport No.')); ?></th>
                                <th><?php echo e(__('Visa Type')); ?></th>
                                <th><?php echo e(__('Visa status')); ?></th>
                                <th><?php echo e(__('Total Paid')); ?></th>
                                <th><?php echo e(__('Total Due')); ?></th>
                                
                                

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                    <td class="font-style"><?php echo e($employee->name); ?></td>
                                    <td><?php echo e($employee->email); ?></td>
                                    <?php if($employee->branch_id): ?>
                                        <td class="font-style"><?php echo e(!empty($employee->branch)?$employee->branch->name:''); ?></td>
                                    <?php else: ?>
                                        <td>-</td>
                                    <?php endif; ?>
                                    <?php if($employee->department_id): ?>
                                        <td class="font-style"><?php echo e(!empty($employee->department)?$employee->department->name:''); ?></td>
                                    <?php else: ?>
                                        <td>-</td>
                                    <?php endif; ?>
                                    <?php if($employee->designation_id): ?>
                                        <td class="font-style"><?php echo e(!empty($employee->designation)?$employee->designation->name:''); ?></td>
                                    <?php else: ?>
                                        <td>-</td>
                                    <?php endif; ?>
                                    
                                    <td>
                                        <?php echo e((!empty($employee->user->last_login_at)) ? $employee->user->last_login_at : '-'); ?>

                                    </td>
                                    <?php if(Gate::check('edit employee') || Gate::check('delete employee')): ?>
                                        <td>
                                            <?php if($employee->is_active==1): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit employee')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="<?php echo e(route('employee.edit',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                     data-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                </div>

                                                    <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete employee')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['employee.destroy', $employee->id],'id'=>'delete-form-'.$employee->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($employee->id); ?>').submit();"><i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                                <?php endif; ?>
                                            <?php else: ?>

                                                <i class="ti ti-lock"></i>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/samier/Downloads/erp_sagor_vai_project/erpgo/resources/views/employee/index.blade.php ENDPATH**/ ?>