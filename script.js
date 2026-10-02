let companyName = "Employee Management System";
let totalEmployees = 2;

console.log(companyName);
console.log("Total Employees:", totalEmployees);

const heading = document.getElementById("employee-heading");

console.log(heading);

if (heading) {
    heading.textContent = "Our Employees";
}

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

const {
    name,
    role,
    department
} = employee;

console.log(name);
console.log(role);
console.log(department);


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


const employeeForm = document.getElementById("employeeForm");

if (employeeForm) {

    employeeForm.addEventListener("submit", function (event) {


        event.preventDefault();

        const employeeName =
            document.getElementById("employeeName").value.trim();

        const employeeEmail =
            document.getElementById("employeeEmail").value.trim();

        const employeeRole =
            document.getElementById("employeeRole").value.trim();


        if (
    employeeName === "" ||
    employeeEmail === "" ||
    employeeRole === ""
) {
    alert("Please fill all fields.");
    return;
}

const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (!emailPattern.test(employeeEmail)) {
    alert("Please enter a valid email address.");
    return;
}

alert("Employee added successfully!");

employeeForm.reset();
    });
}