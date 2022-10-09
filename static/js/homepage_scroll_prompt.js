document.addEventListener("scroll", () => {
    const scrollAmount = document.body.scrollTop || document.documentElement.scrollTop;
    const promptPosition = document.getElementById("scroll-down-prompt").offsetTop;

    distance = promptPosition - scrollAmount;

    const firstArrow = document.getElementById("arrow-1");
    const secondArrow = document.getElementById("arrow-2");
    const thirdArrow = document.getElementById("arrow-3");
    const scrollLink = document.getElementById("scroll-link");

    const mainColor = getComputedStyle(document.documentElement).getPropertyValue('--main-color');
    const accentColor = getComputedStyle(document.documentElement).getPropertyValue('--accent-color');
    const attentionColor = getComputedStyle(document.documentElement).getPropertyValue('--attention-color');

    if (distance > 400) {
        scrollLink.style.textDecorationColor = "";
        firstArrow.style.color = accentColor;
        secondArrow.style.color = mainColor;
        thirdArrow.style.color = accentColor;
        secondArrow.style.textShadow = "";
    } else if (distance <= 400 && distance > 300) {
        scrollLink.style.textDecorationColor = attentionColor;
        firstArrow.style.color = accentColor;
        secondArrow.style.color = mainColor;
        thirdArrow.style.color = accentColor;
        secondArrow.style.textShadow = "";
    } else if (distance <= 300 && distance > 200) {
        scrollLink.style.textDecorationColor = attentionColor;
        firstArrow.style.color = attentionColor;
        secondArrow.style.color = mainColor;
        thirdArrow.style.color = accentColor;
        secondArrow.style.textShadow = "";
    } else if (distance <= 200 && distance > 100) {
        scrollLink.style.textDecorationColor = attentionColor;
        firstArrow.style.color = attentionColor;
        secondArrow.style.color = attentionColor;
        thirdArrow.style.color = accentColor;
        secondArrow.style.textShadow = "none";
    } else if (distance <= 100 && distance > 0) {
        scrollLink.style.textDecorationColor = attentionColor;
        firstArrow.style.color = attentionColor;
        secondArrow.style.color = attentionColor;
        thirdArrow.style.color = attentionColor;
        secondArrow.style.textShadow = "none";
    } else {
        scrollLink.style.textDecorationColor = attentionColor;
        firstArrow.style.color = attentionColor;
        secondArrow.style.color = attentionColor;
        thirdArrow.style.color = attentionColor;
        secondArrow.style.textShadow = "none";
    }
});
