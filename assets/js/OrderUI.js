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
        let headingVNode = super.createVNode(
            "h2",
            {},
            "Summary",
            this
        );
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
                        [vNode("a",{className: "homer", href: "#"},
                            [vNode("i",{className: "fa fa-shopping-cart"})," CHECKOUT"]
                        )]
                    ),
                    vNode("li",{},
                        [vNode("a",{classname: "homer", href: "#"},
                            [vNode("i",{className: "fa fa-address-card"})," BILLING ADDRESS"]
                        )]
                    ),
                    vNode("li",{},
                        [vNode("a",{classname: "homer", href: "#"},
                            [vNode("i",{className: "fa fa-id-card"})," SHIPPING ADDRESS"]
                        )]
                    ),
                    vNode("li",{},
                        [vNode("a",{classname: "homer", href: "#"},
                            [vNode("i",{className: "fa fa-credit-card"})," PAYMENT TYPE"]
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

        let formVNode = vNode(
            "form",
            { id: this.id },
            [headingVNode,menuVnode,placeCardVNode,placeOrderbtnVNode,cancelbtnVNode]
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