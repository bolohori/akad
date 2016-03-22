<?php
if('posts' == get_option('show_on_front')){
    include(get_home_template());
}else{
    global $xt_corporate_lite_opt;
    if(!empty($xt_corporate_lite_opt)){
        get_template_part('home','template');
    }else{
        include(get_page_template());
    }
}
?>