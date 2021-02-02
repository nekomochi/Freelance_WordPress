jQuery(function($){
$("body").children().each(function() {
    $(this).html($(this).html().replace(/Autocad/g,"AutoCAD"));
    $(this).html($(this).html().replace(/autocad/g,"autoCAD"));
});
// $(window).load(function() {
	$('.slider').slick({
		lazyLoad: 'progressive',
		draggable: false,
		infinite: true,
		slidesToShow: 2,
		slidesToScroll: 1,
		rows: 0,
		autoplay: false,
		dots: false,
		// adaptiveHeight: true,
		// infinite: false,
		prevArrow: $('.carousel-control-prev'),
		nextArrow: $('.carousel-control-next')
	});

	$('#searchform').on('submit',function (e) {
	    if ($('#s').val() == '') {
	        $('#submit').prop('disabled', true);
	        e.preventDefault();
	    } else {
	        $('#submit').prop('disabled', false);
	    }
	}).keyup();

	// Add smooth scrolling to all links
	  $(".navi a").each(function(){
	  	$(this).on('click', function(event) {

		    // Make sure this.hash has a value before overriding default behavior
		    if (this.hash !== "") {
		      // Prevent default anchor click behavior
		      event.preventDefault();

		      // Store hash
		      var hash = this.hash;// Add hash (#) to URL when done scrolling (default click behavior)
		        // window.location.hash = hash;

		      // Using jQuery's animate() method to add smooth page scroll
		      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		      // console.log("scroll");
		      $('html, body').animate({
		        scrollTop: ($(hash).offset().top - $('.hive-nav').height())
		      }, 800, function(){

		        
		      });
		    } // End if
		  });
	  });

	$("select").chosen({
		disable_search: true,
		inherit_select_classes: true,
		width: "100%"
	});


	$(".search-sort").on('change', function(evt, params){
		// var currentUrl = window.location.href;

		// var url = window.location.toString();

		$( ".search-sort option:selected" ).each(function() {

			var selected = $(this).val();

			if(selected=="title"){
				addQSParm("orderby", $(this).val());
				addQSParm("order", "ASC");
			}
			if(selected=="date"){
				addQSParm("orderby", $(this).val());
				addQSParm("order", "DESC");
			}
			window.location = url;
		});
	});

	var params = { width:'value', height:1050 };
	var str = jQuery.param( params );

	var url = window.location.toString();

	$(".tag-sort").on('change', function(evt, params){

		var currentUrl = window.location.href;
		addQSParm("tag", $(this).val());
		window.location = url;

		// $('.tag-sort option:selected').each(function() {

		

		// });
	});

	$(".first-sort").on('change', function(evt, params){

		var currentUrl = window.location.href;
		addQSParm("tag", $(this).val());
		window.location = url;
		// console.log(url);

	});

$(".second-sort").on('change', function(evt, params){

	var currentUrl = window.location.href;
	addQSParm("+", $(this).val());
	// console.log(url);
	window.location = url;

});


$("select.multi-sort").each(function(i, obj){


if(i != 0){


	$(this).on('change', function(evt, param){


			addQSParm("+", $(this).val());
			console.log(url);
			// window.location = url;
	});
} else {

	$(this).on('change', function(evt, param){

			addQSParm("tag", $(this).val());
			// console.log(url);
			window.location = url;
	});
	
}
// console.log(obj);
	
});
	
	$(".detail-sort").on('change', function(evt, params){
		var currentUrl = window.location.href;
		var newurl;

		$( ".detail-sort option:selected" ).each(function() {

			var selected = $(this).val();

			if(selected=="title"){
				addQSParm("orderby", $(this).val());
				addQSParm("order", "ASC");
			}
			if(selected=="date"){
				addQSParm("orderby", $(this).val());
				addQSParm("order", "DESC");
			}
			window.location = url;

			
		});
	});



	var searchcancel =  $(".search-cancel-icon");
	var searchbox = $('.search-box');


	if(searchbox.val()){
		searchcancel.show();
	}

	searchbox.keyup(function() {

	  if (searchbox.val() == '') {
	    searchcancel.hide();
	  } else {
	    searchcancel.show();
	  }
	});

	searchcancel.on('click', function() {
	    searchcancel.hide();
	  searchbox.val('');
	});


	$('.scroll-top').click(function() {      // When arrow is clicked
		// console.log("scroll");
		$('body,html').animate({
		    scrollTop : 0                       // Scroll to top of body
		}, 500);
	});


	function addQSParm(name, value) {
		// var myUrl = url;
	    var re = new RegExp("([?&]" + name + "=)[^&]+", "");

	    function add(sep) {
	    	// & something = value
	        url += sep + name + "=" + encodeURIComponent(value);
	    }

	    function addTag(sep){
	    	if(url.indexOf("?tag") > -1){ 
	    		var newval;
	    		var rea = new RegExp("([?&][^tag=])[^.*]+", "");
	    		url = url.replace(rea, sep + value);
	    		// console.log("test " + url.replace(rea, sep + value));
	    		// console.log(url);
	    		// console.log('active');
	    	} else {
	    		url += sep + encodeURIComponent(value);
	    	}
	    }

	    function change() {
	        url = url.replace(re, "$1" + encodeURIComponent(value));
	    }
	    function replaceVal() {
	    	url = url.replace()
	    }
	    if (url.indexOf("?") === -1) {
	        add("?");
	    } else {
	        if (re.test(url)) {
	            change();
	        } else {

	        	if(name == "+"){
	        		addTag(name);
	        		// console.log('fire');
	        	} else if(url.indexOf("+") > -1) {
			    	// console.log('in');
			    	// console.log(value);
			    	// re = new RegExp("[^&]+([+]" + value + ")", "");
			    	// console.log(url.replace(re, "$1" + encodeURIComponent(value)));
			    	// // url = url.replace(re, encodeURIComponent(value));
			    	// console.log(re);
			    	// console.log(url.split("+")[0]);
			    	// re = new RegExp("["+ (url.split("+")[0]) + "]+", "");
			    	// console.log(re);
			    	// console.log(url.replace((url.split("+")[0]), ""));
			    	if((name == "order") || (name == "orderby")) {

	            		add("&");
	            	} else {
				    	console.log('in');
				    	var newurl = url.replace(url, (url.split("+")[0]));
				    	// addTag(name);
				    	console.log(url.split("+")[0]);
				    	newurl += name + encodeURIComponent(value);
				    	url = newurl;
				    	// console.log('in ' + url);
				    }

			    } else {
            		add("&");
            	}
	        }
	    }


	    return url;
	}

});



function removeParam(key, key2, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
            if (param === key2) {
                params_arr.splice(i, 2);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

// var myimages=new Array()
// function preloadimages(){
// 	for (i=0;i<preloadimages.arguments.length;i++){
// 		myimages[i]=new Image();
// 		myimages[i].src=preloadimages.arguments[i];
// 	}
// }

/**
 * Image preloader
 *
 * @link http://engineeredweb.com/blog/09/12/preloading-images-jquery-and-javascript
 */
var cache = [];
// Arguments are image paths relative to the current page.
function pilau_preload_images() {
	var args_len, i, cache_image;
	args_len = arguments.length;
	for ( i = args_len; i--;) {
		cache_image = document.createElement('img');
		cache_image.src = arguments[i];
		cache.push( cache_image );
	}
}