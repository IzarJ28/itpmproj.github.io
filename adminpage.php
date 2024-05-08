<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }
        .sidebar {
            width: 200px;
            padding: 20px;
            background-color: #f2f2f2;
            border-right: 1px solid #ddd;
        }
        .tabs ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        .tabs ul li {
            margin-bottom: 10px;
        }
        .tabs ul li a {
            text-decoration: none;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            display: block;
        }
        .tabs ul li a:hover {
            background-color: #45a049;
        }
        .content {
            flex: 1;
            padding-left: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 5px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="tabs">
                <ul>
                    <li><a class="tab-button" href="#dashboard" onclick="showDashboardTab()">Dashboard</a></li>
                    <li><a class="tab-button" href="#employees" onclick="showEmployeesTab()">Employees</a></li>
                    <li><a class="tab-button" href="#customers" onclick="showCustomersTab()">Customers</a></li>
                    <li><a class="tab-button" href="#transactions" onclick="showTransactionsTab()">Transactions</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <h1>Admin Dashboard</h1>
            <div id="dashboard" class="tab-content">
                <!-- Dashboard content -->
                <h2>Dashboard</h2>
                    <div class="dashboard-stats">
                        <p>Total Employees: <span id="totalEmployees">0</span></p>
                        <p>Total Customers: <span id="totalCustomers">0</span></p>
                        <p>Total Transactions: <span id="totalTransactions">0</span></p>
                        <p>Pending Transactions: <span id="pendingTransactions">0</span></p>
                    </div>
            </div>
            <div id="employees" class="tab-content" style="display: none;">
                <h2>Employees</h2>
                <button id="addEmployeeBtn">Add Employee</button>
                <table id="employeeTable">
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Number</th>
                            <th>Salary</th>
                            <th>Join Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employeeData">
                    </tbody>
                </table>
            </div>
            <div id="customers" class="tab-content" style="display: none;">
                <h2>Customers</h2>
                <button id="addCustomerBtn">Add Customer</button>
                <table id="customerTable">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customerData">
                    </tbody>
                </table>
            </div>
            <div id="transactions" class="tab-content" style="display: none;">
                <h2>Transactions</h2>
                <button id="addTransactionBtn">Add New Transaction</button>
                <div id="transactionTablesContainer">
                    <div id="completed" class="transaction-tab">
                        <table id="pendingTransactionTable">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Employee ID</th>
                                    <th>Weight</th>
                                    <th>Total</th>
                                    <th>Order Date</th>
                                    <th>Finished Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pendingTransactionData">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form id="logoutForm" action="logoutadmin.php" method="POST">
    <button type="submit">Logout</button>
</form>

        </div>
    </div>
    <div id="addEmployeeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addEmployeeModal')">&times;</span>
        <h2>Add Employee</h2>
        <form id="employeeForm" action="add_employee.php" method="POST">
            <!-- Form fields for adding employee -->
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="address" placeholder="Address">
            <input type="text" name="number" placeholder="Number">
            <input type="text" name="salary" placeholder="Salary">
            <input type="date" name="join_date" placeholder="Join Date">
            <input type="date" name="end_date" placeholder="End Date">
            <button type="submit" onclick="submitEmployeeForm()">Submit</button>
        </form>
    </div>
</div>

<div id="addCustomerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addCustomerModal')">&times;</span>
        <h2>Add Customer</h2>
        <form id="customerForm" action="add_customer.php" method="POST">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="address" placeholder="Address">
            <input type="text" name="number" placeholder="Number">
            <button type="submit" onclick="submitCustomerForm()">Submit</button>
        </form>
    </div>
</div>

<div id="addTransactionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addTransactionModal')">&times;</span>
        <h2>Add New Transaction</h2>
        <!-- Form for adding transactions -->
        <form id="transactionForm" action="add_transaction.php" method="POST">
            <!-- Form fields for adding transaction -->
            <!-- Remove action field -->
            <input type="hidden" name="action" value="">

            <!-- Auto-generated Transaction ID -->
            <input type="text" name="total" id="totalInput" placeholder="Total">

            <!-- Select customer and employee -->
            <select name="customer" id="customerSelect" required>
                <option value="" selected disabled>Select Customer</option>
            </select>
            <select name="employee" id="employeeSelect" required>
                <option value="" selected disabled>Select Employee</option>
            </select>

            <input type="number" name="weight" id="weightInput" placeholder="Weight" required>
            <input type="text" name="total" id="totalInput" placeholder="Total" disabled>

            <input type="date" name="order_date" placeholder="Order Date" required>
            <button type="submit" onclick="submitTransactionForm()">Submit</button>
        </form>
    </div>
</div>
    <div id="editTransactionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editTransactionModal')">&times;</span>
            <h2>Edit Transaction</h2>
            <form id="editTransactionForm" action="edit_transaction.php" method="POST">
                <input type="hidden" name="transaction_id" id="editTransactionId">
                <select name="customer" id="editCustomerSelect" required>
                    <option value="" selected disabled>Select Customer</option>

                </select>
                <select name="employee" id="editEmployeeSelect" required>
                    <option value="" selected disabled>Select Employee</option>
                </select>
                <input type="number" name="weight" id="editWeightInput" placeholder="Weight" required>
                <input type="date" name="order_date" id="editOrderDateInput" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function modifyTransaction(transactionId) {
    console.log("Modify button clicked for transaction ID:", transactionId); // Add this line
    fetch(`get_transaction.php?id=${transactionId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch transaction details');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById("editTransactionId").value = data.transaction_id;
            document.getElementById("editCustomerSelect").value = data.customer_id;
            document.getElementById("editEmployeeSelect").value = data.employee_id;
            document.getElementById("editWeightInput").value = data.weight;
            document.getElementById("editOrderDateInput").value = data.order_date;

            openModal("editTransactionModal");
        })
        .catch(error => console.error('Error fetching transaction details:', error));
}



        function fetchEmployeesForDropdown() {
            fetch('employee.php')
                .then(response => response.json())
                .then(data => {
                    const employeeSelect = document.getElementById("employeeSelect");
                    employeeSelect.innerHTML = '<option value="" selected disabled>Select Employee</option>';
                    data.forEach(employee => {
                        const option = document.createElement("option");
                        option.text = employee.name;
                        option.value = employee.id; // Set value to employee ID
                        employeeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching employee data:', error));
        }

        function fetchEmployeeData() {
            fetch('employee.php')
                .then(response => response.json())
                .then(data => updateEmployeeTable(data))
                .catch(error => console.error('Error fetching employee data:', error));
        }

        function fetchCustomerData() {
            fetch('customer.php')
                .then(response => response.json())
                .then(data => updateCustomerTable(data))
                .catch(error => console.error('Error fetching customer data:', error));
        }

        function fetchCustomersForDropdown() {
            fetch('customer.php')
                .then(response => response.json())
                .then(data => {
                    const customerSelect = document.getElementById("customerSelect");
                    customerSelect.innerHTML = '<option value="" selected disabled>Select Customer</option>';
                    data.forEach(customer => {
                        const option = document.createElement("option");
                        option.text = customer.name;
                        option.value = customer.id;
                        customerSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching customer data:', error));
        }
        document.getElementById("addTransactionBtn").addEventListener("click", function () {
            openModal("addTransactionModal");
            fetchEmployeesForDropdown();
            fetchCustomersForDropdown();
        });

        function updateEmployeeTable(employeeData) {
            const employeeTableBody = document.getElementById("employeeData");
            employeeTableBody.innerHTML = ""; // Clear existing data

            employeeData.forEach(employee => {
                const row = `<tr>
                    <td>${employee.id}</td>
                    <td>${employee.name}</td>
                    <td>${employee.address}</td>
                    <td>${employee.number}</td>
                    <td>${employee.salary}</td>
                    <td>${employee.join_date}</td>
                    <td>${employee.end_date}</td>
                    <td>Actions</td>
                </tr>`;
                employeeTableBody.innerHTML += row;
            });
        }

        function updateCustomerTable(customerData) {
            const customerTableBody = document.getElementById("customerData");
            customerTableBody.innerHTML = "";

            customerData.forEach(customer => {
                const row = `<tr>
                    <td>${customer.id}</td>
                    <td>${customer.name}</td>
                    <td>${customer.address}</td>
                    <td>${customer.number}</td>
                    <td>Actions</td>
                </tr>`;
                customerTableBody.innerHTML += row;
            });
        }

        function fetchPendingTransactionData() {
            fetch('transaction.php')
                .then(response => response.json())
                .then(data => updatePendingTransactionTable(data))
                .catch(error => console.error('Error fetching pending transaction data:', error));
        }

        function completeTransaction(transactionId) {
            fetch(`complete_transaction.php?id=${transactionId}`, {
                method: 'POST'
            })
            .then(response => {
                if (response.ok) {
                    alert("Laundry is finished!");
                    fetchPendingTransactionData();
                } else {
                    throw new Error('Failed to complete transaction');
                }
            })
            .catch(error => console.error('Error completing transaction:', error));
        }

        function updatePendingTransactionTable(pendingTransactionData) {
    const pendingTransactionTableBody = document.getElementById("pendingTransactionData");
    pendingTransactionTableBody.innerHTML = "";

    pendingTransactionData.forEach(transaction => {
        const row = `<tr>
            <td>${transaction.customer_id}</td>
            <td>${transaction.employee_id}</td>
            <td>${transaction.weight}</td>
            <td>${transaction.total}</td>
            <td>${transaction.order_date}</td>
            <td>${transaction.finished_date}</td>
            <td>
                <button onclick="completeTransaction(${transaction.transaction_id})">Complete</button>
            </td>
        </tr>`;
        pendingTransactionTableBody.innerHTML += row;
    });
}


        document.getElementById("transactions").addEventListener("click", function () {
            fetchPendingTransactionData();
        });

        function showDashboardTab() {
            hideAllTabs();
            document.getElementById("dashboard").style.display = "block";
        }

        function hideAllTabs() {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.style.display = "none";
            });
        }

        document.getElementById("editTransactionForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    closeModal("editTransactionModal");
                    fetchPendingTransactionData();
                } else {
                    throw new Error('Error submitting form');
                }
            })
            .catch(error => console.error('Form submission error:', error));
        });
        document.getElementById("addEmployeeBtn").addEventListener("click", function () {
            openModal("addEmployeeModal");
        });

        document.getElementById("addCustomerBtn").addEventListener("click", function () {
            openModal("addCustomerModal");
        });

        document.getElementById("addTransactionBtn").addEventListener("click", function () {
            openModal("addTransactionModal");
        });

        document.getElementById("logoutBtn").addEventListener("click", function () {
            console.log("Logging out...");
        });

        document.getElementById("weightInput").addEventListener("input", function () {
            const weight = parseFloat(this.value);
            if (!isNaN(weight)) {
                const total = weight * 40; // Assuming 40 pesos per kg
                document.getElementById("totalInput").value = total.toFixed(2);
            } else {
                document.getElementById("totalInput").value = "";
            }
        });

        showDashboardTab();

        // Function to open a modal
        function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = "block";
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = "none";
    }
        window.addEventListener("click", function (event) {
        const modals = document.getElementsByClassName("modal");
        for (let i = 0; i < modals.length; i++) {
            if (event.target == modals[i]) {
                modals[i].style.display = "none";
            }
        }
    });

        function showEmployeesTab() {
            hideAllTabs();
            document.getElementById("employees").style.display = "block";
            fetchEmployeeData();
        }

        function showCustomersTab() {
            hideAllTabs();
            document.getElementById("customers").style.display = "block";
            fetchCustomerData();
        }

        function showTransactionsTab() {
            hideAllTabs();
            document.getElementById("transactions").style.display = "block";
            updatePendingTransactionTable(pendingTransactions);
            fetchEmployeesForDropdown(); // Fetch employees for dropdown
            fetchPendingTransactionData();
        }

        document.getElementById("transactionForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            // Calculate total based on weight
            const weight = parseFloat(formData.get("weight"));
            const total = weight * 40;
            formData.set("total", total.toFixed(2));


            const currentDate = new Date().toISOString().slice(0, 10);
            formData.set("order_date", currentDate);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.ok) {
                        closeModal("addTransactionModal");
                        fetchPendingTransactionData();
                    } else {
                        throw new Error('Error submitting form');
                    }
                })
                .catch(error => console.error('Form submission error:', error));
        });

        function submitEmployeeForm() {
            document.getElementById("employeeForm").submit();
        }

        function submitCustomerForm() {
            document.getElementById("customerForm").submit();
        }

    function submitTransactionForm() {
        const form = document.getElementById("transactionForm");
        const weight = parseFloat(form.elements["weight"].value);
        const totalInput = form.elements["total"];
        if (!isNaN(weight)) {
            const total = weight * 40;
            totalInput.value = total.toFixed(2);
            form.submit();
        } else {
            console.error("Invalid weight input");
        }
    }

    function fetchDashboardCounts() {
        fetch('dashboard_counts.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById("totalEmployees").innerText = data.totalEmployees;
                document.getElementById("totalCustomers").innerText = data.totalCustomers;
                document.getElementById("totalTransactions").innerText = data.totalTransactions;
            })
            .catch(error => console.error('Error fetching dashboard counts:', error));
        }

    window.addEventListener("load", function () {
        fetchDashboardCounts();
    });
    
    function showDashboardTab() {
        hideAllTabs();
        document.getElementById("dashboard").style.display = "block";
        fetchDashboardCounts();
    }
    </script>


</body>
</html>
