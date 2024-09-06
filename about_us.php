<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About CodeConnect</title>
    <link rel="stylesheet" href="home.css">
    <style>
        footer{
            margin-top: 29vh;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: #e1efff; */
            background: #fff5df;
        }
        .main-section{
            margin: 10px 30px 10px 25px;
        }

        /* Header styles */
        .about-heading {
            text-align: center;
            margin: 20px;
            margin-top: 110px;
        }

        /* Section styles */
        .section-heading {
            font-size: 24px;
            margin-top: 20px;
        }

        .section-content {
            margin-bottom: 20px;
        }

        /* Developer info styles */
        .developer-name {
            font-size: 18px;
            margin-top: 10px;
        }

        .developer-description {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include 'dependencies/_nav.php'; ?>
    <header>
        <h1 class="about-heading">About CodeConnect</h1>
    </header>
    <main class="main-section">
        <section class="about-section">
            <h2 class="section-heading">Overview</h2>
            <p class="section-content">Welcome to CodeConnect, your go-to platform for connecting with fellow developers, sharing knowledge, and collaborating on coding projects. Our community is dedicated to fostering a vibrant and supportive environment for developers of all skill levels.</p>
        </section>

        <section class="about-section">
            <h2 class="section-heading">Our Team</h2>
            <div class="developer-info">
                <h3 class="developer-name">Front-end Developer - Beriston Coutinho</h3>
                <p class="developer-description">Beriston Coutinho is our talented front-end developer who crafts the user interfaces and ensures a seamless user experience on CodeConnect. With a passion for creating beautiful and user-friendly websites, Beriston brings creativity and innovation to our platform.</p>
            </div>
            <div class="developer-info">
                <h3 class="developer-name">Back-end Developer - Cliffton Andrade</h3>
                <p class="developer-description">Cliffton Andrade is our back-end wizard responsible for the server-side functionality and database management of CodeConnect. With expertise in building robust and scalable web applications, Cliffton ensures the technical backbone of our platform runs smoothly.</p>
            </div>
        </section>

        <section class="about-section">
            <h2 class="section-heading">Our Mission</h2>
            <p class="section-content">At CodeConnect, our mission is to empower developers by providing a platform where they can learn, collaborate, and grow. We aim to create a supportive community where knowledge is freely shared, innovation and making things better for others.</p>
        </section>

        

    </main>
    <?php include 'dependencies/_footer.php'; ?>
</body>

</html>