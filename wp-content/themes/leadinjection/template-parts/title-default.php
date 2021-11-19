<?php

// leadinjection Global options
$leadinjection_global_option = get_option( 'rdx_option' );

// Check if Blog Home page
if(is_home()){
    $post_id = get_option( 'page_for_posts' );
}else{
    $post_id = get_the_ID();
}
$leadinjection_onpage_title = get_post_meta( $post_id, 'li-onpage-title', true );

?>

<?php if($leadinjection_onpage_title || !empty($leadinjection_global_option["li-global-blog-title-enabled"])) :?>
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        <?php if (empty($leadinjection_global_option["li-global-blog-title"])) {
                            echo __('Blog', 'leadinjection');
                        } else {
                            echo esc_html($leadinjection_global_option["li-global-blog-title"]);
                        } ?>
                    </h1>
                </div>
                <div class="col-md-6">
                    <?php custom_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>