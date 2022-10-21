<div id="welcome-section">
    <div class="section">
        <h1>Welcome!</h1>
        <img src="<?= CDN_URL ?>images/me.jpg">
        <p>
            I'm <b>Daniel Di Giovanni</b>, a programming professional, student, and hobbyist.
            I'm in my third year of studying software engineering at York University, but I've been programming for about five years in total.
        </p>
    </div>
    <div id="scroll-down-prompt">
        <p>
            <a id="scroll-link" href="#homepage-projects-section" class="paragraph">Scroll On To Read More</a>
        </p>
        <a href="#homepage-projects-section">
            <div href="#homepage-projects-section">
                <div id="arrow-1">&#10095;</div>
                <div id="arrow-2">&#10095;</div>
                <div id="arrow-3">&#10095;</div>
            </div>
        </a>
    </div>
</div>
<div id="homepage-projects-section" class="section">
    <div>
        <div>
            <h2 class="subheading">My Projects</h2>
            <p class="paragraph">
                I mentioned that I've been programming for about five years.
                Most of that has been my own personal projects that I made for fun or for learning.
                I'm always trying to learn more and I feel very rewarded seeing the progress of my personal projects.
            </p>
        </div>
        <a href="<?= '/' . BASE_URL_DIRECTORY . 'projects' ?>" alt="View my projects">
            <video class="image-link" muted autoplay loop>
                <source src="<?= CDN_URL ?>videos/projects_overview.webm" type="video/webm">
                <source src="<?= CDN_URL ?>videos/projects_overview.mp4" type="video/mp4">
            </video>
        </a>
    </div>
    <a class="link-button button-2" href="<?= '/' . BASE_URL_DIRECTORY . 'projects' ?>">View my projects</a>
</div>
<div id="homepage-resume-section" class="section">
    <a class="link-button button-3" href="<?= '/' . BASE_URL_DIRECTORY . 'resume' ?>">Read my resume</a>
    <div>
        <h2 class="subheading">My Professional Experience</h2>
        <p class="paragraph">
            Working as a professional programmer is the newest programming experience for me, and is also what I'm currently looking for.
            My goal is to gain experience with working in software development teams and to program more substantial systems.
        </p>
    </div>
</div>
<div id="homepage-horizontal-line"></div>
<div id="homepage-contact-section" class="section">
    <h2 class="subheading">Let's Get in Touch</h2>
    <p class="paragraph">
        Have any questions or feedback?
        Feel free to get in touch with me!
        Connect with me on <a class="link" href="https://www.linkedin.com/in/daniel-di-giovanni/">LinkedIn</a>, or send me an message directly on the <a class="link" href="<?= '/' . BASE_URL_DIRECTORY . 'contact' ?>">contact page</a>.
    </p>
    <a class="link-button button-4" href="<?= '/' . BASE_URL_DIRECTORY . 'contact' ?>">Contact Me</a>
</div>
<script src="<?= CDN_URL ?>js/homepage_scroll_prompt.js"></script>
