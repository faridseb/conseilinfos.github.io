const button = document.querySelector(".fa-bars");
const navlinks = document.querySelector('.navlinks');

button.onclick = () =>{
    navlinks.classList.toggle('active');

    const isOpen = navlinks.classList.contains('active');

    button.classList = isOpen ?  'fa-solid fa-xmark' : 'fa-solid fa-bars' ;
}

navlinks.classList = isOpen ?  'fa-solid fa-xmark' : 'fa-solid fa-bars' ;