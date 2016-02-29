<!DOCTYPE html>
<html lang="en" ng-app="firstapp">
<head ng-controller="headerctrl">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title ng-bind="'Project Name - '+template.title">Project Name</title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <base href="FynxPreview/" target="_blank">
    <link rel="stylesheet" type="text" href="css/main.css" />
    <script>
      var isproduction=false;
    </script>
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/Arctext.js/js/jquery.arctext.js"></script>
    <script src="bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
    <script src="bower_components/angular/angular.js"></script>
    <script src="bower_components/angular-sanitize/angular-sanitize.min.js"></script>
    <script src="bower_components/ui-router/release/angular-ui-router.min.js"></script>
    <script src="bower_components/angular-bootstrap/ui-bootstrap.min.js"></script>
    <script src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script src="bower_components/lodash/lodash.js"></script>
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/navigation.js"></script>
    <script src="js/templateservice.js"></script>
    <!--[if IE]>
        <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
    <div class="repeated-item" ui-view></div>
</body>
</html>