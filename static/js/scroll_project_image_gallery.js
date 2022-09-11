// Previous image button was clicked
document.getElementById("project-image-gallery-previous-arrow-button").addEventListener("click", () => {
    const imageGallery = document.getElementById("project-images");
    const prevButton = document.getElementById("project-image-gallery-previous-arrow-button");
    const nextButton = document.getElementById("project-image-gallery-next-arrow-button");

    // Since the previous button was clicked, the image gallery scrolls to the previous image.
    // This means there must now be another image "next".
    // So, the next button must not be disabled.
    nextButton.style.display = "flex";

    // Check if this click will make the image gallery scroll to the beginning of the gallery
    if (imageGallery.scrollLeft - 850 <= 0) {
        // If so, set the scroll to the beginning of the gallery and disable the previous button
        imageGallery.scrollLeft = 0;
        prevButton.style.display = "none";
    } else {
        // Otherwise, scroll left and keep the previous button enabled
        imageGallery.scrollLeft -= 850;
        prevButton.style.display = "flex";
    }
});

// Next image button was clicked
document.getElementById("project-image-gallery-next-arrow-button").addEventListener("click", () => {
    const imageGallery = document.getElementById("project-images");
    const prevButton = document.getElementById("project-image-gallery-previous-arrow-button");
    const nextButton = document.getElementById("project-image-gallery-next-arrow-button");

    // Calculate the maximum amount that can be scrolled
    const maximumScrollAmount = imageGallery.scrollWidth - imageGallery.offsetWidth;

    // Since the next button was clicked, the image gallery scrolls to the next image.
    // This means there must now be another image "previous".
    // So, the previous button must not be disabled.
    prevButton.style.display = "flex";

    // Check if this click will make the image gallery scroll to the end of the gallery
    if (imageGallery.scrollLeft + 850 >= maximumScrollAmount) {
        // If so, set the scroll to the end of the gallery and disable the next button
        imageGallery.scrollLeft = maximumScrollAmount;
        nextButton.style.display = "none";
    } else {
        // Otherwise, scroll right and keep the next button enabled
        imageGallery.scrollLeft += 850;
        nextButton.style.display = "flex";
    }
});
