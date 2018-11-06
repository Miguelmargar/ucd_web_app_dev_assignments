// Hide / show extra information required--------------------------------
function hide_show(arg) {
	var winners = document.getElementsByClassName("extra");
	for (var i = 0; i < winners.length; i++) {
		winners[i].style.display = "none";
		}
	winners[arg].style.display = "block";
	}
	
// MAIN FUNCTION-----------------------------------------------------------------------------
function display() {
	var xmlhttp = new XMLHttpRequest();
	var url = "nobels.json";
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var myArr = JSON.parse(xmlhttp.responseText);
			displayJSON(myArr);
		}
	};
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
	
// 	obtain input from search fields in html------------------------------------------
	var info1 = document.getElementById("info_needed").elements[0].value;
	var info2 = document.getElementById("info_needed").elements[1].value;
	var info3 = document.getElementById("info_needed").elements[2].value;
	var info4 = document.getElementById("info_needed").elements[3].value;
	var male = document.getElementById("info_needed").elements[4];
	var female = document.getElementById("info_needed").elements[5];
	var both = document.getElementById("info_needed").elements[6];
	
	function displayJSON(myArr) {
		// clear previous search-------------------------------------------
		function clear() {
			document.getElementById("people").innerHTML = "";
		}
		
        // show extra information for winners displayed----------------------------- 		
		function show() {
			document.getElementById("extra_button").style.display = "block";
		}
		
		// Winner information to be printed-----------------------------------
		function html(arg) {
			document.getElementById("people").innerHTML +=
				"<div class='html search_results'>" +
				"<h2>Nobel Winner details:</h2>" +
				"<p><span class='attribute'>Name: </span>" + nobels[i].firstname + "</p>" +
				"<p><span class='attribute'>Surname: </span>" + nobels[i].surname + "</p>" +
				"<p><span class='attribute'>Country of Birth: </span>" + nobels[i].bornCountry + "</p>" +
				"<p><span class='attribute'>Field of Work: </span>" + nobels[i].prizes[j].category + "</p>" +
				"<p><span class='attribute'>Year of Price: </span>" + nobels[i].prizes[j].year + "</p>" +
				"<div class='extra'>" +
				"<h2>Extra Details:</h2>" +
				"<p><span class='attribute'>Year of Birth: </span>" + nobels[i].born + "</p>" +
				"<p><span class='attribute'>Year of Death: </span>" + nobels[i].died + "</p>" +
				"<p><span class='attribute'>City of Birth: </span>" + nobels[i].bornCity + "</p>" +
				"<p><span class='attribute'>Motivation for price: </span>" + nobels[i].prizes[j].motivation + "</p>" +
				"<p><span class='attribute'>Affiliations: </span>" + nobels[i].prizes[j].affiliations[k].name + "</p>" +
				"</div>" + 
				"<div class='separate_inside_winners'><input type='submit' class='extra_button' value='Extra Info' onclick='hide_show(" + arg + ")'></div>" + 
				"</div>";
		}
		var nobels = myArr["laureates"];
		clear();
		
		// get dates in search--------------------------------------------------------------
		if (parseInt(info1) > parseInt(info2)) {
			alert("The start date has to  be at least the same as the end date, Please try again!");
		}
		else if (parseInt(info1) < 1901 || parseInt(info2) > 2018) {
			alert("The date range available is from 1901 to 2018, Please try again!");
		}
		else if (parseInt(info1) <= parseInt(info2)) {
			// loop through all json file structure--------------------------------------------------------------------
			var count = 0;
			for (var i in nobels) {
				for (var j in nobels[i].prizes) {
					for (var k in nobels[i].prizes[j].affiliations) {
					    
						// takes dates and all categories and all countries-----------------------------------------------------------
						if (parseInt(nobels[i].prizes[j].year) >= parseInt(info1) && parseInt(nobels[i].prizes[j].year) <= parseInt(info2) && info3 == "allcat" && info4 == "allcou") {
							// male search--------------------------------------------
							if (male.checked && nobels[i].gender == male.value) {
								html(count);
								count += 1;
							}
							// female search----------------------------------------------
							else if (female.checked && nobels[i].gender == female.value) {
								html(count);
								count += 1;
							}
							// both male and female search----------------------------------
							else if (both.checked) {
								html(count);
								count += 1;
							}
						}
						
						// takes dates, all countries and specific category-----------------------------------------------------------
						else if (parseInt(nobels[i].prizes[j].year) >= parseInt(info1) && parseInt(nobels[i].prizes[j].year) <= parseInt(info2) && info3 != "allcat" && info4 == "allcou") {
							if (nobels[i].prizes[j].category == info3) {
								// male search--------------------------------------------
								if (male.checked && nobels[i].gender == male.value) {
									html(count);
									count += 1;
								}
								// female search----------------------------------------------
								else if (female.checked && nobels[i].gender == female.value) {
									html(count);
									count += 1;
								}
								// both male and female search----------------------------------
								else if (both.checked) {
									html(count);
									count += 1;
								}
							}
						}
						
						// takes dates, all categories and specific country---------------------------------------------------------
						else if (parseInt(nobels[i].prizes[j].year) >= parseInt(info1) && parseInt(nobels[i].prizes[j].year) <= parseInt(info2) && info3 == "allcat" && info4 != "allcou") {
							if (nobels[i].bornCountryCode == info4) {
								// male search--------------------------------------------
								if (male.checked && nobels[i].gender == male.value) {
									html(count);
									count += 1;
								}
								// female search----------------------------------------------
								else if (female.checked && nobels[i].gender == female.value) {
									html(count);
									count += 1;
								}
								// both male and female search----------------------------------
								else if (both.checked) {
									html(count);
									count += 1;
								}
							}
						}
						
						// takes dates and specific category and specific country----------------------------------------------------
						else if (parseInt(nobels[i].prizes[j].year) >= parseInt(info1) && parseInt(nobels[i].prizes[j].year) < +parseInt(info2) && info3 != "allcat" && info4 != "allcou") {
							if (nobels[i].prizes[j].category == info3 && nobels[i].bornCountryCode == info4) {
								// male search--------------------------------------------
								if (male.checked && nobels[i].gender == male.value) {
									html(count);
									count += 1;
								}
								// female search----------------------------------------------
								else if (female.checked && nobels[i].gender == female.value) {
									html(count);
									count += 1;
								}
								// both male and female search----------------------------------
								else if (both.checked) {
									html(count);
									count += 1;
								}
							}
						}
					}
				}
			}
		}
		show();
	}
}