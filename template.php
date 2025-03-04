<?php 
function datestr($fname) {
	return filemtime(dirname(__FILE__).'/'.$fname);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($ogimg)) { ?>
<meta property="og:image" content="<?php echo $ogimg; ?>" />
<?php } ?>
<title><?php if(isset($ogtitle)) echo $ogtitle; else echo "Ajay Brahmakshatriya";?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://intimeand.space/css/style.css?v=<?php echo(datestr('css/style.css'));?>" />
<link rel="icon" type="image/png" href="https://intimeand.space/images/oldman.jpg">


<script src="https://intimeand.space/js/main.js"> </script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-164382133-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-164382133-1');
</script>

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "i08184d86d");
</script>
</head>

<body>
<div class="links-bar">
<?php if (!(isset($no_main_header) && $no_main_header == 1)) { ?>
	<div class="links">
		<a href="https://intimeand.space/" id="root">intimeand.space</a>
		<a href="https://build-it.intimeand.space/" id="buildit">Build-It</a>
		<a href="https://thoughts.intimeand.space/" id="thoughts">thoughts</a>	
		<a href="https://wandering.intimeand.space/" id="wandering">wandering</a>	
		<!--<a href="https://stuck.intimeand.space/" id="stuck">stuck</a>-->
	</div>
	<div class="links-right">
		<a href="https://github.com/AjayBrahmakshatriya" target="_blank"><img src="https://intimeand.space/images/github.svg"></a><a href="https://twitch.tv/ajaycxx" target="_blank"><img src="https://intimeand.space/images/twitch.svg"></a><a href="https://stackoverflow.com/users/2858773/ajay-brahmakshatriya" target="_blank"><img src="https://intimeand.space/images/stackoverflow.svg"></a><a href="https://www.linkedin.com/in/ajay-brahmakshatriya-868577a6/" target="_blank"><img src="https://intimeand.space/images/linkedin.svg"></a><a href="https://scholar.google.com/citations?user=TJZiN2cAAAAJ&hl=en" target="_blank"><img src="https://intimeand.space/images/googlescholar.svg"/></a><!--<a href="https://facebook.com/thats.me.ajay" target="_blank"><img src="https://intimeand.space/images/facebook.svg"/></a>--><a href="https://twitter.com/ajaybrcxx" target="_blank"><img src="https://intimeand.space/images/twitter.svg"/></a><a href="mailto:ajaybr@mit.edu" target="_blank"><img src="https://intimeand.space/images/email.svg"/></a>

	</div>
<?php } ?>

		
