<?php
/**
* Template Name: Exclusive For You
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

                <div class="exclusive-for-you-banner">
					<h3 class="exclusive-for-you-banner-heading">How to Order</h3>
					<div class="how-to-order">
						<div class='how-to-order-item'>
							<img src="<?php echo get_theme_file_uri('assets/img/upload-photo.svg') ?>" alt="upload-photo">
							<p>Upload Photo</p>
						</div>
						<div class="how-to-order-item"s>
							<img src="<?php echo get_theme_file_uri('assets/img/select-art-type.svg') ?>" alt="select-art-type">
							<p>Select Art Type</p>
						</div>
						<div class="how-to-order-item">
							<img src="<?php echo get_theme_file_uri('assets/img/select-work-size.svg') ?>" alt="select-work-size">
							<p>Select Work Size</p>
						</div>
						<div class="how-to-order-item">
							<img src="<?php echo get_theme_file_uri('assets/img/half-payment.svg') ?>" alt="half-payment">
							<p>Make half payment in advance</p>
						</div>
						<div class="how-to-order-item">
							<img src="<?php echo get_theme_file_uri('assets/img/initiate-work.svg') ?>" alt="initiate-work">
							<p>We will initiate your work</p>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="exclusive-for-you-form">
						<form action="" method="post">

							<label for="uname"><b>Username</b></label>
							<input type="text" placeholder="Enter Username" name="uname" required>

							<label for="psw"><b>Password</b></label>
							<input type="password" placeholder="Enter Password" name="psw" required>

							<button type="submit">Login</button>
							<label>
							<input type="checkbox" checked="checked" name="remember"> Remember me
							</label>
							
							<div class="container" style="background-color:#f1f1f1">
								<button type="button" class="cancelbtn">Cancel</button>
								<span class="psw">Forgot <a href="#">password?</a></span>
							</div>
						</form>
					</div>
				</div>
        
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