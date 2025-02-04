<?php 

use classes\CronJob\CronJobController as CronJobController;
use classes\Utility\Mailer as Mailer;
use classes\User\UserController as UserController;

date_default_timezone_set("America/Toronto");



require_once "Autoloader.inc.php";
require_once "PHPMailer-5.2-stable/PHPMailerAutoload.php";

if (session_status() !== PHP_SESSION_ACTIVE) session_start();


$cron = new CronJobController();
$datarow = $cron->getUsersSignedAgo();
var_dump($datarow);
foreach($datarow as $row){
    $userID = $row['userID'];
    $email = $row['email']; // $email = "marisha17012001@gmail.com"; 
    $pin = $row['pin_status'];
    $name = $row['name'];
    $which_email = $row['email'];

    //$mailer = new Mailer($email);
    //$mailer->sendPINinfoToNewUsers($which_email, $name, $userID);
    sendPINinfoToNewUsers($email, $which_email, $name, $userID);

}


function sendPINinfoToNewUsers($email, $which_email, $name, $userID){

    // $HTTP_URL = getenv("HTTP_URL");
    // $HTTP_MEDIA_LOGOS = getenv("HTTP_MEDIA_LOGOS");

    $HTTP_URL = "https://v2.imatr.org";
    $HTTP_MEDIA_LOGOS = "https://media.imatr.org/imatr/logos/";

    // $_SERVER['HTTP_URL'] = "https://v2.imatr.org/";
    // $_SERVER['HTTP_MEDIA_LOGOS'] = "https://media.imatr.org/imatr/logos/";

    $staff = "";
    $subject = "Politician Access"; 
    $message = "";
    $message .= '<!doctype html>
                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                <title>Politician Access</title>
                <!--[if !mso]><!-- --> 
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <!--<![endif]--> 
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <style type="text/css"> span.productOldPrice { color: #A0131C; text-decoration: line-through;} #outlook a { padding: 0; } body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } p { display: block; margin: 13px 0; } </style>
                <!--[if mso]> 
                <xml>
                <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
                </xml>
                <![endif]--> <!--[if lte mso 11]> 
                <style type="text/css"> .outlook-group-fix { width:100% !important; } </style>
                <![endif]--> <!--[if !mso]><!--> 
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700" rel="stylesheet" type="text/css">
                <style type="text/css"> @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700); </style>
                <!--<![endif]--> 
                <style type="text/css"> @media only screen and (min-width:480px) { .column-per-100 { width: 100% !important; max-width: 100%; } .column-per-25 { width: 25% !important; max-width: 25%; } .column-per-75 { width: 75% !important; max-width: 75%; } .column-per-48-4 { width: 48.4% !important; max-width: 48.4%; } .column-per-50 { width: 50% !important; max-width: 50%; } } </style>
                <style type="text/css"> @media only screen and (max-width:480px) { table.full-width-mobile { width: 100% !important; } td.full-width-mobile { width: auto !important; } } noinput.menu-checkbox { display: block !important; max-height: none !important; visibility: visible !important; } @media only screen and (max-width:480px) { .menu-checkbox[type="checkbox"]~.inline-links { display: none !important; } .menu-checkbox[type="checkbox"]:checked~.inline-links, .menu-checkbox[type="checkbox"]~.menu-trigger { display: block !important; max-width: none !important; max-height: none !important; font-size: inherit !important; } .menu-checkbox[type="checkbox"]~.inline-links>a { display: block !important; } .menu-checkbox[type="checkbox"]:checked~.menu-trigger .menu-icon-close { display: block !important; } .menu-checkbox[type="checkbox"]:checked~.menu-trigger .menu-icon-open { display: none !important; } } </style>
                <style type="text/css"> @media only screen and (min-width:481px) { .products-list-table img { width: 120px !important; display: block; } .products-list-table .image-column { width: 20% !important; } } a { color: #000; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } </style>
                </head>
                <body style="background-color:#FFFFFF;">
                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #FFFFFF;">
                <!-- Body Wrapper --> <!--[if mso | IE]> 
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="body-wrapper-outlook" style="width:600px;" width="600" >
                <tr>
                <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]--> 
                <div class="body-wrapper" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding-bottom: 20px; box-shadow: 0 4px 10px #ddd; background: #F2F2F2; background-color: #F2F2F2; margin: 0px auto; max-width: 600px; margin-bottom: 10px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F2F2F2;background-color:#F2F2F2;width:100%;">
                <tbody>
                <tr>
                <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 10px 20px; text-align: center;" align="center">
                <!--[if mso | IE]> 
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <![endif]--> <!-- Pre-Headers --> <!--[if mso | IE]> 
                <tr>
                <td class="pre-header-outlook" width="600px" >
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="pre-header-outlook" style="width:560px;" width="560" >
                <tr>
                <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]--> 
                <div class="pre-header" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; height: 1px; overflow: hidden; margin: 0px auto; max-width: 560px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
                            <!--[if mso | IE]> 
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="" style="vertical-align:top;width:560px;" >
                                        <![endif]--> 
                                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                            <tr>
                                                <td align="center" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
                                                    <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 1px; font-weight: 400; line-height: 0; text-align: center; color: #F2F2F2;"></div>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <!--[if mso | IE]> 
                                    </td>
                                </tr>
                            </table>
                            <![endif]--> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!--[if mso | IE]> 
                </td>
                </tr>
                </table>
                </td>
                </tr>
                <![endif]--> <!-- header --> <!--[if mso | IE]> 
                <tr>
                <td class="header-outlook" width="600px" >
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="header-outlook" style="width:560px;" width="560" >
                <tr>
                <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]--> 
                <div class="header" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; line-height: 22px; padding: 15px 0; margin: 0px auto; max-width: 560px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
                            <!--[if mso | IE]> 
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <![endif]--> <!-- LOGO --> <!--[if mso | IE]> 
                                    <td class="" style="vertical-align:middle;width:140px;" >
                                        <![endif]--> 
                                        <div class="column-per-25 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: middle; width: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
                                            <tr>
                                                <td align="center" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;width: 160px;" width="160"> 
                                                            
                                                            
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <!--[if mso | IE]> 
                                    </td>
                                    <![endif]--> <!-- Navigation Bar --> <!--[if mso | IE]> 
                                    <td class="navigation-bar-outlook" style="vertical-align:middle;width:420px;" >
                                        <![endif]--> 
                                        <div class="column-per-75 outlook-group-fix navigation-bar" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: middle; width: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
                                            <tr>
                                                <td align="right" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; text-align: right; font-size: 0px; word-break: break-word;">
                                                    <div class="inline-links" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;">
                                                    <!--[if mso | IE]> 
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tr>
                                                            <td style="padding:15px 10px;" class="" >
                                                                <![endif]--> <a class="link" href="'. $HTTP_URL.'/login.php" target="_blank" style="display: inline-block; color: #808080; font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 13px; font-weight: bold; line-height: 22px; text-decoration: none; text-transform: none; padding: 0 10px;"></a> <!--[if mso | IE]> 
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <![endif]--> 
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <!--[if mso | IE]> 
                                    </td>
                                </tr>
                            </table>
                            <![endif]--> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!--[if mso | IE]> 
                </td>
                </tr>
                </table>
                </td>
                </tr>
                <![endif]--> <!-- notice --> <!--[if mso | IE]> 
                <tr>
                <td class="notice-wrap-outlook margin-bottom-outlook" width="600px" >
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="notice-wrap-outlook margin-bottom-outlook" style="width:560px;" width="560" >
                <tr>
                <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <![endif]--> 
                <div class="notice-wrap margin-bottom" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; margin: 0px auto; max-width: 560px; margin-bottom: 15px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
                            <!--[if mso | IE]> 
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="" style="vertical-align:top;width:560px;" >
                                        <![endif]--> 
                                        <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="background-color:white">
                                            <tbody>
                                                <tr><td>
                                                <a href="'. $HTTP_URL.'" target="_blank" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding: 0 10px;"> <img alt="iMatr" height="auto" src="'.$_SERVER['HTTP_MEDIA_LOGOS'].'v2/iMatrLogo250.png" style="padding-left: 25px; padding-top: 25px; border:0;display:block;outline:none;text-decoration:none;height:auto;width:40%;font-size:13px;"> </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #ffffff; border-radius: 10px; vertical-align: top; padding: 30px 25px;" bgcolor="#ffffff" valign="top">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style width="100%">
                                                        <tr>
                                                            <td align="left" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
                                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 26px; font-weight: bold; line-height: 30px; text-align: left; color: #4F4F4F;">Politician Access</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
                                                                <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align: left; color: #4F4F4F;"><br> 
                                                                    Hello '.$name.',<br><br>
                                                                    We noticed you signed up but haven\'t yet requested your PIN.<br><br>
                                                                    A PIN (Personal Identification Number) is unique to each user and is mailed to your home address for verification. This ensures you are a real constituent in a politician\'s ward or riding, preventing bot or troll interference in our democracy.<br><br>
                                                                    With your verified PIN, you can use our contact engine to reach out to politicians easily. The contact engine offers two main tools:<br><br>
                                                                        1.     Share: Automatically email a politician with your supported position on an issue. This lets politicians know who and how many people support a particular issue.<br><br>
                                                                        2.     Ask: Automatically email a politician to request their position on a selected issue.<br><br>
                                                                    To unlock your ability to contact politicians, please enter your address by clicking on "GET PIN" in <a href="'.$HTTP_URL.'" target="_blank" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding: 0 0px;">your account.</a><br><br>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        
                                                        
                                                    </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                        <!--[if mso | IE]> 
                                    </td>
                                </tr>
                            </table>
                            <![endif]--> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <!--[if mso | IE]> 
                </td>
                </tr>
                </table>
                </td>
                </tr>
                <![endif]--> 
                
                <!--[if mso | IE]> 
                </table>
                <![endif]--> 
                </td>
                </tr>
                </tbody>
                </table>
                </div>
                <!--[if mso | IE]> 
                </td>
                </tr>
                </table>
                <![endif]--> <!-- footer start --> <!-- Footer Wrapper -->
                <div class="footer-wrapper" style="margin: 0px auto; max-width: 600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; width: 100%;" width="100%" bgcolor="#FFFFFF">
                <tbody>
                <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                <!--[if mso | IE]>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <![endif]-->
                <!-- footer information -->
                <!--[if mso | IE]>
                <tr>
                <td class="footer-information-outlook" width="600px">
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="footer-information-outlook" style="width:600px;" width="600">
                    <tr>
                        <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                            <![endif]--> 
                            <div class="footer-information" style="margin:0px auto;max-width:600px;">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; width: 100%;" width="100%" bgcolor="#FFFFFF">
                                <tbody>
                                    <tr>
                                        <td style="direction:ltr;font-size:0px;padding:0px;text-align:center;">
                                        <!--[if mso | IE]>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="" style="vertical-align:top;width:600px;">
                                                    <![endif]-->
                                                    <div class="column-per-100 outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; vertical-align: top;" width="100%" valign="top" bgcolor="#FFFFFF">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                                <div style="font-family:OpenSans, Helvetica, Tahoma, Arial, sans-serif;font-size:12px;font-weight:400;line-height:20px;text-align:center;color:#4F4F4F;">
                                                                    
                                                                    <br /> &copy; '.Date('Y').' iMatr Canada inc.
                                                                    <br />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                    <!--[if mso | IE]>
                                                </td>
                                            </tr>
                                        </table>
                                        <![endif]-->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <!--[if mso | IE]>
                        </td>
                    </tr>
                </table>
                </td>
                </tr>
                <![endif]-->
                <!-- footer logo -->
                <!--[if mso | IE]>
                </table>
                <![endif]-->
                </td>
                </tr>
                </tbody>
                </table>
                </div>
                <!-- footer end --> 
                </div>
                </body>
                </html>
    ';
    $from = "iMatr Canada"; 
    $reply = "Dom";

    senditEmail($staff, $subject, $message, $from, $reply, $email);
}


function senditEmail($staff, $subject, $message, $from, $reply, $email) {
    $mail = new PHPMailer(true); 
    try {
        $mail->IsSMTP(); 
        //$mail->isHTML(true);
        $mail->SMTPDebug  = 3;
        $mail->Debugoutput = 'html';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // $mail->addCustomHeader('X-CSID', 1234567890123);
        $mail->Encoding = "base64";
        $mail->SMTPAuth = true;
        $mail->Host = "192.99.187.211";
        $mail->Port = 587;
        $mail->Username = "dom@mail.imatr.org";
        $mail->Password = '2eZyTBmWzTTYnVQUIgqG';
        $mail->SetFrom("contact@mail.imatr.org", $from);
        $mail->AddReplyTo("contact@mail.imatr.org", $reply);
        $mail->SMTPSecure = 'SSL'; 
        //$mail->AddEmbeddedImage($_SERVER['HTTP_MEDIA_LOGOS'] . '/imatrlogo75H2.png', 'logo');          
        
        $mail->AddAddress($email);
        
        if (!empty($staff)){
            
            $mail->addCC($staff); 

        }
    //	$mail->addCC("kutjack@gmail.com");
         $mail->addCC("marisha17012001@gmail.com");

        $mail->Subject    = $subject;
        //$mail->AddEmbeddedImage($_SERVER['HTTP_MEDIA_LOGOS'] .'v2/iMatrlogonav.jpg', 'logo'); 
        $mail->MsgHTML($message);
        
        //$mail->send();
            if($mail->send()){
                return 'Success';
            }else {
                // return 'failure';
                // echo 'fail';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
    
        } catch (\Exception $e) { //The leading slash means the Global PHP Exception class will be caught
        echo $e->getMessage(); //Boring error messages from anything else!
    }
   
}