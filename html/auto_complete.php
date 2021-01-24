
    
<script>
function showLocation(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        var resultText = xmlhttp.responseText;
        document.getElementById("txtHint2").innerHTML = "";
//        xmlhttp.onreadystatechange = function() {
//            if (this.readyState == 4 && this.status == 200) {
//                var result = JSON.parse(this.response);
//                console.log(result.title);
//            }
//        };
//        xmlhttp.open("GET","https://jsonplaceholder.typicode.com/todos/1");
        
        xmlhttp.open("GET","frameworks.php?q="+str,true);
        xmlhttp.send();
        
    }
}
    
function showSecondaryLocation(str2) {
    if (str2 == "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","frameworks.php?r="+str2,true);
        console.log("123123123123")
        xmlhttp.send();
    }
}    

</script>