<script type="text/javascript" async src="https://cdn.mxpnl.com/libs/mixpanel-2.2.min.js"></script>

<link href="{{ asset('css/facebookcampaign.css') }}" rel="stylesheet">
<link href="{{ asset('css/headerhome.css') }}" rel="stylesheet">
<link href="{{ asset('css/graph.css') }}" rel="stylesheet">
<link href="{{ asset('css/panel2.css') }}" rel="stylesheet">


@extends('layouts.app')

@section('content')
    <body id="allCampaign">
    <nav id ="subNav">
            <div class ="content">
                <div class ="search">
                    <select id="jsCampaignDropdown" class="field fancy-select campaign-choice selectpicker show-menu-arrow" name="from" data-placeholder="Select a campaign" data-container="body" data-live-search="true" style="display: none;">
                       <option class="placeholder" selected disabled value="0" data-content="<em class='placeholder'>Select a campaign...</em>">Select a campaign...</option>
                            <optgroup label="Active">
                                @foreach ($Ads as $Ad)
                                    <option class="item-camp camp-status-active">{{$Ad->CampaignName}} {{$Ad->Ad_name}}</option>
                                @endforeach
                            </optgroup>
                    </select>
                    <div class="btn-group bootstrap-select field fancy-select campaign-choice show-menu-arrow">
                        <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" data-id="jsCampaignDropdown">
                            <div class="filter-option pull-left">
                                <em class="placeholder">Select a campaign</em>
                            </div>
                            &nbsp;
                            <div class="caret"></div>
                        </button>
                        <div class="dropdown-menu open">
                            <div class="bootstrap-select-searchbox">
                                <input text="text" class="input-block-level form-control">
                            </div>
                            <ul class="dropdownmenu inner" role="menu">
                                <li rel="1">
                                    <div class="div-contain">
                                        <div class="divider"></div>
                                    </div>
                                    <dt>
                                        <span class="text">Active</span>
                                    </dt>
                                    <a tabindex="0" class="opt item-camp camp-status-active" style>
                                        @foreach ($Ads as $Ad)
                                            <div class="opt item-camp camp-status-active">
                                            <a href="{{ url('/home/facebook', $Ad->id) }}">{{$Ad->CampaignName}} {{$Ad->Ad_name}}</a>
                                                <i class="glyphicon glyphicon-ok icon-ok check-mark"></i>
                                            </div>
                                        @endforeach
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </nav>
    <section class="paginator" id="main">

        <form class="header_filter validate" id="frm" action="/" novalidate="true" method="post" autocomplete="off">
            <input type="hidden" id="dashboard_type" value="user">
            <input type="hidden" id="dashboard_stat_action" name="dashboard_state[action]" class="not-removable" value>
            <input type="hidden" id="dashboard_stat_action_object" name="dashboard_stat[action_object" class="not-removable" value="0">
            <input type="hidden" id="diashboard_state_action_type" name="dashboard_stat[action_type]" class="not-removable">
            <header class="tit-page">
                <div class="date-section">
                    <select id="dashboard_stat_timespan" name="dashboard_stat[timespan]" required="required" onchange="dashboard_timespan_changed()" class="required">
                        <option value="LIFETIME">Lifetime</option>
                        <option value="TODAY">Today</option>
                        <option value="YESTERDAY">Yesterday</option>
                        <option value="LAST7DAYS">Last 7 days</option>
                        <option value="LAST30DAYS">Last 30 days</option>
                        <option value="LASTWEEK">Last week</option>
                        <option value="LASTMONTH">Last month</option>
                        <option value="LAST3MONTHS">Last 3 months</option>
                        <option value="LASTYEAR">Last year</option>
                        <option value="THISWEEK">This week</option>
                        <option value="THISMONTH">This month</option>
                        <option value="THISYEAR">This year</option>
                        <option value="RANGE">Range</option>
                    </select>
                    <div class="range-date hide">
                        <div class="input-append date" id="datepicker1">
                            <input type="text" id="dashboard_stat_datefrom" name="dashboard_stat[datefrom]" required="required" maxlength="10" placeholder="from" class="dpicker not-removable" onchange="dashboard_date_changed(this)" readonly="readonly" size="10" data-onchange-func="range_date_changed" data-end-date="today">
                        </div>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>

                    <i class="icon-arrow-right"></i>
                    <div class="input-append date" id="datepicker2">
                        <input type="text" id="dashboard_stat_dateto" name="dashboard_stat[dateto]" required="required" maxlength="10" placeholder="to" class="dpicker not-removable" onchange="dashboard_date_changed(this)" readonly="readonly" size="10" data-onchange-func="range_date_changed">
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                    </div>
                </div>
                </div>
                    <h2 class="tit1">
                        Overview
                        <i class="loading ajax_loading" style="display:none"></i>
                    </h2>

            </header>
            <div id="alertContainer"></div>
            <article id="overflowPanel" class="box ">
                <section class="panel panel1">

                    <div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade preview-modal" id="categories">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h3 class="tit-modal">Customise Columns</h3>
                        </div>
                        <div class="modal-body">
                            <p class="text">Show these metrics in the dashboard:</p>
                            <ul class="list-column">
                                <li>
                                    <label class="checkbox">
                                        {{--<input type="checkbox" class="" name="" adg-stat="ctr" checked="checked">--}}
                                        {{--Click through--}}
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="a_cpc" checked="checked">
                                        Cost per click
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="cl" checked="checked">
                                        Clicks
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="im" checked="checked">
                                        Impressions
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="sp" checked="checked">
                                        Spent
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="cv" checked="checked">
                                        Conversions
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="a_cpm">
                                        Cost per 1k imp.
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="a_cpa" checked="checked">
                                        Cost per conversion
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="cvr">
                                        Conversion Rate
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="s_im">
                                        Social impressions
                                    </label>
                                </li>
                                <li>
                                    <label class="checkbox">
                                        <input type="checkbox" class="" name="" adg-stat="s_cl">
                                        Social clicks
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <footer class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button type="button" class="btn btn-success" onclick="dashboard_save_column_selector(this);" data-save-url="/ajax/dashboard/customize">Save</button>
                        </footer>
                    </div>

                    <a id="custome" href="#categories" data-toggle="modal" class="icon-cog">Customise Columns</a>
                    <div class="graph-info">
              <span class="alert alert-timezone alert-info">
                                              </span>
                    </div>
                    <div id="cwgraph" class="graph" style="height:370px; padding: 0px;" data-chart="0">
                        <div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 823px; height: 370px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); touch-action: none;">
                            <svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="823" height="370">
                                <desc>Created with Highcharts 4.2.6</desc>
                                <defs>
                                    <clipPath id="highcharts-1">
                                        <rect x="0" y="0" width="773" height="276"></rect>
                                    </clipPath>
                                </defs>
                                <rect x="0" y="0" width="823" height="370" fill="#FFFFFF" class=" highcharts-background"></rect>
                                <g class="highcharts-grid"></g>
                                <g class="highcharts-grid">
                                    <path fill="none" d="M 50 296.5 L 823 296.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 250.5 L 823 250.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 204.5 L 823 204.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 158.5 L 823 158.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 112.5 L 823 112.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 66.5 L 823 66.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 19.5 L 823 19.5" stroke="#e7e7e7" stroke-width="1" opacity="1"></path>
                                </g>
                                <g class="highcharts-axis">
                                    <path fill="none" d="M 57.5 296 L 57.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 109.5 296 L 109.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 161.5 296 L 161.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 213.5 296 L 213.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 266.5 296 L 266.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 318.5 296 L 318.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 370.5 296 L 370.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 422.5 296 L 422.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 475.5 296 L 475.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 527.5 296 L 527.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 579.5 296 L 579.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 631.5 296 L 631.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 684.5 296 L 684.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 736.5 296 L 736.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 788.5 296 L 788.5 306" stroke="#C0D0E0" stroke-width="1" opacity="1"></path>
                                    <path fill="none" d="M 50 296.5 L 823 296.5" stroke="#C0D0E0" stroke-width="1"></path>
                                </g>
                                <g class="highcharts-axis"></g><path fill="none" d="M 266.5 20 L 266.5 296" pointer-events="none" stroke="#5a5f68" stroke-width="1" stroke-dasharray="1,1" visibility="visible"></path>
                                <g class="highcharts-series-group">
                                    <path fill="#0338F2" fill-opacity="0.25" d="M 266 142.01080000000002 C 279.32 142.01080000000002 279.32162.01080000000002 266 162.01080000000002 C 252.68 162.01080000000002 252.68 142.01080000000002 266 142.01080000000002 Z">

                                    </path>
                                    <g class="highcharts-series highcharts-series-0" transform="translate(50,20) scale(1 1)" clip-path="url(#highcharts-1)">
                                        <path fill="none" d="M 7.578431372549 71.69100000000003 C 7.578431372549 71.69100000000003 23.2579445571332 85.80656 33.710953346856 91.99080000000001 C 44.1639621365788 98.17504 49.3904665314402 97.24676000000004 59.843475321163 102.61220000000003 C 70.2964841108858 107.97764000000004 75.5229885057472 118.81800000000001 85.97599729547 118.81800000000001 C 96.429006085194 118.81800000000001 101.655510480056 118.81800000000001 112.10851926978 113.91900000000001 C 122.5615280595 109.02000000000001 127.78803245436002 40.18560000000002 138.24104124408 38.82860000000002 C 148.694050033804 37.471600000000024 153.92055442866598 37.471600000000024 164.37356321839 37.471600000000024 C 174.826572008114 37.471600000000024 180.05307640297602 139.173 190.5060851927 139.173 C 200.95909398242003 139.173 206.18559837727997 132.01080000000002 216.638607167 132.01080000000002 C 227.09161595672398 132.01080000000002 232.318120351586 132.01080000000002 242.77112914131 132.5766 C 253.22413793103402 133.1424 258.45064232589596 135.7598 268.90365111562 135.7598 C 279.356659905344 135.7598 284.583164300206 128.7494 295.03617308993 128.7494 C 305.48918187965 128.7494 310.71568627451 133.63828000000188 321.16869506423 143.4188 C 331.62170385395405 153.1993200000019 336.848208248816 151.13576 347.30121703854 177.65200000000002 C 357.75422582826405 204.16824000000003 362.980730223126 276 373.43373901285 276 C 383.88674780256997 276 389.11325219743003 186.70847999999404 399.56626098715 156.262 C 410.019269776874 125.81551999999405 415.24577417173595 132.25 425.69878296146 123.76760000000002 C 436.151791751184 115.28520000000002 441.37829614604595 120.73804000000133 451.83130493577 113.85000000000002 C 462.28431372549005 106.96196000000133 467.51081812035 89.32740000000001 477.96382691007 89.32740000000001 C 488.416835699794 89.32740000000001 493.643340094656 177.02640000000002 504.09634888438 177.02640000000002 C 514.549357674104 177.02640000000002 519.775862068966 87.22060000000002 530.22887085869 87.22060000000002 C 540.681879648414 87.22060000000002 545.908384043276 102.80631999999801 556.361392833 113.275 C 566.81440162272 123.74367999999802 572.04090601758 131.42476000000158 582.4939148073 139.56400000000002 C 592.946923597024 147.70324000000159 598.173427991886 149.92688 608.62643678161 153.9712 C 619.079445571334 158.01552 624.3059499661961 158.32555999999974 634.75895875592 159.78560000000002 C 645.21196754564 161.24563999999975 650.4384719405 159.78560000000002 660.89148073022 161.27140000000003 C 671.344489519944 162.75720000000004 676.5709939148059 189.39120000000003 687.02400270453 189.39120000000003 C 697.4770114942539 189.39120000000003 702.703515889116 150.1946 713.15652467884 150.1946 C 723.60953346856 150.1946 728.83603786342 153.2057600000009 739.28904665314 158.0974 C 749.742055442864 162.98904000000093 765.42156862745 174.6528 765.42156862745 174.6528" stroke="#0338F2" stroke-width="4" stroke-linejoin="round" stroke-linecap="round">

                                        </path>
                                        <path fill="none" d="M -2.421568627451 71.69100000000003 L 7.578431372549 71.69100000000003 C 7.578431372549 71.69100000000003 23.2579445571332 85.80656 33.710953346856 91.99080000000001 C 44.1639621365788 98.17504 49.3904665314402 97.24676000000004 59.843475321163 102.61220000000003 C 70.2964841108858 107.97764000000004 75.5229885057472 118.81800000000001 85.97599729547 118.81800000000001 C 96.429006085194 118.81800000000001 101.655510480056 118.81800000000001 112.10851926978 113.91900000000001 C 122.5615280595 109.02000000000001 127.78803245436002 40.18560000000002 138.24104124408 38.82860000000002 C 148.694050033804 37.471600000000024 153.92055442866598 37.471600000000024 164.37356321839 37.471600000000024 C 174.826572008114 37.471600000000024 180.05307640297602 139.173 190.5060851927 139.173 C 200.95909398242003 139.173 206.18559837727997 132.01080000000002 216.638607167 132.01080000000002 C 227.09161595672398 132.01080000000002 232.318120351586 132.01080000000002 242.77112914131 132.5766 C 253.22413793103402 133.1424 258.45064232589596 135.7598 268.90365111562 135.7598 C 279.356659905344 135.7598 284.583164300206 128.7494 295.03617308993 128.7494 C 305.48918187965 128.7494 310.71568627451 133.63828000000188 321.16869506423 143.4188 C 331.62170385395405 153.1993200000019 336.848208248816 151.13576 347.30121703854 177.65200000000002 C 357.75422582826405 204.16824000000003 362.980730223126 276 373.43373901285 276 C 383.88674780256997 276 389.11325219743003 186.70847999999404 399.56626098715 156.262 C 410.019269776874 125.81551999999405 415.24577417173595 132.25 425.69878296146 123.76760000000002 C 436.151791751184 115.28520000000002 441.37829614604595 120.73804000000133 451.83130493577 113.85000000000002 C 462.28431372549005 106.96196000000133 467.51081812035 89.32740000000001 477.96382691007 89.32740000000001 C 488.416835699794 89.32740000000001 493.643340094656 177.02640000000002 504.09634888438 177.02640000000002 C 514.549357674104 177.02640000000002 519.775862068966 87.22060000000002 530.22887085869 87.22060000000002 C 540.681879648414 87.22060000000002 545.908384043276 102.80631999999801 556.361392833 113.275 C 566.81440162272 123.74367999999802 572.04090601758 131.42476000000158 582.4939148073 139.56400000000002 C 592.946923597024 147.70324000000159 598.173427991886 149.92688 608.62643678161 153.9712 C 619.079445571334 158.01552 624.3059499661961 158.32555999999974 634.75895875592 159.78560000000002 C 645.21196754564 161.24563999999975 650.4384719405 159.78560000000002 660.89148073022 161.27140000000003 C 671.344489519944 162.75720000000004 676.5709939148059 189.39120000000003 687.02400270453 189.39120000000003 C 697.4770114942539 189.39120000000003 702.703515889116 150.1946 713.15652467884 150.1946 C 723.60953346856 150.1946 728.83603786342 153.2057600000009 739.28904665314 158.0974 C 749.742055442864 162.98904000000093 765.42156862745 174.6528 765.42156862745 174.6528 L 775.42156862745 174.6528" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="23" class=" highcharts-tracker" style="">

                                        </path>
                                    </g>
                                    <g class="highcharts-markers highcharts-series-0 highcharts-tracker" transform="translate(50,20) scale(1 1)" clip-path="url(#highcharts-2)" style=""><path fill="#0338F2" d="M 765 171.6528 C 768.996 171.6528 768.996 177.6528 765 177.6528 C 761.004 177.6528 761.004 171.6528 765 171.6528 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 739 155.0974 C 742.996 155.0974 742.996 161.0974 739 161.0974 C 735.004 161.0974 735.004 155.0974 739 155.0974 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 713 147.1946 C 716.996 147.1946 716.996 153.1946 713 153.1946 C 709.004 153.1946 709.004 147.1946 713 147.1946 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 687 186.39120000000003 C 690.996 186.39120000000003 690.996 192.39120000000003 687 192.39120000000003 C 683.004 192.39120000000003 683.004 186.39120000000003 687 186.39120000000003 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 660 158.27140000000003 C 663.996 158.27140000000003 663.996 164.27140000000003 660 164.27140000000003 C 656.004 164.27140000000003 656.004 158.27140000000003 660 158.27140000000003 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 634 156.78560000000002 C 637.996 156.78560000000002 637.996 162.78560000000002 634 162.78560000000002 C 630.004 162.78560000000002 630.004 156.78560000000002 634 156.78560000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 608 150.9712 C 611.996 150.9712 611.996 156.9712 608 156.9712 C 604.004 156.9712 604.004 150.9712 608 150.9712 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 582 136.56400000000002 C 585.996 136.56400000000002 585.996 142.56400000000002 582 142.56400000000002 C 578.004 142.56400000000002 578.004 136.56400000000002 582 136.56400000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 556 110.275 C 559.996 110.275 559.996 116.275 556 116.275 C 552.004 116.275 552.004 110.275 556 110.275 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 530 84.22060000000002 C 533.996 84.22060000000002 533.996 90.22060000000002 530 90.22060000000002 C 526.004 90.22060000000002 526.004 84.22060000000002 530 84.22060000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 504 174.02640000000002 C 507.996 174.02640000000002 507.996 180.02640000000002 504 180.02640000000002 C 500.004 180.02640000000002 500.004 174.02640000000002 504 174.02640000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 477 86.32740000000001 C 480.996 86.32740000000001 480.996 92.32740000000001 477 92.32740000000001 C 473.004 92.32740000000001 473.004 86.32740000000001 477 86.32740000000001 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 451 110.85000000000002 C 454.996 110.85000000000002 454.996 116.85000000000002 451 116.85000000000002 C 447.004 116.85000000000002 447.004 110.85000000000002 451 110.85000000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 425 120.76760000000002 C 428.996 120.76760000000002 428.996 126.76760000000002 425 126.76760000000002 C 421.004 126.76760000000002 421.004 120.76760000000002 425 120.76760000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 399 153.262 C 402.996 153.262 402.996 159.262 399 159.262 C 395.004 159.262 395.004 153.262 399 153.262 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 373 273 C 376.996 273 376.996 279 373 279 C 369.004 279 369.004 273 373 273 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 347 174.65200000000002 C 350.996 174.65200000000002 350.996 180.65200000000002 347 180.65200000000002 C 343.004 180.65200000000002 343.004 174.65200000000002 347 174.65200000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 321 140.4188 C 324.996 140.4188 324.996 146.4188 321 146.4188 C 317.004 146.4188 317.004 140.4188 321 140.4188 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 295 125.74940000000001 C 298.996 125.74940000000001 298.996 131.7494 295 131.7494 C 291.004 131.7494 291.004 125.74940000000001 295 125.74940000000001 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 268 132.7598 C 271.996 132.7598 271.996 138.7598 268 138.7598 C 264.004 138.7598 264.004 132.7598 268 132.7598 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 242 129.5766 C 245.996 129.5766 245.996 135.5766 242 135.5766 C 238.004 135.5766 238.004 129.5766 242 129.5766 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 216 127.01080000000002 C 222.66 127.01080000000002 222.66 137.01080000000002 216 137.01080000000002 C 209.34 137.01080000000002 209.34 127.01080000000002 216 127.01080000000002 Z" stroke="#FFFFFF" stroke-width="2">

                                        </path>
                                        <path fill="#0338F2" d="M 190 136.173 C 193.996 136.173 193.996 142.173 190 142.173 C 186.004 142.173 186.004 136.173 190 136.173 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 164 34.471600000000024 C 167.996 34.471600000000024 167.996 40.471600000000024 164 40.471600000000024 C 160.004 40.471600000000024 160.004 34.471600000000024 164 34.471600000000024 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 138 35.82860000000002 C 141.996 35.82860000000002 141.996 41.82860000000002 138 41.82860000000002 C 134.004 41.82860000000002 134.004 35.82860000000002 138 35.82860000000002 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 112 110.91900000000001 C 115.996 110.91900000000001 115.996 116.91900000000001 112 116.91900000000001 C 108.004 116.91900000000001 108.004 110.91900000000001 112 110.91900000000001 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 85 115.81800000000001 C 88.996 115.81800000000001 88.996 121.81800000000001 85 121.81800000000001 C 81.004 121.81800000000001 81.004 115.81800000000001 85 115.81800000000001 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 59 99.61220000000003 C 62.996 99.61220000000003 62.996 105.61220000000003 59 105.61220000000003 C 55.004 105.61220000000003 55.004 99.61220000000003 59 99.61220000000003 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 33 88.99080000000001 C 36.996 88.99080000000001 36.996 94.99080000000001 33 94.99080000000001 C 29.004 94.99080000000001 29.004 88.99080000000001 33 88.99080000000001 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                        <path fill="#0338F2" d="M 7 68.69100000000003 C 10.996 68.69100000000003 10.996 74.69100000000003 7 74.69100000000003 C 3.004 74.69100000000003 3.004 68.69100000000003 7 68.69100000000003 Z" stroke="#FFFFFF" stroke-width="1">

                                        </path>
                                    </g>
                                </g>
                                <g class="highcharts-legend" transform="translate(356,330)">
                                    <g>
                                        <g>
                                            <g class="highcharts-legend-item" transform="translate(8,3)">
                                                <path fill="none" d="M 0 11 L 16 11" stroke="#0338F2" stroke-width="3"></path>
                                                <path fill="#0338F2" d="M 8 8 C 11.996 8 11.996 14 8 14 C 4.004 14 4.004 8 8 8 Z" stroke="#FFFFFF" stroke-width="1"></path>
                                                <text x="21" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" y="15">
                                                    <tspan>Cost per conversion</tspan>
                                                </text>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                                <g class="highcharts-axis-labels highcharts-xaxis-labels">
                                    <text x="72.57843137254902" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>28. Aug</tspan>
                                    </text>
                                    <text x="124.84347532116294" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>30. Aug</tspan>
                                    </text>
                                    <text x="177.10851926977688" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>1. Sep</tspan>
                                    </text>
                                    <text x="229.37356321839079" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>3. Sep</tspan>
                                    </text>
                                    <text x="281.6386071670047" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>5. Sep</tspan>
                                    </text>
                                    <text x="333.90365111561863" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>7. Sep</tspan>
                                    </text>
                                    <text x="386.16869506423257" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>9. Sep</tspan>
                                    </text><text x="438.4337390128465" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>11. Sep</tspan>
                                    </text><text x="490.69878296146044" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>13. Sep</tspan>
                                    </text>
                                    <text x="542.9638269100743" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>15. Sep</tspan>
                                    </text>
                                    <text x="595.2288708586883" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>17. Sep</tspan>
                                    </text>
                                    <text x="647.4939148073022" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>19. Sep</tspan>
                                    </text>
                                    <text x="699.7589587559161" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>21. Sep</tspan>
                                    </text>
                                    <text x="752.0240027045301" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>23. Sep</tspan>
                                    </text>
                                    <text x="804.2890466531439" style="color:#666666;cursor:default;font-size:10px;fill:#666666;width:45px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="316" opacity="1">
                                        <tspan>25. Sep</tspan>
                                    </text>
                                </g>
                                <g class="highcharts-axis-labels highcharts-yaxis-labels"><text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="306" opacity="1">
                                        <tspan>0.000 $</tspan>
                                    </text>
                                    <text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="260" opacity="1">
                                        <tspan>10.000 $</tspan>
                                    </text>
                                    <text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="214" opacity="1">
                                        <tspan>20.000 $</tspan>
                                    </text>
                                    <text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="168" opacity="1">
                                        <tspan>30.000 $</tspan>
                                    </text>
                                    <text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="122" opacity="1">
                                        <tspan>40.000 $</tspan>
                                    </text>
                                    <text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="76" opacity="1">
                                        <tspan>50.000 $</tspan>
                                    </text>
                                    <text x="10" style="color:#0338F2;cursor:default;font-size:10px;fill:#0338F2;width:262px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="30" opacity="1">
                                        <tspan>60.000 $</tspan>
                                    </text>
                                </g>
                                <g class="highcharts-tooltip" style="cursor:default;padding:0;pointer-events:none;white-space:nowrap;" transform="translate(166,74)" opacity="1" visibility="visible">

                                </g>
                            </svg>
                            <div class="highcharts-tooltip" style="position: absolute; left: 166px; top: 74px; opacity: 1; visibility: visible;">
                                <span style="position: absolute; font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space: nowrap; color: rgb(51, 51, 51); margin-left: 0px; margin-top: 0px; left: 8px; top: 8px;">
                                    <b>September  5, 2017</b>
                                    <br>
                                    <span style="font-weight:bold;color:#0338F2">Cost per conversion</span>: 31.302 $<br>
                                </span>
                            </div>
                        </div>
                    </div>
                    <ul class="list-cat">
                        <li class="list" onclick="dashboard_stat_click(event, this, 'ctr');" style="" adg-stat="ctr">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_ctr" name="graphtype[]" value="ctr">
                                <em class="btn value type-a">0.589%</em>
                                <span class="dat">Click through</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'a_cpc');" style="" adg-stat="a_cpc">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_a_cpc" name="graphtype[]" value="a_cpc">
                                <em class="btn value type-b">$2.777</em>
                                <span class="dat">Cost per click</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'cl');" style="" adg-stat="cl">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_cl" name="graphtype[]" value="cl">
                                <em class="btn value type-c">133,099</em>
                                <span class="dat">Clicks</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'im');" style="" adg-stat="im">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_im" name="graphtype[]" value="im">
                                <em class="btn value type-d">22,585,234</em>
                                <span class="dat">Impressions</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'sp');" style="" adg-stat="sp">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_sp" name="graphtype[]" value="sp">
                                <em class="btn value type-e">$369,618.30</em>
                                <span class="dat">Spent</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'cv');" style="" adg-stat="cv">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_cv" name="graphtype[]" value="cv">
                                <em class="btn value type-j">11,959</em>
                                <span class="dat">Conversions</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'a_cpm');" style="display:none;" adg-stat="a_cpm">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_a_cpm" name="graphtype[]" value="a_cpm">
                                <em class="btn value type-k">$16.365</em>
                                <span class="dat">Cost per 1k imp.</span>
                            </label>
                        </li>
                        <li class="active list" onclick="dashboard_stat_click(event, this, 'a_cpa');" style="" adg-stat="a_cpa">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_a_cpa" name="graphtype[]" value="a_cpa" checked="checked">
                                <em class="btn value type-l">$30.907</em>
                                <span class="dat">Cost per conversion</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 'cvr');" style="display:none;" adg-stat="cvr">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_cvr" name="graphtype[]" value="cvr">
                                <em class="btn value type-m">8.985%</em>
                                <span class="dat">Conversion Rate</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 's_im');" style="display:none;" adg-stat="s_im">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_s_im" name="graphtype[]" value="s_im">
                                <em class="btn value type-n">807,686</em>
                                <span class="dat">Social impressions</span>
                            </label>
                        </li>
                        <li class=" list" onclick="dashboard_stat_click(event, this, 's_cl');" style="display:none;" adg-stat="s_cl">
                            <label class="checkbox">
                                <input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_s_cl" name="graphtype[]" value="s_cl">
                                <em class="btn value type-o">13,510</em>
                                <span class="dat">Social clicks</span>
                            </label>
                        </li>
                        {{--<li class="list active" onclick="dashboard_stat_click(event, this, 'ctr');" style="" adg-stat="ctr">--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_ctr" name="graphtype[]" value="ctr">--}}
                                {{--<em class="btn value type-a">0.589%</em>--}}
                                {{--<span class="dat">Click through</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                        {{--<li class=" list active" onclick="dashboard_stat_click(event, this, 'a_cpc');" style="" adg-stat="a_cpc">--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_a_cpc" name="graphtype[]" value="a_cpc">--}}
                                {{--<em class="btn value type-b">$2.777</em>--}}
                                {{--<span class="dat">Cost per click</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                        {{--<li class=" list active" onclick="dashboard_stat_click(event, this, 'cl');" style="" adg-stat="cl">--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_cl" name="graphtype[]" value="cl">--}}
                                {{--<em class="btn value type-c">133,099</em>--}}
                                {{--<span class="dat">Clicks</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                        {{--<li class=" list active" onclick="dashboard_stat_click(event, this, 'im');" style="" adg-stat="im">--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_im" name="graphtype[]" value="im">--}}
                                {{--<em class="btn value type-d">22,585,234</em>--}}
                                {{--<span class="dat">Impressions</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                        {{--<li class=" list active" onclick="dashboard_stat_click(event, this, 'sp');" style="" adg-stat="sp">--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_sp" name="graphtype[]" value="sp">--}}
                                {{--<em class="btn value type-e">$369,618.30</em>--}}
                                {{--<span class="dat">Spent</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                        {{--<li class=" list active" onclick="dashboard_stat_click(event, this, 'cv');" style="" adg-stat="cv">--}}
                            {{--<label class="checkbox">--}}
                                {{--<input type="checkbox" class="graphtype_cb sel-cat" id="graphtype_cv" name="graphtype[]" value="cv">--}}
                                {{--<em class="btn value type-j">11,959</em>--}}
                                {{--<span class="dat">Conversions</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                    </ul>

                </section>
                <section class="panel panel2">
                    <div class="cont1">
                        <h3 class="tit1">Campaign Details</h3>
                        <div id="jsCampaignEdit" data-refresh-url="" style="min-height:200px">
                            <div data-update-url="">


                                <input type="hidden" id="campaign__token" data-name="_token" name="campaign[_token]" disabled="disabled" class=" not-removable">
                                <div class="summary ad-account">
                                    <div class="item">
                                        <strong>Ad Account: </strong>
                                        <span>Hernia Mesh</span>
                                    </div>
                                </div>

                                <ul class="summary">
                                    <li class="item js_budget_type ">
                                        <strong>Budget Type:: </strong>
                                        <span class="jsData">Daily    </span>
                                        <div class="field jsField modify-field" style="display:none"></div>
                                    </li>
                                    <li class="item js_start_time ">
                                        <strong>Start Date: </strong>
                                        <span class="jsData">8/18/17, 11:48 AM</span>
                                        <div class="field jsField modify-field" style="display:none">
                                            <input type="datetime" id="campaign_start_time" data-name="start_time" name="campaign[start_time]" disabled="disabled" required="required" class="datetime not-removable" value="8/18/17, 11:48 AM">
                                        </div>
                                    </li>
                                    <li class="item js_status jsEditable ">
                                        <strong>Status: </strong>
                                        <span class="jsData">Active</span>
                                        <div class="field_select typeD jsField modify-field" style="display:none">
                                            <select id="campaign_status" data-name="status" name="campaign[status]" required="required">
                                                <option disabled="disabled" value="250">Completed</option>
                                                <option value="1" selected="selected">Active</option>
                                                <option value="2">Paused</option>
                                            </select>
                                        </div>
                                        <a href="#" class="btn-icon icon-pencil jsEdit"></a>
                                    </li>
                                </ul>
                                <ul class="summary">
                                    <li class="item js_budget ">
                                        <strong>Budget: </strong>
                                        <span class="jsData">50.00 $</span>
                                        <div class="field jsField modify-field" style="display:none">
                                            <div class="input-prepend">
                                                <span class="add-on">€  </span>
                                                <input type="text" id="campaign_budget" data-name="budget" name="campaign[budget]" disabled="disabled" required="required" class=" not-removable">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item js_end_time ">
                                        <strong>End date: </strong>
                                        <span class="jsData"></span>
                                        <div class="field jsField modify-field" style="display:none">
                                            <input type="datetime" id="campaign_end_time" data-name="end_time" name="campaign[end_time]" disabled="disabled" required="required" class="datetime not-removable">
                                        </div>
                                    </li>
                                    <li class="item js_bid_display">
                                        <strong></strong>
                                        <span class="jsData">Automatic</span>
                                    </li>
                                </ul>

                                <div class="summary bid-bill-optim">
                                    <ul class="item js_bid_bill_optim jsEditable" data-selected="IMPRESSIONS">
                                        <li class="subitem js_optimization_goal jsEditable ">
                                            <strong>Optimize for </strong>
                                            <span class="jsData">Offsite conversions</span>
                                            <div class="field_select typeD jsField modify-field" style="display:none">
                                                <select id="campaign_optimization_goal" data-name="optimization_goal" name="campaign[optimization_goal]" required="required">
                                                    <option value="OFFSITE_CONVERSIONS" selected="selected">Offsite conversions</option>
                                                    <option value="IMPRESSIONS">Impressions</option>
                                                    <option value="LINK_CLICKS">Link clicks</option>
                                                    <option value="REACH">Reach</option>
                                                    <option value="SOCIAL_IMPRESSIONS">Social impressions</option>
                                                    <option value="POST_ENGAGEMENT">Post engagement</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="subitem js_billing_event ">
                                            <strong>Pay for </strong>
                                            <span class="jsData">Impressions</span>
                                            <div class="field_select typeD jsField modify-field" style="display:none">
                                                <select id="campaign_billing_event" data-name="billing_event" name="campaign[billing_event]" disabled="disabled" required="required">
                                                    <option value="APP_INSTALLS">App installs</option>
                                                    <option value="CLICKS">Clicks</option>
                                                    <option value="IMPRESSIONS" selected="selected">Impressions</option>
                                                    <option value="LINK_CLICKS">Link clicks</option>
                                                    <option value="OFFER_CLAIMS">Offer claims</option>
                                                    <option value="PAGE_LIKES">Page likes</option>
                                                    <option value="POST_ENGAGEMENT">Post engagement</option>
                                                    <option value="VIDEO_VIEWS">Video views</option>
                                                </select>
                                            </div>
                                        </li>
                                        <a href="#" class="btn-icon icon-pencil jsEdit"></a>
                                    </ul>
                                </div>

                                <div class="summary weekly-plan">
                                    <div class="item">
                                        <strong>Dayparting:</strong>
                                        <span class="day-list">Disabled</span>
                                        <a class="btn-icon icon-pencil jsEditDayparting" href="/campaign/2602256/edit-dayparting" data-form-sign="campaign_edit_dayparting" data-form-id="popUpEditDayparting" data-form-extra-classes="container">
                                        </a>
                                    </div>
                                </div>
                                <div class="jsError"></div>
                                {{--<div class="tag-list">--}}
                                    {{--<strong>Your tags:</strong>--}}
                                    {{--<div class="jsTags" data-tags="[{&quot;id&quot;:184635,&quot;name&quot;:&quot;Amir&quot;},{&quot;id&quot;:232168,&quot;name&quot;:&quot;Floyd&quot;}]">--}}
                                        {{--<span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>--}}
                                        {{--<div class="cw-autocomplete-container cw-autocomplete-multiple">--}}
                                            {{--<ul>--}}
                                                {{--<li class="cw-autocomplete-selected">--}}
                                                    {{--<span class="cw-autocomplete-selected-label">Amir</span>--}}
                                                    {{--<a href="#_" class="cw-autocomplete-selected-close"></a>--}}
                                                    {{--<input id="tags" name="tags" type="hidden" value="Amir">--}}
                                                {{--</li>--}}
                                                {{--<li class="cw-autocomplete-selected">--}}
                                                    {{--<span class="cw-autocomplete-selected-label">Floyd</span>--}}
                                                    {{--<a href="#_" class="cw-autocomplete-selected-close"></a>--}}
                                                    {{--<input id="tags" name="tags" type="hidden" value="Floyd">--}}
                                                {{--</li>--}}
                                                {{--<li class="cw-autocomplete-new">--}}
                                                    {{--<input type="text" class="ui-autocomplete-input" name="tags_autocomplete" placeholder="Insert new tag" maxlength="50" id="tags_autocomplete" autocomplete="off">--}}
                                                {{--</li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="cont2">
                        <span class="for">for</span>
                        <h3 class="tit1">Current Target</h3>
                        <p>Not available for imported campaigns.</p>
                    </div>
                </section>
                <footer>
                    <div class="actions-wrap">
                        <a href="/campaigns/excel" class="btn btn-export-excel">Export in Excel</a>
                        <a href="/campaigns" class="btn btn-all-campaigns">See All Campaigns</a>
                    </div>
                </footer>
            </article>
        </form>
    </section>
    </body>
@endsection
