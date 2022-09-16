let count = 0;
function CreateNotify(header, text){
    $(".notifications")[0].innerHTML += `<div class="item showing">
    <span class="item-title">${header}</span>
    <p class="item-message">${text}</p>
    </div>`;
    let notification = $(".notifications .item.showing");
    notification.fadeIn("slow");
    notification.removeClass("showing");
    count++;
    setTimeout(()=>{
        $('.notifications .item:first-child').slideUp('slow', function(){
            $(this).remove();
        });
        count--;
    }, 3000*count);
}
