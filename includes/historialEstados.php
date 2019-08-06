<?
$conexion = Conexion::Conectar();
$sentencia = $conexion->prepare("SELECT * FROM estado WHERE DNI = :DNI"); 
$sentencia->bindParam(":DNI",$_GET['DNI']);
$sentencia->execute();
?>
<div id="main_area" style="padding: 5%;">
    <!-- Slider -->
    <h1>Historial de estados</h1>
    <div class="row">
        <div class="col-sm-6" id="slider-thumbs">
            <!-- Bottom switcher of slider -->
            <ul class="hide-bullets">
                <?
                while($row = $sentencia->fetch()){
                    echo '<li class="col-sm-6">';
                    $img = substr($row['estado'], 3);
                    echo '<a class="thumbnail" id="carousel-selector-'.$row['idEstado'].'"><img src="'.$img.'"></a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="col-xs-12" id="slider">
                <!-- Top part of the slider -->
                <div class="row">
                    <div class="col-sm-12" id="carousel-bounding-box">
                        <div class="carousel slide" id="myCarouselSlider">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <?
                                $sentencia->execute();
                                $row = $sentencia->fetch();
                                $img = substr($row['estado'], 3);
                                echo '<div class="active item" data-slide-number="'.$row['idEstado'].'"><img src="'.$img.'"></div>';
                                while ($row = $sentencia->fetch()){
                                    $img = substr($row['estado'], 3);
                                    echo '<div class="item" data-slide-number="'.$row['idEstado'].'"><img src="'.$img.'"></div>';
                                }
                                ?>
                                <!-- Carousel nav -->
                                <a class="left carousel-control" href="#myCarouselSlider" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#myCarouselSlider" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Slider-->
        </div>
    </div>
</div>
<script>
  jQuery(document).ready(function($) {
 
        $('#myCarouselSlider').carousel({
                interval: 5000
        });
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarouselSlider').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarouselSlider').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});
</script>
