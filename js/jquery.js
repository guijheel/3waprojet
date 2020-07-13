

/****
 * 
 *  Jquery
 *  Qui permet a chaque clique d'un utilisateur de changer d'étoile 
 *
  */

 $(document).ready(function(){
let notation = 0;

 $('#1').on('click',function(){
  let  notation = 1;
   $('.fa-star').css('color','white');
   $('#1').css('color','#01233F');
 });

 $('#2').on('click',function(){
  let  notation = 2;
  $('.fa-star').css('color','white');
  $('#1,#2').css('color','#01233F');
});

 $('#3').on('click',function(){
  let  notation = 3;
  $('.fa-star').css('color','white');
  $('#1,#2,#3').css('color','#01233F');
});

 $('#4').on('click',function(){
  var  notation = 4;
  $('.fa-star').css('color','white');
  $('#1,#2,#3,#4').css('color','#01233F');
});
 $('#5').on('click',function(){
  let notation = 5;
  $('.fa-star').css('color','white');
  $('.fa-star').css('color','#01233F');
});
});