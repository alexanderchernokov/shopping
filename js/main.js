/**
 * Created by Alex.Chernokov on 02/11/2016.
 */
$(document).ready(function(){
    $(document).on("click",".db_submit",function(e){
        e.preventDefault();
                var form_id = '#db_form';
                form_data = $(form_id).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'install.php',
                    enctype: 'multipart/form-data',
                    data: form_data,
                    success:function(msg) {
                        $("#results").html(msg);
                        
                        return false;
                    },
                    error:function(){
                        alert('Whoops! This didn\'t work. Please contact us.');
                    }
                });
                return false;



    });
});
