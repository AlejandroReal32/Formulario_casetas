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