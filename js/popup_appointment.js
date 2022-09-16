var lines = null,items = null,choose_time = null, choose_day = null;
function initializePopup(){
    drawSecondBlock();
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
    $(".popup_appointment_body_buttons .Button").on("click", (e)=>{
        switch (e.target.name) {
            // case "Next":
            //     NextButton(e.target);
            //     break;
            case "Send":
                RegisterAppoinment();
                break;
        }
    });
    $(".popup_appointment").addClass("initialized");
}
function destroy(){
    $(".input-block.with_title input").off("focus");
    $(".input-block.with_title input").off("blur");
    $(".popup_appointment_body_buttons .Button").off("click");
    $('.popup_appointment , .popup_appointment_body_header > .close-btn').off('click');
    $(".popup_appointment").removeClass("initialized");
}


// function NextButton(e){
//     let inputs = $(".line-inputs .input-block > input");
//     let errors = checkFields(inputs);
//     if(errors.length == 0)
//         drawSecondBlock(e);
//     else
//         for(let key in errors)
//             $(inputs[errors[key]]).parent().addClass("error");
// }

function drawSecondBlock(){
    document.querySelector('.popup_appointment_body_header').innerHTML = "Информация о приеме <span onclick='destroy()' class='close-btn'>X</span>";
    $(".popup_appointment_body_content .User_info").removeClass("visible");
    $(".popup_appointment_body_content .Registration-appointment").addClass("visible");
    Send("Get_department", "");
    $('.Registration-appointment_departments-list').on('change', (e)=>{
        Send("Get_doctor", "department_id="+($(e.target).val()));
    })
    $('.Registration-appointment_doctors-list').on('change', (e)=>{
        let docID = $(e.target).val();
        if(docID != "")
            Send("Get_schedule", "doctor_id="+docID);
        else
        items.addClass('CantChoose');
    })
    lines = $('.popup_appointment_body_content .Registration-appointment_choose-time table .table_body tr');
    items = $('td', lines);
}

function RegisterAppoinment(){
    let errors = checkFields($(".line-inputs .input-block > input"));
    if(errors.length == 0){
        let id_doctor = $('.Registration-appointment_doctors-list').val();
        Send("Register_appoinment", `id_doc=${id_doctor}&day=${choose_day}&time=${choose_time}`);
    }
}

function filldepartments(data){
    let selectDepartments = $('.Registration-appointment_departments-list');
    selectDepartments[0].innerHTML = '<option selected value="">Выберите Отделение</option>';
    for(let key in data){
        selectDepartments[0].innerHTML += '<option value="'+ data[key]['id'] +'">'+ data[key]['name'] +'</option>';
    }
}
function filldoctors(data){
    let selectDoctors = $('.Registration-appointment_doctors-list');
    selectDoctors[0].innerHTML = '<option selected value="">Выберите врача</option>';
    for(let key in data){
        selectDoctors[0].innerHTML += '<option value="'+ data[key]['id'] +'">'+ data[key]['FIO'] +'</option>';
    }
    items.addClass('CantChoose');
}
let xuy;
function filltable(data){
    xuy = data;
    if(data.length > 0){
        items.removeClass('CantChoose');
        data = data.map(function(data) {
            return data.split(',');
        });
        data.forEach((item) => {
                let row = Number.parseInt((item[1].substr(1)))+1; 
                let column = item[0] > 0?Number.parseInt(item[0])-1 : 6;
                $(lines[row].cells[column]).addClass("CantChoose");
        });
        clearTimes(lines);
    }else{
        items.removeClass('CantChoose');
        clearTimes(lines);
    }
}
function clearTimes(lines){
    let date = new Date();
    let week = date.getDay();
    let indexHour = String(date.getHours()+1);
    let lastColum = week > 0?Number.parseInt(week)-1 : 6;
    for(let i = 1; i < lines.length; i++){
        if((i+9) > indexHour)
            for(let j = 0; j<lastColum; j++)
                $(lines[i].cells[j]).addClass("CantChoose");
        else
            for(let j = 0; j<=lastColum; j++)
                $(lines[i].cells[j]).addClass("CantChoose");  
    }
}
function chooseTime(obj, time, day){
    if(!$($(obj).parent()[0]).hasClass('CantChoose')){
        choose_time = time;
        choose_day = day;
        $('span', items).removeClass('choosed');
        $(obj).addClass('choosed');
    }
}

function Send(querytype, query){
    query = 'query_type='+querytype+"&"+query;
    $.ajax({
        type: 'POST',
        url: 'appointment/register',
        data: query,
        cache: false,
        beforeSend: ()=>{
            $('.popup_appointment_body .popup_appointment_body_content').addClass('bg_wait');
        },
        success: (data)=>{
            $('.popup_appointment_body .popup_appointment_body_content').removeClass('bg_wait');
            data = JSON.parse(data);
            if(data['status'] == 'Success')
            {
                switch(data['type']){
                    case "RequestDepartments":
                            filldepartments(data['data']);
                        break;
                    case 'RequestDoctors':
                        filldoctors(data['data']);
                        break;
                    case 'RequestDoctorsSchedule':
                        filltable(data['data']);
                        break;
                    case 'RequestRegisterAppointment':
                        alert('Запись на прием успешно зарегистрирована!');
                        window.location.reload(true);
                        break;
                }
            }else
                alert("ERROR!");
        }
    });
}


function checkFields(fields){
    let errors = [];
    for(let i = 0; i < fields.length; i++)
    {
        if(fields[i].value != "")
            switch (fields[i].id) {
                case "Surname-appointment":
                    let val = fields[i].value;
                    if(!(/^[A-Za-zА-Яа-я]+$/.test(fields[i].value)))
                        errors.push(i);
                    break;
                case "Name-appointment":
                    if(!(/^[A-Za-zА-Яа-я]+$/.test(fields[i].value)))
                        errors.push(i);
                    break;
                case "Lastname-appointment":
                    if(!(/^[A-Za-zА-Яа-я]+$/.test(fields[i].value)))
                        errors.push(i);
                    break;
                case "MailUser-appointment":
                    if(!(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(fields[i].value)))
                        errors.push(i);
                    break;      
            }
        else
            errors.push(i);
    }
    return errors;
}