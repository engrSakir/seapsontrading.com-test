@php
    $faqCaption = getContent('faq.caption',true);
    $faqs = getContent('faq');
@endphp
@if($faqCaption)

    <!-- ========Faq-Section Starte Here ========-->
    <section class="faq-section padding darkmode">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-header">
                        <h2 class="title">{{__(@$faqCaption->data_values->title)}}</h2>
                        <p>{{__(@$faqCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center justify-content-lg-between">

                <div class="col-lg-12 col-xl-12">
                    <div class="faq-wrapper style-two">


                        @foreach($faqs as $k=>$data)
                            <div class="faq-item @if($k==0)  open active @endif">
                                <h6 class="faq-title">{{__($data->value->title)}}</h6>
                                <div class="faq-content">
                                    <p>@php echo $data->value->body @endphp</p>
                                </div>
                            </div>

                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========Faq-Section Ends Here ========-->

@endif

