<?php 
	
    
    require_once('Autoloader.inc.php');

	use classes\Issue\IssueView as IssueView;
	
    
	
	date_default_timezone_set("America/Toronto");
	$dtime=date("Y-m-d H:i:s");
	$tstamp=strtotime($dtime);
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iMatr</title>
	<link href="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>css/fontawesome-all.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>css/iofrm-style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>css/iofrm-theme5.css" rel="stylesheet" type="text/css">
	
</head>
<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="index.php">
                <div>
                    <img class="logo-size" src="<?php echo $_SERVER['HTTP_MEDIA_IMAGES']  ;?>iMatr_Logo_80.png" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
				<div class="info-holder">
                    <img src="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>images/graphic2.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div id="validation_popper" class="success alert" style="display:none">
							<div class="content">
							<div class="icon">
								<svg height="50" viewBox="0 0 512 512" width="50" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" d="M449.07,399.08,278.64,82.58c-12.08-22.44-44.26-22.44-56.35,0L51.87,399.08A32,32,0,0,0,80,446.25H420.89A32,32,0,0,0,449.07,399.08Zm-198.6-1.83a20,20,0,1,1,20-20A20,20,0,0,1,250.47,397.25ZM272.19,196.1l-5.74,122a16,16,0,0,1-32,0l-5.74-121.95v0a21.73,21.73,0,0,1,21.5-22.69h.21a21.74,21.74,0,0,1,21.73,22.7Z"/></svg>
							</div>
							<p id="message">Your reset link has been sent to the email you provided below.</p>
							</div>
							<button class="close">
							<svg height="18px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#69727D" d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/></svg>
							</button>
						</div>
                        <h3>Password Reset</h3>
                        <p>By submitting your email, a link will be sent to your email address to enable you to create your new password.</p>
                        <form>
                            <input class="form-control" type="text" id="email" name="email" placeholder="E-mail Address" required>
                            <div class="form-button full-width">
                                <button  onclick="sendResetEmail()" id="submit" type="submit" class="ibtn btn-forget">Send Reset Link</button>
                            </div>
                        </form>
                        <div class="other-links" >
                            <span >  <a href="index.php" style="font-size:1.3em">Home  </a> | <a href="register.php" style="font-size:1.3em; padding-left:1em"> Register</a></span>
                        </div>
                    </div>
                    <div class="form-sent">
                        <div class="tick-holder">
                            <div class="tick-icon"></div>
                        </div>
                        <h3>Password link sent</h3>
                        <p id="show_email"> </p>
                        <div class="info-holder">
                            <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>js/jquery.min.js"></script>
<script src="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>js/popper.min.js"></script>
<script src="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>js/bootstrap.min.js"></script>
<script src="<?php echo $_SERVER['IOFORM_TEMPLATE_PATH']  ;?>js/main.js"></script>

<script>

    function closeMessage(){

        $("#errormsg").hide();

        }

        function sendResetEmail(){

            email = document.getElementById('email').value;
            //document.getElementById('show_email').value = "Please check your inbox: "+email;

            //alert(email);

            $.ajax({    
                type: "POST",
                url: "includes/login.inc.php",             
                data: {type:"resetemail", email:email},
                dataType: "json",                  
                success: function(data){   
                    
                    var urllink =  data.url; 
                    var validation_status = data.status;
                    // var user_id = data.user_id;
                    // var token = data.token;
                   
                    $("#show_email").html("Please check your inbox: "+email);
                    sendResetMail(email, data.url);

                
                
                    
                },
                // complete: function(){
                //     //send registraion confirmation emails 
                   
                // },
                error: function(error){
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();                 
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
                    
                },
            });



        }

        function sendResetMail (email, url){

            // alert('email'+email);
            // alert('url'+url);

            $.ajax({    
                type: "POST",
                url: "includes/login.inc.php",             
                data: {type:'sendresetemail',  email:email, url:url},
                dataType: "html",                  
                success: function(data){   
                    

                    
                
                },
                error: function(error){
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();                 
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
                    
                },
            });

        }

       

</script>


</body>
</html>	



