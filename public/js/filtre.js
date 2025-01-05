
    document.getElementById('toggle-form-button').addEventListener('click', function() {
        const formContainer = document.getElementById('company-form-container');
        if (formContainer.style.display === 'none' || formContainer.style.display === '') {
            formContainer.style.display = 'block';
            this.textContent = 'cacher'; 
        } else {
            formContainer.style.display = 'none';
            this.textContent = 'afficher'; 
        }
    });

