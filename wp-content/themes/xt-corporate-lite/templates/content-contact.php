<div class="col-md-6">
    <?php the_content(); ?>
</div>

<div class="col-md-6">
    <?php
    if(function_exists('get_field')) {
        $location = get_field('xt_map_address');

        $zoom = get_field('zoom');
        if (empty($zoom)) {
            $zoom = '14';
        }
        $lat = isset($location['lat']) ? $location['lat'] : '';
        $lng = isset($location['lng']) ? $location['lng'] : '';
        if (!empty($location)):
            ?>
            <?php
            if (function_exists('xt_corporate_lite_get_map')) {
                xt_corporate_lite_get_map(esc_attr($lat), esc_attr($lng), esc_attr($zoom));
            }
            ?>
        <?php endif;
    }?>
</div>


