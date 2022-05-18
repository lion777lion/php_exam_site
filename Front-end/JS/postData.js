function CheckData() {
    var data = new FormData(document.querySelector('form'));
    var request = new XMLHttpRequest();
    console.log(...data);
    request.open('POST', 'http://localhost:3000/Back-end/index.php', true)
    request.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
    request.onreadystatechange = function() { //Call a function when the state changes.
        if (request.readyState == 4 && request.status == 200) {
            alert(request.responseText);
        }
    }
    request.send(data);

}

function submit() {
    window.location.href = "http://www.eek.ee";
}

function checkStrings(name) {
    if (name != "") {
        return true;
    } else {
        document.getElementById('nameReq').innerHTML = "Please enter your name";
        return false;
    }
}

function checkIsikucod(isikucod) {
    if (isikucod != "") {
        if (isNaN(isikucod)) {
            document.getElementById('telReq').innerHTML = "Please enter valid number or left this field empty";
            return false;
        }
    }
}

function checkEmail(mail) {
    if (mail != "") {
        var mailPattern = /\S+@\S+\.\S+/;
        if (mailPattern.test(mail)) {
            return true;
        } else {
            document.getElementById('emReq').innerHTML = "Please enter valid email address!";
            return false;
        }
    } else {
        document.getElementById('emReq').innerHTML = "Please enter valid email address!";
        return false;
    }
}