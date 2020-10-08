let page;
let myModal;
let modalForm;
let opportunity;
let order;

function getSObjectRequest(json, url) {
    let headers = new Headers();
    headers.append('Content-Type', 'application/json');
    headers.append('Accept', 'text/html');

    let init = {
        body: json,
        method: "POST",
        headers: headers
    }

    return new Request(url, init);
}

function send(body,url){
    let req = getSObjectRequest(body, url);
    let callout = fetch(req);
    return callout.then((resp) => {
        return resp.json();
    });
}   


window.onload = () => {
    //page = new PageUI();
    callout = send(null,"/opportunity/0063h000009tv58AAA").then(function (opp){
        let page = new PageUI(opp);
        document.body.classList.add("loading");
        page.render();
        page.modal(checkoutCreateModal);
        document.body.classList.remove("loading");
    });
    //page.render();
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
        
        
    //opportunity.then((result)=>{console.log(result)});
    //});
}