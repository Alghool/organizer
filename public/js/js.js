function removeMsg(e){
    $(e).parent().remove();
    if($('.msg-wrapper li').length == 0){
        $('.msg-wrapper').remove();
    }
}


$(function(){

});