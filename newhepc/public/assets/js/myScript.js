$(document).ready(function(){
    window.onscroll=function(){
        if(document.body.scrollTop>152||document.documentElement.scrollTop > 152)
        {
            document.getElementById("menu-bar").classList.add("fixed-top");
        }else{
            document.getElementById("menu-bar").classList.remove("fixed-top");
        }
    };
});