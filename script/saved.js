$('.save').click(function(e){
    e.preventDefault();//не обновляет страницу при клике(отключение стандартного поведения)

    $.ajax({
        url:'script/save_post.php',
        type:'POST',
        dataType:'json',

        success:function(data){
            if(data.status){
                if(data.isAdmin){
                    document.location.href='/admin.php';
                }else if(!data.isAdmin){
                    document.location.href='/account.php';
                }
            }else{
                if(data.type===1){
                    data.fields.forEach(function(field){
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.message').removeClass('none').text(data.message);
            }
        }
    })
});