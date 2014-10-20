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
          <h4 class="modal-title" id="myModalLabel">Add a lifestream</h4>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart('home/post');?>
            <fieldset>
            <div class="form-group">
              <input name="ls_title" type="text" class="form-control" placeholder="Post Title">
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
            <!-- <label class="col-md-4 control-label" for="ls_category">Select Category</label> -->
              <div class="col-md-4">
                <label><small>Select category</small></label>
                <select id="ls_category" name="ls_category" class="form-control">
                  <option value="status">Status</option>
                  <option value="notes">Notes</option>
                </select>
              </div>


              <!-- File Button --> 
              <div class="col-md-4">
                <label><small>Upload file</small></label>
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
        <a class="navbar-brand" href="#"><i class="fa fa-spin fa-circle-o-notch"></i> Lifestream</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url();?>project">Project</a></li>
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
    <div class="col-md-5">
      <div class="media">
      <a class="pull-left" href="#">
        <img class="media-object dp" src="<?php echo base_url();?>assets/flatly/img/chitoge.png" style="width: 100px;height:100px;">
      </a>
        <div class="media-body">
          <h4 class="media-heading">Perdana Hadi <small> Indonesia</small></h4>
          <h5>Web Developer at <a href="http://zmg.co.id">ZMG Indonesia</a></h5>
          <hr style="margin:4px auto">
          <span class="label label-default">HTML5/CSS3</span>
          <span class="label label-default">Laravel</span>
          <span class="label label-info">CodeIgniter</span>
          <span class="label label-default">Ubuntu</span>
        </div>
      </div>

      <!-- image galleries -->
    </div>

    <div class="col-md-7">
      <div class="timeline-centered">
        <?php foreach($streams as $stream):?>

          <?php if($this->ion_auth->logged_in()){;?>
          <!-- Modal  Edit -->
          <div class="modal fade" id="editModal-<?php echo $stream->pk_stream_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel">Edit lifestream</h4>
                </div>
                <div class="modal-body">
                  <?php echo form_open_multipart('home/edit');?>
                  <?php echo form_hidden('sid', $stream->pk_stream_id);?>
                    <fieldset>
                    <div class="form-group">
                      <input value="<?php echo $stream->s_title;?>" name="ls_title" type="text" class="form-control" placeholder="Post Title">
                    </div>

                    <div class="form-group">
                      <textarea required name="ls_lifestream" id="editor-<?php echo $stream->pk_stream_id;?>" rows="10" cols="80"><?php echo $stream->s_lifestream;?>
                      </textarea>
                      <script>
                          // Replace the <textarea id="editor1"> with a CKEditor
                          // instance, using default configuration.
                          CKEDITOR.replace( 'editor-<?php echo $stream->pk_stream_id;?>' );
                      </script> 
                    </div>
                    <!-- Select Basic -->
                    <div class="form-group">
                    <!-- <label class="col-md-4 control-label" for="ls_category">Select Category</label> -->
                      <div class="col-md-4">
                        <label><small>Select category</small></label>
                        <select id="ls_category" name="ls_category" class="form-control">
                          <option value="status">Status</option>
                          <option value="notes">Notes</option>
                        </select>
                      </div>


                      <!-- File Button --> 
                      <div class="col-md-4">
                        <label><small>Upload file</small></label>
                        <input id="filebutton" name="userfile" class="input-file" type="file">
                        <?php if($stream->s_picture){ ;?>
                          <p><?php echo $stream->s_picture;?> | <a href="<?php echo base_url();?>home/delete_picture/<?php echo $stream->pk_stream_id;?>">[x]</a></p>
                        <?php } ;?>
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

          <!-- delete modal -->
           <div class="modal fade" id="deleteModal-<?php echo $stream->pk_stream_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel">Delete stream</h4>
                </div>
                <div class="modal-body">
                  <?php echo form_open_multipart('home/delete');?>
                  <?php echo form_hidden('sid', $stream->pk_stream_id);?>
                  <?php echo form_hidden('ls_picture', $stream->s_picture);?>
                  Do you really want to delete stream? This action can't be undone.
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

        <article class="timeline-entry">
          <div class="timeline-entry-inner">
            <div class="timeline-icon <?php if($stream->e_category == "status"){ echo "bg-success";} else { echo "bg-warning";};?>">
              <i class="entypo-feather"></i>
            </div>
            <div class="timeline-label">
              <h2>
                <a href="#"><?php echo $stream->s_title;?></a>
                <?php if($this->ion_auth->logged_in()){;?>
                <small class="pull-right">
                  <a href="#" data-toggle="modal" data-target="#editModal-<?php echo $stream->pk_stream_id;?>">edit</a> | <a href="#" data-toggle="modal" data-target="#deleteModal-<?php echo $stream->pk_stream_id;?>">delete</a>
                </small>
                <?php } ;?>
              </h2>
              <p><?php echo $stream->s_lifestream;?></p>
              <?php if($stream->s_picture){;?>
              <?php
                $img_src = 'uploads/image/'.$stream->s_picture;
                $width = 848;
                $height = 480;
              ?>
              <p><img class="img-responsive" src="<?php echo base_url('/uploads/image/'. thumb($img_src, $width, $height)); ?>"></p>
              <?php };?>
            </div>
          </div>
        </article>
        <?php endforeach;?>

        <article class="timeline-entry begin">
          <div class="timeline-entry-inner">
            <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
              <i class="entypo-flight"></i> +
            </div>
          </div>
        </article>
      </div>
    </div>
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