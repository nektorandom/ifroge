function save(form) {
    
    $.ajax({
        type: 'POST',
        url: 'form.php?action='+form,
        data: $('#'+form).serialize(),
        success: function(response){
            $('ul').html(response);
            
            $.ajax({
                type: 'POST',
                url: 'form.php?action=list_option',
                success: function(response){
                    $('select#selectParent').html(response);
                    
                    $.ajax({
                        type: 'POST',
                        url: 'form.php?action=list_option_delete',
                        success: function(response){
                            $('select#deleteName').html(response);
                        }   
                    });
                    
                }   
            });
            
            
        }   
    });
    document.getElementById(form).reset();
    
}

function deleteRec(url, name, id) {
    
    $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'form.php?action=remove_'+url,
            data: { get_name: name, get_id : id },
            success: function(response){
                $('.results').html(response);
                
                $.ajax({
                    type: 'POST',
                    url: 'form.php?action=list_option',
                    success: function(response){
                        $('select#selectParent').html(response);
                    }   
                });
                
                $.ajax({
                    type: 'POST',
                    url: 'form.php?action=list_option_delete',
                    success: function(response){
                        $('select#deleteName').html(response);
                    }   
                });
                
                setTimeout( function() { $('.results').html('') } , 3000 );
                
            },
            error: function (response) {
                $('.results').html('Ошибка при отправке формы');
            }   
        });
    
    
}

