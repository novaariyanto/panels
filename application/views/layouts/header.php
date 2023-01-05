
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$setting->app_name;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet"  href="<?= base_url("assets/purple/assets/vendors/mdi/css/materialdesignicons.min.css")?>">
    <link rel="stylesheet"  href="<?= base_url("assets/purple/assets/vendors/css/vendor.bundle.base.css")?>">

    <link rel="stylesheet"  href="<?= base_url("assets/purple/assets/css/style.css")?>">
    <!-- End layout styles -->
    <link rel="shortcut icon"  href="<?= base_url("assets/purple/assets/images/favicon.png")?>" />
    <script src="<?= base_url("assets/purple/assets/js/tinymce.min.js?v1")?>" referrerpolicy="origin"></script>


    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    
   
<script>
  tinymce.init({
    selector: '#message',
   
    toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
      'alignleft aligncenter alignright alignjustify  ' 
      
  });
</script>
  </head>
  <body>
    <?php 
    $this->load->view('layouts/navbar');
    ?>