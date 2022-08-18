@extends('layouts.app')

@section('content')
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="https://img.freepik.com/free-vector/doctor-examining-patient-clinic-illustrated_23-2148856559.jpg?t=st=1654573681~exp=1654574281~hmac=29ccf402349c261e38522788395dd1adc352140c96c2c551d7f490f1e8319aca&w=1380"
                    class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold lh-1 mb-4 " style="color:#5928E5 ">Welcome to high quality patient care</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda nobis accusamus
                    dolorem consequuntur ratione. Minima?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a class="btn btn-secondary btn-lg px-4 me-md-2" href="{{ route('login') }}">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5" id="custom-cards">
        <h2 class="pb-2 text-center fw-bold display-5">What we offer</h2>

        <div class="container px-4 py-5" id="icon-grid">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3 fa-primary" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="fa-solid fa-circle flex-shrink-0 me-3" style="color:#5928E5 "></i>
                    <div>
                        <h4 class="fw-bold mb-0">Featured title</h4>
                        <p>Paragraph of text beneath the heading to explain the heading.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
