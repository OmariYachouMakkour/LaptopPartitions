let searchForm  =document.querySelector(".search-form");
let searchBox   = document.querySelector("#search-box");
let shoppingCart=document.querySelector(".shopping-cart");
let loginForm   =document.querySelector(".login-form");

document.querySelector('#search-btn').onclick=()=>{
    
    searchForm.classList.toggle('active');
    searchBox.focus();
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navBar.classList.remove('active');
}



document.querySelector('#cart-btn').onclick=()=>{
    shoppingCart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navBar.classList.remove('active');
}




document.querySelector('#login-btn').onclick=()=>{
    loginForm.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    navBar.classList.remove('active');
}
let navBar=document.querySelector(".navbar");

document.querySelector('#menu-btn').onclick=()=>{
    navBar.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
}

window.onscroll=()=>{
    // searchForm.classList.remove('active');
    //shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navBar.classList.remove('active');
}

let boxxContainer = document.querySelector('.boxx-container');

if (boxxContainer.children.length === 0) {
    boxxContainer.style.maxWidth = '80vh';
}





var swiper = new Swiper(".product-slider", {
    loop:true,
    spaceBetween: 20,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints:{
        0:{
            slidesPerView:1,
        },
        768:{
            slidesPerView:2,
        },
        1020:{
            slidesPerView:3,
        },
    },
    
});

var swiper = new Swiper(".review-slider", {
    loop:true,
    spaceBetween: 20,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints:{
        0:{
            slidesPerView:1,
        },
        768:{
            slidesPerView:2,
        },
        1020:{
            slidesPerView:3,
        },
    },
    
});