<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Github API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          
          <a class="brand" href="#">Github API </a>
          <ul class="nav">
              <li><a href="index.php">AnaSayfa</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
		
      <div class="row">
       <div class="span8">
      <table class="table">
        <thead>
          <tr>
            
            <th>sha</th>
            <th>Changelog</th>
            <th>Username</th>
            <th>Tarih</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($repoDetail[1] as $k => $v) : ?>
          <tr>
            <td><b><a href="https://github.com/<?php echo $github->username;?>/<?php echo $repoName ?>/commit/<?php echo $v->sha;?>"><?php echo $v->sha;?></b></td>
            <td><?php echo $v->commit->message;?></td>
            <td><?php echo $v->commit->committer->name;?></td>
            <td><?php echo $v->commit->committer->date;?></td>         
          </tr>
         <?php endforeach;?>
        </tbody>
      </table>
    </div>
      </div>

      <hr>

      <footer>
        <p>Onur Baran</p>
      </footer>

    </div> 
   

  </body>
</html>
