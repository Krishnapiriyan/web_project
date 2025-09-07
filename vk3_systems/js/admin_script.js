const navbar = document.querySelector('.header .flex .newnavbar');
const profile = document.querySelector('.header .flex .profile');
const menuBtn = document.querySelector('#menu-btn');
const userBtn = document.querySelector('#user-btn');

// toggle mobile menu with staggered link reveal
if(menuBtn && navbar){
   menuBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !navbar.classList.contains('active');
      navbar.classList.toggle('active');
      // ensure profile menu is closed
      if(profile) profile.classList.remove('active');

      // stagger links when opening
      const links = Array.from(navbar.querySelectorAll('a'));
         links.forEach((lnk, i) => {
            if(opening){
               lnk.style.transitionDelay = (i * 70) + 'ms';
            } else {
               lnk.style.transitionDelay = '';
               lnk.style.opacity = '';
               lnk.style.transform = '';
            }
         });
   });

   // close menu when a nav link is clicked
   navbar.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
         navbar.classList.remove('active');
         navbar.querySelectorAll('a').forEach(n=> n.style.transitionDelay = '');
      });
   });
}

// profile toggle (desktop/user button)
if(userBtn){
   userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      if(profile) profile.classList.toggle('active');
      if(navbar) navbar.classList.remove('active');
   });
}

// close menus when clicking outside
document.addEventListener('click', (e) => {
   if(navbar && !navbar.contains(e.target) && !menuBtn.contains(e.target)){
      navbar.classList.remove('active');
      navbar.querySelectorAll('a').forEach(n=> n.style.transitionDelay = '');
   }
   if(profile && !profile.contains(e.target) && userBtn && !userBtn.contains(e.target)){
      profile.classList.remove('active');
   }
});

// close on scroll
window.addEventListener('scroll', () =>{
   if(navbar) navbar.classList.remove('active');
   if(profile) profile.classList.remove('active');
   if(navbar) navbar.querySelectorAll('a').forEach(n=> n.style.transitionDelay = '');
});

// image preview logic (unchanged)
let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');

subImages.forEach(images =>{
    images.onclick = () =>{
         src = images.getAttribute('src');
         mainImage.src = src;
    }
});