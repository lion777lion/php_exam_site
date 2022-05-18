function CheckData() {
    var isikucod = document.getElementById('isikucod');
    var fname = document.getElementById('fname');
    var surname = document.getElementById('surname');
    var email = document.getElementById('email');
    var grade = document.getElementById('grade');
    var message = document.getElementById('message');

    if (checkFname(fname.value) && checkSurname(surname.value) && checkEmail(email.value) && checkGrade(grade.value) && checkIsikucod(isikucod.value)) {
        submit(isikucod.value, fname.value, surname.value, email.value, grade.value, message.value)
    }
}

function submit(isikucod, fname, surname, email, grade, message) {
    request = new XMLHttpRequest();
    data = JSON.stringify({
        "isikucod": isikucod,
        "fname": fname,
        "surname": surname,
        "email": email,
        "grade": grade,
        "message": message
    })
    request.open('POST', 'http://localhost:3000/Back-end/index.php', true)
    request.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            alert(fname + " " + surname + " " + "successfully added!");
            window.location.href = 'index.html';
        } else {
            alert("Something wrong:("));
    }
}
request.send(data);
}


function checkFname(fname) {
    if (fname != "") {
        return true;
    } else {
        document.getElementById('fnameReq').innerHTML = "Please enter your name";
        return false;
    }
}

function checkSurname(surname) {
    if (surname != "") {
        return true;
    } else {
        document.getElementById('surnameReq').innerHTML = "Please enter your name";
        return false;
    }
}

function checkIsikucod(isikucod) {
    if (isikucod != "") {
        if (isNaN(isikucod)) {
            document.getElementById('isikucodReq').innerHTML = "Dont use letters, numbers only!";
            return false;
        } else if (isikucod.length > 8 || isikucod.length < 8) {
            document.getElementById('isikucodReq').innerHTML = "Not right format!";
        } else {
            return true;
        }
    }
}

function checkEmail(mail) {
    if (mail != null) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
            return true;
        } else {
            document.getElementById('emailReq').innerHTML = "Please enter valid email address!";
            return false;
        }
    } else {
        document.getElementById('emailReq').innerHTML = "Email is requered!";
        return false;
    }
}

function checkGrade(grade) {
    if (isNaN(grade)) {
        document.getElementById('gradeReq').innerHTML = "Enter valid grade";
        return false;
    } else if (grade > 6 || grade.length > 1) {
        document.getElementById('gradeReq').innerHTML = "Enter valid grade";
        return false;
    } else {
        return true;
    }
}