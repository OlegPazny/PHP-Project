// авторизация
$('.login-btn').click(function(e){
    e.preventDefault();//не обновляет страницу при клике(отключение стандартного поведения)

    $(`input`).removeClass('error');//очищение инпутов от класса error

    let login=$('input[name="login"]').val();
    let password=$('input[name="password"]').val();

    $.ajax({
        url:'script/signin.php',
        type:'POST',
        dataType:'json',
        data:{
            login:login,
            password:password,
        },
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

//регистрация
$('.register-btn').click(function(e){
    e.preventDefault();//не обновляет страницу при клике(отключение стандартного поведения)

    $(`input`).removeClass('error');//очищение инпутов от класса error

    let name=$('input[name="name"]').val();
    let login=$('input[name="login"]').val();
    let password=$('input[name="password"]').val();
    let email=$('input[name="email"]').val();
    let number=$('input[name="number"]').val();
    let password_confirm=$('input[name="password_confirm"]').val();
    
    let formData=new FormData();
    formData.append('name', name);
    formData.append('login', login);
    formData.append('email', email);
    formData.append('number', number);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);

    $.ajax({
        url:'script/signup.php',
        type:'POST',
        dataType:'json',
        data:formData,
        processData: false,
        contentType:false,
        cache:false,

        success:function(data){
            if(data.status){
                document.location.href='/auth.php';
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

let img=false;
//получение изображения
$('input[name="img"]').change(function(e){
    img=e.target.files[0];
    console.log(img);
});
//добавление автомобиля
$('.submit-btn').click(function(e){
    e.preventDefault();//не обновляет страницу при клике(отключение стандартного поведения)

    $(`input`).removeClass('error');//очищение инпутов от класса error

    let brand=$('select[name="brand"]').val();
    let model=$('select[name="model"]').val();
    let year=$('input[name="year"]').val();
    let price=$('input[name="price"]').val();
    let body=$('select[name="body"]').val();
    let color=$('select[name="color"]').val();
    let engine=$('select[name="engine"]').val();
    let gearbox=$('select[name="gearbox"]').val();
    let run=$('input[name="run"]').val();
    let city=$('input[name="city"]').val();
    let description=$('textarea[name="description"]').val();
    
    let formData=new FormData();
    formData.append('brand', brand);
    formData.append('model', model);
    formData.append('year', year);
    formData.append('price', price);
    formData.append('body', body);
    formData.append('color', color);
    formData.append('img', img);
    formData.append('engine', engine);
    formData.append('gearbox', gearbox);
    formData.append('run', run);
    formData.append('city', city);
    formData.append('description', description);

    $.ajax({
        url:'script/addcar.php',
        type:'POST',
        dataType:'json',
        processData: false,
        contentType:false,
        cache:false,
        data:formData,
        
        success:function(data){
            if(data.status){
                console.log('успешно');
                document.location.href='/account.php';
            }else{
                if(data.type===1){
                    console.log('косяк');
                    data.fields.forEach(function(field){
                        $(`input[name="${field}"]`).addClass('error');
                        $(`select[name="${field}"]`).addClass('error');
                    });
                }
                $('.message').removeClass('none').text(data.message);
            }
        }
    })
});

// фильтрация
$('.filter-btn').click(function(e){
    e.preventDefault();//не обновляет страницу при клике(отключение стандартного поведения)

    $(`input`).removeClass('error');//очищение инпутов от класса error

    // let brand=$('select[name="brand"]').val;
    // let model=$('select[name="model-menu"]').val;
    let year_from=$('input[name="year_from"]').val();
    let year_to=$('input[name="year_to"]').val();
    let price_from=$('input[name="price_from"]').val();
    let price_to=$('input[name="price_to"]').val();
    // let body=$('select[name="body"]').val;
    // let color=$('select[name="color"]').val;
    // let engine=$('select[name="engine"]').val;
    // let gearbox=$('select[name="gearbox"]').val;
    let run_from=$('input[name="run_from"]').val();
    let run_to=$('input[name="run_to"]').val();

    $.ajax({
        url:'script/filter-validation.php',
        type:'POST',
        dataType:'json',
        data:{
            // brand:brand,
            // model:model,
            year_from:year_from,
            year_to:year_to,
            price_from:price_from,
            price_to:price_to,
            // body:body,
            // color:color,
            // engine:engine,
            // gearbox:gearbox,
            run_from:run_from,
            run_to:run_to,

        },
        success:function(data){
            if(data.status){
                console.log('норм');
                document.location.href="/search_results.php"
            }else{
                if(data.type===1){
                    console.log('жопа');
                    data.fields.forEach(function(field){
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.message').removeClass('none').text(data.message);
            }
        }
    });
    //return false;
});