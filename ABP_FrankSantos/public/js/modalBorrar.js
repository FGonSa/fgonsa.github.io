
let botonesBorrar = document.querySelectorAll('.btn-eliminar')
let modalFormCurso=document.getElementById('modalFormCurso')
let bodyModal=document.getElementById('bodyModal');

if(botonesBorrar){
    botonesBorrar.forEach(botonBorrar => {
        botonBorrar.addEventListener('click', ()=> {
            bodyModal.textContent ='¿Seguro que deseas eliminar el curso '+botonBorrar.dataset.sigla+'?'
            modalFormCurso.action= botonBorrar.dataset.action
        })
    });
}
