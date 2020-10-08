'use strict'

class PageUI extends BaseComponent {

    constructor(opportunity) {
        super();

        this.id = "order-summary";
        //console.log(opportunity["records"]["0"]);
        this.opportunity=opportunity["OppInfo"]["records"]["0"];
        this.lineItems = opportunity["OppLineItems"];
        
        //this.lineItems.redords.map;
                                //.foreach
    }
    render() {
        let headingVNode = vNode("h2",{},"Cart");
        const lineItems= this.lineItems["records"];
        let itemCount = vNode("span",{className:"count"},lineItems.length+" item(s) in the cart");

        const LineComponent = LineComponents(lineItems);
        
        let checkoutbtnVNode = vNode("a",{id:"checkoutModal", className:"car-link-btn"},
            vNode("span",{},"Checkout"));

        let completeVNode = vNode("div",{},[headingVNode,itemCount,LineComponent,checkoutbtnVNode]);

        var pageElement = createElement(completeVNode);
        
        document.getElementById('body').appendChild(pageElement);
    } 

    modal(callback){
        document.getElementById("checkoutModal").addEventListener("click", (e) => {
            e.preventDefault();
            callback();
        });
    }

}