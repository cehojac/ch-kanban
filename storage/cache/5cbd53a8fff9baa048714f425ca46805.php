
<?php $__env->startSection('content'); ?>
<?php if(isset($view)&&$view=='list'): ?>
  <?php echo $__env->make('backend.tickets.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
  <?php echo $__env->make('backend.tickets.tablero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.tickets.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/wp-content/plugins/ch-kanban/resources/views/backend/tickets/index.blade.php ENDPATH**/ ?>