
$("#submitmsg").click(function() {
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");

        loadLog;

    	return false;
});


function activeInput() {
	if (document.getElementById("usermsg").value.trim() !== '') {
  		console.log("Input exists:" + document.getElementById("usermsg").value);
		document.getElementById("thread").style.display = "block";
		return;
	} else {
		//$.post("post.php", {text: "User is typing"});
		document.getElementById("thread").style.display = "none";
		console.log("No input: " + document.getElementById("usermsg").value);
	}
}

function loadLog(){    
    	var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request

	var date = new Date();
	var mm = date.getUTCMonth() + 1;
	var yyyy = date.getUTCFullYear();

		//console.log(yyyy + " " + mm);
    	$.ajax({
        	url: "/usr/logs/test/" + yyyy + "-" + "0" + mm + ".htm",
        	cache: false,
        	success: function(html) {       
            	$("#chatbox").html(html); 
           

            	var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request

            	if (newscrollHeight > oldscrollHeight) {
                	$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            	}              
        },
    });
}
 




// Dormant/onclick scripts

function ground_chat() {
	var def = document.getElementById("ext_wrapper_def");
	var bot = document.getElementById("ext_wrapper_bot");

	if (def) {
		def.id = "ext_wrapper_bot";
	} else {
		bot.id = "ext_wrapper_def";
	}

} function min_chat() {
	var minimize   = document.getElementById("ext_wrapper_def");
	var minimize2 = document.getElementById("ext_wrapper_bot");

	if (minimize) {
		minimize.setAttribute("style", "position: absolute !important; bottom: 60%; left: 50%; ");
	} else if (minimize2) {
		minimize2.setAttribute("style", "position: absolute !important; bottom: 60%; left: 50%; ");
	}
}

function ch_back_color() {

	if (document.getElementById('onoff').value === "Off") {
   		document.body.style.background = "rgba(0,0,0,0.6)";

		document.getElementById('onoff').value = "On";
		console.log("On");
	} else if (document.getElementById('onoff').value === "On") {
   		document.body.style.background = "rgba(0,0,0,0)";	
		document.getElementById('onoff').value = "Off";
		console.log("Off");
	}
}

function logout() {
	console.log("Logout?");
	if (confirm("Are you sure you want to end this session?") === false) {
		event.preventDefault(); // Stop page from reloading if cancelled
	}
}


function dup_chat() {
	
	console.log("<-- Chats");

	//console.log(Math.max.apply(Math, $('#wrapper').map(function(){ return $(this).width(); }).get()));

	var original = document.getElementById('ext_wrapper_def');
	var original2 = document.getElementById('wrapper');


	var children = document.getElementById('ext_wrapper_def').children;
	var totalWidth = 0;

	for (var i = 0; i < children.length; i++) {
    		totalWidth += children[i].offsetWidth;
		console.log(totalWidth);
	} 

	if (totalWidth > window.innerWidth) {
		console.log("Oh no!");
		var ext_clone = original.cloneNode(true); // "deep" clone
		original.parentNode.appendChild(ext_clone);
	} else if (totalWidth < window.innerWidth) {


	//original2.style.width = original2.style.width / 2;
    	var clone = original2.cloneNode(true); // "deep" clone

    	clone.id = "wrapper";
    	original2.parentNode.appendChild(clone); }
}


function stopMotion_start(anim_style) {
	var anim_div = document.createElement('div');
		anim_div.className = "stop_motion_cont";
	anim_div.innerHTML = '<div class="square_left"></div><div class="square_m_left"></div><div class="square_m_right"></div><div class="square_right"></div>';
	anim_div.setAttribute("style", anim_style);
	document.body.prepend(anim_div);

	console.log("stopMotion animation start");

	setTimeout(stopMotion_stop, 1800); // 1.8s to match the CSS animation time

	} function stopMotion_stop() {
		var stopMotion_div = document.getElementsByClassName("stop_motion_cont");

    		while(stopMotion_div.length > 0) {
        		stopMotion_div[0].parentNode.removeChild(stopMotion_div[0]);
    		} 
	}

function magic_timer() {
  	var delay = Math.floor(Math.random() * 1000000);
	
		//console.log(delay);

	setTimeout(magic_create, delay); // Change "delay" to "1000" (milliseconds) for testing

	} function magic_create() {
		var minion = document.createElement('div');
		minion.className = "minion";

		document.body.appendChild(minion); 
		console.log("Magic created");

		setTimeout(magic_destroy, 5000);

	} function magic_destroy() {
		var magic_destroy = document.getElementsByClassName("minion");
    		while(magic_destroy.length > 0) {
        		magic_destroy[0].parentNode.removeChild(magic_destroy[0]);
    		} 
	
		console.log("Magic destroyed");
	}


function create_note() {
	var button = document.createElement("button");
	button.style.cssText = "color: red; font-size: 13px; float: left; margin: 0 4px 0 1px !important;"
	button.innerHTML = "!";

	var glob_menu = document.getElementsByClassName("glob_menu")[0];
	glob_menu.appendChild(button);
}




// Recursive calls


// Modal 
$(document).ready(function() {
	$("#chatbox").on("click", "img", function (event) {
		console.log("Image clicked");
		var body = document
		var modal_cont = document.createElement("div");
			modal_cont.className = "modal_cont";
		document.body.prepend(modal_cont);
		this.classList.add("modal_img");
	});
});

setInterval (loadLog, 2000); // Milliseconds --- Fast: 360; Medium: 800;


/*

window.onfocus = function () { 
  isTabActive = true; 
}; 

window.onblur = function () { 
  isTabActive = false; 
}; 

// test
setInterval(function () { 
  console.log(window.isTabActive ? 'active' : 'inactive'); 
}, 500);

*/