<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://momentjs.com/downloads/moment.min.js'></script>

<script src="http://localhost:3000/socket.io/socket.io.js"></script>

<script  src="<?=base_url("assets/chatpen/script.js")?>"></script>
<script>
  $( document ).ready(function() {
    console.log( "ready!" );

    refreshChat();
    listChats();
   
    function refreshChat(){
      $.ajax({
        url: 'http://localhost/wapa/index.php/api/listMessages',
                data:JSON.stringify({
                  instance_key:"OiPRYJMdbogl"
                }),
                type: "POST",
                dataType: 'json',
                beforeSend:function(xhr){
                 $('#loader-chat').show();

                },
                success: function (results) {
                  $('#loader-chat').hide();
                }
      })
    }
    function listChats(){
      $.ajax({
                url: 'http://localhost/wapa/index.php/api/listChats',
                data:JSON.stringify({
                  instance_key:"OiPRYJMdbogl"
                }),
                type: "POST",
                dataType: 'json',
                beforeSend:function(xhr){
                 $('#loader-chat').show();

                },
                success: function (results) {
                  $('#loader-chat').hide();

                  // Put the object into storage
                 if(results.success){
                   var data = results.data

                   for(i in data){
                     var pp = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                     if(data[i].foto_profil !== ""){
                       pp = data[i].foto_profil
                     }
                     var pushName = data[i].pushName
                     var isGroup = (data[i].jid.includes("g.us"))?true:false;

                      $('.messages-page__list').append(`
                                        <li class="messaging-member a_${data[i].jid.substr(0,data[i].jid.length-15)}"  id="${data[i].jid}" onclick="switchRoom('${data[i].jid}')">
                                          <div class="messaging-member__wrapper">
                                            <div class="messaging-member__avatar">
                                              <img class="" src="${pp}" alt="Courtney Simmons" loading="lazy">
                                              ${(isGroup === false)?`<div class="user-status">${(data[i].unreadCount > 0)?data[i].unreadCount:''}</div>
                                            `:''}

                                            </div>

                                              <span class="messaging-member__name">${(pushName === "")?data[i].jid.substr(0,data[i].jid.length-15):pushName} ${ (isGroup===true)?'[Group]':''}</span>
                                            <span class="messaging-member__message">...</span>
                                          </div>
                                        </li>
                                        `)

                                        if(i < 10){
                                          getLastMessage(data[i].jid,i)
                                          
                                        }
                                        // if(i < 20){
                                        //   getImagesPp(data[i].jid,i)
                                        // }

                                    // var pp = getPp(`62895361034833@s.whatsapp.net`)
                    }
                    $('.messaging-member').click(function(e)
                      {

                        $('#welcome-chat').hide();
                        $("#body-chat").show();

                        $('.chat-member__avatar').find("img").attr("src",$(this).find("img").attr("src"))
                        $('.chat-member__name').text($(this).find(".messaging-member__name").text())

                        $('.user-profile__avatar').find("img").attr("src",$(this).find("img").attr("src"))
                        $('.user-profile__phone').text($(this).attr("id"))
                        $('.user-profile__name').text($(this).find(".messaging-member__name").text())
                        $('#jid').val($(this).attr("id"))
                        $('#instance_key').val("OiPRYJMdbogl")
                        $('.messages-page__list').find('.messaging-member').removeClass("messaging-member--active")
                        $($(this).addClass("messaging-member--active"))
                        getChat($(this).attr("id"),'OiPRYJMdbogl')


                    });


                 }

                 function getLastMessage(id,i){
                  $.ajax({
                      url: 'http://localhost:8000/groups/getLastMessages?id=OiPRYJMdbogl',
                      data:{
                        jid:id
                      },
                      type: "POST",
                      dataType: 'json',
                      beforeSend:function(xhr){

                      },
                      success:function(results){
                        if(results.success){


                          var lastmessage = results.data[0]?.message
                          var getid = id.substr(0,id.length-15)
                          if(lastmessage){


                              var keyobj = Object.keys(lastmessage);
                              if(keyobj[0]==="conversation"){
                                var text =lastmessage.conversation
                              }else if(keyobj[0]==="extendedTextMessage") {
                                var text =lastmessage.extendedTextMessage.text
                              }else{
                                var text = "-"
                              }
                              $('.a_'+getid).find(".messaging-member__message").text(text)
                              var pushName = results.data[0]?.pushName
                              if(pushName){
                                $('.a_'+getid).find(".messaging-member__name").text(pushName)
                              }

                          }


                        }
                      }
                    })
                    }
                    function getImagesPp(id,i){
                    $.ajax({
                                      url: 'http://localhost/wapa/index.php/api/getImages',
                                      data:JSON.stringify({
                                        jid:id,
                                        instance_key:'OiPRYJMdbogl'
                                        }),
                                      type: "POST",
                                      dataType: 'json',
                                      success:function(results){
                                       
                                      }
                                    })
                          }
                 }
                

              })


    };
  });
  function getChat(id,instance_key){
  
                  $.ajax({
                          url:`http://localhost:8000/chats/${id}?id=${instance_key}&limit=25&cursor_id=&cursor_fromMe=true`,

                          type: "GET",
                          dataType: 'json',
                          beforeSend:function(xhr){
                            // console.log('before')
                            $('.chat__list-messages').html("")
                            $('#loader-chat2').show();
                          },
                          success:function(results){
                            $('#loader-chat2').hide();
                            if(results.success){
                              var data = results.data


                              var dtanggal = [];
                              for(i in data){


                                var fromMe = data[i].key.fromMe
                                var timestamp = data[i].messageTimestamp

                                var tanggal = moment.unix(timestamp).format("h:m:s a");

                                var tanggal2 = moment.unix(timestamp).format("DD MMMM YYYY");

                                if(data[i]?.message){

                                var typeMessage = data[i].message

                                var keyobj = Object?.keys(typeMessage);

                                if(keyobj[0]==="conversation"){
                                  var text =typeMessage.conversation
                                }else if(keyobj[0]==="extendedTextMessage") {
                                  var text =typeMessage.extendedTextMessage.text
                                }else if(keyobj[0]==="documentMessage") {
                                  var text = `<a href="#" style="color:white">${typeMessage.documentMessage.title}</a>`
                                }else{
                                  var text = JSON.stringify(typeMessage)
                                }
                                if(i > 1){
                                  var timestamp = data[i-1].messageTimestamp
                                  var tanggal_before =moment.unix(timestamp).format("DD MMMM YYYY");
                                  if(tanggal2 !== tanggal_before){
                                      $('.chat__list-messages').append(` <div class="chat__time">${tanggal2}</div>`)
                                  }
                                }

                                if(fromMe){
                                  $('.chat__list-messages').append(`<li id="chat_${i}">
                                        <div class="chat__bubble chat__bubble--me">
                                        ${text}
                                          <br><span style="float:right;font-size:10px">${tanggal}</span>
                                          </div>
                                      </li>`)

                                }else{
                                  $('.chat__list-messages').append(` <li id="chat_${i}">
                                      <div class="chat__bubble chat__bubble--you">
                                      ${text}
                                        <br><span style="color:white;float:right;font-size:10px">${tanggal}</span>
                                      </div>

                                    </li>`)
                                }}
                                window.location.href= "#chat_"+i
                              }
                              var grouped = dtanggal.reduce((r, v, i, a) => {
                                  if (v === a[i - 1]) {
                                      r[r.length - 1].push(v);
                                  } else {
                                      r.push(v === a[i + 1] ? [v] : v);
                                  }
                                  return r;
                              }, []);

                            console.log(grouped);
                            // console.log(dtanggal)
                            }
                          }
                        })
                      
                      }
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
            url: "http://localhost/wapa/index.php/api/sendMessageText",
            data: JSON.stringify(getFormData($(this))),
            type: $(this).attr("method"),
            processData: true,
            dataType: 'application/json; charset=UTF-8',
            beforeSend: function () {
              $("button").attr("disabled", true);
              var date = new Date()
              $('.chat__list-messages').append(`<li id="chat_last">
                                        <div class="chat__bubble chat__bubble--me">
                                        ${$("#message").val()}
                                          <br><span style="float:right;font-size:10px">${date.toLocaleTimeString()}</span>
                                          </div>
                                      </li>`)
              window.location.href= "#chat_last"
              $("#message").val("")
            },
            complete: function (data) {
              console.log(data)
              $("button").attr("disabled", false);
              var jid = $("#jid").val()
              var instance_key = $("#instance_key").val()

            }
          })
          return false;
  });
 
  
  var socket = io.connect('http://localhost:3000');
    // on connection to server, ask for user's name with an anonymous callback
    socket.on('connect', function(){
      // call the server-side function 'adduser' and send one parameter (value of prompt)
     
      socket.emit('adduser', "client wa");
    });

    // listener, whenever the server emits 'updatechat', this updates the chat body
    socket.on('updatechat', function (username, data) {
     
      $('#conversation').append('<b>'+username + ':</b> ' + data + '<br>');
      var date = new Date()
      var dtimestamp = Math.floor(Date.now() / 1000)

    
      $('.chat__list-messages').append(` <li id="chat_last_${dtimestamp}">
                                          <div class="chat__bubble chat__bubble--you">
                                          ${data}
                                            <br><span style="color:white;float:right;font-size:10px">${date.toLocaleTimeString()}</span>
                                          </div>

                                        </li>`);
                                        window.location.href= `#chat_last_${dtimestamp}`

    });

    // listener, whenever the server emits 'updaterooms', this updates the room the client is in
    socket.on('updaterooms', function(rooms, current_room) {
      $('#rooms').empty();
      $.each(rooms, function(key, value) {
        if(value == current_room){
          $('#rooms').append('<div>' + value + '</div>');
        }
        else {
          $('#rooms').append('<div><a href="#" onclick="switchRoom(\''+value+'\')">' + value + '</a></div>');
        }
      });
    });
    function switchRoom(room){
      socket.emit('switchRoom', room);
      }
  



</script>
</body>
</html>
