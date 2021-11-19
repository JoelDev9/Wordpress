<?php

// Check if Blog Home page
if(is_home()){
    $post_id = get_option( 'page_for_posts' );
}else{
    $post_id = get_the_ID();
}
$leadinjection_onpage_title = get_post_meta( $post_id, 'li-onpage-title', true );

$vc_check = false;
$post = get_post();
if ( $post && preg_match( '/vc_row/', $post->post_content ) ) {
    $vc_check = true;
}

?>

<?php if(!$vc_check || $leadinjection_onpage_title) :?>
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        <?php echo the_title(); ?>
                    </h1>
                </div>
                <div class="col-md-6">
                    <?php custom_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>