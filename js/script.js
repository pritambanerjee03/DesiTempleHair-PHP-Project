var theight, wheight, wwidth, brange;

jQuery.fn.doesExist = function(){
    return jQuery(this).length > 0;
};

function enableScroll(){
    $html = $('html');
    $body = $('body');
    $html.css('overflow', $html.data('previous-overflow'));
    var scrollPosition = $html.data('scroll-position');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);    
    $body.css({'margin-right': 0,'margin-bottom':0});
}

function disableScroll(){
    $html = $('html'); 
    $body = $('body'); 
    var initWidth = $body.outerWidth();
    var initHeight = $body.outerHeight();

    var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
    ];
    $html.data('scroll-position', scrollPosition);
    $html.data('previous-overflow', $html.css('overflow'));
    $html.css('overflow', 'hidden');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);   

    var marginR = $body.outerWidth()-initWidth;
    var marginB = $body.outerHeight()-initHeight; 
    $body.css({'margin-right': marginR,'margin-bottom': marginB});
}

function modalHeight(modal){
    var max_height = wheight*0.9;
    var mbody = modal.find('.modal-body');
    var hheight = modal.find('.modal-head').height();
    var bheight = max_height-hheight-50;
    mbody.css({'max-height':bheight+'px'});
}

function placeModal(modal)
{
	var previousCss  = $("#myDiv").attr("style");
	modal.css({visibility:'hidden', display:'block'});
	var marg_left = modal.width()/2;
	var marg_top = modal.height()/2;
	modal.attr("style",previousCss?previousCss:"");
	modal.css({'margin-top':-marg_top+'px','margin-left':-marg_left+'px'});
}

function hideModal(modal)
{
	modal.fadeOut(300,function(){
		$(this).removeClass('active');
		$('.modal-backdrop').fadeOut(300);
		enableScroll();
	});
}

function showModal(modal)
{
	$('.modal-backdrop').fadeIn(300,function(){
		modal.fadeIn(300).addClass('active');
		disableScroll();
	});
}

function isMobile(){
    return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) || wwidth<=960
}

var isDesktop = (function() {
  return !('ontouchstart' in window) // works on most browsers 
  || !('onmsgesturechange' in window); // works on ie10
 })();

$(document).ready(function(e){
    wwidth = $(window).width();
    wheight = $(window).height();
    theight = $('.title-container').height();
    brange = wheight-theight;
    
	$('.modal-backdrop').appendTo('body');
	$('.modal').appendTo('body');
	
    if($('.modal-backdrop').size()>1)
        $('.modal-backdrop.stat').remove();
    
	$('.modal').each(function(index, element) {
        modalHeight($(this));
    });
	
	$('body').on('click','.modal-toggle',function(e) {
		var modal = $($(this).data('target'));
		placeModal(modal);
		showModal(modal);
    });
	
	$('body').on('click','.modal-switch',function(e) {
		var modal = $($(this).data('target'));
		placeModal(modal);
        $('.modal.active').fadeOut(300,function(){
			$(this).removeClass('active');
			modal.fadeIn(300).addClass('active');
		});
    });
	
	$('body').on('click','.modal-close',function(e) {
		hideModal($(this).closest('.modal'));
    });
	$('body').on('click','.modal-backdrop',function(e) {
        if(!$(this).hasClass('stat'))
		  hideModal($('.modal.active'));
    });

    $(function(){
        bindMoves();
    });

    if(isMobile()){
        $('body').append('<style type="text/css">*{background-attachment:scroll !important;}</style>');
        $('.title-container').addClass('fixed');
        $('.anim-elem').addClass('mobile');
        $('.zoom-elem').addClass('mobile');
        $('.ibox').addClass('mobile');
    }
    else{
        if($('.gift-container').size()==0){
            var mi_height = wheight - $('.title-container').outerHeight() - $('.footer').outerHeight();
            $('.inner-wrap').css({'min-height':mi_height+'px'});
        }
    }
    
    if($('#hscon').doesExist()){
        var ism = isMobile() ? 1 : 0;
        $('#hscon').load('hbanner.php?ism='+ism);
    }
    
    if(!isMobile()){
        if($('.pickle-banner').doesExist()){
            var psm_height = $('.pside-inner').outerHeight()+30;
            //$('.pickle-banner').height(brange);
            console.log(psm_height+' : '+brange);
            if(psm_height>brange){
                $('.pickle-wrapper').css({'padding-bottom':(psm_height-brange)+'px'});
            }
        }
        else{
            var eheight = $('.title-container').height() + $('.footer').outerHeight() - 1;
            $('.inner-container').css({'min-height':(wheight-eheight)+'px'});
        }
    }
    
    $('.menu-toggle').click(function(c) {
        var b = $(this);
        if (!b.hasClass("active")) {
            $('.body-container').addClass('freeze');
            $('.title-container').removeClass('trans').animate({left:'100%'}, 500);
            $('.main-container').animate({'left':'100%'}, 500);
            $('.menu-container').animate({left:0},500);
            b.addClass('active');
        } else {
            $('.body-container').removeClass('freeze');
            $('.title-container').animate({left:0}, 500,function(){ $(this).addClass('trans') });
            $('.main-container').animate({'left':0}, 500);
            $('.menu-container').animate({left:'-100%'},500);
            b.removeClass('active');
        }
    });
    
	$('body').on('click','.pay-btn',function(e){
        if(!$(this).hasClass('off') && !$(this).hasClass('active')){
            $('.pay-btn.active').removeClass('active');
            $(this).addClass('active');
            var ptype = $(this).data('type');
            // alert(ptype);
            $('#pay_type').val(ptype);
            $('.pay-note').hide();
            $('.pay-note.'+ptype).show();
            // alert()
            if(ptype=='cod'){
                jQuery("#cod").css("display", "block");
                jQuery("#online").css("display", "none");
            }else{
                jQuery("#cod").css("display", "none");
                jQuery("#online").css("display", "block");
            }

            // if(ptype=='cod'){
            //     $('#cash_handling').text(30);
            //     $('#final_total').text(eval($('#final_total').text())+30);
            // }
            // else{
            //     $('#cash_handling').text(0);
            //     $('#final_total').text(eval($('#final_total').text())-30);
            // }
        }
    });
    
	$('body').on('click','.ad-box',function(e) {
        $(this).removeClass('new');
        if(!$(this).hasClass('stat') && !$(this).hasClass('active')){
            $(this).closest('.ad-list').find('.ad-box.active').removeClass('active');
            $(this).addClass('active');
            if($(this).closest('.ad-list').hasClass('billing'))
                $('#bill_aid').val($(this).data('aid'));
            else{
                $('#ship_aid').val($(this).data('aid'));
                $('#pay_type').val('online');
                $('.pay-btn.online').addClass('active');
                $('.pay-btn.cod').removeClass('active');
                if($(this).data('cod')!='1')
                    $('.pay-btn.cod').addClass('off');
                else
                    $('.pay-btn.cod').removeClass('off');
            }
            if($('.ad-box.active').size()==2){
                $('#bnote').addClass('hide');
            }
        }
    });
    
	$('body').on('click','.csum-toggle',function(e) {
        if(!$(this).hasClass('active')){
            $(this).addClass('active');
            $('.csum-list').slideDown(300);
        }
        else{
            $(this).removeClass('active');
            $('.csum-list').slideUp(300);
        }
    });

    $('body').on('click','.cart-rem',function(e) {
        var that = $(this);
        var price= eval(that.closest('.ci-amt').children('.rp').text());
        var totalammount = eval($('.totalammount:first').text());
        $.post("removeitem.php",{item:that.data('id')},function(data){
            var amts = JSON.parse(data);
            var citem = that.closest('.cart_pro');
            var cnum = eval($('.cnote:first').text());
            citem.slideUp(300,function(){
                $('.cnote').text(cnum-1);
                $(this).remove();
                //$('.totalammount').text(totalammount-price);
                $('#amt-sub').text(amts.cart_total);
                $('#amt-ship').text(amts.shipping_changes);
                $('#amt-grand').text(amts.grand_total);
                if($('.cart_pro').size()==0)
                    window.location = 'index/';
            });
        });
    });
    
    $('.mtoggle').click(function(e){
        var that = $(this);
        if(!that.hasClass('active')){
            $('.mtoggle.active').removeClass('active');
            that.addClass('active');
            var tpane = $(that.data('target'));
            $('.menu-pane.active').fadeOut(300,function(){
                $(this).removeClass('active');
                tpane.fadeIn(300,function(){
                    $(this).addClass('active');
                });
            })
        }
    });
    
    
    $('.dlink').click(function(e){
        var that = $(this);
       // var tdb = $(that.data('target'));
        var categoryId = $(this).attr("data-id");
        var tdb = '#t_'+categoryId;
        jQuery.ajax
            ({
                type: "POST",
                url: APPURL+"ajxHandler.php",
                data: "action=subCategoryMenu&categoryId="+categoryId,
                success: function(data)
                {   
                    // alert(data);
                    // $('#cartItemsCatIds').val(cartIds);
                    $('#menuCategory').html(data);
                    // $('#outofStockCartItems').modal('show');
                    if(!that.hasClass('active')){
                      
                            if($('.td-main.active').size()){
                                $('.td-wrap').animate({'opacity':0},300,function(){
                                    $('.td-main.active').removeClass('active');
                                    $('.dlink.active').removeClass('active');   
                                    $(tdb).addClass('active');
                                    that.addClass('active');
                                    $(this).animate({'opacity':1},300);
                                });
                              
                            }
                            else{
                                $('.td-main.active').removeClass('active');
                                $('.dlink.active').removeClass('active');
                                $(tdb).addClass('active');
                                that.addClass('active');
                                $('.title-container').addClass('open');
                                setTimeout(function(){ $('.title-drop').slideDown(300); },300);
                            }
                        }
                        else{
                            
                            $('.title-drop').slideUp(300,function(){
                                $('.title-container').removeClass('open');
                                $('.td-main.active').removeClass('active');
                                $('.dlink.active').removeClass('active');
                            })
                        }
                    
                },
                error: function(){
                    $('#menuCategory').html(data);
                }
            });
        
    });

    $('.anim-block').each(function(index,el){
        $(this).attr('data-offset',$(this).offset().top);
    });

    $(document).mouseup(function(event) { 
        var container = $('.title-container');
        var btns = $('.dlink');
        if(container.has(event.target).length===0) {
            $('.dlink.active').click();
        }        
    });
    
    $(".dob-select").change(function(f) {
        var b = $("#dob-day").val();
        var d = $("#dob-month").val();
        var c = $("#dob-year").val();
        $("#dob").val(d + "/" + b + "/" + c)
    });

    $(".ft-btn").click(function(c) {
        var b = $(this);
        if (!b.hasClass("active")) {
            $(".ft-btn.active").removeClass("active");
            b.addClass("active");
            $(".formbox.active").fadeOut(300, function() {
                $(this).removeClass("active");
                $(b.data("target")).fadeIn(300).addClass("active")
            })
        }
    });
    
    if($(window).width()>960){
        $('.vintage-btn').hover(function(){
            $(this).stop().animate({'right':'-35px'},300);
        },function(){
            $(this).stop().animate({'right':'-135px'},300);
        });
    }
	
	$('.vintage-btn').click(function(e) {
        var icon_offset = $('.page-cart').offset().top-50;
		$('html,body').animate({scrollTop:icon_offset+'px'},600);
    });

	$('.gwrite-link').click(function(e) {
        var foffset = $('.cgfblock').offset().top- ( isMobile() ? 61 : 86);
		$('html,body').animate({scrollTop:foffset+'px'},600);
    });

    $('#gift_msg').keyup(function(e) {
		var rem = eval(200-$(this).val().length);
		if(rem<=0)
			$(this).val($(this).val().substr(0, 200)); 
        $('#gmsg-count').html(eval(200-$(this).val().length)+' characters left');
    });
	
    
	if($('#gift-check').size()>0 && $('#gift-check').is(':checked')){
        $('.gfbody').slideDown(250);
        $('.check-btn').fadeOut(250);
    }
    
	$('#gift-check').change(function(){
		if($(this).is(':checked')){
			$('body').animate({scrollTop:($('.gift-container').offset().top-120)+'px'},250);
	        $('.gfbody').slideDown(250);
			$('.check-btn').fadeOut(250);
		}
		else
		{
			$('.gift-toggle').removeClass('active');
			$('.check-btn').fadeIn(250);
	        $('.gfbody').slideUp(250,function(){
                $('#form-gift input').val('');
                $('#form-gift textarea').val('');
            });
		}
	});

	$('#txt-message').keyup(function(e) {
		var rem = eval(200-$(this).val().length);
		if(rem<=0)
			$(this).val($(this).val().substr(0, 200)); 
        $('#gmsg-count').html(eval(200-$(this).val().length)+' characters left');
    });
	
	$('#card-tog').click(function(e) {
        $('.card-popup').fadeIn(350);
    });
	
	$('.card-close').click(function(e) {
        $('.card-popup').fadeOut(350);
    });
	
    $('body').on('click','.spin-btn',function(e){
        var mix = $(this).hasClass('mix');
        var cart = $(this).hasClass('cart');
        var row = $(this).closest('.pqb-row');
        var ip = $(this).closest('.spinner').find('.spin-txt');
        var pamt = row.find('.pqb-amt');
        var size = row.find('.pqb-size').data('val');
        var cindex = $('.spin-txt').index(ip);
        var cval = eval(ip.val());
        var nval = $(this).hasClass('plus') ? ++cval : --cval;
        var min_range = cart ? 1 : 0;
        nval = nval>50 ? 50 : ( nval<min_range ? min_range : nval );
        var srate = eval(row.find('.pqb-srate').val());
        var rate = eval(row.find('.pqb-rate').val());
        var old_price = eval(row.find('.pqb-amt').text());
        pamt.text(rate*nval);
        var total = eval($('#amt-sub').text() - old_price);
        ip.val(nval);
        
        var samt = row.find('.pqb-strike');
        if(srate>0){
            samt.text(srate*nval);
        }
        
        if(mix){
            var factor = size/50;
            var nprice =  rate*nval>0 ? rate*nval+factor*nval*row.find(".ingd_num").val() : 0;
            pamt.text(nprice);
            if(srate!='' && eval(srate)>0){
                var sprice =  srate*nval>0 ? srate*nval+factor*nval*row.find(".ingd_num").val() : 0;
                samt.text(sprice);
            }
            if(!cart)
                adjust_amt();
        }
        
        if(eval(samt.text())>0)
            samt.removeClass('hide');
        else
            samt.addClass('hide');
        
        if(checkQty()>250)
            $('#amt-ship').text('0');
        else
            $('#amt-ship').text('40');
        $('#amt-sub').text(total + eval(pamt.text()));
        $('#amt-grand').text(eval($('#amt-sub').text()) + eval($('#amt-ship').text()));
        var weight = 0
        $('.spin-txt').each(function(index,el){
            var size = $(this).closest('.pqb-row').find('.pqb-size').data('val');
            weight = weight + size*$(this).val();
        });
        
        var wtext,wtype;
        if(weight<1000){
            wtext = weight;
            wtype = 'gms';
        }
        else if(weight==1000){
            wtext = '1';
            wtype = 'kg';
        }
        else{
            wtext = weight/1000;
            wtype = 'kgs';
        }
        
        $('#weight').text(wtext);
        $('#wtype').text(wtype);
        
        if(weight==0)
            $('#addtocart').attr('disabled','disabled');
        else
            $('#addtocart').removeAttr('disabled');
    });

    if($('.spin-btn').size()){
        $('.pqb-row:last').find('.spin-btn.plus:not(".cart")').click();
    }
    
    $("#addcart").submit(function(e){
        var btn = $('#addtocart');
        e.preventDefault();
        btn.addClass('empty checked');
        setTimeout(function(){
            btn.removeClass('checked');
            setTimeout(function(){
                btn.removeClass('empty');
            },300);
        },1000);

        // $.post("updatecart.php", $("#addcart").serialize(),function(data){
        //     $(".cnote").text(data);
        // }, "json");
    });

    $('.fn-close').click(function(e) {
        $('.fnote-block').animate({'margin-bottom':'-120px'},300).removeClass('active');
        $('.fn-body.active').fadeOut(500).removeClass('active');
        $('.fn-toggle').removeClass('active');
    });
    
    $('.fn-toggle').click(function(e) {
        var that = $(this);
        var fbody = $(that.data('target'));
        if($('.fnote-block').hasClass('active')){
            if(!that.hasClass('active'))
                changeTab(true)
        }
        else{
            $('.fnote-block').addClass('active').animate({'margin-bottom':'0px'},function(){
                changeTab(false);
            });
        }
        
        function changeTab(open){
            if(!open){
                fbody.fadeIn(500).addClass('active');
                that.addClass('active');
            }
            else{
                $('.fn-body.active').fadeOut(500,function(){
                    $(this).removeClass('active');
                    $('.fn-toggle.active').removeClass('active');
                    fbody.fadeIn(500).addClass('active');
                    that.addClass('active');
                });
            }
        }
    });
    
    if($('.pickle-container').doesExist()){
        if($('.pickle-banner').doesExist()){
            if($("#pickle-img").size()){
                $("#pickle-img").one("load", function() {
                    $('.pickle-banner').animate({'opacity':1},300,function(){
                        $('.pickle-sidebar').animate({'opacity':1},300);
                        $('.pside-wrap').animate({'padding-left':'0px','margin-right':'0px'},300,function(){
                            $('.pickle-data').animate({'opacity':1},300);
                            $('.pmore').animate({'opacity':1},300);
                        });
                    });
                });
                if($("#pickle-img")[0].complete)
                    $("#pickle-img").load();
            }
            else{
                $('.pickle-banner').animate({'opacity':1},300,function(){
                    $('.pickle-sidebar').animate({'opacity':1},300);
                    $('.pside-wrap').animate({'padding-left':'0px','margin-right':'0px'},300,function(){
                        $('.pickle-data').animate({'opacity':1},300);
                        $('.pmore').animate({'opacity':1},300);
                    });
                });
            }
        }
        else{
            $('.pickle-sidebar').animate({'opacity':1},300);
            $('.pside-wrap').animate({'padding-left':'0px','margin-right':'0px'},300,function(){
                $('.pickle-data').animate({'opacity':1},300);
                $('.pmore').animate({'opacity':1},300);
            });
        }
    }
    
    $('.ps-btn').click(function(e){
        var that = $(this);
        if(!that.hasClass('active')){
            var pstab = $(that.data('target'));
            $('.ps-btn').removeClass('active');
            $('.pside-inner.active').fadeOut(300,function(){
                $('.psirev').removeClass('editing');
                $(this).removeClass('active');
                pstab.fadeIn(300).addClass('active');
                that.addClass('active');
            });
        }
    });
    
    $('.rev-write').click(function(e){
        $('.psirev').fadeOut(300,function(){
            $(this).addClass('editing');
            $(this).fadeIn(300);
        });
    });
    
    $('.prev-toggle').click(function(e){
        if(!$(this).hasClass('active')){
            $(this).addClass('active');
            $('.prev-container').slideDown(300);
            $('html,body').animate({'scrollTop':($('.prev-toggle').offset().top-64)+'px'},300);
        }
        else{
            $(this).removeClass('active');
            $('.prev-container').slideUp(300);
        }
    });
    
    $('.rvnum').click(function(e){
        $('.psb-rev').click();
    });
    
    if($('.prev-form').size()){
        
        //Rating
        var user_rating=0;
        var maxRating= 5;
        var callback = function(rating) {
            user_rating = rating;
            if(user_rating==0)
                $('.frwrap').addClass('error');
            else
                $('.frwrap').removeClass('error');
        };

        var el1 = document.querySelector('#nrate');
        var myRating1 = rating(el1, 0, maxRating, true, callback);
        
        $('#rsubmit').click(function(){
            var valid = $('#form-review').validationEngine('validate');
            if(user_rating==0)
                $('.frwrap').addClass('error');
            else
                $('.frwrap').removeClass('error');
            if(valid){
                if(user_rating!=0){
                    var that = $('#rsubmit');
                    that.text('Processing...').attr('disabled','disabled');
                    $.post("review.php",{
                        name: $('#user_name').val(),
                        email: $('#user_email').val(),
                        title: $('#review_title').val(), 
                        review: $('#user_review').val(),
                        rating: user_rating,
                        product: $('#pickle_id').val()
                    },
                    function(data){
                        var msg = data ? 'Thank you for your feedback.' : 'Sorry, an error occurred! Please try again.';
                        $('#rmessage').html(msg);
                        $('.psirev').fadeOut(300,function(){
                            $(this).addClass('result');
                            $(this).fadeIn(300,function(){
                                setTimeout(function(){
                                    that.text('Submit').removeAttr('disabled');
                                    if(data){
                                        myRating1 = rating(el1, 0, maxRating, true, callback);
                                        $('#form-review')[0].reset();
                                        $('#user_name').blur();
                                        $('#user_email').blur();
                                        $('.psb-buy').click();
                                        setTimeout(function(){
                                            $('.psirev').removeClass('result');
                                        },1000);
                                    }
                                    else{
                                        $('.psirev').fadeOut(300,function(){
                                            $(this).removeClass('result');
                                            $(this).fadeIn(300);
                                        });
                                    }
                                },5000);
                            });
                        });
                    });
                }
            }
        });
        
    }

    $('.fform').submit(function(e){
        var that = $(this);
        var isValid = that.validationEngine('validate');
        if(isValid){
            e.preventDefault();
            var sect = that.closest('.ffpar');
            var ffbody = sect.find('.ffbody');
            var ffmsg = sect.find('.ffmsg');
            ffbody.fadeOut(300,function(){
                ffmsg.fadeIn(300);
                $.post(that.data('action'),that.serialize(),function(data){
                    that[0].reset();
                    if(!that.hasClass('news'))
                        ffmsg.html(data);
                    else{
                        var rtext = (data.indexOf("You're already subscribed!") !== -1) ? "This email id is already in our subscription list." : "Thank you for subscription!"
                        ffmsg.addClass('success').text(rtext);
                    }
                    setTimeout(function(){
                        ffmsg.fadeOut(300,function(){
                            ffmsg.removeClass('success error').text('Processing...');
                            ffbody.fadeIn(300);
                        });
                    },5000);
                });
            });
        }
    });

    checkIBox();
    
});

function animateText(nindex){
    $('.hsd.active').fadeOut(300,function(){
        $(this).removeClass('active');
        $('.hsd').eq(nindex).fadeIn(300,function(){
            $(this).addClass('active');
        });
    });
}

function checkQty(){
    var total_qty=0;
    $(".pqb-size").each(function(index,el){
        var qty = $(this).data('val');
        var units = eval($(this).closest('.pqb-row').find('.spin-txt').val());
        total_qty = total_qty + (qty * units);
    });
    return total_qty;
}

function checkValue(){
    $(".fip input,.fip textarea").each(function(index,el){
        var label = $(this).parent().find(".fpl");
        if($(this).val() !== "")
            label.addClass("show");
        else
            label.removeClass("show");
    });
}

function bindMoves(){
    var onClass = "on";
    var showClass = "show";
    $(".fip input,.fip textarea").bind("checkval",function(){
        var label = $(this).parent().find(".fpl");
        if($(this).val() !== ""){
            label.addClass(showClass);
        }else{
            label.removeClass(showClass);
        }
    })
    // .on("keyup",function(){
    //     $(this).trigger("checkval");
    // }).on("focus",function(){
    //     $(this).parent().find(".fpl").addClass(onClass);
    //     $(this).parent().addClass('active');
    // }).on("blur",function(){
    //     $(this).parent().find(".fpl").removeClass(onClass);
    //     $(this).parent().removeClass('active');
    //     $(this).trigger("checkval");
    // }).trigger("checkval");
}

$(window).scroll(function(e){
    
    var scroll_top = getScrollTop();
    if(!isMobile()){

        checkIBox();
        if($('.title-container').doesExist()){
            var scroll_top = getScrollTop();
            if(scroll_top>200){
                $('.title-container').addClass('filled');
                $('.fnote-block').addClass('show');
            }
            else{
                $('.title-container').removeClass('filled');
                $('.fnote-block').removeClass('show');
            }
        }
        
        if($('.home-page').doesExist()){
            var oper = (1-scroll_top/brange)>0.9 ? 1 : (1-scroll_top/brange)*1.33;
            $('.bslider').css({'opacity':oper});
        }
        
        $('.anim-block').each(function(index,el){
            var el_off = $(this).attr('data-offset');
            if(!$(this).hasClass('done') && el_off<scroll_top+wheight/2){
                $(this).addClass('done');
                $(this).find('.anim-elem').each(function(index,el){
                    var that = $(this);
                    setTimeout(function(){ fadeElem(that) },150*index);
                });
            }
        });
        
        if($('.full-section').doesExist()){
            $('.full-section').each(function(index,el){
                var el_off = $(this).offset().top+wheight;
                var el_vis = (el_off-scroll_top)>=wheight ? wheight : (el_off-scroll_top);
                console.log(el_off+' : '+scroll_top+' : '+el_vis);
                $(this).find('.full-wrapper').height(el_vis);
                var tper = (el_vis/wheight) - (1-(el_vis/wheight))*1.5;
                $(this).find('.full-text').css({'opacity':tper,'transform':'scale('+tper+')'});
            });
        }
        
        if($('.bimg').doesExist()){
            $('.bimg').each(function(index, element) {
                var bheight = $(this).height();
                var boper = 50*scroll_top/bheight;
                var bopec = 1-scroll_top/bheight;
                $(this).css({'background-position':'center '+(-boper)+'px','opacity':bopec});
            });
        }
        
        if($('.pimage-container').doesExist()){
            var scrollTop = $(window).scrollTop();
            $('.pimage-container').each(function(index, element) {
                var ibanner = $(this);
                var wheight = $(window).height();
                var offset = ibanner.offset().top;
                var diff = 200;

                var amt = offset - (scrollTop+wheight);

                var min_vpoint = offset - wheight;
                var max_vpoint = offset + wheight;
                var range = max_vpoint - min_vpoint;
                var mdist = (scrollTop<min_vpoint) ? min_vpoint : scrollTop;

                var pos = -((mdist-min_vpoint)/range)*diff;
                pos = pos>0 ? 0 : pos;
                pos = pos<-diff ? -diff : pos;	
                ibanner.css({'background-position':'center '+(pos/5)+'px'});
            });		
        }
        
        if($('.pshow').doesExist()){
            var cindex = Math.round(scroll_top/wheight)-1;
            cindex = cindex>=$('.psimg').size() ? $('.psimg').size()-1 : cindex;
            cindex = cindex<0 ? 0 : cindex;
            $('.psimg').removeClass('active');
            $('.psimg').eq(cindex).addClass('active');
        }
        
    }
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function pad(b, a) {
    b = b.toString();
    return b.length < a ? pad("0" + b, a) : b
}

function checkIBox(){
    var scroll_top = getScrollTop();
    $('.ibox').each(function(index,el){
        var el_off = $(this).offset().top;
        if(el_off<scroll_top+wheight*0.8)
            $(this).addClass('move');
        else
            $(this).removeClass('move');
    });
}

function fadeElem(el){
    el.animate({'opacity':1},{
        step: function(now,fx){
          if(el.hasClass('zoom-elem')){
              var amt = 0.8 + 0.2*now;
              $(this).css('transform','scale('+amt+')');
          }
        },
        duration:400,
        complete:function(){}
    },'linear');
}

function resizeVideo(){
	var aspImg = 720/1280;
	var aspWin = wheight/wwidth;
	var ih,iw,il,it;
	if(aspImg<aspWin){
		ih = wheight;
		iw = wheight/aspImg;
		il = -((iw-wwidth)/2);
		it = 0;
		$('.hsv').css({'width':iw+'px','height':ih+'px','left':il+'px','top':it+'px'});
	}
	else{
		iw = wwidth;
		ih = wwidth*aspImg;
		il = 0;
		it = -((ih-wheight)/2);
		$('.hsv').css({'width':iw+'px','height':ih+'px','left':il+'px','top':it+'px'});
	}
}

function getScrollTop(){ //  Verifies the total sum in pixels of the whole page
	if(typeof pageYOffset!= 'undefined'){
		// Most browsers
		return pageYOffset;
	}
	else{
		var B= document.body; //IE 'quirks'
		var D= document.documentElement; //IE with doctype
		D= (D.clientHeight)? D: B;
		return D.scrollTop;
	}
}


/*thumb nail slider*/

$(document).ready(function() {
      $("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                // auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
    });

/*thumb nail slider*/

/* pop up script */
$(document).ready(function(){
            
      $('.btnBkPopup').fancybox({
        padding:0
            
    });
});
/* pop up script */
