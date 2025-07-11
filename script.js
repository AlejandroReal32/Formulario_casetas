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
    
    // Show the current tab and add active class to the button
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
    
    // If it's the first tab, make sure the first tab button is active
    // if (tabName === 'personal') {
    //     tablinks[0].className += " active";
    // }
}

// Form validation before submission
document.getElementById('multiTabForm').addEventListener('submit', function(e) {
    // You can add additional validation here if needed
    const termsChecked = document.getElementById('terms').checked;
    if (!termsChecked) {
        alert('Accepto que todos los datos son correctos');
        e.preventDefault();
        openTab(e, 'DECA');
        document.getElementById('terms').focus();
    }
    
    // If all validations pass, the form will submit
});