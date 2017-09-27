
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="content">
                            <div class="title m-b-md">
                                 Campaign Results
                            </div>




                                <div>
                                    <br />
                                    Account Name : {{ $arrayResponse->data[0]->account_name }}
                                    <br />
                                    Campaign Name : {{ $arrayResponse->data[0]->campaign_name }}
                                    <br />
                                    Ad Name : {{ $arrayResponse->data[0]->ad_name }}
                                    <br />
                                    Clicks : {{ $arrayResponse->data[0]->clicks }}
                                    <br />
                                    {{ $arrayResponse->data[0]->cost_per_action_type[2]->action_type}}
                                    : {{ $arrayResponse->data[0]->cost_per_action_type[2]->value }}
                                    <br />
                                    Cost per result  : {{ $arrayResponse->data[0]->cost_per_action_type[3]->value}}
                                   



                                    <br />
                                    {{ $arrayResponse->data[0]->actions[2]->action_type}} : {{ $arrayResponse->data[0]->actions[2]->value}}
                                    <br />
                                    Results :  {{ $arrayResponse->data[0]->actions[3]->value}}
                                    <br />
                                    Reach : {{ $arrayResponse->data[0]->reach}}
                                    <br />
                                    Impressions : {{ $arrayResponse->data[0]->impressions}}
                                    <br />
                                    Spend : {{ $arrayResponse->data[0]->spend}}



                                </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

