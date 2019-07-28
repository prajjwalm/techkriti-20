<?php
//session_start();
//if (empty($_SESSION['techid'])) {
//    session_destroy();
//} else {
//    header("Location: dashboard.php");
//}

// ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../session'));
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <meta name = "keywords" content = "Techkriti, Techkriti 20, TOSC, Open, School, Championship, Competition, 2019">
    <meta name = "Description" content = "Official Page for techkriti Open School Championship 2019">
    <meta name = "theme-color" content = "#103d87">

    <title>TOSC '19</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

    <!-- External Styles-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
    <link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />
    <link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />
    <link href="assets/icons/fa/css/all.min.css" rel="stylesheet">

    <!-- My Styles -->
    <link type="text/css" rel="stylesheet" href="css/build/style.css" />
    <link type="text/css" rel="stylesheet" href="css/self.css" />

    <script src="js/jquery-3.2.1.min.js"></script>

    <script src="js/dash.js"></script>
    <script src="js/dashboard/session.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="assets/icons/favicon.ico" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header id="home">
    <div class="bg-img" style="background-image: url('assets/images/flicker.jpg'); object-fit:contain;">
        <div class="overlay" style = "opacity:0.1;"></div>
    </div>
    <nav id="nav" class="navbar nav-transparent">
        <div id="nav-container" class="container">
            <div class="navbar-header">
                <div class="navbar-text-header">
                    T<span class="large-width-header-text">echkriti</span>
                    O<span class="large-width-header-text">pen </span>
                    S<span class="large-width-header-text">chool</span>
                    C<span class="large-width-header-text">hampionship</span>
                </div>
                <span id = "data-x03" style = ""></span>
                <div class="nav-collapse">
                    <span></span>
                </div>
            </div>
            <ul class="main-nav nav navbar-nav navbar-right">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#conduction">Conduction</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <!--ul class ="dropdown">
                    <li><a href="#team">Hall of fame</a></li>
                    <li><a href="#team">Current Members</a></li>
                </ul-->
                <li><a href="#prizes">Prizes</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact-us">Contact Us</a></li>
            </ul>
        </div>
        <div id="fixed-side-links" class = "social-box">
            <a href="https://www.facebook.com/tosc.iitk/"><i class="fab fa-facebook-square"></i></a>
            <a href="http://www.youtube.com/techkritiIITK"><i class="fab fa-youtube"></i></a>
            <a href="https://twitter.com/techkriti_iitk"><i class="fab fa-twitter-square"></i></a>
            <a href="https://www.instagram.com/techkriti.iitk/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/school/techkriti'13"><i class="fab fa-linkedin"></i></a>
        </div>
        <div id="tologin">
            <button class="btn" type="button" onclick="location.href = 'login.html';"><span>Sign up</span></button>
            <?php if (empty($_SESSION['techid'])): ?>
                <button class="btn" type="button" id="to_dashboard"><span>Sign in</span></button>
            <?php else: ?>
                <button class="btn" type="button" onclick="location.href = 'dashboard.php';"><span>Proceed to dashboard</span></button>
            <?php endif; ?>
<!--            <button class="btn" disabled type="button" id="to_dashboard" title="Dashboard will open in a few days"><span>Sign in</span></button>-->
        </div>
    </nav>
</header>
<div class="section md-padding" id = "about" style = "min-height: 80vh;">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="title">About Us</h2>
            </div>
            <div class="dual-box">
                <div class = "right">
                    <div class="section-desc vlarge" style="min-height: 180px; box-sizing: border-box;">
                        <h3> What is Techkriti? </h3>
                        <p> <span style="font-weight: bold;">Techkriti</span> is an annual international technical and entrepreneurial festival organized by the
                            students of IIT Kanpur. The festival is held over four days every March, attracting participants
                            from every corner of the country as well as from abroad, comprising a total footfall of over
                            60,000 from all over India and abroad.
                        </p>
                    </div>
                </div>
                <div class = "left small" style="height: 180px; box-sizing: border-box;">
                    <img src="assets/images/techkriti-logo.png" alt=""/>
                </div>
            </div>

            <div class="dual-box">
                <div class = "right">
                    <img src="assets/images/nbk.png" alt=""/>
                </div>
                <div class = "left large">
                    <div class="section-desc">
                        <h4> What is TOSC? </h4>
                        <p> <span style="font-weight: bold;">Techkriti Open School Championship</span> is an annual aptitude examination for classes 9th to 12th
                            conducted and organized by Techkriti, IIT Kanpur. The championship consists of two phases in
                            which the students will form a team of two to compete for the coveted championship. The Phase 1
                            is conducted in both languages (English and Hindi) and the question paper comprises of Mental
                            Ability, Aptitude, Puzzles. The top 50 teams from each pool will get an opportunity to visit IIT
                            Kanpur for the final phase, where they will be further tested upon some additional activities to
                            decide the overall winners. No previous knowledge is required to participate, the only
                            prerequisite is enthusiasm and confidence.
                        </p>
                        <h4> Why TOSC? </h4>
                        <p> Our mission is to strengthen and cultivate the talent of our nation at the grassroots level,
                            which serves our sole motive. Through a series of events involving mental aptitude, logic, and
                            scrutiny, it seeks to provide school students a platform to gain fundamental experience and
                            knowledge, to exercise coordination skills, and to think out of the box while providing
                            solutions never thought before.

                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="section sm-padding bg-grey" id="conduction" style = "min-height: 80vh;">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="title">Conduction</h2>
            </div>
            <div class="row-bar emboss">
                <div class="descriptor">
                    <img src="assets/images/phase1.jpg" alt="">
                </div>
                <div class="description">
                    <h3> Phase 1 </h3>
                    <div class="section-desc">
                        This round consists of an exam to be held in your respective cities which will consist of
                        objective type questions on aptitude, reasoning and general awareness. Participants will
                        have to form a team of two to participate in this phase. The duration of the exam will be of
                        90 mins. Top 50 teams from each pool will be invited to IIT Kanpur for Phase II
                    </div>
                </div>
            </div>

            <div class="row-bar emboss">
                <div class="descriptor">
                    <img src="assets/images/phase1-results.jpg" alt="">
                </div>
                <div class="description">
                    <h3> Phase 1 Results </h3>
                    <div class="section-desc">
                        Phase 1 results will be announced on 3rd November. The results will be made available on the
                        website. The e-Certificates of participation will be available on the TOSC website after the
                        result declaration.
                    </div>
                </div>
            </div>

            <div class="row-bar emboss">
                <div class="descriptor">
                    <img src="assets/images/phase2.jpg" alt="">
                </div>
                <div class="description">
                    <h3> Phase 2 </h3>
                    <div class="section-desc">
                        This round will comprise of puzzles, and competitive activities which will not only decide
                        the winner but also help the participants explore and enhance their cognitive and analytical
                        skills. Also there will be various exhibitions, technical workshops and talks (by some
                        renowned professors of IIT Kanpur) as a part of Phase 2.
                    </div>
                </div>
            </div>
            <div class = "row-bar emboss">
                <div class="tabs">

                    <input type="radio" id="tab1" name="tab-control" checked>
                    <input type="radio" id="tab2" name="tab-control">
                    <!--						<input type="radio" id="tab3" name="tab-control">-->
                    <!--						<input type="radio" id="tab4" name="tab-control">-->
                    <ul>
                        <li ><label for="tab1" role="button">
                            <br><span>Registration Process</span></label>
                        </li>
                        <li ><label for="tab2" role="button">
                            <br><span>Selection Procedure</span></label>
                        </li>
                        <!--							<li title="Shipping"><label for="tab3" role="button">-->
                        <!--								<br><span>Shipping</span></label>-->
                        <!--							</li>-->
                        <!--							<li title="Returns"><label for="tab4" role="button">-->
                        <!--								<br><span>Returns</span></label>-->
                        <!--							</li>-->
                    </ul>
                    <div class="slider"><div class="indicator"></div></div>
                    <div class="content">
                        <section>
                            <h2>Registration Process</h2>
                            Students are required to form a team consisting of 2 members (of same pool and same school).
                            Registration fee for a team is Rs.300. Clicking the 'Sign up' button on the right would lead
                            you to a form filling which would enable you to create an account. Signing in to that account
                            and paying the registration fees would complete the process.
                        </section>
                        <section>
                            <h2>Selection Procedure</h2>
                            Each round consists of two pools:<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;Pool A: Class 9th - 10th <br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;Pool B: Class 11th -12th <br/>
                            Top 50 teams from each pool, selected on the basis of their performance in phase 1 will
                            be given the opportunity to visit IIT Kanpur to compete for phase 2.
                        </section>
                        <!--							<section>-->
                        <!--								<h2>Shipping</h2>-->
                        <!--								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam nemo ducimus eius, magnam error quisquam sunt voluptate labore, excepturi numquam! Alias libero optio sed harum debitis! Veniam, quia in eum.-->
                        <!--							</section>-->
                        <!--							<section>-->
                        <!--								<h2>Returns</h2>-->
                        <!--								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa dicta vero rerum? Eaque repudiandae architecto libero reprehenderit aliquam magnam ratione quidem? Nobis doloribus molestiae enim deserunt necessitatibus eaque quidem incidunt.-->
                        <!--							</section>-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="section sm-padding" id = "testimonials">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="title">Testimonials</h2>
            </div>
            <div id = "testimonial_container">
                <div class ="testimonial_box">
                    <h3>Aryan A. Barsaniyan - TOSC Topper (Pool A)</h3>
                    <div class="testimonial_video">
                        <iframe src="https://youtube.com/embed/cCDOPuoRpjQ"  frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="section-desc">
                        "It was a great pleasure to become a part of Techkriti Open School Championship,
                        at IIT-Kanpur. It provided a great platform to my idea and ideas of many such children
                        like me. The campus was amazingly big and robotics class was quite fruitful. Above all,
                        meeting and listening to Professor H. C. Verma was like the icing on the cake. Finally,
                        when I was declared as one of the winners from POOL-A, it was just like the cherry on
                        the icing of the cake. To sum up, I would like to say that some experiences in our life
                        are so important from every point of view that it is totally worth to attain one and the
                        same goes for me in the case of TOSC."
                    </div>
                </div>
                <div class ="testimonial_box">
                    <h3>Anand Krishna - TOSC Topper (Pool B)</h3>
                    <div class = "testimonial_video">
                        <iframe  src="https://youtube.com/embed/zd9g9Xn_lIQ"  frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="section-desc">
                        "My gratitude to IIT Kanpur and TOSC who fuelled my scientific pursuits through the
                        current honour knows no bounds. This achievement gives me courage to go further in
                        figuring out scientific solutions to everyday necessities of life which have social
                        relevance as well. Apart from the sheer happiness of earning this prestigious accolade,
                        my journey from the southern tip of India to this renowned temple of scientific excellence
                        in a faraway northern state gave me a rare chance to earn firsthand experience of my
                        county as a whole and the current frontiers of academic research. TOSC has changed my
                        personal outlook and academic pursuits."
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section sm-padding bg-dark"  id="prizes" style = "min-height: 80vh;">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="title">Prizes</h2>
        </div>
        <div class="section-subheader">
            <span style="font-size: 32px;">For Winners</span>
        </div>
        <div class="row">
            <!-- div class="major-prize-container">
                <div class="bg">
                    <img src="assets/images/isro.jpg" alt="">
                    <div class="overlay">
                        <h2>Tour to ISRO, Bangalore</h2>
                        <p>Winning teams from both the pools will be taken to a guided tour to ISRO, Bangalore</p>
                    </div>
                </div>
                <div class="bg">
                    <img src="assets/images/barc.jpg" alt="">
                    <div class="overlay">
                        <h2>Tour to BARC, Mumbai</h2>
                        <p>2nd and 3rd teams from both pools will be taken to a guided tour to Bhabha Atomic
                            Research Center, Mumbai</p>
                    </div>
                </div>
            </div -->


            <div class="col-md-12 col-xs-12 work major">
                <img class="img-responsive" src="assets/images/isro.jpg" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>Winning teams from both the pools</span>
                    <h3>Tour to ISRO, Bangalore</h3>
                </div>
            </div>
        </div>
        <div class="section-subheader">
            <span style="font-size: 32px;">And many more ...</span>

        </div>
        <div class = "row">
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/medals.png" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>to top 3 teams</span>
                    <h3>gold, silver & bronze medals</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/kindle.jpg" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>1st Prize</span>
                    <h3>kindle</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/smart_speaker.jpg" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>2nd Prize</span>
                    <h3>smart speaker</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/smart_watch.jpg" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>3rd Prize</span>
                    <h3>smart watches</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/trophy.jpg" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>to top 10 teams from each pool</span>
                    <h3>trophies</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/gold_medals.png" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span> to city toppers</span>
                    <h3>gold medals</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/tshirts.jpg" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>to phase 2 participants</span>
                    <h3>T-shirts</h3>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 work">
                <img class="img-responsive" src="assets/images/cert.png" alt="">
                <div class="overlay"></div>
                <div class="work-content">
                    <span>to the top 250 teams in each pool</span>
                    <h3>rank certificates</h3>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="section sm-padding" id="faq" style = "min-height: 80vh;">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="title">FAQ</h2>
            </div>
            <div class = "faq_accordion">
                <div class="faq-tabs">
                    <div class="tab">
                        <input type="checkbox" id="chck1">
                        <label class="tab-label" for="chck1">I have trouble using the site on mobile. What should I do?
                        </label>
                        <div class="tab-content">
                            Open the site on PC [or] Enable desktop version (can be found in browser options) [or] Try
                            using any other browser
                        </div>
                    </div>
                    <div class="tab">
                        <input type="checkbox" id="chck2">
                        <label class="tab-label" for="chck2">What is the Syllabus of TOSC?
                        </label>
                        <div class="tab-content">
                            TOSC is an exam filled with fascinating and intriguing questions that test your logical
                            reasoning and thinking skills. If you think your analytical abilities are sharp and clear,
                            then just sit for the exam with a pen and a Fresh Mind!!
                        </div>
                    </div>

                    <div class="tab">
                        <input type="checkbox" id="chck3">
                        <label class="tab-label" for="chck3">What are the pre-requisites to appear in TOSC?
                        </label>
                        <div class="tab-content">
                            No previous knowledge is required to participate, the only prerequisite is enthusiasm and
                            confidence.
                        </div>
                    </div>

                    <div class="tab">
                        <input type="checkbox" id="chck4">
                        <label class="tab-label" for="chck4">Even though my school is not tied up with TOSC, can I participate?
                        </label>
                        <div class="tab-content">
                            Yes. Every student pursuing school (class 9th-12th) can enroll for TOSC. Exam centre
                            allotted is also irrespective of School you are from.
                        </div>
                    </div>
                    <div class="tab">
                        <input type="checkbox" id="chck5">
                        <label class="tab-label" for="chck5">Is there any offline mode of registration?
                        </label>
                        <div class="tab-content">
                            Yes, there are various schools and coachings where offline facility will be availabe.You
                            have to confirm with your institute authorities whether offline forms are available in your institute.
                        </div>
                    </div>
                    <div class="tab">
                        <input type="checkbox" id="chck6">
                        <label class="tab-label" for="chck6">Can I change my team member after registration?
                        </label>
                        <div class="tab-content">
                            No
                        </div>
                    </div>
                    <div class="tab">
                        <input type="checkbox" id="chck7">
                        <label class="tab-label" for="chck7">Can I change my team member for Phase 2 after qualifying Phase 1?
                        </label>
                        <div class="tab-content">
                            No
                        </div>
                    </div>
                    <div class="tab">
                        <input type="checkbox" id="chck8">
                        <label class="tab-label" for="chck8">Will I and my teammate be given a single or different OMR sheets?
                        </label>
                        <div class="tab-content">
                            One OMR sheet will be provided per team. You can interact with your team member while
                            solving the questions and mark your answers.
                        </div>
                    </div>
                    <div class="tab">
                        <input type="checkbox" id="chck9">
                        <label class="tab-label" for="chck9">When will we receive our admit card for the exam?
                        </label>
                        <div class="tab-content">
                            If you have paid the registration fee, then you will receive your admit card a few days
                            before the exam
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section sm-padding bg-grey" id="sponsors" style = "display: none; min-height: 80vh;">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="title">Sponsors</h2>
            </div>
                <div class = "sponsor-space">
                </div>
        </div>
    </div>
</div>
<div class="section sm-padding bg-dark" id="contact-us" style = "min-height: 80vh;">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="title">Contact Us</h2>
            </div>
            <div style ="width: 100%; display: flex; justify-content: space-evenly; flex-wrap: wrap;">
                <div class="team">
                    <div class="team-img">
                        <img class="img-responsive" src="assets/images/devendra.jpg" alt="">
                        <div class="overlay">
                            <div class="team-social">
                                <a href="https://www.facebook.com/profile.php?id=100017384439930"><i class="fab fa-facebook-square"></i></a>
                                <a href="mailto:devendra@techkriti.org"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-content">
                        <h3>Devendra Kumar</h3>
                        <span>Head Show Management</span> <br/>
                        <span>+91-9929937399</span>
                    </div>
                </div>
                <div class="team">
                    <div class="team-img">
                        <img class="img-responsive" src="assets/images/osama.jpg" alt="">
                        <div class="overlay">
                            <div class="team-social">
                                <a href="https://www.facebook.com/siddiqui.osama"><i class="fab fa-facebook-square"></i></a>
                                <a href="mailto:osama@techkriti.org"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-content">
                        <h3>Osama Siddiqui</h3>
                        <span>Head Show Management</span> <br/>
                        <span>+91-9198999317</span>
                    </div>
                </div>
                <div class="team">
                    <div class="team-img">
                        <img class="img-responsive" src="assets/images/vishal.jpg" alt="">
                        <div class="overlay">
                            <div class="team-social">
                                <a href="https://www.facebook.com/profile.php?id=100007637491173"><i class="fab fa-facebook-square"></i></a>
                                <a href="mailto:vishal@techkriti.org"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-content">
                        <h3>Vishal Kumar</h3>
                        <span>Festival Coordinator</span> <br/>
                        <span>+91-9643776705</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="modal-shadow" style="display: none;">
    <div id="modal-login">
        <div class = "section-header text-center">
            <h3 class="title">Login To Dashboard</h3>
        </div>
        <div class = "row">
            <div id = "email" class="main-input cell l">
                <div class="group">
                    <input type="email" class="xinput" id="email_input" placeholder="&nbsp;" required >
                    <label for="email_input">Email Address *</label>
                    <div class="bar"></div>
                </div>
            </div>
        </div>

        <div class = "row">
            <div id = "password" class = "main-input cell">
                <div class="group">
                    <input type="password" class="xinput" id="password_input" placeholder="&nbsp;" minlength="4" required/>
                    <label for="password_input">Password</label>
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <div class="btn-space">
            <input type="submit" class="main-btn" id="login_submit"/>
        </div>
    </div>
</div>

<div id="back-to-top"><i class="fas fa-arrow-up"></i></div>
<div id="preloader" style = "background: #000;">
    <div class="preloader" style = "background: #000;">
        <img src="assets/svg/preloader-fast.svg" alt="" style ="width:216px;"/>
    </div>
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>