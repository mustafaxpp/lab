(function($){

    "use strict";

   $('#tips_form').validate({
       rules:{
           name:{
               required:true
           },
           email:{
               required:true,
               email:true
           },
           phone:{
               required:true
           },
           address:{
               required:true
           },
           gender:{
               required:true
           },
           age:{
               required:true
           },
           age_unit:{
               required:true
           },

       },
       errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
   });

    //change avatar
    $(document).on('change','#avatar',function(){
        var file=document.getElementById('avatar').files[0];
        getBase64(file);
    });

})(jQuery);


function getBase64(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    data=reader.onload = function () {
        $('#patient_avatar').attr('src',reader.result);
        $('#patient_avatar').parent('a').attr('href',reader.result);
    };
    reader.onerror = function (error) {
      console.log('Error: ', error);
    };
}