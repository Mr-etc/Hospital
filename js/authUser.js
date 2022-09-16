const url = '/user/api';
var lines = null,items = null,choose_time = null, choose_day = null;
function initialize(){
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
    $(".section-auth_body .Button").on("click", (e)=>{
        let inputs = $(".section-auth_body .input-block > input");
        let errors = checkFields(inputs);
        if(errors.length == 0)
        {
            Send();
            return;
        }
        else
            for(let key in errors)
                $(inputs[errors[key]]).parent().addClass("error");
        CreateNotify("Авторизация", "Не все поля заполнены корректно");
    });
}
function checkFields(fields){
    let errors = [];
    for(let i = 0; i < fields.length; i++)
    {
        if(fields[i].value != "")
            switch (fields[i].id) {
                case "Pass-user":
                    if(!(/(^[A-zА-я0-9]{8,}$)/.test(fields[i].value)))
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
    let phone = /^.+(\d{3}).+(\d{3}).+(\d{2}).+(\d{2})$/.exec($("#Phone-user").val());
    phone.shift(1);
    fields.push(phone.join(''));
    fields.push($("#Pass-user").val());
    query = `query_type=authAccount&phone=${fields[0]}&pass=${fields[1]}`;
    $.ajax({
        type: 'POST',
        url: url,
        data: query,
        cache: false,
        beforeSend: ()=>{
            $(".section-auth_body > .wait_wrap").addClass("show");
            $(".section-auth_body > .wait_wrap svg").addClass("spinner");
        },
        statusCode: {
            200:(data)=>{
                data = JSON.parse(data);
                switch(data['type']){
                    case "notify":
                        CreateNotify(data['data']['header'], data['data']['message']);
                        break;
                    case "auth":
                        ResponseAuth(data);
                        break;
                }
                
            },
            404:()=>{
                CreateNotify("Ошибка", "Страница не найдена");
            }
        },
        success: ()=>{
            $(".section-auth_body > .wait_wrap").removeClass("show");
            $(".section-auth_body > .wait_wrap svg").removeClass("spinner");
        }
    });
}

function ResponseAuth(data){
    if(data['status'] == "success"){
        window.location.replace("/");
    }else
        CreateNotify(data['data']['header'], data['data']['message']);
}