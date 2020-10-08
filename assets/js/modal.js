function buildModalForm() {
    document.body.classList.add("loading");

    //myModal = modal;

    document.getElementById('modal-content').innerHTML = "";

    modalForm = new OrderUI();
    modal.render(modalForm.render());

    modal.cancel = function () {
        closeModalForm();
    };
    document.getElementById("cancelOrder").addEventListener("click", modal.cancel);
    document.getElementById("current-card").innerHTML = creditCardTemplate();
    modal.show();
    //modalForm.styleForm(900);
    document.body.classList.remove("loading");
}

function closeModalForm() {
    modal.hide();
    modalForm = null;
}

function checkoutCreateModal(){
    let response = buildModalForm();
    response.then(() => {
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
    });
}