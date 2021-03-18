var url = document.querySelector("#url");
function copyLink() {
    /* Get the text field */
    var copyText = url;
  
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
  
    /* Copy the text inside the text field */
    document.execCommand("copy");
  
    /* Alert the copied text */
    appearPopup();
}
function appearPopup(){
    var pop = document.querySelector(".pop-up");
    pop.classList.add("pop-up-open");
    setTimeout(function(){
        closePopup();
    },3000);
}
// function close pop up
function closePopup(){
    var pop = document.querySelector(".pop-up");
    pop.classList.remove("pop-up-open");
}