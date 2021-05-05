addEventListener("load", function () {
    //Validation
    let form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        let name = document.querySelector("#name").value;
        let email = document.querySelector("#email").value;
        let phonenumber = document.querySelector("#phonenumber").value;
        name = name.trim()
        email = email.trim()
        phonenumber = phonenumber.trim()
        let errors = [];
        if (name === "") {
            errors.push("Bitte geben sie einen Namen ein.");
        }
        if (email === "") {
            errors.push("Bitte geben sie eine E-Mail ein.");
        }
        if (errors.length > 0) {
            renderErrors(errors);
            event.preventDefault();
        }
    })


    function renderErrors(errors){   
        let errorList = document.querySelector("#errorList");
        errorList.innerHTML = "";
        //LI erstellen mit Error-Meldungne
        errors.forEach(function(error){
            let errorItem = document.createElement("li");
            errorItem.textContent = error;
            //LI in Error Liste erstellen
            errorList.appendChild(errorItem);
        });
    }


    
});





