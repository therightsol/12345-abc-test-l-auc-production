/**
 * Created by abcd on 12/29/2016.
 */


/**
 * Created by Ali Shan on 27/12/2016.
 */


// aJax
function ajax_call( url, type, ajax_data_to_sent, function_after_call, headers, process_data, enc_type, content_type){
    var result = {};

    jQuery.ajax({
        url: url,
        type: type,
        data: ajax_data_to_sent,
        headers: headers,
        enctype: enc_type,
        processData: process_data,
        contentType: content_type
    }).success(function( data ) {
        //console.log(data);
        result.success = true;
        result.data = data;

    }).error(function ( error ){
        //console.log(error);
        result.success = false;
        result.data = error;
        function_after_call( result );
    }).done(function (){
        function_after_call( result );
    });

}

// displaying modal
function openModal(modalName){
    jQuery(modalName).modal(
        {
            backdrop: 'static',
            keyboard: true,
            show: true
        }
    );
}

// closing modal
function closeModal( modalName ){
    $(function () {
        $(modalName).modal('toggle');
    });
}

// updating data table -- with the DB record - - on ajax_call
function update_dt( jSON_response ){

    console.log(jSON_response.success);

    if (jSON_response.data.length > 0 && jSON_response.success ) {

        var obj = jQuery.parseJSON(jSON_response.data);

        if (obj.length > 0) {
            myTable.clear().draw();
        }

        var buttons = '<button type="button" class="btn btn-icon-toggle edit-button">'
            + '<i class="fa fa-pencil"></i></button>';

        buttons += '<button type="button" class="deleteButton btn btn-icon-toggle"'
            + ' data-toggle="tooltip" data-placement="top" data-original-title="Delete row">'
            + ' <i class="fa fa-trash-o"></i></button>';


        //console.log(obj.length);


        for (var i = 0; i < obj.length; i++) {
            //console.info ('Response from DB is : ' + obj[i]['userrole']);

            console.log(obj[i]['picture']);

            if (obj[i]['picture'] == null || obj[i]['picture'] == undefined){
                picture = "../images" + "/image-not-found-100x100.png";
            }else {

                picture = "../images/users" + "/" + obj[i]['picture'];
            }

            console.log(obj[i]);


            display_name = obj[i]['display_name'];
            username = obj[i]['username'];
            email = obj[i]['email'];
            role = obj[i]['user_role']['role'];
            id = obj[i]['id'];


            if (role == 'inactive') {
                role = '<span class="inactive">' + role + '</span>'
            } else if (role == 'member') {
                role = '<span class="member">' + role + '</span>'
            } else if (role == 'team') {
                role = '<span class="team">' + role + '</span>'
            } else if (role == 'administrator') {
                role = '<span class="administrator">' + role + '</span>'
            }

            var row_data = ['<img class="img-circle width-1" src="' + picture + '" alt=""/>',
                display_name,
                username,
                '<a href="mailto:' + email + '">' + email + '</a> ',
                role,
                buttons];


            myTable.row.add(row_data).draw(true)
                .nodes()
                .to$()
                .attr('data-uid', 'user-' + id).find('td').addClass('aaaaa');

        }

        myTable.processing( false );
    }
}