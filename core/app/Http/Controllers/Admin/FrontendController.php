<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use App\Page;
use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Image;
use File;


class FrontendController extends Controller
{
    public function blogIndex()
    {
        $page_title = 'Blog Post';
        $empty_message = 'No blog post yet.';
        $blog = Frontend::where('data_keys', 'blog.caption')->latest()->firstOrFail();
        $blog_posts = Frontend::where('data_keys', 'blog.post')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.blog.index', compact('page_title', 'empty_message', 'blog', 'blog_posts'));
    }

    public function blogNew()
    {
        $page_title = 'New Post';
        return view('admin.frontend.blog.new', compact('page_title'));
    }

    public function blogEdit($id)
    {
        $page_title = 'Edit Post';
        $post = Frontend::findOrFail($id);
        return view('admin.frontend.blog.edit', compact('page_title', 'post'));
    }

    public function seoEdit()
    {
        $page_title = 'SEO Configuration';
        $seo = Frontend::where('data_keys', 'seo')->first();
        if (!$seo) {
            $notify[] = ['error', 'Something went wrong or not functioning properly, contact developer.'];
            return back()->withNotify($notify);
        }
        return view('admin.frontend.seo.edit', compact('page_title', 'seo'));
    }

    public function testimonialIndex()
    {
        $page_title = 'Testimonials';
        $empty_message = 'No testimonials';

        $caption = Frontend::where('data_keys', 'testimonial.caption')->latest()->first();
        $testimonials = Frontend::where('data_keys', 'testimonial')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.testimonial.index', compact('page_title', 'empty_message', 'testimonials', 'caption'));
    }

    public function testimonialNew()
    {
        $page_title = 'New Testimonial';
        return view('admin.frontend.testimonial.new', compact('page_title'));
    }

    public function testimonialEdit($id)
    {
        $page_title = 'Edit Testimonial';
        $testi = Frontend::findOrFail($id);
        return view('admin.frontend.testimonial.edit', compact('page_title', 'testi'));
    }

    public function socialIndex()
    {
        $page_title = 'Social Icons';
        $empty_message = 'No social icons';
        $socials = Frontend::where('data_keys', 'social.item')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.social.index', compact('page_title', 'empty_message', 'socials'));
    }

    public function store(Request $request)
    {
        $validation_rule = ['key' => 'required'];
        foreach ($request->except('_token') as $input_field => $val) {
            if ($input_field == 'has_image') {
                $validation_rule['image_input'] = ['required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, [], ['image_input' => 'image']);

        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($request->key, $request->image_input)]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }

        Frontend::create([
            'data_keys' => $request->key,
            'data_values' => $request->except('_token', 'key', 'image_input'),
        ]);

        $notify[] = ['success', 'Content has been added.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $validation_rule = [];
        foreach ($request->except('_token', 'video') as $input_field => $val) {
            if ($input_field == 'image_input' && !isset($validation_rule['image_input'])) {
                $validation_rule['image_input'] = ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }

            $validation_rule[$input_field] = 'required';
        }

        $request->validate($validation_rule, [], ['image_input' => 'image']);

        $content = Frontend::findOrFail($request->id);
        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($content->data_keys, $request->image_input, $content->data_values->image
                )]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        } else if (isset($content->data_values->image)) {
            $request->merge(['image' => $content->data_values->image]);
        }


        $content->update(['data_values' => $request->except('_token', 'image_input', 'key', 'status')]);

        $notify[] = ['success', 'Content has been updated.'];
        return back()->withNotify($notify);
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required']);
        $frontend = Frontend::findOrFail($request->id);
        if (isset($frontend->data_values->image)) {
            remove_file(config('constants.frontend.' . $frontend->data_keys . '.path') . '/' . $frontend->data_values->image);
        }
        $frontend->delete();
        $notify[] = ['success', 'Content has been removed.'];
        return back()->withNotify($notify);
    }

    protected function store_image($key, $image, $old_image = null)
    {
        $path = config('constants.frontend.' . $key . '.path');
        $size = config('constants.frontend.' . $key . '.size');
        $thumb = config('constants.frontend.' . $key . '.thumb');
        return upload_image($image, $path, $size, $old_image, $thumb);
    }

    // FAQ Management

    public function faqIndex()
    {
        $page_title = 'FAQ';
        $empty_message = 'No FAQ create yet.';
        $blog = Frontend::where('data_keys', 'faq.caption')->latest()->firstOrFail();
        $blog_posts = Frontend::where('data_keys', 'faq')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.faq.index', compact('page_title', 'empty_message', 'blog_posts','blog'));
    }

    public function faqNew()
    {
        $page_title = 'Add New FAQ';
        return view('admin.frontend.faq.new', compact('page_title'));
    }

    public function faqEdit($id)
    {
        $page_title = 'Edit FAQ';
        $post = Frontend::where('id', $id)->where('data_keys', 'faq')->firstOrFail();
        return view('admin.frontend.faq.edit', compact('page_title', 'post'));
    }

    // Rule
    public function ruleIndex()
    {
        $page_title = 'All Rule';
        $empty_message = 'No Rule create yet.';
        $blog = Frontend::where('data_keys', 'rules.caption')->latest()->firstOrFail();
        $blog_posts = Frontend::where('data_keys', 'rules')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.rules.index', compact('page_title', 'empty_message', 'blog_posts','blog'));
    }

    public function ruleNew()
    {
        $page_title = 'Add New Rule';
        return view('admin.frontend.rules.new', compact('page_title'));
    }

    public function ruleEdit($id)
    {
        $page_title = 'Edit Rule';
        $post = Frontend::where('id', $id)->where('data_keys', 'rules')->firstOrFail();
        return view('admin.frontend.rules.edit', compact('page_title', 'post'));
    }

    // Company Policy
    public function companyPolicy()
    {
        $page_title = 'Company Policy';
        $empty_message = 'No Policy yet.';
        $blog_posts = Frontend::where('data_keys', 'company_policy')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.policy.index', compact('page_title', 'empty_message', 'blog_posts'));
    }

    public function companyPolicyNew()
    {
        $page_title = 'Add New Policy';
        return view('admin.frontend.policy.new', compact('page_title'));
    }

    public function companyPolicyEdit($id)
    {
        $page_title = 'Edit Policy';
        $post = Frontend::findOrFail($id);
        return view('admin.frontend.policy.edit', compact('page_title', 'post'));
    }


    public function latestTrx(){
        $page_title = 'Latest Transaction';
        $blog = Frontend::where('data_keys', 'latestTrx.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.latestTrx', compact('page_title', 'blog'));
    }
    public function topInvestor(){
        $page_title = 'Top Investor Caption';
        $blog = Frontend::where('data_keys', 'investor.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.investorCaption', compact('page_title', 'blog'));
    }
    public function statistics(){
        $page_title = 'Our statistics Caption';
        $blog = Frontend::where('data_keys', 'statistics.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.statisticsCaption', compact('page_title', 'blog'));
    }


    public function planHeading(){
        $page_title = 'Plan Heading';
        $blog = Frontend::where('data_keys', 'plan.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.plan-caption', compact('page_title', 'blog'));
    }
    public function weAcceptHeading(){
        $page_title = 'We Accept Heading';
        $blog = Frontend::where('data_keys', 'weAccept.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.weAccept-caption', compact('page_title', 'blog'));
    }
    public function subscribeHeading(){
        $page_title = 'Subscribe Heading';
        $blog = Frontend::where('data_keys', 'subscribe.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.subscribe-heading', compact('page_title', 'blog'));
    }
    public function callToAction(){
        $page_title = 'Call To Action';
        $blog = Frontend::where('data_keys', 'callToAction.caption')->latest()->firstOrFail();
        return view('admin.frontend.section.callToAction', compact('page_title', 'blog'));
    }





    public function sectionContact()
    {
        $page_title = 'Manage Contact';
        $post = Frontend::where('data_keys', 'contact')->firstOrFail();
        return view('admin.frontend.section.contact', compact('page_title', 'post'));
    }


    public function servicesIndex()
    {
        $page_title = 'Services';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'services.caption')->firstOrFail();
        $howItWorks = Frontend::where('data_keys', 'services')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.services.index', compact('page_title', 'empty_message', 'howItWorks','blog'));
    }


    public function profitIndex()
    {
        $page_title = 'HOW TO GET PROFIT';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'profit.caption')->latest()->first();
        $howItWorks = Frontend::where('data_keys', 'profit')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.profit.index', compact('page_title', 'empty_message', 'howItWorks', 'blog'));
    }


    public function featureIndex()
    {
        $page_title = 'Our Feature';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'feature.caption')->latest()->first();
        $howItWorks = Frontend::where('data_keys', 'feature')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.feature.index', compact('page_title', 'empty_message', 'howItWorks', 'blog'));
    }


    public function logoIcon()
    {
        $page_title = 'Breadcrumb Image & Icon';
        return view('admin.frontend.logo_icon', compact('page_title'));
    }

    public function logoIconUpdate(Request $request)
    {

        if ($request->hasFile('page_header')) {
            $image = $request->file('page_header');
            $filename = 'page-header-01.png';
            $location = 'assets/images/frontend/breadcrumb/' . $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('coin')) {
            $image = $request->file('coin');
            $filename = 'coin.png';
            $location = 'assets/images/frontend/breadcrumb/' . $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('tree1')) {
            $image = $request->file('tree1');
            $filename = 'tree1.png';
            $location = 'assets/images/frontend/footer/' . $filename;
            Image::make($image)->save($location);
        }

        if ($request->hasFile('coin_icon')) {
            $image = $request->file('coin_icon');
            $filename = 'coin1.png';
            $location = 'assets/images/frontend/footer/' . $filename;
            Image::make($image)->save($location);
        }


        if ($request->hasFile('tree2')) {
            $image = $request->file('tree2');
            $filename = 'tree2.png';
            $location = 'assets/images/frontend/footer/' . $filename;
            Image::make($image)->save($location);
        }


        $notify[] = ['success', 'Updated Successfully.'];
        return back()->withNotify($notify);
    }



    // Manage About
    public function sectionAbout()
    {
        $page_title = 'Manage About';
        $post = Frontend::where('data_keys', 'about.caption')->firstOrFail();
        return view('admin.frontend.section.about', compact('page_title', 'post'));

    }

    public function sectionAboutUpdate(Request $request, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'about.caption')->firstOrFail();

        $in['title'] = $request->title;
        $in['sub_title'] = $request->sub_title;
        $in['details'] = $request->details;
        $in['video_link'] = $request->video_link;

        if ($request->hasFile('image')) {
            @unlink('assets/images/frontend/' . @$data->data_values->image);
            $image = $request->file('image');
            $filename = 'about-minimul.' . strtolower($image->getClientOriginalExtension());
            $location = 'assets/images/frontend/' . $filename;
            Image::make($image)->save($location);
            $in['about'] = $filename;
        }else{
            $in['about'] = @$data->data_values->about;
        }

        $data->data_values = $in;
        $data->save();

        $notify[] = ['success', 'Update Successfully.'];
        return back()->withNotify($notify);
    }

    public function sectionBanner()
    {
        $page_title = 'Manage Banner';
        $post = Frontend::where('data_keys', 'banner.caption')->firstOrFail();
        return view('admin.frontend.section.banner', compact('page_title', 'post'));

    }

    public function sectionBannerUpdate(Request $request, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'banner.caption')->firstOrFail();

        $in['title'] = $request->title;
        $in['sub_title'] = $request->sub_title;


        if ($request->hasFile('image')) {
            @unlink('assets/images/frontend/' . @$data->data_values->image);
            $image = $request->file('image');
            $filename = 'banner.' . strtolower($image->getClientOriginalExtension());
            $location = 'assets/images/frontend/' . $filename;
            Image::make($image)->save($location);
            $in['about'] = $filename;
        }else{
            $in['about'] = @$data->data_values->about;
        }

        $data->data_values = $in;
        $data->save();

        $notify[] = ['success', 'Update Successfully.'];
        return back()->withNotify($notify);
    }


    public function sectionCalculator()
    {
        $page_title = 'Calculation Content';
        $post = Frontend::where('data_keys', 'calculation.caption')->firstOrFail();
        return view('admin.frontend.section.calculation', compact('page_title', 'post'));

    }

    public function sectionCalculatorUpdate(Request $request, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'calculation.caption')->firstOrFail();

        $in['title'] = $request->title;
        $in['sub_title'] = $request->sub_title;


        if ($request->hasFile('image')) {
            @unlink('assets/images/frontend/' . @$data->data_values->image);
            $image = $request->file('image');
            $filename = 'profit_cal.' . strtolower($image->getClientOriginalExtension());
            $location = 'assets/images/frontend/' . $filename;
            Image::make($image)->save($location);
            $in['profit_cal'] = $filename;
        }else{
            $in['profit_cal'] = @$data->data_values->profit_cal;
        }

        $data->data_values = $in;
        $data->save();

        $notify[] = ['success', 'Update Successfully.'];
        return back()->withNotify($notify);
    }



    public function teamIndex()
    {
        $page_title = 'Our Team';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'team.caption')->latest()->first();
        $howItWorks = Frontend::where('data_keys', 'team')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.team.index', compact('page_title', 'empty_message', 'howItWorks', 'blog'));
    }

    public function teamNew()
    {
        $page_title = 'Add New';
        return view('admin.frontend.team.new', compact('page_title'));
    }

    public function teamEdit($id = null)
    {
        $page_title = 'Edit Team';
        $testi = Frontend::where('id', $id)->where('data_keys', 'team')->firstOrFail();

        return view('admin.frontend.team.edit', compact('page_title', 'testi'));
    }



    public function counterIndex()
    {
        $page_title = 'Counter Section';
        $empty_message = 'No Data Found';
        $blog = Frontend::where('data_keys', 'counter.caption')->latest()->first();
        $howItWorks = Frontend::where('data_keys', 'counter')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.counter.index', compact('page_title', 'empty_message', 'howItWorks', 'blog'));
    }




    public function managePages()
    {
        //// HOME PAGE

              $count = Page::where('tempname',activeTemplate())->where('slug','home')->count();
                if($count == 0){
                $in['tempname'] = activeTemplate();
                $in['name'] = 'HOME';
                $in['slug'] = 'home';
                Page::create($in);
        }



        $pdata = Page::where('tempname',activeTemplate())->get();
        $page_title = 'Manage Section';
        $empty_message = 'No Page Created Yet';




        return view('admin.frontend.builder.pages', compact('page_title','pdata','empty_message'));
    }

    public function managePagesSave(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
        ]);

$exist = Page::where('tempname', activeTemplate())->where('slug', str_slug($request->slug))->count();
if($exist != 0){
        $notify[] = ['error', 'This Page Already Exist on your Current Template. Please Change the Slug.'];
        return back()->withNotify($notify);
}

        $in['tempname'] = activeTemplate();
        $in['name'] = $request->name;
        $in['slug'] = str_slug($request->slug);

        Page::create($in);
        $notify[] = ['success', 'Save Successfully'];
        return back()->withNotify($notify);

    }

    public function managePagesUpdate(Request $request){

        $page = Page::where('id',$request->id)->first();


        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3|unique:pages,slug,'.$page->id,
        ]);



        $page->name = $request->name;
        $page->slug = str_slug($request->slug);
        $page->save();


        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);

    }

    public function managePagesDelete(Request $request){
        $page = Page::where('id',$request->id)->first();
        $page->delete();

        $notify[] = ['success', 'Delete Successfully'];
        return back()->withNotify($notify);
    }



    public function manageSection($id)
    {
        $pdata = Page::findOrFail($id);
        $page_title = 'Manage Section of '.$pdata->name;

$sectionsUrl = resource_path('views/').str_replace('.', '/', activeTemplate()).'sections.json';
$sections =  json_decode(file_get_contents($sectionsUrl),true);
asort($sections);


        return view('admin.frontend.builder.index', compact('page_title','pdata','sections'));
    }



    public function manageSectionUpdate($id, Request $request)
    {
        $request->validate([
            'secs' => 'required',
        ],[
            'secs.required' => 'Page should Contain Minimum One Section'
        ]);

        $page = Page::findOrFail($id);
        $page->secs = json_encode($request->secs);
        $page->save();
        $notify[] = ['success', 'Update Successfully'];
        return back()->withNotify($notify);

    }





}
