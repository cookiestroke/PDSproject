<html>

<head>
    <?php require_once("header.php"); ?>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.min.js"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        #myCarousel img {
            /* Full height */
            height: 90.4%;
            width: 100%;
            opacity: 90%;

        }
    </style>
</head>

<body>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="ny.jpg" alt="First Slide">
                <div class="carousel-caption h3 font-weight-bold">
                    <h1 class="font-weight-bold" style="color:black;">We Do Secure</h3>
                        <p style="color:black;">Insuring Your Future… Today</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="ca.jpg" alt="Second Slide">
                <div class="carousel-caption h3 font-weight-bold">
                    <h1 class="font-weight-bold" style="color:black;">We Do Secure</h3>
                        <p style="color:black;">It’s fast, free, and secure</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="la.jpg" alt="Third Slide">
                <div class="carousel-caption h3 font-weight-bold">
                    <h1 class="font-weight-bold" style="color:black;">We Do Secure</h3>
                        <p style="color:black;">Apply for a home insurance or an auto insurance at affordable rates</p>
                </div>
            </div>
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

</body>

</html>