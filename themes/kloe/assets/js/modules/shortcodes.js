(function($) {
    'use strict';

    var shortcodes = {};

    qodef.modules.shortcodes = shortcodes;

    shortcodes.qodefInitCounter = qodefInitCounter;
    shortcodes.qodefInitProgressBars = qodefInitProgressBars;
    shortcodes.qodefInitCountdown = qodefInitCountdown;
    shortcodes.qodefInitMessages = qodefInitMessages;
    shortcodes.qodefInitMessageHeight = qodefInitMessageHeight;
    shortcodes.qodefInitTestimonials = qodefInitTestimonials;
    shortcodes.qodefInitCarousels = qodefInitCarousels;
    shortcodes.qodefInitPieChart = qodefInitPieChart;
    shortcodes.qodefInitPieChartDoughnut = qodefInitPieChartDoughnut;
    shortcodes.qodefInitTabs = qodefInitTabs;
    shortcodes.qodefInitTabIcons = qodefInitTabIcons;
    shortcodes.qodefInitBlogListMasonry = qodefInitBlogListMasonry;
    shortcodes.qodefCustomFontResize = qodefCustomFontResize;
    shortcodes.qodefInitImageGallery = qodefInitImageGallery;
    shortcodes.qodefInitAccordions = qodefInitAccordions;
    shortcodes.qodefShowGoogleMap = qodefShowGoogleMap;
    shortcodes.qodefInitPortfolioListMasonry = qodefInitPortfolioListMasonry;
    shortcodes.qodefInitPortfolioListPinterest = qodefInitPortfolioListPinterest;
    shortcodes.qodefInitPortfolio = qodefInitPortfolio;
    shortcodes.qodefInitPortfolioMasonryFilter = qodefInitPortfolioMasonryFilter;
    shortcodes.qodefInitPortfolioSlider = qodefInitPortfolioSlider;
    shortcodes.qodefInitPortfolioLoadMore = qodefInitPortfolioLoadMore;
    shortcodes.qodefCheckSliderForHeaderStyle = qodefCheckSliderForHeaderStyle;
    shortcodes.qodefInitShopListMasonry = qodefInitShopListMasonry;
    shortcodes.qodefInitShopMasonryFilter = qodefInitShopMasonryFilter;
    shortcodes.qodefInitImageSlider = qodefInitImageSlider;
    shortcodes.qodefInitBlogSlider = qodefInitBlogSlider;
    shortcodes.qodefInitPortfolioAnimations = qodefInitPortfolioAnimations;

    shortcodes.qodefOnDocumentReady = qodefOnDocumentReady;
    shortcodes.qodefOnWindowLoad = qodefOnWindowLoad;
    shortcodes.qodefOnWindowResize = qodefOnWindowResize;
    shortcodes.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefUncoveringSlider().init();
        qodefInitPortfolioSlider();
        qodefInitCounter();
        qodefInitProgressBars();        
        qodefInitCountdown();
        qodefIcon().init();       
        qodefInitMessages();
        qodefInitMessageHeight();
        qodefInitTestimonials();
        qodefInitCarousels();
        qodefInitPieChart();
        qodefInitPieChartDoughnut();
        qodefInitTabs();
        qodefInitTabIcons();
        qodefButton().init();
        qodefInitBlogListMasonry();
        qodefCustomFontResize();
        qodefInitImageGallery();
        qodefInitAccordions();
        qodefShowGoogleMap();
        qodefInitPortfolioListMasonry();
        qodefInitPortfolioListPinterest();
        qodefInitPortfolio();
        qodefInitPortfolioMasonryFilter();
        qodefInitPortfolioLoadMore();
        qodefInitShopListMasonry();
        qodefInitShopMasonryFilter();
        qodefSlider().init();
        qodefSocialIconWidget().init();
        qodefPortfolioFullScreenSlider().init();
        qodefInitImageSlider();
        qodefIconListItem().init();
        qodefInitBlogSlider();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitPortfolioAnimations();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitBlogListMasonry();
        qodefCustomFontResize();
        qodefInitPortfolioListMasonry();
        qodefInitPortfolioListPinterest();
        qodefInitShopListMasonry();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        
    }

    

    /**
     * Counter Shortcode
     */
    function qodefInitCounter() {

        var counters = $('.qodef-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parent().addClass('qodef-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            });
        }

    }
    
    /*
    **	Horizontal progress bars shortcode
    */
    function qodefInitProgressBars(){
        
        var progressBar = $('.qodef-progress-bar');
        
        if(progressBar.length){
            
            progressBar.each(function() {
                
                var thisBar = $(this);
                
                thisBar.appear(function() {
                    qodefInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.qodef-floating.qodef-floating-inside') !== 0){
                        var floatingInsideMargin = thisBar.find('.qodef-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.qodef-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.qodef-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.qodef-floating-inside').css('margin-bottom',-(floatingInsideMargin)+'px');
                    }
                    var percentage = thisBar.find('.qodef-progress-content').data('percentage'),
                        progressContent = thisBar.find('.qodef-progress-content'),
                        progressNumber = thisBar.find('.qodef-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }

    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function qodefInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.qodef-progress-content').data('percentage'));
        var percent = progressBar.find('.qodef-progress-number .qodef-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.qodef-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }
    
    /*
    **	Function to close message shortcode
    */
    function qodefInitMessages(){
        var message = $('.qodef-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.qodef-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }
    
    /*
    **	Init message height
    */
    function qodefInitMessageHeight(){
       var message = $('.qodef-message.qodef-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.qodef-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.qodef-message-icon-holder').height();
               
               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.qodef-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.qodef-message-text-holder').height(iconHolderHeight);
               }
           });
       }
    }

    /**
     * Countdown Shortcode
     */
    function qodefInitCountdown() {

        var countdowns = $('.qodef-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var qodefIcon = qodef.modules.shortcodes.qodefIcon = function() {
        //get all icons on page
        var icons = $('.qodef-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('qodef-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.qodef-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var qodefSocialIconWidget = qodef.modules.shortcodes.qodefSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.qodef-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function qodefInitTestimonials(){

        var testimonial = $('.qodef-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

                var interval = 5000;
                var controlNav = true;
                var directionNav = false;
                var animationSpeed = 600;
                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

                //var iconClasses = getIconClassesForNavigation(directionNavArrowsTestimonials); TODO

                thisTestimonial.owlCarousel({
                    singleItem: true,
                    autoPlay: interval,
                    navigation: directionNav,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    mouseDrag: false,
                    pagination: controlNav,
                    slideSpeed: animationSpeed,
                    navigationText: [
                        '<span class="qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="arrow_carrot-right"></span></span>'
                    ]
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function qodefInitCarousels() {

        var carouselHolders = $('.qodef-carousel-holder'),
            carousel,
            numberOfItems,
            navigation;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                carousel = $(this).children('.qodef-carousel');
                numberOfItems = carousel.data('items');
                navigation = (carousel.data('navigation') == 'yes') ? true : false;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,3],
                    [1200,numberOfItems]
                ];

                carousel.owlCarousel({
                    autoPlay: 3000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: false,
                    navigation: navigation,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="arrow_carrot-right"></span></span>'
                    ]
                });

            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function qodefInitPieChart() {

        var pieCharts = $('.qodef-pie-chart-holder, .qodef-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.qodef-percentage, .qodef-percentage-with-icon'),
                    barColor,
                    trackColor,
                    lineWidth = 10,
                    size = 145;

                var activeColor = percentageHolder.data('active-color');
                if(typeof activeColor !== 'undefined') {
                    barColor = activeColor;
                }

                var inactiveColor = percentageHolder.data('inactive-color');
                if(typeof inactiveColor !== 'undefined') {
                    trackColor = inactiveColor;
                }

                var customSize = percentageHolder.data('size');
                if(typeof customSize !== 'undefined') {
                    size = customSize;
                }

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.qodef-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function qodefInitPieChartDoughnut() {

        var pieCharts = $('.qodef-pie-chart-doughnut-holder, .qodef-pie-chart-pie-holder');

        pieCharts.each(function(){

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for (var i = 1; i<=10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);
                
                if (typeof value !== 'undefined' && typeof color !== 'undefined' ) {
                    chartItem = {
                        value : value,
                        color : color
                    };
                    data.push(chartItem);
                }

            }

            if (canvas.hasClass('qodef-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor : 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor : 'transparent'}
                );
            }

        });

    }

    /*
    **	Init tabs shortcode
    */
    function qodefInitTabs(){

        var tabs = $('.qodef-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this);

                thisTabs.children('.qodef-tab-container').each(function(index){
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
                        navLink = navItem.attr('href');

                    link = '#'+link;

                    if(link.indexOf(navLink) > -1) {
                        navItem.attr('href',link);
                    }
                });

                if(thisTabs.hasClass('qodef-horizontal')){
                    thisTabs.tabs();
                }
                else if(thisTabs.hasClass('qodef-vertical')){
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.qodef-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /*
    **	Generate icons in tabs navigation
    */
    function qodefInitTabIcons(){

        var tabContent = $('.qodef-tab-container');
        if(tabContent.length){

            tabContent.each(function(){
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.qodef-tabs').find('.qodef-tabs-nav > li > a[href="#'+id+'"]');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.qodef-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var qodefButton = qodef.modules.shortcodes.qodefButton = function() {
        //all buttons on the page
        var buttons = $('.qodef-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };
    
    /*
    **	Init blog list masonry type
    */
    function qodefInitBlogListMasonry(){
        var blogList = $('.qodef-blog-list-holder.qodef-masonry .qodef-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});
                thisBlogList.isotope({
                    itemSelector: '.qodef-blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.qodef-blog-list-masonry-grid-sizer',
                        gutter: '.qodef-blog-list-masonry-grid-gutter'
                    }
                });
            });

        }
    }

	/*
	**	Custom Font resizing
	*/
	function qodefCustomFontResize(){
		var customFont = $('.qodef-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (qodef.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (qodef.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (qodef.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (qodef.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (qodef.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && qodef.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && qodef.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function qodefShowGoogleMap(){

        if($('.qodef-google-map').length){
            $('.qodef-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "qodef-map-"+ uniqueId;

                qodefInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function qodefInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'qodef-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Qode Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('qodef-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function qodefInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function qodefInitAccordions(){
        var accordion = $('.qodef-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.qodef-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function qodefInitImageGallery() {

        var galleries = $('.qodef-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.qodef-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                gallery.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle : animation, //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="arrow_carrot-right"></span></span>'
                    ]
                });
            });
        }

    }
    /**
     * Initializes portfolio list
     */
    function qodefInitPortfolio(){
        var portList = $('.qodef-portfolio-list-holder-outer.qodef-ptf-standard, .qodef-portfolio-list-holder-outer.qodef-ptf-gallery');
        if(portList.length){            
            portList.each(function(){
                var thisPortList = $(this);
                qodefInitPortMixItUp(thisPortList);
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function qodefInitPortMixItUp(container){
        var filterClass = '';
        if(container.hasClass('qodef-ptf-has-filter')){
            filterClass = container.find('.qodef-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }

        // appear init for ptf standard and ptf galleru
        var portfolioAppearAux = function() {
            if (holderInner.parent().hasClass('qodef-ptf-standard')) {
                holderInner.find('article').each(function(){
                    var article = $(this);
                    setTimeout(function(){
                        article.appear(function(){
                            article.addClass('qodef-appeared');
                        },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                    },100);
                });
            }

            if (holderInner.parent().hasClass('qodef-ptf-gallery')) {
                holderInner.each(function(){
                    var portfolioList = $(this);
                    setTimeout(function(){
                        portfolioList.appear(function(){
                            portfolioList.find('article').addClass('qodef-appeared');
                        },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                    },100);
                });
            }
        };
        
        var holderInner = container.find('.qodef-portfolio-list-holder'),
            loadMore = container.find('.qodef-ptf-list-paging');
        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixStart: function(){
                    holderInner.find('article').css('visibility','visible');
                    setTimeout(function(){
                        loadMore.addClass('qodef-appeared');
                        portfolioAppearAux();
                    },500)
                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');
                } 
            },           
            selectors: {
                filter: filterClass
            },
            animation: {
                effects: 'fade',
                duration: 600
            }
            
        });

        
        
    }
     /*
    **	Init portfolio list masonry type
    */
    function qodefInitPortfolioListMasonry(){
        var portList = $('.qodef-portfolio-list-holder-outer.qodef-ptf-masonry');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.qodef-portfolio-list-holder');
                var size = thisPortList.find('.qodef-portfolio-list-masonry-grid-sizer').width();
                var gutter = thisPortList.find('.qodef-portfolio-list-masonry-grid-gutter').width();
                qodefResizeMasonry(size,thisPortList);
                portList.waitForImages(function() {
                    qodefInitMasonry(thisPortList);
                });

                $(window).resize(function(){
                    qodefResizeMasonry(size,thisPortList);
                    qodefInitMasonry(thisPortList);
                });
            });
        }
    }
    
    function qodefInitMasonry(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.qodef-portfolio-item',
            masonry: {
                columnWidth: '.qodef-portfolio-list-masonry-grid-sizer',
                gutter: '.qodef-portfolio-list-masonry-grid-gutter'
            }
        });
    }
    
    function qodefResizeMasonry(size,container){
        
        var defaultMasonryItem = container.find('.qodef-default-masonry-item');
        var largeWidthMasonryItem = container.find('.qodef-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.qodef-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.qodef-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2*size));

        if(qodef.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeWidthMasonryItem.css('height', size);
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size/2));

        }
    }
    /**
     * Initializes portfolio pinterest 
     */
    function qodefInitPortfolioListPinterest(){
        
        var portList = $('.qodef-portfolio-list-holder-outer.qodef-ptf-pinterest');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.qodef-portfolio-list-holder');
                portList.waitForImages(function() {
                    qodefInitPinterest(thisPortList);
                });
                $(window).resize(function(){
                     qodefInitPinterest(thisPortList);
                });
            });
            
        }
    }
    
    function qodefInitPinterest(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.qodef-portfolio-item',
            masonry: {
                columnWidth: '.qodef-portfolio-list-masonry-grid-sizer'
            }
        });
        
    }
    /**
     * Initializes portfolio masonry filter
     */
    function qodefInitPortfolioMasonryFilter(){
        
        var filterHolder = $('.qodef-portfolio-filter-holder.qodef-masonry-filter');
        
        if(filterHolder.length){
            filterHolder.each(function(){
               
                var thisFilterHolder = $(this);
                
                var portfolioIsotopeAnimation = null;
                
                var filter = thisFilterHolder.find('ul li').data('class');
                
                thisFilterHolder.find('.filter:first').addClass('current');
                
                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); 
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.qodef-portfolio-list-holder-outer').find('.qodef-portfolio-list-holder').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });
                
            });
        }
    }
    /**
     * Initializes portfolio slider
     */
    
    function qodefInitPortfolioSlider(){

        var portSlider = $('.qodef-ptf-gallery.qodef-portfolio-slider-holder');
        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.qodef-portfolio-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var navigation = true;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                sliderWrapper.owlCarousel({
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: false,
                    navigation: navigation,
                    slideSpeed: 600,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    navigationText: [
                        '<span class="qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="arrow_carrot-right"></span></span>'
                    ]
                });
            });
        }
    }


    /**
     * Init Full Screen Slider
     */
    var qodefPortfolioFullScreenSlider = function() {

        var sliderHolder = $('.qodef-full-screen-slider-holder');
        var content = $('.qodef-wrapper .qodef-content');
        var headerTop = $('.qodef-top-bar');
        var sliders = $('.qodef-portfolio-full-screen-slider');


        var qodefFullScreenSliderHeight = function() {
            if (sliderHolder.length) {

                var contentMargin = parseInt(content.css('margin-top'));
                var headrTopHeight = 0;

                if (headerTop.length) {
                    headrTopHeight = headerTop.height();
                }

                if(qodef.windowWidth > 1024) {
                    if(contentMargin < 0) {
                        sliderHolder.css("height", qodef.windowHeight);
                    }
                    else {
                        sliderHolder.css("height", qodef.windowHeight - qodefGlobalVars.vars.qodefMenuAreaHeight);
                    }
                }
                else {
                    sliderHolder.css("height", qodef.windowHeight - qodefGlobalVars.vars.qodefMobileHeaderHeight - headrTopHeight);
                }
            }
        }

        var qodefFullScreenOwlSlider = function() {

            if (sliderHolder.length) {
                sliders.each(function () {
                    var slider = $(this);
                    slider.owlCarousel({
                        singleItem:true,
                        pagination: false,
                        navigation: true,
                        slideSpeed: 600,
                        transitionStyle : 'fade',
                        navigationText: [
                            '<span class="qodef-prev-icon"><span class="custom-nav-left"></span></span>',
                            '<span class="qodef-next-icon"><span class="custom-nav-right"></span></span>'
                        ]
                    });
                });
            }

        }

        var qodefFullScreenSliderInfo = function() {

            if (sliderHolder.length) {

                var sliderContent = $('.qodef-portfolio-slider-content');
                var close = $('.qodef-control.qodef-close');
                var description = $('.qodef-description');
                var info = $('.qodef-portfolio-slider-content-info');

                sliderContent.on('click',function(e){
                    if (!sliderContent.hasClass('opened')) {
                        e.preventDefault();
                        description.fadeOut(400, function() {
                            sliderContent.addClass('opened');
                            setTimeout(function(){
                                info.fadeIn(400);
                            }, 400);
                            setTimeout(function(){
                                $(".qodef-portfolio-slider-content-info").niceScroll({
                                    scrollspeed: 60,
                                    mousescrollstep: 40,
                                    cursorwidth: 0,
                                    cursorborder: 0,
                                    cursorborderradius: 0,
                                    cursorcolor: "transparent",
                                    autohidemode: false,
                                    horizrailenabled: false
                                });
                            }, 800);
                        });
                    }
                });

                close.on('click',function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    info.fadeOut( 400, function() {
                        sliderContent.removeClass('opened');
                        setTimeout(function() {
                            description.fadeIn(400);
                        }, 400);
                    });
                });

            }
        }
        return {
            init : function() {
                qodefFullScreenSliderHeight();
                qodefFullScreenOwlSlider();
                qodefFullScreenSliderInfo();

                $(window).resize(function(){
                    qodefFullScreenSliderHeight();
                });
            }
        };
    }


    /**
     * Init Uncovering Slider
     */
    var qodefUncoveringSlider = function() {

        var sliderHolder = $('.qodef-fixed-background');
        var sliderItem = $('.qodef-fixed-background-item');
        var sliderItemFirst = $('.qodef-fixed-background-item:first-child');
        var content = $('.qodef-wrapper .qodef-content');
        var headerTop = $('.qodef-top-bar');
        var firstSlideContent = $('.qodef-fixed-background-item:first-child .qodef-fixed-background-inner');

        var qodefUncoveringSliderHeight = function() {
            if (sliderHolder.length && (qodef.windowWidth > 768) ) {

                var contentMargin = parseInt(content.css('margin-top'));
                var headrTopHeight = 0;

                if (headerTop.length) {
                    headrTopHeight = headerTop.height();
                }

                if(qodef.windowWidth > 1024) {
                    if(contentMargin < 0) {
                        sliderItem.css("height", qodef.windowHeight);
                    }
                    else {
                        sliderItem.css("height", qodef.windowHeight);
                        sliderItemFirst.css("height", qodef.windowHeight - qodefGlobalVars.vars.qodefMenuAreaHeight);
                    }
                }
                else {
                    sliderHolder.css("margin-top", -(qodefGlobalVars.vars.qodefMobileHeaderHeight + headrTopHeight));
                    sliderItem.css("height", qodef.windowHeight);
                    firstSlideContent.css("padding-top", qodefGlobalVars.vars.qodefMobileHeaderHeight + headrTopHeight);
                }
            }
        }

        return {
            init : function() {
                qodefUncoveringSliderHeight();

                $(window).resize(function(){
                    qodefUncoveringSliderHeight();
                });
            }
        };
    }


    /**
     * Initializes portfolio load more function
     */
    function qodefInitPortfolioLoadMore(){
        var portList = $('.qodef-portfolio-list-holder-outer.qodef-ptf-load-more');
        if(portList.length){
            portList.each(function(){
                
                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.qodef-portfolio-list-holder');
                var nextPage; 
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.qodef-ptf-list-load-more a');      
                
                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {  
                    maxNumPages = thisPortList.data('max-num-pages');
                }
                
                loadMoreButton.on('click', function (e) {
                    var loadMoreDatta = qodefGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();
                    if(nextPage <= maxNumPages){
                        var ajaxData = qodefSetPortfolioAjaxData(loadMoreDatta);                        
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: qodeCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = qodefConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with 
                                thisPortList.waitForImages(function(){    
                                    setTimeout(function() {
                                        if(thisPortList.hasClass('qodef-ptf-masonry') || thisPortList.hasClass('qodef-ptf-pinterest') ){
                                            thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');
                                            qodefInitPortfolioListMasonry();
                                            responseHtml.addClass('qodef-appeared');
                                        } else {
                                            thisPortListInner.mixItUp('append',responseHtml);
                                        }
                                    },400);
                                });                           
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
                
            });
        }
    }
    
    function qodefConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    }

    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function qodefGetPortfolioAjaxData(container){
        var returnValue = {};
        
        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.imageSize = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {                    
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {                    
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {                    
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {                    
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {                    
            returnValue.number = container.data('number');
        }
        if (typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {                    
            returnValue.imageSize = container.data('image-size');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {                    
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {                    
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {                    
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {                    
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {                    
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {                    
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {                    
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function qodefSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'qode_core_portfolio_ajax_load_more',
            type: container.type,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            imageSize: container.imageSize,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage
        };
        return returnValue;
    }

    /**
     * Slider object that initializes whole slider functionality
     * @type {Function}
     */
    var qodefSlider = qodef.modules.shortcodes.qodefSlider = function() {

        //all sliders on the page
        var sliders = $('.qodef-slider .carousel');
        //image regex used to extract img source
        var imageRegex = /url\(["']?([^'")]+)['"]?\)/;
        //default responsive breakpoints set
        var responsiveBreakpointSet = [1600,1200,900,650,500,320];
        //var init for coefficiens array
        var coefficientsGraphicArray;
        var coefficientsTitleArray;
        var coefficientsSubtitleArray;
        var coefficientsTextArray;
        var coefficientsButtonArray;
        //var init for slider elements responsive coefficients
        var sliderGraphicCoefficient;
        var sliderTitleCoefficient;
        var sliderSubtitleCoefficient;
        var sliderTextCoefficient;
        var sliderButtonCoefficient;
        var sliderTitleCoefficientLetterSpacing;
        var sliderSubtitleCoefficientLetterSpacing;
        var sliderTextCoefficientLetterSpacing;

        /*** Functionality for translating image in slide - START ***/

        var matrixArray = { zoom_center : '1.2, 0, 0, 1.2, 0, 0', zoom_top_left: '1.2, 0, 0, 1.2, -150, -150', zoom_top_right : '1.2, 0, 0, 1.2, 150, -150', zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150', zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'};

        // regular expression for parsing out the matrix components from the matrix string
        var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

        // parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
        // returns an array with the matrix components
        var parseMatrix = function (val) {
            return val.match(matrixRE)[0].substr(1).
                split(",").map(function (s) {
                    return parseFloat(s);
                });
        };

        // transform css property names with vendor prefixes;
        // the plugin will check for values in the order the names are listed here and return as soon as there
        // is a value; so listing the W3 std name for the transform results in that being used if its available
        var transformPropNames = [
            "transform",
            "-webkit-transform"
        ];

        var getTransformMatrix = function (el) {
            // iterate through the css3 identifiers till we hit one that yields a value
            var matrix = null;
            transformPropNames.some(function (prop) {
                matrix = el.css(prop);
                return (matrix !== null && matrix !== "");
            });

            // if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
            matrix = (!matrix || matrix === "none") ?
                "matrix(1,0,0,1,0,0)" : matrix;
            return parseMatrix(matrix);
        };

        // set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
        // in "transformPropName" to ensure that the std compliant prop name shows up last
        var setTransformMatrix = function (el, matrix) {
            var m = "matrix(" + matrix.join(",") + ")";
            for (var i = transformPropNames.length - 1; i >= 0; --i) {
                el.css(transformPropNames[i], m + ' rotate(0.01deg)');
            }
        };

        // interpolates a value between a range given a percent
        var interpolate = function (from, to, percent) {
            return from + ((to - from) * (percent / 100));
        };

        $.fn.transformAnimate = function (opt) {
            // extend the options passed in by caller
            var options = {
                transform: "matrix(1,0,0,1,0,0)"
            };
            $.extend(options, opt);

            // initialize our custom property on the element to track animation progress
            this.css("percentAnim", 0);

            // supplant "options.step" if it exists with our own routine
            var sourceTransform = getTransformMatrix(this);
            var targetTransform = parseMatrix(options.transform);
            options.step = function (percentAnim, fx) {
                // compute the interpolated transform matrix for the current animation progress
                var $this = $(this);
                var matrix = sourceTransform.map(function (c, i) {
                    return interpolate(c, targetTransform[i],
                        percentAnim);
                });

                // apply the new matrix
                setTransformMatrix($this, matrix);

                // invoke caller's version of "step" if one was supplied;
                if (opt.step) {
                    opt.step.apply(this, [matrix, fx]);
                }
            };

            // animate!
            return this.stop().animate({ percentAnim: 100 }, options);
        };

        /*** Functionality for translating image in slide - END ***/


        /**
         * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
         * @param slider, current slider
         * @param defaultHeight, default height of slider, set in shortcode
         * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
         * @param reset, boolean for reseting heights
         */
        var setSliderHeight = function(slider, defaultHeight, responsive_breakpoint_set, reset) {
            var sliderHeight = defaultHeight;
            if(!reset) {
                if(qodef.windowWidth > responsive_breakpoint_set[0]) {
                    sliderHeight = defaultHeight;
                } else if(qodef.windowWidth > responsive_breakpoint_set[1]) {
                    sliderHeight = defaultHeight * 0.75;
                } else if(qodef.windowWidth > responsive_breakpoint_set[2]) {
                    sliderHeight = defaultHeight * 0.6;
                } else if(qodef.windowWidth > responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.55;
                } else if(qodef.windowWidth <= responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.45;
                }
            }

            slider.css({'height': (sliderHeight) + 'px'});
            slider.find('.qodef-slider-preloader').css({'height': (sliderHeight) + 'px'});
            slider.find('.qodef-slider-preloader .qodef-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (sliderHeight) + 'px'});
            if(qodefPerPageVars.vars.qodefStickyScrollAmount == 0) {
                qodef.modules.header.stickyAppearAmount = sliderHeight;
            }
        };

        /**
         * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
         * @param slider, current slider
         */
        var setSliderFullHeight = function(slider) {
            var mobileHeaderHeight = qodef.windowWidth < 1000 ? qodefGlobalVars.vars.qodefMobileHeaderHeight + $('.qodef-top-bar').height() : 0;
            slider.css({'height': (qodef.windowHeight - mobileHeaderHeight) + 'px'});
            slider.find('.qodef-slider-preloader').css({'height': (qodef.windowHeight) + 'px'});
            slider.find('.qode-slider-preloader .qodef-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (qodef.windowHeight) + 'px'});
            if(qodefPerPageVars.vars.qodefStickyScrollAmount == 0) {
                qodef.modules.header.stickyAppearAmount = qodef.windowHeight;
            }
        };

        /**
         * Set initial sizes for slider elements and put them in global variables
         * @param slideItem, each slide
         * @param index, index od slide item
         */
        var setSizeGlobalVariablesForSlideElements = function(slideItem, index) {
            window["slider_graphic_width_" + index] = [];
            window["slider_graphic_height_" + index] = [];
            window["slider_title_" + index] = [];
            window["slider_subtitle_" + index] = [];
            window["slider_text_" + index] = [];
            window["slider_button1_" + index] = [];
            window["slider_button2_" + index] = [];

            //graphic size
            window["slider_graphic_width_" + index].push(parseFloat(slideItem.find('.qodef-thumb img').data("width")));
            window["slider_graphic_height_" + index].push(parseFloat(slideItem.find('.qodef-thumb img').data("height")));

            // font-size (0)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.qodef-slide-title').css("font-size")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.qodef-slide-subtitle').css("font-size")));
            window["slider_text_" + index].push(parseFloat(slideItem.find('.qodef-slide-text').css("font-size")));
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(0)').css("font-size")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(1)').css("font-size")));

            // line-height (1)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.qodef-slide-title').css("line-height")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.qodef-slide-subtitle').css("line-height")));
            window["slider_text_" + index].push(parseFloat(slideItem.find('.qodef-slide-text').css("line-height")));
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(0)').css("line-height")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(1)').css("line-height")));

            // letter-spacing (2)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.qodef-slide-title').css("letter-spacing")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.qodef-slide-subtitle').css("letter-spacing")));
            window["slider_text_" + index].push(parseFloat(slideItem.find('.qodef-slide-text').css("letter-spacing")));
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(0)').css("letter-spacing")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(1)').css("letter-spacing")));

            // margin-bottom (3)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.qodef-slide-title').css("margin-bottom")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.qodef-slide-subtitle').css("margin-bottom")));


            // slider_button padding top/bottom(3), padding left/right(4)
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(0)').css("padding-top")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(1)').css("padding-top")));

            window["slider_button1_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(0)').css("padding-left")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.qodef-btn:eq(1)').css("padding-left")));
        };

        /**
         * Set responsive coefficients for slider elements
         * @param responsiveBreakpointSet, responsive breakpoints
         * @param coefficientsGraphicArray, responsive coeaficcients for graphic
         * @param coefficientsTitleArray, responsive coeaficcients for title
         * @param coefficientsSubtitleArray, responsive coeaficcients for subtitle
         * @param coefficientsTextArray, responsive coeaficcients for text
         * @param coefficientsButtonArray, responsive coeaficcients for button
         */
        var setSliderElementsResponsiveCoeffeicients = function(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray) {

            function coefficientsSetter(graphicArray,titleArray,subtitleArray,textArray,buttonArray){
                sliderGraphicCoefficient = graphicArray;
                sliderTitleCoefficient = titleArray;
                sliderSubtitleCoefficient = subtitleArray;
                sliderTextCoefficient = textArray;
                sliderButtonCoefficient = buttonArray;
            }

            if(qodef.windowWidth > responsiveBreakpointSet[0]) {
                coefficientsSetter(coefficientsGraphicArray[0],coefficientsTitleArray[0],coefficientsSubtitleArray[0],coefficientsTextArray[0],coefficientsButtonArray[0]);
            }else if(qodef.windowWidth > responsiveBreakpointSet[1]){
                coefficientsSetter(coefficientsGraphicArray[1],coefficientsTitleArray[1],coefficientsSubtitleArray[1],coefficientsTextArray[1],coefficientsButtonArray[1]);
            }else if(qodef.windowWidth > responsiveBreakpointSet[2]){
                coefficientsSetter(coefficientsGraphicArray[2],coefficientsTitleArray[2],coefficientsSubtitleArray[2],coefficientsTextArray[2],coefficientsButtonArray[2]);
            }else if(qodef.windowWidth > responsiveBreakpointSet[3]){
                coefficientsSetter(coefficientsGraphicArray[3],coefficientsTitleArray[3],coefficientsSubtitleArray[3],coefficientsTextArray[3],coefficientsButtonArray[3]);
            }else if (qodef.windowWidth > responsiveBreakpointSet[4]) {
                coefficientsSetter(coefficientsGraphicArray[4],coefficientsTitleArray[4],coefficientsSubtitleArray[4],coefficientsTextArray[4],coefficientsButtonArray[4]);
            }else if (qodef.windowWidth > responsiveBreakpointSet[5]){
                coefficientsSetter(coefficientsGraphicArray[5],coefficientsTitleArray[5],coefficientsSubtitleArray[5],coefficientsTextArray[5],coefficientsButtonArray[5]);
            }else{
                coefficientsSetter(coefficientsGraphicArray[6],coefficientsTitleArray[6],coefficientsSubtitleArray[6],coefficientsTextArray[6],coefficientsButtonArray[6]);
            }

            // letter-spacing decrease quicker
            sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient;
            sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient;
            sliderTextCoefficientLetterSpacing = sliderTextCoefficient;
            if(qodef.windowWidth <= responsiveBreakpointSet[0]) {
                sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient/2;
                sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient/2;
                sliderTextCoefficientLetterSpacing = sliderTextCoefficient/2;
            }
        };

        /**
         * Set sizes for slider elements
         * @param slideItem, each slide
         * @param index, index od slide item
         * @param reset, boolean for reseting sizes
         */
        var setSliderElementsSize = function(slideItem, index, reset) {

            if(reset) {
                sliderGraphicCoefficient = sliderTitleCoefficient = sliderSubtitleCoefficient = sliderTextCoefficient = sliderButtonCoefficient = sliderTitleCoefficientLetterSpacing = sliderSubtitleCoefficientLetterSpacing = sliderTextCoefficientLetterSpacing = 1;
            }

            slideItem.find('.qodef-thumb').css({
                "width": Math.round(window["slider_graphic_width_" + index][0]*sliderGraphicCoefficient) + 'px',
                "height": Math.round(window["slider_graphic_height_" + index][0]*sliderGraphicCoefficient) + 'px'
            });

            slideItem.find('.qodef-slide-title').css({
                "font-size": Math.round(window["slider_title_" + index][0]*sliderTitleCoefficient) + 'px',
                "line-height": Math.round(window["slider_title_" + index][1]*sliderTitleCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_title_" + index][2]*sliderTitleCoefficient) + 'px',
                "margin-bottom": Math.round(window["slider_title_" + index][3]*sliderTitleCoefficient) + 'px'
            });

            slideItem.find('.qodef-slide-subtitle').css({
                "font-size": Math.round(window["slider_subtitle_" + index][0]*sliderSubtitleCoefficient) + 'px',
                "line-height": Math.round(window["slider_subtitle_" + index][1]*sliderSubtitleCoefficient) + 'px',
                "margin-bottom": Math.round(window["slider_subtitle_" + index][3]*sliderSubtitleCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_subtitle_" + index][2]*sliderSubtitleCoefficientLetterSpacing) + 'px'
            });

            slideItem.find('.qodef-slide-text').css({
                "font-size": Math.round(window["slider_text_" + index][0]*sliderTextCoefficient) + 'px',
                "line-height": Math.round(window["slider_text_" + index][1]*sliderTextCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_text_" + index][2]*sliderTextCoefficientLetterSpacing) + 'px'
            });

            slideItem.find('.qodef-btn:eq(0)').css({
                "font-size": Math.round(window["slider_button1_" + index][0]*sliderButtonCoefficient) + 'px',
                "line-height": Math.round(window["slider_button1_" + index][1]*sliderButtonCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_button1_" + index][2]*sliderButtonCoefficient) + 'px',
                "padding-top": Math.round(window["slider_button1_" + index][3]*sliderButtonCoefficient) + 'px',
                "padding-bottom": Math.round(window["slider_button1_" + index][3]*sliderButtonCoefficient) + 'px',
                "padding-left": Math.round(window["slider_button1_" + index][4]*sliderButtonCoefficient) + 'px',
                "padding-right": Math.round(window["slider_button1_" + index][4]*sliderButtonCoefficient) + 'px'
            });
            slideItem.find('.qodef-btn:eq(1)').css({
                "font-size": Math.round(window["slider_button2_" + index][0]*sliderButtonCoefficient) + 'px',
                "line-height": Math.round(window["slider_button2_" + index][1]*sliderButtonCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_button2_" + index][2]*sliderButtonCoefficient) + 'px',
                "padding-top": Math.round(window["slider_button2_" + index][3]*sliderButtonCoefficient) + 'px',
                "padding-bottom": Math.round(window["slider_button2_" + index][3]*sliderButtonCoefficient) + 'px',
                "padding-left": Math.round(window["slider_button2_" + index][4]*sliderButtonCoefficient) + 'px',
                "padding-right": Math.round(window["slider_button2_" + index][4]*sliderButtonCoefficient) + 'px'
            });
        };

        /**
         * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
         * @param slider, current slider
         */
        var setHeights =  function(slider) {

            slider.find('.item').each(function (i) {
                setSizeGlobalVariablesForSlideElements($(this),i);
                setSliderElementsSize($(this), i, false);
            });

            if(slider.hasClass('qodef-full-screen')){

                setSliderFullHeight(slider);

                $(window).resize(function() {
                    setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);
                    setSliderFullHeight(slider);
                    slider.find('.item').each(function(i){
                        setSliderElementsSize($(this), i, false);
                    });
                });

            }else if(slider.hasClass('qodef-responsive-height')){

                var defaultHeight = slider.data('height');
                setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

                $(window).resize(function() {
                    setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);
                    setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                    slider.find('.item').each(function(i){
                        setSliderElementsSize($(this), i, false);
                    });
                });

            }else {
                var defaultHeight = slider.data('height');

                slider.find('.qodef-slider-preloader').css({'height': (slider.height()) + 'px'});
                slider.find('.qodef-slider-preloader .qodef-ajax-loader').css({'display': 'block'});

                qodef.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

                $(window).resize(function() {
                    setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);
                    if(qodef.windowWidth < 1000){
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                        slider.find('.item').each(function(i){
                            setSliderElementsSize($(this),i,false);
                        });
                    }else{
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
                        slider.find('.item').each(function(i){
                            setSliderElementsSize($(this),i,true);
                        });
                    }
                });
            }
        };

        /**
         * Set prev/next numbers on navigation arrows
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         */
        var setPrevNextNumbers = function(slider, currentItem, totalItemCount) {
            if(currentItem == 1){
                slider.find('.left.carousel-control .prev').html(totalItemCount);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }else if(currentItem == totalItemCount){
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(1);
            }else{
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }
        };

        /**
         * Set video background size
         * @param slider, current slider
         */
        var initVideoBackgroundSize = function(slider){
            var min_w = 1500; // minimum video width allowed
            var video_width_original = 1920;  // original video dimensions
            var video_height_original = 1080;
            var vid_ratio = 1920/1080;

            slider.find('.item .qodef-video .qodef-video-wrap').each(function(){

                var slideWidth = qodef.windowWidth;
                var slideHeight = $(this).closest('.carousel').height();

                $(this).width(slideWidth);

                min_w = vid_ratio * (slideHeight+20);
                $(this).height(slideHeight);

                var scale_h = slideWidth / video_width_original;
                var scale_v = (slideHeight - qodefGlobalVars.vars.qodefMenuAreaHeight) / video_height_original;
                var scale =  scale_v;
                if (scale_h > scale_v)
                    scale =  scale_h;
                if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

                $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
                $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
                $(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
                $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
                $(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
            });
        };

        /**
         * Init video background
         * @param slider, current slider
         */
        var initVideoBackground = function(slider) {
            $('.item .qodef-video-wrap .video').mediaelementplayer({
                enableKeyboard: false,
                iPadUseNativeControls: false,
                pauseOtherPlayers: false,
                // force iPhone's native controls
                iPhoneUseNativeControls: false,
                // force Android's native controls
                AndroidUseNativeControls: false
            });

            $(window).resize(function() {
                initVideoBackgroundSize(slider);
            });

            //mobile check
            if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
                $('.qodef-slider .qodef-mobile-video-image').show();
                $('.qodef-slider .qodef-video-wrap').remove();
            }
        };

        /**
         * initiate slider
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         * @param slideAnimationTimeout, timeout for slide change
         */
        var initiateSlider = function(slider, totalItemCount, slideAnimationTimeout) {

            //set active class on first item
            slider.find('.carousel-inner .item:first-child').addClass('active');
            //check for header style
            qodefCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('qodef-header-effect'));
            // setting numbers on carousel controls
            if(slider.hasClass('qodef-slider-numbers')) {
                setPrevNextNumbers(slider, 1, totalItemCount);
            }
            // set video background if there is video slide
            if(slider.find('.item video').length){
                initVideoBackgroundSize(slider);
                initVideoBackground(slider);
            }

            //init slider
            if(slider.hasClass('qodef-auto-start')){
                slider.carousel({
                    interval: slideAnimationTimeout,
                    pause: false
                });

                //pause slider when hover slider button
                slider.find('.slide_buttons_holder .qbutton')
                    .mouseenter(function() {
                        slider.carousel('pause');
                    })
                    .mouseleave(function() {
                        slider.carousel('cycle');
                    });
            } else {
                slider.carousel({
                    interval: 0,
                    pause: false
                });
            }


            //initiate image animation
            if($('.carousel-inner .item:first-child').hasClass('qodef-animate-image') && qodef.windowWidth > 1000){
                slider.find('.carousel-inner .item.qodef-animate-image:first-child .qodef-image').transformAnimate({
                    transform: "matrix("+matrixArray[$('.carousel-inner .item:first-child').data('qodef_animate_image')]+")",
                    duration: 30000
                });
            }
        };

        return {
            init: function() {
                if(sliders.length) {
                    sliders.each(function() {
                        var $this = $(this);
                        var slideAnimationTimeout = $this.data('slide_animation_timeout');
                        var totalItemCount = $this.find('.item').length;
                        if($this.data('qodef_responsive_breakpoints')){
                            if($this.data('qodef_responsive_breakpoints') == 'set2'){
                                responsiveBreakpointSet = [1600,1300,1000,768,567,320];
                            }
                        }
                        coefficientsGraphicArray = $this.data('qodef_responsive_graphic_coefficients').split(',');
                        coefficientsTitleArray = $this.data('qodef_responsive_title_coefficients').split(',');
                        coefficientsSubtitleArray = $this.data('qodef_responsive_subtitle_coefficients').split(',');
                        coefficientsTextArray = $this.data('qodef_responsive_text_coefficients').split(',');
                        coefficientsButtonArray = $this.data('qodef_responsive_button_coefficients').split(',');

                        setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);

                        setHeights($this);

                        /*** wait until first video or image is loaded and than initiate slider - start ***/
                        if(qodef.htmlEl.hasClass('touch')){
                            if($this.find('.item:first-child .qodef-mobile-video-image').length > 0){
                                var src = imageRegex.exec($this.find('.item:first-child .qodef-mobile-video-image').attr('style'));
                            }else{
                                var src = imageRegex.exec($this.find('.item:first-child .qodef-image').attr('style'));
                            }
                            if(src) {
                                var backImg = new Image();
                                backImg.src = src[1];
                                $(backImg).load(function(){
                                    $('.qodef-slider-preloader').fadeOut(500);
                                    initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                });
                            }
                        } else {
                            if($this.find('.item:first-child video').length > 0){
                                $('.qodef-slider-preloader').fadeOut(500);
                                initiateSlider($this,totalItemCount,slideAnimationTimeout);
                            }else{
                                var src = imageRegex.exec($this.find('.item:first-child .qodef-image').attr('style'));
                                if (src) {
                                    var backImg = new Image();
                                    backImg.src = src[1];
                                    $(backImg).load(function(){
                                        $('.qodef-slider-preloader').fadeOut(500);
                                        initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                    });
                                }
                            }
                        }
                        /*** wait until first video or image is loaded and than initiate slider - end ***/

                        /* before slide transition - start */
                        $this.on('slide.bs.carousel', function () {
                            $this.addClass('qodef-in-progress');
                            $this.find('.active .qodef-slider-content-outer').fadeTo(250,0);
                        });
                        /* before slide transition - end */

                        /* after slide transition - start */
                        $this.on('slid.bs.carousel', function () {
                            $this.removeClass('qodef-in-progress');
                            $this.find('.active .qodef-slider-content-outer').fadeTo(0,1);

                            // setting numbers on carousel controls
                            if($this.hasClass('qodef-slider-numbers')) {
                                var currentItem = $('.item').index($('.item.active')[0]) + 1;
                                setPrevNextNumbers($this, currentItem, totalItemCount);
                            }

                            // initiate image animation on active slide and reset all others
                            $('.item.qodef-animate-image .qodef-image').stop().css({'transform':'', '-webkit-transform':''});
                            if($('.item.active').hasClass('qodef-animate-image') && qodef.windowWidth > 1000){
                                $('.item.qodef-animate-image.active .qodef-image').transformAnimate({
                                    transform: "matrix("+matrixArray[$('.item.qodef-animate-image.active').data('qodef_animate_image')]+")",
                                    duration: 30000
                                });
                            }
                        });
                        /* after slide transition - end */

                        /* swipe functionality - start */
                        $this.swipe( {
                            swipeLeft: function(){ $this.carousel('next'); },
                            swipeRight: function(){ $this.carousel('prev'); },
                            threshold:20
                        });
                        /* swipe functionality - end */

                    });

                    //adding parallax functionality on slider
                    if($('.no-touch .carousel').length){
                        var skrollr_slider = skrollr.init({
                            smoothScrolling: false,
                            forceHeight: false
                        });
                        skrollr_slider.refresh();
                    }

                    $(window).scroll(function(){
                        //set control class for slider in order to change header style
                        if($('.qodef-slider .carousel').height() < qodef.scroll){
                            $('.qodef-slider .carousel').addClass('qodef-disable-slider-header-style-changing');
                        }else{
                            $('.qodef-slider .carousel').removeClass('qodef-disable-slider-header-style-changing');
                            qodefCheckSliderForHeaderStyle($('.qodef-slider .carousel .active'),$('.qodef-slider .carousel').hasClass('qodef-header-effect'));
                        }

                        //hide slider when it is out of viewport
                        if($('.qodef-slider .carousel').hasClass('qodef-full-screen') && qodef.scroll > qodef.windowHeight && qodef.windowWidth > 1000){
                            $('.qodef-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                        }else if(!$('.qodef-slider .carousel').hasClass('qodef-full-screen') && qodef.scroll > $('.qodef-slider .carousel').height() && qodef.windowWidth > 1000){
                            $('.qodef-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                        }else{
                            $('.qodef-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
                        }
                    });
                }
            }
        };
    };

    /**
     * Check if slide effect on header style changing
     * @param slide, current slide
     * @param headerEffect, flag if slide
     */

    function qodefCheckSliderForHeaderStyle(slide, headerEffect) {

        if($('.qodef-slider .carousel').not('.qodef-disable-slider-header-style-changing').length > 0) {

            var slideHeaderStyle = "";
            if (slide.hasClass('light')) { slideHeaderStyle = 'qodef-light-header'; }
            if (slide.hasClass('dark')) { slideHeaderStyle = 'qodef-dark-header'; }

            if (slideHeaderStyle !== "") {
                if (headerEffect) {
                    qodef.body.removeClass('qodef-dark-header qodef-light-header').addClass(slideHeaderStyle);
                }
            } else {
                if (headerEffect) {
                    qodef.body.removeClass('qodef-dark-header qodef-light-header').addClass(qodef.defaultHeaderStyle);
                }

            }
        }
    }

    /*
     **  Init shop list masonry type
     */
    function qodefInitShopListMasonry(){
        var shopList = $('.qodef-shop-masonry');
        if(shopList.length) {
            shopList.each(function() {
                var thisShopList = $(this).children('.qodef-shop-list-masonry');
                var size = thisShopList.find('.qodef-shop-list-masonry-grid-sizer').width();
                qodefResizeShopMasonry(size,thisShopList);

                qodefInitMasonryLayout(thisShopList);
                $(window).resize(function(){
                    size = thisShopList.find('.qodef-shop-list-masonry-grid-sizer').width();
                    qodefResizeShopMasonry(size,thisShopList);
                    qodefInitMasonryLayout(thisShopList);
                });
            });
        }
    }

    function qodefInitMasonryLayout(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.qodef-shop-product',
            masonry: {
                columnWidth: '.qodef-shop-list-masonry-grid-sizer'
            }
        });
    }

    function qodefResizeShopMasonry(size,container){

        var defaultMasonryItem = container.find('.qodef-default-masonry-item');
        var largeWidthMasonryItem = container.find('.qodef-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.qodef-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.qodef-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2*size));

        var breakpoint = qodef.body.hasClass('page-template-full-width') ? 480 : 600;

        if(qodef.windowWidth > breakpoint){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeWidthMasonryItem.css('height', size);
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size/2));

        }
    }

    /**
     * Initializes shop masonry filter
     */
    function qodefInitShopMasonryFilter(){

        var filterHolder = $('.qodef-shop-filter-holder.qodef-masonry-filter');

        if(filterHolder.length){
            filterHolder.each(function(){

                var thisFilterHolder = $(this);

                var shopIsotopeAnimation = null;

                thisFilterHolder.find('.filter:first').addClass('current');

                thisFilterHolder.find('li').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(shopIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    shopIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s');
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.parent().find('.qodef-shop-list-masonry').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });

            });
        }
    }

    /**
     * Initializes image slider shortcode
     * If window width is 768 or wider, lemon slider is called, otherwise, owl slider
     * in order to keep slider effect.
     */

    function qodefInitImageSlider() {

        var galleries = $('.qodef-image-slider');

        if(galleries.length && qodef.windowWidth > 768){
            galleries.each(function(){
                $(this).animate({'opacity': 1},1000);
                $(this).find('.qodef-image-slider-inner').lemmonSlider({infinite: true});
                $(this).swipe({
                    swipeLeft: function (event, direction, distance, duration, fingerCount) {
                        $('.controls .next-slide').click();
                    },
                    swipeRight: function (event, direction, distance, duration, fingerCount) {
                        $('.controls .prev-slide').click();
                    },
                    threshold: 0
                });
            });
        }
        else if(galleries.length) {
            //Responsive breakpoints
            var items = [
                [0,1],
                [480,1],
                [600,2]
            ];
            galleries.each(function() {
                $(this).animate({'opacity': 1}, 1000);
                $(this).find('.qodef-image-slider-inner ul').owlCarousel({
                    items: 2,
                    itemsCustom: items,
                    autoPlay: false,
                    navigation: true,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: false,
                    navigationText: [
                        '<span class="qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="arrow_carrot-right"></span></span>'
                    ]
                });
            });
        }
    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon list item's functionality
     */
    var qodefIconListItem = qodef.modules.shortcodes.qodefIconListItem = function() {
        //get all icons on page
        var iconListItem = $('.qodef-icon-list-item');

       /**
         * Function that triggers icon hover color functionality
         */
        var textHoverColor = function(iconListItem) {

           var text = iconListItem.find('.qodef-icon-list-text');
           var hoverColor = text.data('hover-color');
           var originalColor = text.css('color');

            if(typeof text.data('hover-color') !== 'undefined') {
                var changeTextColor = function(event) {
                    event.data.text.css('color', event.data.color);
                };

                if(hoverColor !== '') {
                    text.on('mouseenter', {text: text, color: hoverColor}, changeTextColor);
                    text.on('mouseleave', {text: text, color: originalColor}, changeTextColor);
                }
            }
        };

        return {
            init: function() {
                if(iconListItem.length) {
                    iconListItem.each(function() {
                        textHoverColor($(this));
                    });
                }
            }
        }
    }

    /**
     * Initializes blog slider shortcode
     */

    function qodefInitBlogSlider() {
        var blogSlider = $('.qodef-blog-slider-holder');
        if(blogSlider.length){
            blogSlider.each(function(){
                var thisBlogSlider = $(this);
                var sliderWrapper = thisBlogSlider.children('.qodef-blog-slider-items');
                var numberOfItems = thisBlogSlider.data('number-of-items');

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,1],
                    [768,2],
                    [1024,2],
                    [1360,numberOfItems]
                ];

                sliderWrapper.owlCarousel({
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: false,
                    navigation: false,
                    slideSpeed: 600,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    navigationText: [
                        '<span class="qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="arrow_carrot-right"></span></span>'
                    ]
                });
            });
        }
    }

    /*
    *  Animate portfolio articles on appear
    */

    function qodefInitPortfolioAnimations() {

        var portfolioList = $('.qodef-portfolio-list-holder-outer:not(.qodef-portfolio-slider-holder)');
        if(portfolioList.length){
            portfolioList.each(function(){

                //masonry and pinterest load
                if(portfolioList.hasClass('qodef-ptf-masonry') || portfolioList.hasClass('qodef-ptf-pinterest')) {
                    var thisPortfolioList = $(this),
                        article = thisPortfolioList.find('article'),
                        loadMore = thisPortfolioList.find('.qodef-ptf-list-paging'),
                        animateCycle = 5, // rewind delay
                        animateCycleCounter = 0;
                    article.each(function(){
                        var thisArticle = $(this);
                        setTimeout(function(){
                            thisArticle.appear(function(){
                                animateCycleCounter ++;
                                if(animateCycleCounter == animateCycle) {
                                    animateCycleCounter = 0;
                                }
                                setTimeout(function(){
                                    thisArticle.addClass('qodef-appeared');
                                },animateCycleCounter * 180);
                            },{accX: 0, accY: 0});
                        },30);
                    });
                    if(loadMore.length){
                        loadMore.addClass('qodef-appeared');
                    }
                }

            });
        }

    }

})(jQuery);