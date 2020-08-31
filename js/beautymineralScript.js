//var APPURL = 'http://localhost/chitkiapp/';

var APPURL = '';

function numbersOnly(evt){
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
     return false;

  return true;
}

function addToCartItems(productId){

	 // var timeslotVal = ''
	 // var productOptionId = jQuery('#productOptionId_'+productId).val();
	 // var quantity = jQuery('#productQty_'+productId).val();
	 // timeslotVal = jQuery('#timeslotVal').val();	
	 // if (typeof timeslotVal === "undefined") {
	 // 	timeslotVal = '';
	 // }
	var totalAmount = 0;
	var quantity = 0;
	var productOptionId = 0;
    var quantityVal = [];
    var productOptionIdVal=[];

	$(".total_amt").each(function(){
    	productOptionId = $(this).attr("data-id");
        totalAmount += +$(this).val();
        quantity = $('#qty_'+productOptionId).val();
        quantityVal.push(quantity);
        productOptionIdVal.push(productOptionId);

    }); 

    var jsonQuantityString = JSON.stringify(quantityVal);
    var jsonProductOptionIdString = JSON.stringify(productOptionIdVal);
	// console.log(productOptionIdVal);

	 jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=addToCartItems&productId="+productId+"&productOptionId="+jsonProductOptionIdString+"&quantity="+jsonQuantityString,
		    success: function(msg)
		    {	
		    	miniCartBeautyMineral();  
		    	// jQuery('.miniCartFlavors').html(msg);
		    }
		});

}

function addToCart(productId,productOptionId){
	var productCropSet = $('#productCropSet_'+productId).val();
	var productCrop = $('#productCrop_'+productId).val();
	if(productCropSet == '1' && productCrop == '' ){
		$('#corpErrmsg').html("Please select corps");	
		return false;
	}
	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=addToCart&productId="+productId+"&productOptionId="+productOptionId,
		    success: function(msg)
		    {	
		    	var msg = jQuery.trim(msg);
		    	if(msg=='success'){	
		    		//window.location = 'cart';
		    		miniCartBeautyMineral();
		    	}else{
		    		$('#addToCartError').html('Error while adding to cart, Please try again!');
		    	}		               
		    }
		});
}

function addToCartChitki(productId){
	 var timeslotVal = ''
	 var productOptionId = jQuery('#productOptionId_'+productId).val();
	 var quantity = jQuery('#productQty_'+productId).val();
	 timeslotVal = jQuery('#timeslotVal').val();	
	 if (typeof timeslotVal === "undefined") {
	 	timeslotVal = '';
	 }	 
	 jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=addToCartChitki&productId="+productId+"&productOptionId="+productOptionId+"&quantity="+quantity+"&timeslotVal="+timeslotVal,
		    success: function(msg)
		    {	

		      if(msg=='success'){		                           
		    	  miniCartChitki();

		    	  jQuery.toast({
					    heading: 'Success',
					    text: 'Item has been added to the Cart',
					    showHideTransition: 'slide',
					    icon: 'success',
					    hideAfter: 1000
					});
		    	  if(timeslotVal !=''){
		    	  	window.location = 'cart';
		    	  }
		      }    

		    }
		});

}



function miniCartChitki(){

	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=miniCartChitki",
		    success: function(msg)
		    {			               
		        jQuery('.miniCartBeautyMineral').html(msg);

		        var totalItemsCount =  jQuery('#totalItemsCount').val();

		        if(jQuery('.totalItems').length>0){
		        	jQuery('.totalItems').html(totalItemsCount);
		        }  

		        if(jQuery('.mobItemCount').length>0){
		        	jQuery('.mobItemCount').html(totalItemsCount);	    
		        }                       
		    }
		});
}

function miniCartBeautyMineral(){

	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=miniCartBeautyMineral",
		    success: function(msg)
		    {			               
		        jQuery('.miniCartBeautyMineral').html(msg);

		        var totalItemsCount =  jQuery('#totalItemsCount').val();

		        if(jQuery('.totalItems').length>0){
		        	jQuery('.totalItems').html(totalItemsCount);
		        }  

		        if(jQuery('.mobItemCount').length>0){
		        	jQuery('.mobItemCount').html(totalItemsCount);	    
		        }                       
		    }
		});
}

function removeItemFromCart(id){

	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=removeItemFromCart&id="+id,
		    success: function(msg)
		    {	

		    // alert(msg)		               
		    	miniCartBeautyMineral();
		    	
		    	if(jQuery('.mainCart').length>0){
		        	jQuery('.mainCart').html(msg);	 
		        }                          
		    }
		});
}

	jQuery( document ).ready(function() {
		
	     // $('#addtocart').attr('disabled','disabled');
	    
	    
	});

function updateCartItemsData(id, type, cost){
	var qty = jQuery('#qty_'+id).val();
	// alert(qty);
	if(type=='plus'){
		
		var newQty = parseInt(qty)+1;
		jQuery('#qty_'+id).val(newQty);
		var productCost = parseInt(cost)*newQty;
		// alert(productCost);
		jQuery('#cost_'+id).html(productCost);
		procost = jQuery('#amt_'+id).val(productCost);

		$('#addtocart').removeAttr('disabled');
		calGrandTotalAmount();
	}else{
		if(qty>=1){
			var newQty = parseInt(qty)-1;
			// if(newQty>0){
			jQuery('#qty_'+id).val(newQty);
			var productCost = parseInt(cost)*newQty;
			jQuery('#cost_'+id).html(productCost);
			jQuery('#amt_'+id).val(productCost);
			// }

			$('#addtocart').removeAttr('disabled');
			calGrandTotalAmount();
		}

	}
}

function calGrandTotalAmount(){

    var totalAmount = 0;
    var totalQty = 0;

    $(".total_amt").each(function(){
    	var id = $(this).attr("data-id");
        totalAmount += +$(this).val();
        totalQty += +$('#qty_'+id).val();


    });

    $("#totalAmount").html(totalAmount);
    if(totalQty < 1){
    	$('#addtocart').attr('disabled','disabled');
	}

}

function updateCartItems(id, type, cost){
// alert(cost)
	var qty = jQuery('#qty_'+id).val();
	
	if(type=='plus'){
		
		var newQty = parseInt(qty)+1;
		jQuery('#qty_'+id).val(newQty);
		var productCost = parseInt(cost)*newQty;
		// alert(productCost);
		jQuery('#cost_'+id).html(productCost.toFixed(2));
		jQuery('#amtont_'+id).val(productCost.toFixed(2));

	}else{
		if(qty>=1){
			var newQty = parseInt(qty)-1;
			if(newQty>0){
				jQuery('#qty_'+id).val(newQty);
				var productCost = parseInt(cost)*newQty;
				jQuery('#cost_'+id).html(productCost.toFixed(2));
				jQuery('#amtont_'+id).val(productCost.toFixed(2));
			}else{
				removeItemFromCart(id);	
			}
		}else{
			removeItemFromCart(id);
		}
	}

	calCartTotalAmount();

	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=updateCartItems&qty="+newQty+"&id="+id,
		    success: function(msg)
		    {			               
		    	// miniCartChitki();
		     //    jQuery('.mainCart').html(msg);
		     miniCartBeautyMineral()	
		     jQuery('.miniCartFlavors').html(msg);                           
		    }
		});

}


function calCartTotalAmount(){

	var totalAmount = 0;
    $(".total_amtont").each(function(){

        totalAmount += +$(this).val();
      // alert(totalAmount);
    });
 //alert(totalAmount);
    $("#totalCartAmount").html(totalAmount.toFixed(2));
    
    $("#grandTotalCartAmount").html(totalAmount.toFixed(2));

}


function getProductCostByOptionId(ele, id){

	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=getProductCostByOptionId&productId="+id+"&productOptionId="+ele.value,
		    success: function(msg)
		    {	

		   	// alert(msg);

		   	 if(msg){
		   	 	jQuery('.chitkiPrice_'+id).html(msg);
		   	 }
		      // if(msg=='success'){		                           
		    	  	
		      // }    

		    }
		});

}

function changePaymentOption(ele){

	if(ele.value=='cashOnDelivery'){
		jQuery( "#cashOnDelivery .newMobileNumber" ).blur();
		jQuery("#cashOnDelivery").css("display", "block");
		jQuery("#onlinePayment").css("display", "none");
	}else{
		jQuery( "#onlinePayment .newMobileNumber" ).blur();
		jQuery("#cashOnDelivery").css("display", "none");
		jQuery("#onlinePayment").css("display", "block");
	}

}
function applyBusinessUserOffer(subTotal,grandTotal){
	jQuery.ajax
	    ({
	        type: "POST",
	        url: APPURL+"ajxHandler.php",
	        dataType: 'json',
	        data: "action=applyBusinessUserOffer&subTotal="+subTotal+"&grandTotal="+grandTotal,
	        success: function(data)
	        {		
	        	if(data.msg=='unset'){	
	            	grandTotal = data.totalpay;
	            	jQuery('#offerMsg').html('');
	                jQuery('#discountAmt').html('');
	                jQuery('#totalPayable').html(grandTotal);
	            }else{	  
	            	console.log(data.msg);	                           
	                jQuery('#offerMsg').html(data.msg);
	                jQuery('#discountAmt').html(data.offer);
	                jQuery('#totalPayable').html(data.totalpay);
	            }			                           
	        }
	    });
}

function newRegNumberCheck(ele,subTotal,grandTotal){
				var mobileNumber = ele.value;
				if((mobileNumber.length ==10 ) || (mobileNumber.length ==11 ) ){
				jQuery.ajax
	                ({
	                    type: "POST",
	                    url: APPURL+"ajxHandler.php",
	                    dataType: 'json',
	                    data: "action=checkNewNumberOffer&mobileNumber="+mobileNumber+"&subTotal="+subTotal+"&grandTotal="+grandTotal,
	                    success: function(data)
	                    {		
	                    	if(data.msg=='unset'){	
		                    	grandTotal = data.totalpay;
				            	jQuery('#offerMsg').html('');
			                    jQuery('#discountAmt').html('');
			                    jQuery('#totalPayable').html(grandTotal);
	                        }else if(data.msg=='businessoffer'){
	                        }else{	  
		                    	console.log(data.msg);	                           
		                        jQuery('#offerMsg').html(data.msg);
		                        jQuery('#discountAmt').html(data.offer);
		                        jQuery('#totalPayable').html(data.totalpay);
	                        }			                           
	                    }
	                });
	            }else{
	            	jQuery.ajax
	                ({
	                    type: "POST",
	                    url: APPURL+"ajxHandler.php",
	                    dataType: 'json',
	                    data: "action=checkNewNumberOffer&unsetSession=Yes&grandTotal="+grandTotal,
	                    success: function(data)
	                    {	
	                    	if(data.msg=='unset'){	
		                    	grandTotal = data.totalpay;
				            	jQuery('#offerMsg').html('');
			                    jQuery('#discountAmt').html('');
			                    jQuery('#totalPayable').html(grandTotal);
	                        }			                           
	                    }
	                });
	            	
	            } 
}

function registrationEmailCheck(email){
 	jQuery.ajax
    ({
        type: "POST",
        url: APPURL+"ajxHandler.php",
        data: "action=registrationEmailCheck&email="+email,
        success: function(data)
        {	
        	if(data=='emailexits'){
        		jQuery('#registrationEmailCheck').html('Email you entered is already exist.');
        	}else{
        		jQuery('#registrationEmailCheck').html('');
        	}
        }
    });
}

function addToWishlist(productId){
	jQuery('#wish_'+productId).toggleClass('wishlistActive');
	jQuery.ajax
    ({
        type: "POST",
        url: APPURL+"ajxHandler.php",
        data: "action=addToWishlist&productId="+productId,
        success: function(data)
        {	
        	if(data=='success'){
        		jQuery.toast({
					    heading: 'Added to Wishlist',
					    text: 'Item has been added to the wishlist',
					    showHideTransition: 'slide',
					    icon: 'success',
					    hideAfter: 2000
					})
        	}else if(data=='login'){
        		jQuery.toast({
					    heading: 'Login',
					    text: 'Please login to add item to wishlist',
					    showHideTransition: 'slide',
					    icon: 'warning',
					    hideAfter: 3500,

					})
        		jQuery('#wish_'+productId).removeClass('wishlistActive');
        	}else if(data=='removed'){
        		jQuery.toast({
					    heading: 'Removed from Wishlist',
					    text: 'Item has been removed from the wishlist',
					    showHideTransition: 'slide',
					    icon: 'success',
					    hideAfter: 2000
					})
        	}else{
        		jQuery.toast({
					    heading: 'Error',
					    text: 'Error while updating wishlist, Please try again!',
					    showHideTransition: 'slide',
					    icon: 'error',
					    hideAfter: 3500,

					})
        	}	
        }
    });
}
function removeFromWishlist(productId){
	jQuery.ajax
    ({
        type: "POST",
        url: APPURL+"ajxHandler.php",
        data: "action=removeFromWishlist&productId="+productId,
        success: function(data)
        {	
        	if(data=='removed'){
        		jQuery.toast({
					    heading: 'Success',
					    text: 'Item has been removed from the wishlist',
					    showHideTransition: 'slide',
					    icon: 'success',
					    hideAfter: 2000
					})
        		jQuery('#wishList_'+productId).css('display','none');
        	}else{
        		jQuery.toast({
					    heading: 'Error',
					    text: 'Error while deleting item, Please try again!',
					    showHideTransition: 'slide',
					    icon: 'error',
					    hideAfter: 3500,

					})
        	}	
        }
    });
}

jQuery( document ).ready(function() {
	jQuery('#coupon_form').on('submit', function(e){
		var couponcode = jQuery(this).find('[name=couponcode]').val();
		jQuery.ajax
            ({
                type: "POST",
                url: APPURL+"ajxHandler.php",
                data: "action=applyCouponCode&couponcode="+couponcode,
                dataType: 'json',
                success: function(data)
                {		
                	if(data.codestatus =='login'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'expired'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'invalid'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'notenoughammount'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'applied_to_total'){
                		jQuery("#couponMsg").css('font-weight','600');
                		jQuery("#couponMsg").css('color','#008542');
                		jQuery('#offerMsg').html('');
	                    jQuery('#discountAmt').html('');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html(data.discount);
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'item_not_incart'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                		
                	}else if(data.codestatus == 'already_used'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}                                
                }
            });
		return false;
	});

	if ( jQuery( ".couponCodeWrap" ).length ) {
		var couponcode = jQuery(this).find('[name=couponcode]').val();
		jQuery.ajax
            ({
                type: "POST",
                url: APPURL+"ajxHandler.php",
                data: "action=applyCouponCode&couponcode="+couponcode,
                dataType: 'json',
                success: function(data)
                {		
                	if(data.codestatus =='login'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'expired'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'invalid'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'notenoughammount'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'applied_to_total'){
                		jQuery("#couponMsg").css('font-weight','600');
                		jQuery("#couponMsg").css('color','#008542');
                		jQuery('#offerMsg').html('');
	                    jQuery('#discountAmt').html('');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html(data.discount);
                		jQuery('#totalPayable').html(data.totalpay);
                	}else if(data.codestatus == 'item_not_incart'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                		
                	}else if(data.codestatus == 'already_used'){
                		jQuery("#couponMsg").css('font-weight','400');
                		jQuery("#couponMsg").css('color','#D14836');
                		jQuery('#couponMsg').html(data.msg);
                		jQuery('#couponDiscount').html('');
                		jQuery('#totalPayable').html(data.totalpay);
                	}                                
                }
            });
		return false;
		
	}
});

function notifyUsers(productId){
	var notifyNumber= document.getElementById("notifyNumber_"+productId).value;
	jQuery.ajax
    ({
        type: "POST",
        url: APPURL+"ajxHandler.php",
        data: "action=notifyUsers&notifyNumber="+notifyNumber+"&notifyProductId="+productId,
        success: function(data)
        {	
        	if(data == 'success'){
        		jQuery('#notifybox_'+productId+' .modal-body .modalFormContent').css('display','none');
        		jQuery('#notifybox_'+productId+' .modal-body .modalMsgContent').html('<p class="text-center">We will notify you when stock is updated! </p>');
        	}else if(data == 'invalidphone'){
        		jQuery('#notifybox_'+productId+' .modal-body .modalMsgContent').html('<p class="text-center" style="color:#FE002D;">Enter valid 10 digit mobile number.</p>');
        	}else if(data =='alreadynotified'){
        		jQuery('#notifybox_'+productId+' .modal-body .modalFormContent').css('display','none');
        		jQuery('#notifybox_'+productId+' .modal-body .modalMsgContent').html('<p class="text-center" style="color:#EC961D;">You are already in the notifying list.</p>');
        	}

        	
        }
    });
    return false;
}
jQuery(document).ready(function($){
	$('#showOutofStockModal').click(function () {
	var cartIds = $(this).attr("data-id");
	jQuery.ajax
	    ({
	    	type: "POST",
	        url: APPURL+"ajxHandler.php",
	        data: "action=showOutofStockModal&cartIds="+cartIds,
	        success: function(data)
	        {	$('#cartItemsCatIds').val(cartIds);
	        	$('.modalMsgContent').html(data);
	        	$('#outofStockCartItems').modal('show');
	        	
	        },
	        error: function(){
	        	$('#outofStockCartItems').modal('show');
	        }
	    });
		
	});
    return false;
});	

function getShippingAddress(id){

	// alert(id);

	jQuery.ajax
	    ({
	    	type: "POST",
	        url: APPURL+"ajxHandler.php",
	        data: "action=getShippingAddress&id="+id,
	        success: function(data)
	        {	
	        	
	        },
	        
	    });

}

function getBillingAddress(id){
	// alert(id);
	jQuery.ajax
	    ({
	    	type: "POST",
	        url: APPURL+"ajxHandler.php",
	        data: "action=getBillingAddress&id="+id,
	        success: function(data)
	        {	
	        	
	        },
	        
	    });
}

function removeShippingAddress(id){

	jQuery.ajax
	    ({
	    	type: "POST",
	        url: APPURL+"ajxHandler.php",
	        data: "action=removeShippingAddress&id="+id,
	        success: function(data)
	        {	
	        	if(data=='success'){
	        		window.location = 'myaddresses.php';
	        	}
	        },
	        
	    });

}

function removeBillingAddress(id){

	jQuery.ajax
	    ({
	    	type: "POST",
	        url: APPURL+"ajxHandler.php",
	        data: "action=removeBillingAddress&id="+id,
	        success: function(data)
	        {	
	        	if(data=='success'){
	        		window.location = 'myaddresses.php';
	        	}
	        },
	        
	    });

}




function getProductOptionByAttr(productId,attributeId,attributeValueId){
	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=getProductOptionByAttr&productId="+productId+"&attributeId="+attributeId+"&attributeValueId="+attributeValueId,
		    success: function(msg)
		    {	
		    	$('#productOptionDetails').html(msg);
		    	// var msg = jQuery.trim(msg);
		    	// if(msg=='false'){	
		    	// 	$('#confirmorderError').html('Error while Proceeding to Payment, Please try again!');
		    	// }else{
		    	// 	window.location = 'payment.php?pay='+msg;
		    	// }		               
		    }
		});
}

function getProductAttributes(productId,attributeId,attributeValueId){
	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=getProductAttributes&productId="+productId+"&attributeId="+attributeId+"&attributeValueId="+attributeValueId,
		    success: function(msg)
		    {	
		   		$('#attrReturn').html(msg);
		    	//alert(msg);
		    	// var msg = jQuery.trim(msg);
		    	// if(msg=='false'){	
		    	// 	$('#confirmorderError').html('Error while Proceeding to Payment, Please try again!');
		    	// }else{
		    	// 	window.location = 'payment.php?pay='+msg;
		    	// }		               
		    }
		});
}
// $(document).ready(function() {
// 	var attrVal = '';
// 	var attrId = '';
// 	var attrCount = '';
// 	var position = '';
// 	var productId ='';
// 	var attributeValueId='';
// 	var nextPos=1;
// 	var attrIds = new Array();
// 	var attrValIds = new Array();
// 	$(".selectAttOpt").on("change", function(){

// 		attrId = $(this).data("attribute");
// 		attrCount = $(this).data("attrcount");
// 		position = $(this).data("position");
// 		productId = $(this).data("product");
// 		attributeValueId = $(this).val();
// 		nextPos = position+1;
// 		for (i = position; i < attrCount; i++) { 
// 			jQuery.ajax
// 			({
// 			    type: "POST",
// 			    url: APPURL+"ajaxHandler.php",
// 			    data: "action=getProductNextAttribute&productId="+productId+"&attributeId="+attrId+"&attributeValueId="+attributeValueId+"&nextPos="+nextPos+"&attrCount="+attrCount,
// 			    success: function(msg)
// 			    {	
// 			    	// $('.selectAttOpt').each(function(){
// 			    	// 	attrIds.push($(this).data("attribute"));
// 			    	// 	attrValIds.push($(this).val());
// 			    	// 	alert(attrValIds);
// 			    	// });
// 			    	//getProductOptionByAttr(productId,attrIds,attrValIds);
// 			   		$('#productAtt_'+nextPos).html(msg);			    		               
// 			    }
// 			});
// 		}

		
// 		//alert('hello');
// 		// $('.selectAttOpt').each(function(){
// 		// 	attrVal = $(this).val();
// 		// 	attrId = $(this).data("attribute");
// 		// 	alert(attrVal);
// 		// 	alert(attrId);
// 		// });
// 	});
// });	


function getProductNextAttribute(productId,attr,position,attrCount,attributeValueId,attributeIds){
	$('.productAttributes').append('<div class="loader"><img src="images/loading.gif" style="left: 45%;top:50%;position: absolute;width: auto;" /></div>');
	//return false;

	var attrIds = new Array();
	var attrValIds = new Array();
	var attributeId = attr;
	var iterationCount = 0;
	for(i = position; i <= attrCount; i++) { 
		(function(i){
        setTimeout(function(){
		position = parseInt(position)+1;
			jQuery.ajax
			({
				type: "POST",
			    url: APPURL+"ajxHandler.php",
			    data: "action=getProductNextAttribute&productId="+productId+"&attributeId="+attributeId+"&attributeValueId="+attributeValueId+"&nextPos="+position+"&attrCount="+attrCount+"&attributeIds="+attributeIds,
			    success: function(msg)
			    {	
			    	//alert(msg);
			    	$('.productAttributes .loader').remove();
			    	$('#productAtt_'+position).html(msg);
					attributeId = $('#productAttSel_'+position).data("attribute");
			   		attributeValueId = $('#productAttSel_'+position).val();
			   		$('.selectAttOpt').each(function(){
					 	attrIds.push($(this).data("attribute"));
					 	attrValIds.push($(this).val());					 	
					});
					iterationCount = position;
					if(iterationCount >= attrCount){
						getProductOptionByAttr(productId,attrIds,attrValIds);
					 }
			   	}
			});
			
		}, 1000 * i);
    }(i));
  }	
 
 	//  $('.selectAttOpt').each(function(){
	// 	attrIds.push($(this).data("attribute"));
	// 	attrValIds.push($(this).val());
	// 	console.log(attrValIds);
	// });
}

function getProductCostByOptionId(ele, id){
	 var productStock = $('#productOptionId_'+id).find(':selected').attr('data-stock');
	//alert(productStock);
	jQuery.ajax
		({
		    type: "POST",
		    url: APPURL+"ajxHandler.php",
		    data: "action=getProductCostByOptionId&productId="+id+"&productOptionId="+ele.value+"&productStock="+productStock,
		    success: function(msg)
		    {	
			   	 if(msg){
			   	 	jQuery('.itemPrice_'+id).html(msg);
			   	 }		     
		    }
		});
}