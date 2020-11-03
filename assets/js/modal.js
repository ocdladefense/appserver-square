let orderMenuTab;

function buildModalForm() {
    document.body.classList.add("loading");

    //myModal = modal;
    orderMenuTab = "checkout";

    document.getElementById('modal-content').innerHTML = "";

    modalForm = new OrderUI(null);
    modal.render(modalForm.render());

    modal.cancel = function () {
        closeModalForm();
    };
    document.getElementById("cancelOrder").addEventListener("click", modal.cancel);
    document.getElementById("current-card").innerHTML = creditCardTemplate();
    document.getElementsByName("changeOrder").forEach(function(element){
        element.addEventListener(("click"),changeOrderPage,false);
    })
    modal.show();
    //modalForm.styleForm(900);
    document.body.classList.remove("loading");

}

function changeOrderPage(){
    let attribute = this.getAttribute("ordermenu");
    switch(attribute){
        case "checkout":
            document.getElementById(orderMenuTab).classList.remove("homer");
            document.getElementById(orderMenuTab+"-body").hidden = true;
            orderMenuTab = "checkout";
            document.getElementById(orderMenuTab).classList.add("homer");
            document.getElementById(orderMenuTab+"-body").hidden = false;
            break;
        case "billing":
            document.getElementById(orderMenuTab).classList.remove("homer");
            document.getElementById(orderMenuTab+"-body").hidden = true;
            orderMenuTab = "billing";
            document.getElementById(orderMenuTab).classList.add("homer");
            document.getElementById(orderMenuTab+"-body").hidden = false;
            break;
        default:
            document.getElementById(orderMenuTab).classList.remove("homer");
            document.getElementById(orderMenuTab+"-body").hidden = true;
            orderMenuTab = "checkout";
            document.getElementById(orderMenuTab).classList.add("homer");
            document.getElementById(orderMenuTab+"-body").hidden = false;
            break;
    }
}

function closeModalForm() {
    modal.hide();
    modalForm = null;
}

function checkoutCreateModal(){
    let response = buildModalForm();
    var touch 	= $('.responsive-menu');
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
    //response.then(() => {
        // myModal.confirm = function () {
        //     let carCondition = DBQuery.createCondition("id", "(SQL)(SELECT max(id) FROM car)");
        //     let newCarResponse = FormSubmission.send("/car-load-more", JSON.stringify([carCondition]));
        //     newCarResponse.then(data => {
        //         let tempCar = getElementByIdFromString(data, "car-results")
        //         document.getElementById("car-results").prepend(tempCar.getElementsByClassName("car-instance")[0]);
        //         reloadButtons();
        //         myModal.cancel();
        //     }); 
        // };

        // let formSettings = { 
        //     formId: "car-create-form", 
        //     overides: {}, 
        //     dontParse: ["insert-id"]
        // };

        // parser.setSettings(formSettings);

        //modalForm.onFormSubmit(() => { submitForm("/car-insert"); });
    //});
}