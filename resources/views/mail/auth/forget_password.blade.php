<!DOCTYPE html>
<html>
<head>
	<title>Forget Password </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

 <div class="container col-md-12 col-sm-12">
    <div class="row col-sm-12 col-lg-6 m-auto">
        <div class="card" style="width: 100%;">
            <img src="https://cdn-icons-png.flaticon.com/512/6195/6195700.png"  class="card-img-top" alt="...">
            <div class="card-body text-center">
              <h5 class="card-title">Your Easy Ecommerce Password Reset Code</h5>
              <p class="card-text">{{ $data }}</p>
              <a href="{{ env('APP_URL') }}/reset-password/{{ $data }}" class="btn btn-primary">To Change Your Password Click Here</a>
            </div>
        </div>
    </div>
 </div>

</body>
</html>