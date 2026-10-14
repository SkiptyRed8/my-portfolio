<?php
/*
 * Home / About page
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 */
require_once __DIR__ . '/includes/db.php';

$pageTitle  = 'Bonaobra Portfolio';
$activePage = 'home';
$base       = '';
require __DIR__ . '/includes/header.php';
?>
        <section id="home">
            <div class="hero fadeUp">
                <div class="profilePic">
                    <img src="images/myProfile.png" alt="Profile Image" width="300" height="420">
                </div>
                <div class="hero-texts">
                    <p class="welcome">Welcome to my portfolio!</p>
                    <h1>Hi I'm <span class="name">Amalyn Bonaobra</span></h1>
                    <h4> <span class="aspiring">Aspiring</span> Designer <span class="aspiring">&</span><br>
                        Web Developer
                    </h4>
                    <button>
                        <a href="#projects">
                            <span>View my work</span>
                            <img src="imageIcon/arrow-down-svgrepo-com.svg" alt="">
                        </a>
                    </button>
                    <div class="home-socials-icon">
                        <a href="https://www.instagram.com/krngg_kringg"><img src="imageIcon/insta-icon.svg" alt="Instagram logo"></a>
                        <a href="https://www.facebook.com/share/1CEg3AhzrJ/?mibextid=wwXIfr"><img src="imageIcon/fb-icon.svg" alt="Facebook logo"></a>
                        <a href="https://www.linkedin.com/feed/"><img src="imageIcon/linkedin-icon.svg" alt="LinkedIn logo"></a>
                    </div>
                </div>
            </div>
        </section>
        <section id="about-me">
            <div class="content-about autoShow">
                <h1>ABOUT <span>ME</span></h1>
                <div class="heading">
                    <h2>IT Student | Aspiring Web Designer & Developer</h2>
                </div>
                <div class="aboutme-long-card">
                    <p>
                        I’m an IT student who loves two things: making websites work well and making them look great. To 
                        me, a good website shouldn't be a puzzle for the user, it should be easy to use, fast, and nice to
                        look at.
                        I spend most of my time building web apps and figuring out how to make them feel natural for
                        anyone who visits. Even though I’m focused on web development and design, I’m also a huge fan
                        of learning new things. Whether it’s picking up a new coding language or trying out a new design
                        tool, I’m always working to get better at my craft.
                        I love the challenge of taking a simple idea and turning it into something real that people can
                        actually use. I'm always looking for new projects to dive into, so let’s build something useful and
                        beautiful together.
                    </p>
                    <div class="aboutme-more-info">
                        <div class="ewq">
                            <img src="imageIcon/education.svg" alt="Education Icon">
                            <span class="education">
                                <h4>Education</h4>
                                <p>
                                    Bachelor of Science 
                                    in Information Technology
                                </p>
                            </span>
                        </div>
                        <div class="ewq">
                            <img src="imageIcon/heart.svg" alt="Heart Icon">
                            <span class="web-dev">
                                <h4>Web Development</h4>
                                <p>
                                    UI/UX Design, reading 
                                    Tech Blog
                                </p>
                            </span>
                        </div>
                        <div class="ewq">
                            <img src="imageIcon/location.svg" alt="Location Icon">
                            <span class="address">
                                <h4>Quezon City,</h4>
                                <p>
                                    Philippines
                                </p>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="skills">
            <div class="content-skills autoShow">
                <h1>SKILL<span>S</span></h1>
                <div class="skills-container">
                    <div class="tech-skills">
                        <h4>TECHNICAL SKILLS</h4>
                        <div class="web-related-skills">
                            <img src="imageIcon/html.svg" alt="HTML Logo">
                            <img src="imageIcon/css3.svg" alt="CSS3 Logo">
                            <img src="imageIcon/javascript.svg" alt="Javascript Logo">
                        </div>
                            <br>
                            <p>Other</p>
                        <div class="other-skills">
                            <br>
                            <img src="imageIcon/java.svg" alt="Java Logo">
                            <img src="imageIcon/c.svg" alt="C Language Logo" width="88" height="87">
                            <img src="imageIcon/linux.svg" alt="Linux Logo">
                        </div>
                    </div>
                    <div class="soft-skills">
                        <h4>SOFT SKILLS</h4>
                        <ul>
                            <li>
                                <p>
                                    <span>Problem Solving:</span> Enjoys finding smart, simple
                                    fixes for tricky coding or design bugs.
                                </p>
                            </li>
                            <li>
                                <p>
                                    <span>Teamwork:</span> Works well with others and
                                    communicates clearly to get the job done.</p>
                            </li>
                            <li>
                                <p>
                                    <span>Adaptability:</span> Picks up new programming
                                    languages and design tools quickly.
                                </p>
                            </li>
                            <li>
                                <p>
                                    <span>Time Management:</span> Stays organized and hits
                                    deadlines without rushing the quality.
                                </p>
                            </li>
                            <li>
                                <p>
                                    <span>Attention to Detail:</span> Focuses on the small things to
                                    make sure every project is polished.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="projects">
            <div class="content-projects autoShow">
                <h1><span>P</span>ROJECTS</h1>
                <div class="gallery slider">
                    <img src="imageIcon/arrow-prev-small-svgrepo-com.svg" alt="" class="prev">
                    <div class="slider-track">
                        <a href="https://github.com/SkiptyRed8/simple_digital_clock_java_gui" target="_blank" class="gallery-card">
                            <figure>
                                <figcaption>Digital Clock</figcaption>
                                <div class="img-desc">
                                    <div class="project-img"><img src="images/clock.png" alt="Digital Clock"></div>
                                    <p>
                                        A real-time digital clock application built
                                        using Java and the Swing Library
                                    </p>
                                    <button> <a href="https://github.com/SkiptyRed8/simple_digital_clock_java_gui" target="_blank" >Source Code</a><img src="imageIcon/go-to-web.svg
                                        " alt=""></button>
                                </div>
                            </figure>
                        </a>
                        <a href="https://github.com/SkiptyRed8/Student_management_system_java" target="_blank" class="gallery-card">
                            <figure>
                                <figcaption>Student Management System</figcaption>
                                <div class="img-desc">
                                    <div class="project-img"><img src="images/library.png" alt="Student Management System"></div>
                                    <p>Java-based student record system to manage student data.</p>
                                    <button><a href="https://github.com/SkiptyRed8/Student_management_system_java" target="_blank">Source Code </a><img src="imageIcon/go-to-web.svg
                                        " alt=""></button>
                                </div>
                            </figure>
                        </a>
                        <a href="https://amalyntbonaobra.wixsite.com/my-site-1" target="_blank" class="gallery-card">
                            <figure>
                                <figcaption>College Activities Journal</figcaption>
                                    <div class="img-desc"> <div class="project-img"><img src="images/journal.png" alt="Activities Journal Website"></div>
                                    <p>College Activities compilation website built with Wix!</p>
                                    <button><a href="https://amalyntbonaobra.wixsite.com/my-site-1" target="_blank">View Project </a><img src="imageIcon/go-to-web.svg
                                        " alt=""></button>
                                </div>
                            </figure>
                        </a>
                    </div>
                    <img src="imageIcon/arrow-next-small-svgrepo-com (1).svg" alt="" class="next">
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="content-contact autoShow">
                <h1>CONTAC<span>T</span></h1>
                <div class="contact-cta">
                    <p>Have a project in mind or just want to say hi? I'd love to hear from you.</p>
                    <a href="contact.php" class="btn-gold">Get in touch</a>
                </div>
            </div>
        </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
