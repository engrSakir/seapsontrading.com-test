@php
    $testimonialCaption = getContent('testimonial.caption',true);
    $testimonial = getContent('testimonial');
@endphp
@if($testimonialCaption)
    <section class="client-section padding-top">
        <div class="container mw-lg-100">
            <div class="client-area">
                <div class="owl-thumbs" data-slider-id="1">

                    @foreach($testimonial as $data)
                        <div class="owl-thumb-item">
                            <div class="thumb wow zoomIn" data-wow-duration="1s" >
                                <img src="{{get_image(config('constants.frontend.testimonial.path').'/'.$data->value->image)}}" alt="client">
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="client-slider-section">
                    <h2 class="title">{{$testimonialCaption->data_values->title}}</h2>
                    <div class="client-slider owl-carousel owl-theme" data-slider-id="1">

                        @foreach($testimonial as $data)
                            <div class="client-slide-item">
                                <blockquote>
                                    {{__($data->value->quote)}}
                                </blockquote>
                                <div class="author">
                                    <div class="author-thumb">
                                        <img src="{{get_image(config('constants.frontend.testimonial.path').'/'.$data->value->image)}}" alt="client">
                                    </div>
                                    <div class="author-content">
                                        <h6 class="sub-title"><a href="javascript:void(0)">{{__($data->value->author)}}</a></h6>
                                        <span>{{__($data->value->designation)}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
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
