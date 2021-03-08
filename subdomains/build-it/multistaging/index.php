<?php $ogtitle="Build&rarr;It"; ?>
<?php include '../params.php'; ?>
<?php include '../../../template.php'; ?>
<?php include '../buildit-template.php'; ?>
<script>document.getElementById("link-ms").classList.add("active");</script>
In the most general sense, multi-stage programming or meta-programming or generative-programming is programming in stages, where the output of a stage is the code for the next stage. The figures below explain this adequately (the Virgin single-stage vs the Chad multi-stage).
<br>
<br>
<img style="width:100%;background-color:white" src="https://docs.google.com/drawings/d/e/2PACX-1vRDiDCUGknSn4xjvSzlUpc15TG2TKGzjgDxVbL2I6BrRy3kysRgvhz_sGWT_p-Fqr3vNMGK-lYV_bvw/pub?w=899&amp;h=331">
Something worth noticing here is that each <i>stage</i> has its own compilation and run (or interpretation) step and its own set of inputs. 
<br>
&quot;Why go through all this trouble though?&quot; - that's a perfectly valid question. We can just squeeze all the inputs together and write a program with a single compilation and execution step. Let's keep the compilation steps to minimum. We have all struggled with C++ compiler's cryptic error messages.
<br><br>

Well, the short answer is - We use multi-staging all the time. This very page you are currently viewing is a result of two stages of execution. I wrote the website in PHP (let the PHP bad memes flow!) which executes on my server to produce HTML as a string. This your computer and the HTML engine in your browser renders it<sup>1</sup>. If you have ever written any neural network with Tensorflow, you might recollect that it first constructs a static/dynamic graph with placeholders and executes it with concrete inputs later. This way the Tensorflow runtime is not only able to automatically calculate gradients but is also able to generate the most efficient code for each graph. 
<br><br>
The long and Software Engineery answer is <a href="">here</a>.
<?php include '../../../footer.php'; ?>
