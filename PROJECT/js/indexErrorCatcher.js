



$('document').ready(function(){
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable)
               {
                  
                   return pair[1];
                   
               }
       }
       return(false);
       
}
var errors = ['username_error','password_error','password_again_error','country_error'];
var type ='';

for(var i=0; i<errors.length;i++){
    type=getQueryVariable(errors[i]);
    switch(type){
        case'false':
            break;
        case 'reqerror':
            $('#'+errors[i]).append('Input is Required');    
            break;
        case 'minerror':
            $('#'+errors[i]).append('Input Too Short');
            break;
        case 'maxerror':
            $('#'+errors[i]).append('Input Too Long');
            break;
        case 'matcherror':
            $('#'+errors[i]).append('Passwords Must Match');
           // $('#password_again_error').append('Passwords Must Match');
            break;
        case 'exsisterror':
            $('#'+errors[i]).append('Username is Taken');
            break;
        case 'wspace':
            $('#'+errors[i]).append('Input Contains Blank Space');
    }
}




   
   
   
   });