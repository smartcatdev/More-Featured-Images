<?php

namespace mfi; 
?> 

    <?php $mfi_image = get_post_meta( get_the_ID(), 'mfi_image', true );
          var_dump();
    ?>

    <div>
        <ul id="mfi_images">

            <?php foreach ( $mfi_image as $single_mfi_image ){ ?>

                <?php echo '<li class="mfi_image_item" style="background-image:url(' . $single_mfi_image . ')" >'; ?>
                            </li>

            <?php } ?>
        </ul>
    </div>

