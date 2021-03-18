const slides = document.querySelectorAll('.caseroul img');
var count = 0;
var maxSlide = slides.length;
slides.forEach(item => {
    item.style.display = "none";
});
if(slides[0]){
    slides[0].style.display = "block";
}
function moveSlides(){
    //console.log(slides[count]);
    count++;
    if(count >= maxSlide){
        count = 0;
    }
    slides.forEach(item => {
        item.style.display = "none";
    });
    slides[count].style.display = "block";
}
if(maxSlide != 0){
    setInterval(moveSlides,4000);
}
console.log(maxSlide);

// expand navbar
const menu = document.querySelector('.menu');
menu.addEventListener('click',() => {
    document.body.classList.toggle('navbar-expand');
});

// scrolling fixed header
window.addEventListener('scroll',function(){
    let header = document.querySelector('header');
    let wp = window.scrollY > 150;
    header.classList.toggle('scrolling',wp);
});
// close navbar
const closeNav = document.querySelector('.menu-close');
if(closeNav){
    closeNav.addEventListener('click',function(){
        document.body.classList.remove('navbar-expand');
    });
}
const sticky = document.querySelector('.sticky-fixed');
if(sticky){
    sticky.addEventListener('click',function(){
        document.body.classList.remove('navbar-expand');
    });
}
// dropdown menu
const navItem = document.querySelectorAll('.has-sub');
navItem.forEach(item => {
    item.addEventListener('click',(e) => {
        //alert("hey, you just clicked me ");
        //console.log(item.children[1]);
        if(item.children[1].hasChildNodes)
        {
            item.children[0].firstElementChild.classList.toggle('fa-angle-left');
            //console.log("yes");
            item.children[1].classList.toggle('active');
        }
    });
});