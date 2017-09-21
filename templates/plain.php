<?php namespace mfi; ?> 

<?php $mfi_image = get_post_meta( get_the_ID(), 'mfi_image', true ); ?>

<?php if ( is_array( $mfi_image ) ) {?>

    <div class="mfi_image_container">
        
            <?php foreach ( $mfi_image as $single_mfi_image ){ ?>

                <?php echo '<img class="mfi_plain_image" src="' . $single_mfi_image . '"/>'; ?>

            <?php } ?>

    </div>

<?php }
