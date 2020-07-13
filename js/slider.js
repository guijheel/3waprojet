/**
 *  Initialisation des variable
 */

let slider = document.querySelector('.slider img');
let i = 0;
let time = 30000; // 1000 = 1sec 

const slides =
[
    { image: 'img/slider/1.jpg'}, 
    { image: 'img/slider/2.jpg'}, 
    { image: 'img/slider/3.jpg'},
    { image: 'img/slider/4.jpg'},
    { image: 'img/slider/5.jpg'},
    { image: 'img/slider/6.jpg'}
];

/*

        Fonctions qui affiche les images du slider et qui fait une pause (time) puis les changes

*/

function slide()
{
    if(i == slides.length)
        i = 0
    
    slider.src              =slides[i].image;
    setTimeout(slide,time);
    i++;
}
slide();
