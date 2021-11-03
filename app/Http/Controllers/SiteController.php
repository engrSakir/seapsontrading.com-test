<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\GeneralSetting;
use App\Invest;
use App\Language;
use App\Page;
use App\Plan;
use App\Subscriber;
use App\UserWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function home()
    {
        $data['page_title'] = 'Home';
        $data['sections'] = Page::where('tempname',activeTemplate())->where('slug','home')->firstOrFail();
        return view(activeTemplate() . 'home', $data);
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',activeTemplate())->where('slug',$slug)->firstOrFail();
        $data['page_title'] = $page->name;
        $data['sections'] = $page;
        return view(activeTemplate() . 'pages', $data);
    }


    public function rules()
    {
        $page_title = "RULES & REGULATION";
        $rules = Frontend::where('data_keys', 'rules')->get();
        $ruleheads = Frontend::where('data_keys', 'rules.caption')->latest()->first();
        return view(activeTemplate() . 'rules', compact('rules', 'page_title', 'ruleheads'));
    }


    public function policyInfo($id, $slug = null)
    {
        $menu = Frontend::where('data_keys', 'company_policy')->where('id', $id)->firstOrFail();
        $page_title = $menu->value->title;
        return view(activeTemplate() . 'policy', compact('menu', 'page_title'));
    }


    public function contact()
    {
        $data['page_title'] = "Contact Us";
        $data['contact'] = Frontend::where('data_keys', 'contact')->firstOrFail();
        return view(activeTemplate() . 'contact', $data);
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|string|email',
            'message' => 'required',
            'subject' => 'required'
        ]);
        $subject = $request->subject;
        $txt = "<br><br>" . $request->message;
        $txt .= "<br><br>" . "Contact Number : " . $request->phone . "<br>";
        send_contact($request->email, $request->name, $subject, $txt);
        $notify[] = ['success', 'Contact Message Send'];
        return back()->withNotify($notify);
    }

    public function register($reference)
    {
        $page_title = "Sign Up";
        return view(activeTemplate() . 'user.auth.register', compact('reference', 'page_title'));
    }

    public function plan()
    {
        $data['page_title'] = "Investment Plan";
        $data['plans'] = Plan::where('status', 1)->latest()->get();
        $data['wallets'] = UserWallet::where('user_id', Auth::id())->get();
        return view(activeTemplate() . 'plan', $data);
    }


    public function blog()
    {
        $blogs = Frontend::where('data_keys', 'blog.post')->latest()->paginate(9);
        $recentBlog = Frontend::where('data_keys', 'blog.post')->latest()->limit(8)->get();
        $page_title = "Blog";
        return view(activeTemplate() . 'blog', compact('blogs', 'page_title', 'recentBlog'));
    }

    public function blogDetails($slug = null, $id, $data_keys = 'blog.post')
    {
        $post = Frontend::where('id', $id)->where('data_keys', $data_keys)->firstOrFail();


        $page_title = "Blog Details";
        $data['title'] = $post->value->title;
        $data['details'] = $post->value->body;
        $data['image'] = config('constants.frontend.blog.post.path') . '/' . $post->value->image;
        $recentBlog = Frontend::where('data_keys', 'blog.post')->latest()->limit(8)->get();
        return view(activeTemplate() . 'blog-details', compact('recentBlog', 'post', 'data', 'page_title'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $macCount = Subscriber::where('email', trim(strtolower($request->email)))->count();
        if ($macCount > 0) {
            $notify[] = ['error', 'This Email Already Exist !!'];
            return redirect()->to(url()->previous() . "#subscribe")->withNotify($notify)->withInput();

        } else {
            Subscriber::create($request->only('email'));
            $notify[] = ['success', 'Subscribe Successfully!'];
            return redirect()->to(url()->previous() . "#subscribe")->withNotify($notify);

        }
    }


    public function changeLang($lang)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }


    public function planCalculator(Request $request)
    {

        if ($request->planId == null) {
            return response(['errors'=> 'Please Select a Plan!']);
        }

        $requestAmount = $request->investInput;
        if ($requestAmount == null ||  0 > $requestAmount) {
            return response(['errors'=> 'Please Enter Invest Amount!']);
        }


        $gnl = GeneralSetting::first();


        $plan = Plan::where('id', $request->planId)->where('status', 1)->first();
        if (!$plan) {
            return response(['errors'=> 'Invalid Plan!']);
        }

        if ($plan->fixed_amount == '0') {
            if ($requestAmount < $plan->minimum) {
                return response(['errors'=> 'Minimum Invest ' . formatter_money($plan->minimum) . ' ' . $gnl->cur_text]);
            }
            if ($requestAmount > $plan->maximum) {
                return response(['errors'=> 'Maximum Invest ' . formatter_money($plan->maximum) . ' ' . $gnl->cur_text]);
            }
        } else {
            if ($requestAmount != $plan->fixed_amount) {
                return response(['errors'=> 'Fixed Invest amount ' . formatter_money($plan->fixed_amount) . ' ' . $gnl->cur_text]);
            }
        }


        //start
        if ($plan->interest_status == 1) {
            $interest_amount = ($requestAmount * $plan->interest) / 100;
            $result['interest_amount'] = $interest_amount . "%";
        } else {
            $interest_amount = $plan->interest;
            $result['interest_amount'] = $interest_amount . " ".$gnl->cur_text;
        }

        $period = ($plan->lifetime_status == 1) ? '-1' : $plan->repeat_time;


        if($plan->lifetime_status == '0'){
            $result['interestValidity'] =  'Per '. $plan->times . ' Hours, '. $plan->repeat_time. " Times";
        }else{
            $result['interestValidity'] =  'Per '. $plan->times . " Hours,  Lifetime";
        }

        return response($result);
        //end



    }


}
