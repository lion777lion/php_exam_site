document.addEventListener('DOMContentLoaded', () => {
    var request = new XMLHttpRequest();
    const app = document.getElementById('students');
    request.open('GET', 'http://localhost:3000/Back-end/index.php', true)
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            json = JSON.parse(request.responseText);
            json.forEach(student => {
                var tr = document.createElement("tr");
                tr.innerHTML = "<td>" + student.isikucod + "</td>" +
                    "<td>" + student.surname + "</td>" +
                    "<td>" + student.fname + "</td>" +
                    "<td>" + student.grade + "</td>" +
                    "<td>" + student.email + "</td>" +
                    "<td>" + student.message + "</td>";
                app.appendChild(tr);
            });

        }
    };
    request.send();
});

function deleteStudent() {
    forDelete = document.getElementById("delete")
    var request = new XMLHttpRequest();
    url = 'http://localhost:3000/Back-end/index.php';
    request.open('DELETE', url + "/" + forDelete.value, true);
    request.onreadystatechange = function() {
        if (request.status == 200) {
            if (alert('Succsess')) {} else { window.location.reload(); }
        } else {
            alert("Something go wrong:(");
        }
    }
    request.send();
}

function searchStudent() {
    search = document.getElementById("search");
    const app = document.getElementById('students');
    app.innerHTML = "";
    var request = new XMLHttpRequest();
    url = 'http://localhost:3000/Back-end/index.php';
    request.open('GET', url + "/" + search.value, true);
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            json = JSON.parse(request.responseText);
            json.forEach(student => {
                var tr = document.createElement("tr");
                tr.innerHTML = "<td>" + student.isikucod + "</td>" +
                    "<td>" + student.surname + "</td>" +
                    "<td>" + student.fname + "</td>" +
                    "<td>" + student.grade + "</td>" +
                    "<td>" + student.email + "</td>" +
                    "<td>" + student.message + "</td>";
                app.appendChild(tr);
            });

        }
    };
    request.send();
}