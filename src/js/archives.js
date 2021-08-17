const overlay = document.getElementById('overlay');
const opacity = overlay.dataset.opacity;
const fadeDuration = 1.0*overlay.dataset.transitionTime;

if(overlay) {
    const content = overlay.querySelector('.content');
    const background = overlay.querySelector('.background');
    const close = overlay.querySelector('.close');

    const imageWrapper = content.querySelector('.img-wrapper');
    const prev = content.querySelector('.prev');
    const next = content.querySelector('.next');

    const image = document.createElement('div');
    let img = null;

    const interval = 50;
    const gap = interval/fadeDuration
    
    if(background && opacity) background.style.opacity = opacity;

    function fadeOut(el) {
        el.style.opacity = 1;

        (function fade() {
            if ((el.style.opacity -= gap) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    };

    function fadeIn(el, display) {
        el.style.opacity = 0;
        el.style.display = display || "block";

        (function fade() {
            var val = parseFloat(el.style.opacity);
            if (!((val += gap) > 1 || 0)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    };

    function loadImage() {
        const tempImage = img.querySelector('img');
        const images = tempImage.srcset.split(',');
        const fullImage = images[images.length - 1].split(' ')[1];

        image.style.backgroundImage = 'url(' + fullImage + ')';
        image.classList.add('image')
        image.addEventListener('contextmenu', (e) => e.preventDefault());
        imageWrapper.appendChild(image);
    }

    function prevPhoto() {
        setTimeout(() => {
            const prevEl = img.previousElementSibling
            if(prevEl == null) {
                img = img.parentNode.lastElementChild
            } else {
                img = prevEl;
            }
            loadImage();
        },100);
    }

    function nextPhoto() {
        setTimeout(() => {
            const nextEl = img.nextElementSibling
            if(nextEl == null) {
                img = img.parentNode.firstElementChild
            } else {
                img = nextEl;
            }
            loadImage();
        }, 100);
    }

    function clearOverlay() {
        fadeOut(overlay);
        imageWrapper.innerHTML = '';
    }

    const gridElements = document.querySelectorAll('.grid-item');
    
    if(gridElements) {
        gridElements.forEach(el => {
            el.addEventListener('click', (e) => {
                fadeIn(overlay);
                img = el;
                loadImage();
            })
        })
    }

    prev.addEventListener('click', prevPhoto);

    next.addEventListener('click', nextPhoto);

    close.addEventListener('click', clearOverlay)
    
    imageWrapper.addEventListener('click', clearOverlay);

    background.addEventListener('click', clearOverlay);

    document.addEventListener('keyup', (e) => {
        if(e.key == 'Escape' && overlay.classList.contains('open')) clearOverlay();
        if(e.key == 'ArrowRight') nextPhoto();
        if(e.key == 'ArrowLeft') prevPhoto();
    });
}