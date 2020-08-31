$(document).ready( function() { $("body").on("click", "#refreshimg", function(){ $.post("captcha/newsession.php"); $("#captchaimage").load("captcha/image_req.php"); return false; }); });

$(document).ready( function() {

  $('#contactForm').validate({

        rules: {
            name: {
                required: true,                                          
            },

            phone:{
              required:true,
              number: true
            },

           
            email: {  
                required:true,              
                 email: true,                                        
            },

            message: {
                required: true,                                          
            },

            captcha: {
              required: true,
              remote: "captcha/process.php"
            }

        },
        messages: {

            name: "Please enter your name",    
            phone:{
              required: "Please enter your mobile number",            
              number: "Please enter a valid mobile number"
            },
           
            email: {
             required: "Please enter your email address",
             email: "Enter a valid email address",    
            },

            message: "Please enter the comment",

            captcha: "Invalid security code, please try again"
            
        },

        errorPlacement: function(error, element) {
            if (element.attr("name") == "interestedIn[]") {
                error.insertAfter("#interestedInId");
            } else if (element.attr("name") == "captcha") {
                error.insertAfter("#captchaError");
            } else {
                error.insertAfter(element);
            }
        }
                
  });

    
});

