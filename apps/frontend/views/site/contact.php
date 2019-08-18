
<?php
use kartik\alert\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title='Liên Hệ';
?>
<?php

if (Yii::$app->session->getFlash('alertSuccess') != null) {
    Yii::$app->session->setFlash('success', Yii::$app->session->getFlash('alertSuccess'));
}
if (Yii::$app->session->getFlash('alertFail') != null) {
    Yii::$app->session->setFlash('error', Yii::$app->session->getFlash('alertFail'));
};
?>

<section id="page-title">

    <div class="container clearfix">
        <h1>Contact</h1>
        <span>Get in Touch with Us</span>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Google Map
============================================= -->
<section id="google-map" class="gmap slider-parallax">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.093677239543!2d106.69097251533456!3d10.880479360238455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d7d9249c8b5d%3A0x7adf02d13d206719!2zODEsIDE2IFbEqW5oIFBow7ogMzgsIFbEqW5oIFBow7osIFRodeG6rW4gQW4sIELDrG5oIETGsMahbmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1566065028491!5m2!1svi!2s"
            width="100%" height="450" frameborder="0" style="border:0" allowfullscreen>
    </iframe>
</section>


<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Postcontent
            ============================================= -->
            <div class="postcontent nobottommargin">

                <h3>Send us an Email</h3>

                <div class="contact-widget">

                    <div class="contact-form-result"></div>

                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'action' => '/site/create-contact']); ?>

                    <div class="form-process"></div>

                        <div class="col_one_third">
                            <label for="template-contactform-name">Name <small>*</small></label>
                            <?php echo $form->field($modelContact, 'name')->label(false) ?>
                        </div>

                        <div class="col_one_third">
                            <label for="template-contactform-email">Email <small>*</small></label>
                            <?php echo $form->field($modelContact, 'email')->label(false) ?>
                        </div>

                        <div class="col_one_third col_last">
                            <label for="template-contactform-phone">Phone</label>
                            <?php echo $form->field($modelContact, 'phone')->label(false) ?>
                        </div>

                        <div class="clear"></div>

                        <div class="col_two_third">
                            <label for="template-contactform-subject">Subject <small>*</small></label>
                            <?php echo $form->field($modelContact, 'subject')->label(false) ?>
                        </div>

                        <div class="clear"></div>

                        <div class="col_full">
                            <label for="template-contactform-message">Message<small>*</small></label>
                            <?php echo $form->field($modelContact, 'body')->textArea(['rows' => 6])->label(false) ?>
                        </div>

                        <div class="reservation-btn text-center">
                            <?= \yii\helpers\Html::submitButton('<span>Gửi Yêu Cầu</span>', ['class' => 'default-btn']) ?>
                        </div>


                    <?php ActiveForm::end(); ?>
                </div>

            </div><!-- .postcontent end -->

            <!-- Sidebar
            ============================================= -->
            <div class="sidebar col_last nobottommargin">

                <address>
                    <strong>Headquarters:</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                </address>
                <abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
                <abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
                <abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com

                <div class="widget noborder notoppadding">

                    <div class="fslider customjs testimonial twitter-scroll twitter-feed" data-username="envato" data-count="3" data-animation="slide" data-arrows="false">
                        <i class="i-plain i-small color icon-twitter nobottommargin" style="margin-right: 15px;"></i>
                        <div class="flexslider" style="width: auto;">
                            <div class="slider-wrap">
                                <div class="slide"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="widget noborder notoppadding">

                    <a href="#" class="social-icon si-small si-dark si-facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>

                    <a href="#" class="social-icon si-small si-dark si-twitter">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>

                    <a href="#" class="social-icon si-small si-dark si-dribbble">
                        <i class="icon-dribbble"></i>
                        <i class="icon-dribbble"></i>
                    </a>

                    <a href="#" class="social-icon si-small si-dark si-forrst">
                        <i class="icon-forrst"></i>
                        <i class="icon-forrst"></i>
                    </a>

                    <a href="#" class="social-icon si-small si-dark si-pinterest">
                        <i class="icon-pinterest"></i>
                        <i class="icon-pinterest"></i>
                    </a>

                    <a href="#" class="social-icon si-small si-dark si-gplus">
                        <i class="icon-gplus"></i>
                        <i class="icon-gplus"></i>
                    </a>

                </div>

            </div><!-- .sidebar end -->

        </div>

    </div>

</section><!-- #content end -->
<?php
$js = <<<JS

var  x = 1;
var y = 1;
 function init() {
        var mapOptions = {
            zoom: 22,
            scrollwheel: false,
            center: new google.maps.LatLng(x, y),
            styles: [{
                "featureType": "administrative",
                "elementType": "all",
                "stylers": [{"visibility": "on"}, {"lightness": 33}]
            }, {
                "featureType": "administrative.province",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "administrative.locality",
                "elementType": "labels",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "administrative.locality",
                "elementType": "labels.text.fill",
                "stylers": [{"lightness": "23"}]
            }, {
                "featureType": "administrative.neighborhood",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "administrative.neighborhood",
                "elementType": "labels",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{"color": "#f2e5d4"}]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry.fill",
                "stylers": [{"lightness": "31"}, {"weight": "1.00"}]
            }, {
                "featureType": "poi.attraction",
                "elementType": "geometry",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi.attraction",
                "elementType": "labels",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi.business",
                "elementType": "all",
                "stylers": [{"visibility": "on"}]
            }, {
                "featureType": "poi.government",
                "elementType": "geometry",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [{"color": "#c5dac6"}, {"visibility": "off"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{"saturation": "15"}, {"hue": "#7eff00"}, {"lightness": "1"}]
            }, {
                "featureType": "poi.park",
                "elementType": "labels",
                "stylers": [{"visibility": "off"}, {"lightness": 20}]
            }, {
                "featureType": "poi.park",
                "elementType": "labels.icon",
                "stylers": [{"visibility": "on"}, {"saturation": "-50"}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers": [{"lightness": 20}, {"visibility": "off"}]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [{"color": "#d8d8d8"}, {"visibility": "off"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [{"color": "#e4d7c6"}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [{"color": "#fbfaf7"}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "transit.line",
                "elementType": "geometry.stroke",
                "stylers": [{"invert_lightness": true}]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{"visibility": "on"}, {"color": "#acbcc9"}]
            }, {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [{"lightness": "9"}, {"saturation": "-92"}, {"hue": "#00daff"}]
            }]
        };
        var mapElement = document.getElementById('googleMap');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: map.getCenter(),
            icon: '/img/map-marker.png',
            map: map
        });
    }

    google.maps.event.addDomListener(window, 'load', init);
JS;
$this->registerJs($js);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyClpvcUyl31wMd7DJZQnnzI006S99u9nnM');
?>
