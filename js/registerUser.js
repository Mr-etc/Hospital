const url = '/user/api';
var lines = null,items = null,choose_time = null, choose_day = null;
function initialize(){
    $("#SNILS-user").mask("999-999-999 99");
    $("#Phone-user").mask("8 (999) 999-99-99");
    $(".input-block.with_title input").on("focus", (e)=>{
        let input = $(e.target);
        let parent = input.parent();
        input.siblings("label").removeClass("fill-label");
        if(parent.hasClass("error"))
            parent.removeClass("error");
    });
    $(".input-block.with_title input").on("blur", (e)=>{
        let input = $(e.target);
        if(input.val() == "")
            input.siblings("label").addClass("fill-label");
    });
    $(".section-register_body .Button").on("click", (e)=>{
        let inputs = $(".section-register_body .input-block > input");
        let errors = checkFields(inputs);
        if(errors.length == 0)
        {
            Send();
            return;
        }
        else
            for(let key in errors)
                $(inputs[errors[key]]).parent().addClass("error");
        CreateNotify("Регистрация", "Не все поля заполнены корректно");
    });
}
function checkFields(fields){
    let errors = [];
    for(let i = 0; i < fields.length; i++)
    {
        if(fields[i].value != "")
            switch (fields[i].id) {
                case "Surname-user":
                    if(!(/^[A-Za-zА-Яа-я]+$/.test(fields[i].value)))
                        errors.push(i);
                    break;
                case "Name-user":
                    if(!(/^[A-Za-zА-Яа-я]+$/.test(fields[i].value)))
                        errors.push(i);
                    break;
                case "Lastname-user":
                    if(!(/^[A-Za-zА-Яа-я]+$/.test(fields[i].value)))
                        errors.push(i);
                    break;
                case "Mail-user":
                    if(!(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(fields[i].value)))
                        errors.push(i);
                    break;      
            }
        else
            errors.push(i);
    }
    return errors;
}
function Send(){
    let fields = [];
    fields.push($("#Surname-user").val());
    fields.push($("#Name-user").val());
    fields.push($("#Lastname-user").val());
    fields.push($("#Birthdate-user").val());
    fields.push($(".input-block .radio input:checked").val());
    fields.push($("#SNILS-user").val());
    fields.push($("#Mail-user").val());
    let phone = /^.+(\d{3}).+(\d{3}).+(\d{2}).+(\d{2})$/.exec($("#Phone-user").val());
    phone.shift(1);
    fields.push(phone.join(''));
    fields.push($("#Pass-user").val());
    query = `query_type=registrationAccount&surname=${fields[0]}&name=${fields[1]}&lastname=${fields[2]}
    &birthdate=${fields[3]}&sex=${fields[4]}&mail=${fields[6]}&phone=${fields[7]}&snils=${fields[5]}&pass=${fields[8]}`;
    $.ajax({
        type: 'POST',
        url: url,
        data: query,
        cache: false,
        beforeSend: ()=>{
            $(".section-register_body > .wait_wrap").addClass("show");
            $(".section-register_body > .wait_wrap svg").addClass("spinner");
        },
        statusCode: {
            200:(data)=>{
                data = JSON.parse(data);
                switch(data['type']){
                    case "notify":
                        CreateNotify(data['data']['header'], data['data']['message']);
                        break;
                    case "register":
                        ResponseRegister(data);
                        break;
                }
            },
            404:()=>{
                CreateNotify("Ошибка", "Страница не найдена");
            }
        },
        success: (data, status)=>{
            $(".section-register_body > .wait_wrap").removeClass("show");
            $(".section-register_body > .wait_wrap svg").removeClass("spinner");
        }
    });
}
function ResponseRegister(data){
    if(data['status'] == "success"){
        CreateNotify("Регистрация", "Регистрация прошла успешно");
        setTimeout(()=>{
            window.location.replace("/");
        }, 2000)
    }else
        CreateNotify(data['data']['header'], data['data']['message']);
}