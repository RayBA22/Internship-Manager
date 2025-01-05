
    /* Gère les filtres de recherche dans Entreprise.twig et Stagiaire.twig 
    
    permet d'aficher et de cacher les menus de recherche*/
    
    
    
    
    
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

