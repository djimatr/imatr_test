<?php 




    
    require_once('Autoloader.inc.php');
	use classes\Organization\OrganizationView as OrganizationView;
	use classes\IQ\IQView as IQView;
    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'head.php'); 
	

    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_top2.php'); 

	use classes\Issue\IssueView as IssueView;
	
	
	// //include('../logger.php');
	// //include('logger_inf.php');
	
	// $_SESSION['next_action'] = 'D0';
	// $_SESSION['menu'] = 'M1';
	date_default_timezone_set("America/Toronto");
	$dat=date("Y-m-d H:i:s");
	$dats=strtotime($dat);

	$user_id = $_SESSION['user_id'];

	//include('isloggedinxs.php');
	//$_SESSION['next_action'] = 'D0';
	//include('../logger.php');
   

?>

<!DOCTYPE html>
<style>

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



 <!-- Latest News Start -->
    
 <section class="main-content">
        	<div class="container">
            	<div class="row">
                	
                    <div class="col-md-12">
					<centre><h1><a href="index.php"><img src="<?php echo $_SERVER['HTTP_MEDIA_IMAGES']  ;?>iMatr_Logo_80.png"  alt=""></a>Organization Mode</h2></centre>							

                    <div class="left-sec row " >
						<section class="news-left col-lg-3">
						
							<div>
								<a href="#"><img src="<?php echo $_SERVER['HTTP_MEDIA_IMAGES']  ;?>add_logo.png"  alt=""></a>
							</div>
			
							<nav id="column_left">	
								
								<?php 
								
									require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_organizations_left.php');
								?> 
				
							</nav>


						</section>	
                   
                    
                   
                    <section class="news-right col-lg-9">
                    	
						<div id="organization_functions">
							<?php
								$user_id = $_SESSION['user_id'];
								$resource = new OrganizationView(true);
								$resource->getOrganizationProfile($user_id);
							?>
						</div>
      
                    </section>
                    
                       
                    </div>
                    
                   </div> 

                    
				  
                   
                    
                    
                    
                </div>                   
                
                
                
                
                
                
            </div>
        </section>
    
    <!-- Latest News End -->
    




<?php 

    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'footer.php'); 

?>


</div>


	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/jquery.mmenu.min.all.js"></script>
	<!-- Bootstrap -->
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/bootstrap.js"></script>
<?php 

    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'scripts.php'); 

?>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
	<!-- Mobile Menu -->

	<script type="text/javascript">
				$(document).ready(function() {
				$("#menu").mmenu({
				"classes": "mm-slide",
				"offCanvas": {
					"position": "right"
				},
				"footer": {
					"add": true,
					"title": "Copyrights 2022 iMatr Canada. all rights reserved."
				},
				
				"header": {
					"title": "Add your Title",
					"add": true,
					"update": true
				},
				"searchfield": {
					"addTo": "panels",
					"placeholder": "Search here",
					"add": true,
					"search": false
				}
				});
			});
	</script>



	<!-- Sticky Header -->
	<script type="text/javascript" src="<?php echo $_SERVER['MAG_TEMPLATE_PATH']  ;?>js/jquery-scrolltofixed.js"></script>
	
	<script>

selected_row = '1';
function goto_issue(a){
	$.ajax({    

			        type: "POST",
			        url: "pages/iqcreator.php",             
			        data: {"questID":a},
			        dataType: "html",                  
			        success: function(data){                
			            $("#iqwriter_content").html(data);
						//document.getElementById(selected_row).style.backgroundColor = '';

						//document.getElementById(a).style.backgroundColor = 'red';
						//selected_row = a;
			        }
	});
}
		$(document).ready(function() {

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


	<div id="modal-full" class="uk-modal-full" uk-modal>
        <div class="uk-modal-dialog">
        	<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
        	<div  id="modalpanel" class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid> </div>
        </div>
    </div>
			
	<!-- Modal Confirm IQ-->
	<div id="answerModal" uk-modal>
		<div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Headline 2</h2>
            </div>
            <div class="uk-modal-body">
				           <p>test</p>';
           
        	</div>
			<div class="uk-modal-footer uk-text-right">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
			<a href="#modal-group-1" class="uk-button uk-button-primary" uk-toggle>Previous</a>
			</div>
    	</div>

	</div>

	<div id="modal-page" class="uk-modal" uk-modal>
		<div class="uk-modal-dialog uk-width-auto">
			<a style="color: #000;" class="uk-modal-close-full icon-cross2"></a>
			<div class="uk-grid-collapse uk-flex-middle" uk-grid>
				
				<div id="pagecontent" class="uk-padding-large">
					
				</div>
			</div>
		</div>
	</div>
        
	       

   


	<!--IQ Posts-->
	<script src="https://js.stripe.com/v3/"></script>

<script>

	 //AJAX FUNCTIONS

	 function goto_invoice(a){
		window.open('pages/invoice_pdf.php?cart_id=' + a, '_blank');
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





function update_resource(a, resID){
	url = document.getElementById(a).value;
	id = document.getElementById('id').value;
	if(pattern.test(url)){
		//alert('in');
		$.ajax({    
						type: "POST",
						url: "../includes/org.inc.php",             
						data: {"type":"update_resource","res_url":url, "res_id":resID , "IQid":id},
						dataType: "html",                  
						success: function(data){                    
							$("#resources").html(data);
						}
		});
	}else{
		//alert('out');
		document.getElementById('resource_mess_'+resID).innerHTML = 'Not Saved: You need to provide an exact URL.';
		//alert('well that did not work');
	}
		
}	
function delete_res(a){
	id = document.getElementById('id').value;
	$.ajax({    
			        type: "POST",
					url: "../includes/org.inc.php",             
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
	url: "../includes/org.inc.php",             
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
		url: "../includes/org.inc.php",             
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
		url: "../includes/org.inc.php",             
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
	//region_id = region_id.options[region_id.selectedIndex].text;
	region_id = 'a';

alert(type);
	$.ajax({    
			        type: "POST",
					url: "../includes/org.inc.php",             
					data: {"type":"update_question_elements", "questID":a, "column":column, "value":data_sub, "element_type":type},
			        dataType: "html",                  
			        success: function(data){  
						//console.log(data);                  
			            //$("#update").html(data);
			           //document.getElementById('title_'+a).innerHTML = issue_title;//window.location.href = 'issuelist.php';
					   document.getElementById('colmessage_' + column).innerHTML = data;
					   if(!data.includes('Updated Successfully')) colorpick = 'red';
						else colorpick = 'green';
						document.getElementById('colmessage_' + column).style.color = colorpick;
						if(column == 'IQ_title') document.getElementById('title_'+a).innerHTML = data_sub;//window.location.href = 'issuelist.php';

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
	c2 = document.getElementById('c2').value
	if(c2.length === 0){
		message =1
	}
	//console.log(message)

	//message.forEach(build_message)
the_message = 'iQ Background, iQ being asked, and at least 2 answers must be added. ';

	//alert(the_message)
	if(message === 1){
		alert(the_message)
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
						//window.location.href = 'issuelist.php';
						}
		});
	}
}
	


/* ------------------------------------------------------------------------ */
/* Search bar *///
/* ------------------------------------------------------------------------ */

	jQuery("#show-search").click(function(){
			jQuery("#search").fadeIn();
			});
			jQuery("#close-search").click(function(){
				jQuery("#search").fadeOut();
			});
			//TextRotators
	({
			animation: "flipUp",
			speed: 0
	});

</script>



</body>


</html>

