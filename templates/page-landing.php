<?php
/**
* Template Name: My Landing Page
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

                <!-- ======= Hero Section ======= -->
                <section id="hero" 
                    style="background: url(
                            <?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) ?>
                                            ) top center;">
                    <div class="hero-container">
                        <h1><?php the_title() ?></h1>
                        <h2><?php the_field('landing_page_subtitle') ?></h2>
                        <a href="#about" class="btn-get-started">Get Started</a>
                    </div>
                </section>
                <!-- End Hero Section -->

                <main id="main">

                    <!-- ======= Services Section ======= -->
                    <section id="services">
                        <div class="container wow fadeIn">
                            <div class="section-header">
                                <h3 class="section-title">Services</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                            <div class="services-grid-container">
                                <div class="box">
                                    <img class="product img-responsive" src="<?php echo get_theme_file_uri('assets/img/service1.jpg') ?>" alt="">
                                    <div class="middle">
                                        <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores velit eaque hic est eligendi, veritatis quae illo cumque dolorum! Est saepe nam esse perspiciatis quo illum pariatur a voluptas ab odit excepturi.</div>
                                    </div>
                                    <h6 class="product-title">High Quality Artwork Prints</h6>
                                </div>
                                <div class="box">
                                    <img class="product img-responsive" src="<?php echo get_theme_file_uri('assets/img/service2.jpg') ?>" alt="">
                                    <div class="middle">
                                        <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores velit eaque hic est eligendi, veritatis quae illo cumque dolorum! Est saepe nam esse perspiciatis quo illum pariatur a voluptas ab odit excepturi.</div>
                                    </div>
                                    <h6 class="product-title">Artwork on Demand</h6>
                                </div>
                                <div class="box">
                                    <img class="product img-responsive" src="<?php echo get_theme_file_uri('assets/img/service3.jpg') ?>" alt="">
                                    <div class="middle">
                                        <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores velit eaque hic est eligendi, veritatis quae illo cumque dolorum! Est saepe nam esse perspiciatis quo illum pariatur a voluptas ab odit excepturi.</div>
                                    </div>
                                    <h6 class="product-title">Advertisements</h6>
                                </div>                                
                            </div>
                        </div>
                    </section>
                    <!-- End Services Section -->

                    <!-- ======= Call To Action Section ======= -->
                    <section id="call-to-action">
                        <div class="container wow fadeIn">
                            <div class="row">
                                <div class="col-lg-9 text-center text-lg-left">
                                    <h3 class="cta-title">Call To Action</h3>
                                    <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="col-lg-3 cta-btn-container text-center">
                                    <a class="cta-btn align-middle" href="#">Call To Action</a>
                                </div>
                            </div>

                        </div>
                    </section>
                    <!-- End Call To Action Section -->

                    <!-- ======= Portfolio Section ======= -->
                    <section id="portfolio">
                        <div class="container wow fadeInUp">
                            <div class="section-header">
                                <h3 class="section-title">Popular Arts</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <ul id="portfolio-flters">
                                        <li data-filter=".filter-app, .filter-card, .filter-logo, .filter-web" class="filter-active">All</li>
                                        <li data-filter=".filter-app">App</li>
                                        <li data-filter=".filter-card">Card</li>
                                        <li data-filter=".filter-logo">Logo</li>
                                        <li data-filter=".filter-web">Web</li>
                                    </ul>
                                </div>
                            </div>

                            <div id="portfolio-wrapper">
                                <?php
                                    $products = wc_get_products(array() );
                                    foreach ($products as $product) {
                                        ?>
                                        <div class="portfolio-item filter-app">
                                             <a href="assets/img/portfolio/app1.jpg" data-gall="portfolioGallery" class="venobox">
                                                <?php echo $product->get_image() ?>
                                                <div class="details">
                                                    <h4><?php echo $product->get_name() ?></h4>
                                                    <span>Alosdrellld dono par</span>                                                
                                                </div>
                                             </a>
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>

                        </div>
                    </section>
                    <!-- End Portfolio Section -->

                    <!-- ======= Contact Section ======= -->
                    <section id="contact">
                        <div class="container wow fadeInUp">
                            <div class="section-header">
                                <h3 class="section-title">Contact</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                        </div>

                        <!-- Uncomment below if you wan to use dynamic maps -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452"
                            width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

                        <div class="container wow fadeInUp mt-5">
                            <div class="row justify-content-center">

                                <div class="col-lg-3 col-md-4">

                                    <div class="info">
                                        <div>
                                            <i class="fa fa-map-marker"></i>
                                            <p>A108 Adam Street<br>New York, NY 535022</p>
                                        </div>

                                        <div>
                                            <i class="fa fa-envelope"></i>
                                            <p>info@example.com</p>
                                        </div>

                                        <div>
                                            <i class="fa fa-phone"></i>
                                            <p>+1 5589 55488 55s</p>
                                        </div>
                                    </div>

                                    <div class="social-links">
                                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                    </div>

                                </div>

                                <div class="col-lg-5 col-md-8">
                                    <div class="form">
                                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                <div class="validate"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                                <div class="validate"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                                <div class="validate"></div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                                <div class="validate"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="loading">Loading</div>
                                                <div class="error-message"></div>
                                                <div class="sent-message">Your message has been sent. Thank you!</div>
                                            </div>
                                            <div class="text-center"><button type="submit">Send Message</button></div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                    <!-- End Contact Section -->

                </main>
                <!-- End #main -->

                <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
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

	</body>
</html>