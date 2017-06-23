<html>
<head>

<script>
function callAjax(str) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "ajax.php?q=" + str, true);
        xmlhttp.send();
    }
</script>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form>
First name: <input type="text" onkeyup="callAjax(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
</body>
</html>
