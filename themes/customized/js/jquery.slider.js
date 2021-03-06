/**
	Afresh - Parallax Responsive Creative Portfolio
 	Copyright (c) 2012, Subramanian 

	Author: Subramanian
    Profile: themeforest.net/user/FMedia/
	
    Version: 1.0.0
	Release Date: 14 December 2012
	
**/



(function( $ ){	

	function fmMainSlider(selector, params){
		// default variables
		var defaults = $.extend({}, { 
			pageBgResize : true,
			slideshowDelayTime : 2.5,
			slideNumber : undefined,
			nextPreviousButton : true,
			playPause : false,
			autoplay : false,
			mouse_drag : false,
			dotButtons : false,
			numberOfthumbnails : undefined
		} , params);
		
		// Initialize required variables and objects
		var self = this;
		self.pageBgResize = defaults.pageBgResize;
		self.delaySec = defaults.slideshowDelayTime;
		self.plaPau = defaults.playPause;
		self.nexPreBtn  = defaults.nextPreviousButton;
		self.numThum =  defaults.numberOfthumbnails;
		self.spd = 0;
		self.ele = [];
		self.cur = 0;
		self.pre = 0;
		self.slideshow = defaults.autoplay;
		self.resetSlideshow = defaults.autoplay;
		self.pauseNow = false;
		self.finishPlay = false;
		self.IE_old = $.browser.msie;
		self.ssInt;
		self.ssChk;
		
		self.loadNew = true;
		
		self.botButton = true;
		
		self.aniType = 0;
		
		self.selEle = $(selector);

		if(selector.length == 0)
		return
		
		var allSlides = self.selEle.find(".fmSlides");
		
		if(self.IE_old){
			allSlides.css({"overflow-x":"hidden"});
		}
		
		/* Create a navigation */
		if(defaults.slideNumber || self.nexPreBtn || self.plaPau){
			self.selEle.parent().append('<div class="navigations"  ></div>');
			self.navCon = self.selEle.parent().children(":last-child");
		}
		
		/* Add slide number if required */
		self.numHolder
		if(defaults.slideNumber){
			self.navCon.prepend('<div class="fmslider_sliderNumber"> <span id="sliderNumber"></span>/ <span id="totalSlides" ></span> </div>');
			self.numHolder = self.navCon.children(":first-child");
			self.num = self.selEle.parent().find("#sliderNumber");
			self.numOfSlides = self.selEle.parent().find("#totalSlides");
			self.numHolder.hide();
		}

		
		/* Store all slides on Array */
		if(!isNaN(self.numThum)){
			var sl =  allSlides;
			var aa = 0;
			var ss = [];
			 
			sl.children().each(function(){
				ss.push($(this));
			});
			 
			var kz = [];
			ff = 0;
			  
			sl.append('<div class="columns alpha fmSlider_animate" ><div class="mobile_spacing"></div></div>');
			var ns = sl.children(":last-child").children(":first-child"); 
			 
			for(var jj=0; jj<ss.length; jj++){
				if(ff < self.numThum ){
					ff++;
					(ns).append(ss[jj]);
				 }else{
					ff = 1;
					sl.append('<div class="columns alpha fmSlider_animate" ><div class="mobile_spacing"></div></div>');
					ns = sl.children(":last-child").children(":first-child");
					(ns).append(ss[jj]);
				}
			 }
		 }

		
		self.allSlideHolder = self.selEle.find(".fmSlides");
		 
		self.allSlideHolder.children().each(function(){
				$(this).css({"opacity":0, "left": self.selEle.width()});
				self.ele.push($(this));
			}
		)
		
		if(self.numOfSlides){
			self.numOfSlides.text(self.ele.length);
		}
		
		
		self.ele[self.ele.length-1].css({"opacity":0, "left": -self.ele[self.ele.length-1].width()});
		self.cur = self.ele.length;
		
		self.firNavPos = false;
		
		/* Play Pause Button */
		if(self.plaPau){
			self.navCon.prepend('<div  class="fmSlider_plaPau" ><div  class="fmSlider_plaPau_inner"> <div class="fmSlider_plaPau_icon"> </div></div></div>');
			self.plaPau = self.navCon.children(":first-child");
			
			self.plaPau.each(function(){
				var selor = $(this);	
				selor.click(function(){
					if(!self.slideshow){
						self.plaPau.children(":first-child").children(":first-child").css({"right" : "-40px"});
						self.slideshow = true;
						self.Start();
						
					}else{
						self.plaPau.children(":first-child").children(":first-child").css({"right" : "0px"});
						self.slideshow = false;
						self.Pause();
					}
				});
			});
			
			if(!self.slideshow){
				self.plaPau.children(":first-child").children(":first-child").css({"right" : "0px"});
			}
			
			self.plaPau.hide();
		}

		
		/* Next Previous Button */
		if(self.nexPreBtn){
			$(".dynamicLoad").prepend(' <a class="next_btn" ></a>');
			self.nxB = $(".dynamicLoad").children(":first-child");
			$(".dynamicLoad").prepend('<a class="previous_btn" ></a> ');
			self.pxB = $(".dynamicLoad").children(":first-child");
			
			if(isTouch){
				self.nxB.removeClass("enableTransition"); 
				self.pxB.removeClass("enableTransition"); 
			}else{
				self.nxB.addClass("enableTransition"); 
				self.pxB.addClass("enableTransition"); 
			}
			
			self.nxB.click(function(){
				self.Next();
			});
			
			self.pxB.click(function(){
				self.Previous();
			});
			
			self.nxB.css({"visibility":"hidden"})
			self.pxB.css({"visibility":"hidden"})
			self.nxB.hide();
			self.pxB.hide();
		}
		
		
		/* Dotted buttons */
		self.navDots;
		self.dotClick = -1;
		self.dotsWidth = 0;
		if(defaults.dotButtons){
			self.navCon.prepend('<ul class="fmslider_dots"></ul>');
			self.navDots = self.navCon.children(":first-child");
			for(var jj=0; self.ele.length > jj; jj++){
				self.navDots.append('<li><a></a></li>');
				self.navDots.children(":last-child").data("num",jj)
				self.dotsWidth = self.dotsWidth + self.navDots.children(":last-child").find('a').width();
				self.navDots.children(":last-child").click(function() {
					self.dotClick = $(this).data("num");
					self.Next();
				});
			}
			self.navDots.children(":first-child").find("a").addClass("active");
			self.navDots.hide();
		}
		
		
		self.allSlideHolder.bind('mouseover mouseup mouseleave', function() {
			self.Pause();
		});
		
		self.allSlideHolder.bind('mouseout', function() {
			if(self.slideshow){
				self.slideshowDelay();
			}
		});
		
		self.fadeToAll = false;
		if(self.numThum != undefined){
			self.fadeToAll = self.selEle.hasClass('fadeEffect')

		}
		
		// slide Drag Coding
	
		var tm;
		var tmArr=[];
		var tmMovChk;
		var tmRevMov = false;
		var bgDrgPos = 0;
		var strDrg = false;
		self.drgPosDir = 0;
		
		var mainCon = self.selEle;
		self.moveItem = self.allSlideHolder;
		self.dragIt = false;
		
		/* Add Mouse cursor */
		if(defaults.mouse_drag ){
			if(!this.hasTouch) {
				self.moveItem.addClass("fm_drag-cursor");
				self.moveItem.bind('mousedown', function() {		
					tmRevMov = false;
					self.moveItem.removeClass("fm_drag-cursor");
					self.moveItem.addClass("fm_draging-cursor");
					mouseDragInit();
				});
			}
			
			// Start to drag using below functionv
			var dragStart = function(){
				if(tch != tch_){
					strDrg = true;
					thClick = false;
					self.dragIt = true;
				}
				self.moveItem.stop();
				tm = Math.round(Math.abs(Number(tch_)-Number(tch)))< 101? 
				Math.round(Math.abs(Number(tch_)-Number(tch))) : Math.round(100 + Math.abs(100-(Math.abs(Number(tch_)-Number(tch))))*.2);
				
				if(self.finishPlay){
					if((Number(tch_) > Number(tch))){
						self.moveItem.css({"left":Number(tm)+"px"});
					}else{
						self.moveItem.css({"left":-Number(tm)+"px"});
					}
				}
			};
			
			// Stop drag using below function, The next and previous slide will start here
			var dragStop = function(){
				 
				if(Number(tch) != Number(tch_) && self.finishPlay){
					if(Number(tch) > Number(tch_) ){
	
						if(((Number(tch) - Number(tch_)) > 50 || tmMovChk>5) && !tmRevMov){
							self.moveItem.stop();
							if (!$.browser.msie){
								self.moveItem.animate({"left":Number(-tm-(mainCon.width()*.36))+"px", "opacity":0},300, function(){ dragFinish(); } );
							}else{
								self.moveItem.animate({"left":Number(-tm-(mainCon.width()*.36))-self.moveItem.width()+"px"},300, function(){ dragFinish(); } );
							}
							self.drgPosDir = 1;
							
						}else{
							self.moveItem.stop();
							self.moveItem.animate({"left":"0px"});
						}
						
					}else{
						
						if(((Number(tch_)-Number(tch)) > 50 || tmMovChk>5) && !tmRevMov){
							self.moveItem.stop();
							if (!$.browser.msie){
								self.moveItem.animate({"left":Number(tm+(mainCon.width()*.36))+"px", "opacity":0},300, function(){ dragFinish(); } );
							}else{	
								self.moveItem.animate({"left":Number(tm+(mainCon.width()*.36))+self.moveItem.width()+"px"},300, function(){ dragFinish(); });
							}
							self.drgPosDir = -1;
						}else{
							self.moveItem.stop();
							self.moveItem.animate({"left":"0px"});
						}
					}
				}
				tm = 0;
			};
			
			// Mousedown event for drag
			
			var mouseDragInit = function(){	
	
				$(document).bind('mousedown.fmDragEvent', function(e) {
					tch = tch_ = Math.abs(e.clientX);
					tmArr = [];
					tmArr.push(tch);
					
					bgDrgPos = parseInt(self.moveItem.css("left"));
					
					$(document).bind('mousemove.fmDragEvent', function(e) {
						tmRevMov = tch_ > Math.abs(e.clientX) ? (Number(tch) > Number(tch_)) ? false:true : (Number(tch) < Number(tch_)) ? false : true;
						tch_ = Math.abs(e.clientX);
						tmArr.push(tch_);
						tmMovChk = Math.abs((tmArr[tmArr.length-1]-tmArr[tmArr.length-2]));
						dragStart();



						return false;
					});
					
					return false;
				});
				
				$(document).bind('mouseup.fmDragEvent', function() {
					strDrg = tch != tch_ ? false : true;
					$(document).unbind('mousedown.fmDragEvent');
					$(document).unbind('mouseleave.fmDragEvent');
					$(document).unbind('mousemove.fmDragEvent');
					$(document).unbind('mouseup.fmDragEvent');	
					
					self.moveItem.removeClass("fm_draging-cursor");
					self.moveItem.addClass("fm_drag-cursor");
	
					dragStop();
					return false;
				});
				
				
				$(document).bind('mouseleave.fmDragEvent', function() {
					strDrg = false;
					$(document).unbind('mousedown.fmDragEvent');
					$(document).unbind('mouseleave.fmDragEvent');
					$(document).unbind('mousemove.fmDragEvent');
					$(document).unbind('mouseup.fmDragEvent');	
					
					self.moveItem.removeClass("fm_draging-cursor");
					self.moveItem.addClass("fm_drag-cursor");
					
					return false;
				});
			};
	
			
			// Touch screen Enable
			
			var touEle = self.moveItem;
			var tch = 0;
			var tch_ = 0;
			var tchY = 0;
			var tchY_ = 0;
			
			self.touMoving = true;
			
			try {
				document.createEvent('TouchEvent');
				
				$(touEle).each(function() {
					this.ontouchstart = function(e) {
							self.touMoving = true;
							touchStart(e);
							return true;
						};
					this.ontouchend = function(e) {
						self.touMoving = true;
						touchEnd();
						return true;
					};	
					
					this.ontouchmove = function(e) {
						if(self.touMoving){
							touchMove(e);
						}
						if(!isMobile){
							//e.preventDefault();
							//e.stopPropagation();
							return true;
						}
					};
					
					this.find('.nonDraggable').bind("mousedown", function(e) {				
						e.stopImmediatePropagation();
					});	
				});
				
				
				
			} catch (e) {
				// Nothing to do
			}
					
						
			var touchStart = function(e) {
				tch = tch_ = Math.abs(e.clientX);
				tmArr = [];
				tmArr.push(tch);
				self.moveItem.stop();
				bgDrgPos = parseInt(self.moveItem.css("left"));
				tch = tch_ =  e.targetTouches[0].clientX;
				
				tchY = tchY_ = e.targetTouches[0].clientY;
			};
				 
			var touchEnd = function() {
				dragStop();
				if(Math.abs(tchY - tchY_) > 100){
					self.moveItem.stop();
					self.moveItem.css({"left":0+"px", "opacity":1});
				}
			};
	
			var touchMove = function(e) {
				tchY_ = e.targetTouches[0].clientY;
				if(Math.abs(tchY - tchY_) < 100){
					tmRevMov = tch_ > Math.abs(e.targetTouches[0].clientX) ? (Number(tch) > Number(tch_)) ? false:true : (Number(tch) < Number(tch_)) ? false : true;
					tch_ = Math.abs(e.targetTouches[0].clientX);
					tmArr.push(tch_);
					tmMovChk = Math.abs((tmArr[tmArr.length-1]-tmArr[tmArr.length-2]));
					dragStart();
				}else{
					self.moveItem.stop();
					self.moveItem.css({"left":0+"px", "opacity":1});
					self.touMoving = false;
					return false;
				}
			};
			
			var dragFinish = function(){
				if(Math.abs(tchY - tchY_) < 100){
					self.moveItem.stop();
					self.moveItem.css({"left":0+"px", "opacity":1});
					if(self.finishPlay){
						self.spd = 0;
						$(self.ele[self.cur]).css({"opacity":0, "left":$(self.selEle).width()} );
						if(self.drgPosDir<0){
							self.Previous();
						}else{
							self.Next();
						}
					}
				}else{
					self.moveItem.stop();
					self.moveItem.css({"left":0+"px", "opacity":1});
				}
			}
			
			// Drag coding end
		}
	}
	

	fmMainSlider.prototype = {
		
		/* start the slide animation */
		Start : function(){	
			var self = this;
			
				self.finishPlay = false;
				self.pauseNow = false;
				if(self.dotClick>-1){
					self.cur = self.dotClick;
				}else{
					self.cur = self.ele.length > self.cur+1? self.cur+1 : 0;
				}
				
				self.dotClick = -1;
				var dir;
				var aTyp = $(self.ele[self.pre]).hasClass('fadeEffect') || self.fadeToAll;
				
				self.aniType  = aTyp && !self.dragIt ? 0 : 1;
				
				if(self.navDots){
					self.navDots.find("a").removeClass("active");
					self.navDots.children().each(function(){
						if($(this).data("num") == self.cur){
							$(this).find("a").addClass("active");
						}
					})
				}
				
				
				if(self.aniType == 0){
					dir = 0;
				}else{
					dir = self.drgPosDir != 0? self.drgPosDir : 1;
				}
				
				$(".contentWarp").css({"height" : $(".contentWarp").height()});
				
				if(self.loadNew){
					self.loadNew = false;
					
					if(self.navDots){
						self.navDots.delay(1000).fadeIn();
					}
					
					if(self.nexPreBtn){
						self.nxB.css({"visibility":"visible"})
						self.pxB.css({"visibility":"visible"})
						self.nxB.delay(1000).fadeIn();
						self.pxB.delay(1000).fadeIn();
					}
					
					if(self.numHolder){
						self.numHolder.delay(1000).fadeIn();
					}
					
					if(self.plaPau){
						self.plaPau.delay(1000).fadeIn();
					}
				}

				var firT = true;
				var aSpd = aTyp ? 5 : 1;
				
				if($(self.ele[self.pre]).hasClass('fmSlider_animate') && !isMobileChk && !self.IE_old){
					var sel1 = $(self.ele[self.pre]).children(":first-child").children();
					var kk2 = self.drgPosDir == 0 && !isMobileChk ? 5*sel1.length : 0;
					var kk = dir>0 ? 0: sel1.length;
					
					var px = self.aniType == 0 ? 0 : 550;
					
					sel1.each(function(){
						$(this).stop();
						kk = firT ? 0 : dir > 0 ? kk+aSpd : kk-aSpd;
						firT = false;
						$(this).delay(20*kk).animate({"left":px*(-dir)},1000,"easeInOutQuart");
					})
				}
				
				$(self.ele[self.pre]).stop();
				
				
				
				var qx = self.aniType == 0 ? 0 : -$(self.ele[self.pre]).width();
				
				var aaSpd = self.dragIt ? 10 : self.spd;
				

				
				$(self.ele[self.pre]).animate({"opacity":0, "left":qx}, aaSpd ,"easeInOutQuart",function(){ 
				
				
					for(var ii=0; ii<self.ele.length; ii++){
						$(self.ele[ii]).css({"left": $(self.selEle).width(),"position": "absolute", "visibility":"hidden", "top":"-10000px"});
					}
					self.moveItem.stop();
					self.moveItem.css({"left":0+"px", "opacity":1});
					$(self.ele[self.cur]).css({"position": "relative", "visibility":"visible", "top":"0"});
					
					if($(self.selEle).hasClass("fullHeight") && !isMobileChk){
						$(self.ele[self.cur]).css({"margin-top":0+"px"})
						$(self.ele[self.cur]).css({"margin-bottom":0+"px"})
						var padd = ((($(window).height() )-($(".pageHolder").height()+ $(".header").outerHeight())))/2 ;
						$(self.ele[self.cur]).css({"margin-top":padd+"px"})
						$(self.ele[self.cur]).css({"margin-bottom":padd+"px"})
					}else{
						$(self.ele[self.cur]).css({"margin-top":0+"px"})
						$(self.ele[self.cur]).css({"margin-bottom":0+"px"})
					}


					if(self.pageBgResize){	$("body").mainFm('page_setup'); $("body").mainFm('pageBgRepos'); }
					
					self.spd = 0;
					self.pre = self.cur;
					
					aTyp = $(self.ele[self.cur]).hasClass('fadeEffect') || self.fadeToAll;
					self.aniType  = aTyp ? 0 : 1;
					
					if(self.aniType == 0){
						dir = 0;
					}else{
						dir = self.drgPosDir != 0? self.drgPosDir : 1;
					}
				
					if(self.drgPosDir<0){	
						$(self.ele[self.cur]).css({"left": -$(self.ele[self.cur]).width()}) 
					};
					
					if(self.num){
						$(self.num).text(self.cur+1);
					}
					
					
					if($(self.ele[self.cur]).hasClass('fmSlider_animate')){
						var sel2 = $(self.ele[self.cur]).children(":first-child").children();
						sel2.each(function(){
							$(this).stop();
							if(!isMobileChk &&  !self.IE_old){
								$(this).css({"left":(550*dir)+"px","opacity":"0"});
								self.spd  = 0;
							}else{
								$(this).css({"left":"0px","opacity":"1"});
							}
							
						})
					}

					self.drgPosDir = 0;
					self.allSlideHolder.stop();
					self.allSlideHolder.css({"opacity": 1, "left":0});
					$(self.ele[self.cur]).stop();
					
					if($(self.ele[self.cur]).hasClass('fmSlider_animate') && !isMobileChk  && !self.IE_old){
						sel2.each(function(){
							$(this).css({"visibility":"hidden"});
						})
					}
					
					
					self.posNav();

					
					self.firNavPos = true;

					aSpd = aTyp ? (sel2.length<5 ? 5 :1) : 1;
					
					firT = true;
					$(self.ele[self.cur]).css({"opacity": 1, "left":0});
					
				//	$(self.ele[self.cur]).animate({"opacity": 1, "left":0},10,"easeInOutQuart",function(){
						 
						 if(self.pageBgResize){	$("body").mainFm('page_setup'); $("body").mainFm('pageBgRepos'); }
						 
						if($(self.ele[self.cur]).hasClass('fmSlider_animate') && !isMobileChk  && !self.IE_old){
						
							var kk = dir>0 ? 0: sel2.length;
							sel2.each(function(){
								$(this).stop();
								kk = firT && aTyp ? 0 : (dir > 0 || aTyp ? kk+aSpd : kk-aSpd);
								firT = false;
								$(this).css({"visibility":"visible"})
									   .delay(50*(kk)).animate({"left":"0px","opacity":1, "visibility":"visible"},1000,"easeInOutQuart" );
							
							})
						}
						
						self.spd = 1000;
						self.finishPlay = true;
						self.dragIt = false;
						if(self.slideshow && !self.pauseNow){
							self.slideshowDelay();
						}
				//	});
					
						
				});
		},
		
		/* Slide show delay */
		slideshowDelay : function(){
			var self = this;
			clearInterval(self.ssChk);
			self.ssChk = setInterval(function(){
				if(self.finishPlay){
					clearInterval(self.ssChk);
					self.ssInt = setInterval(function(){
						clearInterval(self.ssInt);	
						self.Start();
					}, 1500*self.delaySec)
				}
			}, 50)
		},
		
		/* Previous slide action */
		Previous: function(){
			var self = this;
			if(self.finishPlay){
				clearInterval(self.ssChk);
				clearInterval(self.ssInt);
				self.cur = self.cur-2 < -1 ? self.ele.length-2 : self.cur-2;
				self.Start();
			}
		},
		
		/* Next slide action */
		Next: function(){
			var self = this;
			if(self.finishPlay){
				clearInterval(self.ssChk);
				clearInterval(self.ssInt);
				self.Start();
			}
		},
		
		/* Pause slide action */
		Pause : function(){
			var self = this;
			self.pauseNow  = true;
			clearInterval(self.ssChk);
			clearInterval(self.ssInt);
		},
		
		/* Stop slide action */
		Stop : function(){
			var self = this;
			clearInterval(self.ssChk);
			clearInterval(self.ssInt);
			self.cur = self.ele.length-1;
			self.pre = 0;
			self.spd = 0;
			self.finishPlay = false;
			self.slideshow = false;
			self.loadNew = true;
			if(self.navHold){ self.navHold.hide(); }
			for(var ii=0; ii<self.ele.length; ii++){
				$(self.ele[ii]).stop();
				$(self.ele[ii]).css({"opacity":0, "left": $(self.selEle).width(),"position": "absolute"});
			}
			$(self.ele[0]).css({"left": $(self.selEle).width(),"position": "relative"});
			if(self.num){
				$(self.num).text(1);
			}
		},
		
		/* Restart the slider */
		ReStart : function(){
			var self = this;
			self.Stop();
			self.slideshow = self.resetSlideshow;
			if(self.plaPau){
				if(self.resetSlideshow){
					self.plaPau.children(":first-child").children(":first-child").css({"right" : "-40px"});
				}else{
					self.plaPau.children(":first-child").children(":first-child").css({"right" : "0px"});
				}
			}
			clearInterval(self.ssChk);
			clearInterval(self.ssInt);
			self.Start();
		},
		
		/* Resume the slider if it pause */
		Resume: function(){
			var self = this;
			if(self.finishPlay && self.slideshow){
				clearInterval(self.ssChk);
				clearInterval(self.ssInt);
				self.slideshowDelay();
			}
		},
		
		pause_slideshow: function(){
			var self = this;
			if(self.plaPau){
				self.plaPau.children(":first-child").children(":first-child").css({"right" : "0px"});
				self.slideshow = false;
				self.Pause();
			}
		
		},
		
		/*postion navigation */
		
		posNav : function(){
			var self = this;
			
			$(self.ele[self.cur]).css({"margin-top":0+"px"})
			$(self.ele[self.cur]).css({"margin-bottom":0+"px"});
			
			$(".pageHolder").css({"height":"auto"});
			
			if($(self.selEle).hasClass("fullHeight") && !isMobileChk ){
						
				var padd = ((($(window).height() )-($(".pageHolder").outerHeight()+ $(".header").outerHeight())))/2 ;
				padd = padd > 0 ? padd : 50;
				$(self.ele[self.cur]).css({"margin-top":padd+2+"px"})
				$(self.ele[self.cur]).css({"margin-bottom":padd+"px"})
			}else{
				padd = 50;
			}		

			self.hPg = Number($(".pageHolder").height()- (parseInt($(".pageHolder").find(".page").css("margin-top")))) ;
			self.vPg = $(window).height()-(self.nxB.height()+$(".header").height());
			
			var wF = self.dotsWidth+20;
			var xF = !isMobileChk  ? 75 : 20;
			
			if(wF > $(".pageHolder").width()-100){
				wF = 0;
				if(!isMobileChk ){
					xF = 105;
				}else{
					xF = -10;
				}
			}
					
			if( !isMobileChk ){
				
				if(self.navDots){
					self.navDots.css({"top": self.hPg - 55 });
				}
					
				if(self.nxB){
					self.nxB.css({"top":  self.vPg/2});
					self.pxB.css({"top":  self.vPg/2})
				}
						
				if(self.plaPau){
					self.plaPau.css({"top": self.hPg-xF-9, "left":wF/2+20 });
				}
						
				if(self.numHolder){
					if(self.plaPau){
						self.numHolder.css({"top": self.hPg- xF-30, "right":wF/2+25 });
					}else{
						self.numHolder.css({"top": self.hPg- xF, "right":wF/2+25 });
					}
				}
					
			}else{
				
				if($(self.selEle).hasClass("fullHeight")){
					$(self.ele[self.cur]).css({"margin-top":25+"px", "margin-bottom":25+"px"})
				}
				
				if(self.navDots){
					self.navDots.css({"top": 55});
				}
				if(self.nxB){
					self.nxB.css({"top":  40});
					self.pxB.css({"top":  40})
				}
				
				if(self.plaPau){
					self.plaPau.css({"top": xF+5, "left":wF/2+20 });
				}

				if(self.numHolder){
					if(self.plaPau){
						self.numHolder.css({"top": (xF-25), "right":wF/2+25 });
					}else{
						self.numHolder.css({"top": (xF+15), "right":wF/2-10 });
					}
				}
					
			}
		}
			
	};
	

	/*  Initizlize and create the slider plug-in */
	$.fn.fmMainSlider = function(params) {
		var $fm = $(this);
		var instance = $fm.data('GBInstance');
		if (!instance) {
			if (typeof params === 'object' || !params){
				return $fm.data('GBInstance',  new fmMainSlider($fm, params));	
			}
		} else {
			if (instance[params]) {					
				return instance[params].apply(instance, Array.prototype.slice.call(arguments, 1));
			}
		}
	};
	
	
})( jQuery );
