<?php $ogtitle="BuildIt"; ?>
<?php $ogimg="https://intimeand.space/images/logo-buildit.png"; ?>
<?php include '../params.php' ?>
<?php include '../../../template.php'; ?>
<?php include '../buildit-template.php'; ?>
<script>document.getElementById("link-d2x").classList.add("active");</script>
<style>
article {
	max-width: 80em;
}
table {
	width: 100%;
	border-spacing: 0;
}
tr { 
	width: 50%;
	margin-bottom: 4em;
}
td {
	vertical-align: top;
	width: 50%;
	padding: 2em;
}
.code-block {
	/*width: 30em;*/
	background-color: white;	
	display: inline-block;
	white-space: nowrap;
	box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 8px;
}
.code-keyword {
	color: blue;
}
.panel {
	width: 100%;
	clear: both;
	overflow: auto;
	padding: 0px;
	margin-top: 1em;
}
.panel-wheat {
	background-color: wheat;
}
.panel-left {
	float: left;
	margin: 1em;
}
.panel-right {
	float: right;
	margin: 1em;
}


.project-panel {
	width: 100%;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
.project {
	text-align: center;
	min-height: 16em;
	width: 16em;	
	display: inline-block;
	background-color: white;
	background-color: #f1f0eb;
	box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 8px;
	padding: 1em;
	margin: 2em;
}	
.project:hover {
	/*transform: scale(1.01);*/
}
.conf-video {
	width: 560px;
	height: 400px;
}

@media screen and (max-width: 45em) {
.panel-left, .panel-right {
	width: calc(100% - 2em);
	overflow-x: auto;
}
.panel-left::-webkit-scrollbar {
	display: block;
}
.panel-right::-webkit-scrollbar {
	display: block;
}
.panel {
	background-color: wheat;
}
.conf-video {
	width: 100%;
	
}
.code-block {
	box-shadow: none;
}

}
</style>
<center>
<h1 style="font-size:96px">D2X</h1>
<br>
<!--<a class="icons-link" target="_blank" href="https://github.com/BuildIt-lang/buildit"><img src="https://img.shields.io/badge/BuildIt-MIT-brightgreen"/></a>&nbsp;<a class="icons-link" target="_blank" href="https://github.com/BuildIt-lang/buildit/fork"><img src="https://img.shields.io/github/forks/BuildIt-lang/buildit"/></a>&nbsp;<a class="icons-link" href="https://github.com/BuildIt-lang/buildit/" target="_blank"><img src="https://img.shields.io/github/stars/BuildIt-lang/buildit"/></a><br>
<a href="https://github.com/BuildIt-lang/buildit/actions/workflows/ci-all-samples.yml" class="icons-link" target="_blank"><img src="https://github.com/BuildIt-lang/buildit/actions/workflows/ci-all-samples.yml/badge.svg"/></a>-->
<a class="icons-link" target="_blank" href="https://github.com/BuildIt-lang/d2x_cgo23_artifacts"><img src="https://img.shields.io/badge/D2X-MIT License-brightgreen"/></a>
</center>

<h2 >An e<u><b>X</b></u>tensible and conte<u><b>X</b></u>tual <u><b>D</b></u>ebugger for modern <u><b>D</b></u>SLs</h2>
<br>
<hr>
<br>

<div class="panel">
	<div class="panel-right">
		<div class="code-block" style="min-width:300px">
		...<br>
		(gdb) xbt<br>
		(gdb) xvars mylist<br>
		<hr>
		&gt; gdb --args ./program
		</div>
	</div>
	<div class="panel-left">
		1. Works with your favorite debugger (gdb/lldb/WinDbg) without <b>any</b> modifications.
	</div>

</div>

<div class="panel panel-wheat">
	<div class="panel-left">
		<div class="code-block" >
xctx.push_source_loc(cloc);<br>
xctx.nextl();<br>
xctx.create_var("myvar");<br>
xctx.update_var("myvar", var_resolver);<br>
		</div>
	</div>
	<div class="panel-right" style="max-width: 40em">
		2. Easy to use compiler library for encoding debug information in the generated code.
	</div>	
</div>
		
<div class="panel">
	<div class="panel-right">
		<div class="code-block" >
<span class="code-keyword">struct</span> d2x::runtime::d2x_var_stack d2x_0_var_table[] = {<br>
&nbsp;&nbsp;{0, 0},<br>
&nbsp;&nbsp;{6, 18},<br>
&nbsp;&nbsp;{6, 24},<br>
&nbsp;&nbsp;...<br>
};<br>
<span class="code-keyword">struct</span> d2x::runtime::d2x_var_entry d2x_0_var_list[] = {<br>
&nbsp;&nbsp;{14, 15, 0},<br>
&nbsp;&nbsp;{16, 15, 0},<br>
&nbsp;&nbsp;...<br>
};<br>
<span class="code-keyword">const char*</span> d2x_0_string_table[] = {<br>
&nbsp;&nbsp;"index",<br>
&nbsp;&nbsp;"matrix_vector_multiplication",<br>
&nbsp;&nbsp;"a.constant_val",<br>
&nbsp;&nbsp;...<br>
};<br>
		</div>
	</div>
	<div class="panel-left" style="max-width: 25em">
		3. Debugging information stored as C++ arrays that are easy to understand and extend
	</div>
		
</div>

<div class="panel panel-wheat">
	<div class="panel-left">
		<div class="code-block" >
c[i] = 2 * a[i][j] * b[j];
<hr>
(gdb) <b>xframe 7</b><br>
#7 in matrix_vector_multiplication at einsum.cpp:360<br>
360&nbsp;&nbsp;&nbsp;&nbsp;c[i] = 2 * a[i][j] * b[j]; // first stage source code<br>
(gdb) <b>xvars</b><br>
1. a.constant_val // static_var(s) as xvars<br>
2. a.is_constant<br>
...
		</div>
	</div>	
	<div class="panel-right">
		4. DSLs written with BuildIt get D2X support without <b>any</b> changes
	</div>
</div>

<br>

<center>
<a name="publications"></a>
<h2>Publications</h2>
</center>
<p class="publication">
<b class="publication-title">D2X: An eXtensible conteXtual Debugger for Modern DSLs</b> <br>
<u>Ajay Brahmakshatriya</u>, Saman Amarasinghe <br>
Proceedings of the 2023 International Symposium on Code Generation and Optimization  
<b>Distinguished Paper Award</b> [<a href="https://intimeand.space/docs/CGO2023-D2X.pdf" target="_blank">CGO 2023</a>]
</p>
<p>&nbsp;</p>
<br>
<center>
<a name="conference-videos"></a>
<h2>Conference presentations</h2>
Presentation Slides: <a href="https://intimeand.space/docs/CGO23_D2X_Slides.pdf" target="_blank">[pdf]</a> <br>
Video: Coming up soon!
<br>
</center>



<?php include '../../../footer.php'; ?>
