<?php /* @var $this Controller */ ?>
<!DOCTYPE html>

<!-- /**
	NEX1 TV
 	Copyright (c) 2013, 

    Profile: MediaBanq
	
    Version: 1.0.0
	Release Date: 14 December 2012
**/ -->	

    <html lang="en"><head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>NEX1 TV - Music & More</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== --> 
  
  <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->


	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-114x114.png">
  	
    <!-- Included CSS files 
	================================================== -->
    
  	<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/main.min.css">
	<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/base.min.css">
    <link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/color.css">
	<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/skeleton.min.css">
	<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/jquery.fancybox-1.3.4.min.css" media="screen" />
    <link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/flexslider.min.css" media="screen" />
	<link rel="stylesheet" type="text/css"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/css/custom.css">


    <!-- Included javascript files 
	================================================== -->
    
     <!--[if !IE]><!-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/ios6-timers.js"></script> 
    <!--<![endif]-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/custom.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery.vegas.min.js" ></script>   
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery.fancybox-1.3.4.min.js"></script>  
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery.isotope.min.js" ></script>  
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery.flexslider.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/jquery.slider.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/customized/js/main-fm.min.js"></script> 
    
   
    <script>

		
		
		/* Site Main plug-in initilize */
		
		$(document).ready(function(){
			
			jQuery(function($){
				$("body").mainFm({
				
				/* set page background src is used for large size image(desktop) src_small is used for small size image(mobile)*/
				pageBackground 	: [	{ src : 'images/background/background1.jpg', src_small : 'images/background/background1_s.jpg'} ],
					
				/* Set background overlay patter */							
					backgroundOverlay 	: 'images/background_overlay.png',
					
				/* set whether it's an one page or separate page file, if it's set false, the template works like a separate page version*/
					onePage : true,
					
				/* Set the opening page. 
					leave it blank value if you need to show the home page as a opening page*/
					homePage : "",
					
				/* Full screen gallery options for autoplay and slideshow delay time*/
					galleryAutoplay : "true",
					gallerySlideshowDelay : 1.5,
				/* Full screen gallery default image resize types. Options are fill/fit/none */
					galleryImageResize : "fill",
					
				/* FlexSlider slideshow speed */
					slideshowSpeed : 5000
					
				});
			});
			
			
			//.parallax(xPosition, speedFactor, outerHeight) options:
			//xPosition - Horizontal position of the element
			//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
			//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
			$('.parallax').each(function(){
				$(this).parallax("50%", 0.4, true);
			}); 
			
			
			
/* Home page Slider */			
			$(function(){
				$(".slider1").fmMainSlider({ 
					slideNumber : false, 		// Boolean: Create slide number
					playPause : true, 			// Boolean: Create play pause button
					nextPreviousButton : true, 	// Boolean: Create next button
					dotButtons : true, 			// Boolean: Create dot buttons
					autoplay : true, 			// Boolean: Enable auto play
					mouse_drag : true,			// Boolean: Mouse/Touch drag
					slideshowDelayTime : 2.5 	// Integer: slideshow delay time
				});
			});
	
						
// Email submit action			
			$("#email_submit").click(function() { 
									
				$('#reply_message').removeClass();
				$('#reply_message').html('')
				var regEx = "";	 
								
				// validate Name				
				var name = $("input#name").val();  
				regEx=/^[A-Za-z .'-]+$/; 
				if (name == "" || name == "Name"  || !regEx.test(name)) { 
					$("input#name").val(''); 
					$("input#name").focus();  
					return false;  
				}
				
				// validate Email						  
				var email = $("input#email").val();  
				regEx=/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;											
				if (email == "" || email == "Email" || !regEx.test(email)) { 
					$("input#email").val(''); 
					$("input#email").focus();  
					return false;  
				}  
				
				// validate comment			
				var comments = $("textarea#comments").val(); 
				if (comments == "" || comments == "Comments..." || comments.length < 2) { 
					$("textarea#comments").val(''); 
					$("textarea#comments").focus();  
					return false;  
				}  
									
				var dataString = 'name='+ $("input#name").val() + '&email=' + $("input#email").val() + '&comments=' + $("textarea#comments").val();									
				$('#reply_message').addClass('email_loading');
				
				// Send form data to mailer.php 
				$.ajax({
					type: "POST",
					url: "mailer.php",
					data: dataString,
					success: function() {
						$('#reply_message').removeClass('email_loading');
						$('#reply_message').addClass('list3');
						$('#reply_message').html("Mail sent sucessfully")
						.hide()
						.fadeIn(1500);
							}
						});
				return false;
				
			});	
		});
			
	</script>

    <script src="https://apis.google.com/js/plusone.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<?php echo $content; ?>
</body>
</html>
