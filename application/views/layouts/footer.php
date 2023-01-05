

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script  src="<?=base_url("assets/purple/assets/vendors/js/vendor.bundle.base.js")?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script  src="<?=base_url("assets/purple/assets/vendors/chart.js/Chart.min.js")?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script  src="<?=base_url("assets/purple/assets/js/off-canvas.js")?>"></script>
    <script  src="<?=base_url("assets/purple/assets/js/hoverable-collapse.js")?>"></script>
    <script  src="<?=base_url("assets/purple/assets/js/misc.js")?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- <script  src="<?=base_url("assets/purple/assets/js/dashboard.js")?>"></script> -->
    <script  src="<?=base_url("assets/purple/assets/js/todolist.js")?>"></script>
    <script  src="<?=base_url("assets/purple/assets/js/jquery.min.js")?>"></script>
    <script  src="<?=base_url("assets/purple/assets/js/jquery.qrcode.min.js")?>" type="text/javascript"></script>
    <script  src="<?=base_url("assets/purple/assets/js/script.js?v=13")?>" type="text/javascript"></script>
   
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
   
 <script>
  $(document).ready(function () {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
});
 </script>
    <!-- End custom js for this page -->
   <script>
        function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * 
    charactersLength));
      }
      return result;
    }

    function getsession(){
        if( localStorage.getItem("session")){
         
          console.log('ada')
        }else{
          var code = makeid(8)
          localStorage.setItem("session", code);
         
          console.log('tidak ada')
        }
      }
      function resetsession(){
        localStorage.setItem('session',"")
      }
 
    

   </script>
   <?php if (@$client_key != "") {?>
     <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?=$client_key?>"></script>
        <script type="text/javascript">
          function paybill(snaptoken){
            snap.pay(snaptoken,{
              onSuccess: function(result) {
                console.log("SUCCESS", result);
                location.reload();

          },
              onPending: function(result) {
                console.log("Payment pending", result);
                // alert("Payment pending \r\n"+JSON.stringify(result));
                location.reload();

          },
              onError: function() {
                console.log("Payment error");
                location.reload();

          }
            })
          }

        </script>
        <?php }?>
  </body>
</html>