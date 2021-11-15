const statusSelect = document.getElementById("statusSelect");

statusSelect.addEventListener("change",()=>{changeStatusSelectColor();})

function changeStatusSelectColor()
{
    //console.log(statusSelect.value);
    if(statusSelect.value == "Nie zaakceptowany") statusSelect.classList = "btn-outline-danger btn";
    else if(statusSelect.value == "Przygotowywanie") statusSelect.classList = "btn-outline-warning btn";
    else if(statusSelect.value == "W drodze" | statusSelect.value == "Do odebrania") statusSelect.classList = "btn-outline-success btn";
    else if(statusSelect.value == "Zrealizowane") statusSelect.classList = "btn-outline-light btn";
    
}