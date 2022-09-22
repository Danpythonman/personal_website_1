function openModal(eventNode) {
    const modal = document.getElementById("project-image-modal");
    const modalImage = document.getElementById("project-image-modal-image");
    const modalTitle = document.getElementById("project-image-modal-title");
    const modalDescription = document.getElementById("project-image-modal-description");

    modalImage.src = eventNode.src;
    modalImage.alt = eventNode.alt;

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
    if (eventNode.id != "project-image-modal-image"
        && eventNode.id != "project-image-modal-title"
        && eventNode.id != "project-image-modal-description"
    ) {
        document.getElementById("project-image-modal").style.display = "none";
    }
}
