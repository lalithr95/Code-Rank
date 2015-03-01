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
                </thead>
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
                        <?php echo validation_errors(); ?>
                            <form class="form-horizontal" role="form" action="http://localhost/coderank/index.php/home/register" method="POST">
                                <div class="form-group">
                                    <label for="username" class="col-sm-4 control-label">Username</label>
                                        <div class="col-sm-7">
                                             <input type="text" class="form-control" name="username" id="username"   placeholder="Enter Username">
                                        </div>
                                </div>
                                <div class="form-group">
                                     <label for="email" class="col-sm-4 control-label">Email</label>
                                         <div class="col-sm-7">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                        </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="password" class="col-sm-4 control-label">Password</label>
                                         <div class="col-sm-7">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                        </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="confirm-password" class="col-sm-4 control-label">Confirm Password</label>
                                         <div class="col-sm-7">
                                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm password">
                                        </div>
                                 </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-10">
                                        <button type="submit" class="btn btn-success" value="submit">Sign up</button>
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