<?php
$menu = "3,3,24";
if (isset($_REQUEST['tid'])) {
    $thispageeditid = 17;
} else {
    $thispageid = 17;
}

include ('../../config/config.inc.php');
$dynamic = '1';
include ('../../require/header.php');
include 'uploadimage.php';

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['tid'];
    $ip = $_SERVER['REMOTE_ADDR'];

    if ($imagename != '') {
        $imagec = $imagename;
    } else {
        $imagec = time();
    }
    $imag = strtolower($_FILES["image"]["name"]);
    $pimage = getsupplier('image', $getid);

    if ($imag) {
        if ($pimage != '') {
            unlink("../../../images/supplier/" . $pimage);
        }
        $main = $_FILES['image']['name'];
        /* $tmp = $_FILES['image']['tmp_name'];
          $size = $_FILES['image']['size'];
          $width = 1000;
          $height = 1000;
          $width1 = 200;
          $height1 = 200; */
        $extension = getExtension($main);
        $extension = strtolower($extension);
        if (($extension == 'jpg') || ($extension == 'png') || ($extension == 'gif')) {
            $m = $imagec;
            $imagev = $m . "." . $extension;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], '../../../images/supplier/' . $imagev)) {
                die('Error uploading file - check destination is writeable.');
            }

            /* $thumppath = "../../../images/testimonial/";
              $filepath = "../../../images/testimonial/thump/";
              $aaa = Imageupload($main, $size, $width, $thumppath, $thumppath, '255', '255', '255', $height, strtolower($m), $tmp);
              $bbb = Imageupload($main, $size, $width1, $filepath, $filepath, '255', '255', '255', $height1, strtolower($m), $tmp); */
        } else {
            $ext = '1';
        }
        $image = $imagev;
    } else {
        if ($_REQUEST['tid']) {
            $image = $pimage;
        } else {
            $image = '';
        }
    }


    $msg = addsupplier($shopname, $suppliername, $producttype, $supplierid, $status, $ip, $getid);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            supplier Mgmt
            <small><?php
                if ($_REQUEST['tid'] != '') {
                    echo 'Edit';
                } else {
                    echo 'Add New';
                }
                ?> supplier Mgmt </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $sitename; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-asterisk"></i> Home Block(s)</a></li>
            <li><a href="<?php echo $sitename; ?>pages/process/supplier.htm">supplier Mgmt </a></li>
            <li class="active"><?php
                if ($_REQUEST['tid'] != '') {
                    echo 'Edit';
                } else {
                    echo 'Add New';
                }
                ?> supplier</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form method="post" autocomplete="off" enctype="multipart/form-data" action="">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php
                        if ($_REQUEST['tid'] != '') {
                            echo 'Edit';
                        } else {
                            echo 'Add New';
                        }
                        ?> supplier Mgmt</h3>
                    <span style="float:right; font-size:13px; color: #333333; text-align: right;"><span style="color:#FF0000;">*</span> Marked Fields are Mandatory</span>
                </div>
                <div class="box-body">
                    <?php echo $msg; ?>
                    <div class="panel panel-info" id="comp_details_fields">
                        <div class="panel-heading">
                            supplier Mgmt
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Shop name<span style="color:#FF0000;">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter the Name" name="shopname" id="shopname" required="required" pattern="[0-9 A-Z a-z .-,:'()]{2,255}" title="Allowed Characters (0-9 A-Z a-z .,:'()]{2,255})" value="<?php echo getsupplier('shopname', $_REQUEST['tid']); ?>" />
                                </div>

                                <div class="col-md-6">
                                    <label>Supplier name<span style="color:#FF0000;">*</span></label> 
                                    <input type="text" class="form-control" placeholder="Enter the Name" name="suppliername" id="supplirsname" required="required" pattern="[0-9 A-Z a-z .-,:'()]{2,255}" title="Allowed Characters (0-9 A-Z a-z .,:'()]{2,255})" value="<?php echo getsupplier('suppliername', $_REQUEST['tid']); ?>" /> 

                                </div>
                            </div>
                            <div class="clearfix"><br /></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>supplier id<span style="color:#FF0000;">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter the Link" name="supplierid" id="supplierid" required="required" value="<?php echo getsupplier('supplierid', $_REQUEST['tid']); ?>" />                     
                                </div>
                                <div class="col-md-6">
                                    <label>Product type<span style="color:#FF0000;">*</span></label>  
                                    <input type="text" class="form-control" placeholder="Enter the Link" name="producttype" id="producttype" required="required" value="<?php echo getsupplier('producttype', $_REQUEST['tid']); ?>" />
                                </div>
                            </div><br>
                            <div class="row">

                                <div class="col-md-6">
                                    <label>Status <span style="color:#FF0000;">*</span></label>                  
                                    <select name="status" class="form-control">
                                        <option value="1" <?php
                                        if (getsupplier('status', $_REQUEST['tid']) == '1') {
                                            echo 'selected';
                                        }
                                        ?>>Active</option>
                                        <option value="0" <?php
                                        if (getsupplier('status', $_REQUEST['tid']) == '0') {
                                            echo 'selected';
                                        }
                                        ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>


                            <!--<div class="clearfix"><br /></div>-->


                            <!--  <div class="row">
  
                              </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Image Name<span style="color:#FF0000;"> *</span></label>                                  
                                      <input type="text" name="imagename" pattern="[A-Za-z0-9 -_]{2,110}" class="form-control" value="<?php echo getsupplier('imagename', $_REQUEST['tid']); ?>" required />                     
                                  </div>
                              </div> -->
                        </div>

                        <!--   <div class="row">                                             
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="form-group">
                                      <label>Image <span style="color:#FF0000;"> *(Recommended Size 1000 Pixels Width * 1000 Pixels Height)</span></label>
                                      <input class="form-control spinner" <?php if (getsupplier('image', $_REQUEST['tid']) == '') { ?> required="required" <?php } ?> name="image" type="file"> 
                                  </div>
                              </div>
                        <?php if (getsupplier('image', $_REQUEST['tid']) != '') { ?>
                                              <div class="col-md-6 col-sm-6 col-xs-12" id="delimage">
                                                  <label> </label>
                                                  <img src="<?php echo $fsitename; ?>images/supplier/<?php echo getsupplier('image', $_REQUEST['tid']); ?>" style="padding-bottom:10px;" height="100" />
                                                  <button type="button" style="cursor:pointer;" class="btn btn-danger" name="del" id="del" onclick="javascript:deleteimage('<?php echo getsupplier('image', $_REQUEST['tid']); ?>', '<?php echo $_REQUEST['tid']; ?>', 'testimonial', '../../images/testimonial/', 'image', 'tid');"><i class="fa fa-close">&nbsp;Delete Image</i></button>
                                              </div>
                        <?php } ?>
                          </div> -->

                        <!--  <div class="row">
                             <div class="col-md-12">
                                 <label>Content<span style="color:#FF0000;">* (350 Characters Only Allowed)</span></label>  
                                 <textarea id="editor1" name="content" class="form-control" rows="5" cols="80"><?php echo getsupplier('content', $_REQUEST['tid']); ?></textarea>
                             </div>
                         </div> -->

                    </div><br/>
                </div> 

            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo $sitename; ?>pages/process/supplier.htm">Back to Listings page</a>
                    </div>
                    <div class="col-md-6"><!--validatePassword();-->
                        <button type="submit" name="submit" id="submit" class="btn btn-success" style="float:right;"><?php
                            if ($_REQUEST['tid'] != '') {
                                echo 'UPDATE';
                            } else {
                                echo 'SAVE';
                            }
                            ?>
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </form>
        <!-- /.box -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include ('../../require/footer.php'); ?>


<link type="text/css" href="<?php echo $sitename; ?>dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" rel="stylesheet" />
<?php if (isset($_REQUEST['tid'])) { ?>
    <script src="<?php echo $sitename; ?>dhtmlgoodies_calendar/dhtmlgoodies_calendar1.js" type="text/javascript"></script>
<?php } else { ?>
    <script src="<?php echo $sitename; ?>dhtmlgoodies_calendar/dhtmlgoodies_calendar.js" type="text/javascript"></script>
<?php } ?>