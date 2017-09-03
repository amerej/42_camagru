/* 
**  Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon
*/
function addResponsiveClass() {
    var x = document.getElementById("topnav");
    var y = document.getElementById("nav-section");
    if (x.className === "topnav")
        x.className += " responsive";
    else
        x.className = "topnav";
    if (y.className === "nav-section")
        y.className += " responsive";
    else
        y.className = "nav-section";
}

/* 
**  Close responsive menu when clickink on anchor link
*/
function closeOnClick() {
    var x = document.getElementById("topnav");
    var y = document.getElementById("nav-section");
    
    if (y.className === "nav-section responsive") {
        x.className = "topnav";
        y.className = "nav-section";
    }
}
