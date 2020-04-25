<?php include '../../../template.php'; ?>
<?php include '../stuck-template.php'; ?>
<script>document.getElementById("link-game").classList.add("active");</script>
It is almost the end of April 2020 and it has been more than 1.5 months since I have stepped out of my house. It is not easy and I have lost all sense of time. Working all through the night and sleeping during the day. It is almost as if I am - <h2>Stuck In Time and Space</h2>

Anyway, if you too are as bored and like those old text based dungeon crawling games, take a stab at <b>pandemic-crawler</b>.
<br>
<br>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>


<style>
	#outerconsolewrapper {
		background-color: rgb(20, 20, 25);
		min-height: 40em;
		position: relative;
		width:100%;
		padding: 0;
		margin: 0;
		color: rgb(225, 225, 230);
		font-family: 'courier new';
		overflow: hidden;
	}
	#titlebar {
		background-color: rgb(120, 120, 125);
		height: 1em;
		position: relative;
		display: block;
		margin: 0;
		padding: 0;
	}
	#gameconsolewrapper {
		position: relative;
		max-width: 44em;
		margin: 0em auto;
		padding: 0;
		display: block;
		top: 1em;
		height: 30em;
	}
	#gameconsole {	
		margin: 0em;
		line-height: 1em;
		cursor: pointer;
		position: absolute;
		bottom: 0px;
		width: 100%;
		min-height:30em;
	}	
	.consoletext {
		margin: 0em;
		padding: 0em;
		display: inline-block;
	}
	@keyframes blink {
		0% {
			opacity: 1;
		}
		50% {
			opacity: 0;
		}
		100% {
			opacity: 1;
		}
	}
	#consolecursor {
		background-color: rgb(225, 225, 230);
		width: 0.5em;
		display: none;
		animation: blink 1s;
		animation-iteration-count: infinite;
	}
	[contenteditable] {
  		outline: 0px solid transparent;
		caret-color: transparent;
	}
	#textonconsole {
		width: 100%;
		word-break: white-space;
		text-align: left;
	}
	#messagepanel {
		display: block;
		position: relative;
		width: 100%;
		margin-top: 1em;
		font-size: 1.5em;
		opacity: 0;
	}
</style>
<script>
window.onload = function() {
	var gameconsole = document.getElementById("gameconsole");
	var typedtext = document.getElementById("typedtext");
	var consolecursor = document.getElementById("consolecursor");
	var textonconsole = document.getElementById("textonconsole");
	var consoleprompt = document.getElementById("consoleprompt");
	/* game state description
		0 = waiting for name prompt
		1 = do you understand?
		2 = what do you do?
	*/
	

	var gameintroduction = "It is the winter of 2020, the year ... I mean the DECADE everyone was waiting for! We were going to have the Olympics, the US presidential elections, and ... umm I was probably going write my thesis. But alas, a tragedy struck the whole world - a novel Coronavirus, COVID-19 spread like wild fire and by mid April about 2.5 million people were already affected leaving nearly 200,000 dead. Everyone is confined to their houses, businesses disrupted and economy hitting an all time low. Despair everywhere with no end in sight.\n\nThe future of the world rests in the hands of not one person or the government, but each and every one of us and with YOU! The decisions that you make NOW will decide how many more people will be affected and if the medical system will be able to handle the situation.\n\nAll the major country governments have urged people to stay inside their houses and step outside ONLY for essential needs. Do you understand what you have to do?\n\n1. Yes, I am a responsible citizen and I will do my best\n2. No, but I going to do what I want and no-one can stop me!";
	var scenariotext = "............................................\n\nIt is " + new Date().toDateString() + ", 8 in the morning. You wake up and have your cup of coffee, make yourself a sandwich and sadly look at your mobile screen to read that yesterday 23000 new cases were added worldwide. \"Uhhh! Is there no end to this?\", you think to yourself.\n\nBut hey it's a bright day outside and it has been such a long time since the sun came out. This sunny day reminds you of your childhood when you used to play catch with Steve all afternoon!\n\n\"Wait! Didn't steve move to my towm the last month? I didn't even go say hi to him!\" - you feel almost guilty.\n\n";
	var reprompttext = "1. Where are my car keys? Time to meet by old buddy!\n2. Ummm, social distancing... 6 feet... Steve can wait. No, this is not an excuse to put off meeting an old friend just because I am lazy";

	var winmessage = "Oh!...\n\nOh!...\n\nYou made the right decision and you managed to fatten the curve?? That was ... simple?\n\nYes! It is THAT SIMPLE. Of course, it doesn't mean you CAN'T CAN'T step outside at all. All you have to do is ask yourself - \"Is this task essential?\". You will know when it is. It wasn't that hard to figure out that meeting your buddy is not exactly essential? The government and the medical system will take care of the rest.";
	var losemessage = "Oh!...\n\n\Oh!...\n\nYou had ONE job, just one job! How hard was that? Was meeting your old time buddy really an \"essential need\"? If you are old enough to drive a car, you are old enough to realize that it was utterly... stupid. Maybe you didn't catch the virus, but you unknowingly transferred it over to your 62 y/o neighbor, Mrs. O'donald, or the 6 y/o son of the couple who was born with an immune deficiency. They mentioned to you how worried they are these days, didn't they?.\n\n The hospitals should be able to take care of a few critical cases though, right? But just like you, 265 other folks in your neighborhood stepped out for \"getting a haircut\", \"I HAVE to watch that new Avengers movie, I am the biggest fan??\", or \"a day at the beach shouldn't hurt, right?\". 265 times 2.5 is 700 new cases. Even the biggest hospitals cannot take these many new cases in a single day.\n\n\nYou DIDN'T help flatten the curve."
	var slowtext = "";
	var addercontroller = 0;
	var addercallback = 0;
	function addtextone() {
		var chartoadd = slowtext[0];
		slowtext = slowtext.slice(1);
		if (chartoadd == " ") {
		} else if(chartoadd == "\n") {
			chartoadd = "<br>";
		}
		textonconsole.innerHTML += chartoadd;
		if (slowtext == "") {
			clearInterval(addercontroller);
			typedtext.focus();
			consoleprompt.innerHTML = ">&nbsp;";
			addercallback();
		}
	}
	function addtextslow(val, callback) {
		textonconsole.innerHTML += "<br>";
		slowtext = val;	
		addercallback = callback;
		typedtext.blur();
		addercontroller = setInterval(function(){addtextone()}, 20);	
	}
	function revealmessage() {
		setTimeout(function() {
			document.getElementById("messagepanel").style.opacity="1";
			document.getElementById("gameconsolewrapper").style.opacity="0.7";
		}, 5000);
	}
	var gamestate = 0;
	function inputreceived(val) {
		switch(gamestate) {
			case 0: if (val=="") { consoleprompt.innerHTML = ">&nbsp;Login name:&nbsp;";return;}  addtextslow("Welcome, " + val + "\n" + gameintroduction, function(){}); var oReq = new XMLHttpRequest(); oReq.open("GET", "/game/log.php?name=" + val); oReq.send(); break;
			case 1: if (val=="1") addtextslow("Good!\n\n" + scenariotext + reprompttext, function(){}); else addtextslow("Hmm, well! We can hope for the best.\n\n" + scenariotext + reprompttext, function(){}); break;
			case 2: if (val=="2") addtextslow(winmessage, function(){revealmessage();}); else if (val=="1") addtextslow(losemessage, function(){revealmessage();}); else {addtextslow(reprompttext, function(){}); gamestate -=1;} break;
		}
		gamestate+=1;
	}
	gameconsole.onclick = function(e) {
		typedtext.focus();
		e.stopPropagation();
	}
	typedtext.onfocus = function(e) {
		consolecursor.style.display="inline-block";
	}
	typedtext.onblur = function() {
		consolecursor.style.display="none";
	}
	document.body.onclick = function() {
		typedtext.blur();
	}
	typedtext.onkeyup = function(e) {
		if (e.keyCode === 13) {
			var texttoadd = typedtext.innerHTML.split("<br>").join("");
			var prompttext = consoleprompt.innerHTML;
			typedtext.innerHTML = "";
			consoleprompt.innerHTML = "";
			textonconsole.innerHTML += "<br>" + prompttext + texttoadd;
			inputreceived(texttoadd);
		}
	}
	gameconsole.click();
}
</script>
<div id="titlebar"></div>
<div id="outerconsolewrapper">
	<div id="gameconsolewrapper">
		<div id="gameconsole">
		<p class="consoletext" id="textonconsole">Running pandemic-crawl.exe</p>
		<br>
		<p class="consoletext" id="consoleprompt">>&nbsp;Login name:&nbsp;</p><p id="typedtext" class="consoletext" contenteditable="true"></p><p class="consoletext" id="consolecursor">&nbsp;</p>
		</div>
	</div>
	<div id="messagepanel">
		<center>You must have realized at this point that this wasn't really a game. It was an elaborate diversion, but with a simple message - We know it's hard. Some of us are being more than just "inconvenienced". But everyone is doing their part, the medical staff, the essential workers. Please do yours and stay indoors. <br>
		<div class="fb-share-button" data-href="https://stuck.intimeand.space/game" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fstuck.intimeand.space%2Fgame&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
		</center>
		<br>
	</div>
</div>


<?php include '../../../footer.php'; ?>
