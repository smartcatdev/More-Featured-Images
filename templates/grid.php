<?php namespace mfi; ?> 

<?php $mfi_image = get_post_meta( get_the_ID(), 'mfi_image', true ); ?>

<?php if ( is_array( $mfi_image ) ) {?>

    <div>

        <?php foreach ( $mfi_image as $single_mfi_image ){ ?>

            <?php echo '<div class="mfi_image_item grid" style="background-image:url(' . $single_mfi_image . ')" ></div>'; ?>
                        
        <?php } ?>

    </div>
    
    <div class="clear clearfix"></div>

<?php }
