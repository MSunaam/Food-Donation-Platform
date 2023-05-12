<div class="col-md-4">
    <div class="card cardZoom" id="{{ $id }}">
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <lottie-player src="{{ $link }}"  background="transparent"  speed="{{ $speed }}"  style="width: 175px; height: 150px;" {{ $hover }} loop style="z-index: -1;"  ></lottie-player>
        </div>
    </div>
</div>
