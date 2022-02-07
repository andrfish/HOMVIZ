function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


$(document).ready(function(){


    setTimeout(function(){

      let tarray = window._table.split(",");

      generatetable()

      $(document).find(".ttd").each(function (index, value) {
        
        $(this).find('input').val(tarray[index])

      });


    },500)

    // Smart Wizard
    $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'arrows',
            transitionEffect:'fade'
         });

	$("#addresource").click(function(){

		count = $(document).find(".resources").length
		count = count + 1
		html = ' <div count="'+count+'" class="resources col-12 col-sm-6 col-md-4 d-flex align-items-stretch"><div class="card bg-light" style="width: 100%"><div class="card-header text-muted border-bottom-0"> Resource '+count+' &nbsp;&nbsp;&nbsp;<i class="fas fa-trash table-danger deleteresource" style="cursor: pointer;"></i></div><div class="card-body pt-0"> <div class="row"> <div class="col-12"><div class="form-group"><label for="inputName">Name</label><input name="resource['+count+'][name]" type="text" id="inputName" class="form-control"></div><div class="form-group"><label for="inputName">Capacity</label><input name="resource['+count+'][capacity]" type="text" id="inputName" class="form-control"></div><div class="form-group"><label for="inputName">Max Length (days) <small>optional</small></label><input name="resource['+count+'][maxlength]" type="text" id="inputName" class="form-control" value="NaN"></div><div class="row subresroucewrapper"></div></div></div></div><div class="card-footer"> <div class="text-right"> <a id="addsubresource" class="btn btn-sm btn-primary" style="color: white;cursor: pointer;"> <i class="fas fa-plus"></i> Add Sub-resource </a> </div></div></div></div>';
		$(html).insertBefore("#addresourcewrapper")

	});


	$(document).on("click","#addsubresource",function() {

		count = $(this).closest(".card").find('.subresource').length

    resCount = $(this).closest(".resources").attr("count")

		count = count + 1
		html = '<div class="col-6 col-sm-6 col-md-6 d-flex subresource"><div class="card bg-light"><div class="card-header text-muted border-bottom-0">Sub-Resource '+count+' &nbsp;&nbsp;&nbsp;<i class="fas fa-trash table-danger deletesubresource" style="cursor: pointer;"></i></div><div class="card-body pt-0"> <div class="row"> <div class="col-12"><div class="form-group"><label for="inputName">Name</label><input name="subresource['+resCount+']['+count+'][name]" type="text" id="inputName" class="form-control"></div><div class="form-group"><label for="inputName">Capacity</label><input name="subresource['+resCount+']['+count+'][capacity]" type="text" id="inputName" class="form-control"></div></div></div></div></div></div>';
		$(this).closest(".card").find('.subresroucewrapper').append(html)

    });


    $(document).on("change","input[type=radio]",function() {

		let value = $(this).closest( 'input[type=radio]:checked' ).val();
		let _class = "table-success";
		if (value==0) _class = "table-danger"
		$(this).closest("td").removeClass("table-success table-danger").addClass(_class)

	});


    $("#statebtn").click(function(){

    	_val = $("#statetext").val()
    	_exp = _val.split(',')

    	_table = '<small>This table represents the probability of moving from one state to another. Absorbing states where the movement to other states is not allowed will have a probability of 0.</small><div class="table-responsive">'+
    				 '<table class="table table-bordered ">'+
     				 	'<thead>'+
        				'<tr>'+
      					'<th>#</th>';

      	 _hdntable = '<div class="table-responsive" style="display: none">'+
    				 '<table id="statetable" class="table table-bordered ">'+
     				 	'<thead>'+
        				'<tr>'+
      					'<th>#</th>';


      	$.each( _exp, function( key, value ) {
      		_table += '<th>'+value+'</th>'
      		_hdntable += '<th>'+value+'</th>'
		});

      	_table += 	'</tr>'+
				    '</thead>'+
      				'<tbody>';

      	_hdntable += 	'</tr>'+
				    	'</thead>'+
      					'<tbody>';

      	$.each( _exp, function( k1, value ) {

      			_table += 	'<tr>'+
      						'<td style="font-weight: 900">'+value+'</td>';

      			_hdntable += 	'<tr>'+
      						'<td style="font-weight: 900">'+value+'</td>';

      			$.each( _exp, function( key, value ) {

      				_table += 	'<td class="ttd"><input name="table['+k1+']['+key+']" style="width:100%; height:100%;" placeholder="#"></td>';

      			});

      		_table += '</tr>';
      		_hdntable += '</tr>';

		});
        
        _table += 	'</tbody>'+
    				'</table>'+
  					'</div>';
  		_hdntable += 	'</tbody>'+
    				'</table>'+
  					'</div>';

  		$("#_table").append(_table)
  		$("#_table").append(_hdntable)

      $("#adddataanchor").removeClass("hide").addClass('show');

    })


	$("#toexcel").click(function(){

		exportTableToExcel('statetable', 'data')

	});


  $("#adddataanchor").click(function(){

    $('#uploadwrapper').addClass("show").removeClass("hide");

  });

  $(document).on("change","#fileinput",function(e,data) {

    	$(this).closest(".file").removeClass("bg-gradient-primary").addClass("bg-gradient-default").find('.txt').text($(this).val());


      //Reference the FileUpload element.
      var fileUpload = $("#fileinput")[0];

      //Validate whether File is valid Excel file.
      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
      if (regex.test(fileUpload.value.toLowerCase())) {
          if (typeof (FileReader) != "undefined") {
              var reader = new FileReader();

              //For Browsers other than IE.
              if (reader.readAsBinaryString) {
                  reader.onload = function (e) {
                      ProcessExcel(e.target.result);
                  };
                  reader.readAsBinaryString(fileUpload.files[0]);
              } else {
                  //For IE Browser.
                  reader.onload = function (e) {
                      var data = "";
                      var bytes = new Uint8Array(e.target.result);
                      for (var i = 0; i < bytes.byteLength; i++) {
                          data += String.fromCharCode(bytes[i]);
                      }
                      ProcessExcel(data);
                  };
                  reader.readAsArrayBuffer(fileUpload.files[0]);
              }
          } else {
              alert("This browser does not support HTML5.");
          }
      } else {
          alert("Please upload a valid Excel file.");
      }



      

	});


	$(document).on("click",".deleteresource",function() {

		$(this).closest(".resources").remove();

    });


	$(document).on("click",".deletesubresource",function() {

		$(this).closest(".subresource").remove();

    });


	$(document).on("click","#runsimulation",function() {

		// Simulate a mouse click:
		window.location.href = "/make-simulation";

		// Simulate an HTTP redirect:
		window.location.replace("/make-simulation");

    });



  $("body").on("click", "#upload", function () {
      //Reference the FileUpload element.
      var fileUpload = $("#fileinput")[0];

      //Validate whether File is valid Excel file.
      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
      if (regex.test(fileUpload.value.toLowerCase())) {
          if (typeof (FileReader) != "undefined") {
              var reader = new FileReader();

              //For Browsers other than IE.
              if (reader.readAsBinaryString) {
                  reader.onload = function (e) {
                      ProcessExcel(e.target.result);
                  };
                  reader.readAsBinaryString(fileUpload.files[0]);
              } else {
                  //For IE Browser.
                  reader.onload = function (e) {
                      var data = "";
                      var bytes = new Uint8Array(e.target.result);
                      for (var i = 0; i < bytes.byteLength; i++) {
                          data += String.fromCharCode(bytes[i]);
                      }
                      ProcessExcel(data);
                  };
                  reader.readAsArrayBuffer(fileUpload.files[0]);
              }
          } else {
              alert("This browser does not support HTML5.");
          }
      } else {
          alert("Please upload a valid Excel file.");
      }
  });



  function ProcessExcel(data) {

      var exceltojson = []

      //Read the Excel File data.
      var workbook = XLSX.read(data, {
          type: 'binary'
      });

      //Fetch the name of First Sheet.
      var firstSheet = workbook.SheetNames[0];

      //Read all rows from First Sheet into an JSON array.
      var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

      //Add the data rows from Excel file.
      for (var i = 0; i < excelRows.length; i++) {

        _rarray = []

        let _row = excelRows[i]

        let c = 0


        $.each(_row, function( index, value ) {

          if (c!=0) {
            _rarray.push(value)
          }
          c = c+1

        });

        exceltojson.push(_rarray)

      }


      let newarray = []

      for (var i = 0; i < exceltojson.length; i++) {

        for (var j = 0; j < exceltojson[i].length; j++) {

          newarray.push(exceltojson[i][j])

        }

      }

      $(document).find(".ttd").each(function (index, value) {
        
        $(this).find('input').val(newarray[index])

      });

  };


});



function generatetable(){
      _val = $("#statetext").val()
      _exp = _val.split(',')

      _table = '<div class="table-responsive">'+
             '<table class="table table-bordered ">'+
              '<thead>'+
                '<tr>'+
                '<th>#</th>';

         _hdntable = '<div class="table-responsive" style="display: none">'+
             '<table id="statetable" class="table table-bordered ">'+
              '<thead>'+
                '<tr>'+
                '<th>#</th>';


        $.each( _exp, function( key, value ) {
          _table += '<th>'+value+'</th>'
          _hdntable += '<th>'+value+'</th>'
    });

        _table +=   '</tr>'+
            '</thead>'+
              '<tbody>';

        _hdntable +=  '</tr>'+
              '</thead>'+
                '<tbody>';

        $.each( _exp, function( k1, value ) {

            _table +=   '<tr>'+
                  '<td style="font-weight: 900">'+value+'</td>';

            _hdntable +=  '<tr>'+
                  '<td style="font-weight: 900">'+value+'</td>';

            $.each( _exp, function( key, value ) {

              _table +=   '<td class="ttd"><input name="table['+k1+']['+key+']" style="width:100%; height:100%;" placeholder="#"></td>';

            });

          _table += '</tr>';
          _hdntable += '</tr>';

    });
        
        _table +=   '</tbody>'+
            '</table>'+
            '</div>';
      _hdntable +=  '</tbody>'+
            '</table>'+
            '</div>';

      $("#_table").append(_table)
      $("#_table").append(_hdntable)

      $("#adddataanchor").removeClass("hide").addClass('show');

}