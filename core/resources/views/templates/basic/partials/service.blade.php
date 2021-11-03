@php
    $serviceCaption = getContent('services.caption',true);
    $services = getContent('services');
@endphp
@if($serviceCaption)


    <section class="padding feature-section">
        <div class="container">


            <div class="row justify-content-center ">
                <div class="col-10 text-center">
                    <div class="section-header mb-5">
                        <h2 class="title">{{__(@$serviceCaption->data_values->title)}} </h2>
                        <p class="section-para">{{__(@$serviceCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-30-none">
                @foreach($services as $k => $data)
                    <div class="col-md-6 col-sm-10 col-xl-4">
                        <div class="section-feature-item">
                            <div class="feature-thumb">
                                <?php echo @$data->data_values->icon ?>
                            </div>
                            <div class="feature-content">
                                <h3 class="title">{{__(@$data->data_values->title)}}</h3>
                                <p>
                                    {{__(@$data->data_values->short_details)}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <div class="sec-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec"></div>
                </div>
            </div>
        </div>
    </div>
@endif

