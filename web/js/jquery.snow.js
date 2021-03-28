/**
 * jquery.snow - jQuery Snow Effect Plugin
 *
 * Available under MIT licence
 *
 * @version 1 (21. Jan 2012)
 * @author Ivan Lazarevic
 * @requires jQuery
 *
 * @params flakeChar - the HTML char to animate
 * @params minSize - min size of snowflake, 10 by default
 * @params maxSize - max size of snowflake, 20 by default
 * @params newOn - frequency in ms of appearing of new snowflake, 500 by default
 * @params flakeColors - array of colors , #FFFFFF by default
 * @params durationMillis - stop effect after duration
 * @example $.fn.snow({ maxSize: 200, newOn: 1000 });
 */
(function ($) {

    $.fn.snow = function (options) {

        var $flake = $('<div class="flake" />').css({'position': 'absolute', 'top': '-50px'}),
                //documentHeight = $(document).height(),
                //documentWidth = $(document).width(),
                defaults = {
                    flakeChar: "&#10052;",
                    minSize: 10,
                    maxSize: 20,
                    newOn: 500,
                    flakeColor: "#ffffff", //#0099FF
                    durationMillis: null
                },

                options = $.extend({}, defaults, options);
//console.log(defaults);
//console.log(options);
        $flake.html(options.flakeChar);

        var interval = setInterval(function () {
                var documentHeight = $(document).height(),
                    documentWidth = $(document).width(), 
                    startPositionLeft = Math.random() * documentWidth - 100,
                    startOpacity = 0.5 + Math.random(),
                    sizeFlake = options.minSize + Math.random() * options.maxSize,
                    endPositionTop = documentHeight - options.maxSize - 40,
                    endPositionLeft = startPositionLeft - 100 + Math.random() * 200,
                    durationFall = documentHeight * 10 + Math.random() * 5000;
            $flake
                    .clone()
                    .appendTo('body')
                    .css(
                            {
                                left: startPositionLeft,
                                opacity: startOpacity,
                                'font-size': sizeFlake,
                                //color: options.flakeColor[Math.floor((Math.random() * options.flakeColor.length))]
				color: options.flakeColor
                            }
                    )
                    .animate(
                            {
                                top: endPositionTop,
                                left: endPositionLeft,
                                opacity: 0.2
                            },
                            durationFall,
                            'linear',
                            function () {
                                $(this).remove()
                            }
                    );
        }, options.newOn);

        if (options.durationMillis) {
            setTimeout(function () {
                removeInterval(interval);
            }, options.durationMillis);
        }
    };

})(jQuery);

timeend = new Date();
// IE и FF по разному отрабатывают getYear()
timeend = new Date(timeend.getYear() > 1900 ? (timeend.getYear() + 1) : (timeend.getYear() + 1901), 0, 1);
// для задания обратного отсчета до определенной даты укажите дату в формате:
// timeend= new Date(ГОД, МЕСЯЦ-1, ДЕНЬ);
// Для задания даты с точностью до времени укажите дату в формате:
// timeend= new Date(ГОД, МЕСЯЦ-1, ДЕНЬ, ЧАСЫ-1, МИНУТЫ);
function time_new_year() {
    today = new Date();
    today = Math.floor((timeend - today) / 1000);
    tsec = today % 60;
    today = Math.floor(today / 60);
    if (tsec < 10)
        tsec = '0' + tsec;
    tmin = today % 60;
    today = Math.floor(today / 60);
    if (tmin < 10)
        tmin = '0' + tmin;
    thour = today % 24;
    today = Math.floor(today / 24);
    timestr = today + " днів " + thour + " годин " + tmin + " хвилин " + tsec + " секунд";
    document.getElementById('time_new_year').innerHTML = timestr;
    window.setTimeout("time_new_year()", 1000);
}

$(document).ready(function () {
    $.fn.snow({minSize: 5, maxSize: 50, newOn: 500, flakeColor: '#0099FF'});
    // Свойство 	По умолчанию 	Описание
    // minSize 	10 	минимальный размер снежинки
    // maxSize 	20 	максимальный размер снежинки
    // newOn 	500 	частота появления новых снежинок в миллисекундах
    // flakeColor 	#FFFFFF цвет снежинок

    $('.new_year_logo').css({
        'position': 'absolute',
        'left': '0',
        'top': '0',
        'width': '96px',
        'height': '96px',
        'z-index': '10000',
        'background': 'url(/web/uploads/new_year/new_year_tree.png) no-repeat',
        'background-size': '84% auto'
    });

    time_new_year();
});