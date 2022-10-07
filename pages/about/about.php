<div class="page-header">
    <div class="section">
        <h1 class="page-title">About Me</h1>
        <p class="paragraph">More about me, beyond software development.</p>
    </div>
</div>
<div class="section">
    <p id="first-element" class="paragraph">
        Hi! I'm Daniel Di Giovanni. Since you're on this website, you probably already know that I program both as a hobby and professionally.
        I'm also a student at York University, in my third year of studying software engineering.
        My main hobby is (clearly) programming; I've always had a fascination with computers and how technical problems can be solved so elegantly with math and software.
        But I also love reading!
        Scroll down to see what I've been learning in school and what I've been reading.
    </p>
</div>
<div class="section">
    <h2 class="subheading">Education</h2>
    <p class="paragraph">
        Below are some of the courses I've completed and topics I've learned.
    </p>
    <h3 class="subsubheading">Data Structures</h3>
    <p class="paragraph newline">
        In second year I took a computer science course on data structures.
        I learned the fundamental data structures, like arrays, linked lists, stacks, queues, and trees.
        Then we went a step further and explored topics like binary search trees and heaps.
        We also explored many related topics along the way, like mathematical analysis of data structure operations (big O) and using data structures to implement algorithms (like heap sort).
    </p>
    <p class="paragraph">
        I thoroughly enjoyed this course and it really opened my eyes to how software engineering can be rigorous and scientific.
        After the course, I started a <a class="link" href="https://github.com/Danpythonman/data_structures_java" alt="Data structures in Java GitHub repository" target="_blank">Java project</a> implementing all the data structures I learned.
    </p>
    <h3 class="subsubheading">Advanced Object-Oriented Programming</h3>
    <p class="paragraph">
        This course solidified my understanding of OOP and the Java programming language.
        We started by discussing classes, objects, and reference vs. primitive values.
        From there, we covered more advanced topics, like inheritance, polymorphism, and programming with generics.
        All of these topics were taught as theory, then demonstrated through Java.
        Without this course, I would lack a full, rigorous understanding of Java that has enabled me to complete more intense projects like <a class="link" href="/<?= BASE_URL_DIRECTORY . 'projects/tab2xml' ?>" alt="TAB2XML project" target="_blank">TAB2XML</a>.
    </p>
    <h3 class="subsubheading">Other</h3>
    <p class="paragraph newline">Here are some other courses I've and concepts I've learned at university:</p>
    <ul class="list">
        <li><span>Discrete mathematics and writing proofs</span></li>
        <li><span>Calculus, linear algebra, and other mathematics</span></li>
        <li><span>Statistics</span></li>
        <li><span>Effective Engineering Communication</span></li>
    </ul>
</div>
<div class="section">
    <h2 class="subheading">Reading!</h2>
    <p class="paragraph newline">
        Here are some of the books I've been reading!
    </p>
    <div id="currently-reading">
        <?php
            $query = 'SELECT * FROM books WHERE currently_reading=TRUE LIMIT 1';

            $result = mysqli_query($db, $query);

            if (!$result) {
                throw new CustomException("There was an error with the database. This one's on our end.", 500);
            }

            $book = mysqli_fetch_assoc($result);

        ?>
            <a href="<?= $book['book_url'] ?>" alt="<?= $book['title'] ?> by <?= $book['author'] ?>">
                <img class="image-link" src="<?= $book['image_url'] ?>" alt="<?= $book['title'] ?> by <?= $book['author'] ?>">
            </a>
            <div>
                <a href="<?= $book['book_url'] ?>" alt="<?= $book['title'] ?> by <?= $book['author'] ?>">
                    <h3 class="subheading link"><?= $book['title'] ?></h3>
                </a>
                <p class="paragraph">by <?= $book['author'] ?></p>
            </div>
        <?php

            mysqli_free_result($result);
        ?>
    </div>
    <p class="paragraph newline">
        Check out
        <a class="link" href="https://www.goodreads.com/user/show/126424416-daniel-di-giovanni" alt="Daniel Di Giovanni's GoodReads profile">my GoodReads profile</a>
        to see more! Here are some of my favorite books:
    </p>
    <div id="favorite-books">
        <?php
            $query = 'SELECT * FROM books WHERE currently_reading=FALSE';

            $books = mysqli_query($db, $query);

            if (!$books) {
                exit('Database query failed');
            }

            while ($book = mysqli_fetch_assoc($books)) {
        ?>
            <a href="<?= $book['book_url'] ?>" alt="<?= $book['title'] ?> by <?= $book['author'] ?>">
                <img class="image-link" src="<?= $book['image_url'] ?>" alt="<?= $book['title'] ?> by <?= $book['author'] ?>">
            </a>
        <?php
            }

            mysqli_free_result($books);
        ?>
    </div>
</div>
