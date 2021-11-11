const radioDelivery1 = document.getElementById("delivery1");
radioDelivery1.addEventListener("change",() => {change1();});

const radioDelivery2 = document.getElementById("delivery2");
radioDelivery2.addEventListener("change",() => {change2();});

const formInputs = document.getElementById("formInputs");

//// This part chage html according to radio button, if user choose delivery by courier this part generate form imputs ////

// User choose delivery : self
function change1() 
{
    email = '<input type="email" class="btn-outline-primary btn bg-dark form-control w-75 text-light" name="email" placeholder="Email">'
    formInputs.innerHTML = email;
}

// User choose delivery : by courier
function change2() 
{
    email = '<input type="email" class="btn-outline-primary btn bg-dark form-control w-75 text-light" name="email" placeholder="Email">'
    street = '<input type="text" class="btn-outline-primary btn bg-dark form-control w-50 text-light mt-1" name="street" placeholder="Ulica"> <input type="text" class="btn-outline-primary btn bg-dark form-control w-25 text-light mt-1" name="houseNr" placeholder="Nr.dom">'
    city = '<input type="text" class="btn-outline-primary btn bg-dark form-control w-75 text-light mt-1" name="city" placeholder="Miasto">'
    formInputs.innerHTML = email + city + street;
}