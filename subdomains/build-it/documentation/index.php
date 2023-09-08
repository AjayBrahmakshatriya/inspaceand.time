<?php $ogtitle="BuildIt"; ?>
<?php $ogimg="https://intimeand.space/images/logo-buildit.png"; ?>
<?php include '../params.php' ?>
<?php include '../../../template.php'; ?>
<?php include '../buildit-template.php'; ?>


<style>
a {
	text-decoration: revert;
	border-bottom: none;
	color: revert;
}
.doc-section {
	text-align: left;
	text-decoration: underline;
	font-weight: bold;
}
.doc-subsection {
	text-align: left;
	text-decoration: underline;
}
.doc-ref-entry {
	text-align: left;
	font-family: monospace;
	font-size: 1.2em;
}
.code-text {
	font-family: monospace;
}
.code-command {
	font-family: monospace;
	background: white;
	padding: 0.5em;
	padding-left: 1em;
	margin-top: 1em;
	margin-bottom: 1em;
	width: 100%;
	overflow-x: auto;
	white-space: nowrap;
}
article {
	max-width: 80em;
}
</style>

<h1>BuildIt reference manual</h1>
<br>
This document serves as the technical documentation for using the BuildIt multi-stage programming library and the 
domain specific language framework. <br>

<ul>
	<li><a href="#overview">Overview</a></li>
	<li><a href="#installation">Installation</a>
		<ul>
			<li><a href="#requirements">Requirements</a></li>
			<li><a href="#buildit-build">Cloning and Building</a></li>
			<li><a href="#linking-buildit">Using BuildIt in your project</a></li>
		</ul>
	</li>
	<li><a href="#online-tool">Using the online tool</a></li>
	<li><a href="#reference">Reference for types and functions</a>
		<ul>
			<li><a href="#builder_context">builder::builder_context</a></li>
			<li><a href="#extract_function_ast">builder::builder_context::extract_function_ast()</a></li>
		</ul>
	</li>
</ul>
<hr>
<br>

<?php include 'markdown/main.html' ?>



<br><br><br><br>
<?php include '../../footer.php'; ?>
