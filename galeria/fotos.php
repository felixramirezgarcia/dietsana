<br><br>
<div id="main_area">
    <!-- Slider -->
    <div class="row">
        <div class="col-sm-6" id="slider-thumbs">
            <!-- Bottom switcher of slider -->
            <ul class="hide-bullets">
                    <li class="col-sm-4">
                        <a class="thumbnail" id="carousel-selector-4"><img src="images/slider-4.jpg"></a>
                    </li>
                    <li class="col-sm-4">
                        <a class="thumbnail" id="carousel-selector-5"><img src="images/slider-5.jpg"></a>
                    </li>
                    <li class="col-sm-4">
                        <a class="thumbnail" id="carousel-selector-6"><img src="images/slider-6.jpg"></a>
                    </li>
                    <li class="col-sm-4">
                        <a class="thumbnail" id="carousel-selector-1"><img src="images/slider-1.jpg"></a>
                    </li>
                    <li class="col-sm-4">
                        <a class="thumbnail" id="carousel-selector-2"><img src="images/slider-2.jpg"></a>
                    </li>
                    <li class="col-sm-4">
                        <a class="thumbnail" id="carousel-selector-3"><img src="images/slider-3.jpg"></a>
                    </li>
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
                                <div class="active item" data-slide-number="1"><img src="images/slider-1.jpg"></div>
                                <div class="item" data-slide-number="4"><img src="images/slider-4.jpg"></div>
                                <div class="item" data-slide-number="5"><img src="images/slider-5.jpg"></div>
                                <div class="item" data-slide-number="6"><img src="images/slider-6.jpg"></div>
                                <div class="item" data-slide-number="1"><img src="images/slider-1.jpg"></div>
                                <div class="item" data-slide-number="2"><img src="images/slider-2.jpg"></div>
                                <div class="item" data-slide-number="3"><img src="images/slider-3.jpg"></div>
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
