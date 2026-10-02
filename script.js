let companyName = "Employee Management System";
let totalEmployees = 2;

console.log(companyName);
console.log("Total Employees:", totalEmployees);

const heading = document.getElementById("employee-heading");

console.log(heading);

heading.textContent = "Our Employees";

const profileBtn = document.getElementById("profileBtn");

profileBtn.addEventListener("click", function (event) {
    event.preventDefault();
    alert("Employee Profile Opened!");
});
const profileBtn2 = document.getElementById("profileBtn2");

profileBtn2.addEventListener("click", function (event) {
    event.preventDefault();
    alert("Employee 2 Profile Opened!");
});