var kue = require('kue')
  , express = require('express');
const bodyParser = require('body-parser');
const { url } = require('inspector');
const axios = require('axios')


// create our job queue

var jobs = kue.createQueue();

function create2(process_name,url, nomor,id_user) {

  jobs.create(process_name, {
    title: 'checking number: ' + nomor + '', id_user:id_user,url:url, user: 1, frames: 200
  }).save();
  // setTimeout( create, Math.random() * 3000 | 0 );
}


// process video conversion jobs, 2 at a time.

jobs.process('check-number', 10, function (job, done) {
  var nomor = job.data.nomor
  var id_user = job.data.id_user
  var url = (job.data.url)?job.data.url:"http://localhost/panel_dompul/index.php/api/checknumber";
  console.log({ "event": job.type, "data": job.data });
  axios.post(url, {
    nomor: nomor,
    id_user:id_user
  }).then((response) => {
    console.log(response.data)
   
  }).catch((error) => {
    console.log(error);
  })
  setTimeout(done, Math.random() * 3000);
});

kue.app.use(bodyParser.json());
kue.app.use(bodyParser.urlencoded({ extended: false }));

kue.app.post('/add-queue', (req, res) => {
  create2("check-number",req.body.url, req.body.nomor, req.body.id_user)
  console.log(req.body)
  res.json({ success: true, message: "data in queue",data:{nomor:req.body.nomor }})
})


// start the UI
kue.app.listen(3001);
console.log('UI started on port 3001');

