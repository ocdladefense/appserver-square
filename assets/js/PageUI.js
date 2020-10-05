'use strict'

class PageUI extends BaseComponent {

    constructor(opportunity) {
        super();

        this.id = "order-summary";
        //console.log(opportunity["records"]["0"]);
        this.opportunity=opportunity["OppInfo"]["records"]["0"];
        this.lineItems = opportunity["OppLineItems"];
        
        //this.timerLength = 500;
    }
    render() {
        let headingVNode = super.createVNode(
            "h2",
            {},
            "Cart",
            this
        );

        /*
        let selectOptions = [];
        
        if (subjects.options) {
            selectOptions = subjects.options.map(option => {
                return super.createVNode(
                    "option",
                    { value: option.value },
                    option.name.toLowerCase(),
                    this
                );
            });
        }

        let allOption = super.createVNode(
            "option",
            { value: "ALL" },
            "--ALL-- (Select Subject)",
            this
        );

        selectOptions.unshift(allOption);

        let selectVNode = super.createVNode(
            "select",
            { id: "car-subject_1", class: "car-form-field", "data-field": subjects.field },
            selectOptions,
            this
        );

        let dateOptions = dateRanges.options.map(option => {
            if (option.value == "space") {
                return super.createVNode(
                    "option",
                    { disabled: true },
                    option.name,
                    this
                );
            } else {
                return super.createVNode(
                    "option",
                    { value: option.value },
                    option.name,
                    this
                );
            }
        });

        let selectDateVNode = super.createVNode(
            "select",
            { id: "car-dates", class: "car-form-field", "data-field": dateRanges.field, "data-op": dateRanges.op },
            dateOptions,
            this
        );

        let searchCheckBoxes = searches.flatMap(checkBox => {
            return [super.createVNode(
                "label",
                { for: checkBox.name },
                checkBox.name,
                this
            ),
            super.createVNode(
                "input",
                { type: "checkbox", class: "search-checkbox", id: checkBox.name, value: checkBox.value },
                [],
                this
            )
            ];
        });

        let checkBoxesVNode = super.createVNode(
            "div",
            { id: "checkbox-group" },
            searchCheckBoxes,
            this
        );

        var inputVNode = super.createVNode(
            "input",
            { id: "car-search-box" }, 
            [], 
            this
        );

        let sortOptions = sorts.map(option => {
            return super.createVNode(
                "option",
                { value: option.value, "data-desc": option.desc },
                option.name,
                this
            );
        });

        let selectSortVNode = super.createVNode(
            "select",
            { id: "car-sort", class: "car-form-field", "data-desc": true},
            sortOptions,
            this
        );

        let formSearchVNode = super.createVNode(
            "div",
            { id: "car-search-container" },
            [checkBoxesVNode, inputVNode],//selectSearchLabelVNode, selectSearchVNode, inputVNode],
            this
        );

        let formFilterVNode = super.createVNode(
            "div",
            {},
            [selectVNode, selectDateVNode, selectSortVNode],
            this
        );
        /*
        let limitVNode = super.createVNode(
            "input",
            { id: "car-limit", class: "car-form-field" },
            [],
            this
        );

        let limitLabelVNode = super.createVNode(
            "label",
            { for: "car-limit" },
            "Number of CAR's to Return: ",
            this
        );

        let mobileSeparatorVNode = super.createVNode(
            "hr",
            { id: "car-mobile-separator" },
            [],
            this
        );

        let formVNode = super.createVNode(
            "form",
            { id: this.id },
            [formSearchVNode, mobileSeparatorVNode, formFilterVNode],
            this
        );

        let buttonVNode = super.createVNode(
            "input",
            { type: "button", id: "car-form-button", value: "Show Search Form" },
            [],
            this
        );

        let carCreateLink = super.createVNode(
            "a",
            { id: "car-create-link", class: "car-link-btn" },
            [super.createVNode(
                "span",
                {},
                "Create New Criminal Apellate Review",
                this
            )],
            this
        );
        */
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
        let opportunityVNode = vNode("ul",{className:"lineItems"},[
            vNode("li",{className:"lineItem"},[
                vNode("div",{className:"col left"},[
                    vNode("div",{className:"detail"},[
                        vNode("div",{className:"name"},
                            vNode("a",{href:"#"},this.lineItems["records"]["0"]["Description"])),
                        vNode("div",{className:"description"},"Product Code: "+this.lineItems["records"]["0"]["ProductCode"]),
                        vNode("div",{className:"price"},"$"+this.lineItems["records"]["0"]["UnitPrice"])
                    ])
                ]),
                vNode("div",{className: "col right"},[
                    vNode("div",{className:"quantity"},
                        vNode("input",{type:"text", className:"quantity", step:"1", value:"1"})),
                    vNode("div",{className:"remove"},
                        vNode("svg",{version:"1.1", className:"close", y:"0px", x:"0px", viewBox:"0 0 60 60"},
                            vNode("polygon",{points:"38.936,23.561 36.814,21.439 30.562,27.691 24.311,21.439 22.189,23.561 28.441,29.812 22.189,36.064 24.311,38.186 30.562,31.934 36.814,38.186 38.936,36.064 32.684,29.812"},)))
                ])
            ])
        ]);
        
        let checkoutbtnVNode = vNode("a",{id:"car-create-link", className:"car-link-btn"},
            vNode("span",{},"Checkout"));

        let completeVNode = vNode("div",{},[headingVNode,opportunityVNode,checkoutbtnVNode]);

        var pageElement = createElement(completeVNode);
        
        document.getElementById('body').appendChild(pageElement);
        //this.form = document.getElementById(this.id); // used by component

        //this.attachAttributes();

        //Check the first checkbox
        //(document.getElementsByClassName("search-checkbox"))[0].checked = true;

        //document.getElementById("car-form-button").addEventListener("click", this.toggleForm);
        
        //searchPlaceholderText();
    } 

}