<nav class="main-sidebar bg-default">
    <button class="sidebar-close"><i class="fa fa-times"></i></button>
    <div class="navbar-brand-wrapper d-flex justify-content-start align-items-center">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            <span class="logo-one"><img src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="logo-image" /></span>
            <span class="logo-two"><img src="{{ get_image(config('constants.logoIcon.path') .'/favicon.png') }}" alt="logo-image" /></span>
        </a>
    </div>
    <div id="main-sidebar">
        <ul class="nav">
            <li class="nav-item {{ sidenav_active('admin.dashboard') }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-th-large text-facebook"></i></span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ sidenav_active('admin.referral.index') }}">
                <a href="{{ route('admin.referral.index') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-tree text-facebook"></i></span>
                    <span class="menu-title">Referral Commission </span>
                </a>
            </li>



            <li class="nav-item {{ sidenav_active('admin.time*')}} {{ sidenav_active('admin.plan*')}}">
                <a data-default-url="{{ route('admin.time-setting') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-clipboard text-facebook"></i></span>
                    <span class="menu-title">Plan Management</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.time*') }}">
                        <a class="nav-link" href="{{ route('admin.time-setting') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Time Manage</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.plan*') }}">
                        <a class="nav-link" href="{{ route('admin.plan-setting') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Plan Manage</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item {{ sidenav_active('admin.users*') }}">
                <a data-default-url="{{ route('admin.users.all') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-users text-facebook"></i></span>
                    <span class="menu-title">Manage Users</span>
                    @if($email_unverified_users_count > 0 || $sms_unverified_users_count > 0)
                        <span class="badge bg-orange border-radius-10"><i class="fa px-1 fa-exclamation"></i></span>
                    @endif
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.users.all') }}">
                        <a class="nav-link" href="{{ route('admin.users.all') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Users</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.users.active') }}">
                        <a class="nav-link" href="{{ route('admin.users.active') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Active Users</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.users.banned') }}">
                        <a class="nav-link" href="{{ route('admin.users.banned') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Banned Users</span>
                            @if($banned_users_count) <span class="badge bg-blue border-radius-10">{{ $banned_users_count }}</span> @endif
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.users.emailUnverified') }}">
                        <a class="nav-link" href="{{ route('admin.users.emailUnverified') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Email Unverified</span>
                            @if($email_unverified_users_count) <span class="badge bg-blue border-radius-10">{{ $email_unverified_users_count }}</span> @endif
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.users.smsUnverified') }}">
                        <a class="nav-link" href="{{ route('admin.users.smsUnverified') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">SMS Unverified</span>
                            @if($sms_unverified_users_count) <span class="badge bg-blue border-radius-10">{{ $sms_unverified_users_count }}</span> @endif
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active(['admin.users.login.history','admin.users.login.search']) }}">
                        <a class="nav-link" href="{{ route('admin.users.login.history') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Login History</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.users.email.all') }}">
                        <a class="nav-link" href="{{ route('admin.users.email.all') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Send Email</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ sidenav_active('admin.withdraw*') }}">
                <a data-default-url="{{ route('admin.withdraw.method.methods') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-bank text-facebook"></i></span>
                    <span class="menu-title">Withdraw System</span>
                    @if($pending_withdrawals_count > 0)
                        <span class="badge bg-orange border-radius-10"><i class="fa px-1 fa-exclamation"></i></span>
                    @endif
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.withdraw.method*') }}">
                        <a class="nav-link" href="{{ route('admin.withdraw.method.methods') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Withdraw Methods</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.withdraw.pending') }}">
                        <a class="nav-link" href="{{ route('admin.withdraw.pending') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Pending Withdrawals</span>
                            @if($pending_withdrawals_count) <span class="badge bg-blue border-radius-10">{{ $pending_withdrawals_count }}</span> @endif
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.withdraw.approved') }}">
                        <a class="nav-link" href="{{ route('admin.withdraw.approved') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Approved Withdrawals</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.withdraw.rejected') }}">
                        <a class="nav-link" href="{{ route('admin.withdraw.rejected') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Rejected Withdrawals</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.withdraw.log') }}">
                        <a class="nav-link" href="{{ route('admin.withdraw.log') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Withdrawals</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item {{ sidenav_active('admin.deposit*') }}">
                <a data-default-url="{{ route('admin.deposit.gateway.index') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-credit-card-alt text-facebook"></i></span>
                    <span class="menu-title">Deposit System</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.deposit.gateway*') }}">
                        <a class="nav-link" href="{{ route('admin.deposit.gateway.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Automatic Gateways</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.deposit.manual*') }}">
                        <a class="nav-link" href="{{ route('admin.deposit.manual.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Manual Methods</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.deposit.pending') }}">
                        <a class="nav-link" href="{{ route('admin.deposit.pending') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Pending Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.deposit.approved') }}">
                        <a class="nav-link" href="{{ route('admin.deposit.approved') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Approved Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.deposit.rejected') }}">
                        <a class="nav-link" href="{{ route('admin.deposit.rejected') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Rejected Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.deposit.list') }}">
                        <a class="nav-link" href="{{ route('admin.deposit.list') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Deposits</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item @if(request()->path() == 'admin/tickets*') active open @endif {{sidenav_active('admin.contact-topic')}}">
                <a data-default-url="{{ route('admin.ticket') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-ticket text-facebook"></i></span>
                    <span class="menu-title">Support Ticket</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.ticket') }}">
                        <a class="nav-link" href="{{ route('admin.ticket') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">All Ticket</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.open.ticket') }}">
                        <a class="nav-link" href="{{ route('admin.open.ticket') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Open Ticket</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.pending.ticket') }}">
                        <a class="nav-link" href="{{ route('admin.pending.ticket') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Pending Ticket</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.closed.ticket') }}">
                        <a class="nav-link" href="{{ route('admin.closed.ticket') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Closed Ticket</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.contact-topic') }}">
                        <a class="nav-link" href="{{ route('admin.contact-topic') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title"> Ticket Type</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ sidenav_active('admin.subscriber*') }}">
                <a href="{{ route('admin.subscriber.index') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-rss-square text-facebook"></i></span>
                    <span class="menu-title">Subscribers</span>
                </a>
            </li>


            <li class="nav-item {{ sidenav_active('admin.report*') }}">
                <a href="{{ route('admin.report.transaction') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-clipboard text-facebook"></i></span>
                    <span class="menu-title">Transaction Log</span>
                </a>
            </li>


        </ul>
        <hr class="nk-hr" />
        <h6 class="nav-header text-facebook">Settings</h6>
        <ul class="nav">

            <li class="nav-item {{ sidenav_active('admin.plugin*') }}">
                <a href="{{ route('admin.plugin.index') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-cogs text-facebook"></i></span>
                    <span class="menu-title">Plugin & Extensions</span>
                </a>
            </li>
    
            <li class="nav-item {{ sidenav_active('admin.frontend*') }}">
                <a data-default-url="{{ route('admin.frontend.blog.index') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-diamond text-facebook"></i></span>
                    <span class="menu-title">Frontend Manager</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item ">
                        <hr class="nk-hr" />
                        <h6 class="nav-header text-facebook">Page Builder</h6>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.manage*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.manage.pages') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i> Manage Pages</span>
                            <span class="menu-title"></span>
                        </a>
                    </li>





                    <li class="nav-item ">
                        <hr class="nk-hr" />
                        <h6 class="nav-header text-facebook">Content Manage </h6>
                    </li>

                    @if($general->active_template == 'minimul')
                        <li class="nav-item {{ sidenav_active('admin.frontend.breadcrumb*') }}">
                            <a class="nav-link" href="{{route('admin.frontend.breadcrumb.logo-icon')}}">
                                <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                                <span class="menu-title">Breadcrumb Image</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item {{ sidenav_active('admin.frontend.banner.edit*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.banner.edit') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Banner</span>
                        </a>
                    </li>



                    <li class="nav-item {{ sidenav_active('admin.frontend.feature*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.feature.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Feature</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.about*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.about.edit') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Manage About</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.frontend.testimonial*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.testimonial.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Testimonial</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.profit*') }}">
                        <a class="nav-link" href="{{route('admin.frontend.profit.index')}}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">How To Get Profit</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.latest.trx*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.latest.trx') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Latest Transaction</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.topInvestor*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.topInvestor') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Top Investor</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.statistics*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.statistics') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Our Statistics</span>
                        </a>
                    </li>



                    <li class="nav-item {{ sidenav_active('admin.frontend.plan.heading*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.plan.heading') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Plan Heading</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.services*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.services.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Our Service</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.team*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.team.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Our Team</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.counter*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.counter.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Counter Section</span>
                        </a>
                    </li>




                    <li class="nav-item {{ sidenav_active('admin.frontend.faq*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.faq.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">FAQ</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.calculator.edit*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.calculator.edit') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Calculator Content</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.weAccept.heading*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.weAccept.heading') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">We Accept Payment</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.callToAction*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.callToAction') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Call To Action</span>
                        </a>
                    </li>



                    <li class="nav-item {{ sidenav_active('admin.frontend.blog*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.blog.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Blog Manager</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.subscribe.heading*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.subscribe.heading') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Subscribe Heading</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.rules*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.rules.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">RULES</span>
                        </a>
                    </li>



                    <li class="nav-item {{ sidenav_active('admin.frontend.companyPolicy*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.companyPolicy.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Company Policy</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.social*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.social.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Social Icons</span>
                        </a>
                    </li>

                    <li class="nav-item {{ sidenav_active('admin.frontend.section*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.section.contact.edit') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Contact Us</span>
                        </a>
                    </li>


                    <li class="nav-item {{ sidenav_active('admin.frontend.seo*') }}">
                        <a class="nav-link" href="{{ route('admin.frontend.seo.edit') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">SEO Manager</span>
                        </a>
                    </li>



                </ul>
            </li>

            <li class="nav-item {{ sidenav_active('admin.setting*') }}">
                <a data-default-url="{{ route('admin.setting.index') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-cog text-facebook"></i></span>
                    <span class="menu-title">General Settings</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.setting.index') }}">
                        <a class="nav-link" href="{{ route('admin.setting.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Basic</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.setting.logo-icon') }}">
                        <a class="nav-link" href="{{ route('admin.setting.logo-icon') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Logo & Icons</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.setting.language*') }}">
                        <a class="nav-link" href="{{ route('admin.setting.language-manage') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Language Manager</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ sidenav_active('admin.email-template*') }}">
                <a data-default-url="{{ route('admin.email-template.global') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-envelope-o text-facebook"></i></span>
                    <span class="menu-title">Email Manager</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.email-template.global') }}">
                        <a class="nav-link" href="{{ route('admin.email-template.global') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Global Template</span>
                        </a>
                    </li>                  
                    <li class="nav-item {{ sidenav_active(['admin.email-template.index','admin.email-template.edit']) }}">
                        <a class="nav-link" href="{{ route('admin.email-template.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Email Templates</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active('admin.email-template.setting') }}">
                        <a class="nav-link" href="{{ route('admin.email-template.setting') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Email Configure</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ sidenav_active('admin.sms-template*') }}">
                <a data-default-url="{{ route('admin.sms-template.global') }}" class="nav-link">
                    <span class="menu-icon"><i class="fa fa-mobile text-facebook"></i></span>
                    <span class="menu-title">SMS Manager</span>
                    <span class="menu-arrow"><i class="fa fa-chevron-right"></i></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ sidenav_active('admin.sms-template.global') }}">
                        <a class="nav-link" href="{{ route('admin.sms-template.global') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">Global Template</span>
                        </a>
                    </li>
                    <li class="nav-item {{ sidenav_active(['admin.sms-template.index','admin.sms-template.edit']) }}">
                        <a class="nav-link" href="{{ route('admin.sms-template.index') }}">
                            <span class="mr-2"><i class="fa fa-angle-right"></i></span>
                            <span class="menu-title">SMS Templates</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
