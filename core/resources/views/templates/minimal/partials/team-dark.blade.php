@php
    $teamCaption = getContent('team.caption',true);
    $team = getContent('team');
@endphp
@if($teamCaption)

<section class="team-section padding darkmode">
    <div class="container">
        <div class="section-header">
            <h2 class="title">{{__(@$teamCaption->data_values->title)}}</h2>
            <p>{{__(@$teamCaption->data_values->short_details)}}</p>
        </div>
        <div class="row justify-content-center mb-30-none">

            @foreach($team as $data)
            <div class="col-sm-10 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="team-item">
                    <div class="team-thumb">
                        <a href="javascript:void(0)">
                            <img src="{{get_image(config('constants.frontend.team.path').'/'.$data->value->image)}}" alt="team">
                        </a>
                    </div>
                    <div class="team-content">
                        <h4 class="title mt-0">
                            <a href="javascript:void(0)">{{__(@$data->value->name)}}</a>
                        </h4>
                        <span>{{__(@$data->value->designation)}}</span>
                        <ul class="social-icons-team d-flex flex-wrap justify-content-center">
                            <li>
                                <a href="{{@$data->value->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="{{@$data->value->twitter}}"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{@$data->value->pinterest}}"><i class="fab fa-pinterest-p"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>
@endif
