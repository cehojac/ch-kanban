<div id='boardlists' class="board-lists">
    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div id='<?php echo e($term->slug); ?>' data-term-id="<?php echo e($term->term_taxonomy_id); ?>" class="board-list" ondrop="dropIt(event)" ondragover="allowDrop(event)">
        <div class="list-title">
          <?php echo e($term->name); ?> 
        </div>
        <?php $__currentLoopData = $cards[$term->slug]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div  id='card-<?php echo e($card->ID); ?>' class="card" draggable="true" ondragstart="dragStart(event)">
                <?php if(has_post_thumbnail($card->ID)): ?>
                <div class="card-thumbnail">
                    <div style="background-image: url('<?php echo e(get_the_post_thumbnail_url($card->ID)); ?>')";></div>
                </div>
                <?php endif; ?>
                <div class="card-title"><a href="/wp-admin/post.php?post=<?php echo e($card->ID); ?>&action=edit"><?php echo e($card->post_title); ?></a></div>
                <div class="card-time"><strong><?php echo \Carbon\Carbon::parse($card->post_date)->locale("es_ES")->diffForHumans(); ?></strong></div>
                
                <div class="card-priority">
                    <?php $prioridad = wp_get_post_terms( $card->ID, 'prioridad' );?>
                    <?php echo e(__('Priority','ch-kanban')); ?>: <?php echo e($prioridad[0]->name); ?>

                </div>
                <div class="card-auhtor"><?php echo e(__('Auhtor','ch-kanban')); ?>: <?php echo get_avatar( get_the_author_meta( $card->post_author ), 16 ); ?> <?php echo e(get_the_author_meta('display_name', $card->post_author)); ?></div>
                <div class="card-menbers"> <?php echo e(__('Members','ch-kanban')); ?>: 
                    <?php $members = get_post_meta($card->ID,'ticket_members',true); ?>
                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo get_avatar( get_the_author_meta( $menber), 16 ); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
</div><?php /**PATH /var/www/html/wp-content/plugins/ch-kanban/resources/views/backend/tickets/tablero.blade.php ENDPATH**/ ?>