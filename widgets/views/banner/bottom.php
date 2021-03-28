<?php use yii\helpers\Html; ?>
<div class="row" style="margin: 5px 40px 10px 40px;">
    <div id="bannerCarouselbottom" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
<?php $count = count($model); $i = 0; foreach ($model as $banner): ?>
<?php if (($i == 0) || ($i % 6 == 0)): ?><div class="item<?php if ($i == 0) {echo " active";} ?>"><?php endif; ?>
            <div class="col-sm-2 col-md-2 col-lg-2">
                <?php //echo Html::a(Html::img("@web/web/uploads/banners/" . $banner['img_src'], ['alt' => $banner['name'], 'width' => Yii::$app->setting->get('BANNER_IMG_WIDTH'), 'height' => Yii::$app->setting->get('BANNER_IMG_HEIGHT'), 'class' => 'img-opacity']), ['banner/view', 'id' => $banner['id']]) ?>
                <?php //echo Html::a(Html::img("@web/web/uploads/banners/" . $banner['img_src'], ['alt' => $banner['name'], 'width' => Yii::$app->setting->get('BANNER_IMG_WIDTH'), 'height' => Yii::$app->setting->get('BANNER_IMG_HEIGHT'), 'class' => 'img-opacity']), ['#'], ['onclick' => 'banner_to_url('.$banner['id'].')']) ?>
                <?php echo Html::a(Html::img("@web/web/uploads/banners/" . $banner['img_src'], ['alt' => $banner['name'], 'width' => Yii::$app->setting->get('BANNER.IMG_WIDTH'), 'height' => Yii::$app->setting->get('BANNER.IMG_HEIGHT'), 'class' => 'img-opacity']),
                    ['#'],
                    ['onclick' => "banner_to_url('".$banner['url_link']."'); banner_click(".$banner['id'].");", 'title' => $banner['name']]
                    )
                ?>

            </div>
<?php $i++; if ($i % 6 == 0 || $i == $count ): ?></div><?php endif; ?>
<?php endforeach; ?>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#bannerCarouselbottom" data-slide="prev" style="left:-40px; width:20px; background:none;">
            <span class="glyphicon glyphicon-chevron-left" style="color:#511c39;"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#bannerCarouselbottom" data-slide="next" style="right:-40px; width:20px; background: none;">
            <span class="glyphicon glyphicon-chevron-right" style="color:#511c39;"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<script>
function banner_click(id) {
    $.ajax({
        url: '/en/banner/view',
        data: {id: id},
        type: 'POST',
        success: function(response) {
            //console.log(response);
            if (!response) {
                alert("Error Ajax banner clicks update!!!");
            }
        },
        error: function() {
            window.alert('Error connect Ajax banner clicks update!!!');
        }
    });
    return false;
}
function banner_to_url(url) {
    var win = window.open(url, '_blank');
    if (win) {
        //Browser has allowed it to be opened
        win.focus();
    } else {
        //Browser has blocked it
        alert('Please allow popups for this website!!!');
    }
    return false;
}
</script>