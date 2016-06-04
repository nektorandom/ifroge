function errorMessage( elem, msg, place, o_left, o_top ) {
    o_left = o_left || 3;
    o_top = o_top || 23;
    $('.errorMessage').remove();
    $('<div class="errorMessage a_bottom">' + msg + '</div>').appendTo(place).css({
        'left' : $(elem).position().left + o_left,
        'top' : $(elem).position().top + o_top,
    })
    return false;
}

$(function(){
    
    $("#button1").click(function(){
        
        $('.popup').fadeToggle().toggleClass('.popup--visible');
        if($('.popup--visible')) {
        $('html').addClass('htmlhidden');
        
        $('#formHide').attr('style', 'display:block;');
        
        } else {
        $('html').removeClass('htmlhidden');
        }
        return false;
          
    })
    
    $('.js-popup-close').click(function() {
      $('.popup').fadeToggle().toggleClass('.popup--visible');
      $('html').toggleClass('htmlhidden');
      return false;
    });
    
    $('.btnform').on('click', function() {
        
        var name_val = $(this).parent().find('input[name="name"]').val();
        
        if ( name_val == '') {
            errorMessage( $(this).parent().find('input[name="name"]'), 'Введите имя', $(this).parent() );
            return false;
        }
        
    })
    
    //add field
    $('.add').on('click', function(){
        
        var inputHiddenID = $(this).parent().find('input[type="hidden"]').attr('id');
        var formId = $(this).parent().attr('id');
        
        $('#' + inputHiddenID).attr('type', 'text');
        
        if ( formId == 'form_id3') {
            $(this).parent().find('select').attr('style', 'display: inline;');
        }
        
    })
    
    $('input[name="name"]').on('focus', function(){
        $('.errorMessage').remove();
    })
    
    $('select').on('focus', function(){
        $('.errorMessage').remove();
    })
    
    $('input[type="button"]').on('focus', function(){
        $('.errorMessage').remove();
    })
    
    
    //save
    $('.save').on('click', function(){
        
        var form_id = $(this).parent().attr('id');
        var input_type = $(this).parent().find('input[name="name"]').attr('type');
        var name_val = $(this).parent().find('input[name="name"]').val();
       
        if ( input_type == 'hidden') {
            errorMessage( $(this).parent().find('input[class="add"]'), 'Нажмите на кнопку добавить', $(this).parent(), 3, 35 );
        }
        else if ( name_val == '') {
            errorMessage( $(this).parent().find('input[name="name"]'), 'Введите имя', $(this).parent() );
        }
        else if ( form_id == 'form_id3' ) {
            var select = document.getElementById('selectParent');
            var select_val = select.selectedIndex;
            
            if ( select_val == 0) {
                errorMessage( $(this).parent().find('select'), 'Выберите родителя', $(this).parent() );
            }
            else {
                save(form_id);
            }
        }
        else {
            save(form_id);
        }
        
    })
    
    //delete
    
    $('body').on('click', '.remove', function(){
        
        var relation = $(this).data('relation');
        
        var removeName = $(this).parent().find('span').html();
        var removeID = $(this).data('id');
        
        var listOptionName = $('option');
        
        deleteRec(relation, removeName, removeID);
        
        var deleteName = $(this).parent();
        
        if (relation == 'parent') {
            var deleteChild = $('ul').find('li[data-parentid="' + removeID + '"]');
            $(deleteChild).remove();
        }
        
        $(deleteName).hide('slow', function(){
            $(deleteName).remove();
        });
        
        
        
    })
    
    $('body').on('change', 'select#deleteName', function(){
        
        var selectOption = $(this.options [this.selectedIndex]);
        var selectInd = this.selectedIndex;
        
        var selectName = selectOption.data('name');
        var selectRelation = selectOption.data('relation');
        var selectId = selectOption.data('id');
        
        if (selectName !== 'Выберите имя для удаления') {
            
            deleteRec(selectRelation, selectName, selectId);
            
            var deleteName = $('ul').find('input[data-id="' + selectId + '"]').parent();
            
            if (selectRelation == 'parent') {
                var deleteChild = $('ul').find('li[data-parentid="' + selectId + '"]');
                $(deleteChild).remove();
            }
            
            $(deleteName).hide('slow', function(){
                $(deleteName).remove();
            });
            
            
        }
        
    })


})
