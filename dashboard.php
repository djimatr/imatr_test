<?php 

	//session_start();
    require_once('Autoloader.inc.php');
  
    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_top.php'); 
	use classes\Issue\IssueView as IssueView;
	
	use classes\IQ\IQView as IQ;
	use classes\Organization\OrganizationController as OrganizationController;
	//echo "vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv".$subpage;

	if (session_status() !== PHP_SESSION_ACTIVE) session_start();

	date_default_timezone_set("America/Toronto");
	$dat=date("Y-m-d H:i:s");
	$dats=strtotime($dat);

	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	
  
	$page = $_REQUEST['page'] ?? "";
	$subpage = $_REQUEST['subpage'] ?? "";
	$token = $_REQUEST['token'] ?? "";
	$cookie_name = "user_id";
	$cookie_value = $token;
	
	
	$active = $page ?? "dash";



	


?>
<!-- Initialize JS -> PHP vars here -->
<script>

myReps = <?php echo isset($_SESSION['my_reps']) ? json_encode($_SESSION['my_reps']) : '[]'; ?>;

pin_status = <?php echo isset($_SESSION['pin_status']) ? $_SESSION['pin_status'] : 0; ?>;


</script>

<a href="#modal-page" id="session" uk-toggle onclick="getContentModal('session', '2')"></a>
<?php  


require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'sidebar.php');


?>

<div class="content content-page">
	<!-- this sticky-header-sub is the problem in mobile OSWALD  -->
  	<div class="sticky-header-sub" id="top_bar_sticky">
		<?php  require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'header.php');?>
	</div>

	<a href="javascript:" id="return-to-top"><i >
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-up"><polyline points="17 11 12 6 7 11"></polyline><polyline points="17 18 12 13 7 18"></polyline></svg>


  </i></a> <a href="javascript:" id="return-to-bottom"><i >
   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>

  </i></a>

  <div id="pagecontent">
  <div style="position: absolute;
margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
top: 45%;" id='spinner' class='spinner'>     <br></div>
  </div>

 



  

	<?php 
		
		require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'bottom.php'); 


	?>

	<style>

.spinner {
			margin: auto;
			margin-top: 15px;
    width: 55px;
    height: 55px;
    
    border: 9px solid #0000001a;
    border-radius: 50%;
    border-right-color: #00528A;
    
    animation: spin 1s ease infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
.Custom_Container .swal2-html-container {
	text-align: unset !important;
	/*margin:0;*/
}
		.Custom_Container{
 text-align: unset !important; 

		}
		.Custom_Container_Story .swal2-popup {
			padding-bottom: 0px !important;
		}
#dontshowlink {
	display: none;
}

 .Custom_Engage {
            transition: 0.5s;
            font-family: 'univers_57_condensedregular';
            border-radius: 0px !important;
  background-color: #00528A !important;
}
  .Custom_Engage:hover {
    
    background-color: #3D7CA6 !important;
  }
  .Custom_WOT {
    font-family: 'univers_57_condensedregular';
    border-radius: 0px !important;
    transition: 0.5s;
  background-color: #00954C !important;
}
  .Custom_WOT:hover {
    
    background-color: #46B27D !important;
  }

button.swal2-close  {
  position: absolute !important;
  visibility: hidden !important;
  /* position: absolute !important; */
}



button.swal2-close:before {
  content: "\e8f5";
  visibility: visible;
  position: absolute;
  color: #000;
  font-size: 32px !important;
}
button.swal2-close:hover::before {
  
  color: #d23439;
}



		.swal2-title h3 {
    margin-bottom: 0px !important;

}
        .swal2-title {
            font-size: 1.5rem;
            font-weight: normal;
			color: black !important;

        }
        .swal2-title, .swal2-popup {
			color: black !important;
            font-family: 'Fira Sans', sans-serif !important;
        }
	.Custom_Confirm {
		    font-family: 'univers_57_condensedregular';
		transition: 0.5s;
		 border-radius: 0px !important;
  background-color: #1c1c1c !important;
}
  .Custom_Confirm:hover {
    
    background-color: #00954C !important;
  }

  .Custom_Cancel {
	font-family: 'univers_57_condensedregular';
	transition: 0.5s;
	border-radius: 0px !important;
  background-color: #b2b3b5 !important;
}
  .Custom_Cancel:hover {
    
    background-color: #B0B1B3 !important;
  }
  
  .Custom_Deny {
    font-family: 'univers_57_condensedregular';
    transition: 0.5s;
    border-radius: 0px !important;
  background-color: #1c1c1c !important;
}
  .Custom_Deny:hover {
    
    background-color: #d23439 !important;
  } 
  
  .flex-container {
	display: flex; 
	flex-direction: row; 
	height: 100%;
	width: 100%;
	padding: 0; 
}

.center-content-column2 {
	
	width: 66%; 
	padding-left: 3%; 
	padding-right: 3%; 
	padding-bottom: 1%; 
	padding-top:0; 
	margin-bottom:0;

}
.centered-content {
	
	align-items: center;
	text-align: center;
	background-color: #bdc4d3; 
	height: 100%; 
	padding: 10px; 
	width: 30%;
}
@media only screen and (max-width: 767px) {
	.flex-container {
	display: flex; 
	flex-direction: column; 
	height: 100%;
	weight: 100%;
	padding: 0; 
}

.centered-content {
	
	align-items: center;
	text-align: center;
	background-color: #bdc4d3; 
	height: 100%; 
	padding: 10px; 
	width: 100%;
}

.center-content-column2 {
	width: 96%; padding-left: 3%; padding-right: 3%; padding-bottom: 1%; padding-top:0; margin-bottom:0;
}
/*.Dancing_font p {
	font-size: 20pt !important;
}*/



}
/* .flex-container-column{
	display: flex; 
	flex-direction: column; 
	height: 100%;
	weight: 100%;
	padding: 0; 
} */

.Custom_Container_Story .swal2-html-container {
	text-align: unset !important;
	margin: 0;
	padding: 0 !important;
}
 /* .centered-content-column {
	
	align-items: center;
	text-align: center;
	background-color: #bdc4d3; 
	height: 100%; 
	padding: 10px; 
	width: 100%;
} */



.story-cont{
	text-align: unset !important;
	font-family: 'PTSerif-Regular';
}

.center-text{
	text-align: center;
}

.unstyle{
	text-align: inherit;
	font-size: inherit;
}

.Dancing_font{
	font-family: 'DancingScript-Regular';
}

.PT_Italic{
	font-family: 'PTSerif-Italic';
}


.invoice_table td, .invoice_table th, .invoice_table table{
  border-collapse: collapse; 
  border: 1px solid black;
  text-align: center;
  font-size:10pt;
}

.invoice_table th{
  padding: 10px 5px;
  max-width:300px !important;

}
.invoice_table td{
  padding: 10px 5px !important;
  max-width:300px !important;
 
}


#headinvoice{
	min-width:200px !important;
}
#qtytbl{
	min-width:50px;
	max-width:50px;
}
.tddif{
	min-width: 80px;
	max-width:100px;
}

.toppdf{
	font-size:12pt;
	border-width: 0 0 2px;
	border-color: black;
	width: 400px;
}
.toppdfsm{
	font-size:10pt;
	border-width: 0 0 2px;
	border-color: black;
	width: 150px;
}


  .page-break {
    page-break-before: always !important;
  }

.inppdf{
	font-size:10pt;
	width: 80px !important;
	border: none;
}
table {
  word-break: break-word; 
  white-space: normal;  
}
.accomp li {
  list-style-type: disc;
  
}

.accomp li::before{
	background-color: #000;
}

 </style>
<!--script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script-->
<!--script type="text/javascript" src="/vendor/JS_files/sweetalert2@11.js"></script-->
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.plugin.html.min.js"></script-->
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.3/jspdf.plugin.autotable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.3/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.8/purify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script-->

<script type="text/javascript" src="vendor/JS_files/jspdf.umd.min.js"></script>

<script type="text/javascript" src="vendor/JS_files/jspdf.plugin.autotable.js"></script>
<script type="text/javascript" src="vendor/JS_files/jspdf.plugin.autotable.min.js"></script>

<script type="text/javascript" src="vendor/JS_files/purify.min.js"></script>
<script type="text/javascript" src="vendor/JS_files/html2canvas.min.js"></script>


<script src="https://js.stripe.com/v3/"></script>
<script src="../JS/Payment.js"></script>

<script>

	

// $( function() {
//     $( "#datepicker" ).datepicker();
//   } );
	     $(function(){

'use strict'

$('#profileMenu').on('click', function(e) {
  e.preventDefault();

  $('body').addClass('profile-menu-show');
  $('#mainMenu').removeClass('d-none');
  $(this).addClass('d-none');
$('#profileMenuHide').removeClass('d-none');
})

$('#profileMenuHide').on('click', function(e) {
  e.preventDefault();

  $('body').removeClass('profile-menu-show');
//   $('#mainMenu').addClass('d-none');
  $('#profileMenuHide').addClass('d-none');
  $('#profileMenu').removeClass('d-none');
})

})


$(document).ready(function(){
	//move sidebar menu to 0px if mobile
	if(window.matchMedia('(max-width: 768px)').matches) {
			$("#sidemenu").css('margin-top', '0px');
			}
		//Get URL string
		const queryString = window.location.search;
  		const urlParams = new URLSearchParams(queryString);
  		
			//console.log(queryString);
			if(urlParams.get('questID')){

				repID = urlParams.get('repID')
				questID = urlParams.get('questID')
// alert(questID)
// $.when(getDashboardPage('politician_profile', `${repID}`)).then(engagement_details(`${questID}`));
				
// function myDisplayer(some) {
//   document.getElementById("demo").innerHTML = some;
// }

// function myCalculator(repID, questID, myCallback) {
	getDashboardPage('politician_profile', `${repID}`)
	setTimeout(() => {
		engagement_details(`${questID}`)
	}, 500);
// }

// myCalculator(repID, questID, engagement_details);

			}else {

	
  		const page = urlParams.get('page');
  		const subpage =urlParams.get("subpage");
		getDashboardPage(page, subpage);
			}
		  //loadContent(page);
		//alert(page);
	});


function set_IQid(IQid){
	document.cookie = "iq=" + IQid;
}
function change_answer(questID){
	document.getElementById('change_answer' + questID).style.display = '';
}

function loadContent(page){

	switch(page) {
		case "basic_profile":
			$("#pagecontent").load("admin/profile_settings.php");
			break;
		case y:
			// code block
			break;
		default:
		$("#pagecontent").load("admin/profile_settings.php");
	}



}
function jumptoIQ(iq){
	window.location.href = 'https://<?php print $_SERVER['HTTP_HOST']; ?>/index.php?questID='+ iq

}

const monthes = ["January","February","March","April","May","June","July","August","September","October","November","December"];

function invoice(current_month, year){

	var today = new Date();
	var date_today = today.getDate();
	var month_today = monthes[today.getMonth()];
	var year_today = today.getFullYear();

	var todays_date = `${date_today}-${month_today}-${year_today}`;
	
	var month_name = monthes[current_month];
	var days_range = '';
	if (current_month == 1) {
		if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0) {
			days_range = '1-29'; // Leap year
		} else {
			days_range = '1-28';
		} 
	}else if ([3, 5, 8, 10].includes(current_month)) {
		days_range = '1-30';
	}else
		days_range = '1-31';

	$.ajax({
		type: "POST",
		url: "includes/IQWriter.inc.php",
		data: {"type":"invoice_info","month": current_month, "year": year},
		dataType: "html",
		success: function(data){
			
			if (typeof data === 'string') {
			data = JSON.parse(data);
			}
			for (let i = 0; i < data.iq_det.length; i++) {
	
			
			}
			var fname = data.user_det.fname;
			var lname = data.user_det.lname
			var name = fname + ' ' + lname;
			var email = data.user_det.userEmail;
			var tel = data.user_det.tel ?? '---';
			var address = data.user_det.address ?? '---';
			var city = data.user_det.city ?? '---';
			var provter = data.user_det.provter ?? '---';
			var pcode = data.user_det.pcode ?? '---';
			var invoice_count = data.invoice_count ?? 1;
			var invoice_num = data.invoice_count.toString() ?? '001';
			if(invoice_num.length == 2) invoice_num = '0'+ invoice_num;
			else if(invoice_num.length == 1) invoice_num = '00'+ invoice_num;

			//console.log(data.user_det);
			if((!fname)||(!lname)||(fname.trim() == '')||(lname.trim() == '')){
				Swal.fire({
                title: "Please enter your name in your account settings",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Save',
                focusConfirm: false,
                confirmButtonText:
                  '<i class="fa fa-thumbs-up"></i> Yes, I will add my name!',
                  customClass: {
                    confirmButton: 'Custom_Confirm',
                    denyButton: 'Custom_Deny',
                    cancelButton: 'Custom_Cancel'
                  },
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                  '<i class="fa fa-thumbs-down"></i> No, not at this time',
                cancelButtonAriaLabel: 'Thumbs down'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=paneAccount';
                  } 
				});
			}else{
			
			let tableHTML = `<div><table id="userInfoDiv" style="width:100%;"><tr><th style="width:70%;"><div style="height:50px; width:100%; font-size:18pt; border:3px solid black; float:left; text-align:center;font-weight:bold;line-height:40px; box-sizing: border-box;">` + name + `</div></th>
										<th style="width:20px;">&nbsp;&nbsp;&nbsp;&nbsp;</th><th style="width:150px;"><div><div style="height:50px;  width:100%; font-size:18pt; font-weight:bold; border:3px solid black; float:right; text-align:center;line-height:40px; box-sizing: border-box;">INVOICE</div></th></tr>
							<tr><td style="width:80%;"><br><br><b style="float:left;"><input type="text" class="inppdf" value="Address:"><input type="text" class="toppdf" value="`+ address +`"></b>
							<br><br><b style="float:left;"><input type="text" class="inppdf" value="City:"><input type="text" class="toppdf" value="`+ city +`"></b>
							<br><br><b style="float:left;"><input type="text" class="inppdf" value="Province:"><input type="text" class="toppdf" value="`+ provter +`"></b>
							<br><br><b style="float:left;"><input type="text" class="inppdf" value="Postal Code:"><input type="text" class="toppdf" value="`+ pcode +`"></b>
							<br><br><b style="float:left;"><input type="text" class="inppdf" value="Phone:"><input type="text" class="toppdf" value="`+ tel +`"></b>
							<br><br><b style="float:left;"><input type="text" class="inppdf" value="Email:"><input type="text" class="toppdf" value="`+ email +`"></b>
							<br><br><b style="float:left;"><input type="text" class="inppdf" value="Bill To: "><br><input type="text" class="toppdf" style="border:0px" value="Company:  iMatr Canada Inc."></b>
							<br><br><div style="font-size:6pt !important;"><input type="text" class="inppdf" value=""><input type="text" class="toppdf" style="border:0px; font-size:10pt !important" value="Attention: Joe Kutlesa"><br>
							<input type="text" class="inppdf" value=""><input type="text" class="toppdf" style="border:0px !important; font-size:10pt !important;" value="TechPlace, 5500 North Service Road,"><br>
							<input type="text" class="inppdf" value=""><input type="text" class="toppdf" style="border:0px !important; font-size:10pt !important;" value="Suite 801, Burlington, Ontario L7L 6W6"><br>
							<input type="text" class="inppdf" value=""><input type="text" class="toppdf" style="border:0px !important; font-size:10pt !important;" value="Phone: 905-630-1759"><br>
							<input type="text" class="inppdf" value=""><input type="text" class="toppdf" style="border:0px !important; font-size:10pt !important;" value="E-Mail: jkutlesa@imatr.org"></div></td>
							</td><td style="20px"></td>
							<td><b style="float:left;"><input type="text" class="inppdf" value="Invoice: "><input type="text" class="toppdfsm" value="#`+ invoice_num +`">
							<br><b style="float:left;"><input type="text" class="inppdf" value="Invoice Date: "><input type="text" class="toppdfsm" value="`+ todays_date +`">
							<br><b style="float:left;"><input type="text" class="inppdf" value="Invoice For: "><input type="text" class="toppdfsm" value="`+ month_name + `  ` + days_range + `, ` + year + `"></b></td></tr></table><br>`;
			
			    tableHTML += '<table id="invoice_tbl" class="invoice_table" style="width: 100%;">';
				tableHTML += '<thead><tr><th class="tddif">&nbsp;Start Date&nbsp;</th><th class="tddif">&nbsp;iQ No.&nbsp;</th><th id="headinvoice">iQ Submitted</th><th id="qtytbl">&nbsp;Qty&nbsp;</th><th class="tddif">Rate</th><th class="tddif">Amount</th></tr></thead>';
				tableHTML += '<tbody>';
			for (let i = 0; i < data.iq_det.length; i++) {
				tableHTML +=`<tr><td>${data.iq_det[i].sdate}</td>
								<td>${data.iq_det[i].questID}</td>
								<td>${data.iq_det[i].qasked}</td>
								<td>1</td>
								<td>$ ${data.iq_det[i].rate}</td>
								<td>$ ${data.iq_det[i].rate}</td></tr>`;

			}
				tableHTML += '<tr style="border-color:white"><td style="border-color:white"></td><td style="border-color:white"></td><td style="border-color:white"></td><td style="border-color:white"></td><td style="border-color:white"></td><td style="border-color:white"><b>Total: $'+ data.total + '</b></td></tr>'
				tableHTML += '</tbody></table></div>';
				
				swal_invoice(data, name, address, city, provter, pcode, tel, email, invoice_num, todays_date, month_name, days_range, current_month, year, tableHTML, data.total, name, email, invoice_count);
			}
		}
		});
}


function swal_invoice(data, name, address, city, provter, pcode, tel, email, invoice_num, todays_date, month_name, days_range, month, year_now, tableHTML, total, name, email, invoice_num){
	var user_id = <?php echo $_SESSION['user_id'] ?>;

	var screen_condition = window.innerWidth >= 768;
	var swal_width = screen_condition ? '60%': '100%';
	var month_name = monthes[month];

	Swal.fire({
			title:'Invoice for ' + month_name,
			html:tableHTML,
			confirmButtonText: 'Previous Month',
			cancelButtonText: 'Next Month',
			denyButtonText: 'Send me the invoice',
			showCloseButton: true,
			showCancelButton: true,
			showDenyButton: true,

			width: swal_width,
			customClass: {
				closeButton: 'uk-modal-close-full icon-cross2',
				confirmButton: 'Custom_Cancel',
				denyButton: 'Custom_Confirm',
				cancelButton: 'Custom_Cancel',
			}
		}).then((result) => {
			if (result.isDenied) {
				const { jsPDF } = window.jspdf;

				const doc = new jsPDF({
					orientation: 'portrait',
					unit: 'pt',
					format: 'a4'
					
				});
				doc.margins = {
					top: 20,
					bottom: 20,
					left: 20,
					right: 20
				};

				let startY = 60;
				const leftColumnX = 30;
				const rightColumnX = 350;
				const rightColumnStartIndex = 7; 
				var boxHeight = 20;
				const userInfo = [
					{ header: 'Name', value: name },
					{ header: 'Address', value: address},
					{ header: 'City', value: city },
					{ header: 'Province', value: provter },
					{ header: 'Postal Code', value: pcode },
					{ header: 'Phone', value: tel },
					{ header: 'Email', value: email },
					{ header: 'INVOICE', value: 'INVOICE' },
					{ header: 'Invoice', value: '#'+ invoice_num },
					{ header: 'Invoice Date', value: todays_date },
					{ header: 'Invoice For', value: `${month_name} ${days_range}, ${year_now}` }
				];
				doc.setFont("helvetica", "bold"); 
				doc.setFontSize(13); 

				var yAdd = 0;
				
				userInfo.forEach((item, index) => {
					let isRightColumn = index >= rightColumnStartIndex;
					let xPosition = isRightColumn ? rightColumnX : leftColumnX;
					let yPosition = startY + (isRightColumn ? (index - rightColumnStartIndex) * 40 : (index * 40 + yAdd));
				
					if (item.header !== 'Name' && item.header !== 'INVOICE'){
						doc.setFontSize(14); 
						if(item.header === 'Address'){
							var max_width = rightColumnX - 150;
							var addr = item.value;
							let splitAddress = doc.splitTextToSize(addr, max_width);
							var text = '';
							doc.text(`${item.header}:`, xPosition, yPosition); 
							var addressXPosition = xPosition + doc.getTextWidth(`${item.header}: `)
							var lineHeight = 10;
							var numLines = splitAddress.length;
        					if(numLines > 1) yAdd = lineHeight * numLines;

							splitAddress.forEach((line, index) => {
								let lineYPosition = yPosition + (index * (lineHeight + 5));
								let lineWidth = doc.getTextWidth(line);
								doc.text(line, addressXPosition, lineYPosition);
								doc.line(addressXPosition-2, lineYPosition+2, addressXPosition + lineWidth+2, lineYPosition+2);
							});
						}else{
							var text = `${item.header}: ${item.value}`;
							
							doc.text(`${item.header}: `, xPosition, yPosition);
							var valueText = item.value;
							var textWidth = doc.getTextWidth(valueText);
							var valueXPosition = xPosition + doc.getTextWidth(item.header + ': ');
							doc.text(item.value, valueXPosition, yPosition);
							doc.setLineWidth(0.5);
							doc.line(valueXPosition-2, yPosition + 2, valueXPosition + textWidth + 2, yPosition + 2);
						}
					}
					else{
						
						doc.setFontSize(18); 
						var text = `${item.value}`;
						yPosition -= 10;
					}

					
					var textWidth = doc.getTextWidth(text) + 4; 
					doc.text(text, xPosition, yPosition);
				

					if (item.header === 'Name' || item.header === 'INVOICE') {
						doc.setLineWidth(3);
						doc.rect(xPosition - 10, yPosition - boxHeight - 6, textWidth + 15, boxHeight + 20);
						doc.setLineWidth(0.2);
					}
				});
				const userInfoHeight = rightColumnStartIndex * 40;
				const tableStartY = startY + userInfoHeight + 50;
				let newSectionStartY = startY + userInfoHeight + 40;
		
		doc.text('Bill To:', leftColumnX, newSectionStartY);
newSectionStartY += 17;
doc.text('Company: iMatr Canada Inc.', leftColumnX, newSectionStartY);
newSectionStartY += 17; 
doc.setFont("helvetica", "normal"); 
var x_shift = doc.getTextWidth("Company: ") + 5;

//doc.setFontSize(10); 
doc.text('Attention: Joe Kutlesa', leftColumnX + x_shift, newSectionStartY);
newSectionStartY += 17; 

doc.text('TechPlace, 5500 North Service Road,', leftColumnX + x_shift, newSectionStartY);
newSectionStartY += 17;
doc.text('Suite 801, Burlington, Ontario L7L 6W6', leftColumnX + x_shift, newSectionStartY);
newSectionStartY += 17;
doc.text('Phone: 905-630-1759', leftColumnX + x_shift, newSectionStartY);
newSectionStartY += 17; 
doc.text('E-Mail: jkutlesa@imatr.org', leftColumnX + x_shift, newSectionStartY);


				

				doc.text(' ', 10, 10 + (userInfo.length * 10) + 5);
				const tableData = data.iq_det.map(item => [
					item.sdate,
					item.questID,
					item.qasked,
					1,
					`$ ${item.rate}`,
					`$ ${item.rate}`
				]);

				const pageBreakHeight = doc.internal.pageSize.height + 30;

				doc.autoTable({
					head: [['Start Date', 'iQ No.', 'iQ Submitted', 'Qty', 'Rate', 'Amount']],
					body: tableData,
					startY: newSectionStartY+30,
					theme: 'grid',
					columnStyles: {
						0: {
							halign: 'center',
							tableWidth: 100,
							},
						1: {
							halign: 'center',
							tableWidth: 100,
						},
						2: {
							
							tableWidth: 100,
						},
						3: {
							halign: 'center',
							tableWidth: 100,
						},
						4: {
							halign: 'center',
							tableWidth: 100,
						},
						5: {
							halign: 'center',
							tableWidth: 100,
						},
					
					},
					margin: { top: 20, right: 20, bottom: 20, left: 20 },
					styles: {
						fontSize: 14,
						fontFamily: 'Fira sans',
						fontWeight: 'bold',
				
					},
					headStyles: {
    					fillColor: '#f0f0f0',
						halign: 'center',
						textColor: 'black'
					}, 
					pageBreak: 'auto',
					rowPageBreak: 'avoid'
				});
				doc.setFont("helvetica", "bold"); 
				var finalY = doc.autoTable.previous.finalY;
				doc.text(`Total: $${data.total}`, doc.internal.pageSize.width - 100, finalY + 30);


						pdfBlob = doc.output('blob');
						sendPdfByEmail(pdfBlob, email, name, month_name, user_id, invoice_num);
				

			}else if(result.isConfirmed){
				//console.log(year_now)
				if(0 < month && month <= 11)
					invoice(month - 1, year_now);
				else if(month === 0)
					invoice(11, year_now-1);
				else if(month === 11)
					invoice(0, year_now+1);
			}else if(result.isDismissed && result.dismiss === Swal.DismissReason.cancel){
				//console.log(month)
				if(0 <= month && month < 11)
					invoice(month + 1, year_now);
				else if(month === 0)
					invoice(11, year_now-1);
				else if(month === 11)
					invoice(0, year_now+1);
			}
		});
}

function sendPdfByEmail(pdfBlob, email, name, month, user_id, invoice_num) {
    const formData = new FormData();
	var pdfName = 'iMatr_invoice_'+ name.replace(/ /g,"_") + '_' + month + '.pdf';
    formData.append('pdfFile', pdfBlob, pdfName);
	formData.append('type', 'email_invoice');
    formData.append('fullname', name);
    formData.append('email', email);
	formData.append('month', month);

    $.ajax({
        type: 'POST',
        url: 'includes/mailer.inc.php',
        data: formData,
        processData: false, 
        contentType: false,
        success: function(response) {
            //console.log('PDF sent successfully:', response);
			Swal.fire({
				title:"Your invoice has been emailed.",
				timer: 3000,
				showConfirmButton: false
			});
        },
        error: function(error) {
            console.error('Error sending PDF:', error);
        }
    });

	$.ajax({
		type: "POST",
		url: "includes/IQWriter.inc.php",
		data: {"type":"increase_save_invoice","userID":user_id, "inovice_count": invoice_num},
		dataType: "html",
		success: function(data){
        }
    });
}

function goto_issue(type){
	if(type == 'Editors_queue' || type == 'Publisher' || type == 'Editor') $("#identify").html("EDITOR'S DASHBOARD");
	else $("#identify").html("WRITER'S DASHBOARD");
	$("#help").html("See how others think about this topic");
	var side =  document.querySelectorAll('.toggle-sidebar')
    
	$(side).removeClass('toggle-sidebar');
	$.ajax({    

			        type: "POST",
			        url: "pages/iqcreator_list.php",             
			        data: {"type":type},
			        dataType: "html",                  
			        success: function(data){                
			            $("#pagecontent").html(data);
						//document.getElementById(selected_row).style.backgroundColor = '';

						//document.getElementById(a).style.backgroundColor = 'red';
						//selected_row = a;
			        }
	});
}
<?php if(isset($_SESSION['admin_type']) && $_SESSION['admin_type'] >= '3'){ ?>
function goto_issue_admin(a){
	var side =  document.querySelectorAll('.toggle-sidebar')
    
	$(side).removeClass('toggle-sidebar');
	$.ajax({    
		type: "POST",
		url: "admin/iq_writer.php",             
		data: {"questID":a, "admin_flag":"1"},
		dataType: "html",                  
		success: function(data){                
			$("#pagecontent").html(data);
		}
	});
}
<?php } ?>
function goto_issue_b(a){
	var side =  document.querySelectorAll('.toggle-sidebar')
    //console.log("type", typeof a);
	$(side).removeClass('toggle-sidebar');
	if(a == "new"){
		Swal.fire({
			title: 'iQ Creation',
			html: "Are you sure you want create a new iQ?",
			icon: 'question',
			// showDenyButton: true,
			confirmButtonColor: '#1c1c1c',
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes, lets get going!',
			confirmButtonAriaLabel: 'Thumbs up, Yes!',
			denyButtonText:
				'<i class="fa fa-thumbs-down"></i> No, my mistake',
				customClass: {
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel'
},
			denyButtonAriaLabel: 'Thumbs down'
									
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					$.ajax({    

						type: "POST",
						url: "admin/iq_writer.php",             
						data: {"questID":a},
						dataType: "html",                  
						success: function(data){                
							$("#pagecontent").html(data);
						}
					});
				} 
			});
	}else{
		$.ajax({    

			type: "POST",
			url: "admin/iq_writer.php",             
			data: {"questID":a},
			dataType: "html",                  
			success: function(data){                
				$("#pagecontent").html(data);
			}
		});
	}
}
$(document).ready(function() {
          
		  $(function() {
			  $("#new_resource_date").datepicker({maxDate: 0});
			  $("#fromdate").datepicker();
			  $("#todate").datepicker();
		  });
	  })

function getDashboardHeaderContent(page) {

	switch(page) {
		case "engage":
			$("#identify").html("ENGAGEMENT");
			$("#help").html("You may now engage with your politicians. Ask them what they think of this question.");
			break;
		case "wot":
			$("#identify").html("WHAT OTHERS THINK");
			$("#help").html("See how others think about this topic");
			break;
		case "basic_profile":
			$("#identify").html("ACCOUNT SETTINGS");
			$("#help").html("See how others think about this topic");
			break;
		case "politician_profile":
			$("#identify").html("MY POLITICIANS");
			$("#help").html("See how others think about this topic");
			break;
			
		default:
		$("#identify").html("MY DASHBOARD");
			$("#help").html("A summary of your interactions with iMatr");
			// document.getElementById('#profileMenu').classList.remove("d-none")
		}

}

function getDashboardPage(page, subpage) {


	
var side =  document.querySelectorAll('.toggle-sidebar')
    //   
      document.querySelector(".toggle-sidebar").classList.remove(".toggle-sidebar");
//    $("").removeClass('.toggle-sidebar')

		//alert(page);
		//const subpage = urlParams.get('subpage');
		
		getDashboardHeaderContent(page);
		
	
		if (page == 0){

			window.location = ('forbidden.php') 

		}else{
			if (page == "politician_profile"){
				document.cookie = "politician_id= "+subpage + ";";
			}

			if (page == "constituent_profile"){
				document.cookie = "constituent_user_id= "+subpage + ";";
			}

			if (page == "WOT"){
				document.cookie = "iq= "+subpage + ";";
			}
			//document.cookie = "politician_id= "+subpage + ";";
			$.ajax({    
			type: "POST",
			url: "../includes/dashboard.inc.php",             
			data: {type:"admin", page:page },
			dataType: "html",  
			beforeSend : function() {
				$('#pagecontent1').empty();
			},                
			success: function(data){   
				//console.log(data); 
				// if (page=="org_order"){
				// 	getPaymentPage('Payment', 1, 'IQ');
				// } 
				// getOrgMain();
				//getPurchasedIQs();
				$('#pagecontent').empty();               
				$("#pagecontent").html(data); 
			
			},
			complete: function(){
				// if (subpage == 0 || subpage == ""){
				// 	//alert("no subpage");
				// 	getOrgPage("overview");
			 	// 	;//if no subpage parameter set to default
				// } else {
				// 	//alert("run getOrgPage() function if index_org");
					getSubPage(page, subpage);
				// }
	
				
			},
			error: function(error){
				console.log("Error:");
				console.log(error);
				$("#error").show();                 
				$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
				
			},
			});
		}
		// checkTime()

}

function getDashboardPage(page, subpage) {

	
		var side =  document.querySelectorAll('.toggle-sidebar')

	$(side).removeClass('toggle-sidebar');

		
		getDashboardHeaderContent(page);
		
	
		if (page == 0){

			window.location = ('forbidden.php') 

		}else{

			if (page == "politician_profile"){
				document.cookie = "politician_id= "+subpage + ";";
			}

			if (page == "constituent_profile"){
				document.cookie = "constituent_user_id= "+subpage + ";";
			}
			$.ajax({    
			type: "POST",
			url: "../includes/dashboard.inc.php",             
			data: {type:"admin", page:page, subpage:subpage },
			dataType: "html",  
			beforeSend : function() {
				$('#pagecontent1').empty();
			},                
			success: function(data){   
				//console.log(data); 
				// if (page=="org_order"){
				// 	getPaymentPage('Payment', 1, 'IQ');
				// } 
				// getOrgMain();
				//getPurchasedIQs();
				$('#pagecontent').empty();               
				$("#pagecontent").html(data); 
			
			},
			complete: function(){
				// if (subpage == 0 || subpage == ""){
				// 	//alert("no subpage");
				// 	getOrgPage("overview");
			 	// 	;//if no subpage parameter set to default
				// } else {
				// 	//alert("run getOrgPage() function if index_org");
					getSubPage(page, subpage);
				// }
				
			
			},
			error: function(error){
				console.log("Error:");
				console.log(error);
				$("#error").show();                 
				$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
				
			},
			});
		}
		

}






function checkAnswers(questID){
	// console.log('hi')

	$.ajax({    
		type: "POST",
		url: "../includes/engagement.inc.php",             
		data: {type:'checkConstiuentAnswers', questID:questID
		},
		dataType: "html",                  
		success: function(data){ 

		

		if(data == 0){
			Swal.fire({
												title: 'None of your constituents have answered this iQ',
													
												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Cancel',
													cancelButton: 'Custom_Cancel'
												},
																									
												confirmButtonText: 'OK'
												});		}else{

													$.ajax({    
		type: "POST",
		url: "../includes/engagement.inc.php",             
		data: {type:'checkPoliAnswer', iq_id:questID
		},
		dataType: "html",                  
		success: function(data){ 
			if(data == 0){

				Swal.fire({
												title: 'You have not answered this iQ',
													
												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Cancel',
													cancelButton: 'Custom_Cancel'
												},
																									
												confirmButtonText: 'OK'
												});

			}else{
			getDashboardPage('rep_overview', questID)
			}
		}})

		}

		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});


// alert('hi');
// exit()
}

function getSubPage(page, subpage){

	//alert(page+subpage);
	if (page == "org_index"){

		if (subpage == 0 || subpage == ""){
			getOrgPage("overview");
		} else {
			//alert(subpage);
			//$("#pagecontent").reload();
			getOrgPage(subpage);
		}
          
		getOrgPage(subpage);

    }

	// if (page == "city_triage_classic"){
		
	// 	$.ajax({    
	// 		type: "POST",
	// 		url: "../includes/dashboard.inc.php",             
	// 		data: {type:"triageadmin", page:page, subpage:subpage},
	// 		dataType: "html",  
	// 		beforeSend : function() {
	// 			$('#pagecontent1').empty();
	// 		},                
	// 		success: function(data){   
	// 			//console.log(data); 
	// 			// if (page=="org_order"){
	// 			// 	getPaymentPage('Payment', 1, 'IQ');
	// 			// } 
	// 			// getOrgMain();
	// 			//getPurchasedIQs();
	// 			$('#pagecontent').empty();               
	// 			$("#pagecontent").html(data); 
	// 			checkTime()
			
	// 		},
	// 		complete: function(){
	// 			// if (subpage == 0 || subpage == ""){
	// 			// 	//alert("no subpage");
	// 			// 	getOrgPage("overview");
	// 		 	// 	;//if no subpage parameter set to default
	// 			// } else {
	// 			// 	//alert("run getOrgPage() function if index_org");
	// 				// getSubPage(page, subpage);
	// 			// }
				
			
	// 		},
	// 		error: function(error){
	// 			console.log("Error:");
	// 			console.log(error);
	// 			$("#error").show();                 
	// 			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
				
	// 		},
	// 		});




	// }

	if (page == "outreach"){

		if (subpage == 0 || subpage == ""){
			getWOTPage("overview");
		} else {
			getWOTPage(subpage);
		}
		
		getWOTPage(subpage);

	}

	if (page == "basic_profile"){

		if (subpage == 0 || subpage == ""){
			getProfilePage("paneProfile");
		} else {
			getProfilePage(subpage);
		}

		getProfilePage(subpage);

	}

	if (page == "politician_profile"){


		if (subpage == 0 || subpage == ""){
			getWOTPage("overview");
		} else {
			document.cookie = "politician_id= "+subpage + ";";
		}
		
		

			getWOTPage(subpage);

	}

	if (page == "constituent_profile"){


if (subpage == 0 || subpage == ""){
	getWOTPage("overview");
} else {
	document.cookie = "constituent_user_id= "+subpage + ";";
}



	getWOTPage(subpage);

}


}

function getWOTPage(page){
      
      let quest_id = getCookie("iq");
     
	   

      /*$.ajax({    
          type: "POST",
          url: "includes/org.inc.php",             
          data: {type:"start", user_id:user_id},
          dataType: "json",                  
          success: function(data){   
           
		   
            if (page == "main" || page == ""){
              // $("#orgbox").show();
              // $("#orgbox2").hide();
              // $("#orgbox3").hide();
              // $("#orgbox4").hide();
              // $("#orgbox5").hide();
              // $("#mission").html(data.description);

            }
            if (page == "student"){
              // $("#orgbox2").show();
              // $("#orgbox").hide();
              // $("#orgbox3").hide();
              // $("#orgbox4").hide();
              // $("#orgbox5").hide();
              //alert(org_id);
              
			        //getPurchasedIQs(org_id);
			 
	
              
            }
            if (page == "shask"){
              // $("#orgbox3").show();
              // $("#orgbox2").hide();
              // $("#orgbox4").hide();
              // $("#orgbox5").hide();
              // $("#orgbox").hide();

              // getPaymentPage('Payment', 1, 'IQ');

              
            }
                       
          
            //var validation_status = data.status;
        
            
          },
          // complete: function(){
          //     //send registraion confirmation emails 
          //     //sendRegistrationConfirmation (email,  code);
          // },
          error: function(error){
            console.log("Error:");
            console.log(error);
            $("#error").show();                 
            $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+ error); 
            
          },
      });
*/


    }



function get_politician_engagement_by_user(type) {
	$('#spinner').show()
	$("#politician_engagements").html(''); 
	$.ajax({    
		type: "POST",
		url: "../includes/politician.inc.php",             
		data: {type:"politician_engagements_by_user", engagement_type: type, view_type:"politician_profile"},
		dataType: "html",                  
		success: function(data){ 
			//console.log(data);  			
			$("#politician_engagements").html(data); 
		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});

}

function get_constituent_politician_engagement_by_user(type) {
	$.ajax({    
		type: "POST",
		url: "../includes/politician.inc.php",             
		data: {type:"constituent_politician_engagements_by_user", engagement_type: type},
		dataType: "html",                  
		success: function(data){ 
			//console.log(data);  			
			$("#politician_engagements").html(data); 
		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});

}

function get_politician_engagement_of_user(type, view_type) {
	$('#spinner').show() 	
	$("#politician_engagements").html(''); 

	view_type = 'constituent_engagement';
	$.ajax({    
		type: "POST",
		url: "../includes/politician.inc.php",             
		data: {type:"constituent_politician_engagements_by_user", engagement_type: type, view_type:view_type},
		dataType: "html",                  
		success: function(data){ 
			//console.log(data);  			
			$("#politician_engagements").html(data); 
		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});

}

function getTriageView(page){

	$('#spinner').show() 	
	$("#politician_engagements").html(''); 

	$.ajax({    
			type: "POST",
			url: "../includes/dashboard.inc.php",             
			data: {type:"admin", page:page },
			dataType: "html",                  
		success: function(data){ 
			//console.log(data);  			
			$("#politician_engagements").html(data); 
			$('#spinner').hide() 	

		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});

}

function getTriageViewUser(b){
	$('#spinner').show() 	
	$("#politician_engagements").html(''); 

	getDashboardPage('triage_timeline_user', b);

}

function get_politician_engagements_of_user(type, view_type) {
	$('#spinner').show() 	
	$("#politician_engagements").html(''); 
	$.ajax({    
		type: "POST",
		url: "../includes/politician.inc.php",             
		data: {type:"politician_engagements_of_user", engagement_type: type, view_type:view_type},
		dataType: "html",                  
		success: function(data){ 
			//console.log(data);  			
			$("#politician_engagements").html(data); 
		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});

}

function get_politician_engagement_by_user_for_userProf(type) {
	$('#spinner').show()
	$("#politician_engagements").html(''); 
	$.ajax({    
		type: "POST",
		url: "../includes/politician.inc.php",             
		data: {type:"get_politician_engagement_by_user_for_userProf", engagement_type: type},
		dataType: "html",                  
		success: function(data){ 
			//console.log(data);  			
			$("#politician_engagements").html(data); 
		},
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+ error); 
			
		},
	});

}

	
function updateQestion(question_id){

	// $.ajax({    
	// 	type: "POST",
	// 	url: "../includes/engagement.inc.php",             
	// 	data: {type:"update_iq", iq: question_id},
	// 	dataType: "html", 
	// 	success: function(data){ 
	// 		console.log(data);  			
			
	// 	},                 
		
	// 	error: function(error){
	// 		console.log("Error:");
	// 		console.log(error);
	// 		$("#error").show();                 
	// 		$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
	// 	},
	// });

	//alert("the new question is : "+question_id);
	setCookiebyDuration("iq", question_id, 1, "days" );
	getDashboardPage('engage');


}

function setCookiebyDuration(cname, cvalue, amt, timetype) {
	const d = new Date();
	if(timetype == 'days'){
		d.setTime(d.getTime() + (amt*24*60*60*1000));
	}
	if(timetype == 'hours'){
		d.setTime(d.getTime() + (amt*60*60*1000));
	}
	if(timetype == 'minutes'){
		d.setTime(d.getTime() + (amt*60*1000));
	}
	
	let expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function deleteCookie(cname, cvalue, exhours) {
	cvalue = "";
	const d = new Date();
	d.setTime(d.getTime() - (exhours*60*60*1000));
	let expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}


function getOrganizationPage(page, js_flag, variable) {

			$.ajax({    
			type: "POST",
			url: "../includes/org.inc.php",             
			data: {type:page, variables:variable },
			dataType: "html",                
			success: function(data){   
				//console.log(data);               
				$("#organization_functions").html(data); 
				if(js_flag === 1){
					$.getScript('JS/'+page+'.js', function() {
						console.debug('Script loaded.');
					});
				}	
			
			},
			// complete: function(){
			
			// 	//showIQPosts();
			// },
			error: function(error){
				console.log("Error:");
				console.log(error);
				$("#error").show();                 
				$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
				
			},
		});

}

function getPaymentPage(page, js_flag, variable) {

	$.ajax({    
		type: "POST",
		url: "../includes/stripe.inc.php",             
		data: {type:page, variables:variable },
		dataType: "html",                
		success: function(data){   
			//console.log(data);               
			$("#organization_functions").html(data); 
			if(js_flag === 1){
				$.getScript('JS/'+page+'.js', function() {
					console.debug('Script loaded.');
				});
			}	

		},
		// complete: function(){

		// 	//showIQPosts();
		// },
		error: function(error){
			console.log("Error:");
			console.log(error);
			$("#error").show();                 
			$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
			
		},
	});

}





	var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

// function add_resource(a){
// 	url = document.getElementById(a).value;
// 	//alert(url);
// 	id = document.getElementById('question_id').value;
// 	alert(id);
	
//   if(pattern.test(url)){
// 		$.ajax({    
// 						type: "POST",
// 						url: "../includes/iqwriter.inc.php",             
// 						data: {"type":"add_resource","res_url":url, "IQid":id},
// 						dataType: "html",                  
// 						success: function(data){                    
// 							$("#resources").html(data);
// 							$("#new_resource_date").datepicker();
// 						//window.location.href = 'issuelist.php';
// 						}
// 		});
// 	}else{
// 		document.getElementById('new_resource_message').innerHTML = 'Not Saved: You need to provide an exact URL.';
// 		//alert('well that did not work');
// 	}	
// 	$(document).ready(function() {
// 		$("#new_resource_date").datepicker();
// 		  $(function() {
// 			  $("#new_resource_date").datepicker();
// 		  });
// 	  })
// 	$(function() {
// 			  $("#new_resource_date").datepicker();
// 		  });
// 		  $("#new_resource_date").datepicker();
// }

// function update_resource(a, resID){
// 	url = document.getElementById(a).value;
// 	id = document.getElementById('id').value;
// 	if(pattern.test(url)){
// 		//alert('in');
// 		$.ajax({    
// 						type: "POST",
// 						url: "../includes/iqwriter.inc.php",             
// 						data: {"type":"update_resource","res_url":url, "res_id":resID , "IQid":id},
// 						dataType: "html",                  
// 						success: function(data){                    
// 							$("#resources").html(data);
// 						}
// 		});
// 	}else{
// 		//alert('out');
// 		document.getElementById('resource_mess_'+resID).innerHTML = 'Not Saved: You need to provide an exact URL.';
// 		//alert('well that did not work');
// 	}
		
// }	

function delete_res(a){
	id = document.getElementById('id').value;
	$.ajax({    
			        type: "POST",
					url: "../includes/IQWriter.inc.php",             
			        data: {"type":"delete_resource", "res_id":a, "IQid":id},
			        dataType: "html",                  
			        success: function(data){                    
			        	 $("#resources").html(data);
			           //window.location.href = 'issuelist.php';
			        }
	});
}

function character_count(column){
	characters = document.getElementById(column).value;
	characters = characters.length
	document.getElementById('character_count_' + column).innerHTML = characters
}

function update_subcat(id){

	subcat_id = document.getElementById('subcat_id');
	subcat_id = subcat_id.options[subcat_id.selectedIndex].value;
	cat_id = document.getElementById('cat_id');
	cat_id = cat_id.options[cat_id.selectedIndex].value;
	//alert(cat_id);
	//console.log(a + ' ' + region_id + ' ' + id);
	$.ajax({    
		type: "POST",
		url: "../includes/IQwriter.inc.php",             
		data: {"type":"subcategory_update", "cat_id":cat_id, "Sub_cat_id":subcat_id, "IQid":id},
		dataType: "html",                  
		success: function(data){   
			//alert(data);                 
			$("#category_change").html(data);

			//window.location.href = 'issuelist.php';
		}
	});
}

function update_cat(id){

	cat_id = document.getElementById('cat_id');
	cat_id = cat_id.options[cat_id.selectedIndex].value;
	//alert(cat_id);
	//console.log(a + ' ' + region_id + ' ' + id);
	$.ajax({    
		type: "POST",
		url: "../includes/IQwriter.inc.php",             
		data: {"type":"category_update", "cat_id":cat_id, "IQid":id},
		dataType: "html",                  
		success: function(data){   
						
			$("#category_change").html(data);
			//document.getElementById('region_updater')

			//window.location.href = 'issuelist.php';
		}
	});
}

function update_region(a){
	id = document.getElementById('id').value;
	region_id = document.getElementById('region_id');
	region_id = region_id.options[region_id.selectedIndex].value;
	//console.log(a + ' ' + region_id + ' ' + id);
	$.ajax({    
		type: "POST",
		url: "../includes/IQwriter.inc.php",             
		data: {"type":"add_question_region", "region":a, "region_id":region_id, "IQid":id},
		dataType: "html",                  
		success: function(data){                 
			$("#region_updater").html(data);

			//window.location.href = 'issuelist.php';
		}
	});
}

function update(column, type, a){
	data_sub = document.getElementById(column).value;
	if (column == "img1"){
		data_sub = a + ".png"
	}
	region_id = 'a';

	alert(type);
	$.ajax({    
			        type: "POST",
					url: "../includes/IQwriter.inc.php",             
					data: {"type":"update_question_elements", "questID":a, "column":column, "value":data_sub, "element_type":type},
			        dataType: "html",                  
			        success: function(data){  
						//console.log(data);                  
						document.getElementById('colmessage_' + column).innerHTML = data;
						if(!data.includes('Updated Successfully')) colorpick = 'red';
						else colorpick = 'green';
						document.getElementById('colmessage_' + column).style.color = colorpick;
						if(column == 'IQ_title') document.getElementById('title_'+a).innerHTML = data_sub;

					}
	});
}

function generate(a){
	$.ajax({    

					type: "POST",
					url: "../includes/org.inc.php",         
			        data: {"type":"generate_iq",},
			        dataType: "html",                  
			        success: function(data){ 
						//console.log(data);                   
			            $("#organization_functions").html(data);
			           //window.location.href = 'issuelist.php';

			        }
	});
}	

function submit_pin(a){
	pin = document.getElementById('pin_code').value
	$.ajax({    

		type: "POST",
		url: "../includes/user.inc.php",         
		data: {"type":"submit_pin","pin_code":pin},
		dataType: "html",                  
		success: function(data){ 
			if(data == 'verified'){

				Swal.fire({
							title: 'Congratulations.<br> Your Politician access is granted!',
							html: 'What do you want to do next?<br>',
							showDenyButton: true,
								showCancelButton: true,
								confirmButtonText: 'Engage your Politicians',
								denyButtonText: 'Have Your Say',
								cancelButtonText: 'My Dashboard',
								customClass: {
									actions: 'my-actions',
									cancelButton: 'order-1 right-gap',
									confirmButton: 'order-2',
									denyButton: 'order-3',
								},
								customClass: {
									confirmButton: 'Custom_Engage',
									denyButton: 'Custom_WOT',
									cancelButton: 'Custom_Cancel'
								},
								}).then((result) => {
									if (result.isConfirmed) {
										if(getCookie('iq') != ''){
											document.location.href = 'index_dashboard.php?page=engage' ; 	
										}else{
											Swal.fire('You need to answer questions first', '', 'warning').then((result) => {
												document.location.href = 'index.php' 
											});
										}    
									} else if (result.isDenied) {
											document.location.href = 'index.php' 
										}else {
											window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=user_dash'; 
										}   
							})
			}else{
				Swal.fire('Sorry, your entered PIN doesn\'t match!', '', 'error');
			}
		}
	});
}


function showmore(a){
	$.ajax({    
			        type: "GET",
			        url: "issuelist.php",             
			        data: {"type_id":"showmore","id":a, "price_id":a},
			        dataType: "html",                  
			        success: function(data){                    
			          //  $("#more"a).html(data);
			        }
	});
}
selected_row = '1';

var uncolour = null;
function hover(a){
		
				c = document.getElementById(a);
				if(selected_row != a) c.style.backgroundColor = 'Lightgreen';

	}
	function hover_out(a){

				c = document.getElementById(a);
				if(selected_row != a) c.style.backgroundColor = '';

	}
	function privateEmailComment(a){

		Swal.fire({
			title: 'Private Comment?',
			html: "Are you sure you want privatize this comment?",
			icon: 'question',
			// showDenyButton: true,
			confirmButtonColor: '#1c1c1c',
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes.',
			confirmButtonAriaLabel: 'Thumbs up, Yes!',
			denyButtonText:
				'<i class="fa fa-thumbs-down"></i> No, my mistake',
				customClass: {
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel'
},
			denyButtonAriaLabel: 'Thumbs down'
									
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {

		$.ajax({    
			        type: "POST",
			        url: "includes/cityview.inc.php",             
			        data: {"type":"privateEmailComment","commentID":a},
			        dataType: "html",                  
			        success: function(data){  
						Swal.fire({
			title: 'Comment Privated!',
			html: "",
			icon: 'success',
			// showDenyButton: true,
			confirmButtonColor: '#1c1c1c',
			
			
			}).then((result) => {

				location.reload()
			})
						
			          //  $("#more"a).html(data);
			        }
	});
}})

	}

	function privateComment(a){

		Swal.fire({
			title: 'Private Comment?',
			html: "Are you sure you want privatize this comment?",
			icon: 'question',
			// showDenyButton: true,
			confirmButtonColor: '#1c1c1c',
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes.',
			confirmButtonAriaLabel: 'Thumbs up, Yes!',
			denyButtonText:
				'<i class="fa fa-thumbs-down"></i> No, my mistake',
				customClass: {
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel'
},
			denyButtonAriaLabel: 'Thumbs down'
									
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {

		$.ajax({    
			        type: "POST",
			        url: "includes/cityview.inc.php",             
			        data: {"type":"privateComment","commentID":a},
			        dataType: "html",                  
			        success: function(data){  
						Swal.fire({
			title: 'Comment Privated!',
			html: "",
			icon: 'success',
			// showDenyButton: true,
			confirmButtonColor: '#1c1c1c',
			
			
			}).then((result) => {

				location.reload()
			})
						
			          //  $("#more"a).html(data);
			        }
	});
}})

	}

function main_window(a,b,c,d){
		if(a == 'hadsay'){
			go = "hadmysayxs.php";
		}else if(a == 'issue'){
			go = "issues_xs.php";
		}
		
		$.ajax({    
		        type: "GET",
		        url: go,             
		        dataType: "html", 
				data: {"view":b,"id":c,"cat":d,"subcat":c},
		        success: function(data){                    
					$("#settings").html(data); 
					document.getElementById('settings').style.display = 'none';
					document.getElementById('IQmaster').style.display = 'none';
					document.getElementById('settings').style.innerHTML = '';
					document.getElementById('IQmaster').style.innerHTML = '';
					document.getElementById('settings').style.display = '';
					document.getElementById('options').style.display = 'none';
					document.getElementById('options').style.innerHTML = '';
					//newtop = window.scrollY + 60;
					newtop = 100;
					document.getElementById('settings').style.top = newtop + 'px';
					window.scrollTo(1,1);
					//document.getElementById('main').style.background = 'rgba(169,169,169, 0.5)';
					//document.body.style.overflow = 'hidden';
				}
		    });
	}
<?php 

if(isset($_SESSION['admin_type']) && $_SESSION['admin_type'] >= 1 || isset($_SESSION['user_type']) && $_SESSION['user_type'] >= "EP"){
?>
function previewIQ(a){
//console.log('preview', a);
	$.ajax({    
		type: "POST",
		url: "../includes/modal_generator.inc.php",         	             
		data: {"type":"privew_IQ","id":a},
		dataType: "html",                   
		success: function(data){   
			UIkit.modal('#modal-full').show();
      
			$("#modalpanel").html(data); 
		
			//console.log(data);
		}
	});
}

<?php } ?>

<?php



if(isset($_SESSION['admin_type']) && $_SESSION['admin_type'] >= 1){ ?>

function go_editor_approval(id){
	$.ajax({    
		type: "POST",
		url: "../includes/IQWriter.inc.php",         	             
		data: {"type":"go_editor_approval","id":id},
		dataType: "html",                  
		success: function(data){                    
			document.getElementById('status').innerHTML = 'Out for Publication';
			document.getElementById('status').style.color = 'Green';
			document.getElementById("approve").style.display = "none";
		//window.location.href = 'issuelist.php';
		}
	});
}

function go_make_live(id){

	oldID = document.getElementById('img1')

	email_notification = document.getElementById('email_notification')
	// alert(oldID.value)
	// console.log('oldID')
	// console.log(id)
	$.ajax({    
		type: "POST",
		url: "../includes/IQWriter.inc.php",         	             
		data: {"type":"go_publish_live","id":id, "oldID":oldID.value, "email_notification":email_notification.value},
		dataType: "html",                  
		success: function(data){       
			document.getElementById('status').innerHTML = 'Published Live';
			document.getElementById('status').style.color = 'Green';
			document.getElementById("approve").style.display = "none";
			Swal.fire('Published Live', '', 'success');
		//window.location.href = 'issuelist.php';
		}
	});
}
	


	
function goapproval(a){
		//alert('hoooo');
		message=0;
		qasked = document.getElementById('qasked').value
		if(qasked.length === 0){
			message =1
		}
		descr = document.getElementById('descr').value
		if(descr.length === 0){
			message =1
		}
		c1 = document.getElementById('c1').value
		if(c1.length === 0){
			message =1
		}
		c2 = document.getElementById('img1').value
		if(c2.length === 0){
			message =1
		}
		if(c2.length === 0){
			message =1
		}
	//console.log(message)

	//message.forEach(build_message)
	the_message = 'iQ Background, iQ being asked, and at least 2 answers must be added. ';

		//alert(the_message)
		if(message === 1){
			Swal.fire(the_message, '', 'error');
		}else{

			$.ajax({    
							type: "POST",
							url: "../includes/org.inc.php",         	             
							data: {"type":"go_for_approval","id":a},
							dataType: "html",                  
							success: function(data){                    
								$("#update").html(data);
								document.getElementById('submit_'+a).innerHTML = 'Out for Approval';
								document.getElementById('submit_'+a).style.color = 'red';
								$("#approve").html("");
								Swal.fire('Out for Approval', '', 'success');
							//window.location.href = 'issuelist.php';
							}
			});
		}
}
  <?php } ?>

//   const queryString = window.location.search;
//   const urlParams = new URLSearchParams(queryString);
//   const page = urlParams.get('page');
//   let subpage =urlParams.get("subpage");;
  //alert("get subpage: "+subpage);








</script>


<script>

$(document).ready(function() {
//alert($active);
  
});

function delete_answers(){
		Swal.fire({
			title: 'Delete my iQ Answers',
			html: "Are you sure you want erase all of your past iQ answers? This cannot be undone!",
			icon: 'info',
			// showDenyButton: true,
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonColor: "#1c1c1c",
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes, Delete my Answers',
				customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
					confirmButton: 'Custom_Deny',
					cancelButton: 'Custom_Cancel'
				},
			confirmButtonAriaLabel: 'Thumbs up, Yes!',
			denyButtonText:
				'<i class="fa fa-thumbs-down"></i> No, my mistake',
			denyButtonAriaLabel: 'Thumbs down'
									
			}).then((result) => {
				

				

				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					$.ajax({  
					type: "POST",
					url: "includes/user.inc.php",             
						data: {"type":"delete_IQ_answers"},
					dataType: "html",                  
					success: function(data1){ 
						if(data1 == 'Expired'){
							swal_expiry_message()
						}else{
							Swal.fire({title:'iQ Answers Deleted!', icon:'success',
								customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							})

							setCookiebyDuration('iq', 'delete', 1, 'seconds' );

							window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=paneBilling';  
							// getDashboardPage('basic_profile')
							// $("#ScopeandLocation").hide();
							// $("#paneProfile").hide();
							// $("#paneAccount").hide();
							// $("#paneNotification").hide();
							// $("#paneBilling").show();
						}
					
					}
				});
				} else if (result.isDenied) {
					Swal.fire('Your answers are safe', '', 'info')
				}
			});

}

function delete_smiles(){
		Swal.fire({
			title: 'Delete my Politician iQ Asks',
			html: "Are you sure you want erase all of your past Politician iQ Asks? This cannot be undone!",
			icon: 'info',
			// showDenyButton: true,
			// confirmButtonColor: '#3085d6',
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes, Delete my Politician iQ Asks',
				customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
					confirmButton: 'Custom_Deny',
					cancelButton: 'Custom_Cancel'
				},
			confirmButtonAriaLabel: 'Thumbs up, Yes, that is correct!',
			denyButtonText:
				'<i class="fa fa-thumbs-down"></i> No, my mistake',
			denyButtonAriaLabel: 'Thumbs down'
									
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					$.ajax({  
					type: "POST",
					url: "includes/user.inc.php",             
						data: {"type":"delete_IQ_asks"},
					dataType: "html",                  
					success: function(data1){ 
						Swal.fire({title:'All Politician Asks Deleted!', icon:'success',
								customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Cancel',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							})
					window.reload	
					getDashboardPage('basic_profile')
					$("#ScopeandLocation").hide();
					$("#paneProfile").hide();
					$("#paneAccount").hide();
					$("#paneNotification").hide();
					$("#paneBilling").show();				}
				});
				} else if (result.isDenied) {
					Swal.fire('Your Politician Asks are safe', '', 'info')
				}
			});

}

function delete_pokes(){
		Swal.fire({
			title: 'Delete my Politician iQ Shares',
			html: "Are you sure you want erase all of your past Politician iQ Shares? This cannot be undone!",
			icon: 'info',
			// showDenyButton: true,
			confirmButtonColor: '#3085d6',
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes, Delete my Politician iQ Shares',
			confirmButtonAriaLabel: 'Thumbs up, Yes, that is correct!',
			denyButtonText:
				'<i class="fa fa-thumbs-down"></i> No, my mistake',
				customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
					confirmButton: 'Custom_Deny',
					cancelButton: 'Custom_Cancel'
				},
			denyButtonAriaLabel: 'Thumbs down'
			
									
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					$.ajax({  
					type: "POST",
					url: "includes/user.inc.php",             
						data: {"type":"delete_IQ_shares"},
					dataType: "html",                  
					success: function(data1){ 
						Swal.fire({title:'All Politician Shares Deleted!', icon:'success',
								customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							})
					window.reload		
					getDashboardPage('basic_profile')
					$("#ScopeandLocation").hide();
					$("#paneProfile").hide();
					$("#paneAccount").hide();
					$("#paneNotification").hide();
					$("#paneBilling").show();
				
				}
				});
				} else if (result.isDenied) {
					Swal.fire('Your Politician Shares are safe', '', 'info')
				}
			});

}


function engagement_details(IQid){
	const mediaQuery = window.matchMedia("(max-width: 768px)")
	if (mediaQuery.matches) {
		var img_width = 300;
		var img_height = 200;
	}else{
		var img_width = 400;
		var img_height = 300;
	}
	content = document.getElementById(IQid).innerHTML;
	question = document.getElementById('question_' +IQid).innerHTML;
	full_content = '<b>' + question + '</b><br>' + content;

	image = document.getElementById('img_' +IQid).src;

		Swal.fire({
			title: '<span style="text-align: left; font-size:1.2rem">' + question + '</span>',
			confirmButtonText: "Close",
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			width:800,
			imageUrl: image,
			imageWidth: img_width,
			imageHeight: img_height,
			html: content,
			customClass: {
				container: 'iqdetails',
				confirmButton: 'Custom_Cancel'
			}

	
			});

}



		function check(a){
		
      		user_id = "<?php echo $_SESSION['user_id'] ?>";
      		//alert('test'+user_id);
				if(a.name == 'usertype'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'sex'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'race'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'age'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'matstat'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'relig'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'edu'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'inc'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'workty'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'health'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'cadhow'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
				if(a.name == 'polparty'){
					valued = a.options[a.selectedIndex].value;
					console.log(valued);
				}else{
					valued = a.value;
				}
        		//alert(valued);
				if (valued != ''){
					//window[a.name] = '1';
				}
					$.ajax({
				    url: "includes/user.inc.php",
				    type: 'POST',
				    dataType: "html",
				    data: {
				     type:'add_profile_info', column:a.name, value:valued, user_id:user_id
				    },
				    success: function(data) {
				      	if (data == 'Expired'){
							swal_expiry_message()
					    }else{
							document.getElementById(a.name+"_lbl").innerHTML = 'Updated';
							document.getElementById(a.name+"_lbl").style.color = 'Green'; 		 
					 	}
				    }
				   });
		}

		function checkcs(a){
		
		//alert('test'+user_id);
		//   if(a.name == 'fname'){
		// 	//   valued = a.options[a.selectedIndex].value;
		// 	  console.log(valued);
		//   }else{
			  
		//   }
		
		//   if(a.name == 'tel'){
		// 	  valued = a.options[a.selectedIndex].value;
		// 	  console.log(valued);
		//   }else{
		// 	  valued = a.value;
		//   }
		//   if(a.name == 'tel1'){
		// 	  valued = a.options[a.selectedIndex].value;
		// 	  console.log(valued);
		//   }else{
		// 	  valued = a.value;
		//   }
		//   if(a.name == 'squest'){
		// 	  valued = a.options[a.selectedIndex].value;
		// 	  console.log(valued);
		//   }else{
		// 	  valued = a.value;
		//   }
		//   if(a.name == 'sqans'){
		// 	  valued = a.options[a.selectedIndex].value;
		// 	  console.log(valued);
		//   }else{
		// 	  valued = a.value;
		//   }
		  
		//   alert(a.value);
		//   if (valued != ''){
		// 	  //window[a.name] = '1';
		//   }
			  $.ajax({
			  url: "includes/user.inc.php",
			  type: 'POST',
			  dataType: "html",
			  data: {
			   type:'add_contact_info', column:a.name, value:a.value
			  },
			  success: function(data) {
					if (data == 'Expired'){
					  swal_expiry_message()
				  }else{
					  document.getElementById(a.name+"_lbl").innerHTML = 'Updated';
					  document.getElementById(a.name+"_lbl").style.color = 'Green'; 		 
						if (a.name == 'fname') {
							data_names.fname = a.value;

						}
						 if (a.name == 'lname') {
							data_names.lname = a.value;
						
						}
					  if (a.name == 'fname' || a.name == 'lname') {
						$.ajax({
							type: 'POST',
							url: "includes/sessions.inc.php",             	
							dataType: "html",
							data: data_names,
							success: function(data) {

							},
							error: function(XMLHttpRequest, textStatus, errorThrown) { 
								alert("Status: " + textStatus); alert("Error: " + errorThrown); 
							} 
						});
						
					}
				   }
			  }
			 });
  }



		function lookup_postal(user_id){
      		 // alert('hi');
			code = document.getElementById('pcode').value;

			code = code.toUpperCase();
			code = code.replace(/ /g,'');
			code = code.replace(/-/g, '')
			if (code.length == 6){
			if (code.length >= 6) code = code.replace(/^(.{3})(.*)$/, "$1 $2");
				the_city = code;
				var regex = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i;
				var match = regex.exec(the_city);
				if (match){
					if ( (the_city.indexOf("-") !== -1 || the_city.indexOf(" ") !== -1 ) && code.length == 7 ) {
						got_postal(code, user_id);
					} else if (code.length == 6 ) {
						got_postal(code, user_id);
					}
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Your postal code doesn\'t look right',
						footer: 'Example: L8N 1C6',
						customClass: {
							confirmButton: 'Custom_Confirm',
							denyButton: 'Custom_Deny',
							cancelButton: 'Custom_Cancel'
						},
					})
				}
			}else{
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Your postal code doesn\'t look right',
					footer: 'Example: L8N 1C6',
					customClass: {
						confirmButton: 'Custom_Confirm',
						denyButton: 'Custom_Deny',
						cancelButton: 'Custom_Cancel'
					},

				})
			}
			document.getElementById('pcode').value = code;

		}

		function swal_expiry_message(){
			Swal.fire({
				title: 'Your session has expired!',
				text: "We value your security and data protection. Please login to continue your user experience. Thank you.",
				icon: 'warning',
				
				confirmButtonColor: '#3085d6',
				
				confirmButtonText: 'OK'
				}).then((result) => {
				if (result.isConfirmed) {
					document.location.href = 'login.php' ;    
				}
			})
		}

		function got_postal(pcode, user_id){

			$.ajax({
				url: "includes/geolocation.inc.php",             
				type: 'post',
				dataType: "json",
							data: {
								"type": "get_coor_from_postal",
								"postal_code": pcode
							},
							success: function(data) {

								//console.log(data)
								// exit();

								if(data.city == null){
						Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Your postal code doesn\'t look right',
						footer: 'Example: L8N 1C6',
						customClass: {
							confirmButton: 'Custom_Confirm',
							denyButton: 'Custom_Deny',
							cancelButton: 'Custom_Cancel'
						},
					})
					 }else {

								
								// if (data.herecom == undefined) {


								// 	data.district = ""
								// 	data.county = ""


								// 	for (const component of data.results[0].address_components) {
								// 		// @ts-ignore remove once typings fixed
								// 		const componentType = component.types[0];
								// 		switch (componentType) {
      
       

								// 			case "postal_code": {

								// 				pcode = component.short_name
								// 				break;
								// 			}
     
								// 			case "administrative_area_level_3": {
								// 				// console.log(component.long_name)
								// 				data.city = component.short_name
								// 				// document.querySelector("#city").value = component.short_name;
								// 				break;
								// 			}

								// 			case "administrative_area_level_1": {
								// 				// console.log(component.long_name)
								// 				data.province_code = component.short_name

								// 				data.province = component.long_name
								// 				// document.querySelector("#city").value = component.short_name;
								// 				break;
								// 			}

								// 			case "country": {
								// 				// console.log(component.long_name)
								// 				data.country = component.long_name
								// 				// document.querySelector("#city").value = component.short_name;
								// 				break;
								// 			}
		

		
								// 		}
								// 	}

								// 	data.latitude = data.results[0].geometry.location.lat
								// 	data.longitude = data.results[0].geometry.location.lng
								// 	// console.log(country)



								// }

								if(data.district == null){
								district = ", ";
							}else{
								district = " (" + data.district + "), "
							}


						Swal.fire({
							title: 'Confirm your Location',
							html: "Based on your postal code: <b>" + pcode + "</b>,<br> we have you located in <b>" + data.city + district + data.province_code + "</b>. <br> Is this correct?",
							icon: 'info',
							showDenyButton: true,
							confirmButtonColor: '#3085d6',
							showCloseButton: true,
							showCancelButton: false,
							focusConfirm: false,
							confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes, that\'s correct!',
							confirmButtonAriaLabel: 'Thumbs up, Yes',
							customClass: {
								closeButton: 'uk-modal-close-full icon-cross2',
								confirmButton: 'Custom_Confirm',
								denyButton: 'Custom_Deny',
								cancelButton: 'Custom_Cancel'
							},
							denyButtonText:'<i class="fa fa-thumbs-down"></i> No, let\'s try that again',
							denyButtonAriaLabel: 'Thumbs down'
													
							}).then((result) => {
								/* Read more about isConfirmed, isDenied below */
								if (result.isConfirmed) {
									//setcity, province and postal code scope cookies here
									 lat = data.latitude; 
									 long = data.longitude;
									 city = data.city;
									 province = data.province;
									 province_code = data.province_code;
									 county = data.county;
									 district = data.district;
									 country = data.country;

									console.log(data.latitude)
									console.log(country)
									
										$.ajax({    
											type: "POST",
											url: "includes/login.inc.php",             
											data: {type:"saveprofile", user_id:user_id, lat:lat,long:long, city:city, district:district, pcode:pcode, county:county, province_code:province_code, country:country },
											dataType: "html",                  
											success: function(data){   
												if(data == 'Expired'){
													swal_expiry_message();
												}else{


													





													
												$.ajax({    
													type: "POST",
													url: "includes/login.inc.php",             
													data: {type:"checkprofile", user_id:user_id},
													dataType: "json",                  
													success: function(data){ 
														jsonstr = JSON.stringify(data);
													
														
														
														$.ajax({
														type: 'POST',
			url: "includes/sessions.inc.php",             
		
		dataType: "html",
		data: {type:"set_postal", postal_code:pcode, city:data.city, province:province_code, country:country, lat:lat, long:long, county:district},
		success: function(data) {
			

			// console.log(data)
			// console.log('success')


		}




		})


														

														Swal.fire({
															title: 'Success',
															text: "Your location has been set. You can now set up your politician access by providing your home address.  We will mail your activation PIN to that location.",
															icon: 'success',
															showDenyButton: true,
															confirmButtonColor: '#3085d6',
															cancelButtonColor: '#d33',
															confirmButtonText: 'Ok, let\'s do it!',
															customClass: {
																confirmButton: 'Custom_Confirm',
																denyButton: 'Custom_Deny',
																cancelButton: 'Custom_Cancel'
															},
															denyButtonText: '<i class="fa fa-thumbs-down"></i> No, not just yet',
															denyButtonAriaLabel: 'Thumbs down'
															}).then((result) => {
																if (result.isConfirmed) {


																	
																	$("#postal_info").html('');
																	window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=paneNotification';
																} else if (result.isDenied) {
																	window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=ScopeandLocation';
																}
														});
													}
												});
											}
											}
										});
											
								} else if (result.isDenied) {
								}
					});
				
				}						
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    } 
			
			});
		}
		function deleteCookie(cname, cvalue, exhours) {
			cvalue = "";
			const d = new Date();
			d.setTime(d.getTime() - (exhours*60*60*1000));
			let expires = "expires="+ d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
		
		function remove_Korprof1(){
    			Swal.fire({
						title: 'Remove Location Information',
						html: "Are you sure you want to delete and re-enter your location information?",
						icon: 'info',
                        // showDenyButton: true,
						confirmButtonColor: '#3085d6',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                          '<i class="fa fa-thumbs-up"></i> Yes, let\'s try again!',
                        confirmButtonAriaLabel: 'Thumbs up, Yes, that\'s correct!',
						customClass: {
							closeButton: 'uk-modal-close-full icon-cross2',
							confirmButton: 'Custom_Deny',
							cancelButton: 'Custom_Cancel'
						},
                        denyButtonText:
                          '<i class="fa fa-thumbs-down"></i> No, my location is correct',
                        denyButtonAriaLabel: 'Thumbs down'
												
						}).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
								$.ajax({  
									type: "POST",
									url: "includes/user.inc.php",             
									data: {"type":"delete_user_korprof1"},
									dataType: "html",                  
									success: function(data){ 
										if(data == 'Expired'){
											swal_expiry_message()
										}else{
										//alert('hi');
											Swal.fire({
												title: 'Success',
												text: "Your Scope of View has been reset. Let's add your new postal code.",
												icon: 'success',
												confirmButtonColor: '#3085d6',
												cancelButtonColor: '#d33',
												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Deny',
													cancelButton: 'Custom_Cancel'
												},
												confirmButtonText: 'Ok'
												}).then((result) => {
													if (result.isConfirmed) {
														$("#postal_info").html('')
														window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=ScopeandLocation';
													}
											});
										}
								}
                            });
                            } else if (result.isDenied) {
                              Swal.fire('Location information is unchanged', '', 'info')
                            }
                        });
                        
										
   
      

  }

		function removeProfile_korprof2(){
			user_id = "<?php echo $_SESSION['user_id']?>"
			    $.ajax({  
			    	type: "POST",
			    	url: "includes/user.inc.php",             
			    		data: {"type":"removeProfile_korprof2", user_id:user_id},
			    	dataType: "html",                  
			    	success: function(data){ 
			    		Swal.fire({
							icon: 'warning',
  							title: 'Do you want to delete your User Information?',
  							showCancelButton: true,
  							confirmButtonText: 'Delete',
							  customClass: {
								confirmButton: 'Custom_Deny',
								cancelButton: 'Custom_Cancel'
							},
						}).then((result) => {
  							/* Read more about isConfirmed, isDenied below */
  							if (result.isConfirmed) {
    						Swal.fire({title:'Deleted!', icon:'success',
								customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							}).then(()=>{
								location.reload();
							})
							
  						}})
			    	}
					
			    })	
		}

		function remove(){
			
			Swal.fire({
					icon: 'warning',
					title: 'Do you want to delete your Contact Settings?',
					showCancelButton: true,
					confirmButtonText: 'Delete',
					customClass: {
						confirmButton: 'Custom_Deny',
						cancelButton: 'Custom_Cancel'
					},
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {
						$.ajax({  
							type: "POST",
							url: "includes/user.inc.php",
							data: {type:"delete_contact_engine_profile", user_id:user_id},
							dataType: "html",   
							success: function(data){
								if(data == 'Expired'){
									swal_expiry_message()
								}else{
							
									Swal.fire({title:'Deleted!', icon:'success',
								customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							}).then(()=>{
										location.reload();	
									})
								}
							}               
						})
							
  				}})
		}

		function remove_address(){
			
			Swal.fire({
					icon: 'warning',
					title: 'Are you sure you want to delete your address and reset your PIN? You will no longer be able to engage politicians until a new PIN has been confirmed.',
					showCancelButton: true,
					customClass: {
						confirmButton: 'Custom_Deny',
						denyButton: 'Custom_Deny',
						cancelButton: 'Custom_Cancel'
					},
					confirmButtonText: 'Delete',
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {
						$.ajax({  
							type: "POST",
							url: "includes/user.inc.php",
							data: {type:"delete_address_from_contact_engine_profile", user_id:user_id},
							dataType: "html",   
							success: function(data){
								if(data == 'Expired'){
									swal_expiry_message()
								}else{
									Swal.fire({title:'Deleted!', icon:'success',
								customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							}).then(()=>{
										window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=ScopeandLocation';
									})
								}
							}               
						})
							
  				}})
		}

		function show_upload(){
			document.getElementById('upload_form').style.display = '';
			document.getElementById('show_upload').style.display = 'none';
		}

		function showspinner(){
			$('#spinner').removeAttr('hidden'); 
		}

		function uploadFile(){
		
			// const loginBtn = document.getElementById("btn-upload");
			// loginBtn.classList.add("loading");
			// // Hide loader after success/failure - here it will hide after 2seconds
			// setTimeout(() => loginBtn.classList.remove("loading"), 3000);
		
			var file = _("file1").files[0];
			//alert(file.name+" | "+file.size+" | "+file.type);
			//document.getElementById("filename").value = file.name;
			//alert("upload file");
			var formdata = new FormData();
			formdata.append("file1", file);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", completeHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", "includes/org_logo_uploader.inc.php");
			ajax.send(formdata);

			//saveVideoFiletoDB(document.getElementById("file1").value);
		}
		function progressHandler(event){
			$('#progressBar').removeAttr('hidden'); 
				_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
				var percent = (event.loaded / event.total) * 100;
				_("progressBar").value = Math.round(percent);
				_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
			}
		function completeHandler(event){
			_("status").innerHTML = event.target.responseText;
			_("progressBar").value = 0;
			saveVideoFiletoDB(); 
		
		}
		function errorHandler(event){
			_("status").innerHTML = "Upload Failed";
		}
		function abortHandler(event){
			_("status").innerHTML = "Upload Aborted";
		}


		function saveVideoFiletoDB(){
			//e.preventDefault();
		
			var formData = new FormData();
				var files = $('#file1')[0].files;
				var filename = document.getElementById('file1').value;
			var column  = "answer_link";
		
			org_id = getCookie('org_id') ;
			
				filename = filename.slice(12);
		
				if (assignment_id > 0 && user_id >0){
				
					$.ajax({  
						type: "POST",
						url: "includes/org.inc.php",             
						data: {type:"add_logo", org_id:org_id, filename:filename},
						dataType: 'html',                  
						success: function(data){  
							//console.log(data);
							//window.location.href = 'IQed_next.php';
						},
						error: function(data){
									console.log("error");
									console.log(data);
						}
						});
				}else{
					
					alert("Your session has expired please log in again");

				}

		}

		function update_org_prof_1(){
			org_id = getCookie('org_id');
			oname = document.getElementById('oname').value;
			descr = document.getElementById('descr').value;
			url = document.getElementById('url').value;
			Swal.fire({
				title: '<strong>Update Organization Profile</strong>',
				icon: 'info',
				html:
					'You are about to update the follow:<br>' +
					'<b>Organization Name:</b>: <i> ' + oname + '</i><br>' +
					'<b>Description/Purpose:</b>: <i> ' + descr + '</i><br>' +
					'<b>Website URL:</b>: <i> ' + url + '</i><br>' +
					'<br>Do you want to proceed?',
				showCloseButton: true,
				showCancelButton: true,
				focusConfirm: false,
				confirmButtonText:
					'<i class="fa fa-thumbs-up"></i> Yes!',
				confirmButtonAriaLabel: 'Thumbs up, great!',
				cancelButtonText:
					'<i class="fa fa-thumbs-down"></i> No Thanks',
				cancelButtonAriaLabel: 'Thumbs down',
				customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({  
						type: "POST",
						url: "includes/org.inc.php",             
						data: {type:"update_org_prof_1", org_id:org_id, oname:oname, descr:descr, url:url},
						dataType: 'html',                  
						success: function(data){  
							
							if(data == 'Success'){
								Swal.fire(
									'Done!',
									'Your Organization Profile has been updated.',
									'success'
								)
							}else if(data == 'Failed'){
								Swal.fire(
									'Opps!',
									'There was an error with your entry.',
									'error'
								)
							}else if(data > 1){
								
								document.cookie = 'org_id=' + data;
								$('#sidemenu').load(' #sidemenu');
								getDashboardPage('org_add_profile');
								
								//window.location = 'dash_index.php?page=org_add_profile';
					
							}else{
								Swal.fire(
									'Sorry!',
									'<b>' + data + '</b><br><br>Please check your entry and try again.',
									'error'
								)
							}
						}
					})
				}
			})
		}

		function update_org_prof_2(){
			alert('hi');
			org_id = getCookie('org_id');
			email = document.getElementById('email').value;
			phone = document.getElementById('phone').value;
			Swal.fire({
				title: '<strong>Update Contact Details</strong>',
				icon: 'info',
				html:
					'You are about to update the follow:<br>' +
					'<b>Contact Email</b>: <i> ' + email + '</i><br>' +
					'<b>Office Phone Number</b>: <i> ' + phone + '</i><br>' ,
					
				showCloseButton: true,
				showCancelButton: true,
				focusConfirm: false,
				confirmButtonText:
					'<i class="fa fa-thumbs-up"></i> Yes!',
				confirmButtonAriaLabel: 'Thumbs up, great!',
				cancelButtonText:
					'<i class="fa fa-thumbs-down"></i> No Thanks',
				cancelButtonAriaLabel: 'Thumbs down',
				customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({  
						type: "POST",
						url: "includes/org.inc.php",             
						data: {type:"update_org_prof_2", email:email, phone:phone},
						dataType: 'html',                  
						success: function(data){  
							if(data == 'Success'){
								Swal.fire(
									'Done!',
									'Your Contact Details has been updated.',
									'success'
								)
							}else if(data == 'Failed'){
								Swal.fire(
									'Opps!',
									'There was an error with your entry.',
									'error'
								)
							}else{
								Swal.fire(
									'Sorry!',
									'<b>' + data + '</b><br><br>Please check your entry and try again.',
									'error'
								)
							}
						}
					})
				}
			})
		}
		
		function update_org_prof_3(){

			org_id = getCookie('org_id');
			address = document.getElementById('address').value;
			city = document.getElementById('city').value;
			province = document.getElementById('province').value;
			postal = document.getElementById('postal').value;
			Swal.fire({
				title: '<strong>Update Contact Details</strong>',
				icon: 'info',
				html:
					'You are about to update the follow:<br>' +
					'<b>Street Address</b>: <i> ' + address + '</i><br>' +
					'<b>City</b>: <i> ' + city + '</i><br>' +
					'<b>Provice</b>: <i> ' + province + '</i><br>' +
					'<b>Postal</b>: <i> ' + postal + '</i><br>' ,
					
				showCloseButton: true,
				showCancelButton: true,
				focusConfirm: false,
				confirmButtonText:
					'<i class="fa fa-thumbs-up"></i> Yes!',
				confirmButtonAriaLabel: 'Thumbs up, great!',
				cancelButtonText:
					'<i class="fa fa-thumbs-down"></i> No Thanks',
				cancelButtonAriaLabel: 'Thumbs down',
				customClass: {
					closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({  
						type: "POST",
						url: "includes/org.inc.php",             
						data: {type:"update_org_prof_3", address:address, city:city, province:province, postal:postal},
						dataType: 'html',                  
						success: function(data){  
							if(data == 'Success'){
								Swal.fire(
									'Done!',
									'Your Organization Location details has been updated.',
									'success'
								)
							}else if(data == 'Failed'){
								Swal.fire(
									'Opps!',
									'There was an error with your entry.',
									'error'
								)
							}else{
								Swal.fire(
									'Sorry!',
									'<b>' + data + '</b><br><br>Please check your entry and try again.',
									'error'
								)
							}
						}
					})
				}
			})
		}
		function displayImage(a){
			$('#attachedImage').toggle()
		}
		function displayBridgeImage(a){
			$('#attachedImage' + a).toggle()
		}
		function showDecryptComment(a){
			$('#decryptedcomment' + a).toggle()
		}

		function getContactEngineProfile(){
			notready = [];
			fname = document.getElementById('fname').value;
			lname = document.getElementById('lname').value;
			// address = document.getElementById('address').value;
			tel = document.getElementById('tel').value;
			tel1 = document.getElementById('tel1').value;
			squest = document.getElementById('squest').value;
			sqans = document.getElementById('sqans').value;
			
			// console.log(squest)
			if(fname == '') notready.push('First Name<span style="font-weight: 100;color:red">*</span>');
			if(lname == '') notready.push('Last Name<span style="font-weight: 100;color:red">*</span>');
			if(squest == '') notready.push('Security Question<span style="font-weight: 100;color:red">*</span>');
			if(sqans == '') notready.push('Enter security question answer<span style="font-weight: 100; color:red">*</span>');
			if(notready.length != 0){
				lastone = notready.length - 2;
				message = '';
				notready.forEach(function (item, index){
							message += item  + '<br> ';
					}
				);
				Swal.fire({
					title: 'Woops',
					html: "Please ensure that the following field(s) marked with a red asterisk <span style='color:red'>*</span> are filled out before submitting this form:<b><br><br>" + message + "</b>",
					icon: 'error',	
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'OK',
					customClass: {
						confirmButton: 'Custom_Confirm',
					},
				});
				exit;			
			}


			$.ajax({  
				type: "POST",
			    url: "includes/user.inc.php",
					data: {type:"save_contact_engine_profile", fname:fname ,lname:lname, tel:tel, tel1:tel1, squest:squest, sqans:sqans},
				dataType: "html",    
				success: function(data){ 
					if(data == 'Expired'){
						swal_expiry_message()
					}else{
						$.ajax({
							type: 'POST',
							url: "includes/sessions.inc.php",             	
							dataType: "html",
							data: {type:"set_name", fname:fname, lname:lname},
							success: function(data) {
							//	console.log(data)
							}
						})
						Swal.fire({
							title: 'Success',
							html: "Your Contact Settings have been saved",
							icon: 'success',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'OK'
							}).then((result) => {
								if (result.isConfirmed) {

									window.location.href = '<?php echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=basic_profile&subpage=paneAccount';	
									
								}
							})
					}
				}              
			})
			
		}

	</script>



		<style>
			.engaged{
				opacity:40%;
			}

			.engagement-dash{
				padding-left:2em;
				padding-right:2em; 
				height:90%; 
				padding-top:2em;
				bottom:2em; 
				height: fit-content
			}

		</style>

<script type='text/javascript'>
	////// Engagement Poke and smiles
	function getModalContent(content_id, content_type) {

	//alert("content_id="+content_id);
	//alert("content_type="+content_type);

		$.ajax({    
			type: "POST",
			url: "../includes/modal_generator.inc.php",             
			data: {type:"modalcontent", content_id:content_id, content_type:content_type},
			dataType: "html", 
			beforeSend : function() {
				$('#modalpanel').empty();
			},                 
			success: function(data){   
			//	console.log(data);  
					
				$("#modalpanel").html(data); 
			
			},
			// complete: function(){
			
			// 	//showIQPosts();
			// },
			error: function(error){
				console.log("Error:");
				console.log(error);
				$("#error").show();                 
				$("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
				
			},
		});

}

function poli_story(){
	
	$('#modalpanel').load('pages/poli_story.php');

}


function selectiQ(){
	event.stopPropagation();	


		selectedItems = $('.iqRow:checkbox:checked')
		// alert(selectedItems.length);

		if(selectedItems.length > 0){
			$('#deleteIQ').css('opacity', '100%')
			$('#deleteIQ').css('cursor', 'pointer')


		}else {
			$('#deleteIQ').css('opacity', '20%')
			$('#deleteIQ').css('cursor', 'default')

		}
}
function removeiQs(type){


	items = []
		$(".iqRow:checkbox:checked").each(function(){
			items.push($(this).val());
});

		if(items.length > 0){

			items.forEach(element => {
				
				$.ajax({    
			type: "POST",
			url: "includes/IQWriter.inc.php",             
			data: {type:"applyiQDelete", IQ:element},
			dataType: "html",
			complete: function(){
if(type == "E"){
	goto_issue('E')

}
if(type == "Editors_queue"){
				goto_issue('Editors_queue')
}
				// $('#deleteIQ').css('opacity', '20%')
				// $('#deleteIQ').css('cursor', 'default')
				// $('#alertList').replaceWith(data);

				// writertables

			}})




			}
		
		
		)}








}


function ask(repID, question_id){	
if(pin_status == 3){
	if(myReps.includes(Number(repID))){


	$.ajax({  
				type: "POST",
				url: "includes/engagement.inc.php",             
				data: {"type":"confirm_ask_politician", "repID":repID, "question_id":question_id},
				dataType: "json",                  
				success: function(data){
					if(data.return == 'Expired'){
						swal_expiry_message()
					}else if(data.return == 'Asked'){
						Swal.fire({
							title: 'Woops',
							text: "Error! You already 'Asked' " + data.repName + " their Opinion on this iQ",
							icon: 'error',
								
							confirmButtonColor: '#3085d6',
								
							confirmButtonText: 'OK'
							});
					}else{
						Swal.fire({
							title: "Are you sure you want to <b>Ask</b> " + data.repName + " for their Opinion on this iQ?",
							icon: 'question',
							showDenyButton: true,
							showCancelButton: true,
							confirmButtonText: 'Save',
							denyButtonText: `<i class="fa fa-eye"></i> Show Me the Message First`,
							denyButtonColor:'#749DFB',
								
							html:
								'You can check out the message going to ' +data.repName+ ' first too!</b> ',
							focusConfirm: false,
							confirmButtonText:
								'<i class="fa fa-thumbs-up"></i> Yes, Send!',
							confirmButtonAriaLabel: 'Thumbs up, great!',
							cancelButtonText:
								'<i class="fa fa-thumbs-down"></i> No, not at this time',
								customClass: {
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
							cancelButtonAriaLabel: 'Thumbs down'
							}).then((result) => {
							if (result.isConfirmed) {
								$.ajax({  
									type: "POST",
									url: "includes/engagement.inc.php",             
									data: {"type":"ask_politician", "repID":repID, "question_id":question_id},
									dataType: "json",                  
									success: function(data){
										
										
										console.log(data.repID + ' ' + data.repName + ' '  + data.return);	
										if(data.return == 'Success'){
											document.getElementById('p'+data.repID).style.opacity = '.3';
											Swal.fire({
												title: 'Ask Sent',
												text: "You've succesfully 'Asked' " + data.repName + " their Opinion on this iQ",
												icon: 'success',
													
												confirmButtonColor: '#3085d6',
												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Cancel',
													cancelButton: 'Custom_Cancel'
												},
																									
												confirmButtonText: 'OK'
												});
										}
									}
								});
						}else if (result.isDenied) {
								$.ajax({  
									type: "POST",
									url: "includes/engagement.inc.php",             
									data: {"type":"get_ask_message", "repID":repID, "question_id":question_id},
									dataType: "html",                  
									success: function(data1){

										
											Swal.fire({
												title: 'Ask Email Generated',
												html: data1,
												icon: 'info',
												showCloseButton: true,
												showCancelButton: true,
												focusConfirm: false,
												confirmButtonText:
													'<i class="fa fa-thumbs-up"></i> Ok, Send it!',
												confirmButtonAriaLabel: 'Thumbs up, great!',
												cancelButtonText:
													'<i class="fa fa-thumbs-down"></i> No, not at this time',
												cancelButtonAriaLabel: 'Thumbs down',
												customClass: {
													closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
											}).then((result) => {
							if (result.isConfirmed) {
								$.ajax({  
									type: "POST",
									url: "includes/engagement.inc.php",             
									data: {"type":"ask_politician", "repID":repID, "question_id":question_id},
									dataType: "json",                  
									success: function(data){
										console.log(data.repID + ' ' + data.repName + ' '  + data.return);	
										if(data.return == 'Success'){
											document.getElementById('p'+data.repID).style.opacity = '.3';
											Swal.fire({
												title: 'Ask Sent',
												text: "You've succesfully 'Asked' " + data.repName + " their Opinion on this iQ",
												icon: 'success',
													
												confirmButtonColor: '#3085d6',
												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Cancel',
													cancelButton: 'Custom_Cancel'
												},
																									
												confirmButtonText: 'OK'
												});
										}
									}
								});
								
								
								
								
								//document.location.href = 'index.php' ;    
							
						}
												});
										
									}
								});
					}})
					}    
				},
				error: function () {
            
        }
			});

		}else{
			Swal.fire({
							title: 'Woops',
							text: "Error! This politician does not represent you!",
							icon: 'error',
								
							confirmButtonColor: '#3085d6',
								
							confirmButtonText: 'OK'
							});
		}
	}else{
		Swal.fire({
							title: 'Woops',
							text: "You are not PIN verified!",
							icon: 'error',
								
							confirmButtonColor: '#3085d6',
								
							confirmButtonText: 'OK'
							});
	}
}


function poli_answer(rep_id, questID){
	content = document.getElementById('poli_answer' + rep_id + '-' + questID).innerHTML;
	name = document.getElementById('poli_name-' + rep_id).innerHTML;
	//full_content = '<b>' + question + '</b><br><br>' + content;

	image = document.getElementById('poli_image-' +rep_id).src;

		Swal.fire({
			title: name + ' Answered:',
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			customClass: {
																confirmButton: 'Custom_Confirm',
																denyButton: 'Custom_Deny',
																cancelButton: 'Custom_Cancel'
															},
			
			imageUrl: image,
			imageWidth: 'auto',
			imageHeight: 150,
			html: content,
	
			});

}

function no_shask(repID, question_id, pin){
	

	if(pin == '' || pin == '0'){	
		Swal.fire({
			title: "Looks like we haven't confirmed that you are a constituent for this politician. A PIN is required.",
			icon: 'error',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Save',
			denyButtonText: `<i class="fa fa-eye"></i> Tell me about why I need a PIN, first!`,
			// denyButtonColor:'#749DFB',
				
			html:
				'Would you like to get your PIN?',
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes, let\'s get started!',
			confirmButtonAriaLabel: 'Thumbs up, great!',
			customClass: {
			denyButton: 'Custom_Confirm',
    confirmButton: 'Custom_Confirm',
    cancelButton: 'Custom_Cancel'
},
			cancelButtonText:
				'<i class="fa fa-thumbs-down"></i> No, not at this time',
			cancelButtonAriaLabel: 'Thumbs down',
			
			}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = 'index_dashboard.php?page=basic_profile&subpage=paneNotification';
			}else if (result.isDenied) {
							Swal.fire({
								html: 'A PIN is a Personal Identification Number which is unique to each user. It is mailed to the user\'s home address and then verified to ensure the user is a real constituent in a politician\'s ward or riding. This security feature prevents bot or troll interference in our democracy.',
								
								icon: 'info',
								showCloseButton: true,
								showCancelButton: true,
								focusConfirm: false,
								confirmButtonText:
									'<i class="fa fa-thumbs-up"></i> Shall we get you a PIN?',
								confirmButtonAriaLabel: 'Thumbs up, great!',
								customClass: {
									closeButton: 'uk-modal-close-full icon-cross2',
				confirmButton: 'Custom_Confirm',
   
    cancelButton: 'Custom_Deny'
},
								cancelButtonText:
									'<i class="fa fa-thumbs-down"></i> No, not at this time',
								cancelButtonAriaLabel: 'Thumbs down'
							}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = 'index_dashboard.php?page=basic_profile&subpage=paneNotification';
							}
						}
			)}
		})
	}else if(pin == 1){
		Swal.fire('You can\'t engage your politicians until you have confirmed your PIN. A PIN has been requested and is on it\'s way! Keep an eye out in the mail', '', 'success')
	}else if(pin == 2){
		Swal.fire({
			title: "A PIN has been requested, and is in the mail!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Save',
			html:
				'Would you like to enter your PIN to unlock your Politician Access?',
			focusConfirm: false,
			confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Yes, I have my PIN Handy!',
			confirmButtonAriaLabel: 'Thumbs up, great!',
			cancelButtonText:
				'<i class="fa fa-thumbs-down"></i> No, I\'m not ready',
			cancelButtonAriaLabel: 'Thumbs down',
			customClass: {
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
			}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = 'index_dashboard.php?page=basic_profile&subpage=paneNotification';
			}
		})
	}
				
}

function no_newsletter(){
	Swal.fire({
		title: 'This politician hasn\'t linked or created their newsletter yet.',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
	});
}

function more_charts_coming(){
    Swal.fire({
		
		title:
		'Stay tuned, this exciting feature is coming soon',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
		
		
	})
}

function more_iconnect_coming(){
    Swal.fire({
		
		title:
		'To use this feature, tell your politician you want to iConnect...',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
		
		
	})
}

function show_poli_story(poli_position, poli_district, poli_full_name, repID, poli_photo, web, twit, inst, fb){

	$.ajax({    
			type: "POST",
			url: "includes/politician.inc.php",             
			data: {type:"grabStory", repID: repID},
			dataType: "json",
			success: function(data){

	var social_web = '<div style="display: flex; margin: 5%; justify-content: space-between;">';

	if(web){
		social_web += '<li style="display: inline-block;">' +
						'<a href="'+ web +'" target="_blank" style="display: inline-block;">' +
						'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">' +
							'<circle cx="12" cy="12" r="10"></circle>'+
							'<line x1="2" y1="12" x2="22" y2="12"></line>' +
							'<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>' +
						'</svg>' +
						'</a>' +
					'</li>';
	}
	if(twit){
		social_web += '<li style="display: inline-block;">'+
					  	'<a href="' + twit + '" target="_blank">'+
							'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">' +
								'<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>' +
							'</svg>'+
						'</a>'+
					  '</li>';
	}
	if(inst){
		social_web += '<li style="display: inline-block;"><a href="'+ inst + '" target="_blank">'+
					'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">' +
              		'<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>' +
              		'<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>' +
              		'<line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line>' +
            		'</svg></a></li>';
	}
	if(fb){
		social_web += '<li style="display: inline-block;"><a href="' + fb +'" target="_blank">' +
						'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">' +
						'<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>' +
						'</svg></a></li>';
	}
	social_web += '</div>';
	
	var x = window.matchMedia("(max-width: 767px)")
			if (x.matches) {
				width = '90%' 
			}else {
				width = "70%";
			}
	Swal.fire({
	
	html: '<div class="flex-container" style="margin-top:0; margin-left:0; margin-bottom:0;">' +
            '<div class="centered-content">' +
				'<div style="background-color: #b5bdce; margin-top: 20%; margin-left:18%; margin-right:18%; text-align: left; width: 64%;">' +
					'<img src="' + poli_photo + '"  alt="" style="min-width: 100%; max-width: 100%; max-height: 60%; margin-top:0;"><br><br>' +
					'<div style="padding: 5%; font-size: 11pt;">' +
					'<b>  Name:</b> ' + poli_full_name + '<br><br>' +
					'<b>  Position:</b> ' + poli_position + '<br><br>' +
					'<b>  District:</b> ' + poli_district + '<br><br>' + 
					'<div style="width: 50%; position: relative; left:0;">' + social_web + '</div></div>' +
									
				'</div>'+
				'<div class="PT_Italic" style="width: 80%; margin-left:10%; margin-right:10%;">' +
					'<hr style= "margin-top: 10%; color: #e5e6e7;">' +
					'<p style="font-size: 25pt; color: #e5e6e7;">At iMatr your story matters</p>'+
					'<hr style= "color: #e5e6e7;">' +
				'</div>' +
			'</div>' +
            '<div style="" class="center-content-column2">' + 
            	'<div class="Dancing_font"><p style="text-align: center; font-size: 97pt; color: #e5e6e7;">My Story</p></div>' + 
				'<div class="story-cont">' +
					'<div class="center-text"><b style="font-size: 20pt;">' + poli_full_name + '</b></div><br><br>' + '<div style="font-size: 11pt">' + data.story + '</div>' +
				'</div></div>' +
        	'</div>',
        width: width,
		showCloseButton: true,
		showConfirmButton: false,
		customClass: {
			closeButton: 'uk-modal-close-full icon-cross2',
			container: 'Custom_Container_Story',
			}
		
		
	});
}})
// }
}


function goToPoliQuestions(repID){


location.href = `<?php echo $_SERVER['HTTP_URL'] ?>/index.php?repID=${repID}`

}

function poli_platform(role, organiz, name, photo, repID){
	var x = window.matchMedia("(max-width: 767px)")
	var width = x.matches ? '90%' : '70%';
	var font_size = x.matches ? '32pt' : '52pt';
	$.ajax({    
			type: "POST",
			url: "includes/politician.inc.php",             
			data: {type:"grabPlatform", repID: repID},
			dataType: "json",
			success: function(data){
				 console.log(data)

	var platformValues = data;

	if(data){

		let platf_displ = "<ol class='accomp'>";
		platformValues.forEach(platf_look);
		function platf_look(item, index){
			platf_displ+= "<li>" + item['platform_item'] + "</li><br><br>";
		}
		platf_displ += "</ol>"

	Swal.fire({
	
	html: '<div class="flex-container platform_pos" style="margin-top:0; margin-left:0; margin-bottom:0;">' +
            '<div class="centered-content platform_col" style=" padding: 10px 0;">' +
				'<div style="background-color: #b5bdce; text-align: left; width: 64%;">' +
					'<img src="' + photo + '"  alt="" style="min-width: 100%; max-width: 100%; max-height: 60%; margin-top:0;"><br><br>' +
					'<div style="padding: 5%; font-size: 11pt;">' +
					'<b>  Name:</b> ' + name + '<br><br>' +
					'<b>  Position:</b> ' + role + '<br><br>' +
					'<b>  District:</b> ' + organiz + '<br><br>' + 
					'<div style="width: 50%; position: relative; left:0;">'  + '</div></div>' +							
 				'</div>'+		
			'</div>' +
            '<div style="" class="center-content-column2 platform_col2">' + 
            	'<div class="Dancing_font"><p style="text-align: center; font-size: ' + font_size +'; color: #e5e6e7;">My Platform</p></div>' + 
					'<div class="center-text"><b style="font-size: 24pt;">' + name + '</b></div><br><br>' + '<div style="font-size: 11pt">' + platf_displ + '</div>' +
				'</div>' +
        	'</div>',
        width: width,
		showCloseButton: true,
		showConfirmButton: false,
		customClass: {
			closeButton: 'uk-modal-close-full icon-cross2',
			container: 'Custom_Container_Story',
			}
		
		
	});
}else{
	Swal.fire({	
		title: 'This Politician has not writen their platform yet',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
	});
}
}})
}

function poli_accomplish(role, organiz, name, photo, repID){
// console.log(JSON.parse(accomplish));
	var x = window.matchMedia("(max-width: 767px)")
	var width = x.matches ? '90%' : '70%';
	var font_size = x.matches ? '32pt' : '52pt';
//PULL ACOMPLISHMENTS HERE VIA AJAX.
//alert(repID)

$.ajax({    
			type: "POST",
			url: "includes/politician.inc.php",             
			data: {type:"grabAcomplishments", repID: repID},
			dataType: "json",
			success: function(accomplish){


				// console.log(accomplish)

	var accompValues = accomplish;

	if(accomplish){

		let accomp_displ = "<ol class='accomp'>";
		accompValues.forEach(accomp_look);
		function accomp_look(item, index){
			accomp_displ+= "<li>" + item['accomplishments'] + "</li><br><br>";
		}
		accomp_displ += "</ol>"

	Swal.fire({
	
	html: '<div class="flex-container" style="margin-top:0; margin-left:0; margin-bottom:0;">' +
            '<div class="centered-content">' +
				'<div style="background-color: #b5bdce; margin-top: 20%; margin-left:18%; margin-right:18%; text-align: left; width: 64%;">' +
					'<img src="' + photo + '"  alt="" style="min-width: 100%; max-width: 100%; max-height: 60%; margin-top:0;"><br><br>' +
					'<div style="padding: 5%; font-size: 11pt;">' +
					'<b>  Name:</b> ' + name + '<br><br>' +
					'<b>  Position:</b> ' + role + '<br><br>' +
					'<b>  District:</b> ' + organiz + '<br><br>' + 
					'<div style="width: 50%; position: relative; left:0;">'  + '</div></div>' +
									
				'</div>'+
				'<div class="PT_Italic" style="width: 80%; margin-left:10%; margin-right:10%;">' +
					'<hr style= "margin-top: 10%; color: #e5e6e7;">' +
					'<p style="font-size: 21pt; color: #e5e6e7;">At iMatr your accomplishments matter</p>'+
					'<hr style= "color: #e5e6e7;">' +
				'</div>' +
			'</div>' +
            '<div style="" class="center-content-column2">' + 
            	'<div class="Dancing_font"><p style="text-align: center; font-size: ' + font_size +'; color: #e5e6e7;">My Accomplishments</p></div>' + 
				'<!--div class="story-cont"-->' +
					'<div class="center-text"><b style="font-size: 24pt;">' + name + '</b></div><br><br>' + '<div style="font-size: 11pt">' + accomp_displ + '</div>' +
				'</div><!--/div-->' +
        	'</div>',
        width: width,
		showCloseButton: true,
		showConfirmButton: false,
		customClass: {
			closeButton: 'uk-modal-close-full icon-cross2',
			container: 'Custom_Container_Story',
			}
		
		
	});
}else{
	Swal.fire({
		
		title:
		'This Politician has not writen their accomplishments yet',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
	});
}
}})

}

function unfollow_politician(repID){
	var unfoll_poli = document.getElementById('follow_li_'+repID);
	//console.log(unfoll_poli)
	unfoll_poli.style.display = 'none';
	$.ajax({    
			type: "POST",
			url: "includes/user.inc.php",             
			data: {type:"unfollowpoli", repID: repID},
			dataType: "html",
			success: function(data){
				
				Swal.fire({
					icon: "success",
					title: "Politician Unfollowed",
					showConfirmButton: false,
					timer: 3000
					}).then(function(){
						// location.reload();
						//window.location.href = '<?php //echo $_SERVER['HTTP_URL']; ?>/index_dashboard.php?page=user_dash'; 
						$('#pagecontent').load('admin/index.user.php');

					})
			},
			error: function(xhr, status, error) {
				console.error('AJAX Error:', error);
				console.log(xhr.responseText);
			}
		});
}

function no_poli_story(){
    Swal.fire({
		
		title:
		'This Politician has not writen their story yet',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
	})
}

function no_my_story(){
    Swal.fire({
		
		title:
		'This Politician has not writen their story yet',
		customClass: {
				confirmButton: 'Custom_Confirm', 
			}
		
		
	})
}

function share(repID, question_id){
	if(pin_status == 3){
	if(myReps.includes(Number(repID))){
	$.ajax({  
				type: "POST",
				url: "includes/engagement.inc.php",             
				data: {"type":"confirm_share_politician", "repID":repID, "question_id":question_id},
				dataType: "json",                  
				success: function(data){
					//console.log(data);
					//console.log(data.repID + ' ' + data.repName + ' '  + data.return);	
					if(data.return == 'Expired'){
						swal_expiry_message()
					}else if(data.return == 'Asked'){
						Swal.fire({
							title: 'Woops',
							text: "Error! You already 'Shared' Your opinion with " + data.repName + " on this iQ",
							icon: 'error',
								
							confirmButtonColor: '#3085d6',
								
							confirmButtonText: 'OK'
							});
					}else{
						Swal.fire({
							title: "Are you sure you want to <b>Share</b> your Opinion with " + data.repName + " on this iQ?",
							icon: 'question',
							showDenyButton: true,
							showCancelButton: true,
							confirmButtonText: 'Save',
							denyButtonText: `<i class="fa fa-eye"></i> Show Me the Message First`,
							denyButtonColor:'#749DFB',
							customClass: {
								confirmButton: 'Custom_Confirm',
								denyButton: 'Custom_Cancel',
								cancelButton: 'Custom_Cancel'
							},
															
							html:
								'You can check out the message going to ' +data.repName+ ' first too!</b> ',
							focusConfirm: false,
							confirmButtonText:
								'<i class="fa fa-thumbs-up"></i> Yes, Send!',
							confirmButtonAriaLabel: 'Thumbs up, great!',
							cancelButtonText:
								'<i class="fa fa-thumbs-down"></i> No, not at this time',
							cancelButtonAriaLabel: 'Thumbs down'
							}).then((result) => {
							if (result.isConfirmed) {
								$.ajax({  
									type: "POST",
									url: "includes/engagement.inc.php",             
									data: {"type":"share_politician", "repID":repID, "question_id":question_id},
									dataType: "json",                  
									success: function(data){
										console.log(data.repID + ' ' + data.repName + ' '  + data.return);	
										if(data.return == 'Success'){
											document.getElementById('s'+data.repID).style.opacity = '.3';
											Swal.fire({
												title: 'Share Sent',
												text: "You've Shared your opinion with " + data.repName + " on this iQ",
												icon: 'success',
													
												confirmButtonColor: '#3085d6',

												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Cancel',
													cancelButton: 'Custom_Cancel'
												},
																									
												confirmButtonText: 'OK'
												});
										}
									},
									error: function(data){
										console.log("error");
										console.log(data);
									}
								});
						}else if (result.isDenied) {
								$.ajax({  
									type: "POST",
									url: "includes/engagement.inc.php",             
									data: {"type":"get_share_message", "repID":repID, "question_id":question_id},
									dataType: "html",                  
									success: function(data1){
										
											Swal.fire({
												title: 'Share Email Generated',
												html: data1,
												icon: 'info',
												showCloseButton: true,
												showCancelButton: true,
												focusConfirm: false,
												confirmButtonText:
													'<i class="fa fa-thumbs-up"></i> Ok, Send it!',
												confirmButtonAriaLabel: 'Thumbs up, great!',
												cancelButtonText:
													'<i class="fa fa-thumbs-down"></i> No, not at this time',
												cancelButtonAriaLabel: 'Thumbs down',
												customClass: {
													closeButton: 'uk-modal-close-full icon-cross2',
    confirmButton: 'Custom_Confirm',
	denyButton: 'Custom_Cancel',
    cancelButton: 'Custom_Cancel'
},
											}).then((result) => {
							if (result.isConfirmed) {
								$.ajax({  
									type: "POST",
									url: "includes/engagement.inc.php",             
									data: {"type":"share_politician", "repID":repID, "question_id":question_id},
									dataType: "json",                  
									success: function(data){
										console.log(data.repID + ' ' + data.repName + ' '  + data.return);	
										if(data.return == 'Success'){
											document.getElementById('s'+data.repID).style.opacity = '.3';
											Swal.fire({
												title: 'Share Sent',
												text: "You've Shared your opinion with " + data.repName + " on this iQ",
												icon: 'success',
													
												confirmButtonColor: '#3085d6',

												customClass: {
													confirmButton: 'Custom_Confirm',
													denyButton: 'Custom_Cancel',
													cancelButton: 'Custom_Cancel'
												},
																									
												confirmButtonText: 'OK'
												});
										}
									}
								});
								
								
								
								
								//document.location.href = 'index.php' ;    
							
						}
												});
										
									}
								});
					}})
					}    
				}
			});
		}else{
			Swal.fire({
							title: 'Woops',
							text: "Error! This politician does not represent you!",
							icon: 'error',
								
							confirmButtonColor: '#3085d6',
								
							confirmButtonText: 'OK'
							});

		}
	}else{
		Swal.fire({
							title: 'Woops',
							text: "You are not PIN verified!",
							icon: 'error',
								
							confirmButtonColor: '#3085d6',
								
							confirmButtonText: 'OK'
							});
	}

}
function getbla(){
		var glob_request;
		$( "#autocomplete3" ).autocomplete({
			open: function () { $('.ui-autocomplete').css('z-index', 9999999999); },

			source: function( request, response ) {
				glob_request = request;
			// Fetch data
			//console.log(request.term)
					$.ajax({
						url: "../includes/politician.inc.php",             
						type: 'post',
						dataType: "json",
						data: {
						organization: request.term, type: "municipality_search"
						},
						success: function( data ) {
							
						response(data);
						//console.log(data);
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                        // alert("Internet Connection issue");
                    }
					});
			},
			select: function (event, ui) {

				// console.log(ui.item.value)
				// Set selection
				$.ajax({
                        type: "post",
                        url: "../includes/politician.inc.php",
                        data: {
                            "type": "municipality_politicians",
                            "search": ui.item.value
                        },
                        dataType: "html",
                        success: function(data) {
							// console.log(data);
                            $("#municipal_results").html(data);
                           // $("#iqposts").prop('style', 'z-index:11');
                        }
                    });
			},
	
		});
	}

function lookup_department(){
	var glob_request;
		$( "#autocomplete5").autocomplete({
			open: function () { $('.ui-autocomplete').css('z-index', 9999999999); },

			source: function( request, response ) {
				glob_request = request;
			// Fetch data
			if(request.term.length >= 3){
			//console.log(request.term)
					$.ajax({
						url: "../includes/cityview.inc.php",             
						type: 'post',
						dataType: "json",
						data: {
						organization: request.term, type: "department_search"
						},
						success: function( data ) {
							
						response(data);
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                        // alert("Internet Connection issue");
                    }
					});
				}
			},
			select: function (event, ui) {

				document.getElementById("autocomplete5").value = ui.item.label;

				console.log(ui.item.label)
				// Set selection
				$.ajax({
                        type: "post",
                        url: "../includes/cityview.inc.php",
                        data: {
                            "type": "department_result",
                            "search": ui.item.value
                        },
                        dataType: "html",
                        success: function(data) {
							data = JSON.parse(data);
// console.log(data)
							document.getElementById("autocomplete5").value = data.deptName;
							
                        }
                    });
			},
			
			
		});

}
	

function poke(a){
	id = a.className;
	ids = id.split(',');
	if (id.includes('na')){
			alert('You can\'t poke ' + document.getElementById(ids[0]).innerHTML + ' to get their opinion because they already answered the iQ.');
	}else if(id.includes('engaged')){
			alert('You can only poke ' + document.getElementById(ids[0]).innerHTML + ' once regarding any iQ.');
	}else{
		var result = confirm('Do you want to Poke ' + document.getElementById(ids[0]).innerHTML + ' and ask the politician for thier answer on this iQ?');
		if (result == true){
			$.ajax({  
				type: "POST",
				url: "includes/engagement.inc.php",             
				data: {"type":"poke", "repID":ids[0]  },
				dataType: "html",                  
				success: function(data){
					if(data.includes('error')){
							alert(data)
					}else if(data.includes('Pin')){
							console.log(data);
							if(data == 'No Pin'){
								window.location.href = "conengpro_xs.php?ps=no_pin";
							}else if(data == 'Pin Requested'){
								window.location.href = "contacteng_xs.php?ps=enter_pin'";
							}
							console.log(data)
							
					}else{                       
						document.getElementById("p"+ids[0]).classList.add('poked');
						document.getElementById("p"+ids[0]).style.opacity = '40%';
						document.getElementById("pokeall").classList.remove(ids[0] + ',');
					}
				}
			});
		}
	}
}
function pokeall(a){
	var val = '1';
	
	allreps = document.getElementById('pokeall').classList + '';
	if(allreps == ''){
		 alert('You\'ve Poked all your politicians on this iQ already.');
		 exit;
	}
	rep = allreps.split(', ');
	var result = confirm('Do you want to Poke ALL the Politicians in MyZONE and ask them for their answer on this iQ?');
	if (result == true){
		for (var i = 0, len = rep.length; i < len; i++) {
			var val = rep[i];
			if(val.includes(',')) val = val.slice(0, -1);
			if(val === ""){ 
					continue;
			}else{
				$.ajax({  
					type: "GET",
					url: "IQed_next.php",             
						data: {"repID":val,  "type":"poke"},
					dataType: "html",                  
					success: function(data){ 
						if(data.includes('error')){
								alert(data)
						}else if(data.includes('Pin')){
							if(data == 'No Pin'){
								window.location.href = "conengpro_xs.php?ps=no_pin";
							}else if(data == 'Pin Requested'){
								window.location.href = "contacteng_xs.php?ps=enter_pin'";
							}
							console.log(data)
							
						}else{              
							document.getElementById("p"+data).classList.add('poked');
							document.getElementById("p"+data).style.opacity = '40%';
							document.getElementById("pokeall").classList.remove(data + ',');
							document.getElementById("pokeall").style.opacity = '40%';
						}
					}
				});
			}
		}
	}
}



function smile(a){
	id = a.className;
	ids = id.split(',');		
	if (id.includes('engaged')){
			alert('You can\'t smile ' + document.getElementById(ids[0]).innerHTML + ' because you\'ve already smiled this politician about this iQ.');
	}else{
		var result = confirm('Do you want to smile ' + document.getElementById(ids[0]).innerHTML + ' to let them know where you stand on this iQ and that it is important?');
		
		// Swal.fire({
		// 	title: 'Do you want to save the changes?',
		// 	showDenyButton: true,
		// 	showCancelButton: true,
		// 	confirmButtonText: 'Save',
		// 	denyButtonText: `Don't save`,
		// 	}).then((result) => {
		// 	/* Read more about isConfirmed, isDenied below */
		// 	if (result.isConfirmed) {
		// 		Swal.fire('Saved!', '', 'success')
		// 	} else if (result.isDenied) {
		// 		Swal.fire('Changes are not saved', '', 'info')
		// 	}
		// });
	
		if (result == true){
			$.ajax({  
				type: "GET",
				url: "IQed_next.php",             
				data: {"repID":ids[0],  "type":"smile"},
				dataType: "html",                  
				success: function(data){ 
					if(data.includes('error')){
							alert(data)
					}else if(data.includes('Pin')){
							if(data == 'No Pin'){
								window.location.href = "conengpro_xs.php?ps=no_pin";
							}else if(data == 'Pin Requested'){
								window.location.href = "contacteng_xs.php?ps=enter_pin'";
							}
							console.log(data)
							
					}else{                       
						document.getElementById("s"+ids[0]).classList.add('smiled');
						document.getElementById("s"+ids[0]).style.opacity = '40%';
						document.getElementById("smileall").classList.remove(ids[0] + ',');
					}
				}
			});
		}	
	}
}

function smileall(a){
	allreps = document.getElementById('smileall').classList + '';
	if(allreps == ''){
		 alert('You\'ve Smiled all your politicians on this iQ already');
		 return;
	}
	rep = allreps.split(', ');
	var result = confirm('Do you want to Smile ALL the Politicians in MyZONE and let them know your opinion and that this iQ is important to you?');
	if (result == true){
		for (var i = 0, len = rep.length; i < len; i++) {
			val = rep[i];
			if(val.includes(',')) val = val.slice(0, -1);
				if(val === ""){ 
					continue;
				}else{
					$.ajax({  
						type: "GET",
						url: "IQed_next.php",             
						data: {"repID":val,  "type":"smile"},             
						dataType: "html",                  
						success: function(data){ 
							if(data.includes('error')){
								alert(data)
							}else if(data.includes('Pin')){
								if(data == 'No Pin'){
									window.location.href = "conengpro_xs.php?ps=no_pin";
								}else if(data == 'Pin Requested'){
									window.location.href = "contacteng_xs.php?ps=enter_pin'";
								}
								console.log(data)
							}else{              
								document.getElementById("s"+data).classList.add('smiled');
								document.getElementById("s"+data).style.opacity = '40%';
								document.getElementById("smileall").classList.remove(data + ',');
								document.getElementById("smileall").style.opacity = '40%';
							}
						}
					});
				}
		}
	}		
}




//// student assignment

$(document).ready(function (e) {

	$("#file").change(function(){
	   // alert("A file has been selected.");
		document.getElementById('submit').click();
	   // document.getElementById('logo_upload').style.display = 'none';
		document.getElementById('video_upload_progress').style.display = '';
	});



	$('#imageUploadForm').on('submit',(function(e) {
	e.preventDefault();
	var formData = new FormData();
	var files = $('#file')[0].files;
	filename = document.getElementById('file').value
	assignment_id = document.getElementById('assignment_id').innerHTML
	user_id = document.getElementById('user_id').innerHTML
	filename = filename.slice(12);
	
	
	if(files.length > 0 ){
		formData.append('file',files[0]);
			filelocation = '/youtube/videos/'+filename;
			//filey = filelocation.slice(2)
			//alert(filelocations);
			$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:formData,
			dataType:'json',
			cache:false,
			contentType: false,
			processData: false,
			success:function(data){
				console.log(data);

				//alert(data.filename);
			if(data.success === 1){
					
					alert('Video Uploaded Successfully!!!');
					
					$.ajax({  
						type: 'POST',
						url: "student_assignment.php",             
						data: {'type':'2', 'user_id':user_id, 'assignment_id':assignment_id, 'file':data.filename},
						dataType: 'html',                  
						success: function(data){  
							console.log(data);
							
							window.location.href = 'IQed_next.php';
						}
					});
				}else{
					alert('There was a problem loading the video. Please refresh this screen and try again. Error: 30D');
				}
			},
			error: function(data){
				console.log("error");
				console.log(data);
			}
		});
		}else{
			alert("Please select a file.");
			}
		}))

	});

	var content_type = '';
	function answer_option(a){
		content_type = a;
		document.getElementById('assignment_choices').style.display = 'none';
		if(a === 1){
			document.getElementById('answer_content_option').style.display = '';
			document.getElementById('answer_instruction').innerHTML = 'PLEASE PROVIDE A SHORT ANSWER:';
		}else if(a === 2){
			document.getElementById('answer_content_option').style.display = '';
			document.getElementById('answer_instruction').innerHTML = 'PLEASE PROVIDE A LONG ANSWER:';
		}else if(a === 3){
			document.getElementById('logo_upload').style.display = '';
			document.getElementById('assignment_choices').style.display = 'none';
		}else if(a === 4){
			window.location.href = 'IQed_next.php';
		}
	}


/*
$("#file").change(function(){
		alert("A file has been selected.");
		document.getElementById('submit').click();
		var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
	});

	function progressHandler(event){
	$("#kb_of_total").text("Uploaded "+Math.round(event.loaded/1024) +" kb of "+Math.round(event.total/1024));
	var percent = (event.loaded / event.total) * 100;
	$("#progressBar").attr('value', Math.round(percent));
	$("#status").text(Math.round(percent)+"% uploaded... please wait");
	}
	function completeHandler(event){
	$("#progressBar").attr('value', 100);
	$("#status").text('Uploaded Success');
	successHandler(event);

	}
	function successHandler(event){
	return;
	}
	function errorHandler(event){
	$("#status").text("Upload Failed");
	}
	function abortHandler(event){
	$("#status").text("Upload Aborted");
}
$(document).ready(function(){
$(document).on('submit', '.ajax_submit', function(e){
	alert('hi');
	e.preventDefault();
	var formData = new FormData($(this));
	var ajax = new XMLHttpRequest();
	var files_inputs = $(this).find("input[type='file']");
	$.each(files_inputs, function(key, input){
		formData.append($(input).attr('name'), $(input).get(0).files[0]);
	});
   
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", $(this).attr('action'));
	ajax.send(formData);
});
});

*/
// function editCategory(){
// 	$('#modalpanel').load('pages/triage_categories.php');

// }
function getContactEngineProfileInf(){
       
	 
	   $.ajax({    
		   type: "POST",
		   url: "includes/user.inc.php",             
		   data: {type:"get_profile_info"},
		   dataType: "json",                  
		   success: function(data){   
			console.log(data);
			fname = data.fname
			 $('#fname').val(data.fname); 
			 $('#lname').val(data.lname);
			 
			 $('#tel').val(data.tel);
			 $('#tel1').val(data.ctel);
			 $('#sqans').val(data.sqans);
			 $('#squest').val(data.squest);
			 if (data.fname == null && data.lname == null && data.tel == null && data.ctel == null && data.sqans == null){

$('#delconset').attr('style', 'display: none;')

}
		   },
		 
		   error: function(error){
			 console.log("Error:");
			 console.log(error);
			 $("#error").show();                 
			 $("#error").html("Oops! Something went wrong! Try to change things up a bit and if that doesn't work send the following error to the Administrator: "+data); 
		   },
		 });
	 }
	//console.log('hi')
	$(document).ready(function() {
		getContactEngineProfileInf()
        });

	
</script>











