/*console.log('hello world'); para probar*/
//Varibales
const btnmenu = document.querySelector('#btnmenu');
const body = document.querySelector('body');
const header = document.querySelector('.header');
const overlay = document.querySelector('.overlay');
const fadeElems = document.querySelectorAll('.faded');

// codigo para crear la animacion del boton menu en modo celular
btnmenu.addEventListener('click', function(){
    console.log('it works');
    
    if(header.classList.contains('open')){ // si se oprime el btn menu sucede la animacion
        body.classList.remove('noscroll');
        header.classList.remove('open');//cierra el menu
        fadeElems.forEach(function(element){
            element.classList.remove('fade-in');
            element.classList.add('fade-out');
        });        
    }
    else{//abre el menu
        //body.classList.add('noscroll');
        header.classList.add('open');
        fadeElems.forEach(function(element){
            element.classList.remove('fade-out');
            element.classList.add('fade-in');
        });
    }
});
