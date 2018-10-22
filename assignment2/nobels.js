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
    
    var info1 = document.getElementById("year1").innerText;    
    var info2 = document.getElementById("info_needed").elements[1].value;
    var info3 = document.getElementById("info_needed").elements[2].value;
    var info4 = document.getElementById("info_needed").elements[3].value;
    
    function displayJSON(obj) {
        var nobels = obj.laureates;
        var firstName = nobels.firstname;
        var surname = nobels.surname;
        var countryBirth = nobels.bornCountry;
        var yearPrize = nobels.prizes.year;
        var category = nobels.prizes.category;
        
        
        
        for (var i = 0; i < obj.length; i++) {
            document.getElementById("id01").innerHTML = obj.laureates.firstname[i];     
        }
        
    }
}


