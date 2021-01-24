<script>

function showRecent(str) {
    console.log(str);

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

//        xmlhttp.onreadystatechange = function() {
//            if (this.readyState == 4 && this.status == 200) {
//                var result = JSON.parse(this.response);
//                console.log(result.title);
//            }
//        };
//        xmlhttp.open("GET","https://jsonplaceholder.typicode.com/todos/1");
        
        xmlhttp.open("GET","frameworks.php?date="+str,true);
        xmlhttp.send();
        
    }

    
</script>