$(document).ready(function () {
    window.onscroll = function () {
        if (document.body.scrollTop > 152 || document.documentElement.scrollTop > 152) {
            document.getElementById("menu-bar").classList.add("fixed-top");
        } else {
            document.getElementById("menu-bar").classList.remove("fixed-top");
        }
    };
    $("#btn-search").on("click",function(){
        var key_word=$('#txt-search').val()
        key_word=key_word.replaceAll(/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/g,'-')
        key_word=key_word.replaceAll(/( )/g,'-')
        key_word=key_word.replaceAll(/(\/)/g,'-')
        window.location.replace('./tim-kiem/'+key_word)
        
    })
});
document.addEventListener("DOMContentLoaded", function (event) {
    var exampleModal = document.getElementById('imageModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            var button = event.relatedTarget
            var image = button.getAttribute('data-bs-whatever')
            var imageModal = exampleModal.querySelector('img')
            imageModal.src=image
        })
    }
});


