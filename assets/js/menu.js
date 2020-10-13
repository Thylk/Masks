let isActiveSidebar = false;
let getSideBar = document.getElementById("nav-sidebar");
let getForm = document.getElementById("register-box");

document.getElementById("menu-icon").addEventListener("click",

    function() {

        if (isActiveSidebar === false) {
            getSideBar.style.visibility = "visible";
            getSideBar.style.display = "flex";
            isActiveSidebar = true;
        } else {
            getSideBar.style.visibility = "hidden";
            getSideBar.style.display = "none";
            isActiveSidebar = false;
        }
        
    }

);
