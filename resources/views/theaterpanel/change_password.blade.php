@extends('theaterpanel.master')
@section('content')

<div class="content-wrapper pt-4">

    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>

                        <div class="card-body">

                            @if(session('success'))
                                <div class="alert alert-success" id="flash-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ url('updatepassword') }}" method="POST" id="changepasswordform">
                                @csrf

                                <input type="hidden" name="id" value="{{ Session::get('TheaterManagerLogginId')['id'] }}">
                                <input type="hidden" id="password" value="{{ Session::get('TheaterManagerLogginId')['password'] }}">

                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" id="oldpassword" class="form-control" required>
                                    <small class="invalid-feedback">Wrong Old Password</small>
                                </div>

                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="newpassword" id="newpassword" class="form-control" required>
                                    <small class="invalid-feedback">Minimum 8 characters required</small>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="conpassword" id="conpassword" class="form-control" required>
                                    <small class="invalid-feedback">Passwords do not match</small>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">
                                    Save Changes
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    
    <br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $("#changepasswordform").submit(function() {
        var invalid = false
        var password = document.getElementById('password').value
        var oldpass = document.getElementById("oldpassword").value
        var newpass = document.getElementById("newpassword").value
        var conpass = document.getElementById("conpassword").value

        oldpass = oldpass.trim()
        if (oldpass != password) {
            $("#oldpassword").addClass("is-invalid");
            invalid = true;
        } else {
            $("#oldpassword").removeClass("is-invalid");
        }

        newpass = newpass.trim()
        if (newpass.length < 8) {
            $("#newpassword").addClass("is-invalid");
            invalid = true;
        } else {
            $("#newpassword").removeClass("is-invalid");
        }

        if (newpass != conpass) {
            $("#conpassword").addClass("is-invalid");
            invalid = true;
        } else {
            $("#conpassword").removeClass("is-invalid");
        }

        if (invalid) {
            //Suppress form submit
            return false;
        } else {
            return true;
        }

    });
</script>
<script>
    setTimeout(function() {
        document.getElementById('flash-message').remove();
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
    <!-- /.content -->

</div>

@endsection