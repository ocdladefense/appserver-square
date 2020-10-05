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

async function getSObject(json,url){
    let req = getSObjectRequest(json, url);
    let response = fetch(req);
    response.then(async(resp) => {
        //return await resp.json();
        let page = new PageUI(await resp.json());
        page.render();
    });
}   



window.onload = () => {
    //page = new PageUI();
    opportunity = getSObject("","/opportunity/0063h000009tv58AAA");
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