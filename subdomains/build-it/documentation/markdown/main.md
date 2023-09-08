<a name="overview"></a>
<h2 class="doc-section">Overview</h2>
BuildIt is a light-weight type-based multi-stage programming framework in C++ with primary focus on making it easy to develop high-performance domain-specific languages (DSLs) embedded in C++. The core BuildIt library implements the two template types `dyn_var<T>` and `static_var<T>` and utilities the user can use to extract, generate and compile code. The rest of the library has several utilities focused on DSL features like parallel code generation, analysis and transformations and extending user defined types.

This document assumes familiarity with C++ for the multi-stage library and understanding of peformance and optimizations for the DSL implementations. BuildIt doesn't expect any compiler expertise but familiarity wiht compilers can help with some internal low-level interfaces that are also documented here.

BuildIt can be used in two ways, either by building from source and using in your applications or with the online tool for experimenting and generating code. Both the methods are documented here. The language reference is the same for both the modes.

---
<a name="installation"></a>
<h2 class="doc-section">Installation</h2>
The following section documents the steps to fetch, compile and run test cases for the BuildIt library. The library is available open-source under the [MIT license](https://github.com/BuildIt-lang/buildit/blob/master/LICENSE).

<a name="requirements"></a>
<h3 class="doc-subsection">Requirements</h3>
BuildIt is a light-weight C++ library and doesn't require any special compiler. The main requirements are -

- Linux/MacOS platform
- C++ and C compiler (C++11 compliant)
- make
- git

<a name="buildit-build"></a>
<h3 class="doc-subsection">Cloning and Building</h3>

Start by cloning the main BuildIt repo with the command - 

<div class="code-command">
git clone --recursive https://github.com/BuildIt-lang/buildit.git
</div>

To build the repository, navigate to the directory and run make 

<div class="code-command">
make -j $(nproc)
</div>

If no errors are reported, you can run the samples that also double and test cases with the command -

<div class="code-command">
make run
</div>

The build system should run all the test cases and report if any fail. 

<a name="linking-buildit"></a>
<h3 class="doc-subsection">Using BuildIt in your project</h3>
Once you have successfully built BuildIt from source, you are ready to start using it in your project. You just need to notedown the path where you had cloned BuildIt in the previous section. We will need the path to the tell the compiler where the headers and libraries are. 
The officially supported way to obtain the correct compile and link flags is to use the `compile-flags` and `linker-flags` targets from the Makefile. Suppose you write a C++ file `foo.cpp` that uses BuildIt types and functions, you can compile it as - 

<div class="code-command">
g++ $(make --no-print-directory -C &lt;path-to-buildit-rep&gt; compile-flags) foo.cpp $(make --no-print-directory -C &lt;path-to-buildit-repo&gt; linker-flags) -O3 -o foo
</div>

---

<a name="online-tool"></a>
<h2 class="doc-section">Using the online tool</h2>

The following section documents using the online tool available on the BuildIt website which is a great way to try 
BuildIt without having to download and install it. 

Start by navigating to the online tool at [https://buildit.so/tryit](https://buildit.so/tryit/). 
You will be presented with a popup that lists several samples and a disclaimer about 
use of the online tool. 


You can choose one of the samples by clicking on the link and dismiss the popup with the close button. At any time, the 
popup can be brought up again by clicking the <u>?</u> button in the top menu bar. 

Write/Edit the code in the main text area as you would in a cpp file. The language spec for the online tool is exactly 
the same except for a few restrictions - 


1. Since the compiled code runs on our web-servers, we have restricted access to the file system and other systemcalls. 
If you perform any restricted systemcall (Eg. `open`), you will be presented with the `Bad System Call` error message.
2. For similar reasons as above, we have restricted the code execution time to 5 seconds and some limits on the amount 
of memory that can be used by the process. Please try to keep the programs small and simple. 

After writing the code you can hit the triangle shaped run button in the top menu bar. The tool will build and execute 
your code and add another stage in the top menu bar (next to Stage 1). You will also automatically be navigated to the 
newly generated stage. You can navigate between the stages by clicking on the appropriate stage. You can further modify
the code generated for the second stage and execute it as before with the run button. 

In case your program encounters an error either during compilation or execution, the error message would be shown in 
the newly added stage in red. 

To share a code snippet, click on the share button in the top menu bar (left of the triangular run button) and a small
popup will present a unique link for the currently opened stage code. You can copy and share this link. Please remember
that the shared link is only for the current stage and not for the previous stages or the next stages. 

---

<a name="reference"></a>
<h2 class="doc-section">Reference for types and functions</h2>
This section documents all the types and functions introduced by BuildIt. This is the main reference for BuildIt's
programming API. 

All the types and functions are part of two namespaces - `builder` and 
`block`. The builder namespace has the API to use and write code with BuildIt's staging 
framework. The block namespace is an internal API to represent and manipulate the generated code in memory and produce
code. All the functions and types are documented below. For this reference, we will use the abbreviations in the title - 

- `T`: Type (class/struct)
- `F`: Standalone Function
- `MF`: Member Function
- `SMF`: Static Member Function


<a name="builder_context"</a>
<h2 class="doc-ref-entry"><b>T</b>:   builder::builder_context</h2>
> The `builder::builder_context` type is the main context object type used to extract code 
from functions and lambdas. The constructor for `builder::builder_context` takes no arguments but can be configured 
after construction with serveral configuration functions. 

<a name="extract_function_ast"></a>
<h2 class="doc-ref-entry">MF:  builder::builder_context::extract_function_ast(F, std::string name, ...)</h2>
