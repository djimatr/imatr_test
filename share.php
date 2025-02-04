<?php

require_once('Autoloader.inc.php');
use classes\IQ\IQ as Question;




  $IQ = new Question();
  $row = $IQ->getPost($_GET['questid']);



$content = "
<html><head>
<meta name='twitter:card'		  content='summary_large_image'/>
<meta name='twitter:image' 		content='" . $_SERVER['HTTP_IQ_IMAGES'] . $row['img1'] . "' />
	<meta property='og:url'           content='https://".$_SERVER['HTTP_HOST']."/share.php?questid=" . $row['questID'] ."&uniq_id=".$row['uniq_id']."' />
	<meta property='og:type'          content='website' />
	<meta property='og:title'         content='" . $row['qasked'] . "' />
	<meta property='og:description'   content='Have your Say at iMatr, and let politicians know where you stand!' />
	<meta property='og:image'         content='" . $_SERVER['HTTP_IQ_IMAGES'] . $row['img1'] . "' />
	<meta property='fb:app_id' 		  content='462414971794328'/>	


	
	</head>
";


print $content;


print "<span id='result'></span>";
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">


'<?php echo ($_GET['uniq_id']) ?>' ? uniq = '&uniq_id=<?php echo $_GET['uniq_id']; ?>' : uniq = '';
          
	window.location.href = 'https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php?questID=<?php echo $_GET['questid']; ?>' + uniq;
 
</script>