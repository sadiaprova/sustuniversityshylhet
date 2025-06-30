function loginCampus() {
    const id = document.getElementById("studentId").value;
    localStorage.setItem("campusStudentId", id);
    window.location.href = "dashboard.html";
}

function loadCampusData() {
    const id = localStorage.getItem("campusStudentId");
    document.getElementById("studentIdDisplay").innerText = id;

    fetch("data.json")
        .then(response => response.json())
        .then(data => {
            const student = data.students[id];
            if (student) {
                document.getElementById("hostelRoom").innerText = student.hostelRoom;

                const menu = data.canteenMenu;
                const menuList = document.getElementById("canteenMenu");
                menu.forEach(item => {
                    const li = document.createElement("li");
                    li.innerHTML = '<input type="checkbox" value="' + item + '"> ' + item;
                    menuList.appendChild(li);
                });
            } else {
                alert("Student not found!");
            }
        });
}

function placeOrder() {
    const checkboxes = document.querySelectorAll("#canteenMenu input[type='checkbox']");
    const selected = [];
    checkboxes.forEach(cb => {
        if (cb.checked) selected.push(cb.value);
    });
    const msg = selected.length ? "Order placed: " + selected.join(", ") : "No items selected.";
    document.getElementById("orderMessage").innerText = msg;
}