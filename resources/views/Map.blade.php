@extends('layouts.estrutu')
@section('title', 'Mapa')
@section('content')

    <div class="row" style="height:650px; width:137%;margin-left:-18%">
      <div id="map" class="col" style="background-color:#2D4739"></div>
      <div id="info" class="col-2" style="background-color:#ffff;display:none">
        <i onclick="fechar()" class="fas fa-times fechar" style="float:right;margin-right:-2%;margin-top:2%;"></i>
        <h2 style="text-align:center">Titulo</h2>
        <p><b>Dono:</b><br> José Marques</p>
        <p><b>Área:</b><br> 112 m2</p>
        <p><b>Nº Registo:</b><br> 54545787</p>
        <p><b>Artigo Marticial</b><br><a> Documento.pdf</a></p>
        <p><b>Preço:</b><br> 30€ metro</p>
       <a href="/ownerpro"> <button style="display: block; margin: 0 auto;width:80%;" type="button" class="btn btn-success">Perfil Dono</button></a>
      </div>
    </div>

  </div>  
  <script>
    function fechar() {
      document.getElementById("info").style.display = "none";
}
      
    </script> 
  <script>
  
    function initialize() {
      var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: new google.maps.LatLng(41.365, -8.199),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            noClear: true
      });
      map.controls[google.maps.ControlPosition.RIGHT_BOTTOM]
        .push(document.getElementById('save-button'));
      map.controls[google.maps.ControlPosition.RIGHT_BOTTOM]
        .push(document.getElementById('delete-button'));
      var polyOptions = {
        strokeWeight: 3,
        fillOpacity: 0.2
      };

      var shapes = {
        collection: {},
        selectedShape: null,
        add: function (e, s) {
          var shape = e.overlay,
            that = this;
          shape.type = e.type;
          shape.id = new Date().getTime() + '_' + Math.floor(Math.random() * 1000);
          this.collection[shape.id] = shape;
          if (!s) this.setSelection(shape);
          google.maps.event.addListener(shape, 'click', function () {
            that.setSelection(this);
            document.getElementById("info").style.display = "unset";
          });
        },
        setSelection: function (shape) {
          if (this.selectedShape !== shape) {
            this.clearSelection();
            this.selectedShape = shape;
            shape.set('draggable', false);
            shape.set('editable', false);
          }
        },
        deleteSelected: function () {

          if (this.selectedShape) {
            var shape = this.selectedShape;
            this.clearSelection();
            shape.setMap(null);
            delete this.collection[shape.id];
          }
        },


        clearSelection: function () {
          if (this.selectedShape) {
            this.selectedShape.set('draggable', false);
            this.selectedShape.set('editable', false);
            this.selectedShape = null;
          }
        },
        save: function () {
          var collection = [];
          for (var k in this.collection) {
            var shape = this.collection[k],
              types = google.maps.drawing.OverlayType;
            switch (shape.type) {
              case types.POLYGON:
                collection.push({
                  type: shape.type,
                  path: google.maps.geometry.encoding
                    .encodePath(shape.getPath())
                });
                break;
              default:
                alert('implement a storage-method for ' + shape.type)
            }
          }
          //collection is the result
          console.log(JSON.stringify(collection));
          return collection;
        },
        load: function (arr) {
          var types = google.maps.drawing.OverlayType;
          for (var i = 0; i < arr.length; ++i) {
            switch (arr[i].type) {
              case types.POLYGON:
                var shape = new google.maps.Polygon(polyOptions);
                shape.setOptions({
                  fillColor: 'red',
                  map: map,
                  path: google.maps.geometry.encoding
                    .decodePath(arr[i].path)
                });
                shapes.add({ type: types.POLYGON, overlay: shape }, true)
                break;
              default:
                alert('implement a loading-method for ' + arr[i].type)
            }
          }
        }
      }
      
      //initially load some shapes
      shapes.load([ <?php echo $plot ?> ]);
      var drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: false
      });

      google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
        drawingManager.setDrawingMode(null);
        shapes.add(e);
      });


    }
  </script>                                                                                                                                           
  
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDvX007W2OyOt6zHqGyF5uIXpRBw16MRJ0&libraries=drawing,geometry,places&v=3&callback=initialize">async defer</script>

@endsection