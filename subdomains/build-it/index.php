<?php $ogtitle="Build&rarr;It"; ?>
<?php include '../../template.php'; ?>
<?php include 'buildit-template.php'; ?>
<script>document.getElementById("link-home").classList.add("active");</script>
<style>
</style>
<center>
<br>
<h1>Build&rarr;It</h1><br>
<a class="icons-link" target="_blank" href="https://github.com/AjayBrahmakshatriya/buildit"><img src="https://img.shields.io/badge/BuildIt-MIT-brightgreen"/></a>&nbsp;<a class="icons-link" target="_blank" href="https://github.com/AjayBrahmakshatriya/buildit/fork"><img src="https://img.shields.io/github/forks/AjayBrahmakshatriya/buildit"/></a>&nbsp;<a class="icons-link" href="https://github.com/AjayBrahmakshatriya/buildit/" target="_blank"><img src="https://img.shields.io/github/stars/AjayBrahmakshatriya/buildit"/></a><br>
<a href="https://travis-ci.com/github/BuildIt-lang/buildit" class="icons-link" target="_blank"><img src="https://travis-ci.com/BuildIt-lang/buildit.svg?branch=master"/></a>
<h3>&quot;Every problem in Computer Science can be solved with a level of indirection and every problem in Software Engineering can be solved with a step of code-generation&quot;</h3><br>
</center>
<b>Build&rarr;It</b> is a lightweight<sup>1</sup> type-based<sup>2</sup> multi-stage programming<sup>3</sup> framework in C++. Besides extracting expressions and statements, <b>Build&rarr;It</b> supports extracting rich data-dependent control flow like if-then-else conditions and for and while loops using its novel re-execution strategy to explore all control-flow paths in the program. 
<br>

<b>Build&rarr;It</b> turns -
<div class="code-block">
<span class="code-keyword">template</span> &lt;typename BT, typename ET&gt;<br>
dyn_var&lt;<span class="code-keyword">int</span>&gt; power_f(BT base, ET exponent) {<br>
&nbsp;&nbsp;dyn_var&lt;<span class="code-keyword">int</span>&gt; res = 1, x = base;<br>
&nbsp;&nbsp;<span class="code-keyword">while</span> (exponent &gt; 1) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="code-keyword">if</span> (exponent % 2 == 1)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;res = res * x;<br>
&nbsp;&nbsp;&nbsp;&nbsp;x = x * x;<br>
&nbsp;&nbsp;&nbsp;&nbsp;exponent = exponent / 2;<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;<span class="code-keyword">return</span> res * x;<br>
}<br>
...<br>
<span class="code-keyword">int</span> power = 15;<br>
context.extract_function_ast(power_f&lt;dyn_var&lt;<span class="code-keyword">int</span>&gt;, static_var&lt;<span class="code-keyword">int</span>&gt;&gt;, "power_15", power);<br>
...<br>
<span class="code-keyword">int</span> base = 5;<br>
context.extract_function_ast(power_f&lt;static_var&lt;<span class="code-keyword">int</span>&gt;, dyn_var&lt;<span class="code-keyword">int</span>&gt;&gt;, "power_5", base);<br>
...<br>
</div>

into - 
<div class="code-block">
<span class="code-keyword">int</span> power_15 (<span class="code-keyword">int</span> arg0) {<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var0 = arg0;<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var1 = 1;<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var2 = var0;<br>
&nbsp;&nbsp;var1 = var1 * var2;<br>
&nbsp;&nbsp;var2 = var2 * var2;<br>
&nbsp;&nbsp;var1 = var1 * var2;<br>
&nbsp;&nbsp;var2 = var2 * var2;<br>
&nbsp;&nbsp;var1 = var1 * var2;<br>
&nbsp;&nbsp;var2 = var2 * var2;<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var3 = var1 * var2;<br>
&nbsp;&nbsp;<span class="code-keyword">return</span> var3;<br>
}<br>
<br>
<span class="code-keyword">int</span> power_5 (<span class="code-keyword">int</span> arg1) {<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var0 = arg1;<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var1 = 1;<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var2 = 5;<br>
&nbsp;&nbsp;<span class="code-keyword">while</span> (var0 &gt; 1) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;if ((var0 % 2) == 1) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var1 = var1 * var2;<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;var2 = var2 * var2;<br>
&nbsp;&nbsp;&nbsp;&nbsp;var0 = var0 / 2;<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;<span class="code-keyword">int</span> var3 = var1 * var2;<br>
&nbsp;&nbsp;<span class="code-keyword">return</span> var3;<br>
}<br>
</div>
<br>
<b>Build&rarr;It</b> is available opensource on <a href="https://github.com/AjayBrahmakshatriya/buildit/" target="_blank">GitHub</a> under the MIT license. Many more samples are available in the <i><a href="https://github.com/AjayBrahmakshatriya/buildit/tree/master/samples" target="_blank">samples/</a></i> directory including turning an <a href="https://github.com/AjayBrahmakshatriya/buildit/tree/master/samples/sample17.cpp" target="_blank">interpreter for BrainFuck into a compiler</a> using Futamura projections.<br><br>


<b>1.</b> <b>Build&rarr;It</b> uses a purely library based approach and does not require any special compiler modifications making it extremely portable and easy to integrate into existing code bases. </b> Using <b>Build&rarr;It</b> is as easy as including a few header files and linking against the <b>Build&rarr;It</b> library. 
<br>
<b>2.</b> <b>Build&rarr;It</b> uses the declared types of variables and expressions to decide the binding time. <b>Build&rarr;It</b> adds 2 new generic types - <i>static_var&lt;T&gt;</i> and <i>dyn_var&lt;T&gt;</i> which lets the user program with 2 stages. These types can be nested arbitrarily to produce code for more stages. 
<br>
<b>3.</b> What exactly is multi-stage programming and why it is important for high-performance DSLs is explained <a href="/multistaging">here</a>. <br><br>

If you think this work is useful for your research, please <i>star</i> the repository! <br><br>

<?php include '../../footer.php'; ?>
