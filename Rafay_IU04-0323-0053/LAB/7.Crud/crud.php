<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
        input { margin: 5px; padding: 5px; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>
    <h2>CRUD Operations</h2>
    <form id="userForm">
        <input type="hidden" id="id" name="id">
        <input type="text" id="name" name="name" placeholder="Name" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <button type="submit">Save</button>
    </form>
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', loadUsers);
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const action = formData.get('id') ? 'update' : 'create';
            fetch('crud.php', { method: 'POST', body: formData })
                .then(response => response.text())
                .then(() => { loadUsers(); this.reset(); });
        });
        function loadUsers() {
            fetch('crud.php?action=read')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#userTable tbody');
                    tbody.innerHTML = '';
                    data.forEach(user => {
                        tbody.innerHTML += `<tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>
                                <button onclick="editUser(${user.id}, '${user.name}', '${user.email}')">Edit</button>
                                <button onclick="deleteUser(${user.id})">Delete</button>
                            </td>
                        </tr>`;
                    });
                });
        }
        function editUser(id, name, email) {
            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
        }
        function deleteUser(id) {
            if (confirm('Delete?')) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);
                fetch('crud.php', { method: 'POST', body: formData })
                    .then(() => loadUsers());
            }
        }
    </script>
    
</body>
</html>

