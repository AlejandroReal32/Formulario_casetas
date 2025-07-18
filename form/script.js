function openTab(evt, tabName) {
    // Hide all tab content
    const tabcontent = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    // Remove active class from all tab buttons
    const tablinks = document.getElementsByClassName("tablinks");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Show the current tab
    document.getElementById(tabName).style.display = "block";
    // Always activate the correct tab button
    const btn = document.querySelector('.tab button[onclick*="' + tabName + '"]');
    if(btn) btn.className += " active";
}

// Form validation before submission
document.getElementById('multiTabForm').addEventListener('submit', function(e) {
    // You can add additional validation here if needed
    const termsChecked = document.getElementById('terms').checked;
    if (!termsChecked) {
        alert('Accepto que todos los datos son correctos');
        e.preventDefault();
        openTab(e, 'deca');
        document.getElementById('terms').focus();
    }
    
    // If all validations pass, the form will submit
});

// Convierte a mayúsculas automáticamente al escribir en inputs y textareas
window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[type="text"], textarea').forEach(function(el) {
        el.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
});

// Calcular el total basado en cantidad y peso
document.getElementById('cantidad').addEventListener('input', calcularTotal);
document.getElementById('peso').addEventListener('input', calcularTotal);

function calcularTotal() {
    const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
    const peso = parseFloat(document.getElementById('peso').value) || 0;
    document.getElementById('cantidad_total').value = cantidad * peso;
}


// Validate section and move to next tab
function validateSectionAndNext(btn) {
    // Encuentra la sección/tab actual
    const section = btn.closest('.tabcontent');
    // Busca todos los campos requeridos visibles en la sección
    const requiredFields = section.querySelectorAll('input[required], select[required], textarea[required]');
    let valid = true;
    requiredFields.forEach(field => {
        if (!field.value) {
            field.classList.add('input-error');
            valid = false;
        } else {
            field.classList.remove('input-error');
        }
    });
    if (!valid) {
        alert('Por favor, completa todos los campos obligatorios antes de continuar.');
        return;
    }
    // Si todo está bien, avanza a la siguiente sección
    const nextTab = btn.getAttribute('data-next');
    if (nextTab === 'confirmar') {
        displayConfirmationData();
    }
    openTab(event, nextTab);
}

// Display confirmation data in the confirmation tab
function displayConfirmationData() {
    const form = document.getElementById('multiTabForm');
    const data = new FormData(form);
    const confirmationDiv = document.getElementById('confirmation-data');
    let html = '<table>';
    for (const [key, value] of data.entries()) {
        const label = form.querySelector(`label[for="${key}"]`);
        const labelText = label ? label.textContent : key;
        html += `<tr><td><strong>${labelText}:</strong></td><td>${value}</td></tr>`;
    }
    html += '</table>';
    confirmationDiv.innerHTML = html;
}

// Clear form function
document.getElementById('clearFormBtn').addEventListener('click', function() {
    if (confirm('¿Estás seguro de que quieres limpiar todos los campos del formulario?')) {
        document.getElementById('multiTabForm').reset();
        // Reset to the first tab
        openTab(event, 'sitio_inspeccion');
        // Clear any error messages
        document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
    }
});