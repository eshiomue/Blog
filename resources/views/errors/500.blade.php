<x-main-layout>
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Request processing error.</h3>
            <ol class="breadcrumb justify-content-center text-white mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('course/all') }}" class="text-white">Courses</a></li>
                <li class="breadcrumb-item"><a href="{{ url('faq') }}" class="text-white">FAQ</a></li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- 500 Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                    <h1 class="display-1">500</h1>
                    <h1 class="mb-4">Hush!</h1>
                    <p class="mb-4">Sorry, there was an error processing your request</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ url('/') }}">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 500 End -->
</x-main-layout>
