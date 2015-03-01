<!DOCTYPE html>
<html lang="en">
<head>
  <title>Code Rank</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  

</head>

<body>

<!-- header -->
    
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Code Rank</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/index.php">Home<span class="sr-only">(current)</span></a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">IDE</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Signin</a></li>
            <li><a href="#">Signup</a></li>
            <li><a href="#">About</a></li>
            <li class="divider"></li>
            <li><a href="#">Help</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- main -->
<div class="container">
    <div class="jumbotron">
        <div class="row" >
        <div class="col-md-6">
        <table class="table">
            
                <thead>
                <tr>
                    <th><h3><span class="label label-info">Login</span></h3></th>
                </tr>
                <thead>
                <tbody>
                    <tr>
                        <td>
                        <!--for Login form -->
            <form class="form-horizontal" role="form">
                <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" placeholder="Enter Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" placeholder="Enter Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-info">Sign in</button>
                        </div>
                </div>
            </form>
                    </td>    
                </tr>
            </tbody>
        </table>
    </div>
            
                            <!-- End of Login form-->
    <div class="col-md-6">      
            
                <div class="span6">
                <table class="table">
                    <thead>
                    <tr>
                       <th><h3><span class="label label-success">Registration</span></h3></th> 
                       
                    </tr>
                </thead>
                <!-- Registration form -->
                
                <tbody>

                <tr>
                    <td>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label">Username</label>
                                        <div class="col-sm-7">
                                             <input type="username" class="form-control" id="username"   placeholder="Enter Username">
                                        </div>
                                </div>
                                <div class="form-group">
                                     <label for="email" class="col-sm-4 control-label">Email</label>
                                         <div class="col-sm-7">
                                                <input type="email" class="form-control" id="email" placeholder="Enter Email">
                                        </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="password" class="col-sm-4 control-label">Password</label>
                                         <div class="col-sm-7">
                                                <input type="password" class="form-control" id="password" placeholder="Enter Password">
                                        </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="confirm-password" class="col-sm-4 control-label">Confirm Password</label>
                                         <div class="col-sm-7">
                                                <input type="password" class="form-control" id="confirm" placeholder="Confirm password">
                                        </div>
                                 </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-10">
                                        <button type="submit" class="btn btn-success">Sign up</button>
                                    </div>
                                </div>
                            </form>
                    </td>

                </tr>
                </tbody>
                
        </table> 
    </div>       
    </div>
</div>
</div>

<!-- footer-->

<footer class="footer">
    &copy Copyrights 2015
</footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js" ></script>

</body>
</html>