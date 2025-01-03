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



