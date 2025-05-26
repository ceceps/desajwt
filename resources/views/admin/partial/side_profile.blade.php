<div class="side-profile">
    <div class="side-brand">
        <a href="#0" class="brand-logo">
            <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
        </a>
        <h2 class="side-top-title">{{ getenv('APP_NAME','Desa Wisata Jabar') }}</h2>
    </div>

    <div class="profile-thumbnail">
        <img src="{{ asset('images/profile.jpg') }}" alt="profile" class="img-fluid">
        <button type="button" class="btn btn-circle"><i class="mdi mdi-account-edit"></i></button>
    </div>
    <div class="profile-name">
        <h4>Hi, Admin name</h4>
        <div class="button-group">
            <button type="button" class="btn btn-default">Manage user</button>
            <button type="button" class="btn btn-default">Edit profile</button>
        </div>
    </div>
</div>
