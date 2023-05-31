@extends('layouts.plantilla')


@section('title', 'Panel de Colaboradores')

@section('content')


<style>
#main-panel-colaboradores h3 {
    text-align: center;
}

.team-boxed {
    color: #313437;
    background-color: #eef4f7;
}

.team-boxed p {
    color: #7d8285;
}

.team-boxed h2 {
    font-weight: bold;
    margin-bottom: 40px;
    padding-top: 40px;
    color: inherit;
}

@media (max-width:767px) {
    .team-boxed h2 {
        margin-bottom: 25px;
        padding-top: 25px;
        font-size: 24px;
    }
}

.team-boxed .intro {
    font-size: 16px;
    max-width: 500px;
    margin: 0 auto;
}

.team-boxed .intro p {
    margin-bottom: 0;
}

.team-boxed .people {
    padding: 50px 60px;
}

.team-boxed .item {
    text-align: center;
}

.team-boxed .item .box {
    text-align: center;
    padding: 30px;
    background-color: #fff;
    margin-bottom: 30px;
}

.team-boxed .item .name {
    font-weight: bold;
    margin-top: 28px;
    margin-bottom: 8px;
    color: inherit;
}

.team-boxed .item .title {
    text-transform: uppercase;
    font-weight: bold;
    color: #d0d0d0;
    letter-spacing: 2px;
    font-size: 13px;
}

.team-boxed .item .description {
    font-size: 15px;
    margin-top: 15px;
    margin-bottom: 20px;
}

.team-boxed .item img {
    max-width: 160px;
}

.team-boxed .social {
    font-size: 18px;
    color: #a2a8ae;
}

.team-boxed .social a {
    color: inherit;
    margin: 0 10px;
    display: inline-block;
    opacity: 0.7;
}

.team-boxed .social a:hover {
    opacity: 1;
}
</style>
<main id='main-panel-colaboradores'>
    @php
    $embajadores = App\Models\User::where('id_colaborador', 2)->get();
    $mentores = App\Models\User::where('id_colaborador', 3)->get();
    $instituto = App\Models\User::where('id_colaborador', 4)->get();

    @endphp



    <h2>Panel de Colaboradores</h2>
    <h3>Embajadores</h3>

    <h3>Mentores</h3>

    <div id="myCarousel" class="carousel slide myCarousel" data-bs-ride="carousel" >
        <div class="carousel-inner">
            @php
            $totalMentores = count($mentores);
            $slides = ceil($totalMentores / 3);
            $currentSlide = 0;
            @endphp

            @for ($i = 0; $i < $slides; $i++) <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                <div class="team-boxed">
                    <div class="container">
                        <div class="row people">
                            @php
                            $startIndex = $currentSlide * 3;
                            $endIndex = min(($currentSlide + 1) * 3, $totalMentores);
                            $count = 0;

                            for ($j = $startIndex; $j < $endIndex; $j++) { $mentor=$mentores[$j]; @endphp <div
                                class="col-md-6 col-lg-4 item">
                                <div class="box">
                                    <img class="rounded-circle card-img-top"
                                        src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1568709978/BBBootstrap/2.jpg">
                                    <h3 class="name">{{ $mentor->nombre }}</h3>
                                    <p class="title">Mentor</p>
                                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus
                                        lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et
                                        interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa.</p>
                                    <div class="social">
                                        <a href="#"><i class="fa fa-facebook-official"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                        </div>

                        @php
                        $count++;
                        }

                        // Si la diapositiva actual no tiene suficientes elementos, agregar elementos del principio
                        if ($count < 3) { $remaining=3 - $count; for ($k=0; $k < $remaining; $k++) {
                            $mentor=$mentores[$k]; @endphp <div class="col-md-6 col-lg-4 item">
                            <div class="box">
                                <img class="rounded-circle card-img-top"
                                    src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1568709978/BBBootstrap/2.jpg">
                                <h3 class="name">{{ $mentor->nombre }}</h3>
                                <p class="title">Mentor</p>
                                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus
                                    lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et
                                    interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa.</p>
                                <div class="social">
                                    <a href="#"><i class="fa fa-facebook-official"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                    </div>

                    @php
                    }
                    }
                    $currentSlide++;
                    @endphp

                </div>
        </div>
    </div>
    </div>
    @endfor

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>




    {{-- @foreach ($colaboradores as $colaborador)
            @if ($colaborador->tipoColaborador == 'Mentor')
                @php
                    $mentores = App\Models\Colaborador::where('tipoColaborador', 'Mentor')->get();
                @endphp


                @foreach ($mentores as $mentor)
                    <div class="card">
                        <div class="media media-2x1 gd-primary">
                            <img class="profile-image"
                                src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1568709978/BBBootstrap/2.jpg"
                                width="15%">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Delbert Simonas</h5>
                            <p class="card-text">"Online reviews can make or break a customer's decision to make a purchase.
                                Read about these customer review on site"</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach --}}

</main>

@endsection