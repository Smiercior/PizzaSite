$(document).ready(function()
{
    const statusSelectList = document.getElementsByName("status");
    statusSelectList.forEach(statusSelect => {
        console.log(statusSelect);
        statusSelect.addEventListener("change",function(){
            if(statusSelect.value == "Nie zaakceptowany") statusSelect.classList = "btn-outline-danger btn";
            else if(statusSelect.value == "Przygotowywanie") statusSelect.classList = "btn-outline-warning btn";
            else if(statusSelect.value == "W drodze" | statusSelect.value == "Do odebrania") statusSelect.classList = "btn-outline-success btn";
            else if(statusSelect.value == "Zrealizowane") statusSelect.classList = "btn-outline-light btn";
        })
    });
})
