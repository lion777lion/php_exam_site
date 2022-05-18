document.addEventListener('DOMContentLoaded', () => {
    var request = new XMLHttpRequest();
    const app = document.getElementById('students');
    var json
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
                console.log(student);
            });

        }
    };
    request.send();
});