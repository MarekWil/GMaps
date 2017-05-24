<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Marek Wilga">

    <title>GMaps</title>

    <!-- Bootstrap -->


    <script src="./jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="./file_input/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />


		<script src="./file_input/js/fileinput.min.js"></script>
		<script src="./file_input/js/locales/pl.js"></script>

    <!-- CSS -->
    <style>
    body {
        padding-top: 70px;

    }
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" id="open_file">Wczytaj plik z współrzędnymi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="open_file_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <label class="control-label">Wybierz plik</label>
              <input id="geo_cords_file" name="geo_cords_file" type="file" class="file" data-show-preview="false">
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-success" value="Prześlij" name="submit">
              <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
            </div>

        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="container">


        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="googleMap" style="width:100%;height:600px"></div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->





    <script>
    $("#open_file").on('click', function(event) {
      event.preventDefault();
      $("#open_file_modal").modal("show");
    });

    $(document).ready(myMap);
    var map;

    function myMap() {
      var mapProp= {
        center:new google.maps.LatLng(52.219500, 21.681398),
        zoom:5,
      };
      map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
      var myCenter = new google.maps.LatLng(52.219500, 21.681398);
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPFuRgPwoz1mbiVb6XZXWX14mofuQdcmQ&callback=myMap"></script>
    <script>

    </script>
    <script>
      $("#geo_cords_file").fileinput({
      	language: "pl",
      	uploadUrl: '<?php echo __DIR__."/c_upload.php"?>',
      	allowerdFileExtensions: ["txt"]
      });


    </script>
    <script>
        $('#geo_cords_file').on('fileuploaded', function(event, data, previewId, index) {
          var form = data.form, files = data.files, extra = data.extra,
              response = data.response, reader = data.reader;
          console.log(response[0]['longitude']);
          $.each(response, function(index, el) {
            var myCenter = new google.maps.LatLng(response[index]['longitude'], response[index]['latitude']);
            var marker = new google.maps.Marker({position: myCenter});
            marker.setMap(map);
            var infowindow = new google.maps.InfoWindow({
              content: response[index]['name']
            });
            infowindow.open(map,marker);
          });

      });
    </script>
</body>

</html>
