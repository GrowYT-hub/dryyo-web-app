@extends('layouts.user.app')

@section('page-header')
    <a data-bs-toggle="modal" data-bs-target="#largemodal">
        <button type="button" class="btn btn-primary">
            <i class="fe fe-plus me-2"></i> Add New User
        </button>
    </a>
@endsection
@section('content')
    @include('layouts.user.slider')
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="title">About Us</span>
                            <h2>We are leader in <br>Industrial market Since 1992</h2>
                        </div>
                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.
                        </div>

                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.
                        </div>

                        <ul class="list-style-one">
                            <li>Lorem Ipsum is simply dummy tex</li>
                            <li>Consectetur adipisicing elit</li>
                            <li>Sed do eiusmod tempor incididunt</li>
                        </ul>
                        <div class="btn-box">
                            <a data-toggle="modal" data-target="#myModal" class="slide__text-link"
                               style="font-family: 'Roboto', sans-serif;">Schedule Pickup</a>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <figure class="image-1"><a href="#" class="lightbox-image" data-fancybox="images"><img
                                    src="https://img.freepik.com/free-photo/front-view-young-female-with-washing-machine-white-wall_140725-107596.jpg"
                                    alt=""></a></figure>
                        <figure class="image-2"><a href="#" class="lightbox-image" data-fancybox="images">
                                <img style="width: 55%;"
                                     src="https://img.freepik.com/free-photo/young-african-american-man-doing-laundry_273609-23241.jpg"
                                     alt=""></a></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="sec-title text-center">
                <span class="title">6 STAGE PROCESS</span>
                <h2> FOR UNMATCHED GARMENT CARE</h2>
            </div>

            <div class="row">
                <div class="content-column col-lg-7 col-md-12 col-sm-12 ">
                    <img class="w-100"
                         src="https://as1.ftcdn.net/v2/jpg/05/26/21/46/1000_F_526214657_V2qVR9f6NQxe1cBUR0gXEHgYCNiPd3vg.webp">
                </div>
                <div class="content-column col-lg-5 col-md-12 col-sm-12 ">
                    <div>
                        <h2 class="text-process">Specialized Machinery & Skilled Experts for each stage makes us the
                            best laundry & dry cleaner near you. </h2> <br><br>

                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.
                        </div>

                        <div class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.
                        </div>

                        <div class="btn-box">
                            <a data-toggle="modal" data-target="#myModal" class="slide__text-link"
                               style="font-family: 'Roboto', sans-serif;">Schedule Pickup</a>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>

    <section class="container">
        <div class="sec-title text-center">
            <span class="title">Our Happy Customer </span>
            <h2> Feedback </h2>
        </div>
        <div class="row">

            <div class="col-md-5">
                <div>
                    <img class="review_img" src="{{ asset('assets/user/img/cloth.png') }}">
                </div>
            </div>

            <div class="col-md-7">
                <div class="content-wrapper">
                    <div class="wrapper-for-arrows">
                        <div style="opacity: 0;" class="chicken"></div>
                        <div id="reviewWrap" class="review-wrap">
                            <div id="imgDiv" class="">
                            </div>
                            <div id="personName"></div>
                            <div id="profession"></div>
                            <div id="description">
                            </div>
                        </div>
                        <div class="left-arrow-wrap arrow-wrap">
                            <div class="arrow" id="leftArrow"></div>
                        </div>
                        <div class="right-arrow-wrap arrow-wrap">
                            <div class="arrow" id="rightArrow"></div>
                        </div>
                    </div>
                </div>


                <div class="btn-box">
                    <center>
                        <a data-toggle="modal" data-target="#myModal2" class="slide__text-link" style="font-family: 'Roboto', sans-serif;">Enter Your Feedback</a>
                    </center>
                </div>

            </div>

        </div>
    </section>

    <div class="box_div">
        <div class="sec-title text-center">
            <span class="title">FAQ</span>
            <h2> Frequently Asked Questions</h2>
        </div>
        <div class="accordion">
            <div class="accordion-item">
                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Why is the moon sometimes out during the day?</span><span
                        class="icon" aria-hidden="true"></span></button>
                <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo
                        duis ut. Ut tortor pretium viverra suspendisse potenti.Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse
                        potenti.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut
                        tortor pretium viverra suspendisse potenti.Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo
                        duis ut. Ut tortor pretium viverra suspendisse potenti.Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse
                        potenti.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo
                        duis ut. Ut tortor pretium viverra suspendisse potenti.Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse
                        potenti.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut
                        tortor pretium viverra suspendisse potenti.</p>

                </div>
            </div>
            <div class="accordion-item">
                <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Why is the sky blue?</span><span
                        class="icon" aria-hidden="true"></span></button>
                <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.</p>
                </div>
            </div>
            <div class="accordion-item">
                <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Will we ever discover aliens?</span><span
                        class="icon" aria-hidden="true"></span></button>
                <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.</p>
                </div>
            </div>
            <div class="accordion-item">
                <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">How much does the Earth weigh?</span><span
                        class="icon" aria-hidden="true"></span></button>
                <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.</p>
                </div>
            </div>
            <div class="accordion-item">
                <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">How do airplanes stay up?</span><span
                        class="icon" aria-hidden="true"></span></button>
                <div class="accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium
                        viverra suspendisse potenti.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('model')
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <center><h4 class="modal-title">Schedule Free Pick Up</h4></center>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('assets/user/img/schedule.png') }}">
                        </div>
                        <div class="col-md-6">
                            <form id="send-whatsapp" method="POST">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" placeholder="Your Name..">

                                <label for="lname">Whatsapp Number</label>
                                <input type="text" id="lname" name="to"
                                       placeholder="Enter Your Whatsapp Number">


                                <label for="address">Address</label>
                                <textarea id="address" name="address" placeholder="Write Your Address.."
                                          style="height:100px"></textarea>


                                <label for="subject">Subject</label>
                                <textarea id="subject" name="message" placeholder="Write something.."
                                          style="height:150px"></textarea>

                                <center><input class="text-center slide__text-link" type="button" onclick="onSubmit()" value="Submit"></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function onSubmit() {
            const formData = $('#send-whatsapp').serializeArray();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: `{{ route("request-form") }}`,
                data: formData,
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function(response) {
                    toastr.success(response.message);
                    $("#send-whatsapp")[0].reset();
                    $('#myModal').modal('hide');

                },
                error: function(xhr, status, error) {
                    // Handle errors
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors){
                            showToasts(errors);
                        }else {
                            toastr.error(xhr.responseJSON.message);
                        }
                    } else {
                        console.error(error);
                    }
                }
            });
        }
    </script>
@endpush
