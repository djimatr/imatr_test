<?php 
	
    
    require_once('Autoloader.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'head.php'); 
	

    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'topbar.php'); 
	

	use classes\Issue\IssueView as IssueView;
	
	
	



	// //include('../logger.php');
	// //include('logger_inf.php');
	
	// $_SESSION['next_action'] = 'D0';
	// $_SESSION['menu'] = 'M1';
	date_default_timezone_set("America/Toronto");
	$dat=date("Y-m-d H:i:s");
	$dats=strtotime($dat);

	$assignments = $_GET['assignments'] ?? 0;
	//$page =  $_GET['page']??0;

	//include('isloggedinxs.php');
	//$_SESSION['next_action'] = 'D0';
	//include('../logger.php');
	
	//echo "VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV".$_COOKIE["student"];;

?>
<!DOCTYPE html>
<style>
	html{overflow-y: scroll; /* Add the ability to scroll */}
	html ::-webkit-scrollbar {
    	display: none;
	}

		/*desktops*/
		@media only screen and (min-width: 1080px) {
			.hide_mobile_top_bar{
				display: none;
			}
			.Navi_Left_tablet{
				display: none;
			}
			.top_right_tablet{
				display: none;
			}
			
		}
		
		/*tablets*/
		@media only screen and (min-width: 768px) and (max-width: 1079px) {
			.hide_canadian_flag_on_mobile{
				display: none;
			}
			.hide_mobile_top_bar{
				display: none;
			}
			.Navi_Left_desktop{
				display: none;
			}
			.top_right_desktop{
				display: none;
			}
			
		}
		/*smartphones*/
		@media only screen and (max-width: 767px) {
			.hide_canadian_flag_on_mobile{
				display: none;
			}
			.Navi_Left_desktop{
				display: none;
			}
			.Navi_Left_tablet{
				display: none;
			}
			#modal-page{
				margin-top: 100px;
			}
			#oswaldimg{
				display: none;
			}
			#no-show{
				display: none;
			}
			#oswald{
				text-align: center;
				
			}
			
		}
		
		
	</style>
<body>
<!-- <div class='IQmaster' id='IQmaster' style='display:none'></div><div class='settings' id='settings' style='display:none'></div><div class='options' id='options' style='display:none'></div><div class='learnmore' id='learnmore' style='display:none; z-index:99999999999 !important'></div> -->
<div id="wrap">

 <style>
	/* .posts-style1 .post-sec img{ width:48%; float:left; }
	.posts-style1 .post-sec .detail{ background:#fff; padding: 16px 16px 0 16px;  float: right; border: solid 1px #dfdfdf;  width:52%;} */
	.post-sec {border: solid 1px #dfdfdf; }
	.posts-style1 .post-sec .detail{ border: solid 1px #fff;}
	.fbutton { border:none; float:left; color:#fff; font-family: 'univers_57_condensedregular'; text-transform:uppercase; padding:1rem 2.5rem; background:#333333; margin:6px 0 0 0;}
	.fbutton:hover{ background:#f4361e; transition: background-color 0.5s ease;}

			* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		}

		.blur {
        
        filter: blur(5px);
        -webkit-filter: blur(5px);
		pointer-events:none;
      	} 
		

		
		

 </style>   
 <script>

function getContentModal(content_id, content_type) {
		//alert('terms');
		 
		$('#pagecontent').empty();
		switch(content_id) {

			case "contribution":
				setCookiebyDuration('contribution_form', content_type , 30, "minutes");
				$('#pagecontent').load('pages/contributions.php');
                break;
			
			case "scope_profile":
				$('#pagecontent').load('pages/scope.php');
                //$output1 =  require_once("../pages/about_us.php");
                break;

			case "about":
				$('#pagecontent').load('pages/about_us.php');
                //$output1 =  require_once("../pages/about_us.php");
                break;
            case "faq_general":
				$('#pagecontent').load('pages/faq_1_general.php');
                //$faq1 = require_once("../pages/faq_1_general.php");
              
                break;
            case "faq_scope":
				$('#pagecontent').load('pages/faq_2_scope.php');
                //$faq2 = require_once("../pages/faq_2_scope.php");
                               
                break;
            case "faq_platform":
				$('#pagecontent').load('pages/faq_3_platform.php');
                //$faq3 = require_once("../pages/faq_3_platform.php");
                               
                break;
            case "faq_security":
				$('#pagecontent').load('pages/faq_4_security.php');
                // $faq4 = require_once("../pages/faq_4_security.php");
                               
                break;
            case "contact":
				$('#pagecontent').load('pages/contact_choices.php');
                // $contact = require_once("../pages/contact_choices.php");
                
                break;
            case "politicians":
				$('#pagecontent').load('pages/politicians.php');
                // $politician = require_once("../pages/politicians.php");
                
                break;
            case "myStats":
				$('#pagecontent').load('pages/myStats.php');
                // $myStats = require_once("../pages/myStats.php");
                
                break;    
            case "contactEngine":
				$('#pagecontent').load('pages/profile_start.php');
                // $myStats = require_once("../pages/profile_start.php");
                
                break;   
            case "basicProfile":
				$('#pagecontent').load('pages/basic_profile.phpp');
                // $myStats = require_once("../pages/basic_profile.php");
                
                break;  
            case "organizations":
				$('#pagecontent').load('pages/organizations.php');
                // $myStats = require_once("../pages/organizations.php");
                
                break;
            case "location_help":
				$('#pagecontent').load('pages/location_help.php');
                // $help_location = require_once("../pages/location_help.php");
                
                break;  
            case "shask":
				$('#pagecontent').load('pages/student_mode.php');
                // $help_location = require_once("../pages/shask.php");
               
                break;  
			case "student_mode":
				$('#pagecontent').load('pages/student_mode.php');
               
                break; 


			case "privacy_policy":
				$('#pagecontent').load('pages/privacy_policy.php');
               
                break; 

			case "brand_usage":
				$('#pagecontent').load('pages/brand_usage.php');
               
                break;
				case "discussion_policy":
				$('#pagecontent').load('pages/discussion_policy.php');
               
                break;
				case "scopeofview_terms":
				$('#pagecontent').load('pages/scopeofview_terms.php');
               
                break;
				case "activity_standards":
				$('#pagecontent').load('pages/activity_standards.php');
               
                break;
				case "service_terms":
				$('#pagecontent').load('pages/service_terms.php');
               
                break;
				case "advertising":
					
				$('#pagecontent').load('pages/advertising.php');
				
				$('#pagecontent').scrollTop(-100);
				
               
                break;
				case "commercial_terms":
				$('#pagecontent').load('pages/commercial_terms.php');
               
                break;
				case "media":
				$('#pagecontent').load('pages/media.php');
               
                break;
				case "privacy":
				$('#pagecontent').load('pages/privacypolicy.php');
               
                break;
				case "accuracy":
				$('#pagecontent').load('pages/accuracy.php');
               
                break;
				case "premiumServices":
				$('#pagecontent').load('pages/premiumServices.php');
               
                break;
				case "discsub":
				$('#pagecontent').load('pages/discSub.php');
               
                break;
				case "session":
				$('#pagecontent').load('pages/session.php');
               
                break;
				case "firstvisit":
				$('#pagecontent').load('pages/session.php');
               
                break;
				case "terms":
                        $('#pagecontent').load('pages/terms.php');
                       
                        break;
						
			case "brand_usage":
				$('#pagecontent').load('pages/brand_usage.php');
               
                break;
				case "discussion_policy":
				$('#pagecontent').load('pages/discussion_policy.php');
               
                break;
				case "scopeofview_terms":
				$('#pagecontent').load('pages/scopeofview_terms.php');
               
                break;
				case "activity_standards":
				$('#pagecontent').load('pages/activity_standards.php');
               
                break;
				case "service_terms":
				$('#pagecontent').load('pages/service_terms.php');
               
                break;
				
		}

		
		
	}






 </script>

 
 
 <section class="content main-content">
    <div class="container">
    	<div class="row">
            <div class="col-md-12">
				<div class="posts-style1 post-style">
						
					<!-- //hidden link to trigger content engine on page load if user profile is empty -->
					<a id="student_mode" href="#modal-page" onclick="getContentModal('student_mode', 'nav')" uk-toggle></a>
					<a id="ceauto" href="#modal-page" onclick="getModalPage('contactEngine', 'nav')" uk-toggle></a>
					<a id="shask" href="#modal-page" onclick="getModalPage('shask', 'nav')" uk-toggle></a>
						
				
						<!--<div id="iqposts">--><!-- IQPOSTS --><!--</div>-->
			        <h3 style="color: black !Important;"><i id="suggest" class="fa fa-balance-scale" aria-hidden="true"></i>  Terms of Use</h3>
			        <!--<img src='../logos/imatrlogo75.png'><br>-->
			        <!--<a href='https://testnet.imatr.org/index.php'>Home </a><br><br>-->
			        <p><small>Effective 2019-10-08</small></p>
				   
				    
				    <p>The Terms of Use, or simply Terms, govern a user's use of iMatr and the services, platform activities, technologies, and software iMatr offers.</p>
				    
				    <h4>1. Our Service Platform</h4>
				    
				    <p>We strive to give Canadians the power to build a wiser community and a better Canada by bringing Canadians closer together through meaningful and accountable dialogue. To help advance these goals and mission, iMatr provides its platform services (the products), to users in a personalized and yet collective way.</p>
				    <br>
				    <ul><p><strong>A Personalized User Experience</strong></p>
				    <p>Without question, no user experience is the same on iMatr where our products are personally tailored to individual users from the News & Views they read to the MyZone politicians they select. The opinions our users express on issues, including the e-petitions that they e-sign, reflect the nature of one-of-a-kind Canadians. Because of our uniqueness, even users’ SoCos aren’t the same.</p>
				    <p></p><p> 
				    <br>
				    </p><p><strong>Connecting Users With Like-Minded Canadians</strong></p>
				    <p>Finding like-minded people online often takes time. But not at iMatr. We help users find and connect with people, politicians, and organizations that share their views across iMatr products and platform activities. By sharing the data iMatr collects, we let users know what others think, what's trending, and where politicians and political parties really stand before, during, and after an election.</p>
				    <p>There's strength in numbers. Closer ties between like-minded people create stronger and more focused communities. iMatr promotes political and democratic dialogue on what different communities of Canadians need, want, and deem important through their selected platform activities. Join the conversation and see the benefits of users connecting with each other and having their say!</p>
				    <br>
				    <p><strong>Empowering Canadians to Have Their Say</strong></p>
				    <p>Whether you’re an individual, political candidate, politician, or part of a group, on iMatr, Canadians can express themselves about what matters. At iMatr, you matter, we all matter. Share your views on important issues presented by users and iMatr. These issues like families, the economy, and governance affect all Canadians. Also, see what others think, especially at election time. Learn about what electoral communities truly want, political platforms, and policy issues. Empowering all Canadians in different kinds of communities with our products is what we're all about.</p>
				  
				    <br>

					<p><strong>Helping Canadians Access Content</strong></p>

					<p>With our built-in features, iMatr provides content that is tailored to individual users. This content can be submitted by citizens, politicians, organizations, governments. Ultimately, users choose what content, issues,  politicians, and organizations they engage with or learn about.</p>
					<p>Our Basic Service* is free to Canadians. However, to make iMatr more viable, our partners pay to host or link sponsored content, ads, and offers related to what's important to our users as identified in their personalized view (Scope of View).</p>

					<p>For those who love of all things political, there's our Premium Service* offering multi-dimensional perspectives, including audio files.</p>
				    <p>And finally, tools like Matchmaker fast-tracks your experience on the platform. It serves up like-minded politicians, and other relevant and useful content that matches your preferences and chosen Scope of View.</p>
				    <br>
				    <p><strong>Combatting Harmful Content</strong></p>
				    <!-- <p>Canadians will usually only act when they feel safe, and have important things to say. When their fed up, real change happens.</p> -->
				    <p>Privacy and security are the cornerstones of our platform, and that's why we take very seriously the misuse of our products, posting of fake news or other information, harmful conduct towards others, and participation of bad actors, including foreign governments that may attempt to exert influence.</p>
				    <p>To prevent conduct like this, we employ advanced technology and dedicated specialists to fact find, review, and approve all our content. Instead of removing inappropriate, fake, or harmful content after damage may have been done, we are proactive and try to catch inappropriate information  before it is posted. This isn't censorship, but more like protecting the "chicken coop" from the "foxes".</p>
				    <p>If we learn of harmful content or conduct on our domain, we will take appropriate action like offering help, removing content, blocking access to some or all platform activities, disabling of accounts, and if necessary, contacting law enforcement. Under threat of harm, misuse, or illicit conduct, we will share our data and information with appropriate authorities.</p>
				    <br>
				    <p><strong>Advanced Technology for Safe Services</strong></p>
				    <p>Our use of artificial intelligence, machine learning, and SSL certificates, including deep encryption, white lists, and black lists, enables Canadians to use our products and platform safely.</p>
				    <p>Employing the same principles of credit card verification, we mail PINs to users at their declared addresses. If a user doesn't live where they say they live, and they don't prove it with geolocation, then they can't use the Contact Engine Toolbox. No one wants bad actors contacting our political representatives, clogging up communication channels for other Canadians with genuine intentions.</p>
				    <br>
				    <p><strong>Input and Research</strong></p>
				    <p>We value input from our community. That is why we constantly strive to implement ideas and suggestions offered by Canadians to better improve our products. Then iMatr analyzes the data we collect, and provides evidence-based practice models as support to underpin our users’ suggestions.</p>
				    <p>Continuous research in and development of emerging and new technologies helps make our platform from ever-changing cyber threats.</p> 
				    <br>
				    <p><strong>Access To Products and Services</strong></p>
				    <p>Our platform relies on global systems and data centres inside and outside of Canada. Choosing to launch iMatr firstly in Canada, we take great pride in Canadian know-how and its established system of democracy. Not every democracy is ready for iMatr. But it is our belief that Canadians can show the world a few things about how democratic societies can create dialogue among diverse individuals and between distinct communities. It's politics for the future.</p>
				    <p>By testing our "Canadian waters", our hope is that success at home will engage other democracies across the globe.</p>
				    <p>Regardless of their community, colour, or creed, citizens of the world must be able have their say, be heard, and engage in meaningful, accountable, and responsible dialogue, not just with those running for office, but with those democratically elected.</p>
				    <p>At iMatr, you matter, we all matter. 
				    <br>
				    </p></ul>
				    <hr>
				    <br>
				    <h4>2. Privacy Policy & User And Data Control</h4>
				    
				    <p>Without Canadians, there are no iMatr products or services. Without our users, we are devoid of life and passion, thoughts and experiences. To come alive, we collect personal user data in the form of location, account, content, and platform activity.</p>
				    <p>We detail users’ rights concerning this information in our <a href="#modal-page" uk-toggle onclick="getContentModal('privacy', '2')"><i>Privacy Policy</i></a>, which users must agree to in order to use our products.</p>
				    <p>We encourage users to not just review our Privacy Policy and their privacy choices, but to also understand how a user's settings can help and improve their communities.</p>
				    <p>If we want our voice heard, we must use it, privately when necessary and publicly when needed. At iMatr, users can use their voices responsibly on their own terms by personally selecting their platform activity.</p>
				    <hr>
				    <br>
				    <h4>Our Users’ Commitments</h4>
				    
				    <p>In exchange for the products and services our users enjoy, they can improve communities and democracy itself. When signing up or registering for our services, users agree to the following commitments:</p>
				    <br>
				    <ul><p><strong>a. Who may sign up or register?</strong></p>
				    <p>When Canadians ask to be heard, they need to stand behind their voice, their opinions, and actions. This makes our community real, viable, and more accountable. For these reasons, users must:</p>
				    
				    <ul><ul class="check"><li><p>Use their real name. No nicknames or aliases are permitted. </p></li></ul>
				    <ul class="check"><li><p>Provide accurate information about their location and any other voluntary account information.</p></li></ul>
				    <ul class="check"><li><p>Create only one account on a principal device in their location of residence.</p></li></ul>
				    <ul class="check"><li><p>Keep their password and any PIN secret and protected from use by others.</p></li></ul>
				    <ul class="check"><li><p>Agree not to share their account with any other person.</p></li></ul>
				    <ul class="check"><li><p>Agree not to transfer their account to any other person.</p></li></ul>
				    </ul>
				    <br>
				    <p>Although we try to make iMatr available to all Canadians, the following individuals cannot use, register for, or use iMatr Products or services:</p>
				    
				    <ul><li><p>Those who are under the age of 16.</p></li>
				    <li><p>Those who are neither a Canadian citizen nor permanent resident.</p></li>
				    <li><p>Anyone prohibited by applicable laws from receiving our products or services.</p></li>
				    <li><p>Users who have had their accounts previously disabled or deleted for violations of our Terms of Use or Privacy Policy.</p></li>
				    </ul>
				    
				    
				    </ul>
				    <hr>
				    <br>
				    <h4>Permissions On iMatr</h4>
				    
				    <p>Canadians matter! We want people to use our products to express themselves and to share their voices, experiences, and content that is important to them and their communities. Having your say, or sharing your experiences and content should not, however, be at the expense of any of the following:</p>
				    <br>
				    <ul><li><p>our community and democracy</p></li>
				    <li><p>other individuals</p></li>
				    <li><p>politicians</p></li>
				    <li><p>organizations</p></li>
				    <li><p>colleges and universities</p></li>
				    <li><p>governments</p></li>
				    </ul>
				    <br>
				    <p>We at iMatr do not tolerate user-initiated misinformation, hate, or fake news.</p>
				    <br>
				    <ul>
				    	<p>a. To preserve the integrity of our community and our democracy, users agree not to share or engage in the conduct of, facilitate, or support others to do the following:</p>
				    	<br>
				    	<ul><li><p>Violate the Terms of Use or Privacy Policy that applies to the users of iMatr.</p></li>
				    	<li><p>Create unlawful, misleading, discriminatory, or fraudulent content or representations.</p></li>
				    	<li><p>Infringe or violate other Canadians' rights.</p></li>
				    	<li><p>Unnecessarily bother politicians or abuse the platform's contact engine services.</p></li>
				    	<br>
				    	</ul>
				    	<p>b. Users may not upload disruptive or malicious code, viruses, or engage in any conduct or activity which could disable, impair, overtake, or overburden the proper functionality or appearance of our products to the public, our users, and iMatr administration portals.</p> 
				    	<br>
				    	<p>c. Users may not access, scrape, or collect data from our products using automated means or attempt to gain access to unauthorized areas of the platform, or attempt to access data which is private, confidential, and off limits to users.</p>
				    	<br>
				    </ul>
				    <p>In violation of any of the provisions noted above, iMatr may take action against the user's account and remove offending content the user has shared.</p>
				    <p>Users who are found to infringe on the rights of other people or organizations, or violate intellectual property rights will have their accounts disabled.</p>
				    <p>Our community of users is encouraged to help support our mission and our democracy by reporting content or conduct that users suspect violates our Terms of Use, Privacy Policy, or intellectual property rights.</p>
			        <hr>
			        <br>
			        <h4>5. Implicit Consent And Permissions</h4>
			        <br>
			        <p>For our platform to work, iMatr requires certain permissions from our users to provide them with the platform activities they want and use. These permissions include the following:</p>
			        <br>
				    <ul class="check"><li><p><b>Permission to use account information submitted by users. </b></p></li></ul>
				    <p>When users create a Start Up, Basic, Contact Engine or University / College account, the information provided to iMatr is treated as personal information. All personal information is subject to the conditions and requirements in our Terms of Use and Privacy Policies.</p>
				    <p>Users provide iMatr implicit consent to release certain personal information only when a specific platform activity is initiated and completed by the user. Identifying personal information such as a user's name, address, city/town, province, postal code, telephone number and email, including the user's position on an issue, is provided to the user's selected politician ("the receiving user") when the user initiates and executes contact engine platform activities known as Shares, Asks, or SoCos.</p>     
				    <p>Users who e-sign iMatr e-petitions also implicitly consent to provide to other e-signatories, politicians, and governments their personal information found on the e-petition.</p>
				    <p>The purpose of all these various platform activities is to gain a response from the receiving user of them. Therefore, to get a response, the receiver needs to know the personal information that is obtained from the user. Otherwise, the politician would not know who to contact about an issue of concern.</p>
				    <br>
				    <ul class="check"><li><p><b>Permission To Use Information</b></p></li></ul>
				    <p>To provide the services users want and need, iMatr has the express permission to use information from platform activities users have undertaken. This activity includes the user’s use of products, ads, offers, and other sponsored content without any compensation to contributing users.</p>
				    <br>
				    <ul class="check"><li><p><b>Permission to Share Content</b></p></li></ul>
				    <p>When a user creates content, such as giving an opinion on an issue or creating a question they would like to host, nothing in our Terms removes the ownership rights a user has to the content they have created and shared. Users are free to share such content with anyone whenever they want.</p>
				    <p>By the nature of iMatr and its premise of sharing and seeking the opinions of both Canadians and politicians on issues and policies, the use of users’ content is paramount and inescapable to help us achieve our mission.</p>
				    <p>To provide these services and products, users are therefore required to give iMatr legal permission to use their content.</p>
				    <p>For example, when users share, post, or upload their created content that is covered by intellectual property rights (like photos or videos), and is used in connection with our products and services, users grant iMatr a non-exclusive, transferable, sub-licensable, royalty-free, and worldwide license to host, use, distribute, modify, run, copy, publicly perform or display, translate, and create derivative works of the content (consistent with our Privacy Policy).</p>
				    <p>This legal license can be ended by a user at any time by simply deleting their account or the content they have created.</p>
				    <p>For technical reasons, content users create may exist for a limited time in back up copies invisible to other users (See Retention Period in Privacy Policy). However, content that has been deleted but has been shared with politicians, organizations, government, may continue to appear in other forums outside of iMatr if the other parties (politicians, organizations, government) have included a user's content in their domains.</p>
				    <br>
				    <ul class="check"><li><p><b>Limits of Intellectual Property</b></p></li></ul>
				    <p>If a user extracts content covered by intellectual property rights that iMatr or its employees or partners have created (such as images, videos, design, What Other Think data, What's Trending Data, News & Views, Awards data) or that iMatr or its products have provided, iMatr retains all rights to its own content a user may have used or shared.</p>
				    <p>Users may use our copyrights or trademarks as detailed and expressly permitted in our <a href="#modal-page" uk-toggle onclick="getContentModal('brand_usage', '2')" target="_blank"><i>Brand Usage Policy</i></a> or with iMatr's prior written approval.</p>
				    <p>Users must obtain iMatr's written permission and approval (or permission under an open-source license) to alter, create derivative works of, decompile, or otherwise attempt to extract source code or server information from us.</p>
				    <hr>
				    <br>
			        <h4>6. Additional Provisions</h4>
			        <br>
			        <p>a. Terms of Use Updates</p>
			        <p>iMatr strives to improve its services and products and to develop new ways Canadians can engage in their democracy. As a result, we create platform activities that enable users to get the most out of politics and their government.</p>
			        <p>With such activities and the possible inclusion of new legislation and regulation, iMatr may need to update these Terms from time to time to comply and accurately reflect our platform practices. Unless otherwise required by law, users will be notified by iMatr before it makes changes to these Terms to give users an opportunity to review them before they are implemented. Once any updated Terms do take effect, users will be bound by them if they continue to use iMatr Products.</p>
			        <p>We sincerely hope our users appreciate our need to comply with our democracy’s regulations. However, if users do not agree to our updated Terms and no longer want to use or products, they can delete their accounts at any time.</p>
			        <br>
			        <p>b. Limited Liability</p>
			        <p>Despite working hard to deliver reliable, consistent, and exceptional user experiences, our products and platform are provided "<i>as is</i>". Therefore, iMatr makes no guarantee that they will be safe, secure, or error-free, or that they will function as intended, without delay, disruption, imperfections, or inaccuracy.</p> 
			        <p>To the extent as permitted by law, iMatr also <i>disclaims all warranties, whether express or implied, including the implied warranties of merchantability , fitness for a particular purpose, title, and non-infringement</i>.</p>
			        <p>Neither the platform nor iMatr controls or directs what citizens, politicians, organizations, governments do or say, nor can iMatr and its products be responsible for their actions and conduct (whether online or offline) or any content that they share.</p> 
			        <p>iMatr cannot predict nor forecast when issues might arise with our products. Accordingly, iMatr's liability shall be limited to the fullest extent permitted by applicable law, and under no circumstance will iMatr be liable to users for any lost profits, revenues, information, data, or consequential, special, indirect, exemplary, punitive or incidental damages arising out of or related to these Terms or the iMatr products a user uses. These conditions apply even if iMatr has been advised of the possibility of such damages.</p>
			        <br>
			        <p>c. Account Investigations, Suspensions and Terminations</p>
			        <p>We strive to make iMatr a place where Canadians can feel safe to have their say, and express their thoughts, opinions, and views about issues that may affect their lives.</p>
			        <p>If it's suspected or determined that a user has violated our Terms, Privacy or Brand Usage policies, we may take action against their account to protect products, community, and democracy. Actions may include disabling or deletion of a user's account.</p>
			        <p>Accounts may also be suspended or disabled as required or permitted by law when a user creates risk or legal exposure to iMatr.</p>
			        <p>After any account action has been taken, iMatr will, when appropriate and under iMatr's sole discretion, notify users about their account the next time they try to login. Users will have an opportunity to learn more about what they can do if their account has been disabled by following the link in the login notice message.</p>
			        <p>Should any account be disabled or deleted by either a user or iMatr, the Terms shall terminate, cancelling the agreement between a user and iMatr, save and except provision numbers 3, 6.b - 6.e.</p>
			        <br>
			        <p>d. Disputes</p>
			        <p>iMatr works hard to provide clear rules and information so that our platform can limit and avoid disputes between our users and the company. If a dispute does arise, it's helpful to know how a legal dispute can be resolved and what laws may apply.</p>
			        <p>If you are a consumer who has purchased our services, Canadian law will apply to any claim, cause of action, or dispute you have against iMatr that arises out of or relates to the Terms or Products. The "claim" may be resolved in any competent court in Canada that has jurisdiction over the claim.</p>
			        <p>In all other cases, a user agrees that the claim must be submitted and resolved exclusively in the Supreme Court of Canada in Ottawa, Ontario.</p>
			        <br>
			        <p>e. Other Considerations</p>
			        <ul><p>1. The Terms defined in this information make up the entire agreement between a user and iMatr Canada Inc., regarding a user’s use of iMatr products. These Terms supersede any prior Terms of Use agreements.</p>
			        <p>2. Some of the services and products offered are also governed by supplemental terms. If a user uses any of these other products, the supplemental terms will be made available before a user purchases the applicable commercial products. For example, when a user accesses and uses our commercial products for personal, commercial, institutional or business purposes, such as the buying of ads, hosting or linking issues, upgrading to Premium Service, or to our use data services, users must agree to our <a href="#modal-page" uk-toggle onclick="getContentModal('commercial_terms', '2')"><i>Commercial Terms</i></a>. To the extent any supplemental terms conflict with the Terms, the Terms shall govern to the extent of the conflict.</p>
			        <p>3. Should any portion of these Terms be deemed unenforceable by a court of law, the remaining portion will remain in full force and effect. If circumstances arise where iMatr does not enforce any of the Terms, the inaction will not be considered a waiver. Any amendment to or waiver of the Terms must be made in writing and signed by iMatr.</p>
			        <p>4. Users agree not to transfer any of their rights or obligations under the Terms to anyone without the prior written consent of iMatr.</p>
			        <p>5. Users may designate a person named as a Legacy User to manage a user's account should the account be memorialized. The Legacy User, or a person who has been identified in a valid will or equivalent document where express, clear and explict, consent is provided to disclose a user's content upon death or incapacity, will be able to seek and receive disclosure from a user's account after it has been memorialized.</p>
			        <p>6. The Terms do not confer any third-party beneficiary rights. Users acknowledge and agree that all of our obligations and rights under the Terms are freely assignable by iMatr in connection with a merger, acquisition, sale of assets, or by operation of law or otherwise.</p>
			        <p>7. Users acknowledge that should their submitted email address be a registered government, university, or college email address, detected or undetected on a user's registration, such email addresses require an additional layer of protection. Users assigned government, college, or university emails are additionally required to obtain a PIN  for security and authentication purposes.</p>
			        <p>Similarly, political candidates running for office and elected politicians must register with <u>only</u> their valid public email address used for election or government purposes. To activate these reserved email accounts, political candidates and politicians will require a PIN. A PIN can be obtained by following the link at the time of registration.</p>
			        <p>8. iMatr always appreciates suggestions offered by users on its platform services and products. By offering suggestions, users acknowledge that any of them may be used by iMatr without restriction or compensation, and that they are free of Privacy Policy provisions.</p>
			        <p>9. iMatr reserves all rights not expressly granted to its users.</p>
			        <hr>
			        <br>
			        <h4>7. Other terms and policies that may apply, such as the following:</h4>
			        <br>
			        <ul>
					
			        <li><p><a href="#modal-page" uk-toggle onclick="getContentModal('advertising', '2')" target="_blank"><i>Advertising Policy</i></a> - provides information on what types of ad content are allowed by partners who advertise across iMatr products.</p></li>
			        <li><p><a href="#modal-page" uk-toggle onclick="getContentModal('brand_usage', '2')" target="_blank"><i>Brand Usage Policy</i></a> - provides guidelines and policies that apply to the use of iMatr trademarks, logos, and screenshots, including hyperlinks to iMatr and/or its products.</p></li> 
			        <li><p><a href="#modal-page" uk-toggle onclick="getContentModal('commercial_terms', '2')"><i>Commercial Terms</i></a> - outlines guidelines and standards for users who access and use iMatr Products for commercial, business, or governmental purposes.</p></li> 
			        <li><p><a href="#modal-page" uk-toggle onclick="getContentModal('discussion_policy', '2')" target="_blank"><i>Discussion &amp; Submission Policy</i></a> - provides information on what type of user-suggested content, links, and information may be submitted and accepted by iMatr.</p></li>
			        <li><p><a href="#modal-page" uk-toggle onclick="getContentModal('scopeofview_terms', '2')" target="_blank"><i>Custom Scope of View (Audience) Terms</i></a> - provides standards and information on approvals required by iMatr to generate custom scope of view audiences for users.</p></li>
			        <li><p><a href="#modal-page" uk-toggle onclick="getContentModal('activity_standards', '2')" target="_blank"><i>Platform Activity Standards</i></a> - outlines guidelines and standards regarding a user's platform activity and the content and suggestions a user creates, offers, and shares on iMatr.</p></li>
			        <!-- <li><p id="stayhere"><a href="#modal-page" uk-toggle onclick="getContentModal('premiumServices', '2')" target="_blank"><i>Premium Service</i></a> - provides information on the features, limits, and the terms and conditions of iMatr's Premium Service.</p></li> -->
	                </ul></ul>
					
				</div>
           </div>
		   <p class="text-center"><a onclick="scrollToTop()" >Top of Page</a></p>		
			
   
		   <?php 
				//require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_right.php'); 
		   ?>
        </div>                   
    </div>
</section>
    
    <!-- Latest News End -->
    
    <?php 

        require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'footer.php'); 

    ?>


</div>

<div id="modal-full" class="uk-modal-full"  uk-modal>
    <div class="uk-modal-dialog" style="border:solid 5px black">
    	<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
		
		<div class="container">
			<div id="modalpanel" class="row justify-content-md-center"></div>
			
		</div>
    	
	</div>
</div> 
<a href="javascript:" id="return-to-top"><i >
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-up"><polyline points="17 11 12 6 7 11"></polyline><polyline points="17 18 12 13 7 18"></polyline></svg>


  </i></a>
   <a href="javascript:" id="return-to-bottom"><i >
   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>

  </i></a>

	<!-- <div id="modal-full" class="uk-modal-full" uk-modal>
        <div class="uk-modal-dialog">
        	<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
        	<div  id="modalpanel" class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid> </div>
        </div>
    </div> -->

			
	<!-- Modal Confirm IQ-->
	<div id="answerModal" uk-modal>
		<div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title"></h2>
            </div>
            <div class="uk-modal-body">
				           <p></p>';
           
        	</div>
			<div class="uk-modal-footer uk-text-right">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			<a href="#modal-group-1" class="uk-button uk-button-primary" uk-toggle>Previous</a>
			</div>
    	</div>

	</div>




	


	
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/jquery.mmenu.min.all.js"></script>
	<!-- Bootstrap -->
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/bootstrap.js"></script>


<script src="<?php echo $_SERVER['GLOBAL_TEMPLATE_PATH']  ;?>/vendor/uikit/js/uikit.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script> -->
	<!-- Mobile Menu -->

	<!-- Sticky Header -->
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/jquery-scrolltofixed.js"></script>
	
<?php 




?>
	
	
    <!-- /.container -->
    <!-- jQuery -->
    <!-- Bootstrap Core JavaScript -->
	
	<a href="#modal-page" id="session" uk-toggle onclick="getContentModal('session', '2')" ></a>
	<script>
		function scrollToTop() {
			$(document).scrollTop(0)
			

		}
	</script> 
	<script>
var rect = document.getElementById("bottomofpage").getBoundingClientRect()
//console.log(rect.top)


			// checkTime()

			// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});



// 9000 for mobile

//5000 for desktop

// Create a media condition that targets viewports at least 768px wide
const mediaQuery = window.matchMedia('(max-width: 768px)')
// Check if the media query is true
if (mediaQuery.matches) {
  // Then trigger an alert
  xScroll = 120000
}
else {
	xScroll = 8000
}

// console.log(xScroll)

$(window).scroll(function() {
    if ($(this).scrollTop() <= xScroll) {        // If page is scrolled more than 50px
        $('#return-to-bottom').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-bottom').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-bottom').click(function() {      // When arrow is clicked
    $('body,html').animate({ scrollTop: $(document).height()-$(window).height() }, 500);
});






		$(document).ready(function() {

			//check user_id cookie
			
			//alert("uid"+uid);
			// Dock the header to the top of the window when scrolled past the banner.
			// This is the default behavior.

			jQuery('.sticky-header').scrollToFixed();


			// Dock the footer to the bottom of the page, but scroll up to reveal more
			// content if the page is scrolled far enough.



			// Dock each summary as it arrives just below the docked header, pushing the
			// previous summary up the page.

			var summaries = $('.summary');
			summaries.each(function(i) {
				var summary = $(summaries[i]);
				var next = summaries[i + 1];

				summary.scrollToFixed({
					marginTop: $('.sticky-header').outerHeight(true) + 10,
					limit: function() {
						var limit = 0;
						if (next) {
							limit = $(next).offset().top - $(this).outerHeight(true) - 10;
						} else {
							limit = $('.footer').offset().top - $(this).outerHeight(true) - 10;
						}
						return limit;
					},
					zIndex: 999
				});
			});
		});
	</script>

	<!-- Modal Panel -->
		<style>
			.uk-panel {
		
				background: #eee;
				color: #666;
				border: 1px solid #d5d5d5;
		
		
			}
			.uk-margin {    
					margin: 0  !important;    
			}

			.picpanel {
			
				height:50vh;
			
			}
			.qpanel {
			
				height:50vh;
			
			}
			.apanel  {
			
				height:100vh;
			
			}

			#accordionExample .row{
				border-bottom:solid 1px #999;
				margin: 1em;
				padding: .1em 0;	
			}

			#accordionExample h5{
				color:#3366cc;
				
			}

			
		</style>


	       

   


	
	
        


</body>


</html>

