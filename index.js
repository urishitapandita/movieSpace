const tabs = document.querySelectorAll("[data-tab-target]");
const tabContents = document.querySelectorAll("[data-tab-content]");

tabs.forEach((tab) => {
	tab.addEventListener("click", () => {
		const target = document.querySelector(tab.dataset.tabTarget);
		tabContents.forEach((tabContent) => {
			tabContent.classList.remove("active");
		});
		tabs.forEach((tab) => {
			tab.classList.remove("active");
		});
		tab.classList.add("active");
		target.classList.add("active");
	});
});

var showHide;
function show_hide() {
	if(showHide == 0) {
		document.getElementById("postform3").style.display="none";
		return showHide = 1;
	}
	else {
		document.getElementById("postform3").style.display="inline";
		return showHide = 0;
	}
}

var showHide2;
function show_hide1() {
	if(showHide2 == 0) {
		document.getElementById("updateImage").style.display="none";
		return showHide2 = 1;
	}
	else {
		document.getElementById("updateImage").style.display="block";
		return showHide2 = 0;
	}
}

var showHide3;
function show_hide2() {
	if(showHide3 == 0) {
		document.getElementById("postform4").style.display="none";
		return showHide3 = 1;
	}
	else {
		document.getElementById("postform4").style.display="inline";
		return showHide3 = 0;
	}
}

