<?php


require_once('Autoloader.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $_SERVER['MAG_TEMPLATE_PATH'] . 'head.php');




//use classes\Issue\IssueView as IssueView;


// //include('../logger.php');

date_default_timezone_set("America/Toronto");
$dat = date("Y-m-d H:i:s");
$dats = strtotime($dat);

$assignments = $_GET['assignments'] ?? 0;
//$page =  $_GET['page']??0;

?>
<!DOCTYPE html>
<style>
	html {
		overflow-y: scroll;
		/* Add the ability to scroll */
	}

	html ::-webkit-scrollbar {
		display: none;
	}

	/*desktops*/
	@media only screen and (min-width: 1080px) {
		.hide_mobile_top_bar {
			display: none;
		}

		.Navi_Left_tablet {
			display: none;
		}

		.top_right_tablet {
			display: none;
		}

	}

	/*tablets*/
	@media only screen and (min-width: 768px) and (max-width: 1079px) {
		.hide_canadian_flag_on_mobile {
			display: none;
		}

		.hide_mobile_top_bar {
			display: none;
		}

		.Navi_Left_desktop {
			display: none;
		}

		.top_right_desktop {
			display: none;
		}

	}

	/*smartphones*/
	@media only screen and (max-width: 767px) {
		.hide_canadian_flag_on_mobile {
			display: none;
		}

		.Navi_Left_desktop {
			display: none;
		}

		.Navi_Left_tablet {
			display: none;
		}

		#modal-page {
			margin-top: 100px;
		}

		#oswaldimg {
			display: none;
		}

		#no-show {
			display: none;
		}

		#oswald {
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
			.post-sec {
				border: solid 1px #dfdfdf;
			}

			.posts-style1 .post-sec .detail {
				border: solid 1px #fff;
			}

			.fbutton {
				border: none;
				float: left;
				color: #fff;
				font-family: 'univers_57_condensedregular';
				text-transform: uppercase;
				padding: 1rem 2.5rem;
				background: #333333;
				margin: 6px 0 0 0;
			}

			.fbutton:hover {
				background: #f4361e;
				transition: background-color 0.5s ease;
			}

			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
			}

			.blur {

				filter: blur(5px);
				-webkit-filter: blur(5px);
				pointer-events: none;
			}
		</style>



		<section class="content main-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="posts-style1 post-style">

							<!-- //hidden link to trigger content engine on page load if user profile is empty -->
							<a id="student_mode" href="#student-page" onclick="getContentModal('student_mode', 'nav')" uk-toggle></a>
							<a id="ceauto" href="#modal-page" onclick="getModalPage('contactEngine', 'nav')" uk-toggle></a>
							<a id="shask" href="#modal-page" onclick="getModalPage('shask', 'nav')" uk-toggle></a>


							<!--<div id="iqposts">--><!-- IQPOSTS --><!--</div>-->
							<!-- <h3><i id="suggest" class="fa fa-balance-scale" aria-hidden="true"></i>  Terms of Use</h3> -->
							<!--<img src='../logos/imatrlogo75.png'><br>-->
							<!--<a href='https://testnet.imatr.org/index.php'>Home </a><br><br>-->
							<h3 style="color: black !Important;"> Accuracy Pledge</h3>


							<h4><small>Effective 2019-10-08</small></h4>
							<h4>Accuracy statement</h4>
							<br>
							<p>Nothing is more important to us than our users’ security and accuracy. Despite being different, the two issues concepts go hand in hand. To ensure our contributions to democracy are secure, our information must be accurate.</p>

							<h4>1. Information</h4>

							<p>We always strive to ensure the information we provide to our users is correct and reliable. But sometimes we make mistakes, or the public domain data we rely on may be incorrect. When we become aware of any inaccurate information, regardless of its source, iMatr will correct it promptly and prominently.</p>

							<h4>2. Error Reporting</h4>

							<p>Users who detect a factual error are requested to contact iMatr as soon as possible by email at contact@imatr.org We will work hard to respond to all concerns as soon as possible.</p>


						</div>
					</div>
					<?php
					//require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_right.php'); 
					?>
				</div>
			</div>
		</section>

		<!-- Latest News End -->

		<?php

		require_once($_SERVER['DOCUMENT_ROOT'] . $_SERVER['MAG_TEMPLATE_PATH'] . 'footer.php');

		?>


	</div>


	<!-- Modal Panel -->
	<style>
		.uk-panel {

			background: #eee;
			color: #666;
			border: 1px solid #d5d5d5;


		}

		.uk-margin {
			margin: 0 !important;
		}

		.picpanel {

			height: 50vh;

		}

		.qpanel {

			height: 50vh;

		}

		.apanel {

			height: 100vh;

		}

		#accordionExample .row {
			border-bottom: solid 1px #999;
			margin: 1em;
			padding: .1em 0;
		}

		#accordionExample h5 {
			color: #3366cc;

		}
	</style>








</body>


</html>