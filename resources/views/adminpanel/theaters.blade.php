@extends('adminpanel.master')
@section('content')
  <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Theater Form</h4>
                    <hr>
                    <div class="">
                      @if(session('status'))
                        <h6 style="color:red;margin:10px;">{{session('status')}}</h6>
                      @endif
                    </div>
                    
                    <form class="forms-sample " method="POST" action="{{url('/addtheater')}}" enctype="multipart/form-data">
                      @csrf
                      <img id="preview" src="#" alt="preview" style="max-width: 200px; display: none; border:2px solid black; margin-bottom: 10px"/>

                     <div class="form-group">
                        <label for="theater_img">Theater Image</label>
                        <input type="file" class="form-control" id="img" name="theater_img" onchange="previewImage(this)">
                         
                        <h6 style="color:red">@error('theater_img'){{$message}}@enderror</h6>
                      </div>


                      <div class="form-group">
                        <label for="theater">Theater Name</label>
                        <input type="text" class="form-control" id="theater" placeholder="Enter Theater Name" name="theater_name" onkeyup="generateEmail()">
                        <h6 style="color:red">@error('theater_name'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="city">Select City</label>
                        <select class="form-control" id="city" name="cityid">
                          <option value="">Select City</option>
                          @foreach($city as $row)
                          <option value="{{$row->id}}">{{$row->city_name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="theater_add">Theater Address</label>
                        <textarea rows="5" cols="50" class="form-control" id="theater_add" placeholder="Enter Theater Address" name="theater_address"></textarea>
                        <h6 style="color:red">@error('theater_address'){{$message}}@enderror</h6>
                      </div>

                        <div class="form-group">
                        <label for="theater_contact">Theater Contact</label>
                        <input type="text" class="form-control" id="theater_contact" placeholder="Enter Theater Contact" name="theater_contact" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                        <h6 style="color:red">@error('theater_contact'){{$message}}@enderror</h6>
                      </div>

                       <div class="form-group">
                        <label for="theater_email">Theater E-mail</label>
                        <input type="email" class="form-control" id="theater_email" placeholder="Enter Theater E-mail" name="theater_email">
                        <h6 style="color:red">@error('theater_email'){{$message}}@enderror</h6>
                      </div>

                      <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                        <h6 style="color:red">@error('password'){{$message}}@enderror</h6>
                      </div>

                       <div class="form-group">
                        <label for="theater_screen">Theater Screen</label>
                        <input type="text" class="form-control" id="theater_screen" placeholder="Enter Theater Screen No" name="no_of_screen" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                        <h6 style="color:red">@error('no_of_screen'){{$message}}@enderror</h6>
                      </div>

                      <button type="submit" class="btn btn-primary me-2">Add Theater</button>
                    </form>
                  </div>
                </div>
              </div>
<script>
  function previewImage(input) {
  var file = input.files[0]; // Get the selected file
  var reader = new FileReader();
  
  // If a file is selected, show the preview image
  if (file) {
    reader.onload = function(e) {
      $("#preview").attr("src", e.target.result).show(); // Show and set the preview image
    };
    reader.readAsDataURL(file);
  } else {
    $("#preview").hide(); // Hide the preview if no file is selected
  }
}

</script>

<script>
function generateEmail() {
    let theater = document.getElementById('theater').value.trim();
    let emailField = document.getElementById('theater_email');

    if (theater === '') {
        emailField.value = '';
        return;
    }

    let emailName = theater
        .toLowerCase()
        .replace(/\s+/g, '')        // remove spaces
        .replace(/[^a-z0-9]/g, ''); // remove special chars

    emailField.value = emailName + '@gmail.com';
}
</script>




@endsection