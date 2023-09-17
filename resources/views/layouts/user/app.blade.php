<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://daneden.github.io/animate.css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<!-- partial:index.partial.html -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
<link href="pure-js-slider.css" rel="stylesheet">
@include('layouts.user.header')
<div class="slider-container"><!-- PAGE-HEADER -->
@yield('content')
@include('layouts.user.footer')
</div>
</body>
@yield('model')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script type="text/javascript">


    $(document).ready(function () {

        var $slider = $(".slider"),
            $slideBGs = $(".slide__bg"),
            diff = 0,
            curSlide = 0,
            numOfSlides = $(".slide").length - 1,
            animating = false,
            animTime = 500,
            autoSlideTimeout,
            autoSlideDelay = 4000,
            $pagination = $(".slider-pagi");

        function createBullets() {
            for (var i = 0; i < numOfSlides + 1; i++) {
                var $li = $("<li class='slider-pagi__elem'></li>");
                $li.addClass("slider-pagi__elem-" + i).data("page", i);
                if (!i) $li.addClass("active");
                $pagination.append($li);
            }
        };

        createBullets();

        function manageControls() {
            $(".slider-control").removeClass("inactive");
            if (!curSlide) $(".slider-control.left").addClass("inactive");
            if (curSlide === numOfSlides) $(".slider-control.right").addClass("inactive");
        };

        function autoSlide() {
            autoSlideTimeout = setTimeout(function () {
                curSlide++;
                if (curSlide > numOfSlides) curSlide = 0;
                changeSlides();
            }, autoSlideDelay);
        };

        autoSlide();

        function changeSlides(instant) {
            if (!instant) {
                animating = true;
                manageControls();
                $slider.addClass("animating");
                $slider.css("top");
                $(".slide").removeClass("active");
                $(".slide-" + curSlide).addClass("active");
                setTimeout(function () {
                    $slider.removeClass("animating");
                    animating = false;
                }, animTime);
            }
            window.clearTimeout(autoSlideTimeout);
            $(".slider-pagi__elem").removeClass("active");
            $(".slider-pagi__elem-" + curSlide).addClass("active");
            $slider.css("transform", "translate3d(" + -curSlide * 100 + "%,0,0)");
            $slideBGs.css("transform", "translate3d(" + curSlide * 50 + "%,0,0)");
            diff = 0;
            autoSlide();
        }

        function navigateLeft() {
            if (animating) return;
            if (curSlide > 0) curSlide--;
            changeSlides();
        }

        function navigateRight() {
            if (animating) return;
            if (curSlide < numOfSlides) curSlide++;
            changeSlides();
        }

        $(document).on("mousedown touchstart", ".slider", function (e) {
            if (animating) return;
            window.clearTimeout(autoSlideTimeout);
            var startX = e.pageX || e.originalEvent.touches[0].pageX,
                winW = $(window).width();
            diff = 0;

            $(document).on("mousemove touchmove", function (e) {
                var x = e.pageX || e.originalEvent.touches[0].pageX;
                diff = (startX - x) / winW * 70;
                if ((!curSlide && diff < 0) || (curSlide === numOfSlides && diff > 0)) diff /= 2;
                $slider.css("transform", "translate3d(" + (-curSlide * 100 - diff) + "%,0,0)");
                $slideBGs.css("transform", "translate3d(" + (curSlide * 50 + diff / 2) + "%,0,0)");
            });
        });

        $(document).on("mouseup touchend", function (e) {
            $(document).off("mousemove touchmove");
            if (animating) return;
            if (!diff) {
                changeSlides(true);
                return;
            }
            if (diff > -8 && diff < 8) {
                changeSlides();
                return;
            }
            if (diff <= -8) {
                navigateLeft();
            }
            if (diff >= 8) {
                navigateRight();
            }
        });

        $(document).on("click", ".slider-control", function () {
            if ($(this).hasClass("left")) {
                navigateLeft();
            } else {
                navigateRight();
            }
        });

        $(document).on("click", ".slider-pagi__elem", function () {
            curSlide = $(this).data("page");
            changeSlides();
        });

    });

    const items = document.querySelectorAll(".accordion button");

    function toggleAccordion() {
        const itemToggle = this.getAttribute('aria-expanded');

        for (i = 0; i < items.length; i++) {
            items[i].setAttribute('aria-expanded', 'false');
        }

        if (itemToggle == 'false') {
            this.setAttribute('aria-expanded', 'true');
        }
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));


    const reviewWrap = document.getElementById("reviewWrap");
    const leftArrow = document.getElementById("leftArrow");
    const rightArrow = document.getElementById("rightArrow");
    const imgDiv = document.getElementById("imgDiv");
    const personName = document.getElementById("personName");
    const profession = document.getElementById("profession");
    const description = document.getElementById("description");
    const surpriseMeBtn = document.getElementById("surpriseMeBtn");
    const chicken = document.querySelector(".chicken");

    let isChickenVisible;

    let people = @json($feedbacks);

    imgDiv.style.backgroundImage = people.length >0? people[0].photo:'';
    personName.innerText = people.length >0? people[0].name:'';
    profession.innerText = people.length >0? people[0].profession:'';
    description.innerText = people.length >0? people[0].description:'';
    let currentPerson = 0;

    //Select the side where you want to slide
    function slide(whichSide, personNumber) {
        if (people.length === 0){

            return
        }
        let reviewWrapWidth = reviewWrap.offsetWidth + "px";
        let descriptionHeight = description.offsetHeight + "px";
        //(+ or -)
        let side1symbol = whichSide === "left" ? "" : "-";
        let side2symbol = whichSide === "left" ? "-" : "";

        let tl = gsap.timeline();

        if (isChickenVisible) {
            tl.to(chicken, {
                duration: 0.4,
                opacity: 0
            });
        }

        tl.to(reviewWrap, {
            duration: 0.4,
            opacity: 0,
            translateX: `${side1symbol + reviewWrapWidth}`
        });

        tl.to(reviewWrap, {
            duration: 0,
            translateX: `${side2symbol + reviewWrapWidth}`
        });

        setTimeout(() => {
            imgDiv.style.backgroundImage = people[personNumber].photo;
        }, 400);
        setTimeout(() => {
            description.style.height = descriptionHeight;
        }, 400);
        setTimeout(() => {
            personName.innerText = people[personNumber].name;
        }, 400);
        setTimeout(() => {
            profession.innerText = people[personNumber].profession;
        }, 400);
        setTimeout(() => {
            description.innerText = people[personNumber].description;
        }, 400);

        tl.to(reviewWrap, {
            duration: 0.4,
            opacity: 1,
            translateX: 0
        });

        if (isChickenVisible) {
            tl.to(chicken, {
                duration: 0.4,
                opacity: 1
            });
        }
    }

    function setNextCardLeft() {
        if (currentPerson === 3) {
            currentPerson = 0;
            slide("left", currentPerson);
        } else {
            currentPerson++;
        }

        slide("left", currentPerson);
    }

    function setNextCardRight() {
        if (currentPerson === 0) {
            currentPerson = 3;
            slide("right", currentPerson);
        } else {
            currentPerson--;
        }

        slide("right", currentPerson);
    }

    leftArrow.addEventListener("click", setNextCardLeft);
    rightArrow.addEventListener("click", setNextCardRight);

    surpriseMeBtn.addEventListener("click", () => {
        if (chicken.style.opacity === "0") {
            chicken.style.opacity = "1";
            imgDiv.classList.add("move-head");
            surpriseMeBtn.innerText = "Remove the chicken";
            surpriseMeBtn.classList.remove("surprise-me-btn");
            surpriseMeBtn.classList.add("hide-chicken-btn");
            isChickenVisible = true;
        } else if (chicken.style.opacity === "1") {
            chicken.style.opacity = "0";
            imgDiv.classList.remove("move-head");
            surpriseMeBtn.innerText = "Surprise me";
            surpriseMeBtn.classList.add("surprise-me-btn");
            surpriseMeBtn.classList.remove("hide-chicken-btn");
            isChickenVisible = false;
        }
    });

    window.addEventListener("resize", () => {
        description.style.height = "100%";
    });


</script>
@stack('js')
</html>
