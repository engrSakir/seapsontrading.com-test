<div class="col-lg-3">
    <div class="user-area">
        <div class="remove-user d-lg-none">
            <i class="fas fa-times"></i>
        </div>
        <div class="user-item">
            <div class="user-thumb">
                <a href="#0">
                    <img src="{{get_image(config('constants.user.profile.path') .'/'. Auth::user()->image)}}" alt="user">
                </a>
            </div>
            <div class="user-content">
                <h6 class="title">@lang('Hello,') I am {{Auth::user()->username}}</h6>
                <p>Reg: {{date('M-d-Y',strtotime(Auth::user()->created_at))}}</p>
            </div>
        </div>
        <ul class="tab-menu">
            <li @if(Request::routeIs('user.home')) class="active" @endif>
                <a href="{{route('user.home')}}"><i class="fa fa-home"></i> @lang('Dashboard')</a>
            </li>

            <li @if(Request::routeIs('home.plan')) class="active" @endif>
                <a href="{{route('home.plan')}}"><i class="fas fa-cubes"></i> @lang('Investment Plans')</a></li>

            <li @if(Request::routeIs('user.interest.log')) class="active" @endif>
                <a  href="{{route('user.interest.log')}}"><i class="fas fa-hand-holding-usd"></i> @lang('Return Interest Log')</a>
            </li>

            <li @if(Request::routeIs('user.deposit') || Request::routeIs('user.manualDeposit.preview') ||  Request::routeIs('user.manualDeposit.confirm') || Request::routeIs('user.deposit.preview')  ) class="active" @endif>
                <a  href="{{route('user.deposit')}}"><i class="far fa-credit-card"></i> @lang('Deposit Now')</a>
            </li>

            <li @if(Request::routeIs('user.deposit.history')) class="active" @endif>
                <a href="{{route('user.deposit.history')}}"> <i class="fas fa-file-alt"></i> @lang('Deposit History')</a>
            </li>


            <li @if(Request::routeIs('user.withdraw.money')) class="active" @endif>
                <a  href="{{route('user.withdraw.money')}}"><i class="fas fa-university"></i> @lang('Withdraw Now')</a>
            </li>

            <li @if(Request::routeIs('user.withdrawLog')) class="active" @endif>
                <a  href="{{route('user.withdrawLog')}}"> <i class="fas fa-file-alt"></i>  @lang('Withdraw History')</a>
            </li>

            <li @if(Request::routeIs('user.transactions')) class="active" @endif>
                <a  href="{{route('user.transactions')}}"><i class="fas fa-exchange-alt"></i> @lang('Transaction History')</a>
            </li>

            <li @if(Request::routeIs('user.referral')) class="active" @endif>
                <a  href="{{route('user.referral')}}"><i class="fas fa-hands-helping"></i> @lang('Referral Statistic')</a>
            </li>

            <li @if(Request::routeIs('user.edit-profile')) class="active" @endif>
                <a  href="{{route('user.edit-profile')}}"><i class="fas fa-address-card"></i> @lang('Profile')</a>
            </li>

            <li @if(Request::routeIs('user.change-password')) class="active" @endif>
                <a  href="{{route('user.change-password')}}"><i class="fas fa-key"></i> @lang('Change Password')</a>
            </li>

            <li @if(Request::routeIs('user.ticket')) class="active" @endif>
                <a  href="{{route('user.ticket')}}"><i class="fas fa-ticket-alt"></i> @lang('Support Ticket')</a>
            </li>

            <li @if(Request::routeIs('user.twoFA')) class="active" @endif>
                <a  href="{{route('user.twoFA')}}"><i class="fas fa-shield-alt"></i>  @lang('2FA Security')</a>
            </li>

            <li>
                <a  href="{{route('user.logout')}}"> <i class="fa fa-sign-out-alt"></i>  @lang('Logout')</a>
            </li>



        </ul>
    </div>
</div>
