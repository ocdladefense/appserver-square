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

function RenderLoadingPage(){
    document.getElementById('cart').removeChild(document.getElementById('cart').childNodes[2]);
    document.getElementById('count').removeChild(document.getElementById('count').childNodes[0]);
    document.getElementById('count').innerHTML = "loading...";
    loadingCartElement = createElement(vNode("div",{style:"background-color: darkgrey;"},[
        vNode("div",{className:"lds-roller"},[
            vNode("div",{},),
            vNode("div",{},),
            vNode("div",{},),
            vNode("div",{},),
            vNode("div",{},),
            vNode("div",{},),
            vNode("div",{},),
            vNode("div",{},)
        ])
    ]));
    document.getElementById('cart').appendChild(loadingCartElement);

}

function removeCartItem(element){
    RenderLoadingPage();
    let itemToDelete = element.id.slice(10);
    callout = send(null,"cart/deleteItem/"+itemToDelete).then(cart=>{
        let page = new PageUI(cart);
        page.render();
        page.modal(checkoutCreateModal);
        page.removeCartItem(removeCartItem);
    });
}

window.onload = () => {
    document.body.classList.add("loading");
    //var loadingPage = document.getElementById('cart').childNodes[1];
    callout = send(null,"/opportunity/"+customerId).then(function (opp){
        let page = new PageUI(opp);
        page.render();
        //features
        page.modal(checkoutCreateModal);
        page.removeCartItem(removeCartItem);
        document.body.classList.remove("loading");
    });
    //page.render();
    //$(document).ready(function(){ 
        // var touch 	= $('#resp-menu');
        // var menu 	= $('.menu');
     
        // $(touch).on('click', function(e) {
        //     e.preventDefault();
        //     menu.slideToggle();
        // });
        
        // $(window).resize(function(){
        //     var w = $(window).width();
        //     if(w > 767 && menu.is(':hidden')) {
        //         menu.removeAttr('style');
        //     }
        // });
        
        
    //opportunity.then((result)=>{console.log(result)});
    //});
}