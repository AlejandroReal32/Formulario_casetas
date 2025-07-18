// dashboard.js

// Variables globales
let currentSection = 'usuarios';
let users = [];
let records = [];

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    loadUsers();
    loadRecords();
    loadStatistics();
    setupEventListeners();
});

// Event listeners
function setupEventListeners() {
    // Formulario de nuevo usuario
    document.getElementById('newUserForm').addEventListener('submit', handleAddUser);
    
    // Búsqueda de usuarios
    document.getElementById('userSearch').addEventListener('input', filterUsers);
    
    // Búsqueda de registros
    document.getElementById('recordSearch').addEventListener('input', filterRecords);
}

// Navegación entre secciones
function showSection(sectionName) {
    // Ocultar todas las secciones
    document.querySelectorAll('.dashboard-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Remover clase active de todos los botones
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Mostrar sección seleccionada
    document.getElementById(sectionName).classList.add('active');
    
    // Activar botón correspondiente
    event.target.classList.add('active');
    
    currentSection = sectionName;
}

// Modal de agregar usuario
function showAddUserForm() {
    document.getElementById('addUserForm').style.display = 'flex';
}

function hideAddUserForm() {
    document.getElementById('addUserForm').style.display = 'none';
    document.getElementById('newUserForm').reset();
}

// Manejar envío del formulario de nuevo usuario
async function handleAddUser(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const userData = Object.fromEntries(formData);
    
    try {
        const response = await fetch('api/add_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(userData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Usuario agregado exitosamente');
            hideAddUserForm();
            loadUsers(); // Recargar la lista de usuarios
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al agregar usuario');
    }
}

// Cargar usuarios
async function loadUsers() {
    try {
        const response = await fetch('api/get_users.php');
        const data = await response.json();
        
        if (data.success) {
            users = data.users;
            displayUsers(users);
        } else {
            console.error('Error al cargar usuarios:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('usersTable').querySelector('tbody').innerHTML = 
            '<tr><td colspan="7" class="no-data">Error al cargar usuarios</td></tr>';
    }
}

// Mostrar usuarios en la tabla
function displayUsers(usersData) {
    const tbody = document.getElementById('usersTable').querySelector('tbody');
    
    if (usersData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="no-data">No hay usuarios registrados</td></tr>';
        return;
    }
    
    tbody.innerHTML = usersData.map(user => `
        <tr>
            <td>${user.id}</td>
            <td>${user.nombre} ${user.apellido_paterno} ${user.apellido_materno || ''}</td>
            <td>${user.username}</td>
            <td>${user.user_email}</td>
            <td><span class="badge ${user.tipo_usuario === 'administrador' ? 'badge-admin' : 'badge-inspector'}">${user.tipo_usuario}</span></td>
            <td>${formatDate(user.created_at)}</td>
            <td>
                <button class="btn btn-small btn-danger" onclick="deleteUser(${user.id})">Eliminar</button>
            </td>
        </tr>
    `).join('');
}

// Filtrar usuarios
function filterUsers() {
    const searchTerm = document.getElementById('userSearch').value.toLowerCase();
    const filteredUsers = users.filter(user => 
        user.nombre.toLowerCase().includes(searchTerm) ||
        user.apellido_paterno.toLowerCase().includes(searchTerm) ||
        user.username.toLowerCase().includes(searchTerm) ||
        user.user_email.toLowerCase().includes(searchTerm)
    );
    displayUsers(filteredUsers);
}

// Eliminar usuario
async function deleteUser(userId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
        return;
    }
    
    try {
        const response = await fetch('api/delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: userId })
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Usuario eliminado exitosamente');
            loadUsers(); // Recargar la lista de usuarios
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al eliminar usuario');
    }
}

// Cargar registros
async function loadRecords() {
    try {
        const response = await fetch('api/get_records.php');
        const data = await response.json();
        
        if (data.success) {
            records = data.records;
            displayRecords(records);
        } else {
            console.error('Error al cargar registros:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('recordsTable').querySelector('tbody').innerHTML = 
            '<tr><td colspan="7" class="no-data">Error al cargar registros</td></tr>';
    }
}

// Mostrar registros en la tabla
function displayRecords(recordsData) {
    const tbody = document.getElementById('recordsTable').querySelector('tbody');
    
    if (recordsData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="no-data">No hay registros disponibles</td></tr>';
        return;
    }
    
    tbody.innerHTML = recordsData.map(record => `
        <tr>
            <td>${record.id}</td>
            <td>${formatDate(record.fecha)}</td>
            <td>${record.sitio}</td>
            <td>${record.mercancia}</td>
            <td>${record.estadoOrigen}</td>
            <td>${record.estadoDestino}</td>
            <td>
                <button class="btn btn-small btn-primary" onclick="viewRecord(${record.id})">Ver</button>
                <button class="btn btn-small btn-danger" onclick="deleteRecord(${record.id})">Eliminar</button>
            </td>
        </tr>
    `).join('');
}

// Filtrar registros
function filterRecords() {
    const searchTerm = document.getElementById('recordSearch').value.toLowerCase();
    const filteredRecords = records.filter(record => 
        record.sitio.toLowerCase().includes(searchTerm) ||
        record.mercancia.toLowerCase().includes(searchTerm) ||
        record.estadoOrigen.toLowerCase().includes(searchTerm) ||
        record.estadoDestino.toLowerCase().includes(searchTerm)
    );
    displayRecords(filteredRecords);
}

// Ver detalles de un registro
function viewRecord(recordId) {
    // Aquí podrías abrir un modal con los detalles completos del registro
    alert(`Ver detalles del registro ${recordId}`);
}

// Eliminar registro
async function deleteRecord(recordId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este registro?')) {
        return;
    }
    
    try {
        const response = await fetch('api/delete_record.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: recordId })
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Registro eliminado exitosamente');
            loadRecords(); // Recargar la lista de registros
            loadStatistics(); // Actualizar estadísticas
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al eliminar registro');
    }
}

// Cargar estadísticas
async function loadStatistics() {
    try {
        const response = await fetch('api/get_statistics.php');
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('totalUsers').textContent = data.stats.totalUsers;
            document.getElementById('recordsToday').textContent = data.stats.recordsToday;
            document.getElementById('recordsMonth').textContent = data.stats.recordsMonth;
            document.getElementById('totalRecords').textContent = data.stats.totalRecords;
        } else {
            console.error('Error al cargar estadísticas:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        // Mostrar valores por defecto en caso de error
        document.getElementById('totalUsers').textContent = '0';
        document.getElementById('recordsToday').textContent = '0';
        document.getElementById('recordsMonth').textContent = '0';
        document.getElementById('totalRecords').textContent = '0';
    }
}

// Utilidades
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Cerrar modal al hacer clic fuera de él
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('form-modal')) {
        hideAddUserForm();
    }
});

// Manejo de tecla Escape para cerrar modales
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideAddUserForm();
    }
});