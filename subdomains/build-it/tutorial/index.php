<?php $ogtitle="BuildIt"; ?>
<?php include '../params.php'; ?>
<?php include '../../../template.php'; ?>
<?php include '../buildit-template.php'; ?>
<style>
article {
   max-width: 50em;
}
</style>
<script>document.getElementById("link-tutorial").classList.add("active");</script>

<h1>Building DSLs made easy with the BuildIt Framework</h1>
<ul>
<!--<li>CGO 2024, Workshop and Tutorials, <b>8:30 am, 2nd March 2024</b>, Edinburgh, UK</li>-->
<!--<li>DSL Development Workshop@MIT, <b>6th May 2024 3pm - 6pm</b> 32-G882 Stata Center, 32 Vassar St</li>-->
<li>PLDI 2024, Workshop and Tutorials, <b>24th June 2024</b> Copenhagen, Denmark</li>
</ul>
<br>
Tutorial Repo with all the code and instructions at - <a href="https://github.com/BuildIt-lang/buildit-array" target="_blank">https://github.com/BuildIt-lang/buildit-array</a>
<br>
<br>
The BuildIt project was started in 2020 with the goal of making it possible for rapidly prototyping embedded DSLs using a multi-stage programming approach while targeting parallel CPUs, GPUs and now FPGAs. Our publications in the previous years demonstrated how BuildIt can be used to write DSLs that match the performance of state-of-the-art compilers with a small fraction of the development effort. Although BuildIt is targeted towards domain experts who have limited experience with compiler technology, it also greatly simplifies the development process for compiler experts allowing implementing analyses, transformations and code generations for various architectures with a fraction of lines of code as compared to traditional compilers. We believe this makes BuildIt a very interesting topic for not just PLDI attendees but also the co-located workshops. 
<br>
BuildIt not only simplifies the process of implementing compilers but also provides other toolchain support like debugging. Our recent paper at GGO 2023 that was awarded a distinguished paper award demonstrates how rich and customizable debugging support can be added to DSLs written with BuildIt without a single line of code change. 
<br>
<br>
<h2>Agenda</h2>
<ol>
<li>Basics of BuildIt [1 hr, including setup time]
<ol>
<li>Writing programs in multiple stages using BuildIt’s dyn&lt;T&gt; and static&lt;T&gt; types</li>
<li>Implementing a simple DSL that generates naive code for user programs</li>
</ol>
</li>
<li>Optimizations with BuildIt [1 hr]
<ol>
<li>Implementing a whole-program analysis for the DSL that enables optimizations without writing any “compiler-ish” code. </li>
<li>Using analysis results and user schedules to specialize and optimize the generated code. </li>
<li>Using specialization and BuildIt annotations to retarget the generated code for Nvidia GPUs </li>
</ol>
</li>
<!--
<li>Adding Debugger Support [45 mins]
<ol>
<li>Adding D2X support to above implemented DSL and using it with GDB to debug programs</li>
<li>View input program + Input program breakpoints</li>
<li>View program state</li>
<li>View optimization details in the debugger</li>
<li>Customizing D2X generated debug information with custom user defined commands</li>
</ol>
</li>
-->
<li>Hear from BuildIt Users/Contributors [1 hr]
<ol>
<li>Cola and Shim – Prof. Saman Amarasinghe and Jessica Ray</li>
<!--<li> - Manya</li>-->
<li>Lightweight Fusion of General Purpose Code - Manya Bansal</li>
<!--<li>MARCH - Francesco Peverelli</li>-->
<li>A Hybrid IR for BuildIt - Vedant Paranjape</li>
<li>Netblocks - Ajay Brahmakshatriya</li>
</ol>
</li>

<li>Optional: Develop a new DSL of your interest with help from the organizers.
</li>
</ol>
<h2>Pre-requisistes</h2>
The tutorial will be completely hands-on, with presentations from the organizers and relevant skeleton code shared for development. <br>
Attendees are expected to have access to a computer with Linux or MacOS. Windows with WSL also works great. A system with CUDA enabled GPU (optional). Basic experience with C++ expected.
<br>
<br>
We also have some BuildIt swag for attendees!!
<br>
<hr>
<h2> Organizers and Speakers</h2>
<!--<ol>
<li>Ajay Brahmakshatriya, Massachusetts Institute of Technology. <a href="mailto:ajaybr@mit.edu">Email: ajaybr@mit.edu</a></li>
<li>Saman Amarasinghe, Massachusetts Institute of Technology</li>
</ol>
-->
<div>
<img src="Ajay.jpg" width = 200/><br>
<b>Ajay Brahmakshatriya</b> (ajaybr@mit.edu) is a 6th year PhD student advised by Prof. Saman Amarasinghe at CSAIL, MIT. His research interests are
making it easier for folks to create their own programming languages with focus on high-performance systems domains.
In the past he has worked on DSLs for domains like graphs and networks targeting a variety of architectures like
CPUs, GPUs and domain specific hardware. His current work on BuildIt makes the process of designing and implementing
DSLs easier while also providing other toolchain support like debugging.
</div>
<br>
<div>
<img src="Saman.jpg" width = 200/><br>
<b>Saman Amarasinghe</b> is a Professor in the Department of Electrical Engineering and Computer Science at Massachusetts Institute of Technology and a member of its Computer Science and Artificial Intelligence Laboratory (CSAIL) where he leads the Commit compiler group. Under Saman’s guidance, the Commit group has developed a myriad of pioneering programming languages and compilers including the StreamIt, StreamJIT, PetaBricks, Halide, Simit, MILK, Cimple, TACO, GraphIt, BioStream, CoLa and Seq programming languages and compilers, DynamoRIO, Helium, Tiramisu, Codon and BuildIt compiler/runtime frameworks, Superword Level Parallelism (SLP), goSLP and VeGen for vectorization, Ithemal machine learning based performance predictor, Program Shepherding to protect programs against external attacks, the OpenTuner extendable autotuner, and the Kendo deterministic execution system. He was the co-leader of the Raw architecture project. Beyond academia, Saman was a co-founder of Determina, Lanka Internet Services Ltd., Venti Technologies, DataCebo and Exaloop corporations.  Saman received his BS in Electrical Engineering and Computer Science from Cornell University in 1988, and his MSEE and Ph.D. from Stanford University in 1990 and 1997, respectively. He is an ACM Fellow.
</div>
<br>
<div>
<img src="Manya.jpg" width = 200/><br>
<b>Manya Bansal</b> is a first year PhD student advised by Saman Amarasinghe and Jonathan Ragan-Kelley. She currently works on achieving high-performance for compute intensive applications using techniques in the programming language and compilers community. Her website can be found at https://manya-bansal.github.io/.
</div>
<br>
<div>
<img src="Vedant.jpg" width = 200/><br>
<b>Vedant Paranjape</b> works on LLVM Compilers at AMD and is an incoming Masters student at Purdue for Fall 2024. He mainly works on middle-end and backend optimizations with some experience working on Clang frontend. His interest is primarily in systems research. Other than that he loves to design hardware, and tinker with obscure embedded boards.
</div>
<style>
</style>
<?php include '../../../footer.php'; ?>
