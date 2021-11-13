// Add listeners to radio buttons
const radioDelivery1 = document.getElementById("delivery1");
radioDelivery1.addEventListener("change",() => {change1();});
const radioDelivery2 = document.getElementById("delivery2");
radioDelivery2.addEventListener("change",() => {change2();});

// Place in html, where new code will be putted, according to user choose
const formInputs = document.getElementById("formInputs");

// Get data from html, data is given by php
dataObject = document.getElementById("dataForJS");
dataString = dataObject.innerHTML;
emailString = dataString.substring(dataString.indexOf("email=") + 6,dataString.indexOf(";"));

dataString = dataString.substring(dataString.indexOf(";") + 1, dataString.indexOf("}") + 1); // Cut off email
cityString = dataString.substring(dataString.indexOf("city=") + 5,dataString.indexOf(";"));

dataString = dataString.substring(dataString.indexOf(";") + 1, dataString.indexOf("}") + 1); // Cut off city
streetString = dataString.substring(dataString.indexOf("street=") + 7,dataString.indexOf(";"));

dataString = dataString.substring(dataString.indexOf(";") + 1, dataString.indexOf("}") + 1); // Cut off street
houseNumberString = dataString.substring(dataString.indexOf("houseNumber=") + 12,dataString.indexOf(";"));

//// This part chage html according to radio button, if user choose delivery by courier this part generate form imputs ////

// If user is logged in, autocomplete his email field, else left empty
if(dataString != "")
{
    email = `<input type="email" class="btn-outline-primary btn bg-dark form-control w-75 text-light" name="email" placeholder="Email" value=${emailString}>`;
    city = `<input type="text" class="btn-outline-primary btn bg-dark form-control w-75 text-light mt-1" name="city" placeholder="Miasto" value=${cityString}>`
    street = `<input type="text" class="btn-outline-primary btn bg-dark form-control w-50 text-light mt-1" name="street" placeholder="Ulica" value=${streetString}> <input type="text" class="btn-outline-primary btn bg-dark form-control w-25 text-light mt-1" name="houseNumber" placeholder="Nr.dom" value=${houseNumberString}>`
} 
else
{
    email = `<input type="email" class="btn-outline-primary btn bg-dark form-control w-75 text-light" name="email" placeholder="Email">`;
    city = '<input type="text" class="btn-outline-primary btn bg-dark form-control w-75 text-light mt-1" name="city" placeholder="Miasto">'
    street = '<input type="text" class="btn-outline-primary btn bg-dark form-control w-50 text-light mt-1" name="street" placeholder="Ulica"> <input type="text" class="btn-outline-primary btn bg-dark form-control w-25 text-light mt-1" name="houseNumber" placeholder="Nr.dom">'
} 

// User choose delivery : self
function change1() 
{ 
    formInputs.innerHTML = email;
}

// User choose delivery : by courier
function change2() 
{  
    formInputs.innerHTML = email + city + street;
}