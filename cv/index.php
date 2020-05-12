<?php include '../template.php'; ?>
<?php include '../root-template.php'; ?>
<script>document.getElementById("link-cv").classList.add("active");</script>
<div class="iframeoutercontainer">
<div class="iframecontainer">
<a href="/docs/CV_AjayBrahmakshatriya.pdf" class="icons-link" id="cv-download" download><img class="icons"  src="/../images/pdf.svg"/></a>
<iframe src="main.html" class="cv-iframe">
</iframe>
</div>
</div>
<script>
var cvframe = document.getElementsByClassName("cv-iframe")[0];
cvframe.onload = function() {
	cvframe.contentWindow.document.body.onresize = function() {
		cvframe.style.height = (cvframe.contentWindow.document.body.scrollHeight) + 'px';
	};
	cvframe.style.height = (cvframe.contentWindow.document.body.scrollHeight) + 'px';

}
</script>
<?php include '../footer.php'; ?>

