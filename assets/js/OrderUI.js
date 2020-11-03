'use strict'

class OrderUI extends BaseComponent {

    constructor(order) {
        super();

        this.id = "order/";//+order;
        console.log(order);
        
        //this.lineItems.redords.map;
                                //.foreach
    }
    render() {
        let headingVNode = vNode("h2",{className:"container", style:"text-align: center; color: rgba(0,0,0,0.6);"},"Summary");
        let menuVnode = vNode(
            "nav",{id: "order-summary-menu"},
            [vNode("a",
                {id :"resp-menu", className :"responsive-menu", href: "#"},
                [vNode("i",{className: "fa fa-bars"})," MENU"]
            ),
            vNode("ul",
                {className :"menu"},
                [
                    vNode("li",{},
                        [vNode("a",{id:"checkout", name:"changeOrder", className: "homer", href: "#",orderMenu:"checkout"},
                            [vNode("i",{className: "fa fa-shopping-cart"})," CHECKOUT"]
                        )]
                    ),
                    vNode("li",{},
                        [vNode("a",{id:"billing", name:"changeOrder",href: "#",orderMenu:"billing"},
                            [vNode("i",{name:"changeOrder", className: "fa fa-address-card"})," BILLING ADDRESS"]
                        )]
                    ),
                    vNode("li",{},
                        [vNode("a",{name:"changeOrder",href: "#",orderMenu:"shipping"},
                            [vNode("i",{name:"changeOrder", className: "fa fa-id-card"})," SHIPPING ADDRESS"]
                        )]
                    ),
                    vNode("li",{},
                        [vNode("a",{name:"changeOrder",href: "#",orderMenu:"shipping"},
                            [vNode("i",{name:"changeOrder", className: "fa fa-credit-card"})," PAYMENT TYPE"]
                        )]
                    )
                ]
            ),
            ]
        );

        let placeCardVNode = vNode("div",{id:"current-card"},[]);
        
        let placeOrderbtnVNode = vNode("a",{id:"placeOrder", className:"car-link-btn"},
            vNode("span",{},"Place Order"));
        let cancelbtnVNode = vNode("div",{id:"cancelOrder", className:"car-link-btn"},
            vNode("span",{},"Cancel"));

        let checkoutBody = vNode("div",{id:"checkout-body"},
            [placeCardVNode,
                vNode("div",{},[
                    vNode("div",{id:"sq-card-number",className:"third",hidden:"true"},),
                    vNode("div",{id:"sq-expiration-date",className:"third",hidden:"true"},),
                    vNode("div",{id:"sq-cvv",className:"third",hidden:"true"},),
                    vNode("div",{id:"sq-postal-code",className:"third",hidden:"true"},),
                    vNode("button",{id:"sq-creditcard", className:"button-credit-card",onclick:"onGetCardNonce(this,event)"},"Submit Payment")
                ])
                ,placeOrderbtnVNode,cancelbtnVNode]);
        let shippingBody = vNode("div",{id:"shipping-body",hidden:"true"},
            [vNode("form",{},),cancelbtnVNode]);
        let billingBody = vNode("div",{id:"billing-body",hidden:"true"},
            [vNode("form",{},),cancelbtnVNode]);
        let paymentBody = vNode("div",{id:"payment-body",hidden:"true"},
        [vNode("form",{},),cancelbtnVNode]);

        let formVNode = vNode(
            "form",
            { id: this.id },
            [headingVNode,menuVnode,checkoutBody,billingBody,shippingBody,paymentBody]
        );

        return formVNode;
    } 

    modal(callback){
        document.getElementById("checkoutModal").addEventListener("click", (e) => {
            e.preventDefault();
            callback();
        });
    }

}