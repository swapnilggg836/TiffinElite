const images = [
    'https://via.placeholder.com/400x300',
    'https://via.placeholder.com/400x300/ff7f7f',
    'https://via.placeholder.com/400x300/7f7fff'
];

let currentImageIndex = 0;
const imageSlider = document.getElementById('image-slider');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

prevButton.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    imageSlider.src = images[currentImageIndex];
});

nextButton.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    imageSlider.src = images[currentImageIndex];
});