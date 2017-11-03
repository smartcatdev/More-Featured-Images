<?php namespace mfi; ?> 

<?php $mfi_image = get_post_meta( get_the_ID(), 'mfi_image', true ); ?>

<?php if ( is_array( $mfi_image ) ) {?>

    <div class="mfi-image-gallery">

        <?php foreach ( $mfi_image as $single_mfi_image ){ ?>

            <div class="mfi-image-gallery-item">
        
                <?php echo '<a href="' . $single_mfi_image . '" data-lightbox="mfi-grid" class="mfi-lightbox-link">' ?>

                    <?php echo '<img class="mfi-gallery-item" src="' . $single_mfi_image . '"/>'; ?>

                <?php echo '</a>' ?>

            </div>
                
        <?php } ?>

    </div> 

    <div class="clear clearfix"></div>
    
    

<?php }
