// Common JS functions for all Pages

/*
* Protected images
*/

let images = document.querySelectorAll('img');
images.forEach(el => {
    el.addEventListener('contextmenu', e => {
        e.preventDefault();
    })
})
