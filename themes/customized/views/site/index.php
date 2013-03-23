

<?php include_once("fb-js-sdk.php"); ?>


<!--<div id="tst" class="container" style="position:fixed; top:0; left:0; color:#FFF; background-color:#066; z-index:11111120"> a </div>-->

<!-- Site will be fade-in using the below pageFade div -->
<div class="pageFade" style="background-color:#ececec; width:100%;height:100%; z-index:1000000; position:fixed"></div>

<!--
Site main frame begin
Note: Don't edit main frame, except comment area
-->



<div  class="header">	
	<div class="container headerContent">
        	
		<!-- Place your logo here. data-src-small use to add logo for mobile device -->
		<div class="logo" >
			<a href="#home"><img src="<?php echo Yii::app()->request->baseUrl;?>/themes/customized/images/logo.png" data-src-small="images/logo_s.png" alt="logo text"></a>
        </div>
		
		<div class="top-links">
			<a id="fb-login-button"><img src="<?php echo Yii::app()->request->baseUrl;?>/themes/customized/images/fb-login.png" /></a>
			<a href="#login" class="top-link"> Login </a>
			<a href="#register" class="top-link"> Register </a>
			<form class="top-link" id="search-form">
				<input type="text" value="Search Keywords" id="search" name="search"  
					onfocus="if(this.value == 'Search Keywords') {this.value = '';}"  
					onblur="if (this.value == '') {this.value = 'Search Keywords';}" />
				<button type="submit" id="search_btn"  class="button alignLeft"><img src="<?php echo Yii::app()->request->baseUrl;?>/themes/customized/images/search-button.png" alt="search"/></button>
			</form>
		</div>
                
		<div class="nav">
			<div id="mobile_nav"> <span>SELECT PAGE </span> </div>
			<ul>
                <!--  Add require site page navigation -->                    
                <li><a href="#home">Home</a></li> 
                <li><a href="#music">Music</a>
					<!-- Sub menu -->
                	<ul>
                		<li><a> Song 01</a></li>
                	</ul>
                <li><a href="#drama">Drama Series</a> 
                	<!-- Sub menu -->
                	<ul>
                		<li><a> Series 01</a></li>
                	</ul>
                </li>
                <li><a href="#shows">Shows</a>
                	<!-- Sub menu -->
                	<ul>
                		<li><a href="#shows-show01">Show 01</a></li>
                	</ul>
                </li>
                    
                <li><a href="#schedule">Schedule</a></li>
				<li><a href="#live">Live</a></li>
				<li><a href="#mobile" class="last">Mobile</a></li>
				<li><a href="#" class="last">Shop</a></li>				
			</ul>
		</div>             
	</div>
</div>       

<!-- The Dynamic content will be load inside the below mainContainer div-->
<div class="mainContainer" >
    
    <div id="bodyContent" >
        
        <!-- Portfolio/News full details content are load in backArea id div  -->
       	<div id="backArea" ></div>
        
         <div ><div id="fsTextWarp" ></div></div>
        
        <div class="dynamicLoad" >
            <div class="contentWarp container" >
            	<!-- Page content are loaded inside the pageHolder div  -->
				<div class="pageHolder" ></div>        
            </div>
        </div>
        
    </div>

</div>
 

<?php
// include static content pages, these are always present on the page
include_once("static.php");
?>

<?php
// include hidden content pages, these display at the bottom of the page when their respective link is clicked
include_once("hidden.php");
?>


<!-- Hidden Bottom Page -->
       
<div class="staticContent bgShadowCenter" id="bottom-page" data-id="bottom_page" style="padding:100px 0px 0px 0px; overflow:hidden" >   	

</div>

<div class="hiddenPage">
	<div id="privacy-policy">
		<h1> Privacy Policy </h1>
		<p> You are not allowed to copy any of the material posted on this website. </p>
	</div>
</div>

<div class="hiddenPage">
	<div id="disclaimer">
		<h1> Disclaimer </h1>
		<p> You are not allowed to copy any of the material posted on this website. </p>
	</div>
</div>	
        

<!-- Bottom Menu -->
<div class="bottom-menu">
	<div class="container nav">
		<a class="bottom-link" id="about-us-link" href="#home"> About Us </a>
		<a class="bottom-link" href="#bottom_page" data-page-id="advertise"> Advertise with Us </a>
		<a class="bottom-link" id="tune-in-link" href="#home"> Tune in </a>
		<a class="bottom-link" href="#bottom_page" data-page-id="music_gallery"> Music </a>
		<a class="bottom-link" href="#bottom_page" data-page-id="video_gallery"> Video </a>
		<a class="bottom-link" href="#bottom_page" data-page-id="video_submission"> Music Video Submission </a>
		<a class="bottom-link pop-up-link" id="privacy-link" href="#privacy-policy"> Privacy Policy </a>
		<a class="bottom-link pop-up-link" id="disclaimer-link" href="#disclaimer"> Disclaimer </a>
		<a class="bottom-link" href="#bottom_page" data-page-id="career"> Career </a>
		<a class="bottom-link" href="#bottom_page" data-page-id="contact_us"> Contact Us </a>
	</div>
</div>

<script>
	$(function(){
		$("#about-us-link").click(function(){
			$(".slider1 .about-us").css({'visibility': 'visible', 'opacity': 1, 'position': 'relative', 'left':0, 'top':0});
			$(".slider1 .fmSlider_animate").not(".about-us").css({'visibility': 'hidden', 'opacity': 0, 'position': 'absolute', 'top': '-10000px'});
			$('html, body').animate({
					scrollTop: - $(".header").outerHeight()
			}, 2000);
		});
		$("#tune-in-link").click(function(){
			$(".slider1 .tune-in").css({'visibility': 'visible', 'opacity': 1, 'position': 'relative', 'left':0, 'top':0});
			$(".slider1 .fmSlider_animate").not(".tune-in").css({'visibility': 'hidden', 'opacity': 0, 'position': 'absolute', 'top': '-10000px'});
			$('html, body').animate({
					scrollTop: - $(".header").outerHeight()
			}, 2000);
		});
		$('[href="#bottom_page"]').click(
			function(){
				
				stage = $("#bottom-page");
				pageID = $(this).attr("data-page-id");
				page = $('[data-id="'+pageID+'"]');
				stage.fadeOut(750, function(){
					stage.empty();
					stage.append(page.html());
				});
				stage.fadeIn(750);				
				$('html, body').animate({
					scrollTop: stage.offset().top - $(".header").outerHeight()
				}, 1500);
			}
		);
		var page = $("#bottom-page");
		var verticalPadding = parseInt(page.css("padding-top"), 10)+parseInt(page.css("padding-bottom"), 10);
		var requiredHeight = $(window).height()-$(".header").outerHeight()-$(".footer").outerHeight()-verticalPadding;
		page.css("min-height", requiredHeight);
		/* Initialize the fancybox plug-in for portfolio */
		var privacy_popup = $(".pop-up-link");
		privacy_popup.fancybox({
			'padding'			: 0,
			'titlePosition'		: 'outside',
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'overlayColor'		: '#000',
			'overlayOpacity'	:.75
			
		});
		
		$(".program").click(
			function(){
				stage = $(this).siblings(".stage");
				stage.slideUp(750);
				stage.empty();
				stage.append($(this).children(".program-details").clone());
				stage.slideDown(750);				
				$('html, body').animate({
					scrollTop: stage.offset().top - $(".header").outerHeight()
				}, 1500);
			}
		);
	});
</script>		
		
<!-- Footer Content -->
<div class="footer"  >
	<div class="container" > 
		<!-- Place your copyright text -->
		<div class="five columns"><h6 class="bottomText">Copyright 2013 © NEX1 TV All rights reserved.</h6></div>
		<!-- Address -->
		<div class="three columns"><h6 class="bottomText"></h6></div>
		<!-- Email -->
		<div class="three columns"><h6 class="bottomText"><span class="list2_white">support@nex1.tv</span></h6></div>   
		<!-- Social network web page link  -->
		<div class="four  columns offset-by-one" >
			<ul class="social_bookmarks noMargin">                 
				<li class="twitter_white noMargin"><a >Follow us on Twitter</a></li>
				<li class="facebook_white noMargin"><a >Join our Facebook Group</a></li>
				<li class="gplus_white noMargin"><a >Join me on Google Plus</a></li>
				<li class="linkedin_white noMargin"><a >Add me on Linkedin</a></li>
				<li class="rss_white noMargin"><a >RSS</a></li>
			</ul>
		</div> 
	</div>
</div>

<!-- End site main frame -->

<?php include_once("pages.php"); ?>

</body>

</html>