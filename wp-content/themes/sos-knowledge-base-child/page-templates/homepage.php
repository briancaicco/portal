<?php
/**
 * Template Name: Home Page - Knowledge Base
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package sos-knowledge-base
 */


 global $eckb_kb_id, $epkb_password_checked;

 $kb_id = $eckb_kb_id;
 $kb_config = epkb_get_instance()->kb_config_obj->get_kb_config_or_default( $kb_id );

 /**
  * Display MAIN PAGE content
  */
 get_header();

 // initialize Main Page title
 if ( $kb_config[ 'templates_display_main_page_main_title' ] === 'off' ) {
 	$kb_main_pg_title = '';
 } else {
 	$kb_main_pg_title = '<h1 class="eckb_main_title">' . get_the_title() . '</h1>';
 }

 $template_style1 = EPKB_Utilities::get_inline_style(
            'padding-top::       templates_for_kb_padding_top,
 	        padding-bottom::    templates_for_kb_padding_bottom,
 	        padding-left::      templates_for_kb_padding_left,
 	        padding-right::     templates_for_kb_padding_right,
 	        margin-top::        templates_for_kb_margin_top,
 	        margin-bottom::     templates_for_kb_margin_bottom,
 	        margin-left::       templates_for_kb_margin_left,
 	        margin-right::      templates_for_kb_margin_right,', $kb_config );


$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="eckb-kb-template" <?php echo $template_style1; ?>>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div
				class="<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

<?php
					echo $kb_main_pg_title;

				while ( have_posts() ) {

				    the_post();

					if ( post_password_required() ) {
						echo get_the_password_form();
						echo '</div>';
						get_footer();
						return;
					}
					$epkb_password_checked = true;

					// get post content
					$post = empty($GLOBALS['post']) ? '' : $GLOBALS['post'];
					if ( empty($post) || ! $post instanceof WP_Post  ) {
						continue;
					}
					$post_content = $post->post_content;

					// output KB Main Page
					$striped_content = empty($post_content) ? '' : preg_replace('/\s+|&nbsp;/', '', $post_content);
					$generate_main_page_directly = empty($striped_content) || strlen($striped_content) < 27;

					// if the page contains only shortcode then directly generate the Main Page
					if ( $generate_main_page_directly ) {
						echo EPKB_Layouts_Setup::output_main_page( $kb_config );

					// otherwise output the full content of the page
					} else {
						$post_content = apply_filters( 'the_content', $post_content );
						echo str_replace( ']]>', ']]&gt;', $post_content );
					}

				}
				?>




				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar( 'right' ); ?>

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>



<!-- ***************************************************************************
2018-01-07 - ismara - old PAGE for faq homepage
********************************************************************************
<?php
/**
 * Template Name: Home Page old - Knowledge Base
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package sos-knowledge-base
 */
/*
get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="wrapper-search">
	<div class="home-search row justify-content-sm-center">
		<div class="col-sm-7">
			<!-- Display Custom Search box -->
			<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<label class="assistive-text" for="s">Search</label>
				<div class="form-group">
					<input class="field form-control" id="s" name="s" type="text" placeholder="Search …">
				</div>
			</form>
		</div>
	</div>
</div>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row site-main" id="main" role="main">

			<div class="col-md-8">

				<div class="row">
					<div class="col-sm-12">
						<h3>Help Topics</h3>
						<hr/>
						<br/>
					</div>
				</div>

				<div class="row">

					<div class="col-md-12">
						<?php
						get_sidebar( 'home_left' );
						?>
					</div>

				</div>
			</div>

			<div class="col-md-4">
				<?php
				get_sidebar( 'home_right' );
				?>
			</div>


		</div>

	</main><!-- #main -->

</div><!-- #primary -->


</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); */?>

-->
