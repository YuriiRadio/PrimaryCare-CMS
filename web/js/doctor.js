//jQuery(document).ready(function() {
//    window.alert('Page Start');
//});

var lang = document.getElementsByTagName("html")[0].getAttribute("lang").slice(0, 2);

//jQuery('.doctor-view').on('click', function() {
//    //e.preventDefault();
//    var id = $(this).data('id');
//    //var lang = $(this).data('lang');
//
//    $.ajax({
//        url: '/'+lang+'/doctor/view',
//        data: {id: id},
//        type: 'POST',
//        success: function(response) {
//            var response_obj = JSON.parse(response)
//            //console.log(response_obj);
//            $('#doctor-modal .modal-header > h2').html(response_obj.name);
//            $('#doctor-modal .modal-body').html(response_obj.body);
//            $('#doctor-modal').modal();
//        },
//        error: function() {
//            window.alert('Error - doctor-view!!!');
//        }
//    });
//
//    return false;
//});

function doctorQuickView(id) {

    $.ajax({
        url: '/'+lang+'/doctor/view',
        data: {id: id},
        type: 'POST',
        success: function(response) {
            var response_obj = JSON.parse(response)
            //console.log(response_obj);
            $('#doctor-modal .modal-header > h2').html(response_obj.name);
            $('#doctor-modal .modal-body').html(response_obj.body);
            $('#doctor-modal').modal();
        },
        error: function() {
            window.alert('Error - doctor-view!!!');
        }
    });

    return false;
};

//Doctors filters
jQuery('#doctor_filters').on('change', function() {

    //var lang = $('html').attr('lang').slice(0, 2);
    var department = $(this).children('select[name=department]').val();
    var specialization = $(this).children('select[name=specialization]').val();
    var category = $(this).children('select[name=category]').val();
    var declarations = $(this).children('select[name=declarations]').val();
    //console.log(specialization);
    //console.log(category);

    $.ajax({
        url: '/'+lang+'/doctor/index',
        data: {
            department: department,
            specialization: specialization,
            category: category,
            declarations: declarations,
        },
        type: 'GET',
        success: function(response) {
            $('#doctors').html(response);
        },
        error: function() {
            window.alert('Error - doctor-view-filters!!!');
        }
    });

    return false;
});

new WOW().init();