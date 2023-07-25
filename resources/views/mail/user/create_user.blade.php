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
            
            
            <div class="card-body text-center">
                <div class="alert alert-primary" role="alert">
                    <h5 class="card-title">This mail was sent using application By {{ $sender }}</h5>
                </div>
                <p class="card-text">Hello {{ $name }} . Welcome to Dreams . Use password : '{{ $password }}' to login your account . Change yor password as soon as possible </p>
            </div>
        </div>
    </div>
 </div>

</body>
</html>