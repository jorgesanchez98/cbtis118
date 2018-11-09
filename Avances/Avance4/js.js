var trs = document.querySelectorAll("tr");
for(var i = 0; i < trs.length; i++){
    trs[i].addEventListener("click", function(){this.className += " selected";});
}​