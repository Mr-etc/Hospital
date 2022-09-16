function get_data_func(type, data = null) {
    switch (type) {
        case "ChangePage":
            Send('Change_page', "page=" + data);
            break;
        case "SearchDepartment":
            data = document.getElementById("select_department").value;
            if (data != 0)
                Send('Search', "Search_type=byDepartment&value=" + data)
            else
                Send('Change_page', "page=1");
            break;
        case "SearchFIO":
            data = document.getElementById("doctorsFIO_search").value;
            Send('Search', "Search_type=byFIO&value=" + data)
            break;
    }
}
function Send(querytype, query) {
    query = 'query_type=' + querytype + "&" + query;
    $.ajax({
        type: 'POST',
        url: 'doctors',
        data: query,
        cache: false,
        success: function (data) {
            data = JSON.parse(data);
            switch (data['type']) {
                case "RequestDoctors":
                    if (data['status'] == 'Success') {
                        amount_pages = data['data']['amount_pages'];
                        change_page_result(data);
                    }
                    else
                        alert("ERROR!");
                    break;
                case 'RequestSearch':
                    amount_pages = data['data']['amount_pages'];
                    change_page_result(data);
                    break;
            }
        }
    });
}


function change_page_result(data) {
    let items_block = document.getElementsByClassName("section-doctors-body_items-block")[0];
    let pages_block = document.getElementsByClassName("section-doctors-body_pages-block")[0];
    items_block.innerHTML = '';
    for (let key in data['data']['doctors']) {
        items_block.innerHTML += `<div class="section-doctors-body_items-block_item item_doctor">
                    <div class="item-image"><img src="${data['data']['doctors'][key]['photo']}" alt="doctor_image"></div>
                    <div class="item-desc">
                        <a href="doctors/${data['data']['doctors'][key]['id']}" class="item-desc_header">${data['data']['doctors'][key]['FIO']}</a>
                        <p class="item-desc_text">${data['data']['doctors'][key]['Department_name']}</p>
                    </div>
            </div>`;
    }
    if (amount_pages > 1) {
        pages_block.innerHTML = `<span onclick="get_data_func('ChangePage',1)" class="link">«</span>`;
        //if (typeof obj['key'] !== "undefined")
        if (data['page'] > 2)
            draw_pages(data['page'] - 2, data['page'] + 3, pages_block, data['page'])
        else
            draw_pages(1, 6, pages_block, data['page'])
        pages_block.innerHTML += `<span onclick="get_data_func('ChangePage',${amount_pages})" class="link">»</span>`;
    } else
        pages_block.innerHTML = '';
}

function draw_pages(i, max_i, pages_block, current_page) {
    for (i; i < max_i; i++) {
        if (i == amount_pages + 1)
            break;
        pages_block.innerHTML += `<span onclick="get_data_func('ChangePage',${i})" class="link ${current_page == i ? 'selected_link' : ""}">${i}</span>`;
    }
}
/*function post_query(url, name, data){
    data = data.split(',');
    var query = '';
    for(var i = 0; i<data.length; i++){
      query += '&' + data[i] + "=" + $("input[name="+ data[i] +"]").val();
    }
    $.ajax({
        type: 'POST',
        url: 'php/' + url,
        data: name + '_f=1' + query,
        cache: false,
        success: function(data){check(data); }
    });
} // Универсальные запросы*/

/* function change_page(NumPage){
        $.ajax({
            type: 'POST',
            url: 'doctors/page',
            data: 'page=' + NumPage,
            cache: false,
            success: function(data){change_page_result(data) }
        });
    }
    function Search(NumPage){
        $.ajax({
            type: 'POST',
            url: 'doctors/search',
            data: 'page=' + NumPage,
            cache: false,
            success: function(data){change_page_result(data) }
        });
    }*/