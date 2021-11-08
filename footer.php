<div class="clearfix"></div>
<footer id="footer" class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="widget col-12 col-md-6 pr-md-5 footer-links">
					<div class="inner-widget">
						<h3 class="widget-title">Quick links</h3>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
                            <li><a href="gallery.php">Portfolio</a></li>
						</ul>
					</div>
				</div>

				<div class="widget col-12 col-md-6 pl-md-5 footer-contact">
					<div class="inner-widget">
						<h3 class="widget-title">Contact me</h3>
						<p> If you have any questions about my services, or just want to say hi, feel free to contact me. Below are my social links and online portfolios:
						</p>
						<ul class="social-links">
							<li><a href="https://www.instagram.com/miriamsdesigns" class="instagram"><i class="fa fa-instagram" aria-label="Instagram" aria-hidden="true"></i></a></li>	
							<li><a href="https://www.behance.net/mkhenissi28b4f/projects" target="_blank" class="behance"><i class="fa fa-behance" aria-label="Behance" aria-hidden="true"></i></a></li>			
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin" aria-label="Linkedin" aria-hidden="true"></i></a></li>					
						</ul>
					</div>
				</div>

				
			</div>
		</div>
	</div>
	<div class="bottom-footer">
		<div class="container">
			<p><small style=" color: white; ">© Copyright <strong>MayaKh.com</strong>. All Rights Reserved</small></p>
			<p class="credits"><small style=" color: white; ">Designed by <a href="mayakh.com">MayaKh.com</a></small></p>
		</div>
	</div>

</footer>

<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.intro-hero .inner-intro-hero .slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            vertical:true,
            autoplay: true,
            autoplaySpeed: 1200, 
            pauseOnFocus:false,
            pauseOnHover:false,           
            focusOnSelect:false,
        });

        setTimeout(function(){
        	$('.home-page-body .navigation-header-wrap').addClass('ready');
        	$('.home-page-body .first-section').addClass('ready');
        },800);


        var _lastScrollTop = 0;
        window.onscroll = function(event) {
            if(!window.scrollY) return false;

            var _st = window.scrollY, _stDirection = '';
            if (_st > _lastScrollTop) {
                _stDirection = 'down';
            }else {
                _stDirection = 'up';
            }

            //This only for the home page.
            if(document.body.classList.contains('home-page-body')) {
                if (_st >= 20) {
                    // Add class nav-background to body..
                    document.body.classList.add('nav-background');
                    if (_stDirection === 'down') document.body.classList.add('nav-down-pos'); //Add class nav-down-pos to body...;
                }else {
                    //Remove class nav-background from body
                    document.body.classList.remove('nav-background');
                }

                if (_stDirection === 'up') document.body.classList.remove('nav-down-pos'); //remove class nav-down-pos from body;
            }
            //END This only for the home page.
            _lastScrollTop = _st;
        }


    });
</script>


<script src="https://kit.fontawesome.com/5ff82a3bf5.js" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.0.1/dist/gsap.min.js"></script> -->

