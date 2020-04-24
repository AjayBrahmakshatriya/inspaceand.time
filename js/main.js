function profile_picture_open() {
	document.getElementById("imgwrapper").className="imgwrapperopen";
	document.getElementById("profilepicture").className="profile profileopen";
	document.getElementById("imgwrapper").style.animationName="imgwrapper_frames_open";
	document.getElementById("profilepicture").style.animationName="profile_frames_open";
}
function profile_picture_close() {
	document.getElementById("imgwrapper").className="imgwrapperclosed";
	document.getElementById("profilepicture").className="profile profileclosed";
	document.getElementById("imgwrapper").style.animationName="imgwrapper_frames_close";
	document.getElementById("profilepicture").style.animationName="profile_frames_close";
}
profile_state = 0;
window.onload = function() {
	if (document.getElementById("imgwrapper")) {
		document.getElementById("imgwrapper").addEventListener("click", function (ev) {
			if (profile_state == 0) {
				profile_picture_open();
				profile_state = 1;
			} else {
				profile_picture_close();
				profile_state = 0;
			}
			ev.stopPropagation();	
		}, false);

		document.body.addEventListener("click", function() {
			if (profile_state == 1) {
				profile_picture_close();
				profile_state = 0;
			}
		}, false);
	}
}


