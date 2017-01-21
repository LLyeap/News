// function changeStyle() {
    $(document).ready(function(){
        $('article').hover(function(event){
            $(this).addClass("newcolor");
        },function(event){
            $('article').removeClass('newcolor');
        });
    });
// }