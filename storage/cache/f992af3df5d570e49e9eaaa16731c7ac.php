<div>
    <table class="widefat fixed">
        <thead>
            <tr class="alternate">
                <th class="manage-column column-columnname" scope="col"><?php echo e(__('Ticket Title','ch-kanban')); ?></th>
                <th class="manage-column column-columnname" scope="col"><?php echo e(__('Created by','ch-kanban')); ?></th>
               
                <th class="manage-column column-columnname" scope="col"><?php echo e(__('Status','ch-kanban')); ?></th>
                <th class="manage-column column-columnname" scope="col"><?php echo e(__('Created at','ch-kanban')); ?></th>
                <th class="manage-column column-columnname" scope="col"><?php echo e(__('Priority','ch-kanban')); ?></th>
               
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="column-columnname"><a href="/wp-admin/post.php?post=<?php echo e($card->ID); ?>&action=edit"><?php echo e($card->post_title); ?></a></td>
                <td class="column-columnname"><a href="<?php echo e(get_author_posts_url(get_the_author_meta($card->post_author))); ?>"><?php echo e(get_the_author_meta('display_name', $card->post_author)); ?></a></td>
              
                <td class="column-columnname">
                    <?php $estado = wp_get_post_terms( $card->ID, 'estado' );?>
                    <?php echo e($estado[0]->name); ?>

                </td>
                <td class="column-columnname"><?php echo \Carbon\Carbon::parse($card->post_date)->locale("es_ES"); ?></td>
                <td class="column-columnname">
                    <?php $prioridad = wp_get_post_terms( $card->ID, 'prioridad' );?>
                    <?php echo e($prioridad[0]->name); ?>

                </td>
                
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div><?php /**PATH /var/www/html/wp-content/plugins/ch-kanban/resources/views/backend/tickets/list.blade.php ENDPATH**/ ?>