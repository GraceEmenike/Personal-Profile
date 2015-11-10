function alert() {
    alert('This is a test alert');
}
function displaydiv() {
    var el = document.getElementById('outer');
    el.style.borderWidth = "3px";
    el.style.borderColor = "white";
}
function hidediv() {
    var el = document.getElementById('outer');
    el.style.borderWidth = "0px";
}
function menu_hover(option, id) {// change it to background
    if (option === "0") {
        document.getElementById(id).style.backgroundColor = "green";
        document.getElementById(id).style.borderWidth = "3px";
        //document.getElementsByClassName("menu")[option].style.backgroundColor = "red";
    } else if (option === "1") {
        document.getElementById(id).style.backgroundColor = "black";
        document.getElementById(id).style.borderWidth = "1px";
        // document.getElementsByClassName("menu")[option].style.backgroundColor = "green";
    } else if (option === "2") {
        document.getElementById(id).style.backgroundColor = "red";
        document.getElementById(id).style.borderWidth = "3px";
        //document.getElementsByClassName("menu")[option].style.backgroundColor = "black";
    }
}
function hideEdit() {
    for (i = 0; i < 6; i++) {
        document.getElementsByClassName("edits")[i].style.visibility = "hidden";
    }
}
function displayEdit(elmnt) {
    document.getElementsByClassName("edits")[elmnt].style.visibility = "visible !important";
}
function opaque() {
    document.getElementById("testimage").style.opacity = "0.3";
    //document.getElementsByClassName("edits")[elmnt].style.opacity = "0.3";
}

