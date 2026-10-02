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

const showEmployee = (name, role) => {
    console.log(`Employee: ${name} | Role: ${role}`);
};

showEmployee("Rahul Sharma", "Frontend Developer");
showEmployee("Priya Singh", "UI/UX Designer");


const employee = {
    name: "Rahul Sharma",
    role: "Frontend Developer",
    department: "IT"
};

const { name, role, department } = employee;

console.log(name);
console.log(role);
console.log(department);

// ES6 Spread Operator

const employee1 = {
    name: "Rahul Sharma",
    role: "Frontend Developer"
};

const employee2 = {
    department: "IT"
};

const completeEmployee = {
    ...employee1,
    ...employee2
};

console.log(completeEmployee);


const employees = [
    {
        name: "Rahul Sharma",
        role: "Frontend Developer"
    },
    {
        name: "Priya Singh",
        role: "UI/UX Designer"
    }
];

employees.map((employee) => {
    console.log(`${employee.name} - ${employee.role}`);
});