function addCreateValidation(needCreate){
    if(needCreate){
        let fName = document.getElementById("fname");
        let lName = document.getElementById("lname");

        fName.classList.add("form-item-required");
        lName.classList.add("form-item-required");
    };
}
function validateForm(needCreate) {
    let form = document.forms["customer-form"];
    if (form.classList.contains("form-not-validated")){
        addCreateValidation(needCreate);
    };

  }
function validateFormTwo(){
    let fields = document.forms["customer-form"].elements;
    
    for(i = 0; i < fields.length; i++){
        let field = fields.item(i);
        let type = field.getAttribute("type");
        let value = field.value;
        //let fn = "isValid" +(type.charAt(0).toUpperCase() + type.slice(1));

        
        if(validators[type]){
            let validateResult = validators[type](value);

            if(!validateResult)
                throw new Error(field.name + " is invalid");
        } 
    }
}
const validators = {
    email : isValidEmail
}
function isValidEmail(email){
    let validator = /(.{2})@(.+)/;

    return null != email.match(validator);

}
