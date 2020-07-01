function showResult(searching) {
    if (searching.length < 3) {
        document.getElementById("livesearch").style.border="0px";
        document.getElementById("txtHint").innerHTML="Enter a term to search";
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("livesearch").innerHTML=this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
        };
        xmlhttp.open("GET", "livesearch.php?q=" + searching, true);
        xmlhttp.send();
    }
}
function noenter() {
    return !(window.event && window.event.keyCode === 13);
}