$('body').LoadingOverlay("show", {
    background  : "rgba(255, 255, 255, 0.8)",
    image       : "",
    fontawesome : "fas fa-circle-notch fa-spin"
})

window.populationType = []
window.states = []
window.resources = []

window.tableFlagstate = 0
window.currentstep = 0
window.popovers = {}
window.totalPopulation = {}
window.TypePopulation = {}
window.TotalInitPopulation = {}

window.dataSummary = []

//validation
window.loc = 0
window.stateset = 0
window.params = 0

//debug
window.debug = false

var timeElapsed = 0;
var myTimer;

$('.general-info').tooltip();

startTimer()

$(document).ready(function(){

  $('.general-tooltip').tooltip();

  let headerHeight = $('.main-header').height() + 15
  $('.my-sidebar').css('padding-top',headerHeight+'px')

  window.general_Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });

  window.info_Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });

  window.Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: true,
    animation:true
  });

  $("#mcontent").css("display","block")

  $('#smartwizard').smartWizard({
    selected: 0,
    theme: 'arrows',
    showStepURLhash: true,
    transitionEffect:'fade',
    toolbarSettings: {
      showNextButton: false, // show/hide a Next button
      showPreviousButton: false // show/hide a Previous button
    }, 
    anchorSettings: {
      anchorClickable: window.debug, // Enable/Disable anchor navigation
      enableAllAnchors: window.debug, // Activates all anchors clickable all times
      markDoneStep: true, // add done css
      enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
    },
    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
    transitionSpeed: '100',
    keyNavigation: false
  });

  $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {

    window.scroll({
    top: 0, 
    left: 0, 
    behavior: 'auto'
    });

    window.currentstep = stepNumber + 1

    $('#next').removeClass('bg-gradient-success').addClass('bg-gradient-primary').text('Next Step')

    if (window.currentstep==1) {

      $('#prev').attr('disabled','true')
      
      step1HandleErrors()

    } else if (window.currentstep==2) {

      $('#prev').removeAttr('disabled')

      step2HandleErrors()

    } else if (window.currentstep==3) {

      $('#prev').removeAttr('disabled')

      LockPopulationTypes()

      step3HandleErrors()

    } else if (window.currentstep==4) {

      $('#prev').removeAttr('disabled')

      step4HandleErrors()

    } else if (window.currentstep==5000) {

      $('#prev').removeAttr('disabled')

      step5HandleErrors()

    } else if (window.currentstep==5) {

      $('#prev').removeAttr('disabled')
      $('#next').removeClass('bg-gradient-primary').addClass('bg-gradient-success').text('Create Simulation')

      step6HandleErrors()

    }

  });

  $('#smartwizard').smartWizard('reset');

  $('#next').on('click', function(e){

    HandleStepsOnNextBtnClick()

  })

  $('#prev').on('click', function(e){

    $('#smartwizard').smartWizard("prev")
    
  })


  setTimeout(function(){

    document.location.href="#top";

    setTimeout(function(){

      $('body').LoadingOverlay("hide")
      $('#myoverlay').remove()

    }, 500)

  }, 3000)


  $('.tutorial-link').on('click', function(e) {

    let step = $(this).attr('step')

    $('.video-container').addClass('hide')
    $('#step-'+step+'-video').removeClass('hide')

    ToggleVideoSlider()

  })

  $('#close-slider').on('click', function(e) {

    ToggleVideoSlider()

  })

  $(document).on("keypress",".no-special-chars",function() {

      var regex = new RegExp("^[ a-zA-Z0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

  });

  // STEP 1
  $('#simulation-name').on('keyup blur', function(e) {
    step1HandleErrors()
  })

  $(document).on("keypress",".pop-input-validation, .maxlength-input-validation, .capacity-input-validation, .mq-input-validation, .mlos-input-validation",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<1 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(1)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>100000) {
        $(this).val(100000)
         event.preventDefault();
         return false;
      }

  });

  $(document).on("keypress",".pop-input-validation",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>100000) {
        $(this).val(100000)
        event.preventDefault();
        return false;
      }

  });

  $(document).on("keyup blur",".pop-num-input",function(event) {

      if ($(this).val()<1 && $(this).val()!='') {
        $(this).val(1)
        event.preventDefault();
        return false;
      }

      if($(this).val() != '' && $(this).val() >= 1 && $(this).val()<=100000){
        $(this).removeClass('is-invalid').addClass('is-valid')
      } else {
        $(this).removeClass('is-valid').addClass('is-invalid')
      }

  });

  $(document).on("keyup",".res-state-name",function(event) {

    let name = String(sanitizeString($(this).val()))

    let duplicate_count = 0

    $(document).find('.res-state-name').each(function() { 
      let elem_name = String(sanitizeString($(this).val()))
      if(elem_name==name) { 
        duplicate_count = duplicate_count + 1 
      } 
    });

    if(name != '' && duplicate_count == 1){
      $(this).removeClass('is-invalid').addClass('is-valid')
      $(this).parents('td').first().find('.res-state-name-error').first().removeClass('show').addClass('hide')
    } else {
      $(this).removeClass('is-valid').addClass('is-invalid')
      if (duplicate_count>1 && name != '') {
        $(this).parents('td').first().find('.res-state-name-error').first().removeClass('hide').addClass('show')
      }
    }

  });

  $(document).on("blur",".res-state-name",function(event) {

    let name = String(sanitizeString($(this).val()))
    let duplicate_count = 0

    $(document).find('.res-state-name').each(function() { 
      let elem_name = String(sanitizeString($(this).val()))
      if(elem_name==name) { 
        duplicate_count = duplicate_count + 1 
      } 
    });

    if(name != '' && duplicate_count == 1){

      $(this).removeClass('is-invalid').addClass('is-valid')
      $(this).parents('td').first().find('.res-state-name-error').first().removeClass('show').addClass('hide')

      //save id
      let rowID = $(this).parents('tr').first().attr('id')

      $.each( window.dataSummary, function( ds_key, ds_value ) {

        if (ds_value != undefined) {

          if (rowID == ds_value['id']) {

            window.dataSummary[ds_key]['nameforshow'] = name

          }

        }

      });

      drawResSummay()
      drawStateSummay()

    } else {
      $(this).removeClass('is-valid').addClass('is-invalid')
      if (duplicate_count>1 && name != '') {
        $(this).parents('td').first().find('.res-state-name-error').first().removeClass('hide').addClass('show')
      }
    }

  });

  $(document).on("blur","maxlength-input-validation, .capacity-input-validation, .mq-input-validation, .mlos-input-validation",function(event) {

    if ($(this).val()=='') {
      $(this).val(1)
    }

  });

  $(document).on("keypress",".initpop-input-validation",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<=0 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(0)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>100000) {
        $(this).val(100000)
         event.preventDefault();
         return false;
      }


      if ($(this).val()==0) {
        $(this).val(String.fromCharCode(event.keyCode))
         event.preventDefault();
         return false;
      }

  });

  $(document).on("blur",".initpop-input-validation",function(event) {

      if ($(this).val()=='') {
        $(this).val(0)
      }

  });

  $(document).on("keypress","#simweeks",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<=0 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(1)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode)>520) {
        $(this).val(520)
         event.preventDefault();
         return false;
      }

      if ($(this).val()==0) {
        $(this).val(String.fromCharCode(event.keyCode))
         event.preventDefault();
         return false;
      }

  });

  $(document).on("keypress","#simnum",function(event) {

      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }

      if ($(this).val()<=0 && String.fromCharCode(event.keyCode)<1) {
        $(this).val(1)
         event.preventDefault();
         return false;
      }

      if ($(this).val()+String.fromCharCode(event.keyCode) > 10) {
        $(this).val(10)
         event.preventDefault();
         return false;
      }

      if ($(this).val()==0) {
        $(this).val(String.fromCharCode(event.keyCode))
         event.preventDefault();
         return false;
      }

  });

  $('#simweeks, #simnum').on('keyup blur', function(e) {
    step6HandleErrors()
  })
  

  //*********************************
  //**************************STEP 2

  var number = document.getElementsByClassName('pop-total-nums');

  // Listen for input event on numInput.
  number.onkeydown = function(e) {
      if(!((e.keyCode > 95 && e.keyCode < 106)
        || (e.keyCode > 47 && e.keyCode < 58) 
        || e.keyCode == 8)) {
          return false;
      }
  }

  $(document).on("click",".removePopulationRow",function(e,data) {

    if (!$(this).hasClass('disabled')) {

      let this_elem = $(this).parents('tr').first()
      let this_id = this_elem.attr('this_id')
      let name = this_elem.attr('name')

      let popTableTbody = $('#populationtable tbody')

      let rowCount = popTableTbody.find('tr').length

      if (rowCount==1) {
        popTableTbody.append('<tr><td></td><td></td><td></td></tr>')
      }

      this_elem.remove()

      $('#populationselect option[id="'+this_id+'"]').removeAttr('disabled')

      $.each(window.populationType, function( index, value ) {
        if (value==name) {
          window.populationType.splice(index, 1);
        }
      });

      step2HandleErrors()

    }

  })

  $('#populationbtn').on('click', function(e) {

    if ($(this).hasClass('btn-primary')) {

      var elem = document.getElementById("populationselect");
      var id = elem.options[elem.selectedIndex].id;
      let name = elem.options[elem.selectedIndex].value;

      if (id != 'title'){

        let prev_row = $('#populationtable tbody').find('tr[this_id="'+id+'"]').length

        if (prev_row==0) {

          $("#populationselect option:selected").attr('disabled','disabled')

          let pop_row =   '<tr this_id="'+id+'" class="poprows" name="'+name+'">'+
                          '<td style="font-weight: 900">'+name+'</td>'+
                          '<td class="ttd"><input type="number" popfullname="'+name+'" id="population-'+id+'" min="1" max="100000" step="1" class="form-control pop-total-nums pop-input-validation pop-num-input is-invalid" name="populationTypeCount['+id+']" style="width:150px; height:100%;"></td>'+
                          '<td><a class="text-danger pointer removePopulationRow">Delete</a></td>'
                          '</tr>';

          let popTableTbody = $('#populationtable tbody')

          let rowCount = popTableTbody.find('.poprows').length

          if (rowCount==0) {
            popTableTbody.find('tr').remove()
          }

          popTableTbody.append(pop_row)

          $("#populationselect").val(0);
          $("#populationselect").change();

          window.populationType.push(name)

        }

      }

    } else {

      let resStateFlag = false

      if (window.states.length>0 || window.resources.length>0) {

        resStateFlag = true

      }

      if (!resStateFlag) {

        UnlockPopulationTypes()

      } else {

        window.general_Toast.fire({
          title: 'Are you sure?',
          text: "It seems like you have added resources (step 3) or additional states (step 4) to your simulation. Unlocking this will remove resources and states. You won't be able to revert this.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
          if (result.value) {

            window.states = []
            window.resources = []

            window.popovers = {}
            window.TotalInitPopulation = {}

            $("#res-tbody").html('<tr><td></td><td></td><td></td><td></td><td></td></tr>')
            $("#state-tbody").html('<tr><td></td><td></td><td></td><td></td></tr>')

            $('#resources-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')
            $('#states-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

            window.dataSummary = []

            drawResSummay()
            drawStateSummay()

            UnlockPopulationTypes()

          }
        })

      }


    }

    step2HandleErrors()

  });

  //********************************
  //***********************STEP 2 END



  //*********************************
  //**************************STEP 3

  $('#resourcebtn').on('click', function(e) {

    $('.popover-all').popover('hide');

    var elem = document.getElementById("resselect");

    var id = elem.options[elem.selectedIndex].id;

    let name = nameForShow = elem.options[elem.selectedIndex].value;

    if (id != 'title'){

      let type = $('option[id='+id+']').attr('type')

      //is this the first row
      let rowCount = $("#res-tbody .mainrow").length
      if (rowCount== 0) {
        $("#res-tbody tr").remove()
      }

      let rowID = makeid(5)
      var myEle = document.getElementById(rowID);
      while(myEle){
        rowID = makeid(5)
        myEle = document.getElementById(rowID);
      }

      var obj = {};
      obj[rowID] = name;

      window.resources.push(obj)

      let tooltipClass = "tooltip-"+rowID
      let row = MakeResourcesRowColumnHTML(rowID,tooltipClass,type,name,nameForShow)

      $("#res-tbody").append(row)

      //Activate
      $('.'+tooltipClass).tooltip();

      activatePopUpWindows(rowID,type,name)

      window.dataSummary.push({ 'name':name, 'nameforshow':'', 'id':rowID, 'type':type, 'kind':'main', 'parent_id':null, properties: {'ap':[],'ip':[],'mlos':0,'cap':-1,'mq':0} })

    }

    step3HandleErrors()

    drawResSummay()

  })

  
  $(document).on("click",".dismisspopover",function(e,data) {
    $('.popover-all').popover('hide');
  })

  $(document).on("click",".closepop",function(e,data) {

    let id = $(this).attr('id')
    let mainId =  id.substr(5);
    let rowID = $(this).attr('rowid')

    let this_name = id.substring(0, 4)

    if (this_name=='apop') {

      //remove previosuly set allowed population from the summary object also the initial population
      $.each( window.dataSummary, function( ds_key1, ds_value1 ) {
        if (ds_value1 != undefined) {
          if (rowID == ds_value1['id']) {
            window.dataSummary[ds_key1]['properties']['ap'] = [];
            window.dataSummary[ds_key1]['properties']['ip'] = [];
          }
        }
      });

      let allCheckboxes = $(this).parents('.popover-content').first().find('input[type="checkbox"]')
      let checkboxFlag = false

      allCheckboxes.each(function(v) {

        //population names
        let checkbox_name = $(this).val()

        if (this.checked) {
          checkboxFlag = true

          //add new allowed population to the summary object
          $.each( window.dataSummary, function( ds_key2, ds_value2 ) {
            if (ds_value2 != undefined) {
              if (rowID == ds_value2['id']) {
                window.dataSummary[ds_key2]['properties']['ap'].push(checkbox_name);
              }
            }
          });

        }

      });

      if (checkboxFlag===false) {

        window.general_Toast.fire({
          title: 'Error',
          text: "At least 1 population type must be allowed into a resource/additional state",
          icon: 'error'
        })

        UnsetAllowedPopulation(mainId)

        return false 

      }

      UnsetInitialPopulation(mainId)

    } else if (this_name=='cpop') {

      let currentCap = parseInt($(this).parents('.popover-content').first().find('.capacity-inputs').val())

      if (currentCap!=-1) {

        if(typeof window.totalPopulation[mainId] !== 'undefined') {

            if (window.totalPopulation[mainId]>currentCap) {
              
              window.general_Toast.fire({
                title: 'Error',
                text: "Capacity cannot be less than the initial population counts.",
                icon: 'error'
              })

              UnsetCapacity(mainId)

              return false

            } else {


              $.each( window.dataSummary, function( ds_key5, ds_value5 ) {
                if (ds_value5 != undefined) {
                  if (rowID == ds_value5['id']) {
                    window.dataSummary[ds_key5]['properties']['cap'] = currentCap;
                  }
                }
              });

            }


        } else {

          window.general_Toast.fire({
            title: 'Error',
            text: "The initial population counts must be set first.",
            icon: 'error'
            })

          return false

        }

      } else {

        $.each( window.dataSummary, function( ds_key5, ds_value5 ) {
          if (ds_value5 != undefined) {
            if (rowID == ds_value5['id']) {
              window.dataSummary[ds_key5]['properties']['cap'] = -1;
            }
          }
        });

      }

    } else if(this_name=='mpop') {

      let mlsInput = $(this).parents('.popover-content').first().find('input[kind="mls"]').first().val()

      if (mlsInput=='' || mlsInput < 1) {

        window.general_Toast.fire({
          title: 'Error',
          text: "The maximum length of stay is required and cannot be equal to zero",
          icon: 'error'
        })

        UnsetMLS(mainId)

        return false

      } else {

        $.each( window.dataSummary, function( ds_key6, ds_value6 ) {
          if (ds_value6 != undefined) {
            if (rowID == ds_value6['id']) {
              window.dataSummary[ds_key6]['properties']['mlos'] = mlsInput;
            }
          }
        });

      }

    } else if(this_name=='qpop') { //monthly quota

      let mqInput = $(this).parents('.popover-content').first().find('input[kind="mqinput"]').first().val()

      if (mqInput=='' || mqInput < 1) {

        window.general_Toast.fire({
          title: 'Error',
          text: "The monthly quota is required and cannot be equal to zero",
          icon: 'error'
        })

        UnsetMQ(mainId)

        return false

      } else {

        $.each( window.dataSummary, function( ds_keymq, ds_valuemq ) {
          if (ds_valuemq != undefined) {
            if (rowID == ds_valuemq['id']) {
              window.dataSummary[ds_keymq]['properties']['mq'] = mqInput;
            }
          }
        });

      }

    } else if(this_name=='ipop') {

        let initPopInputs = $(this).parents('.popover-content').first().find('table').first().find('tr')

        let poparray = {}
        let popSummaryArray = []

        initPopInputs.each(function() {

          let _name = $(this).attr('name')
          let _val = $(this).find('.initpop-input').val()

          poparray[_name]=_val

          popSummaryArray.push({'name':_name,'value':_val})

        });

        //add new ini population to the summary object
        $.each( window.dataSummary, function( ds_key3, ds_value3 ) {
          if (ds_value3 != undefined) {
            if (rowID == ds_value3['id']) {
              window.dataSummary[ds_key3]['properties']['ip']= popSummaryArray;
            }
          }
        });

        let popCountValidation = validatePopulationCounts(poparray,mainId)

        if (popCountValidation===true) {

          window.TotalInitPopulation[rowID] = poparray

          let total = 0
          $('.initpop-input-'+mainId).each(function (i) {
              total += parseInt($(this).val())
          });
          window.totalPopulation[mainId] = total

        } else {

          window.Toast.fire({
            title: 'Error',
            html: popCountValidation,
            icon: 'error',
          })

          UnsetInitialPopulation(mainId)

          return false

        }

        UnsetCapacity(mainId)

    }

    let html = $(this).parents('.popover-content').first().find('div').first().clone();

    if(typeof window.popovers[id] !== 'undefined') {
      window.popovers[id] = html
    }

    let type = $(this).attr('type')

    // Allowed pop is changed, change init pop table
    if (type == 'ap') {

      let rowCheckboxes = $(this).parents('.popover-content').first().find('table').find('input[type=checkbox]')

      let populationArray = []

      rowCheckboxes.each(function () {
         if (this.checked) {
            populationArray.push($(this).attr('value'))
         }
      });

      let rootID = id.replace('apop-', '')
      let _type = rowCheckboxes.attr('kind')

      updateIpopHTML(populationArray,rootID,_type)

    }

    let notset_elem = $(document).find('li a[id="'+id+'"]').parents('li').first().find('.not-set')

    notset_elem.attr('title','Set').attr('data-original-title','Set')
    notset_elem.find('i').removeClass('fa-times-circle').removeClass('text-danger').addClass('fa-check-circle').addClass('text-success')
    notset_elem.removeClass('not-set').addClass('set')

    $('.popover-all').popover('hide');

    checkStep3()
    checkStep4()

    drawResSummay()
    drawStateSummay()

  });


  $(document).on("change",".capacities-infinite",function(e,data) {

    let _this_id = $(this).attr('thisid')

    if(this.checked) {
      $(this).parents('td').first().find('.capacity-inputs').first().val('-1').attr('readonly','true');
    } else {
      $(this).parents('td').first().find('.capacity-inputs').first().val('1').removeAttr('readonly');
    }

  });

  $(document).on("click",".divideRes",function(e,data) {

    let elem = $(this).parents('tr').first()

    let parentName = elem.attr('name')

    //Remove Propreties Column
    elem.find('td').eq(3).html('')

    let rowcount = elem.attr('count')

    let type = elem.attr('type');

    let parentID = elem.attr('id')

    removeAllPopoverOfID(parentID)
    removeTotalInitKey(parentID)

    let subRowCount = $(document).find('tr[parentID='+parentID+']').length

    let rowID = makeid(5)
    var myEle = document.getElementById(rowID);
    while(myEle){
      rowID = makeid(5)
      myEle = document.getElementById(rowID);
    }

    let tooltipClass= "tooltip-"+rowID

    let row = MakeSUBResourcesRowColumnHTML(rowID,parentID,subRowCount,tooltipClass,parentName)

    if (subRowCount==0) {

      elem.addClass('parentrow')

      $(row).insertAfter(elem);

    } else {

      let childElem = $(document).find('tr[parentID='+parentID+']').last()

      childElem.addClass('nthsub')

      $(row).insertAfter(childElem);

    }

    $('.'+tooltipClass).tooltip();

    activatePopUpWindows(rowID,type,parentName)


    window.dataSummary.push({ 'name':name, 'nameforshow':'', 'id':rowID, 'type':type, 'kind':'child', 'parent_id':parentID, properties: {'ap':[],'ip':[],'mlos':0,'cap':-1, 'mq':0} })

    $.each( window.dataSummary, function( ds_key, ds_value ) {

      if (ds_value != undefined) {

        if (parentID == ds_value['id']) {

          window.dataSummary[ds_key]['kind'] = 'parent'
          window.dataSummary[ds_key]['properties'] =  {'ap':[],'ip':[],'mlos':0,'cap':-1,'mq':0}

        }

      }

    });

    drawResSummay()

  })

  $(document).on('click','.removeResRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')

    window.resources.splice( window.resources.indexOf(rowID), 1 );

    removeTotalInitKey(rowID)

    removeAllPopoverOfID(rowID)
    
    //ALL SUB-ROWS
    $(document).find('tr[parentID='+rowID+']').each(function( index ) {

      let rowid = $(this).attr('id')

      removeAllPopoverOfID(rowid)
      removeTotalInitKey(rowid)
      
      $(this).remove()

      $.each( window.dataSummary, function( ds_key1, ds_value1 ) {

        if (ds_value1 != undefined) {

          if (ds_value1['kind']=='child') {

            if (rowID == ds_value1['parent_id']) {

              window.dataSummary.splice(ds_key1, 1);

            }

          }

        }

      });

    });

    elem.remove()

    //if no more row left
    let rowCount = $("#res-tbody .mainrow").length

    if (rowCount==0) {

      $("#res-tbody").append('<tr><td></td><td></td><td></td><td></td><td></td></tr>')
      
    }

    $.each( window.dataSummary, function( ds_key, ds_value ) {

      if (ds_value != undefined) {

        if (rowID == ds_value['id']) {

          window.dataSummary.splice(ds_key, 1);

        }

      }

    });

    checkStep3()
    step3HandleErrors()
    drawResSummay()

  })

  $(document).on('click','.removeResSubRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')
    let parentID = elem.attr('parentID')

    removeTotalInitKey(rowID)

    removeAllPopoverOfID(rowID)

    elem.remove()

    //IF THIS IS THE LAST SUBROW THEN ADD PROP TD TO THE MAINROW
    let subRowCount = $(document).find('tr[parentID='+parentID+']').length

    if (subRowCount == 0) {

      let parentElem = $(document).find('tr[id='+parentID+']')
      let type = parentElem.attr('type')

      let name = parentElem.attr('name')

      let td3 = makeResourcesPropretiesTD(parentID,null,name)

      parentElem.removeClass('parentrow')
      parentElem.find('td').eq(3).html(td3)

      activatePopUpWindows(parentID,type,name)

      $.each( window.dataSummary, function( ds_key1, ds_value1 ) {

        if (ds_value1 != undefined) {

          if (parentID == ds_value1['id']) {

            window.dataSummary[ds_key1]['kind'] = 'main'

          }

        }

      });

    }

    $.each( window.dataSummary, function( ds_key, ds_value ) {

      if (ds_value != undefined) {

        if (rowID == ds_value['id']) {

          window.dataSummary.splice(ds_key, 1);

        }

      }

    });

    checkStep3()
    drawResSummay()

  })


  //********************************
  //***********************STEP 3 END


  //*********************************
  //**************************STEP 4

  $('#statebtn').on('click', function(e) {

    $('.popover-all').popover('hide');

    var elem = document.getElementById("stateselect");
    var id = elem.options[elem.selectedIndex].id;
    let name = elem.options[elem.selectedIndex].value;

    if (id != 'title'){

      let type = $('option[id='+id+']').attr('type')

      //is this the first row
      let rowCount = $("#state-tbody .mainrow").length
      if (rowCount== 0) {
        $("#state-tbody tr").remove()
      }

      let rowID = makeid(5)
      var myEle = document.getElementById(rowID);
      while(myEle){
        rowID = makeid(5)
        myEle = document.getElementById(rowID);
      }

      var obj = {};
      obj[rowID] = name;
      window.states.push(obj)

      let tooltipClass = "tooltip-"+rowID
      let row = MakeStatesRowColumnHTML(rowID,tooltipClass,type,name)

      $("#state-tbody").append(row)

      $('.'+tooltipClass).tooltip();

      activatePopUpWindows(rowID,type,null)

      window.dataSummary.push({ 'name':name, 'nameforshow':'', 'id':rowID, 'type':type, 'kind':'main', 'parent_id':null, properties: {'ap':[],'ip':{} } })

    }

    step4HandleErrors()
    drawStateSummay()

  })

  $(document).on('click','.removeStateRow', function(){

    let elem = $(this).parents('tr').first();
    let rowID = elem.attr('id')

    removeTotalInitKey(rowID)

    window.states.splice( window.states.indexOf(rowID), 1 );

    removeAllPopoverOfID(rowID)

    elem.remove()

    //if no more row left
    let rowCount = $("#state-tbody .mainrow").length

    if (rowCount==0) {

      $("#state-tbody").append('<tr><td></td><td></td><td></td><td></td></tr>')
      
    }

    $.each( window.dataSummary, function( ds_key, ds_value ) {

      if (ds_value != undefined) {

        if (rowID == ds_value['id']) {

          window.dataSummary.splice(ds_key, 1);

        }

      }

    });

    checkStep4()
    step4HandleErrors()
    drawStateSummay()

  })




  //*********************************
  //**************************STEP 4 END

  //*********************************
  //**************************STEP 5


  $(document).on('keyup', '#policy-name-input', function() {

    let text = String(sanitizeString($(this).val()))

    let dupRowCount = $(document).find('.policy-rows[pname="'+text+'"]').length

    $(this).removeClass('is-valid is-invalid')

    if (dupRowCount>0) {
      $(this).addClass('is-invalid')
      $('#housingp-error').text('This name has been entered. Duplicate name is not allowed.')
    } else if (text == '') {
      $(this).addClass('is-invalid')
      $('#housingp-error').text('*required.')
    } else {
      $(this).addClass('is-valid')
      $('#housingp-error').text('*required.')
    }

  })

  $('#policybtn').on('click', function(e) {

    let text = $('#policy-name-input').val()
    text = String(sanitizeString(text))

    let dupRowCount = $(document).find('.policy-rows[pname="'+text+'"]').length
    $('#policy-name-input').removeClass('is-valid is-invalid')

    $('#housingp-error').text('*required.')

    if (dupRowCount > 0) {

      $('#housingp-error').text('This name has been entered. Duplicate name is not allowed.')

      $('#policy-name-input').addClass('is-invalid')

    } else if (text!='') {

      let rowID = makeid(5)
      while(document.getElementById(rowID)){
        rowID = makeid(5)
      }

      let tooltipClass = "tooltip-"+rowID

      let t = '<tr class="mainrow policy-rows" id="'+rowID+'" pname="'+text+'"><td>Policy</td>'+
              '<td>'+text+'</td>'+
              '<td><a class="text-danger pointer edit-policy-row a-tag" this-id="'+rowID+'">Edit properties</a>&nbsp;'+
              '<a data-toggle="tooltip" data-placement="top" title="" class="_icon not-set pointer '+tooltipClass+'" data-original-title="Not set"><i class="text-danger fas fa-times-circle"></i></a></td>'+
              '<td><a class="text-danger pointer remove-policy-row" this-id="'+rowID+'">Delete policy</a></td></tr>'

      let rowCount = $("#policy-tbody .mainrow").length
      if (rowCount== 0) {
        $("#policy-tbody tr").remove()
      }

      $('#policy-tbody').append(t)

      $('.'+tooltipClass).tooltip();

      window.dataSummary.push({ 'name':text, 'id':rowID, 'type':'policy', data: {} })

    } else {
      $('#policy-name-input').removeClass('is-valid is-invalid').addClass('is-invalid')
    }

  })

  $(document).on('click', '.edit-policy-row', function() {

    let flag = false

    let html =  '<div class="table-responsive row-scroll" style="border: 1px solid gray;">'+
                '<table class="table table-bordered" id="policy-edit-table" style="margin-bottom: 0">'+
                '<thead>'+
                '<tr>'+
                '<th>Type</th><th>Name</th><th>Properties</th><th>Monthly quota</th>'+
                '</tr>'+
                '</thead>'+
                '<tbody id="policy-edit-tbody">';

    var policyId = $(this).attr('this-id')

    $.each( window.dataSummary, function( ds_key, ds_value ) {

      if (ds_value != undefined) {

        if (ds_value['type'] == 'res') {

          if (ds_value['kind'] == 'main') {

            flag = true

            html += '<tr id="'+policyId+'-'+ds_value['id']+'" class="mainrow" res-id="'+ds_value['id']+'">'

            html += '<td rowspan="2">Resource</td>'

            html += '<td rowspan="2">'+ds_value['nameforshow']+'</td>'

            html += '<td class="bb0">'

            let checked = ''
            let readonly = ''
            if (ds_value['properties']['cap']==-1) {
              readonly = 'readonly'
              checked = 'checked=""'
            }

            html += '<label for="inputName">Maximum length of stay</label>'+
                    '<div class="input-group mb-3">'+
                    '<input name="policy['+policyId+']['+ds_value['id']+'][mlos]" main-id="'+ds_value['id']+'" type="number" min="1" max="1000" step="1" autocomplete="off" class="is-valid form-control policy-input policy-mlos" original-val="'+ds_value['properties']['mlos']+'" value="'+ds_value['properties']['mlos']+'">'+
                    '<div class="input-group-append">'+
                    '<span class="input-group-text bg-secondary">unchanged</span>'+
                    '</div>'+
                    '</div>';

            html += '</td>'


            html += '<td class="bb0">'+
                    '<label for="inputName"><span class="increase-decrease">Increase or decrease</span> the maximum length of stay monthly by</label>'+
                    '<input name="policy['+policyId+']['+ds_value['id']+'][mlos][mq]" type="number" min="1" max="1000" step="1" autocomplete="off" class="form-control policy-input mlos-mq mlos-input-validation" readonly value="">'+
                    '<span class="text-danger mq-error hide"></span></td>'


            html += '<tr class="last-child-row" res-id="'+ds_value['id']+'">'

            html += '<td>'

            html += '<label for="inputName">Capacity</label>'+
                    '<div class="input-group mb-3">'+
                    '<input '+readonly+' name="policy['+policyId+']['+ds_value['id']+'][cap]" type="number" min="1" max="100000" step="1" autocomplete="off" class="form-control policy-input capacity-input-policy capacity-input-validation is-valid policy-cap" original-val="'+ds_value['properties']['cap']+'" value="'+ds_value['properties']['cap']+'">'+
                    '<div class="input-group-append">'+
                    '<span class="input-group-text bg-secondary cap-change-text">unchanged</span>'+
                    '</div>'+
                    '</div>';

            html += '<label class="checkbox-inline"><input '+checked+' thisid="'+policyId+'-'+ds_value['id']+'" class="capacities-infinite-policy" type="checkbox"> Infinite</label>' 
   
            html += '</td>'

            html += '<td>'+
                    '<label for="inputName"><span class="increase-decrease">Increase or decrease</span> the capacity monthly by</label>'+
                    '<input name="policy['+policyId+']['+ds_value['id']+'][cap][mq]" type="number" min="1" max="1000" step="1" autocomplete="off" class="form-control policy-input mq-cap capacity-input-validation" readonly value="">'+
                    '<span class="text-danger cap-error hide"></span></td>'

            html += '</tr>'

          } else if (ds_value['kind'] == 'parent') {

            flag = true

            html += '<tr id="'+policyId+'-'+ds_value['id']+'" class="mainrow parentrow">'

            html += '<td>Main resource</td>'
            html += '<td>'+ds_value['nameforshow']+'</td>'
            html += '<td></td>'
            html += '<td></td>'

            html += '</tr>'

            let childCount = 0
            let rowCounter = 0
            let childRowClass = ''

            $.each( window.dataSummary, function( ds_key_child2, ds_value_child2 ) {
            
              if (ds_value_child2 != undefined) {

                if (ds_value['id'] == ds_value_child2['parent_id']) {

                  childCount += 1

                }

              }

            })

            $.each( window.dataSummary, function( ds_key_child2, ds_value_child2 ) {

              if (ds_value_child2 != undefined) {

                if (ds_value['id'] == ds_value_child2['parent_id']) {

                    rowCounter += 1

                    if (childCount > 1 && rowCounter < childCount) {

                      childRowClass = 'child-row'

                    } else{

                      childRowClass = 'last-child-row'

                    }

                    html += '<tr id="'+policyId+'-'+ds_value_child2['id']+'" parent-id="'+ds_value_child2['parent_id']+'" class="'+childRowClass+'" res-id="'+ds_value_child2['id']+'">'

                    html += '<td rowspan="2">Sub resource</td>'

                    html += '<td rowspan="2">'+ds_value_child2['nameforshow']+'</td>'

                    html += '<td class="bb0">'

                    let checked = ''
                    let readonly = ''
                    if (ds_value_child2['properties']['cap']==-1) {
                      readonly = 'readonly'
                      checked = 'checked=""'
                    }

                    html += '<label for="inputName">Maximum length of stay</label>'+
                            '<div class="input-group mb-3">'+
                            '<input name="policy['+policyId+']['+ds_value_child2['id']+'][mlos]" main-id="'+ds_value_child2['id']+'" type="number" min="1" max="1000" step="1" autocomplete="off" class="is-valid form-control policy-input policy-mlos" original-val="'+ds_value_child2['properties']['mlos']+'" value="'+ds_value_child2['properties']['mlos']+'">'+
                            '<div class="input-group-append">'+
                            '<span class="input-group-text bg-secondary">unchanged</span>'+
                            '</div>'+
                            '</div>';

                    html += '</td>'

                     html +=  '<td class="bb0">'+
                              '<label for="inputName"><span class="increase-decrease">Increase or decrease</span> the maximum length of stay monthly by</label>'+
                              '<input name="policy['+policyId+']['+ds_value_child2['id']+'][mlos][mq]" type="number" min="1" max="1000" step="1" autocomplete="off" readonly class="form-control policy-input mlos-mq mlos-input-validation" value="">'+
                              '<span class="text-danger mq-error hide"></span></td>'

                    html += '</tr>'

                    html += '<tr class="'+childRowClass+' cap-class" res-id="'+ds_value_child2['id']+'" parent-id="'+ds_value_child2['parent_id']+'">'

                    html += '<td class="bt0">'
                    html += '<label for="inputName">Capacity</label>'+
                            '<div class="input-group mb-3">'+
                            '<input '+readonly+' name="policy['+policyId+']['+ds_value_child2['id']+'][cap]" type="number" min="1" max="100000" step="1" autocomplete="off" class="form-control policy-input capacity-input-policy capacity-input-validation is-valid policy-cap" original-val="'+ds_value_child2['properties']['cap']+'" value="'+ds_value_child2['properties']['cap']+'">'+
                            '<div class="input-group-append">'+
                            '<span class="input-group-text bg-secondary cap-change-text">unchanged</span>'+
                            '</div>'+
                            '</div>';
                    html += '<label class="checkbox-inline"><input '+checked+' thisid="'+policyId+'-'+ds_value_child2['id']+'" class="capacities-infinite-policy" type="checkbox"> Infinite</label>' 
                    html += '</td>'

                    html += '<td class="bt0">'+
                            '<label for="inputName"><span class="increase-decrease">Increase or decrease</span> the capacity monthly by</label>'+
                            '<input name="policy['+policyId+']['+ds_value_child2['id']+'][cap][mq]" type="number" min="1" max="1000" step="1" autocomplete="off" class="form-control policy-input mq-cap capacity-input-validation" readonly value="">'+
                            '<span class="text-danger cap-error hide"></span></td>'

                    html += '</tr>'

                }

              }

            });

          }

        }

      }

    });

    html += '</tbody>'+
            '</table>'+
            '</div>'

    $('#policy-edit-twrapper').html(html)

    $('#save-close-policy-modal').attr('this-id',policyId)

    $('#modal-xl-policy').removeClass('hide').addClass('show')

  })

  $('.close-policy-modal').on('click', function(e) {
    $('#modal-xl-policy').removeClass('show').addClass('hide')
    $('#policy-edit-twrapper').html('')
  })

  $('#save-close-policy-modal').on('click', function(e) {
    
    let thisID = $(this).attr('this-id')


    //Delete previous data
    $(document).find('.policy-'+thisID).first().remove()
    $.each( window.dataSummary, function( ds_key_p, ds_value_p) {
      if (ds_value_p != undefined) {
        if (ds_value_p['type']=='policy') {
          if (ds_value_p['id']==thisID) {
            ds_value_p['data']={}
          }
        }
      }
    })


    let data = { 'policy-id': thisID, 'policy-data': [] }

    let notset_elem = $(document).find('.tooltip-'+thisID)

    notset_elem.attr('title','Set').attr('data-original-title','Set')
    notset_elem.find('i').removeClass('fa-times-circle').removeClass('text-danger').addClass('fa-check-circle').addClass('text-success')
    notset_elem.removeClass('not-set').addClass('set')

    let trMainRows = $(this).parents('.modal-content').first().find('.modal-body').first().find('.mainrow')

    trMainRows.each(function() {

      let ID = $(this).attr('id')

      //not a parent
      if (!$(this).hasClass('parentrow')) {

        let RowData = {}

        let nameArr = ID.split('-');

        let policyID = nameArr[0]
        let rowID = nameArr[1]

        let childTrElem = $(this).parents('tbody').first().find('.last-child-row[res-id="'+rowID+'"]').first()


        RowData['kind'] = 'main'
        RowData['policyID'] = policyID
        RowData['rowID'] = rowID
        RowData['policy-mlos'] = $(this).find('.policy-mlos').first().val()
        RowData['mlos-mq'] = $(this).find('.mlos-mq').first().val()
        RowData['policy-cap'] = childTrElem.find('.policy-cap').first().val()
        RowData['mq-cap'] = childTrElem.find('.mq-cap').first().val()

        data['policy-data'].push(RowData)

      } else {

        let RowData = {}

        let nameArr = ID.split('-');

        let policyID = nameArr[0]
        let parentID = nameArr[1]

        RowData['kind'] = 'parent'
        RowData['policyID'] = policyID
        RowData['rowID'] = parentID
        data['policy-data'].push(RowData)

        let childTrElem = $(this).parents('tbody').first().find('tr[parent-id="'+parentID+'"]')

        childTrElem.each(function() {

          if (!$(this).hasClass('cap-class')) {

            let childRowData = {}

            let rowID = $(this).attr('res-id')

            childRowData['kind'] = 'child'
            childRowData['policyID'] = policyID
            childRowData['parentID'] = parentID
            childRowData['rowID'] = rowID

            childRowData['policy-mlos'] = $(this).find('.policy-mlos').first().val()
            childRowData['mlos-mq'] = $(this).find('.mlos-mq').first().val()

            let childTrCapElem = $(this).parents('tbody').first().find('.cap-class[parent-id="'+parentID+'"][res-id="'+rowID+'"]')

            childRowData['policy-cap'] = childTrCapElem.find('.policy-cap').first().val()
            childRowData['mq-cap'] = childTrCapElem.find('.mq-cap').first().val()

            data['policy-data'].push(childRowData)

          }

        })

      }

    })


    $.each( window.dataSummary, function( ds_key, ds_value) {
      if (ds_value != undefined) {
        if (ds_value['type']=='policy') {

          if (ds_value['id'] == thisID) {
            
            ds_value['data'] = data

          }

        }
      }
    })

    insertPolicyToDOM(thisID)

    $('#modal-xl-policy').removeClass('show').addClass('hide')
    $('#policy-edit-twrapper').html('')

  })

  $(document).on("click",".remove-policy-row",function() {

    let thisID = $(this).attr('this-id')

    $(document).find('.policy-'+thisID).first().remove()

    $.each( window.dataSummary, function( ds_key, ds_value) {
      if (ds_value != undefined) {
        if (ds_value['type']=='policy') {
          if (ds_value['id']==thisID) {
            window.dataSummary.splice(ds_key, 1);
          }
        }
      }
    })

    $('tr[id="'+thisID+'"]').first().remove()

    let rowCount = $("#policy-tbody .mainrow").length
    if (rowCount== 0) {
      
      $('#policy-tbody').append('<tr><td></td><td></td><td></td><td></td></tr>')

    }

  })

  

  $(document).on("keyup change blur",".capacities-infinite-policy",function(e,data) {

    let cap_input = $(this).parents('td').first().find('.capacity-input-policy').first()
    let changeTextElem = $(this).parents('td').first().find('.cap-change-text')

    let original_val = cap_input.attr('original-val')
    let current_val = cap_input.val()

    cap_input.removeClass('is-invalid').addClass('is-valid')

    if(this.checked) {

      cap_input.val('-1').attr('readonly','true');

      if (original_val != -1) {
        changeTextElem.removeClass('bg-secondary bg-orange bg-lime').addClass('bg-secondary').text('changed to infinite')
      } else {
        changeTextElem.removeClass('bg-secondary bg-orange bg-lime').addClass('bg-secondary').text('unchanged')
      }

      $(this).parents('tr').first().find('.mq-cap').val('').removeClass('is-invalid is-valid').attr('readonly',true)

    } else {

      if (original_val != -1) {

        cap_input.val(original_val).removeAttr('readonly');
        changeTextElem.removeClass('bg-secondary bg-orange bg-lime').addClass('bg-secondary').text('unchanged')

      } else {

        cap_input.val('1').removeAttr('readonly');
        $(this).parents('tr').first().find('.mq-cap').val('').removeClass('is-invalid is-valid').attr('readonly',true)
        changeTextElem.removeClass('bg-secondary bg-orange bg-lime').addClass('bg-secondary').text('changed')

      }

    }

  });

  $(document).on('keyup change blur', '.capacity-input-policy', function() {

    if ($(this).attr('readonly') != 'readonly') {

      let original_val = $(this).attr('original-val')
      let current_val = parseInt($(this).val())

      if (original_val != -1) {

        $(this).removeClass('is-invalid').addClass('is-valid')

        let is_increased = 'unchanged'
        let prepared_text = ''
        let textClass = ''
        let increaseDecrease = ''

        let diff = difference(current_val, original_val)

        if (current_val > original_val) {

          prepared_text = 'increased by '+ diff
          textClass = 'bg-lime'
          increaseDecrease = 'Increase'

        } else if (current_val < original_val) {
         
          prepared_text = 'decreased by '+diff
          textClass = 'bg-orange'
          increaseDecrease = 'Decrease'

        } else {

          prepared_text = 'unchanged'
          textClass = 'bg-secondary'

        }

        $(this).parents('div').first().find('.input-group-text').removeClass('bg-secondary bg-orange bg-lime').addClass(textClass).text(prepared_text)
        

        if (current_val != original_val) {

          $(this).parents('tr').first().find('.increase-decrease').first().text(increaseDecrease)

          $(this).parents('tr').first().find('.mq-cap').first().val('').removeClass('is-valid').addClass('is-invalid').removeAttr('readonly')

        } else {

          $(this).parents('tr').first().find('.increase-decrease').first().text('Increase or decrease')

          $(this).parents('tr').first().find('.mq-cap').first().val('').removeClass('is-invalid is-valid').attr('readonly','true')

        }

      }

    }

  })

  $(document).on('keyup change blur', '.policy-mlos', function() {

    let current_val = parseInt($(this).val())
    let main_id = $(this).attr('main-id')

    if (current_val >= 0) {

      let original_val = null
      let diff = null
      let is_increased = 'unchanged'
      let prepared_text = ''
      let textClass = ''
      let increaseDecrease = ''

      $.each( window.dataSummary, function( ds_key, ds_value) {
        if (ds_value != undefined) {
          if (ds_value['id'] == main_id) {
            original_val = parseInt(ds_value['properties']['mlos'])
          }
        }
      })

      diff = difference(current_val, original_val)

      if (current_val > original_val) {

        prepared_text = 'increased by '+diff
        textClass = 'bg-lime'
        increaseDecrease = 'Increase'

      } else if (current_val < original_val) {
       
        prepared_text = 'decreased by '+diff
        textClass = 'bg-orange'
        increaseDecrease = 'Decrease'

      } else {

        prepared_text = 'unchanged'
        textClass = 'bg-secondary'

      }

      $(this).removeClass('is-invalid').addClass('is-valid')

      $(this).parents('div').first().find('.input-group-text').removeClass('bg-secondary bg-orange bg-lime').addClass(textClass).text(prepared_text)

      if (current_val != original_val) {

        $(this).parents('tr').first().find('.increase-decrease').first().text(increaseDecrease)

        $(this).parents('tr').first().find('.mlos-mq').first().removeAttr('readonly').removeClass('is-valid').addClass('is-invalid').val('')

        $(this).parents('tr').first().find('.mq-error').first().removeClass('show').addClass('hide').text('')

      } else {

        $(this).parents('tr').first().find('.increase-decrease').first().text('Increase or decrease')

        $(this).parents('tr').first().find('.mlos-mq').first().attr('readonly','true').removeClass('is-valid is-invalid').val('')

        $(this).parents('tr').first().find('.mq-error').first().removeClass('show').addClass('hide').text('')

      }

    } else {

      $(this).removeClass('is-valid').addClass('is-invalid')

      $(this).parents('div').first().find('.input-group-text').removeClass('bg-secondary bg-orange bg-lime').addClass('bg-secondary').text('')

      $(this).parents('tr').first().find('.mlos-mq').first().attr('readonly','true').removeClass('is-valid is-invalid').val('')

      $(this).parents('tr').first().find('.increase-decrease').first().text('Increase or decrease')

      $(this).parents('tr').first().find('.mq-error').first().removeClass('show').addClass('hide').text('')

    }

  })

  $(document).on('keyup change blur', '.mlos-mq', function() {

    let original_val = parseInt($(this).parents('tr').first().find('.policy-mlos').first().attr('original-val'))
    let current_val = parseInt($(this).parents('tr').first().find('.policy-mlos').first().val())

    let mq_val = parseInt($(this).val())

    let flag = false
    let msg = ''

    let diff = difference(current_val, original_val)

    if (diff<mq_val) {

      msg = 'Monthly quota cannot be bigger than the difference between the original and the new maximum length of stay'

      $(this).removeClass('is-valid').addClass('is-invalid')

      $(this).parents('tr').first().find('.mq-error').first().removeClass('hide').addClass('show').text(msg)

    } else if (mq_val<= 0) {

      msg = 'Monthly quota cannot be zero'

      $(this).removeClass('is-valid').addClass('is-invalid')

      $(this).parents('tr').first().find('.mq-error').first().removeClass('hide').addClass('show').text(msg)

    } else {

      $(this).removeClass('is-invalid').addClass('is-valid')

      $(this).parents('tr').first().find('.mq-error').first().removeClass('show').addClass('hide')

    }

  })

  $(document).on('keyup change blur', '.mq-cap', function() {

    let inputElem =  $(this).parents('tr').first().find('.capacity-input-policy').first()
    let errorElem = $(this).parents('tr').first().find('.cap-error').first()

    let original_val = inputElem.attr('original-val')
    let current_val = inputElem.val()

    let cap_val = parseInt($(this).val())

    let flag = false
    let msg = ''

    let diff = difference(current_val, original_val)

    if (diff<cap_val) {

      msg = 'Monthly quota cannot be bigger than the difference between the original and the new resource capacity'

      $(this).removeClass('is-valid').addClass('is-invalid')

      errorElem.removeClass('hide').addClass('show').text(msg)

    } else if (cap_val<= 0) {

      msg = 'Monthly quota cannot be zero'

      $(this).removeClass('is-valid').addClass('is-invalid')

      errorElem.removeClass('hide').addClass('show').text(msg)

    } else {

      $(this).removeClass('is-invalid').addClass('is-valid')

      errorElem.removeClass('show').addClass('hide')

    }

  })

  //*********************************
  //**************************STEP 5 END


  $(document).on('keyup', '.transitioninput', function() {

    let val = parseFloat($(this).val())


      let allinputs = $(this).parents('tr').first().find('input')
      let total = 0

      allinputs.each(function() {

        let v = $(this).val()

        if (v == "") {
          v = 0
        }

        let num = parseFloat(v)

        total = total + num

      });

      total = total.toFixed(2)

      let totaltext = $(this).parents('tr').first().find('.rowtotal').first()

      totaltext.find('.totalval').text(total)

      if (total != 1){
        totaltext.find('.msg').first().text('The total summation of the transition probabilities in one row must add up to 1')
      } else {
        totaltext.find('.msg').first().text('')
      }

        
  });

  //LAST STEP

  $(document).on('click','.show-info', function(){

    let message = $(this).find('span').first().attr('msg')


    if (message === 'undefined' || message === undefined) {
      if ($(this).hasClass('apop-info')) {
        message = 'The population type that is allowed to enter this resource/subresource'
      } else if ($(this).hasClass('apop-ls-info')) {
        message = 'The population type that is allowed to enter this living situation'
      } else if($(this).hasClass('initpop-info')){
        message = 'The number of individuals that reside in this resource/subresource at the beginning of the simulation'
      } else if($(this).hasClass('initpop-ls-info')){
        message = 'The number of individuals that are in this living situation at the beginning of the simulation'
      } else if($(this).hasClass('maxl-info')){
        message = 'The maximum number of weeks any individual can reside continuously in this resource/subresource'
      } else if($(this).hasClass('cap-info')){
        message = 'The total number of individuals that can stay at this resource/subresource at any given time'
      } else if($(this).hasClass('mq-info')){
        message = 'The number of individuals allowed to move to this resource at the beginning of every month'
      }
    }

    window.info_Toast.fire({
      title: 'Info',
      text: message,
      icon: 'info',
    })

  });

})

function tick(){
  timeElapsed++;
  $('#stopwatch').attr('value',timeElapsed)
}
function startTimer(){
    //call the first setInterval
    myTimer = setInterval(tick, 1000);
}

function validateAllSteps(){

  let output = false

  if (checkStep1() && checkStep2() && checkStep3() && checkStep4() && checkStep6()) {

    output = true

  }

  return output

}


function checkStep1(){

  let output = {'flag':false,'message':''}

  if (window.loc == 1 && $('#simulation-name').val()) {

    let simname = $('#simulation-name').val();

    if (NoSpecialCharacter(simname)) {

      $('#loc-overview').text('Complete').addClass('text-success').removeClass('text-danger')

      $('#loc-div').removeClass('hide')
      $('#s1-sum').removeClass('hide')

      $('#simname-side').text( simname )
      $('#cityname-side').text( $('#autocomplete').val() )

      output['flag'] = true

      return output

    } else {

      output['message'] = 'Simulation name cannot contain special characters'

      $('#loc-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

      $('#loc-div').addClass('hide')
      $('#s1-sum').addClass('hide')

      $('#simname-side').text('')
      $('#cityname-side').text('')

      return output

    }

  } else {

    $('#loc-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

    $('#loc-div').addClass('hide')
    $('#s1-sum').addClass('hide')

    $('#simname-side').text('')
    $('#cityname-side').text('')

    output['message'] = 'Simulation name and the city name are required'

    return output

  }
  
}

function step1HandleErrors(){

  let simname = $('#simulation-name').val();

  let nameValidated = false
  let cityValidated = false

  if (simname=="" || !NoSpecialCharacter(simname)) {
    $('#simname-error').css('display','block')
    $('#simulation-name').removeClass('is-valid').addClass('is-invalid')
    nameValidated = false
  } else {
    $('#simname-error').css('display','none')
    $('#simulation-name').removeClass('is-invalid').addClass('is-valid')
    nameValidated = true
  }

  if (window.loc != 1) {
    $('#cityname-error').css('display','block')
    $('.sim-location').removeClass('is-valid').addClass('is-invalid')
    cityValidated = false
  } else {
    $('#cityname-error').css('display','none')
    $('.sim-location').removeClass('is-invalid').addClass('is-valid')
    cityValidated = true
  }

  if (nameValidated && cityValidated) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}


function step2HandleErrors(){

  let typesInput = false

  if (window.populationType.length >= 1) {

    typesInput = true

  }

  if (typesInput) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}

function step3HandleErrors(){

  let resourcesSet = false

  if (window.resources.length >= 1) {

    resourcesSet = true

  }

  if (resourcesSet) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}

function step4HandleErrors(){

  let statesSet = false

  if (window.states.length >= 1) {

    statesSet = true

  }

  if (statesSet) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}

function step5HandleErrors(){

  let policySet = true

  if (policySet) {
    $('#next').removeAttr('disabled')
  } else {
    $('#next').attr('disabled','true')
  }
  
}

function step6HandleErrors(){

  let weeksVal = $('#simweeks').val()
  let simnumVal = $('#simnum').val()

  let weeksInput = false
  let simNumInput = false

  if (weeksVal=="" || !NoSpecialCharacter(weeksVal)) {
    $('#weeks-error').css('display','block')
    $('#simweeks').removeClass('is-valid').addClass('is-invalid')
    weeksInput = false
  } else {
    $('#weeks-error').css('display','none')
    $('#simweeks').removeClass('is-invalid').addClass('is-valid')
    weeksInput = true
  }

  if (simnumVal=="" || !NoSpecialCharacter(simnumVal)) {
    $('#simnum-error').css('display','block')
    $('#simnum').removeClass('is-valid').addClass('is-invalid')
    simNumInput = false
  } else {
    $('#simnum-error').css('display','none')
    $('#simnum').removeClass('is-invalid').addClass('is-valid')
    simNumInput = true
  }

  if (weeksInput && simNumInput) {
    $('#parameters-overview').text('Complete').addClass('text-success').removeClass('text-danger')
    $('#next').removeAttr('disabled')
  } else {
    $('#parameters-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')
    $('#next').attr('disabled','true')
  }
  
}

function checkStep2(){

  let output = {'flag':false,'message':''}

  if (window.populationType.length >= 1) {

    output['flag'] = true

  } else {

    $('#population-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')


    $('#population-info').css('display','none');
    $('#population-info').html('');

    output['message'] = 'At least 1 population type is required!'

  }

  if ( output['flag'] ) {

    let popcounts = $(document).find('.pop-total-nums');

    popcounts.each(function(){

      if ( $(this).val() == "" ){

        output['flag'] = false

        output['message'] = 'Enter population counts for all the included population types!'

      }

    });

    if (output['flag']) {

      $('#population-overview').text('Complete').addClass('text-success').removeClass('text-danger')

      let infoSectionPopulation = '<ul class="sum-ul">'
      
      let tbody = $(document).find('#populationtable tbody')

      $.each( window.populationType, function( k1, value ) {

        let thisPopulationVal = tbody.find('input[popfullname="'+value+'"]').first().val()

        infoSectionPopulation += '<li>'+value+': '+thisPopulationVal+'</li>';

      });

      infoSectionPopulation += '</ul>'

      $('#population-info').css('display','block');
      $('#population-info').html(infoSectionPopulation);

    }

  }
  
  return output

}

function checkStep3(){

  let output = {'flag':false,'message':''}

  if (window.resources.length >= 1) {

    let unsetRows = $(document).find('#restable').find('.not-set').length
    let unsetNames = $(document).find('#restable').find('.is-invalid').length

    if (parseInt(unsetRows)!=0 || parseInt(unsetNames)!=0) {

      output['message'] = "One or more properties are not set!"

    } else {

      $('#resources-overview').text('Complete').addClass('text-success').removeClass('text-danger')
      output['flag'] = true

    }

  } else {

    output['message'] = "At least 1 resource is required!"

    $('#resources-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }

  return output

}

function checkStep4(){

  let output = {'flag':false,'message':''}

  if (window.states.length >= 1) {

    let unsetRows = $(document).find('#statetable').find('.not-set').length
    let unsetNames = $(document).find('#statetable').find('.is-invalid').length

    if (parseInt(unsetRows)!=0 || parseInt(unsetNames)!=0) {

      output['message'] = "One or more properties are not set."

    } else {

      $('#states-overview').text('Complete').addClass('text-success').removeClass('text-danger')
      output['flag'] = true

    }

  } else {

    output['message'] = "At least 1 additional states is required!"

    $('#states-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }

  return output

}

function checkStep5(){

  let output = {'flag':false,'message':''}

  output['flag'] = true

  return output

}

function checkStep6(){

  let output = false

  if ($('#simweeks').val() && $('#simnum').val() ) {

    output = true

    $('#parameters-overview').text('Complete').addClass('text-success').removeClass('text-danger')


  } else {

    $('#parameters-overview').text('Incomplete').addClass('text-danger').removeClass('text-success')

  }
  
  return output

}

function  removeDuplicate(myarray){
  let uniqueNames = []
  $.each(myarray, function(i, el){
      if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
  });
  return uniqueNames

}

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;

}

function activatePopUpWindows(rowID,type,name){

  let apopID = 'apop-'+rowID
  let ipopID = 'ipop-'+rowID
  let mpopID = 'mpop-'+rowID
  let cpopID = 'cpop-'+rowID
  let mqpopID = 'qpop-'+rowID

  $(document).find('#'+apopID).popover({html:true,title: "Allowed Population Type <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
  });

  $(document).find('#'+ipopID).popover({html:true,title: "Initial Population Count <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
      $('.popover').not(this).hide();
      $(this).data("bs.popover").inState.click = false;
      $(this).popover('show');
      e.preventDefault();
  });

  let _type = 'state'

  if (type=="res") {

    _type = 'resource'

    $(document).find('#'+mpopID).popover({html:true,title: "Maximum Length of Stay <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

    $(document).find('#'+cpopID).popover({html:true,title: "Capacity <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
        $('.popover').not(this).hide();
        $(this).data("bs.popover").inState.click = false;
        $(this).popover('show');
        e.preventDefault();
    });

    addMpopHTML(mpopID,rowID,_type)
    addCpopHTML(cpopID,rowID,_type)

    if (name == 'Housing First') {

      $(document).find('#'+mqpopID).popover({html:true,title: "Monthly Quota <a class='dismisspopover close' data-dismiss='alert'>&times;</a>"}).click(function(e) {
          $('.popover').not(this).hide();
          $(this).data("bs.popover").inState.click = false;
          $(this).popover('show');
          e.preventDefault();
      });
      addMQpopHTML(mqpopID,rowID,_type)

    }

  }

  addApopHTML(apopID,rowID,_type)
  addIpopHTML(ipopID,rowID,_type)

}

function addApopHTML(ThisID,rowID,_type){

  let html = '<div><div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered">'+
        '<thead>'+
          '<tr>'+
            '<th>Population Type</th><th>Allowed</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody>';

  $.each( window.populationType, function( k1, value ) {

    html += '<tr><td class="pop" style="font-weight: 900">'+value+'</td>'+
            '<td class="pop"><label class="checkbox-inline"><input kind="'+_type+'" name="allowedPopulation['+_type+']['+rowID+']['+value+']" class="ana" type="checkbox" value="'+value+'" checked> Allowed</label></td></tr>';

  });

  html +=   '</tbody></table></div><div style="width:100%"><a rowid="'+rowID+'" type="ap" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function addIpopHTML(ThisID,rowID,_type){

  let html = '<div><div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  $.each(window.populationType, function( k1, value ) {

    html += ReturnIpopTR(value,rowID,_type)

  });

  html += '</tbody></table></div><div style="width:100%"><a rowid="'+rowID+'" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }


  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function addCpopHTML(ThisID,rowID,_type){

  let html =  '<div><div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Capacity</td>'+
          '<td class="pop" ><input class="form-control capacity-inputs capacity-input-validation" name="capacity['+_type+']['+rowID+']" style="width:100px; height:100%;" placeholder="#" value="-1" readonly="true" type="number" min="1" max="100000" step="1">'+
          '<br><label class="checkbox-inline"><input checked thisid="'+rowID+'" class="capacities-infinite" name="capacityCheckBox['+_type+']['+rowID+']" type="checkbox"> Infinite</label>'+
          '</td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a rowid="'+rowID+'" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}


function addMpopHTML(ThisID,rowID,_type){

  let html =  '<div><div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Maximum Length of Stay (weeks)</td>'+
            '<td class="pop"><input kind="mls" class="maxlength-input-validation" type="number" min="1" max="1000" step="1" name="maximumlengthofstay['+_type+']['+rowID+']" value="7" style="width:100px; height:100%;" placeholder="#"></td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a rowid="'+rowID+'" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function addMQpopHTML(ThisID,rowID,_type){

  let html =  '<div><div class="table-responsive">'+
          '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  html += '<tr><td class="pop" style="font-weight: 900">Monthly Quota</td>'+
            '<td class="pop"><input kind="mqinput" class="mq-input-validation" type="number" min="1" max="10000" step="1" name="monthlyquota['+_type+']['+rowID+']" value="1" style="width:100px; height:100%;" placeholder="#"></td></tr>';

  html +=   '</tbody></table></div><div style="width:100%"><a rowid="'+rowID+'" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] === 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}


function updateIpopHTML(populationArray,rootID,_type){

  let ThisID = 'ipop-'+rootID

  let html = '<div><div class="table-responsive">'+
     '<table id="'+ThisID+'" class="table table-bordered"><tbody>';

  $.each(populationArray, function( k1, value ) {

    html += ReturnIpopTR(value,rootID,_type)

  });

  html +=   '</tbody></table></div><div style="width:100%"><a rowid="'+rootID+'" id="'+ThisID+'" class="closepop btn btn-xs btn-primary text-white pointer">Save and Close</a></div></div>';


  if(typeof window.popovers[ThisID] !== 'undefined') {
    window.popovers[ThisID] = html
  }

  $(document).find('#'+ThisID).on('shown.bs.popover', function () {

    let popid = $(this).attr('aria-describedby')

    let thisid = $(this).attr('id')

    $(document).find('#'+popid).first().find('.popover-content').first().html(window.popovers[thisid]);

  })

}

function ReturnIpopTR(value,rowID,_type){
  let html = '<tr name="'+value+'"><td class="pop" style="font-weight: 900">'+value+'</td>'+
            '<td class="pop"><input class="initpop-input initpop-input-validation initpop-input-'+rowID+'" type="number" min="0" max="100000" step="1" value="0" name="initialPopulation['+_type+']['+rowID+']['+value+']" style="width:100px; height:100%;" placeholder="#"></td></tr>';
  return html;
}

function makeResourcesPropretiesTD(rowID,tooltipClass,name){
  let html =  '<ul class="mb0"><li name="apop-'+rowID+'"><a id="apop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Allowed Population Type</a>'+
              '&nbsp;<a class="show-info pointer apop-info"><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li name="ipop-'+rowID+'"><a id="ipop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Initial Population Count</a>'+
              '&nbsp;<a class="show-info pointer initpop-info"><span></span><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li name="mpop-'+rowID+'"><a id="mpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Maximum Length of Stay</a>'+
              '&nbsp;<a class="show-info pointer maxl-info"><span></span><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li name="cpop-'+rowID+'"><a id="cpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Capacity</a>'+
              '&nbsp;<a class="show-info pointer cap-info"><span></span><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>';

              if (name == 'Housing First') {

                html +='<li name="qpop-'+rowID+'"><a id="qpop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Monthly Quota</a>'+
                '&nbsp;<a class="show-info pointer mq-info"><span></span><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
                '</li>';

              }

  return html
}

function makeStatesPropretiesTD(rowID,tooltipClass){
  let html =  '<ul class="mb0"><li name="apop-'+rowID+'"><a id="apop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Allowed Population Type</a>'+
              '&nbsp;<a class="show-info pointer apop-ls-info"><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>'+

              '<li name="ipop-'+rowID+'"><a id="ipop-'+rowID+'" class="a-tag popover-all" data-placement="bottom" data-toggle="popover">Initial Population Count</a>'+
              '&nbsp;<a class="show-info pointer initpop-ls-info"><span></span><i class="text-info fas fa-info-circle"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Not set" class="_icon not-set pointer '+tooltipClass+'"><i class="text-danger fas fa-times-circle"></i></a>'+
              '</li>';

  return html
}

function HandleStepsOnNextBtnClick(){

  let step = window.currentstep

  switch(step){

    //LOCATION
    case 1:

      let output = checkStep1();

      if (output['flag']) {
        $('#smartwizard').smartWizard("next")
      } else {
        window.Toast.fire({
        title: 'Error',
        text: output['message'],
        icon: 'error',
        })
      }

    break;

    //POPULATION
    case 2:

      storeTypePopulation()

      let validatepop = checkStep2()

      if (validatepop['flag']===true) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: validatepop['message'],
          icon: 'warning'
        })
      }

    break;

    //RESOURCES
    case 3:

      let validate = checkStep3()

      if (validate['flag']===true) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: validate['message'],
          icon: 'warning'
        })
      }

    break;

    //STATES
    case 4:

      let stateValidate = checkStep4()

      if (stateValidate['flag']===true) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: stateValidate['message'],
          icon: 'warning'
        })
      }

    break;

    //policies
    case 5000:

      let policyValidate = checkStep5()

      if (policyValidate['flag']===true) {
        $('#smartwizard').smartWizard("next")
      } else {
        Toast.fire({
          title: 'Error',
          text: policyValidate['message'],
          icon: 'warning'
        })
      }

    break;

    //PRAMETERS
    case 5:
      if (checkStep6()) {

        if (validateAllSteps()) {

          InsertArrayElementToDOM(window.populationType,'#myform','populationType')

          Object.keys(window.popovers).forEach(function(key) {

            $('#popoverhtmls').append(window.popovers[key])

          });

          $('#myform').submit()

        } else {

          Toast.fire({
            title: 'Error',
            text: "One or more steps are incomplete!",
            icon: 'warning'
          })

        }

      } else {
        Toast.fire({
        title: 'Error',
        text: "All parameters are required!",
        icon: 'warning'
        })
      }

    break;
  }

}

function MakeResourcesRowColumnHTML(rowID,tooltipClass,type,name,nameForShow){

  let rowCount = $("#res-tbody tr").length

  let tr = '<tr id="'+rowID+'" class="mainrow" count="'+rowCount+'" type="'+type+'" name="'+name+'">';
  let td0 = '<td kind="name">'+nameForShow+'</td>';

  let td1 = '<td kind="nameinput"><input type="text" maxlength="40" class="form-control no-special-chars res-state-name is-invalid" name="resources['+rowID+'][name-for-show]" value="" placeholder="Enter resource name">'+
            '<input type="hidden" class="form-control" name="resources['+rowID+'][name]" value="'+name+'" maxlength="40">'+
            '<small class="text-danger hide res-state-name-error">* This name has been entered. Duplicate name is not allowed.</small></td>';
  
  let td2 = '<td kind="action">'+
            '<a class="text-link divideRes pointer">Add sub-resource&nbsp;<a class="show-info pointer"><span msg="This feature divides this resource into multiple resources"></span><i class="text-info fas fa-info-circle"></i></a></a>'+
            '</td>'

  let td3 = '<td kind="props">'+makeResourcesPropretiesTD(rowID,tooltipClass,name)+'</td>'

  let td4 = '<td kind="action">'+
            '<a class="text-danger pointer removeResRow">Delete resource</a>'+
            '</td>'

  let row =   tr+
              td0+
              td1+
              td2+
              td3+
              td4+
              '</tr>';
  return row;
}

function MakeSUBResourcesRowColumnHTML(rowID,parentID,subRowCount,tooltipClass,parentName){

  let _class = ""
  if (subRowCount!=0) 
    _class = 'nthsub'

  let tr = '<tr id="'+rowID+'" parentID="'+parentID+'" class="sub '+_class+'" count="'+subRowCount+'">'
  let td0 = '<td>Sub '+parentName+'</td>';
  let td1 = '<td><input type="text" class="form-control no-special-chars res-state-name is-invalid" name="subresources['+parentID+']['+rowID+'][name]" placeholder="Enter sub-resource name"><small class="text-danger hide res-state-name-error">* This name has been entered. Duplicate name is not allowed.</small></td>'
  let td2 = '<td></td>'
  let td3 = '<td>'+makeResourcesPropretiesTD(rowID,tooltipClass,parentName)+'</td>'
  let td4 = '<td><a class="text-danger pointer removeResSubRow">Delete sub-resource&nbsp;</a></td>'
  let row =   tr+
              td0+
              td1+
              td2+
              td3+
              td4+
              '</tr>';
  return row;
}

function MakeStatesRowColumnHTML(rowID,tooltipClass,type,name){
  let rowCount = $("#state-tbody tr").length
  let tr = '<tr id="'+rowID+'" class="mainrow" count="'+rowCount+'" type="'+type+'" name="'+name+'">';
  let td0 = '<td>'+name+'</td>';

  let td1 = '<td><input type="text" class="form-control no-special-chars res-state-name is-invalid" name="states['+rowID+'][name-for-show]" value="" placeholder="Enter living situations name">'+
            '<input type="hidden" class="form-control" name="states['+rowID+'][name]" value="'+name+'">'+
            '<small class="text-danger hide res-state-name-error">* This name has been entered. Duplicate name is not allowed.</small></td>';

  let td3 = '<td>'+makeStatesPropretiesTD(rowID,tooltipClass)+'</td>'
  let td4 = '<td><a class="text-danger pointer removeStateRow">Delete living situation</a></td>'
  let row =   tr+
              td0+
              td1+
              td3+
              td4+
              '</tr>';
  return row;
}


function MakeTransitionalPropTable(){

  let arr = []

  Object.keys(window.resources).forEach(function(key) {

    Object.keys(window.resources[key]).forEach(function(key2) {

      arr.push(window.resources[key][key2])

    });

  });

  Object.keys(window.states).forEach(function(key) {

    Object.keys(window.states[key]).forEach(function(key2) {

      arr.push(window.states[key][key2])

    });

  });


  arr = removeDuplicate(arr)

  html = '<div class="table-responsive">'+
  '<table id="transprop" class="table table-bordered">'+
  '<thead>'+
  '<tr><th></th>';


  $.each( arr, function( k1, value ) {

    html += '<th>'+value+'</th>';

  });

  html += '<th>Total</th>';

  html += '</tr>'+
  '</thead>'+
  '<tbody>';

  $.each( arr, function( k1, v1 ) {

    html += '<tr><td class="titles">'+v1+'</td>';

    $.each( arr, function( k1, v2 ) {

      html += '<td><input name="TransitionProbability['+v1+']['+v2+']" id="'+v1+'-'+v2+'" type="text" class="form-control transitioninput no-special-chars" placeholder="0 to 1"></td>';

    });

    html += '<td class="rowtotal"><p class="totalval">0</p><p><small class="msg" style="color:red"></small></p></td>';

    html += '</tr>';

  });


  html += '</tbody></table></div>';

  $('#transitiontable').html(html)

}

function InsertArrayElementToDOM(array,elem,inputName){

  $(document).find('.'+inputName+'-input').remove()

  let i = 0;
  for (i = 0; i < array.length; i++) {
    $(elem).append('<input type="hidden" class="'+inputName+'-input" name="'+inputName+'['+i+']" value="'+array[i]+'">')
  }

}

function removeAllPopoverOfID(rowID){
  let apopID = 'apop-'+rowID
  let ipopID = 'ipop-'+rowID
  let mpopID = 'mpop-'+rowID
  let cpopID = 'cpop-'+rowID

  delete window.popovers[apopID]
  delete window.popovers[ipopID]
  delete window.popovers[mpopID]
  delete window.popovers[cpopID]
}

function NoSpecialCharacter(str){

    var regex = new RegExp("^[ a-zA-Z0-9]+$");
    if (!regex.test(str) ) {
      return false;
    } else {
      return true;
    }

}

function storeTypePopulation(){

  window.TypePopulation = {}

  let popinput = $(document).find('.pop-num-input')

  popinput.each(function() {

    let _name = $(this).attr('popfullname')
    let _val = $(this).val()

    window.TypePopulation[_name] = _val

  });
    
}

function validatePopulationCounts(popArray,rowID){

  let totalArray = {}

  $.each(popArray, function( k1, v1 ) {

    let typeTotal = 0

    $.each(window.TotalInitPopulation, function( k2, v2 ) {

        if (rowID!=k2) {

          if (v2[k1] != undefined) {

            typeTotal = typeTotal + parseInt(v2[k1])

          }

        }

    })

    totalArray[k1] = parseInt(v1) + typeTotal

  });

  let errorArray = {}
  let f = false

  $.each(totalArray, function( k3, v3 ) {

    if (window.TypePopulation[k3] != undefined) {

      if (v3>window.TypePopulation[k3]) {

        errorArray[k3] = []

        errorArray[k3]['current'] = v3
        errorArray[k3]['total'] = window.TypePopulation[k3]

        f = true

      }

    }

  })

  if (f) {

    let errorMsg = '<div class="text-left"><span>The sum of initial populations cannot be more than the total population count (set in step 2).</span>'

    errorMsg += '<ul>';
    $.each(errorArray, function( k4, v4 ) {

      let allInputs = $(document).find('table[id="ipop-'+rowID+'"]').first().find('tr[name="'+k4+'"]').first().find('.initpop-input').val(0)

      errorMsg += '<li>The total population count for "'+k4+'" was set to '+v4['total']+', but the sum of all initial populations is '+v4['current']+'</li>'

    })
    errorMsg += '</ul></div>'


    return errorMsg

  }

  return true

}

function removeTotalInitKey(rowID){

  delete window.TotalInitPopulation[rowID]

}
    
function UnsetCapacity(rowID){

  let thisTooltip = $(document).find('li[name="cpop-'+rowID+'"').first().find('._icon').first()

  thisTooltip.removeClass('set').addClass('not-set').attr('title','Not set').attr('data-original-title','Not set')
  thisTooltip.find('i').first().removeClass('fa-check-circle').removeClass('text-success').addClass('fa-times-circle').addClass('text-danger')

  $.each( window.dataSummary, function( ds_key, ds_value ) {
    if (ds_value != undefined) {
      if (rowID == ds_value['id']) {
        window.dataSummary[ds_key]['properties']['cap']= '-1';
      }
    }
  });

}

   
function UnsetInitialPopulation(rowID){

  let thisTooltip = $(document).find('li[name="ipop-'+rowID+'"').first().find('._icon').first()

  thisTooltip.removeClass('set').addClass('not-set').attr('title','Not set').attr('data-original-title','Not set')
  thisTooltip.find('i').first().removeClass('fa-check-circle').removeClass('text-success').addClass('fa-times-circle').addClass('text-danger')

}


function UnsetAllowedPopulation(rowID){

  let thisTooltip = $(document).find('li[name="apop-'+rowID+'"').first().find('._icon').first()

  thisTooltip.removeClass('set').addClass('not-set').attr('title','Not set').attr('data-original-title','Not set')
  thisTooltip.find('i').first().removeClass('fa-check-circle').removeClass('text-success').addClass('fa-times-circle').addClass('text-danger')

}

function UnsetMLS(rowID){

  let thisTooltip = $(document).find('li[name="mpop-'+rowID+'"').first().find('._icon').first()

  thisTooltip.removeClass('set').addClass('not-set').attr('title','Not set').attr('data-original-title','Not set')
  thisTooltip.find('i').first().removeClass('fa-check-circle').removeClass('text-success').addClass('fa-times-circle').addClass('text-danger')

}

function UnsetMQ(rowID){

  let thisTooltip = $(document).find('li[name="qpop-'+rowID+'"').first().find('._icon').first()

  thisTooltip.removeClass('set').addClass('not-set').attr('title','Not set').attr('data-original-title','Not set')
  thisTooltip.find('i').first().removeClass('fa-check-circle').removeClass('text-success').addClass('fa-times-circle').addClass('text-danger')

}

function UnlockPopulationTypes(elem){

  $('.pop-total-nums').removeAttr('readonly')
  $('#populationbtn').text('Add').removeClass('btn-danger').addClass('btn-primary')
  $('.removePopulationRow').removeClass('disabled')
  $('#populationselect').removeAttr('disabled')

}

function LockPopulationTypes(elem){

  $('.pop-total-nums').attr('readonly','true')
  $('#populationbtn').text('Unlock population types').removeClass('btn-primary').addClass('btn-danger')
  $('.removePopulationRow').addClass('disabled')
  $('#populationselect').attr('disabled','disabled')

}

function ResourcesToOverview(){

}

function sanitizeString(str){
    str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
    return str.trim();
}

function drawResSummay(){

  let flag = false

  let html = ''

  $.each( window.dataSummary, function( ds_key, ds_value ) {

    if (ds_value != undefined) {

      if (ds_value['type'] == 'res') {

        if (ds_value['kind'] == 'main') {

          html += '<ul class="sum-ul">'

          flag = true

          html += '<li>'+ds_value['name']+'</li>'

          html += '<ul class="sum-ul">'

          html += '<li>Name: '+ds_value['nameforshow']+'</li>'

          //----

          ap_string = '<ul class="sum-ul">'

          $.each( ds_value['properties']['ap'], function( ds_keyap, ds_valueap ) {

            ap_string += '<li>'+ds_valueap+'</li>'

          });

          ap_string += '</ul>'

          html += '<li>Allowed Population: '+ap_string+'</li>'

          //----

          let ip_string = '<ul class="sum-ul">'

          $.each( ds_value['properties']['ip'], function( ds_keyip, ds_valueip ) {

            ip_string += '<li>'+ds_valueip['name']+': '+ds_valueip['value']+'</li>'

          });

          ip_string += '</ul>'

          html += '<li>Initial Population: '+ip_string+'</li>'

          //----

          html += '<li>Maximum Length of Stay: '+ds_value['properties']['mlos']+'</li>'

          let cap_html = ''

          if (ds_value['properties']['cap'] == -1) {

            cap_html = 'infinite'

          } else {

            cap_html = ds_value['properties']['cap']

          }

          html += '<li>Capacity: '+cap_html+'</li>'

          if (ds_value['name'] == 'Housing First') {

            html += '<li>Monthly Quota: '+ds_value['properties']['mq']+'</li>'
            
          }          

          html += '</ul>'

          html += '</ul>'

        } else if (ds_value['kind'] == 'parent') {

          html += '<ul class="sum-ul">'

          let num_children = 0

          $.each( window.dataSummary, function( ds_key_child, ds_value_child ) {

            if (ds_value_child != undefined) {

              if (ds_value['id'] == ds_value_child['parent_id']) {

                num_children+=1

              }

            }

          });

          flag = true

          let sub_text = 'sub-resource'
          if (num_children>1) {
            sub_text = 'sub-resources'
          }

          html += '<li>'+ds_value['name']+' ('+num_children+' '+sub_text+')</li>'

          var subResNo = 0

          $.each( window.dataSummary, function( ds_key_child2, ds_value_child2 ) {

            if (ds_value_child2 != undefined) {

              if (ds_value['id'] == ds_value_child2['parent_id']) {

                subResNo+=1

                html += '<ul class="sum-ul child-ul">'

                html += '<li>Name: '+ds_value_child2['nameforshow']+' (sub-resource '+subResNo+')</li>'

                //----

                ap_string = '<ul class="sum-ul">'

                $.each( ds_value_child2['properties']['ap'], function( ds_keyap, ds_valueap ) {

                  ap_string += '<li>'+ds_valueap+'</li>'

                });

                ap_string += '</ul>'

                html += '<li>Allowed Population: '+ap_string+'</li>'

                //----

                let ip_string = '<ul class="sum-ul">'

                $.each( ds_value_child2['properties']['ip'], function( ds_keyip, ds_valueip ) {

                  ip_string += '<li>'+ds_valueip['name']+': '+ds_valueip['value']+'</li>'

                });

                ip_string += '</ul>'

                html += '<li>Initial Population: '+ip_string+'</li>'

                //----

                html += '<li>Maximum Length of Stay: '+ds_value_child2['properties']['mlos']+'</li>'

                let cap_html = ''

                if (ds_value_child2['properties']['cap'] == -1) {

                  cap_html = 'infinite'

                } else {

                  cap_html = ds_value_child2['properties']['cap']

                }

                html += '<li>Capacity: '+cap_html+'</li>'

                if (ds_value['name'] == 'Housing First') {

                  html += '<li>Monthly Quota: '+ds_value_child2['properties']['mq']+'</li>'
                  
                }

                html += '</ul>'

              }

            }

          });

          html += '</ul>'

        }

      }

    }

  });

  $('#res-summary').html(html)

}

function drawStateSummay(){

  let flag = false

  let html = ''

  $.each( window.dataSummary, function( ds_key, ds_value ) {

    if (ds_value != undefined) {

        if (ds_value['type'] == 'state') {

          if (ds_value['kind'] == 'main') {

            html += '<ul class="sum-ul">'

            flag = true

            html += '<li>'+ds_value['name']+'</li>'

            html += '<ul class="sum-ul">'

            html += '<li>Name: '+ds_value['nameforshow']+'</li>'

            //----

            ap_string = '<ul class="sum-ul">'

            $.each( ds_value['properties']['ap'], function( ds_keyap, ds_valueap ) {

              ap_string += '<li>'+ds_valueap+'</li>'

            });

            ap_string += '</ul>'

            html += '<li>Allowed Population: '+ap_string+'</li>'

            //----

            let ip_string = '<ul class="sum-ul">'

            $.each( ds_value['properties']['ip'], function( ds_keyip, ds_valueip ) {

              ip_string += '<li>'+ds_valueip['name']+': '+ds_valueip['value']+'</li>'

            });

            ip_string += '</ul>'

            html += '<li>Initial Population: '+ip_string+'</li>'

            //----

            html += '</ul>'

            html += '</ul>'

        }

      }

    }

  });

  $('#state-summary').html(html)

}

function ToggleVideoSlider(){

  let or_val = parseInt($('#videosliderwatches').val())

  if ($('.my-sidebar').hasClass('sidebar-close')) {

    let new_val = or_val + 1
    $('#videosliderwatches').val(new_val)

    $('.my-sidebar').removeClass('sidebar-close').addClass('sidebar-open')

  } else {

    $('.my-sidebar').removeClass('sidebar-open').addClass('sidebar-close')

  }

}

function difference(a, b) { 
  return Math.abs(a - b); 
}

function insertPolicyToDOM(policyID){

  let html = ''

  $.each( window.dataSummary, function( ds_key, ds_value ) {

      if (ds_value != undefined) {

        if (ds_value['type'] == 'policy') {

          if (ds_value['id']==policyID) {

            html += '<div class="html-policy policy-'+policyID+'">'

            $.each( ds_value['data']['policy-data'], function( p_key, p_value ) {

              if (p_value['kind']=='main') {

                html += '<input type="hidden" name="policies['+policyID+']['+p_value['rowID']+'][policy-mlos]" value="'+p_value['policy-mlos']+'">'
                html += '<input type="hidden" name="policies['+policyID+']['+p_value['rowID']+'][mlos-mq]" value="'+p_value['mlos-mq']+'">'
                html += '<input type="hidden" name="policies['+policyID+']['+p_value['rowID']+'][policy-cap]" value="'+p_value['policy-cap']+'">'
                html += '<input type="hidden" name="policies['+policyID+']['+p_value['rowID']+'][mq-cap]" value="'+p_value['mq-cap']+'">'

              }

            })

            html += '</div>'

          }

        }

      }

    })

  $('#policieshtmls').append(html)

}