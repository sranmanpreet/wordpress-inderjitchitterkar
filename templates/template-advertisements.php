<?php
/**
* Template Name: Advertisements
**/
?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( oceanwp_html_classes() ); ?>" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<!-- Begin Body -->
	<body <?php body_class(); ?> <?php oceanwp_schema_markup( 'html' ); ?>>

		<?php wp_body_open(); ?>

		<?php do_action( 'ocean_before_outer_wrap' ); ?>

		<div id="outer-wrap" class="site clr">

		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'oceanwp' ); ?></a>

			<?php do_action( 'ocean_before_wrap' ); ?>

			<div id="wrap" class="clr">

            <!-- Custom landing page content starts here -->
                <?php get_header();?>

                <!-- ======= Advertisement Banner ======= -->
                <div id="advertisements-banner" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) ?>)">
                    <h1>Our Colors, Your Brand</h1>
                    <h1>Let's Conquer the World TOGETHER</h1>
                    <hr>
                    <p>Our colors make the walls speak your BRAND and expand your customer base.</p> 
                    <p>We advertise brands by painting walls at public places.</p>
                    <p>Huge experience of the artists and businessmen brings unique expertise. </p> 
                    <p>We help brands to grab attention of potential customers.</p>
                </div>
                <!-- End Hero Section -->
        
            <!-- Custom landing page content ends here -->

				<?php do_action( 'ocean_before_main' ); ?>

				<main id="main" class="site-main clr"<?php oceanwp_schema_markup( 'main' ); ?> role="main">

					<?php do_action( 'ocean_before_content_wrap' ); ?>

					<div id="content-wrap" class="container clr">

						<?php do_action( 'ocean_before_primary' ); ?>

						<section id="primary" class="content-area clr">

							<?php do_action( 'ocean_before_content' ); ?>

							<div id="content" class="site-content clr">

                                <?php do_action( 'ocean_before_content_inner' ); ?>
                                <hr>
                                <h1 id="advertisement-form-heading">Write to us and we will get back to you in 24 hours...</h1>
                                <hr>
                                <div class='contact-form'>
                                    <?php echo do_shortcode('[wpforms id="246"]') ?> 
                                </div>

								<?php while ( have_posts() ) : the_post(); ?>

									<div class="entry-content entry clr">
										<?php the_content(); ?>
									</div><!-- .entry-content -->

								<?php endwhile; ?>

								<?php do_action( 'ocean_after_content_inner' ); ?>

							</div><!-- #content -->

							<?php do_action( 'ocean_after_content' ); ?>

						</section><!-- #primary -->

						<?php do_action( 'ocean_after_primary' ); ?>

					</div><!-- #content-wrap -->

					<?php do_action( 'ocean_after_content_wrap' ); ?>

		        </main><!-- #main-content -->

		        <?php do_action( 'ocean_after_main' ); ?>

		    </div><!-- #wrap -->

		    <?php do_action( 'ocean_after_wrap' ); ?>

		</div><!-- .outer-wrap -->

		<?php do_action( 'ocean_after_outer_wrap' ); ?>

        <?php wp_footer(); ?>
        
        <?php get_footer() ?>   

	</body>
</html>