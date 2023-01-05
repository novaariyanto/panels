
    var url = window.location.href;
    console.log('develop by whatsva.com')
    
    if(window.location.href.includes('guest_contact/import')){
      $('#api_key').val(localStorage.getItem("session"));
    }
    if(window.location.href.includes('guest_devices')){
      var data = {
        api_key : localStorage.getItem("session")
      }
      $.ajax({
      url: "http://localhost/wapa/index.php/api/guest_device/list",
      type: "post",
      data: JSON.stringify(data) ,
      contentType:'application/json',
      success: function (response) {
     
        if(response.success){
          for(i in response.data){
            var status_show = "";
            var btn_scan = ""
                       if(response.data[i].status === "1"){
                              status_show = '<label class="badge badge-warning">UnPaired</label>';
                              btn_scan = `<a class="btn btn-primary btn-sm" href="./guest_device/authqr/${response.data[i].id}"><i class="mdi mdi-qrcode-scan icon"></i></a>`;
                            }else if(response.data[i].status === "2"){
                              status_show = '<label class="badge badge-info">Paired</label>';
                              btn_scan = `<a class="btn btn-danger btn-sm" href="./guest_device/logout/${response.data[i].id}">Logout</a>`;
                            }else{
                              status_show = '<label class="badge badge-danger">InActive</label>';
                            }
            $('table').append(`<tr>
            <td>${response.data[i].device_name}</td>
            <td>${response.data[i].api_key}</td>
            <td>${status_show}</td>
            <td>${response.data[i].reg_date}</td>
            <td>${btn_scan}</td>
            </tr>`);
            console.log({device:response.data[i].device_name})
          }
        }
         // You will get response from your PHP page (what you echo or print)
      },
      error: function(err) {
          console.log(err);
        }
      });
    }
    if(window.location.href.includes('guest_list')){
      var data = {
        api_key : localStorage.getItem("session")
      }
      $.ajax({
      url: "http://localhost/wapa/index.php/api/guest_list/list",
      type: "post",
      data: JSON.stringify(data) ,
      contentType:'application/json',
      success: function (response) {
     
        if(response.success){
           var a = 0;
          for(i in response.data){
            a++;
            console.log( response.data[i])
            var button = ` <a href="./guest_contact?id_group=${ response.data[i].id}" class="btn btn-sm btn-success">Contact</a>
          
            <a href="./guest_list/delete/${response.data[i].id}" class="btn btn-sm btn-danger">Delete</a></td>
       `
            $('table').append(`<tr>
            <td>${a}</td>
            <td>${response.data[i].name}</td>
            <td>${response.data[i].contact_active}</td>
            <td>${response.data[i].deskripsi}</td>
            <td>${button}</td>
            </tr>`);
           
          }
        }
         // You will get response from your PHP page (what you echo or print)
      },
      error: function(err) {
          console.log(err);
        }
      });
    }
    if(window.location.href.includes('guest_bulks')){
      var data = {
        api_key : localStorage.getItem("session")
      }
      $.ajax({
      url: "http://localhost/wapa/index.php/api/guest_bulk/list",
      type: "post",
      data: JSON.stringify(data) ,
      contentType:'application/json',
      success: function (response) {
     
        if(response.success){
           var a = 0;
          for(i in response.data){
            a++;
            console.log( response.data[i])
            var button = `
            <a href="./guest_bulk/detail/${response.data[i].id}" class="btn btn-sm btn-success">Detail</a><br>  
            <a href="./guest_bulk/delete/${response.data[i].id}" class="btn btn-sm btn-danger">Delete</a></td>
         `
            
            var status = "";
            if(response.data[i].status === "1"){
              status = "Menunggu Jadwal"
            }else if(response.data[i].status === "2"){
              status = "Berjalan"
            }else if(response.data[i].status === "3"){
              status = "Selesai"
            }else {
              status = "Tidak Berjalan"
            }
    

            $('table').append(`<tr>
            <td>${a}</td>
            <td>${response.data[i].broadcast_name}</td>
            <td>${response.data[i].message}</td>
            <td>${response.data[i].device_name}</td>
            <td>${response.data[i].name_list}</td>
            <td>${response.data[i].date_time}</td>
            <td>${status}</td>
            <td>${button}</td>
            </tr>`);
           
          }
        }
         // You will get response from your PHP page (what you echo or print)
      },
      error: function(err) {
          console.log(err);
        }
      });
    }
    if(window.location.href.includes('guest_contact/add')){

      $( "form" ).submit(function( event ) {
  

            var data = {
              number: $( "#number" ).val(),
              name :$( "#name" ).val(),
              api_key : localStorage.getItem("session"),
              id_group : $( "#id_group" ).val(),
            }
        $.ajax({
          url: "http://localhost/wapa/index.php/api/guest_contact/save",
          type: "post",
          data: JSON.stringify(data) ,
          contentType:'application/json',
          success: function (response) {
            if(response.success){
              window.location.href = "./../guest_contact?id_group="+$( "#id_group" ).val()
            }else{
              alert(response.message)
            }
          },
          error: function(err) {
              console.log(err);
            }
          });
  
           
            return false;
        
          
        event.preventDefault();
        });
      }
    if(window.location.href.includes('guest_device/add')){

    $( "form" ).submit(function( event ) {

      if ( $( "#exampleInputUsername2" ).first().val() !== "" ) {
          var data = {
            device_name :$( "#exampleInputUsername2" ).val(),
            api_key : localStorage.getItem("session")
          }
      $.ajax({
        url: "http://localhost/wapa/index.php/api/guest_device/save",
        type: "post",
        data: JSON.stringify(data) ,
        contentType:'application/json',
        success: function (response) {
          if(response.success){
              window.location.href = "./../guest_list"
            }else{
              alert(response.message)
            }
        },
        error: function(err) {
            console.log(err);
          }
        });

         
          return false;
        }else{
          alert('false')
        
        }
        
      event.preventDefault();
      });
    }
    if(window.location.href.includes('guest_list/add')){
      $('#code_guest').val(localStorage.getItem("session"));
      $( "form" ).submit(function( event ) {
  
    
            var data = {
              deskripsi:$("#deskripsi").val(),
              name :$( "#name" ).val(),
              api_key : localStorage.getItem("session")
            }
        $.ajax({
          url: "http://localhost/wapa/index.php/api/guest_list/save",
          type: "post",
          data: JSON.stringify(data) ,
          contentType:'application/json',
          success: function (response) {
            if(response.success){
              window.location.href = "./../guest_list"
            }else{
              alert(response.message)
            }
            
             // You will get response from your PHP page (what you echo or print)
          },
          error: function(err) {
              console.log(err);
            }
          });
  
           
            return false;
        
          
        event.preventDefault();
        });
      }


    if(url.includes("/guest_device/authqr/") ){
      var urla = window.location.pathname;
      var arr = urla.split('/')
  
      console.log(arr[4])
      var id_device = $("#id_device").val()

      console.log("change qr")
      var timeleft = 15;
      var downloadTimer = setInterval(function(){
      timeleft--;
      document.getElementById("countdowntimer").textContent = timeleft;
      if(timeleft <= 0)
          clearInterval(downloadTimer);
          if(timeleft < 1){
              window.location.reload();
          }
      },1000);
      
      setInterval(() => {
          console.log("change qr")
       

          $.ajax({
              url: url + "./../../../api/guest_device/detail/"+id_device,
              type: "get",
              dataType: 'json',
              success: function (hasil) {
                // console.log(hasil)
                // Put the object into storage
                if (hasil.success) {
                  if(hasil.data.instance_status === "connected"){
                      // window.location.href = "./../../guest_devices"
                      // history.back()
                      alert('back')
                  }
                  $('#qrcode').html("")
                  console.log(hasil.data.qr)
                  // $('#qrcode').qrcode({width: 200,height: 200,text: hasil.data.qrCode});
                  $('#qrcode').html(`<img src="${hasil.data.qr}">`);
                } else {
                  alert(hasil.message)
                }
              }
            })
      }, 3000);


    }
    else if(url.includes("/guest_bulk/add")){
      $('#api_key').val(localStorage.getItem("session"));
      var data = {
        api_key : localStorage.getItem("session")
      }
      $.ajax({
      url: "http://localhost/wapa/index.php/api/guest_device/list",
      type: "post",
      data: JSON.stringify(data) ,
      contentType:'application/json',
      success: function (response) {
     
        if(response.success){
          for(i in response.data){
          
            $('#device').append(`<option value="${response.data[i].id}">${response.data[i].device_name}</option`);
            console.log({device:response.data[i].device_name})
          }
        }
         // You will get response from your PHP page (what you echo or print)
      },
      error: function(err) {
          console.log(err);
        }
      });
      $.ajax({
        url: "http://localhost/wapa/index.php/api/guest_list/list",
        type: "post",
        data: JSON.stringify(data) ,
        contentType:'application/json',
        success: function (response) {
       
          if(response.success){
            for(i in response.data){
            
              $('#list').append(`<option value="${response.data[i].id}">${response.data[i].name}</option`);
         
            }
          }
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(err) {
            console.log(err);
          }
        });
    }
    else if(url.includes("/device/authqr/") ){
        var urla = window.location.pathname;
        var arr = urla.split('/')
    
        console.log(arr[4])
        var id_device = $("#id_device").val()

        console.log("change qr")
        var timeleft = 15;
        var downloadTimer = setInterval(function(){
        timeleft--;
        document.getElementById("countdowntimer").textContent = timeleft;
        if(timeleft <= 0)
            clearInterval(downloadTimer);
            if(timeleft < 1){
                window.location.reload();
            }
        },1000);
        
        setInterval(() => {
            console.log("change qr")
         

            $.ajax({
                url: url + "./../../../api/device/detail/"+id_device,
                type: "get",
                dataType: 'json',
                success: function (hasil) {
                  // console.log(hasil)
                  // Put the object into storage
                  if (hasil.success) {
                    if(hasil.data.instance_status === "connected"){
                        window.location.href = "./../../device"
                    }
                    $('#qrcode').html("")
                    console.log(hasil.data.qr)
                    // $('#qrcode').qrcode({width: 200,height: 200,text: hasil.data.qrCode});
                    $('#qrcode').html(`<img src="${hasil.data.qr}">`);
                  } else {
                    alert(hasil.message)
                  }
                }
              })
        }, 3000);


    } else if(url.includes("/virtualdevice/authqr/") ){
      var urla = window.location.pathname;
      var arr = urla.split('/')
   
      console.log(arr[4])
      var id_device = $("#id_device").val()

      console.log("change qr")
      var timeleft = 15;
      var downloadTimer = setInterval(function(){
      timeleft--;
      document.getElementById("countdowntimer").textContent = timeleft;
      if(timeleft <= 0)
          clearInterval(downloadTimer);
          if(timeleft < 1){
              window.location.reload();
          }
      },1000);
      
      setInterval(() => {
          console.log("change qr")
       

          $.ajax({
              url: url + "./../../../api/vdevice/detail/"+id_device,
              type: "get",
              dataType: 'json',
              success: function (hasil) {
                // console.log(hasil)
                // Put the object into storage
                if (hasil.success) {
                  if(hasil.data.instance_status === "connected"){
                      window.location.href = "./../../device"
                  }
                  $('#qrcode').html("")
                  console.log(hasil.data.qr)
                  // $('#qrcode').qrcode({width: 200,height: 200,text: hasil.data.qrCode});
                  $('#qrcode').html(`<img src="${hasil.data.qr}">`);
                } else {
                  alert(hasil.message)
                }
              }
            })
      }, 3000);


  }
    else if(url.includes("/billing_panel")){
     
      $('#mymodal').on('show.bs.modal', function(e) {
       
        var button = $(e.relatedTarget);
        var modal = $(this);
        console.log(button.data("remote"))
        document.getElementById('iframeLoad').src = button.data("remote");
        // modal.find('.modal-body').load(button.data("remote"));
    });
    }
    else if(url.includes("/messageOut/add")){
   
        console.log('hello')
        function getFormData($form){
          var unindexed_array = $form.serializeArray();
          var indexed_array = {};
      
          $.map(unindexed_array, function(n, i){
              indexed_array[n['name']] = n['value'];
          });
          console.log(indexed_array)
          return indexed_array;
      }

        $("form").submit(function () {
          $.ajax({
            url: $(this).attr("action"),
            data: JSON.stringify(getFormData($(this))),
            type: $(this).attr("method"),
            processData: true,
            dataType: 'application/json; charset=UTF-8',
            beforeSend: function () {
              $("button").attr("disabled", true);
            },
            complete: function (data) {
              var response = JSON.parse(data.responseText);
              alert(response.message)
              if(response.success){
                window.location.href = "./../messageOut";
              }
            
            
              $("button").attr("disabled", false);
            }
          })
          return false;
        });
    }
    function loadIframe(url) {
      document.getElementById('iframeLoad').src = url;
    }
    function handleClick(url,instance_key,multidevice) {
     
      $.ajax({
        
        url: url,
        data: {
          instance_key : instance_key,
          multidevice : multidevice
        },
        type: "post",
        dataType: 'json',
       success : function (results) {
         alert(results.message)
         location.reload()
       }
      })
    }
 
   
