<?php

require_once('Autoloader.inc.php');

date_default_timezone_set("America/Toronto");
$dtime = date("Y-m-d H:i:s");
$tstamp = strtotime($dtime);


?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . $_SERVER['CASSIE_TEMPLATE_PATH'] . 'head_login.php');

?>
<script></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<body>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            transition: background-color 600000s 0s, color 600000s 0s;
        }

        .content {
            margin: 0px !important;
        }

        .contact-us .form {
            text-align: center;
            display: inline-block;
            background: #fff;
            border: solid 1px #dfdfdf;
            padding: 27px;
        }

        .contact-us .textarea textarea {
            width: 100%;
            border: solid 1px #d2d2d2;
            height: 236px;
            text-transform: uppercase;
            font-size: 15px;
            color: #828282;
            margin: 0 0 15px 0;
            padding: 15px;
        }

        .contact-us .textarea {
            width: 100%;
        }

        .contact-us .fields input[type=text] {
            width: 100%;
            border: solid 1px #d2d2d2;
            height: 56px;
            font-size: 15px;
            color: #828282;
            margin: 0 0 15px 0;
            padding: 0 15px;
        }

        .contact-us .fields {
            width: 49%;
            float: left;
            margin: 0 15px 0 0;
        }

        .contact-us .textarea textarea {
            width: 100%;
            border: solid 1px #d2d2d2;
            height: 236px;
            text-transform: uppercase;
            font-size: 15px;
            color: #828282;
            margin: 0 0 15px 0;
            padding: 15px;
        }

        .contact-us .fields.last {
            margin: 0 0 0 0;
        }

        .contact-us {
            text-align: center;
        }

        .contact-us h3 {
            text-align: left;
        }

        .contact-us .form h3 {
            margin: 0 0 25px 0;
        }

        .contact-us input[type=submit] {
            text-transform: uppercase;
            font-size: 16px;
            color: #fff;
            margin: 0 0 15px 0;
            padding: 0 15px;
            background: #333333;
            border: none;
            padding: 12px 32px;
            float: left;
        }

        .contact-us p {

            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 18px !important;
            line-height: 27px;
        }

        .contact-us p,
        ul,
        ol {
            margin: 20px 0 20px 0 !important;
        }

        .contact-us li {
            list-style: none;
        }




        .indent {
            padding-left: 1em !important;
            background-color: #fff;
        }

        .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            padding: 10px;
            color: green;
            min-width: 50px;
            text-align: center;
            float: right;
        }

        .input-field {

            width: 100%;
            padding: 10px 15px;
            text-align: center;
        }

        h2 {
            /* color: green; */
        }

        .form-control {
            padding: 0.437rem 1.75rem 0.437rem 0.75rem !important;
        }

        .highlighter {
            border: solid 3px #02538b85;
            opacity: 80%;
            box-shadow: 0 0 5px #b1b1b1;
        }

        @media only screen and (max-width: 767px) {


            #popover-email {
                float: left !important;
            }

            #popover-cpassword {
                /* float: left !important; */
            }
        }


        @media only screen and (min-width: 1079px) {

            #emailadd,
            #confirmpass {
                padding-left: 0px;
            }

        }
    </style>
    <!-- <link href="<?php echo $_SERVER['MAG_TEMPLATE_PATH']; ?>css/fajar.css?version=3.1" rel="stylesheet" type="text/css"> -->

    <!-- <link href="<?php echo $_SERVER['MAG_TEMPLATE_PATH']; ?>css/topbar.css" rel="stylesheet" type="text/css"><div class="signup-panel"> -->

    <div class="bg">
        <img src="<?php echo $_SERVER['CASSIE_TEMPLATE_PATH']; ?>assets/img/login.jpg">
    </div>

    <div class="signup-sidebar">
        <div id="dpSidebarBody" class="signup-sidebar-body">
            <a href="index.php" class="sidebar-logo mg-b-40"><img src="<?php echo $_SERVER['HTTP_MEDIA_LOGOS']; ?>v2/iMatrLogoEx.jpg" style="width: 150px !important;" class="responsive" alt=""></a>
            <h4 class="signup-title">Create New Account!</h4>
            <h5 class="signup-subtitle">It's free and only takes a minute.</h5>
            <div id="validation_popper" class="alert alert-outline alert-danger" role="alert" style="display: none">
                <span style="padding: 5px;" id="message_icon" class="material-icons-outlined notranslate">error_outline</span>
                <span id="message"></span>
            </div>
            <div id="validation_pop" class="alert alert-outline alert-danger" role="alert" style="display:none"> </div>

            <div class="signup-form">
                <div class="row">

                    <div class="col-sm-6" id="regas">
                        <div class="form-group">
                            <label>I want to register as a:</label>
                            <select id="user_type" onfocus="validation_pop('user_type')" class="custom-select" required>
                                <option value="" selected>Select User Type</option>
                                <option value="P">Canadian Citizen</option>
                                <option value="RPC">Registered Election Candidate</option>
                                <option value="OPC">Official Party Candidate</option>
                                <option value="C1">An Elected Politician</option>
                                <option value="C1">An Elected Trustee</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6" id="emailadd">
                        <div class="form-group">
                            <label>Email address</label>
                            <span id="popover-email" class="block-help" style="float:right; display:none"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter an valid email address</span></label>
                            <input type="email" id="email" style=" opacity:90%;" name="email" class="form-control" value="">
                        </div>
                    </div><!-- col -->

                </div><!-- row -->

                <div class="row mg-b-5">

                    <div class="col-sm-6" id="pass">
                        <div class="form-group">

                            <label>Password <span id="check_pass" class="material-icons-outlined checker notranslate" hidden>check_circle_outline</span> </label>
                            <span id="popover-password-top" class="block-help" style="float:right; display:none">
                                <i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter a strong password</span>
                            <input id="password" type="password" class="form-control" placeholder="" value="">

                        </div>

                    </div><!-- col -->
                    <div class="col-sm-6" id="confirmpass">
                        <div class="form-group">
                            <label>Confirm Password <span id="check_cpass" class="material-icons-outlined checker notranslate" hidden>check_circle_outline</span> </label>

                            <input id="password_confirm" type="password" class="form-control" placeholder="" value="">
                        </div>
                    </div><!-- col -->
                    <span id="popover-cpassword" class="block-help" style="display: none;float:right"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Passwords don't match</span>

                </div><!-- row -->

                <a id="pass_text" style="display: block;" href="#" onclick="pswdVisibility()"> Show/Hide Password <span id="password_toggle" class="material-symbols-outlined checker checkereye notranslate">visibility</span></a>
                <br>
                <div class="g-recaptcha" data-sitekey="6LfNrJsUAAAAAFS9nVAQtJ_2JRhWe6g-wU0DLRCr"></div>

                <br>
                <div class="col-sm-12">
                    <div id="popover-password" style="display:none; border:solid 1px #b9bab9; padding:1em">

                        <p>Password Strength: <span id="result"> </span><br /></p>

                        <div class="progress">
                            <div id="password-strength" class="progress-bar-stripe progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            </div>
                        </div>
                        <ul class="list-unstyled">
                            <li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; A mixture of uppercase &amp; lowercase characters </li>
                            <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;At least 1 number (0-9)</li>
                            <li class=""><span class="one-special"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;At least 1 special character</li>

                            <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; A minimum of 8 characters</li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="form-group mg-b-30" id="termsnservice">

                <div class="custom-control custom-checkbox">
                    <input id="terms" type="checkbox" class="custom-control-input">
                    <label class="custom-control-label tx-sm" for="terms">I have read and agree to your <a href="#modal-page" uk-toggle onclick="getContentModal('terms', '2')">Terms of Use</a>
                        and <a href="#modal-page" onclick="getContentModal('privacy', 'nav')" uk-toggle>Privacy Policy</a></label>
                    <br> <span id="termserror" style="color: red; display: none;">You need to accept our Terms of Use and Privacy Policy!</span>
                </div>
            </div>
            <div>
                <div id="checkterm" class="form-group d-flex mg-b-0">
                    <button id="sign-up" style="pointer-events: none;margin-bottom: 10px;" onclick="Signup()" class="btn btn-brand-01 btn-uppercase btn-block">Create New Account</button>
                </div>
            </div>
            <!-- <div id="ordivider" class="divider-text mg-y-30">Or</div> -->

            <div class="d-flex flex-wrap">

                <a href="index.php" class="btn btn-white btn-uppercase flex-fill">Home</a>
                <a href="login.php" class="btn btn-white btn-uppercase flex-fill mg-l-10">Login</a>
              
            </div>
            <div class="d-flex flex-wrap">
                <a href="reset_sendmail.php" class="btn btn-white btn-uppercase flex-fill mg-t-10">Forgot Password</a>
            </div>
        </div>
        <!-- <p class="mg-t-auto mg-b-0 tx-color-03">Already have an account? <a href="page-signin.html">Signin</a></p> -->
    </div><!-- signup-sidebar-body -->
    </div><!-- signup-sidebar -->
    </div><!-- signup-panel -->


    <div id="modal-page" class="uk-modal" uk-modal>
        <div class="uk-modal-dialog  uk-width-1-1@s uk-width-1-1@m uk-width-3-4@l" style="
    
 border:solid 3px #000; background-color:#ffffff; width: 1308px;">
            <a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
            <div class="uk-grid-collapse uk-flex-middle" uk-grid>

                <div id="pagecontent" class="uk-padding-small" style="width: 100%;">

                </div>

            </div>
        </div>
    </div>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . $_SERVER['CASSIE_TEMPLATE_PATH'] . 'auth_scripts.php');
    ?>
    <script>
        $(function() {

            'use strict'

            feather.replace();

            new PerfectScrollbar('.signup-sidebar', {
                suppressScrollX: true
            });

        })


        $(document).ready(function() {


            //         async function successCallback(token){

            // const captchaResponse = grecaptcha.getResponse()

            // 	console.log(captchaResponse)

            // 	if(!captchaResponse.length > 0){
            //     throw new Error("Captcha Not Complete!")
            // }


            // const secret = "6Ld9TgQoAAAAAMwc5LNt4OQWbzbsn7Ks0E9MEZqP"

            //     // const response = await fetch("https://www.google.com/recaptcha/api/siteverify?secret="+ secret + "&response=" + token);

            //     // console.log(response)


            // }



            // function onLoadCallback(){
            // grecaptcha.render('divRecaptcha', {

            // sitekey: '6Ld9TgQoAAAAAJrjA5OBFhsC1j2PoYol0Mn311S8',
            // callback: successCallback,

            // })


            // };

            //   window.onLoadCallback = onLoadCallback;


            // terms = document.getElementById("checkterm")
            // signup = document.getElementById("sign-up")
            // checkbox = document.getElementById("terms")
            // termserror = document.getElementById("termserror")
            // console.log(terms)

            // document.getElementById("checkterm").addEventListener('click', function(e){


            //     if (checkbox.checked == false)
            //     {
            //         termserror.style.removeProperty('display');
            //         //console.log('hi')

            //     }
            // // event listener for checkbox
            // checkBox.addEventListener('click', function(e){
            //     signup.style.removeProperty('pointer-events');

            // })


            //             })

            // document.getElementById("sign-up").addEventListener('click', function(e){
            //     //console.log('hi')


            // })





            const queryString = window.location.search;

            const urlParams = new URLSearchParams(queryString);
            const logintype = urlParams.get('logintype');
            const code = urlParams.get('code');

            checkValidation();
            if (logintype == "student") {
                isIQedStudent(code);
            }
            //alert(logintype);

            $('#password_confirm').attr('disabled', true);
            $('#sign-up').attr('disabled', true);

            $('#user_type').change(function() {
                checkValidation();
            })

            $('#user_type').focus(function() {

                $('#user_type').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
                $('#popover-password').hide();
            });

            $('#user_type').blur(function() {
                checkValidation();
                if ($('#user_type').val() == 0) {
                    $('#popover-cnumber').removeClass('hide');
                    //$('#sign-up').attr('disabled', true);


                } else {
                    $('#popover-cnumber').addClass('hide');
                    //$('#sign-up').attr('disabled', false);
                    $('#user_type').attr('style', 'border-bottom: solid 3px #d9dfe7; ');
                }
            });

            $('#email').focus(function() {

                $('#email').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
                $('#popover-password').hide();
            });

            $('#email').blur(function() {
                checkValidation();
                var email = $('#email').val();
                //alert(IsEmail(email));
                if (IsEmail(email)) {
                    $('#popover-email').hide();
                    $('#email').attr('style', 'border-bottom: solid 3px #d9dfe7; ');

                } else {

                    //$('#sign-up').prop('disabled', true);

                    $('#email').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');

                    $('#popover-email').show();

                }
            });

            $('#password').focus(function() {
                $('#password_confirm').attr('style', 'border-bottom: solid 3px #d9dfe7; ');
                $('#password').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
            });

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
                // if ($('#password').val() !== $('#password_confirm').val()) {
                //     $('#popover-cpassword').show();
                //     $('#check_cpass').prop("hidden", true);
                // }
            });

            $('#password_confirm').focus(function() {
                $('#password').attr('style', 'border-bottom: solid 3px #d9dfe7; ');
                $('#password_confirm').attr('style', 'border: solid 3px #02538b85; opacity:80%; box-shadow: 0 0 5px #b1b1b1;');
            });

            $('#password_confirm').keyup(function() {
                checkValidation();
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

            checkBox = document.getElementById('terms');
            // Check if the element is selected/checked
            $('#terms').click(function() {
                checkValidation();
            });

            //Enable sign up if any conditions are true






            $('#sign-up').hover(function() {
                if ($('#sign-up').prop('disabled')) {
                    $('#sign-up').popover({
                        html: true,
                        trigger: 'hover',
                        placement: 'below',
                        offset: 20,
                        content: function() {
                            return $('#sign-up-popover').html();
                        }
                    });
                }
            });

            function checkValidation() {

                var terms = document.getElementById('terms');
                var password = $('#password').val();
                var email = $('#email').val();


                if (checkStrength(password) == false || $('#password').val() !== $('#password_confirm').val() || !IsEmail(email) || $('#user_type').val() == 0 || terms.checked == false) {
                    //alert("test");
                    $('#sign-up').attr('disabled', true);
                    $('#sign-up').html("PLEASE COMPLETE THE FORM");
                } else {
                    $('#sign-up').attr('style', 'pointer-events: unset; margin-bottom: 10px;')
                    $('#sign-up').prop('disabled', false);
                    $('#sign-up').html("CREATE NEW ACCOUNT");
                }


            }

            function isIQedStudent(code) {
                // alert(code);

                // $("#user_type").attr("placeholder", "Student");
                $("#user_type").val("P");
                $('#user_type').prop('disabled', true);
                $("#user_type  option:selected").text("Student");
            }

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return false;
                } else {
                    return true;
                }
            }

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
                    $('#password_confirm').attr('disabled', true);


                    $('#result').addClass('text-danger').text('Very Weak - Not Valid');
                    $('#password-strength').css('width', '10%');
                } else if (strength == 2 || strength == 3) {
                    $('#result').addClass('good');
                    $('#password-strength').removeClass('progress-bar-danger');
                    $('#password-strength').addClass('progress-bar-warning');
                    $('#result').addClass('text-warning').text('Weak - Not Valid')
                    $('#password-strength').css('width', '60%');
                    $('#check_pass').prop("hidden", true);
                    $('#password_confirm').attr('disabled', true);


                    return 'Weak'
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

        });
    </script>

    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . $_SERVER['CASSIE_TEMPLATE_PATH'] . 'auth_scripts.php');
    ?>

    <script>
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



        function validation_pop(msg_type) {



            switch (msg_type) {
                case 'email':
                    document.getElementById('email').value = '';
                    $('#password').attr('style', '');
                    $('#password_confirm').attr('style', '');
                    $('#email').attr('style', 'border: solid 3px #02538b85; opacity:50%');
                    msg = "Need to use a valid email address. Please note a confirmation will be sent to this email.";
                    $("#popper").show();
                    $("#popper").html(msg + "");
                    break;
                case 'password':
                    document.getElementById('password').value = '';
                    $('#email').attr('style', '');
                    $('#password_confirm').attr('style', '');
                    $('#password').attr('style', 'border: solid 3px #02538b85; opacity:50%');
                    break;
                case 'password_confirm':
                    document.getElementById('password_confirm').value = '';
                    $('#password').attr('style', '');
                    $('#email').attr('style', '');
                    $('#password_confirm').attr('style', 'border: solid 1px red');
                    msg = "We take cybersecurity seriously. Passwords must contain 8 - 14 characters, include letters and numbers only, and have at least one capital and small case letter. Please safeguard your password and never share it with anyone. ";
                    break;

                case 'user_type':
                    $('#password').attr('style', '');
                    $('#email').attr('style', '');
                    $('#password_confirm').attr('style', '');

                    msg = "Please select the option that represents who you are.";
                    $("#popper").show();
                    $("#popper").html(msg);
                    break;
                default:
                    // code block
            }





        }

        function Signup() {



            const queryString = window.location.search;

            const urlParams = new URLSearchParams(queryString);
            const logintype = urlParams.get('logintype');
            const code = urlParams.get('code');

            email = document.getElementById('email').value;

            password = document.getElementById('password').value;

            password_confirm = document.getElementById('password_confirm').value;

            ut = document.getElementById('user_type');

            utype = ut.options[ut.selectedIndex].value;

            console.log(utype)

            terms = document.getElementById('terms').checked;

            user_id = 0;

            checkbox = document.getElementById('terms')

            signup = document.getElementsByClassName('custom-control-input')

            gotchya = grecaptcha.getResponse();
            pass = true

            // console.log(gotchya)
            if (gotchya === undefined || gotchya === null || gotchya === "") {
                pass = false
            }



            // alert('user_id'+user_id);
            // alert('token'+token);
            if (pass == true) {


                // console.log(checkBox)
                //alert("code"+code);
                // alert("logintype"+logintype);
                $.ajax({
                    type: "POST",
                    url: "includes/signup.inc.php",
                    data: {
                        type: "register",
                        email: email,
                        password: password,
                        password_confirm: password_confirm,
                        utype: utype,
                        terms: terms,
                        logintype: logintype,
                        code: code
                    },
                    dataType: "json",
                    success: function(data) {

                        var message = data.message;
                        var validation_status = data.status;
                        var user_id = data.user_id;
                        var token = data.token;
                        var user_type = data.user_type;
                        var rep_id = data.rep_id;
                        // alert("rep_id"+rep_id);
                        // alert("token"+token);
                        // alert("user_type"+logintype);
                        // alert("user_id"+user_id);
                        $('#dpSidebarBody').scrollTop(0)

                        //$("#login_btn").hide();
                        if (validation_status == "fail") {
                            $("#validation_popper").show();
                            $('#validation_popper').attr('class', 'alert alert-outline alert-danger');
                            $('#validation_popper').attr('style', 'display: inline-flex');
                            $("#message").html(message);


                        } else {
                            $("#validation_popper").show();

                            if (validation_status == "opc") {
                                message = data.message
                            } else {
                                message = "You have successfully registered. A confirmation email has been sent to you. Please check your email to activate your account. If the email has not arrived in your inbox, please check your spam folder."
                            }
                            $('#validation_popper').attr('style', 'display: inline-flex');
                            $('#validation_popper').attr('class', 'alert alert-outline alert-success');
                            $("#message").html(message);
                            $('.signup-form').attr('style', 'display: none')
                            $('#sign-up').attr('style', 'display: none')
                            // $('#emailadd').attr('style', 'display: none')
                            // $('#pass').attr('style', 'display: none')
                            $('#ordivider').attr('style', 'display: none')
                            $('#termsnservice').attr('style', 'display: none')



                            sendRegistrationConfirmation(email, token, user_type); //should send token as well
                            // setCookie("registered", 'y');
                            // document.cookie = "registered=Y";
                            if (logintype == "student") {
                                //add record to iqed_student table

                                getClassData(user_id, code)

                            }
                        }






                    },
                    complete: function() {
                        //send registraion confirmation emails 
                        //alert("userid on complete: "+user_id);

                    },
                    error: function(error) {
                        console.log("Error:");
                        console.log(error);
                        $("#error").show();
                        $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: " + data);

                    },
                });


            } else {
                message = "You did not complete the captcha."
                $("#validation_popper").show();
                $('#validation_popper').attr('class', 'alert alert-outline alert-danger');
                $('#validation_popper').attr('style', 'display: inline-flex');
                $('#message').attr('style', 'display:flex; align-items: center;');


            }
            $("#message").html(message);
        }

        function getClassData(user_id, code) {
            // alert(user_id);
            // alert(code);
            $.ajax({
                type: "POST",
                url: "includes/signup.inc.php",
                data: {
                    type: 'getclass',
                    code: code
                },
                dataType: "json",
                success: function(data) {

                    school_id = data.school_id;
                    class_id = data.class_id;
                    school_address = data.school_address;
                    school_CTR = data.school_CTR;
                    school_PST = data.school_PST;
                    school_postal = data.school_postal;
                    school_coordinates = data.school_lat + ',' + data.school_lng;
                    school_lat = data.school_lat;
                    school_lng = data.school_lng;
                    // alert("school_id="+school_id);
                    // alert("class_id"+class_id);
                    // setCookiebyDuration("student", "true", 365, "days")

                    createStudentRecord(school_id, class_id, code, user_id, school_address, school_CTR, school_PST, school_postal, school_coordinates, school_lat, school_lng);

                },
                complete: function() {
                    //send registraion confirmation emails 
                    //alert("userid on complete: "+user_id);


                },
                error: function(error) {
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: " + data);

                },
            });


        }

        function createStudentRecord(school_id, class_id, code, user_id, school_address, school_CRT, school_PST, school_postal, school_coordinates, school_lat, school_lng) {

            $.ajax({
                type: "POST",
                url: "includes/signup.inc.php",
                data: {
                    type: 'addstudent',
                    code: code,
                    school_id: school_id,
                    class_id: class_id,
                    user_id: user_id,
                    school_address: school_address,
                    school_CRT: school_CRT,
                    school_PST: school_PST,
                    school_postal: school_postal,
                    school_coordinates: school_coordinates,
                    school_lat: school_lat,
                    school_lng: school_lng
                },
                dataType: "html",
                success: function(data) {

                    //create sweet alert function telliung the student to check his email	
                },
                complete: function() {


                },
                error: function(error) {
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: " + data);

                },
            });



        }

        function sendRegistrationConfirmation(email, token, user_type) {

            gotchya = grecaptcha.getResponse();
            // console.log(gotchya)
            $.ajax({
                type: "POST",
                url: "includes/mailer.inc.php",
                data: {
                    type: 'initial_registration',
                    email: email,
                    token: token,
                    user_type: user_type,
                    "g-recaptcha-response": gotchya
                },
                dataType: "html",
                success: function(data) {


                },
                error: function(error) {
                    console.log("Error:");
                    console.log(error);
                    $("#error").show();
                    $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: " + data);

                },
            });

        }

        //close popper
        // $(".close").click(function(){
        // 	$(this).parent().fadeOut();
        // });


        $(document).ready(function() {

            submit = document.getElementsByClassName('btn btn-brand-01 btn-uppercase btn-block')
            console.log(submit[0])

            $(".form-group d-flex mg-b-").on('click', function(e) {
                console.log('bye')
            })


            submit[0].addEventListener('click', function(e) {

            })

        })

        new google.translate.TranslateElement({
                                        pageLanguage: 'en',
                                        includedLanguages: 'en,fr',
                                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    }, 'google_translate_element2');

    </script>
    <!-- <script src="https://www.google.com/recaptcha/api.js?onload=onLoadCallback&render=explicit" async defer></script>  -->


</body>

</html>