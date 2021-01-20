@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">{{ 'Welcome to the Beekeepers Hive!' }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{asset('/storage/bee.jpg')}}" alt="Bee" class="img-fluid rounded">
                    </div>

                    <div class="col-md-6 ml-auto">
                        @guest
                            <b> Welcome, dear guest! </b>
                            <p> Here we discuss our favourite hobby - beekeeping! By browsing through the posts of our community, you may learn many fascinating things about keeping your bees safe and happy. To join our community, click the register button in the navigation bar. If you have already registered, click on the login button.</p>
                        @else
                            <b> Welcome back, {{ Auth::user()->profile->name_displayed }}, to the Beekeepers Hive! </b>
                            <p> Click on the Home button in the navigation bar to see the latest posts from your fellow beekeepers. Click on the Post page to add something yourself! Check your profile page by clicking on your name in the navigation bar. </p>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
