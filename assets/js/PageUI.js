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
        const lineItems= this.lineItems["records"];
        const LineComponent = LineComponents(lineItems);
        let countElement = createElement(vNode("span",{className:"count"},lineItems.length+" item(s) in the cart"));
        
        
        let checkoutbtnVNode = vNode("a",{id:"checkoutModal", className:"car-link-btn"},
            vNode("span",{},"Checkout"));

        let notificationvNode = vNode("div",{className:"notification-container bottom-left",hidden:"true"},[
            vNode("div",{class:"notification toast bottom-left",style:"background-color: #5bc0de;padding-bottom: 50px;"},[
                vNode("div",{class:"notification-image"},
                    vNode("img",{id:"notification-image", src:"{!URLFOR($Resource.info)}", alt:""},)),
                vNode("div",{},[
                    vNode("p",{className:"notification-title"},"Title"),
                    vNode("p",{className:"notification-message"},"Message")
                ])
            ])
        ])

        let cartVNode = vNode("div",{},[LineComponent,checkoutbtnVNode,notificationvNode]);

        var cartElement = createElement(cartVNode); 
        document.getElementById('cart').removeChild(document.getElementById('cart').childNodes[1]);
        document.getElementById('count').innerHTML = "";
        document.getElementById('count').appendChild(countElement);
        document.getElementById('cart').appendChild(cartElement);
    } 

    modal(callback){
        document.getElementById("checkoutModal").addEventListener("click", (e) => {
            e.preventDefault();
            callback();
        });
    }
    removeCartItem(callback){
        let elements = document.getElementsByName("removeItem");
        elements.forEach((element,index)=>{
            renderRemoveCartSvg(element);
            element.addEventListener("click",(e)=>{
                e.preventDefault();
                callback(element);
            });
        });
    }

}