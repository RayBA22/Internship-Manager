/* gère l'ouverture et la fermeture de la barre de navigation 
 et l'indicateur en bleu de l'option sélectionnée  (Développer ou réduire)*/





const sidebar = document.getElementById('navBar');
const developBtn = document.getElementById('develop-btn');
const reduceBtn = document.getElementById('reduce-btn');


reduceBtn.addEventListener('click', () => {
    sidebar.classList.add('collapsed'); 
    reduceBtn.classList.add('active'); 
    developBtn.classList.remove('active'); 
});


developBtn.addEventListener('click', () => {
    sidebar.classList.remove('collapsed'); 
    developBtn.classList.add('active'); 
    reduceBtn.classList.remove('active'); 
    
});



