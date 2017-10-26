<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Simon Perusteita</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Simo Suominen</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="Gallery.html">Gallery</a></li>
                <li><a href="Projects.html">Projects</a></li>
                <li><a href="Skills.html">Skills</a></li>
            </ul>
        </div>
    </nav>  

    <form class="form-horizontal" action="form.php" method="post">
        <fieldset>
            <p><br /></p>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">First Name</label>
                <div class="col-md-4">
                    <input id="firstname" name="firstname" placeholder="Enter Your First Name" class="form-control input-md" type="text" maxlength="25">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="lastname">Last Name</label>
                <div class="col-md-4">
                    <input id="lastname" name="lastname" placeholder="Enter Your Last Name" class="form-control input-md" type="text" maxlength="25">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control label" for="gender"> </label>
                <div class="col-md-4">
                    <select id="gender" name="gender" class="form-control">
                        <option value="" selected="">Gender:</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="company">Age</label>
                <div class="col-md-4">
                    <input id="age" name="age" placeholder="Enter Your age" class="form-control input-md" type="number">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">E-mail</label>
                <div class="col-md-4">
                    <input id="email" name="email" placeholder="Enter Your Valid email address" class="form-control input-md" type="email" maxlength="50">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="website">Website</label>
                <div class="col-md-4">
                    <input id="website" name="website" placeholder="Enter Your Website Address" class="form-control input-md" type="url">
                    <span class="help-block">Ex: www.example.com</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="Message">Comment</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="message" name="message" typeof="url" maxlength="255" required>http://www.example.com</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="laheta"></label>
                <div class="col-md-4">
                    <button type="submit" name="laheta" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="peruuta"></label>
                <div class="col-md-4">
                    <button type="submit" name="peruuta" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </fieldset>
    </form>





</body>
</html>