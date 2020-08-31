<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
		
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

html {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}

body {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  padding: 1em 0;
}

h1 {
  text-align: center;
  font-size: 2em;
  padding-bottom: .5em;
}

#slider {
  width: 500px;
  height: 300px;
  margin: 0 auto 10px;
  overflow: hidden;
  position: relative;
}
#slider ul {
  overflow: hidden;
  *zoom: 1;
}
#slider ul li {
  font-size: 1.5em;
  color: #fff;
  text-align: center;
  float: left;
  width: 500px;
  height: 300px;
  line-height: 300px;
}
#slider a {
  display: block;
  position: absolute;
  color: #fff;
  font-size: 2em;
  top: 50%;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  margin-top: -15px;
  text-decoration: none;
  background: #000;
}
#slider a#sliderNext {
  right: 0;
}
#slider a:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5;
}

#pager {
  text-align: center;
}
#pager a {
  display: inline-block;
  vertical-align: middle;
  *vertical-align: auto;
  *zoom: 1;
  *display: inline;
  cursor: pointer;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  -webkit-transition-property: opacity;
  transition-property: opacity;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  -webkit-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -moz-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  -webkit-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
}
#pager a:hover, #pager a.active {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5;
}


</style>
<script>
$(function(){
	var slider = $('#slider');
	var sliderWrap = $('#slider ul');
	var sliderImg = $('#slider ul li');
	var prevBtm = $('#sliderPrev');
	var nextBtm = $('#sliderNext');
	var length = sliderImg.length;
	var width = sliderImg.width();
	var thumbWidth = width/length;

	sliderWrap.width(width*(length+2));

	//Set up
	slider.after('<div id="' + 'pager' + '"></div>');
	var dataVal = 1;
	sliderImg.each(
		function(){
			$(this).attr('data-img',dataVal);
			$('#pager').append('<a data-img="' + dataVal + '"><img src=' + $('img', this).attr('src') + ' width=' + thumbWidth + '></a>');
		dataVal++;
	});
	
	//Copy 2 images and put them in the front and at the end
	$('#slider ul li:first-child').clone().appendTo('#slider ul');
	$('#slider ul li:nth-child(' + length + ')').clone().prependTo('#slider ul');

	sliderWrap.css('margin-left', - width);
	$('#slider ul li:nth-child(2)').addClass('active');

	var imgPos = pagerPos = $('#slider ul li.active').attr('data-img');
	$('#pager a:nth-child(' +pagerPos+ ')').addClass('active');


	//Click on Pager  
	$('#pager a').on('click', function() {
		pagerPos = $(this).attr('data-img');
		$('#pager a.active').removeClass('active');
		$(this).addClass('active');

		if (pagerPos > imgPos) {
			var movePx = width * (pagerPos - imgPos);
			moveNext(movePx);
		}

		if (pagerPos < imgPos) {
			var movePx = width * (imgPos - pagerPos);
			movePrev(movePx);
		}
		return false;
	});

	//Click on Buttons
	nextBtm.on('click', function(){
		moveNext(width);
		return false;
	});

	prevBtm.on('click', function(){
		movePrev(width);
		return false;
	});

	//Function for pager active motion
	function pagerActive() {
		pagerPos = imgPos;
		$('#pager a.active').removeClass('active');
		$('#pager a[data-img="' + pagerPos + '"]').addClass('active');
	}

	//Function for moveNext Button
	function moveNext(moveWidth) {
		sliderWrap.animate({
    		'margin-left': '-=' + moveWidth
  			}, 500, function() {
  				if (imgPos==length) {
  					imgPos=1;
  					sliderWrap.css('margin-left', - width);
  				}
  				else if (pagerPos > imgPos) {
  					imgPos = pagerPos;
  				} 
  				else {
  					imgPos++;
  				}
  				pagerActive();
  		});
	}

	//Function for movePrev Button
	function movePrev(moveWidth) {
		sliderWrap.animate({
    		'margin-left': '+=' + moveWidth
  			}, 500, function() {
  				if (imgPos==1) {
  					imgPos=length;
  					sliderWrap.css('margin-left', -(width*length));
  				}
  				else if (pagerPos < imgPos) {
  					imgPos = pagerPos;
  				} 
  				else {
  					imgPos--;
  				}
  				pagerActive();
  		});
	}

});
</script>
<h1>Most Simple Slider with Thumbnail Navigator in jQuery</h1>
<div id="slider">
	<ul>
		<li><img src="http://xinkyo.firebird.jp/codepen/slider1.jpg"></li>
		<li><img src="http://xinkyo.firebird.jp/codepen/slider2.jpg"></li>
		<li><img src="http://xinkyo.firebird.jp/codepen/slider3.jpg"></li>
		<li><img src="http://xinkyo.firebird.jp/codepen/slider4.jpg"></li>
	</ul>
	<a href="#" id="sliderNext">></a>
	<a href="#" id="sliderPrev"><</a>
</div>