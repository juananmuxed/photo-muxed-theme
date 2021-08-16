const slider = document.querySelector('.background-slider');
const buttons = document.querySelector('.buttons-slider')

if (slider) {
    const slides = document.querySelectorAll('.slide');
    const timeout = slider.dataset.timeout;
    
    const nextSlide = () => {
        const current = document.querySelector('.current');
    
        current.classList.remove('current');
    
        if(current.nextElementSibling) {
            current.nextElementSibling.classList.add('current');
        } else {
            slides[0].classList.add('current');
        }
    }
    
    const prevSlide = () => {
        const current = document.querySelector('.current');
    
        current.classList.remove('current');
    
        if(current.previousElementSibling) {
            current.previousElementSibling.classList.add('current');
        } else {
            slides[slides.length - 1].classList.add('current');
        }
    }

    if(buttons) {
        const left = buttons.querySelector('.left');
        const right = buttons.querySelector('.right');
        
        left.addEventListener('click', prevSlide);
        right.addEventListener('click', nextSlide);
    }
    
    setInterval(() => {
        nextSlide();
    }, timeout);
}