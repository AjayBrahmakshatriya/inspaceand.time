<?php $ogtitle="BuildIt"; ?>
<?php include '../params.php'; ?>
<?php include '../../../template.php'; ?>

<?php 
function datestr2($fname) {
	return filemtime(dirname(__FILE__).'/'.$fname);
}

?>

<!-- content from buildit template -->
<div class="sub-links">
	<a href="/" id="link-home">Build-It</a><a href="/tryit" id="link-demo">try-it</a><a href="/d2x" id="link-d2x">D2X</a><a href="/publications" id="link-publications">publications</a><a href="/tutorial" id="link-tutorial">tutorials</a>
	<?php if(isset($link_to_main) && $link_to_main == 1) {?><a href="https://intimeand.space/" style="float:right">intimeand.space</a><?php } ?>
</div>
</div>
<!-- -->


<link rel="stylesheet" href="https://intimeand.space/subdomains/build-it/tryit/style.css?v=<?php echo(datestr2('style.css'));?>" />
<div class="container">
<script>document.getElementById("link-demo").classList.add("active");</script>
<style>
.container {
	overflow-y: hidden;
}
.buildit-code-area {
	resize: none;
	width: calc(100% - 1em);
	padding: 0.5em;
	border: 0px;
	height: calc(100% - 1px);
	font-size: 16px;
        font-style: sans-serif;
}
#buildit-stages{
	height: calc(100% - 3em);
}
.buildit-stage {
	height: 100%;
}
.com-error {
	color: red;
	text-align: left;
	margin-left: 3em;
	font-size: 16px;
	font-style: sans-serif;
}
.banner-text {
	text-align: left;
}
#buildit-menu { 
	height: 2em;
	padding: 0px;
	margin: 0px;
	width: 100%;
	display: flex;
	flex-wrap: nowrap;
}
#buildit-menu-uncompressed {
	display: flex;
	flex-wrap: nowrap;
	overflow-x: auto;
}
#buildit-menu-compress {
	display: none;
}
.buildit-stage-button {
	height: 2em;
	padding: 0px;
	margin: 0px;
	line-height: 2em;
	margin-left: 0.8em;
	display: inline-block;
	float: left;
        cursor: pointer;
	flex: 0 0 auto;
	
}
@keyframes spin {
    from {
        transform:rotate(0deg) scale(0.8);
    }
    to {
        transform:rotate(360deg) scale(1.0);
    }
}
#buildit-run-button {
	height: 1.6em;
	width: 1.6em;
	
	margin-left: 1.0em;
	margin-top: 0.2em;
	background-image: url("https://intimeand.space/images/play.png");
	
	background-size: contain;
	display: inline-block;
	float: left;
	cursor: pointer;
	flex: 0 0 auto;
	
	animation-name: none;
	animation-duration: 5000ms;
	animation-timing-function: linear;
	animation-iteration-count: infinite;
}

#buildit-share-button {
	height: 1.2em;
	width: 1.2em;
	
	margin-left: 2.0em;
	margin-top: 0.4em;

	background-image: url("https://intimeand.space/images/share.svg");
	background-size: contain;
	background-repeat: no-repeat;
	display: inline-block;
	float: left;
	cursor: pointer;
	flex: 0 0 auto;
}

#buildit-help-button {
	text-decoration: underline;
}
#buildit-banner {
    position:  absolute;
    background-color: rgb(41, 42, 45);
    width: 50em;
    border: solid black 2px;
    left: calc(50% - 25em);
    top: 10em;
    z-index: 20;
    min-height: 20em;
    padding: 0.5em;
}
@media screen and (max-width: 45em) {
    #buildit-banner {
        width: calc(100% - 1em);
        left: 0px;
        top: 15em;
	border: none;
    } 
}

/* Toggler style borrowed from - https://alvarotrigo.com/blog/css-checkbox-styles/ */

.toggler-wrapper {
  display: block;
  width: 45px;
  height: 25px;
  cursor: pointer;
  position: relative;
}

.toggler-wrapper input[type="checkbox"] {
  display: none;
}

.toggler-wrapper input[type="checkbox"]:checked+.toggler-slider {
  background-color: #44cc66;
}

.toggler-wrapper .toggler-slider {
  background-color: #ccc;
  position: absolute;
  border-radius: 100px;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-transition: all 300ms ease;
  transition: all 300ms ease;
}

.toggler-wrapper .toggler-knob {
  position: absolute;
  -webkit-transition: all 300ms ease;
  transition: all 300ms ease;
}


.toggler-wrapper.style-1 input[type="checkbox"]:checked+.toggler-slider .toggler-knob {
  left: calc(100% - 19px - 3px);
}

.toggler-wrapper.style-1 .toggler-knob {
  width: calc(25px - 6px);
  height: calc(25px - 6px);
  border-radius: 50%;
  left: 3px;
  top: 3px;
  background-color: #fff;
}





</style>
<script>
var current_stage_max = 0;
var current_stage_open = 0;
var running = 0;



function navigate_to_stage(sid) {
	var nelem = document.getElementById("stage" + sid);
	if (nelem) {
		for (id = 0; id <= current_stage_max; id++) {
			var elem = document.getElementById("stage" + id);
			elem.style.display="none";
			var elem = document.getElementById("stage-button" + id);
			elem.style.textDecoration = "underline";
			
		}	
		nelem.style.display="";
		var belem = document.getElementById("stage-button" + sid);
		belem.style.textDecoration = "none";
		current_stage_open = sid;
		document.getElementById("buildit-curr-stage").innerHTML = "Stage " + (sid + 1);
	}


	// Now is a good time to check if the menu bar is overfull
	var menu = document.getElementById("buildit-menu-uncompressed");
	// Momentarily turn it on to check width correctly 
	document.getElementById("buildit-menu-uncompressed").style.display = "flex";
	
	if (menu.scrollWidth > menu.clientWidth){	
		document.getElementById("buildit-menu-uncompressed").style.display = "none";
		document.getElementById("buildit-menu-compress").style.display = "block";
	} else {
		document.getElementById("buildit-menu-uncompressed").style.display = "flex";
		document.getElementById("buildit-menu-compress").style.display = "none";		
	}
}
function prev_stage() {
	if (current_stage_open > 0) 
		navigate_to_stage(current_stage_open - 1);
}
function next_stage() {
	if (current_stage_open < current_stage_max)
		navigate_to_stage(current_stage_open + 1);
}

function set_animation_play() {
	document.getElementById("buildit-run-button").style.backgroundImage='url("https://intimeand.space/images/play.png")';
	document.getElementById("buildit-run-button").style.animationName='none';
}
function set_animation_gear() {
	document.getElementById("buildit-run-button").style.backgroundImage='url("https://intimeand.space/images/gear.png")';
	document.getElementById("buildit-run-button").style.animationName='spin';
}

function fetchAndDisplayOutput(requestId, sid, params) {
	var server = "https://bc-api.intimeand.space";
	var dest = server + "/result/" + requestId + params;
 
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var parent_div = document.getElementById("stage" + sid);
			while (parent_div.firstChild) {
				parent_div.removeChild(parent_div.firstChild);
			}
	
			var editor = document.createElement("div");
			editor.id = "codestage" + (sid);
			editor.classList.add("buildit-code-area");
			editor.textContent = xhr.responseText;
			parent_div.appendChild(editor);	
			var editor = ace.edit("codestage" + sid);
			editor.session.setMode("ace/mode/c_cpp");
			editor.setOptions({
				wrap: true,
				showPrintMargin: false
			});
			var stage_button = document.createElement("div");
			stage_button.classList.add("buildit-stage-button");
			stage_button.innerHTML = "> Stage " + (sid + 1);
			stage_button.id = "stage-button" + sid;
			stage_button.onclick = function() {
				navigate_to_stage(sid);
			}
			
			document.getElementById("buildit-menu-uncompressed").appendChild(stage_button);
			navigate_to_stage(sid);	

			running = 0;	
			set_animation_play();
		}
	}
	xhr.send();
}

function fetchAndDisplayError(requestId, sid, params) {	
	var server = "https://bc-api.intimeand.space";
	var dest = server + "/error/" + requestId + params;
	
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var parent_div = document.getElementById("stage" + sid);
			while (parent_div.firstChild) {
				parent_div.removeChild(parent_div.firstChild);
			}
	
			var editor = document.createElement("div");
			editor.id = "codestage" + (sid);
			editor.classList.add("com-error");
			var banner_text = "The BuildIt program failed to compile/run with the following error: ";
			var banner = document.createElement("h2");
			banner.style.marginLeft = "2em";
			banner.innerHTML = banner_text;
			var cleaned_response = xhr.responseText.replace(/\/scratch\/.*\/input.cpp/g, 'input.cpp');
			cleaned_response = cleaned_response.replace(/\/buildit\/include\//g, '');
			editor.innerHTML = cleaned_response.replace(/\n/g, '<br>').replace(/ /g, '&nbsp;');
			parent_div.appendChild(banner);	
			parent_div.appendChild(editor);	

			var stage_button = document.createElement("div");
			stage_button.classList.add("buildit-stage-button");
			stage_button.innerHTML = "> Stage " + (sid + 1);
			stage_button.id = "stage-button" + sid;
			stage_button.onclick = function() {
				navigate_to_stage(sid);
			}
			
			document.getElementById("buildit-menu-uncompressed").appendChild(stage_button);
			navigate_to_stage(sid);	
			running = 0;
			set_animation_play();
		}
	}
	xhr.send();
}

function fetchInputFromPID(requestId, sid) {
	var dest = "https://bc-api.intimeand.space/code/" + requestId;
	
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var parent_div = document.getElementById("stage" + sid);
			while (parent_div.firstChild) {
				parent_div.removeChild(parent_div.firstChild);
			}
	
			var editor = document.createElement("div");
			editor.id = "codestage" + (sid);
			editor.classList.add("buildit-code-area");
			editor.textContent = xhr.responseText;
			parent_div.appendChild(editor);	
			var editor = ace.edit("codestage" + sid);
			editor.session.setMode("ace/mode/c_cpp");
			editor.setOptions({
				wrap: true,
				showPrintMargin: false
			});
		}
	}
	xhr.send();

}

function checkRequest(requestId, sid, params) {
		
	var server = "https://bc-api.intimeand.space";
	var dest = server + "/status/" + requestId + params;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			if (xhr.responseText == "0") {
				setTimeout(function(){checkRequest(requestId, sid, params);}, 1000);
			} else if (xhr.responseText == "1" || xhr.responseText == "2") {
				fetchAndDisplayError(requestId, sid, params);
			} else if (xhr.responseText == "3") 
				fetchAndDisplayOutput(requestId, sid, params);
		}
	}
	xhr.send();
}


function createStageBox(sid) {
	//document.getElementById("buildit-stages").innerHTML += '<div class="buildit-stage" id="stage'+sid+'">Running...</div>';	

	var stage_box = document.createElement("div");
	stage_box.classList.add("buildit-stage");
	stage_box.id = "stage" + sid;
	stage_box.innerHTML = "Running...";
	
	document.getElementById("buildit-stages").appendChild(stage_box);

	current_stage_max = sid;
}

function buildit_stage(sid) {
	if (running)
		return;

	var code_body = document.getElementById("codestage" + sid);
	if (code_body.className === "com-error")
		return;
	
	for (id = sid + 1; id <= current_stage_max; id++) {
		var elem = document.getElementById("stage" + id);
		if (elem)
			elem.parentNode.removeChild(elem);
		var elem = document.getElementById("stage-button" + id);
		if (elem) 
			elem.parentNode.removeChild(elem);
	}	

	set_animation_gear();	
	createStageBox(sid+1);
	running = 1;
        var checkbox = document.getElementById("recover-var-names");
	server = "https://bc-api.intimeand.space";
	if (checkbox.checked) {
		params = "?recover_vars=1"	
		dest = server + "/run_with_vars"
	} else	{
		params = "?recover_vars=0"
		dest = server + "/run"
	}
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", dest, true);
	
	var code_body = ace.edit(document.getElementById("codestage" + sid)).getValue();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log(xhr.responseText);
			setTimeout(function(){checkRequest(xhr.responseText, sid+1, params);}, 1000);
		}
	}
	xhr.send(code_body);
	
}


function share_this_snippet() {
	var sid = current_stage_open;
	var code_body = document.getElementById("codestage" + sid);
	if (code_body.className === "com-error")
		return;

	var dest = "https://bc-api.intimeand.space/run";
	var xhr = new XMLHttpRequest();
	xhr.open("POST", dest, true);
	
	var code_body = ace.edit(document.getElementById("codestage" + sid)).getValue();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log(xhr.responseText);
			var url = "https://buildit.so/tryit/?sample=shared&pid=" + xhr.responseText;
			window.prompt("Copy and share this URL: Ctrl+C, Enter", url);
		}
	}
	xhr.send(code_body);
	
}

function run_current_stage() {
	buildit_stage(current_stage_open);
}
function add_main(sid) {
	document.getElementById("codestage" + sid).value += '\nint main(int argc, char* argv[]) {\n    auto ast = builder::builder_context().extract_function_ast(foo, "foo");\n    block::c_code_generator::generate_code(ast, std::cout, 0);\n    return 0;\n}';
}

function close_banner() {
	document.getElementById("buildit-banner").style.display="none";
}
function show_banner() {
	document.getElementById("buildit-banner").style.display="";
}
</script>

<div id="buildit-banner">
<center><span onclick="close_banner()" style="text-decoration: underline; cursor: pointer">Close [X]</span></center>
This is an online demo for BuildIt. Input your BuildIt program in the textarea and hit the run button in the menu. BuildIt will add a new stage and show the output. You can further edit the program before running it again. We have a few pre-written samples here
<br>
Samples
<ol>
<li><a href="?sample=bfinterp">BrainFuck Interpreter</a></li>
<li><a href="?sample=einsum">Einsum DSL compiler</a></li>
<li><a href="?">Power Function</a></li>
<li><a href="?sample=3stage">3 stage execution</a></li>
<li><a href="?sample=blank">Blank</a></li>
</ol>
This demo is running on our research server. If you find any bug/security concerns with the demo please create an issue at - <a href="https://github.com/BuildIt-lang/buildit-online" target="_blank">https://github.com/BuildIt-lang/buildit-online</a>. Editor and syntax highlighting powered by <a href="https://ace.c9.io/#nav=about">Ace</a>. <br><br>

Disclaimer: The generated code is provided "as is" without warranty of any kind. To help us improve BuildIt, we keep a record of all programs submitted here.

	

</div>

<div id="buildit-menu">
    <div id="buildit-help-button" class="buildit-stage-button" onclick="show_banner()">?</div><div id="buildit-share-button" class="buildit-stage-button" onclick="share_this_snippet()"></div><label class="toggler-wrapper style-1" style="margin-top:0.3em;transform:scale(0.6);margin-left:0.5em"><input type="checkbox" id="recover-var-names"><div class="toggler-slider"><div class="toggler-knob"></div></div></label><label style="margin-left:0em;line-height: 2em">VarNames</label><div id="buildit-run-button" onclick="run_current_stage()"></div><div id="buildit-menu-uncompressed"><div class="buildit-stage-button" id="stage-button0" onclick="navigate_to_stage(0)">Stage 1</div></div><div id="buildit-menu-compress"><div id="buildit-prev-button" class="buildit-stage-button" onclick="prev_stage()">&lt;</div><div class="buildit-stage-button" id="buildit-curr-stage">Stage 1</div><div id="buildit-next-button" class="buildit-stage-button" onclick="next_stage()">&gt;</div></div>
</div>
<div id="buildit-stages">
<div class="buildit-stage" id="stage0">
<div id="codestage0" class="buildit-code-area" contenteditable>// Include the headers
<?php if (!(isset($_GET["sample"]) && $_GET["sample"] == "einsum")) { ?>
#include "blocks/c_code_generator.h"
#include "builder/static_var.h"
#include "builder/dyn_var.h"
#include &lt;iostream&gt;

// Include the BuildIt types
using builder::dyn_var;
using builder::static_var;

<?php } ?>
<?php if (!isset($_GET["sample"])) { ?>


// The power function to stage
dyn_var&lt;int&gt; power(dyn_var&lt;int&gt; base, static_var&lt;int&gt; exponent) {
    dyn_var&lt;int&gt; res = 1, x = base;
    while (exponent &gt; 1) {
        if (exponent % 2 == 1)
            res = res * x;
        x = x * x;
        exponent = exponent / 2;
    }
    return res * x;
}

// The main driver function 
int main(int argc, char* argv[]) {
    // Declare the context object
    builder::builder_context context;
    
    // Generate the AST for the next stage
    // The exponent can also be a command line argument, constant for simplicity
    auto ast = context.extract_function_ast(power, "power_15", 15);
    
    // Generate the headers for the next stage
    std::cout &lt;&lt; "#include &lt;stdio.h&gt;" &lt;&lt; std::endl;
    block::c_code_generator::generate_code(ast, std::cout, 0);
    
    
    // Print the main function for the next stage manually
    // Can also be generated using BuildIt, but we will skip for simplicity
    std::cout &lt;&lt; "int main(int argc, char* argv[]) {\n    printf(\"2 ^ 15 = %d\\n\", power_15(2));\n    return 0;\n}" &lt;&lt; std::endl;
    
    return 0;
}
<?php } else if ($_GET["sample"] == "bfinterp") { ?>
dyn_var&lt;void(int)&gt; print_value(builder::as_global("print_value"));
dyn_var&lt;int()&gt; get_value(builder::as_global("print_value"));

static int find_matching_closing(int pc, const char* bf_program) {
	int count = 1;
	while (bf_program[pc] != 0 &amp;&amp; count &gt; 0) {
		pc++;
		if (bf_program[pc] == '[')
			count++;
		else if (bf_program[pc] == ']')
			count--;
	}
	return pc;
}
static int find_matching_opening(int pc, const char* bf_program) {
	int count = 1;
	while (pc &gt;= 0 &amp;&amp; count &gt; 0) {
		pc--;
		if (bf_program[pc] == '[')
			count--;
		else if (bf_program[pc] == ']')
			count++;
	}
	return pc;
}
// Operator fusion 
static void do_last_op(static_var&lt;int&gt; &amp;last_op, static_var&lt;int&gt; &amp;last_op_count, dyn_var&lt;int[256]&gt;&amp; tape, dyn_var&lt;int&gt; &amp;pointer) {
    if (last_op_count == 0)
        return;
    if (last_op == '+') {
        tape[pointer] = (tape[pointer] + last_op_count) % 256;
    } else if (last_op == '-') {
        tape[pointer] = (tape[pointer] - last_op_count) % 256;
    } else if (last_op == '&gt;') {
        pointer = pointer + last_op_count;
    } else if (last_op == '&lt;') {
        pointer = pointer - last_op_count;
    }
    last_op_count = 0;
    last_op = ' ';
}
// BF interpreter
static dyn_var&lt;int&gt; interpret_bf(const char* bf_program) {
	dyn_var&lt;int&gt; pointer = 0;
	static_var&lt;int&gt; pc = 0;
	dyn_var&lt;int[256]&gt; tape = {0};

	// variables for operator fusion
	static_var&lt;int&gt; last_op = ' ';
	static_var&lt;int&gt; last_op_count = 0;

	while (bf_program[pc] != 0) {
		// Finish last operator before proceeding to current one
		if (last_op != bf_program[pc])
			do_last_op(last_op, last_op_count, tape, pointer);
		switch(bf_program[pc]) {
			case '&gt;':
			case '&lt;':
			case '+':
			case '-':
				last_op = bf_program[pc];
				last_op_count++;
				break;
			case '.':
				print_value(tape[pointer]);
				break;
			case ',':
				tape[pointer] = get_value();
				break;
			case '[':
				if (tape[pointer] == 0)
					pc = find_matching_closing(pc, bf_program);
				break;
			case ']':
				pc = find_matching_opening(pc, bf_program) - 1;
				break;			
		}			
		pc += 1;
	}
	do_last_op(last_op, last_op_count, tape, pointer);
	return 0;
}
static void print_wrapper_code(std::ostream &amp;oss) {
	oss &lt;&lt; "#include &lt;stdio.h&gt;\n";
	oss &lt;&lt; "#include &lt;stdlib.h&gt;\n";
	oss &lt;&lt; "void print_value(int x) {printf(\"%c\", x);}\n";
	oss &lt;&lt; "int get_value(void) {char x; scanf(\" %c\", &amp;x); return x;}\n";
}
int main(int argc, char *argv[]) {
	builder::builder_context context;

	// BF program that prints hello world
	const char* bf_program =
	    "++++++++[&gt;++++[&gt;++&gt;+++&gt;+++&gt;+&lt;&lt;&lt;&lt;-]&gt;+&gt;+&gt;-&gt;&gt;+[&lt;]&lt;-]&gt;&gt;.&gt;---.++++++"
	    "+..+++.&gt;&gt;.&lt;-.&lt;.+++.------.--------.&gt;&gt;+.&gt;++.";

	auto ast = context.extract_function_ast(interpret_bf, "main", bf_program);

	print_wrapper_code(std::cout);
	block::c_code_generator::generate_code(ast, std::cout, 0);
	return 0;
}

<?php } elseif ($_GET["sample"] == "3stage") { ?>
static dyn_var&lt;dyn_var&lt;int&gt;&gt; bar(void) {
        for (static_var&lt;int&gt; i = 0; i &lt; 10; i++) {
                for (dyn_var&lt;static_var&lt;int&gt;&gt; g = 0; g &lt; i; g = g + 1) {
                        dyn_var&lt;dyn_var&lt;int&gt;&gt; x = i;
                        x = x + 1;
                }
        }
	return 0;
}

int main(int argc, char *argv[]) {
        builder::builder_context context;
        auto ast = context.extract_function_ast(bar, "bar");
        std::cout &lt;&lt; "#include \"builder/dyn_var.h\"" &lt;&lt; std::endl;
        std::cout &lt;&lt; "#include \"builder/static_var.h\"" &lt;&lt; std::endl;
        std::cout &lt;&lt; "#include \"blocks/c_code_generator.h\"" &lt;&lt; std::endl;

        block::c_code_generator::generate_code(ast, std::cout, 0);

        std::cout &lt;&lt; "int main(int argc, char* argv[]) {" &lt;&lt; std::endl;
        std::cout &lt;&lt; "  block::c_code_generator::generate_code(builder::builder_context().extract_function_ast(bar, \"main\"), std::cout, 0);" &lt;&lt; std::endl;
        std::cout &lt;&lt; "  return 0;" &lt;&lt; std::endl &lt;&lt; "}";
        return 0;
}
<?php } elseif ($_GET["sample"] == "blank") { ?>
static void bar(void) {
     // Insert code to stage here
}

int main(int argc, char* argv[]) {
	builder::builder_context context;
	auto ast = context.extract_function_ast(bar, "bar");
	block::c_code_generator::generate_code(ast, std::cout, 0);
	return 0;
}

<?php } elseif ($_GET["sample"] == "einsum") { ?>
<?php include 'einsum_lang.php' ?>
// test case for the expression C[i] = A[i][j] * B[j] with B initialized to a constant
static void matrix_vector_multiplication(builder::dyn_var&lt;int*&gt; C, builder::dyn_var&lt;int*&gt; A, builder::dyn_var&lt;int*&gt; B, int M, int N) {
        el::current_device = el::SERIAL;

        el::index i, j;
        el::tensor&lt;int&gt; c({M}, C);
        el::tensor&lt;int&gt; a({M, N}, A);
        el::tensor&lt;int&gt; b({N}, B);


        b[j] = 1;

        el::current_device = el::CPU_PARALLEL;
        c[i] = 2 * a[i][j] * b[j];
        el::current_device = el::SERIAL;

        b[i] = c[i];
}

int main(int argc, char* argv[]) {

        el::run_einsum_pipeline(
                builder::builder_context().extract_function_ast(
                        matrix_vector_multiplication, "matrix_vector", 1024, 512),
                std::cout);


        return 0;
}
<?php } elseif ($_GET["sample"] == "shared") {} ?>
</div>
</div>
</div>
<script src="ace-src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("codestage0");
    editor.session.setMode("ace/mode/c_cpp");
    editor.setOptions({
	wrap: true,
	showPrintMargin: false,
	});
    var first_render = true;
<?php if (isset($_GET["sample"]) && $_GET["sample"] == "einsum") { ?>
	editor.renderer.on('afterRender', function() {
	    if (first_render) {	
	    	editor.getSession().foldAll(12, 338, 0);
                first_render = false;
	    }
	});
<?php } ?>
<?php if (isset($_GET["sample"]) && $_GET["sample"] == "shared" && isset($_GET["pid"])) { ?>
	fetchInputFromPID("<?php echo $_GET["pid"];?>", 0);
<?php } ?>
<?php if (isset($_GET["sample"])) {?>
	close_banner();
<?php }?>

</script>
<!-- footer stuff -->
</div>
</body>
</html>

