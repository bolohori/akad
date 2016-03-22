<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.', 'xt-corporate-lite'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      if(is_front_page()){
          get_template_part('templates/header-homepage');
      }elseif(is_page()){
          get_template_part('templates/header-page');
      }else{
          get_template_part('templates/header');
      }
    ?>

        <?php include xt_corporate_lite_template_path(); ?>

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>