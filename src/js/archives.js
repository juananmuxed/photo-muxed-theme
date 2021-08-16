// Archive file
const overlay = document.getElementById('overlay');
overlay.dataset.opacity
const opacity = overlay.dataset.opacity;
const fadeDuration = 1.0*overlay.dataset.transitionTime;

if(overlay) {
    const interval = 50;
    const gap = interval/fadeDuration

    function fadeOut(el) {
        el.style.opacity = opacity;

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
            if (!((val += gap) > opacity || 0)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    };

    const gridElements = document.querySelectorAll('.grid-item');
    
    if(gridElements) {
        gridElements.forEach(e => {
            e.addEventListener('click', () => {
                fadeIn(overlay);
            })
        })
    }
    
    overlay.addEventListener('click', () => {
        fadeOut(overlay)
    });

    document.addEventListener('keyup', (e) => {
        if(e.key == 'Escape' && overlay.classList.contains('open')) {
            fadeOut(overlay);
        }
    });
}