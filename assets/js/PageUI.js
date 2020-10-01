'use strict'

class PageUI extends BaseComponent {
    constructor() {
        super();

        this.id = "order-summary";

        //this.timer;
        //this.timerLength = 500;
    }
    render() {
        let headingVNode = super.createVNode(
            "h2",
            {},
            "Order Summary",
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
                        [vNode("a",{classname: "homer", href: "#"},
                            [vNode("i",{className: "fa fa-shopping-cart"})," CART"]
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
        
        

        let completeVNode = vNode("div",{},[headingVNode,menuVnode]);

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