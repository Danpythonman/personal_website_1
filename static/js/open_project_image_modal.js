function openModal(eventNode) {
    const modal = document.getElementById("project-image-modal");
    const modalMedia = document.getElementById("project-image-modal-media");
    const modalTitle = document.getElementById("project-image-modal-title");
    const modalDescription = document.getElementById("project-image-modal-description");

    // The media clicked is either an image or a video, and they must be handled separately.

    if (eventNode.nodeName.toLowerCase() == "img") {
        const modalImage = document.createElement("img");

        modalImage.src = eventNode.src;
        modalImage.alt = eventNode.alt;

        modalImage.id = "project-image-modal-image";

        modalImage.onclick = closeModal;

        modalMedia.appendChild(modalImage);
    } else if (eventNode.nodeName.toLowerCase() == "video") {
        const modalVideo = document.createElement("video");

        modalVideo.muted = true;
        modalVideo.autoplay = true;
        modalVideo.loop = true;

        let modalSource;

        for (let source = eventNode.firstChild; source !== null; source = source.nextSibling) {
            if (source.nodeName.toLowerCase() == "source") {
                modalSource = document.createElement("source");

                modalSource.src = source.src;
                modalSource.type = source.type;

                modalVideo.appendChild(modalSource);
            }
        }

        modalVideo.id = "project-image-modal-image";

        modalVideo.onclick = closeModal;

        modalMedia.appendChild(modalVideo);
    }

    // Get the parent node of the image that was clicked
    let currentNode = eventNode.parentNode.firstChild;

    // Loop through the children nodes (the sibling nodes of the image that was clicked)
    while (currentNode != null) {
        if (currentNode.nodeName.toLowerCase() == "h4") {
            // The h4 node is the title of the image, so use it as the modal title
            modalTitle.innerHTML = currentNode.innerHTML;
        } else if (currentNode.nodeName.toLowerCase() == "p") {
            // The p node is the description of the image, so use it as the modal description
            modalDescription.innerHTML = currentNode.innerHTML;
        }

        currentNode = currentNode.nextSibling;
    }

    // Show the modal
    modal.style.display = "flex";
}

function closeModal(eventNode) {
    // If the modal's image, title, or description was clicked, then do not close the modal.
    // If the modal was clicked anywhere else, then close the modal.
    if (eventNode.id != undefined
        && eventNode.id != "project-image-modal-media"
        && eventNode.id != "project-image-modal-image"
        && eventNode.id != "project-image-modal-title"
        && eventNode.id != "project-image-modal-description"
    ) {
        // Remove image or video from modal
        document.getElementById("project-image-modal-media").innerHTML = "";

        // Close modal
        document.getElementById("project-image-modal").style.display = "none";
    }
}
