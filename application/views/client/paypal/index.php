<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter Paypal Integration Example - nicesnippets.com</title>
  <!-- Latest CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
</head>
<body>
  <div class="container">
    <h2 class="mt-3 mb-3">Products</h2>
    <div class="row">
        <?php if(!empty($products)): foreach($products as $product): ?>
        <div class="thumbnail">
            <img style="width:200px;height:200px" src="<?php echo base_url().'/'.$product['image']; ?>" alt="">
            <div class="caption">
                <h4 class="pull-right">$<?php echo $product['price']; ?></h4>
                <h4><a href="javascript:void(0);"><?php echo $product['name']; ?></a></h4>
            </div>
            <a href="<?php echo base_url().'index.php/payment/paypal/buyProduct/'.$product['id']; ?>">Buy</a>
        </div>
        <?php endforeach; endif; ?>
    </div>
  </div>
</body>
</html>