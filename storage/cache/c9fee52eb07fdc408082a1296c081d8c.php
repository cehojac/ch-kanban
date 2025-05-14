    <div class="base">
        <div class="header">
            <div class="left-aligned">
            <a class="button button-primary" href="?page=ch-kanban&view=list&_wpnonce=<?php echo e($nonce); ?>"><?php echo e(__('List','ch-kanban')); ?></a>
            <a class="button button-primary"  href="?page=ch-kanban"><?php echo e(__('Board','ch-kanban')); ?></a>
            <a class="button button-primary"  href="/wp-admin/post-new.php?post_type=ticket"><?php echo e(__('New Card','ch-kanban')); ?></a>
            
            </div>
            <div>
              <h1>CH Kanban</h1>
            </div>
            <div class="right-aligned">
            <!-- <div class="button"></div> -->
            
            </div>
        </div>
            <div class="board">
            <div class="board-header">
            <div class="left">
                <div class="board-header-text"><?php echo e(__('Tickets')); ?></div>
              <!--  <div class="button">Todos</div>
                <div class="button">Sólo míos</div>
                <div class="button">Por usuario</div>
              -->
            </div>
            <div class="right">
                
            </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div><?php /**PATH /var/www/html/wp-content/plugins/ch-kanban/resources/views/backend/tickets/layout.blade.php ENDPATH**/ ?>