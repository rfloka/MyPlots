
 
@extends('layouts.estrutu')
@section('title', 'Editar Terreno')
@section('content') 
@if($errors->any())
<div class="alert alert-danger"  role="alert">
        O numero de registo inserido já existe
    </div>
@endif
<div id="alerta" class="alert alert-warning" style="display:none" role="alert">
    Antes de Guardar o poligno certefique-se tem um poligno Guardado
</div>
<div id="map" class="col" style="background-color:#2D4739;height:0vh;">
    <button id="fechar-button" onclick="diminuir()" class="btn btn-danger" disabled><i class="fas fa-times"></i></button>
    <button id="delete-button" class="btn btn-danger" disabled>Eliminar Poligno</button>
    <hr>
    <button id="save-button" class="btn btn-success" disabled>Guardar Poligno</button>
</div>

<div class="card" style="width:100%;">
    <button style="width:20%;margin-left:40%;" onclick="aumentar()" class="btn btn-warning" >Adicionar Mapa</button>
    <form method="post" action="{{URL::to('/store')}}" enctype="multipart/form-data">
        <div class="card-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input id="coordenada" class="form-control" name="coordenadas" style="display:none" />
            <input id="shapeid" class="form-control" name="shapeid" style="display:none" />    
            <div class="form-group">
                    <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="id" value="{{$users->id}}" style="display:none">
                            <input type="text" class="form-control" name="nome" value="{{$users->name}}" readonly placeholder="Insira a Morada do Terreno" required>
                        </div>
                <label>Morada</label>
                <input type="text" class="form-control" name="morada" placeholder="Insira a Morada do Terreno" 
                    required>
            </div>
            <div class="form-group">
                <label>Area</label>
                <input type="number" class="form-control" name="area" placeholder="Insira a Area do Terreno" 
                    required>
            </div>
            <div class="form-group">
                <label>Numero de Registo</label>
                <input type="number" class="form-control" name="numero" placeholder="Insira o numero de registo do Terreno"
                     required>
            </div>
            <div class="form-group">
                    <label>Tipo de Solo</label><br>
                    <select class="form-control" name="tipo_solo">
                        <option value="Rustico">Rustico</option>
                        <option value="Urbano">Urbano</option>
                    </select>
            </div>
            <div class="form-group">
                    <label>Caderneta Perdial</label><br>
                    <input type="file"  name="artigo" placeholder="Insira a Caderneta Perdial do terreno" required>
            </div>
            <button id="submit" style="background-color:#09814A;" type="submit" class="btn btn-success" disabled>Adicionar Terreno</button>
    </form>
</div>
</div>
<script>
    function aumentar() {
        document.getElementById("alerta").style.display = "";
        document.getElementById("map").style.height = "80vh";
        document.getElementById("delete-button").disabled = false;
        document.getElementById("save-button").disabled = false;
        document.getElementById("fechar-button").disabled = false;
    }

</script>
<script>
    function diminuir() {
        document.getElementById("alerta").style.display = "none";
        document.getElementById("map").style.height = "0vh";
        document.getElementById("delete-button").disabled = true;
        document.getElementById("save-button").disabled = true;
        document.getElementById("fechar-button").disabled = true;
    }

</script>
<script>
    function initialize() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: new google.maps.LatLng(41.365, -8.199),
            gestureHandling: 'cooperative',
            mapTypeId: google.maps.MapTypeId.HYBRID,
            noClear: true

        });
        map.controls[google.maps.ControlPosition.TOP]
            .push(document.getElementById('save-button'));
        map.controls[google.maps.ControlPosition.TOP]
            .push(document.getElementById('delete-button'));
        map.controls[google.maps.ControlPosition.TOP_RIGHT]
            .push(document.getElementById('fechar-button'));
        var polyOptions = {
            fillColor: 'Yellow',
            strokeWeight: 1.2,
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
                document.getElementById("shapeid").value = shape.id;
                this.collection[shape.id] = shape;
                if (!s) this.setSelection(shape);
                google.maps.event.addListener(shape, 'click', function () {
                    that.setSelection(this);
                });
            },
            setSelection: function (shape) {
                if (this.selectedShape !== shape) {
                    this.clearSelection();
                    this.selectedShape = shape;
                    shape.set('draggable', false);
                    shape.set('editable', true);
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
                var coor = JSON.stringify(collection)
                document.getElementById("coordenada").value = coor;
                document.getElementById("delete-button").disabled = false;
                document.getElementById("submit").disabled = false;
                return collection;

            },
            
        };

        //initially load some shapes
        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingControl: true,
            drawingControlOptions: {
                drawingModes: ['polygon']
            },
            polygonOptions: polyOptions,
            map: map
        });

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
            drawingManager.setDrawingMode(null);
            shapes.add(e);
        });


        google.maps.event.addListener(drawingManager,
            'drawingmode_changed',
            function () {
                shapes.clearSelection();
            });
        google.maps.event.addListener(map,
            'click',
            function () {
                shapes.clearSelection();
            });
        google.maps.event.addDomListener(document.getElementById('delete-button'),
            'click',
            function () {
                shapes.deleteSelected();
            });
        google.maps.event.addDomListener(document.getElementById('save-button'),
            'click',
            function () {
                shapes.save();
            });

    }

</script>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDvX007W2OyOt6zHqGyF5uIXpRBw16MRJ0&libraries=drawing,geometry,places&v=3&callback=initialize">
    async defer

</script>

@endsection
