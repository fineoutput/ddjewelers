function closenav(){
	document.getElementById('menu').style.transform = "translateX(-1500px)";
	document.getElementById('body').style.overflow = "auto";
}

function opennav(){
	document.getElementById('menu').style.transform = "translateX(0px)";
	document.getElementById('body').style.overflow = "hidden";
}




// slider js start //


const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");

signUpButton.addEventListener("click", function(){
  container.classList.add("right-panel-active");
});

signInButton.addEventListener("click", function(){
  container.classList.remove("right-panel-active");
});
