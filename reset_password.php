<?php


require_once('Autoloader.inc.php');

use classes\Issue\IssueView as IssueView;

date_default_timezone_set("America/Toronto");
$dtime = date("Y-m-d H:i:s");
$tstamp = strtotime($dtime);

//Reset Password
$selector = $_GET["selector"];
$validator = $_GET["validator"];


if (empty($selector) || empty($validator)) {
    echo "Oops. something went wrong. Could not validate your request! Try to resend your email <a href='" . $_SERVER['HTTP_URL'] . "/forgot_password.php'>again</a>";
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . $_SERVER['CASSIE_TEMPLATE_PATH'] . 'head_login.php');
?>
	<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<style>
    .form-control {
        padding: 0.437rem 1.75rem 0.437rem 0.75rem !important;
    }
</style>

<body>

    <div class="forgot-panel" style="background: url(<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']; ?>assets/img/password.jpg);  background-repeat: no-repeat; background-size: 100vw;">
        <div class="forgot-body">


        </div>



        <div class="forgot-sidebar">
            <div class="forgot-sidebar-body">

                <a href="index.php" class="sidebar-logo mg-b-40"><img src="<?php echo $_SERVER['HTTP_MEDIA_LOGOS']; ?>v2/iMatrLogoEx.jpg" style="width: 200px !important;" class="responsive" alt=""></a>
                <h4 class="forgot-title">Create New Password</h4>
                <h5 class="forgot-subtitle">Enter your new password below.</h5>


                <div id="validation_popper" class="alert alert-outline alert-danger" role="alert" style="display: none">
                    <span style="padding: 5px;" id="message_icon" class="material-icons-outlined notranslate">error_outline</span>
                    <span id="message"></span>
                </div>
                <div id="errormsg" class="" style="display:none"></div>

                <div id="popover-password" style="display:none; border:solid 1px #b9bab9; padding:1em">

                    <p>Password Strength: <span id="result"> </span><br />

                    </p>

                    <div class="progress">
                        <div id="password-strength" class="progress-bar-striped progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        </div>
                    </div>
                    <br>
                    <ul class="list-unstyled" style="font-size:.9em">
                        <li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; A mixture of uppercase &amp; lowercase characters </li>
                        <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;At least 1 number (0-9)</li>
                        <li class=""><span class="one-special"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;At least 1 special character</li>
                        <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; A minimum of 8 characters</li>
                    </ul>
                </div>

                <div class="forgot-form mg-t-5">
                    <div class="form-group">
                        <label>Password <span id="check_pass" class="material-icons-outlined checker notranslate" hidden>check_box</span> </label>
                        <span id="popover-password-top" class="block-help" style="float:right; display:none">
                            <i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter a strong password</span>
                        <input id="password" type="password" class="form-control">
                    </div>
                </div>
                <div class="forgot-form mg-t-5">
                    <div class="form-group">
                        <label>Confirm Password <span id="check_cpass" class="material-icons-outlined checker notranslate" hidden>check_box</span> </label>
                        <span id="popover-cpassword" class="block-help" style="float:right"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Passwords don't match</span>

                        <input id="password_confirm" type="password" class="form-control">
                        <BR> <a id="pass_text" href="#" onclick="pswdVisibility()"> Show/Hide Password <span id="password_toggle" class="material-symbols-outlined checker checkereye notranslate">visibility</span></a>

                    </div>
                </div>


                <div id="popover-password" style="display:none; border:solid 1px #b9bab9; padding:1em">

                    <p>Password Strength: <span id="result"> </span><br /></p>

                    <div class="progress">
                        <div id="password-strength" class="progress-bar-stripe progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        </div>
                    </div>
                    <ul class="list-unstyled">
                        <li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; A mixture of uppercase &amp; lowercase characters </li>
                        <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;At least 1 number (0-9)</li>
                        <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; A minimum of 8 characters</li>
                    </ul>
                </div><br>





                <div class="form-group">
                    <button onclick="resetPassword()" id="savebutton" class="btn btn-block btn-brand-01 btn-uppercase">Save</button>
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



    <script src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']; ?>lib/feather-icons/feather.min.js"></script>
    <script src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']; ?>lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']; ?>lib/prismjs/prism.js"></script>

    <script>
        function checkValidation() {


            var password = $('#password').val();



            if (checkStrength(password) == false || $('#password').val() !== $('#password_confirm').val()) {
                //alert("test");
                $('#sign-up').attr('disabled', true);
                $('#sign-up').html("PLEASE COMPLETE THE FORM");
            } else {
                $('#sign-up').attr('style', 'pointer-events: unset')
                $('#sign-up').prop('disabled', false);
                $('#sign-up').html("CREATE NEW ACCOUNT");
            }


        }
        $(document).ready(function() {

            $('#password_confirm').attr('disabled', true);

            $('#password').keyup(function() {
                checkValidation();
                $('#popover-password').show();
                var password = $('#password').val();
                if (checkStrength(password) == false) {
                    //$('#sign-up').attr('disabled', true);
                    $('#password').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
                    $('#check_pass').prop("hidden", true);
                } else {
                    $('#password').attr('style', 'border-bottom: solid 3px #d9dfe7; ');


                }
                if ($('#password').val() !== $('#password_confirm').val()) {
                    $('#popover-cpassword').show();
                    $('#check_cpass').prop("hidden", true);
                }
            });

            $('#password').focus(function() {

                $('#password').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
            });

            $('#password').keyup(function() {

                $('#popover-password').show();
                var password = $('#password').val();
                if (checkStrength(password) == false) {
                    $('#sign-up').attr('disabled', true);
                    $('#password').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
                    $('#check_pass').prop("hidden", true);
                } else {
                    $('#password').attr('style', 'border-bottom: solid 3px #d9dfe7; ');


                }
                if ($('#password').val() !== $('#password_confirm').val()) {
                    $('#popover-cpassword').show();
                    $('#check_cpass').prop("hidden", true);
                }
            });

            $('#password_confirm').focus(function() {

                $('#password_confirm').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
            });

            $('#password_confirm').keyup(function() {
                if ($('#password').val() !== $('#password_confirm').val()) {
                    $('#popover-cpassword').show();
                    $('#password_confirm').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
                    $('#sign-up').attr('disabled', true);
                    $('#popover-password').hide();
                    $('#check_cpass').prop("hidden", true);

                } else {
                    $('#popover-cpassword').hide();
                    $('#password_confirm').attr('style', 'border-bottom: solid 3px #d9dfe7; ');
                    $('#check_cpass').prop("hidden", false);
                }
            });

            $('#user_type').focus(function() {

                $('#user_type').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
            });

            $('#user_type').blur(function() {
                if ($('#user_type').val() == 0) {
                    $('#popover-cnumber').removeClass('hide');
                    $('#sign-up').attr('disabled', true);
                } else {
                    $('#popover-cnumber').addClass('hide');
                    $('#sign-up').attr('disabled', false);
                }
            });

        });

        function pswdVisibility() {


            var pass = document.getElementById("password");
            var pass2 = document.getElementById("password_confirm");
            var icon = $('#password_toggle');
            icon.toggleClass('checkeryes');

            if (icon.hasClass('checkeryes')) {

                icon.text('visibility_off');

            } else {

                icon.text('visibility');

            }
            if (pass.type === "password") {

                pass.type = "text";

            } else {

                pass.type = "password";

            }

            if (pass2.type === "password") {

                pass2.type = "text";

            } else {

                pass2.type = "password";

            }
        };


        function checkStrength(password) {
            var strength = 0;


            //If password contains both lower and uppercase characters, increase strength value.
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                $('.low-upper-case').addClass('text-success');
                $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');


            } else {
                $('.low-upper-case').removeClass('text-success');
                $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has numbers and characters, increase strength value.
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
                strength += 1;
                $('.one-number').addClass('text-success');
                $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-number').removeClass('text-success');
                $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>/?]/)) {
                strength += 1;
                $('.one-special').addClass('text-success');
                $('.one-special i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-special').removeClass('text-success');
                $('.one-special i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            if (password.length > 7) {
                strength += 1;
                $('.eight-character').addClass('text-success');
                $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.eight-character').removeClass('text-success');
                $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');

            }

            // If value is less than 2

            if (strength < 2) {
                $('#result').removeClass()
                $('#password-strength').addClass('progress-bar-danger');
                $('#check_pass').prop("hidden", true);

                $('#result').addClass('text-danger').text('Very Weak - Not Valid');
                $('#password-strength').css('width', '10%');
                $('#password_confirm').attr('disabled', true);

            } else if (strength == 2 || strength == 3) {
                $('#result').addClass('good');
                $('#password-strength').removeClass('progress-bar-danger');
                $('#password-strength').addClass('progress-bar-warning');
                $('#result').addClass('text-warning').text('Weak - Not Valid')
                $('#password-strength').css('width', '60%');
                $('#check_pass').prop("hidden", true);
                $('#password_confirm').attr('disabled', true);


                return 'Week'
            } else if (strength == 4) {
                $('#result').removeClass()
                $('#result').addClass('strong');
                $('#password-strength').removeClass('progress-bar-warning');
                $('#password-strength').addClass('progress-bar-success');
                $('#result').addClass('text-success').text('Strong - Valid!');
                $('#password-strength').css('width', '100%');
                $('#check_pass').prop("hidden", false);
                $('#password_confirm').attr('disabled', false);
                return 'Strong'
            }

        }

        function closeMessage() {

            $("#errormsg").hide();

        }

        function resetPassword() {

            password = document.getElementById('password').value;
            password_confirm = document.getElementById('password_confirm').value;


            selector = "<?php echo $selector ?>";
            validator = "<?php echo $validator ?>";
            // password = document.getElementById('password').value;
            // password_confirm = document.getElementById('password_confirm').value;

            // alert(password);
            // alert(password_confirm);

            $.ajax({
                type: "POST",
                url: "includes/login.inc.php",
                data: {
                    type: "resetpassword",
                    selector: selector,
                    validator: validator,
                    password: password,
                    password_confirm: password_confirm
                },
                dataType: "json",
                success: function(data) {

                    var message = data.message;
                    var validation_status = data.status;



                    // alert("validation status="+validation_status);

                    if (validation_status == "fail") {
                        //alert("fail"); 
                        finalmsg = " <a href='reset_password.php?selector=" + selector + "&validator=" + validator + "'>Try Again</a>";
                        heading = "Sorry!";


                        $("#validation_popper").show();
                        $('#validation_popper').attr('style', 'display: inline-flex');
                        $("#message").html(message);
                        //$('#validation_popper').attr('class', 'alert alert-danger');  

                    } else if (validation_status == "pass") {

                        $("#validation_popper").show();
                        $('#validation_popper').attr('style', 'display: inline-flex');
                        $('#validation_popper').attr('class', 'alert alert-outline alert-success');
                        $("#message").html(message);
                        $('#password').val('')
                        $('#password_confirm').val('')
                        $(".forgot-form").attr("style", "display: none;")
                        $(".forgot-title").attr("style", "display: none;")
                        $(".forgot-subtitle").attr("style", "display: none;")
                        $("#savebutton").attr("style", "display: none;")
                        $("#popover-password").hide();


                    } else {


                        $("#validation_popper").show();
                        $('#validation_popper').attr('style', 'display: inline-flex');
                        $("#message").html(message);



                    }




                },

                error: function(error) {
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: " + data);

                },
            });



        }

        // function sendResetEmail(){

        //     email = document.getElementById('email').value;

        //     //alert(email);

        //     $.ajax({    
        //         type: "POST",
        //         url: "includes/login.inc.php",             
        //         data: {type:"resetemail", email:email},
        //         dataType: "json",                  
        //         success: function(data){   

        //             var message =  data.message; 
        //             var validation_status = data.status;
        //             var user_id = data.user_id;
        //             var token = data.token;

        //                 $("#validation_popper").show();
        //                 //message = " A password reset email has been sent to your email. Further instructions can be found in your email. "
        //                 $('#validation_popper').attr('class', 'info alert'); 
        //                 $("#message").html(message);
        //             // } else {
        //             //     //redirect to dashboard
        //             //     //window.location.href = "dashboard_teacher.php";
        //             // }




        //         },
        //         // complete: function(){
        //         //     //send registraion confirmation emails 
        //         //     //sendRegistrationConfirmation (email,  code);
        //         // },
        //         error: function(error){
        //             console.log("Error:");
        //             console.log(error);
        //             $("#error").show();                 
        //             $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 

        //         },
        //     });



        // }

        new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element2');
    </script>


</body>

</html>