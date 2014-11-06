<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perdana Hadi's Lifestream</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/flatly/starter-template.css" rel="stylesheet"> 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.ckeditor.com/4.4.5/basic/ckeditor.js"></script>
  </head>
  <body>

  <?php if($this->ion_auth->logged_in()){;?>
  <!-- Modal Post -->
  <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add a project</h4>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart('project/post');?>
            <fieldset>
            <div class="form-group">
              <input name="ls_title" type="text" class="form-control" placeholder="Project Title">
            </div>
            <div class="form-group">
              <textarea name="ls_lifestream" id="editor1" rows="10" cols="80">
              </textarea>
              <script>
                  // Replace the <textarea id="editor1"> with a CKEditor
                  // instance, using default configuration.
                  CKEDITOR.replace( 'editor1' );
              </script> 
            </div>
            <!-- Select Basic -->
            <div class="form-group">
              <!-- File Button --> 
              <div class="col-md-4">
                <label><small>Upload Picture</small></label>
                <input id="filebutton" name="userfile" class="input-file" type="file">
              </div>
            </div>

            </fieldset>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-primary">Post</button>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
  <?php };?>

  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><i class="fa fa-circle-o-notch"></i> Lifestream</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li class="active"><a href="<?php echo base_url();?>project">Project</a></li>
          <li><a href="<?php echo base_url();?>contact">Contact</a></li>
        </ul>

        <?php if($this->ion_auth->logged_in()){;?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="auth/logout">Logout</a></li>
          <li>
            <form>
              <a href="#" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#postModal">
                <i class="fa fa-plus"></i> 
              </a>
            </form>
          </li>
        </ul>
        <?php };?>
      </div><!--/.nav-collapse -->
    </div>
  </div>

<div class="container">
  <div class="row starter-template">
    <ul class="thumbnails list-unstyled">
      <?php foreach($projects as $project):?>
      <li class="col-md-3">
        <div class="thumbnail" style="padding: 0">
          <div style="padding:4px">
            <img alt="300x200" style="width: 100%" src="http://placehold.it/200x150">
          </div>
          <div class="caption">
            <h2>Project A</h2>
            <p>My project description</p>
            <p><i class="icon icon-map-marker"></i> Place, Country</p>
          </div>
          <div class="modal-footer" style="text-align: left">
            <label>Project</label><br><small>from 12 June to 14 July 2012</small>
          </div>
        </div>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
  <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
    $('#back-to-top').fadeIn();
    } else {
    $('#back-to-top').fadeOut();
    }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
    $('#back-to-top').tooltip('hide');
    $('body,html').animate({
    scrollTop: 0
    }, 800);
    return false;
    });
    $('#back-to-top').tooltip('show');
    });
    </script>
  </body>
</html>