<?php $ogtitle="Build&rarr;It"; ?>
<?php include '../params.php'; ?>
<?php include '../../../template.php'; ?>
<?php include '../buildit-template.php'; ?>
<script>document.getElementById("link-demo").classList.add("active");</script>
<style>
.buildit-code-area {
	resize: none;
	width: calc(100% - 1em);
	padding: 0.5em;
	border: 0px;
	height: 400px;
}
.com-error {
	color: red;
	text-align: left;
}
.banner-text {
	text-align: left;
}
</style>
<script>
var current_stage_max = 0;

function fetchAndDisplayOutput(requestId, sid) {	
	var dest = "https://bc-api.intimeand.space/result/" + requestId;
	
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var parent_div = document.getElementById("stage" + sid);
			while (parent_div.firstChild) {
				parent_div.removeChild(parent_div.firstChild);
			}

			var title = document.createElement("h2");
			title.textContent = "Stage " + (sid + 1);
			parent_div.appendChild(title);
			

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
			
			var button = document.createElement("button");
			button.id = "button" + sid;
			button.textContent = "BuildIt!";
			button.onclick = function(sid){return function() {buildit_stage(sid)};}(sid);
			parent_div.appendChild(button);	
			//document.getElementById("stage" + sid).innerHTML += '<button id="addmain'+sid+'" onclick="add_main('+sid+')">Add main</button>';
		}
	}
	xhr.send();
}

function fetchAndDisplayError(requestId, sid) {	
	var dest = "https://bc-api.intimeand.space/error/" + requestId;
	
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			document.getElementById("stage"+sid).innerHTML = '<div class="com-error">Build or Run failed with error<br>' + xhr.responseText +'</div>';
		}
	}
	xhr.send();
}

function checkRequest(requestId, sid) {
	var dest = "https://bc-api.intimeand.space/status/" + requestId;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", dest, true);
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			if (xhr.responseText == "0") {
				setTimeout(function(){checkRequest(requestId, sid);}, 1000);
			} else if (xhr.responseText == "1" || xhr.responseText == "2") {
				fetchAndDisplayError(requestId, sid);
			} else if (xhr.responseText == "3") 
				fetchAndDisplayOutput(requestId, sid);
		}
	}
	xhr.send();
}


function createStageBox(sid) {
	//document.getElementById("buildit-stages").innerHTML += '<div class="buildit-stage" id="stage'+sid+'">Running...</div>';	

	var stage_box = document.createElement("div");
	stage_box.class="buildit-stage";
	stage_box.id = "stage" + sid;
	stage_box.innerHTML = "Running...";
	
	document.getElementById("buildit-stages").appendChild(stage_box);

	current_stage_max = sid;
}

function buildit_stage(sid) {
	for (id = sid + 1; id <= current_stage_max; id++) {
		var elem = document.getElementById("stage" + id);
		if (elem)
			elem.parentNode.removeChild(elem);
	}	
	
	createStageBox(sid+1);
	var dest = "https://bc-api.intimeand.space/run";
	var xhr = new XMLHttpRequest();
	xhr.open("POST", dest, true);
	
	var code_body = ace.edit(document.getElementById("codestage" + sid)).getValue();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log(xhr.responseText);
			setTimeout(function(){checkRequest(xhr.responseText, sid+1);}, 1000);
		}
	}
	xhr.send(code_body);
	
}
function add_main(sid) {
	document.getElementById("codestage" + sid).value += '\nint main(int argc, char* argv[]) {\n    auto ast = builder::builder_context().extract_function_ast(foo, "foo");\n    block::c_code_generator::generate_code(ast, std::cout, 0);\n    return 0;\n}';
}
</script>
<div class="banner-text">
This is an online demo for BuildIt. Input your BuildIt program in the textarea below and hit the &quot;BuildIt&quot; button below it. BuildIt will add a new stage and show the output. You can further edit the program before running it again. We have a few pre-written samples here<br>
<br><br>
Samples
<ol>
<li><a href="?">Power Function</a></li>
<li><a href="?sample=bfinterp">BrainFuck Interpreter</a></li>
<li><a href="?sample=3stage">3 stage execution</a></li>
<li><a href="?sample=blank">Blank</a></li>
</ol>
</div>
<center>
<div id="buildit-stages">
<div class="buildit-stage" id="stage0">
<h2>Stage 1</h2>
<div rows="30" id="codestage0" class="buildit-code-area" contenteditable>// Include the headers
#include "blocks/c_code_generator.h"
#include "builder/static_var.h"
#include "builder/dyn_var.h"
#include &lt;iostream&gt;

// Include the BuildIt types
using builder::dyn_var;
using builder::static_var;
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
const char *bf_program;
dyn_var&lt;void(int)&gt; *print_value_ptr;
dyn_var&lt;int()&gt; *get_value_ptr;

static int find_matching_closing(int pc) {
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
static int find_matching_opening(int pc) {
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
// BF interpreter
static void interpret_bf(void) {
	auto &amp;get_value = *get_value_ptr;
	auto &amp;print_value = *print_value_ptr;

	dyn_var&lt;int&gt; pointer = 0;
	static_var&lt;int&gt; pc = 0;
	dyn_var&lt;int[256]&gt; tape = {0};
	while (bf_program[pc] != 0) {
		if (bf_program[pc] == '&gt;') {
			pointer = pointer + 1;
		} else if (bf_program[pc] == '&lt;') {
			pointer = pointer - 1;
		} else if (bf_program[pc] == '+') {
			tape[pointer] = (tape[pointer] + 1) % 256;
		} else if (bf_program[pc] == '-') {
			tape[pointer] = (tape[pointer] - 1) % 256;
		} else if (bf_program[pc] == '.') {
			print_value(tape[pointer]);
		} else if (bf_program[pc] == ',') {
			tape[pointer] = get_value();
		} else if (bf_program[pc] == '[') {
			int closing = find_matching_closing(pc);
			if (tape[pointer] == 0) {
				pc = closing;
			}
		} else if (bf_program[pc] == ']') {
			int opening = find_matching_opening(pc);
			pc = opening - 1;
		}
		pc += 1;
	}
}
static void print_wrapper_code(std::ostream &amp;oss) {
	oss &lt;&lt; "#include &lt;stdio.h&gt;\n";
	oss &lt;&lt; "#include &lt;stdlib.h&gt;\n";
	oss &lt;&lt; "void print_value(int x) {printf(\"%c\", x);}\n";
	oss &lt;&lt; "int get_value(void) {char x; scanf(\" %c\", &amp;x); return x;}\n";
	oss &lt;&lt; "int main(int argc, char* argv[]) ";
}
int main(int argc, char *argv[]) {
	builder::builder_context context;

	// BF program that prints hello world
	bf_program =
	    "++++++++[&gt;++++[&gt;++&gt;+++&gt;+++&gt;+&lt;&lt;&lt;&lt;-]&gt;+&gt;+&gt;-&gt;&gt;+[&lt;]&lt;-]&gt;&gt;.&gt;---.++++++"
	    "+..+++.&gt;&gt;.&lt;-.&lt;.+++.------.--------.&gt;&gt;+.&gt;++.";

	print_value_ptr =
	    context.assume_variable&lt;dyn_var&lt;void(int)&gt;&gt;("print_value");
	get_value_ptr =
	    context.assume_variable&lt;dyn_var&lt;int(void)&gt;&gt;("get_value");

	auto ast = context.extract_ast_from_function(interpret_bf);

	print_wrapper_code(std::cout);
	block::c_code_generator::generate_code(ast, std::cout, 0);
	return 0;
}

<?php } elseif ($_GET["sample"] == "3stage") { ?>
static void bar(void) {
        for (static_var&lt;int&gt; i = 0; i &lt; 10; i++) {
                for (dyn_var&lt;static_var&lt;int&gt;&gt; g = 0; g &lt; i; g = g + 1) {
                        dyn_var&lt;dyn_var&lt;int&gt;&gt; x = i;
                        x = x + 1;
                }
        }
}

int main(int argc, char *argv[]) {
        builder::builder_context context;
        auto ast = context.extract_function_ast(bar, "bar");
        std::cout &lt;&lt; "#include \"builder/dyn_var.h\"" &lt;&lt; std::endl;
        std::cout &lt;&lt; "#include \"builder/static_var.h\"" &lt;&lt; std::endl;
        std::cout &lt;&lt; "#include \"blocks/c_code_generator.h\"" &lt;&lt; std::endl;

        block::c_code_generator::generate_code(ast, std::cout, 0);

        std::cout &lt;&lt; "int main(int argc, char* argv[]) {" &lt;&lt; std::endl;
        std::cout &lt;&lt; "  block::c_code_generator::generate_code(builder::builder_context().extract_function_ast(bar, \"bar\"), std::cout, 0);" &lt;&lt; std::endl;
        std::cout &lt;&lt; "  return 0;" &lt;&lt; std::endl &lt;&lt; "}";
        return 0;
}
<?php } elseif ($_GET["sample"] == "blank") { ?>
static void bar(void) {
     // Insert code to stage here
}

int main(int argc, char* argv[]) {
	block::c_code_generator::generate_code(builder::builder_context().extract_function_ast(bar, "bar"), std::cout, 0);
	return 0;
}

<?php } ?>
</div>
<button id="button0" onclick="buildit_stage(0)">BuildIt!</button>
</div>

</div>
</center>
<br><br><br>
<div class="banner-text" style="font-size:13px">
This demo is running on our research server. If you find any bug/security concerns with the demo please create an issue at - <a href="https://github.com/BuildIt-lang/buildit-online" target="_blank">https://github.com/BuildIt-lang/buildit-online</a>
<br>
Editor and syntax highlighting powered by <a href="https://ace.c9.io/#nav=about">Ace</a>.
</div>
<script src="ace-src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("codestage0");
    editor.session.setMode("ace/mode/c_cpp");
    editor.setOptions({
	wrap: true,
	showPrintMargin: false
	});

</script>
<?php include '../../../footer.php'; ?>
