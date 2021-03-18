function collapseSidebar(){
    document.body.classList.toggle('sidebar-expand');
}

window.onclick = function(event){
    openCloseDropdown(event);
}

// close all dropdown
function closeAllDropdown(){
    var dropdowns = document.querySelectorAll('.dropdown-expand');
    dropdowns.forEach(drops => {
        drops.classList.remove('dropdown-expand');
    });
}

function openCloseDropdown(event){
    if(!event.target.matches('.dropdown-toggle')){
        // close dropdown when click outside menu
        closeAllDropdown();
    }
    else{
        var toggle = event.target.dataset.toggle;
        //console.log(toggle);
        var content = document.querySelector(`#${toggle}`);
        //console.log(content);
        if(content.classList.contains('dropdown-expand')){
            closeAllDropdown();
        }
        else{
            closeAllDropdown();
            content.classList.add('dropdown-expand');
        }
    }
}
/// sub menu
const subMenu = document.querySelectorAll('.dropdown-index');
subMenu.forEach(item => {
    item.addEventListener('click',(e) => {
        var subDropdown = document.querySelectorAll('.dropdown-index');
        //e.preventDefault();
        item.classList.toggle("active");
        if(item.classList.contains("active")){
            subDropdown.forEach(sub => {
                sub.classList.remove("active");
                });
                item.classList.add("active");
        }
    });
});
// open sidebar
var openSide = document.querySelector('#hamburger');
var sidebarOverlay = document.querySelector('.sidebar-overlay');
var closeSide = document.querySelector('.navbar-btn');
var sideBar = document.querySelector('.sidebar');
openSide.addEventListener('click',function(e){
    e.preventDefault();
    sideBar.classList.add('open');
    sidebarOverlay.classList.add('active');
});
closeSide.addEventListener('click',function(){
    sideBar.classList.remove('open');
    sidebarOverlay.classList.remove('active');
});
if(sidebarOverlay){
    sidebarOverlay.addEventListener('click',(e) => {
        sideBar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    });
}