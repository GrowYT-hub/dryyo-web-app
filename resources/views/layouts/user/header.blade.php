@php
    $settings = \App\Models\Setting::first();
@endphp
<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <a data-toggle="modal" data-target="#myModal" class="slide__text-link" style="font-family: 'Roboto', sans-serif;">Schedule Pickup</a>
        </ul>
        <h1 class="logo">
            <img src="{{url('public/'.$settings->logo) }}" style="width: 100%; height: 80px;">
        </h1>
    </div>
</nav>
