<?php use yii\helpers\Html; ?>
<div id="bannerCarouselbottom" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
<?php $count = count($model); $i = 0; foreach ($model as $banner): ?>
    <?php if (($i == 0) || ($i % 6 == 0)): ?><div class="carousel-item<?php if ($i == 0) {echo " active";} ?>"><?php endif; ?>
        <?php echo Html::a(Html::img("@web/web/uploads/banners/" . $banner['img_src'], ['alt' => $banner['name'],
            'width' => Yii::$app->setting->get('BANNER.IMG_WIDTH'),
            'height' => Yii::$app->setting->get('BANNER.IMG_HEIGHT'), 'class' => 'rounded img-opacity']),
            ['#'],
            ['onclick' => "banner_to_url('".$banner['url_link']."'); banner_click(".$banner['id'].");", 'title' => $banner['name']]
            )
        ?>
<?php $i++; if ($i % 6 == 0 || $i == $count ): ?></div><?php endif; ?>
<?php endforeach; ?>
    </div>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#bannerCarouselbottom" role="button" data-slide="prev" style="left:-40px; width:20px; background:none;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#bannerCarouselbottom" role="button" data-slide="next" style="right:-40px; width:20px; background: none;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
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