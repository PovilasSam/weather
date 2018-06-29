<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <style>
    .btn-secondary {
      background-color: green;
    }
    .temp {
      text-align: right;
    }
    .button.nav-link {
      background-color: #fff;
    }
    h2 {
      text-align: center;
      margin-top: 30px;
    }
    </style>
  </head>
  <body>
    <h2>Simple weather app</h2>
    <div class='container-fluid'>
      <div class='container'>
    <div class='row'>
    <div class='col-6'>
    <form method="post" id='initial'>
      @csrf
      <input type="text" class='form-control' id='api' placeholder="API Key" name="APIKey" style='margin: 30px 0;'>
      <div class="input-group">
  <input type="text" class="form-control" id='city' name='city' placeholder="City" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button class="btn btn-secondary" type="submit"><i class="fas fa-check"></i></button>
  </div>
</div>
    </form>
  </div>
  <div class='col-6'>
    <div id='cont'>
    <ul class="nav nav-tabs justify-content-end" style='margin-top: 30px;'>
    </ul>
    <div class='temp'></div>
  </div>
</div>
</div>
</div>
</div>
    <script>
    $('#initial').on('submit', function(e) {
      //Get form data
        var data = $(this).serialize();
        var url = window.location.href;
        var city = $('#city').val();
        var api = $('#api').val();
        //Prevent from submition
        e.preventDefault();
        //Ajax POST to back-end
        $.post(url, data, function(data){
          //remove active tab class
          $('.nav-link').removeClass('active');
          //Add dynamic tabs
          $("ul").append('<form method="post" class="cities">@csrf<input type="hidden" name="city" value="'+city+'"><input type="hidden" name="APIKey" value="'+api+'"><li class="nav-item"><button type="submit" class="nav-link active">'+city+'</button></li></form>');
          $('.temp').html('Temperatura: '+data+' &#8451;');
        });
  });
    //Switching between tabs (again AJAX request)
    $('#cont').on('submit', '.cities', function (e) {
      $('.nav-link').removeClass('active');
      $(this).find('.nav-link').addClass('active');
      var data = $(this).serialize();
      var url = window.location.href;
      e.preventDefault();
      $.post(url, data, function(data){
        $('.temp').html('Temperatura: '+data+' &#8451;');
      });
    });
    </script>
  </body>
</html>
