<?php 
	
    
    require_once('Autoloader.inc.php');
   
	use classes\Issue\IssueView as IssueView;
	
	date_default_timezone_set("America/Toronto");
	$dtime=date("Y-m-d H:i:s");
	$tstamp=strtotime($dtime);

   
    // if (empty($selector) || empty($validator)){
    //     echo "Oops. something went wrong. Could not validate your request! Try to resend your email <a href='".$_SERVER['HTTP_URL']."/forgot_password.php'>again</a>";
    // } 
	

?>

<!DOCTYPE html>
<html lang="en">
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'head_login.php'); 
?>
	<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<body>

<div class="forgot-panel" style="background: url(<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']  ;?>assets/img/password.jpg);  background-repeat: no-repeat; background-size: 100vw;">
      <div class="forgot-body">
        
     
      </div>

      
    
      <div class="forgot-sidebar">
        <div class="forgot-sidebar-body">
       
            <a href="index.php" class="sidebar-logo mg-b-40"><img src="<?php echo $_SERVER['HTTP_MEDIA_LOGOS']  ;?>v2/iMatrLogoEx.jpg"   style="width: 150px !important;" class="responsive"  alt="" ></a>
            <h4 class="forgot-title">Reset Your Password</h4>
           

           
            <h5 id="statusmsg" class="forgot-subtitle">Enter your registered email address. We will send you a link to reset your password.</h5>
            <div id="validation_popper" class="alert alert-outline alert-danger"  role="alert" style="display: none;">
			  <span style="padding: 5px;" id="message_icon" class="material-icons-outlined notranslate">error_outline</span>
		  		<span id="message"></span>
            </div>
            <div id="validation_pop" class="alert alert-outline alert-danger" role="alert" style="display:none">	</div>
		 
          
           

            <div class="forgot-form mg-t-20">
                <div class="form-group">
                <label>Email address</label>
                <input id="email" type="text" class="form-control" placeholder="Enter your username/email address">
                </div>
            </div>
            <div class="form-group">
                <button onclick="resetPassword()" id="confirmreset" class="btn btn-block btn-brand-01 btn-uppercase">Send Code Verification</button>
            </div>
            <div class="form-group">
                <a href="login.php" class="btn btn-block btn-white btn-uppercase">Back to Login</a>
            </div>
            <div class="divider-text mg-y-30">Or</div>

<a id="home" href="index.php" class="btn btn-white btn-uppercase btn-block">HOME</a>
</div>
        </div>
      </div><!-- forgot-sidebar -->
    </div><!-- forgot-panel -->



	<script src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']  ;?>lib/feather-icons/feather.min.js"></script>
	<script src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']  ;?>lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']  ;?>lib/prismjs/prism.js"></script>

<script>

        function closeMessage(){

            $("#errormsg").hide();

        }

        function resetPassword(){

            email = document.getElementById('email').value;

            console.log(email)

            // if (email == "")
            // {
            //     swal.fire('You have not submitted an email!')
            // }

         

            $.ajax({    
                type: "POST",
                url: "includes/login.inc.php",             
                data: {type:"resetemail", email:email},
                dataType: "json",                  
                success: function(data){   
                    // console.log(data); 
                    // $("#alert").show(); 
                    // $("#alert").html(data);                 
                    //alert(data);
                    //debugging only
                    //$("#errormsg").show();
                   //$('#validation_popper').attr('class', 'alert alert-outline alert-success');
                    //$('#validation_popper').html('<span style="padding: 5px;" id="message_icon" class="material-icons-outlined">error_outline</span>Further instructions have been sent to your email in order for you to reset your password.')

               
                    $('#confirmreset').attr('style', 'display: none')
                   $('#email').val('')
                
                    var validation_status = data.status;
                    var message = data.message;
                    // alert(validation_status);
                    // alert(message);
                    if (validation_status == "pass"){


                        $("#validation_popper").show();
							
                            $("#validation_popper").show();
                            $('#validation_popper').attr('class', 'alert alert-outline alert-success'); 
                            $('#validation_popper').attr('style', 'display: inline-flex'); 
							$("#validation_popper").html('<span style="padding: 5px;" id="message_icon" class="material-icons-outlined notranslate">error_outline</span>' + message);



                        // $("#statusmsg").show();
                        // $("#statusmsg").html(message);
                      
                    }
                    
                },
                // complete: function(){
                //     //send registraion confirmation emails 
                //     //sendRegistrationConfirmation (email,  code);
                // },
                error: function(error){

                    $("#validation_popper").show();
							$('#validation_popper').attr('class', 'alert alert-outline alert-danger');  
                            $('#validation_popper').attr('style', 'display: inline-flex'); 
                            $('#validation_popper').html('<span style="padding: 5px;" id="message_icon" class="material-icons-outlined notranslate">error_outline</span><span style="padding-top:6px;">This is not a valid email address.</span>')
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();                 
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
                    
                },
            });



        }

        function sendEmail(email, urlstr){

            email = document.getElementById('email').value;

            //alert(urlstr);

            $.ajax({    
                type: "POST",
                url: "includes/login.inc.php",             
                data: {type:"sendresetemail", email:email, urlstr:urlstr},
                dataType: "json",                  
                success: function(data){   
                    // console.log(data); 
                    // $("#alert").show(); 
                    // $("#alert").html(data);                 
                    //alert(data);
                    //debugging only


                
                      
                    
                },
                // complete: function(){
                //     //send registraion confirmation emails 
                //     //sendRegistrationConfirmation (email,  code);
                // },
                error: function(error){
                    console.log("Error:");
                    console.log(error);

                    $("#validation_popper").show();
							$('#validation_popper').attr('class', 'alert alert-outline alert-danger'); 
                            $('#validation_popper').attr('style', 'display: inline-flex'); 
                            $("#message").html("Something went wrong. Please enter a valid email address.");
                    // $('#statusmsg').text("Something went wrong. Please enter a valid email address.")

                    // $("#error").show();                 
                    // $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
                    
                },
            });



        }
       
        new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element2');

</script>


</body>
</html>	



