

const pathName = window.location.pathname;
const pageName = pathName.split("/").pop();

if(pageName === "createviolationreport.php"){
	document.querySelector(".page2").classList.add("active");
}

if(pageName === "managereport.php"){
	document.querySelector(".page4").classList.add("active");
}

if(pageName === "accontmanager.php"){
	document.querySelector(".page5").classList.add("active");
}

