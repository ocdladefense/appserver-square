let page;
let myModal;
let modalForm;

window.onload = () => {
    page = new PageUI();

    page.render();
    //$(document).ready(function(){ 
        var touch 	= $('#resp-menu');
        var menu 	= $('.menu');
     
        $(touch).on('click', function(e) {
            e.preventDefault();
            menu.slideToggle();
        });
        
        $(window).resize(function(){
            var w = $(window).width();
            if(w > 767 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
        
    //});
}