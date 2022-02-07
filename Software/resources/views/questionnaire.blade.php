@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="https://www.youtube.com/iframe_api"></script>
<script src="/assets/js/questionnaire.js?11"></script>
@stop

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content">

    <div class="container-fluid">

        <div class="row">

          <div class="col-lg-12">

            <div class="card card-primary card-outline">

              <div class="card-header">

                <div class="card-title">
                  Questionnaire
                </div>

              </div>

              <div class="card-body">

                <button class="btn btn-primary bt-lg" id="start">Start</button>

                <form style="display: none;" action="/questionnaire" method="post">

                  <input type="hidden" id="stopwatch" value="0" name="stopwatch">



                  <table class="table table-bordered table-striped">
                    <thead>                  
                      <tr>
                        <th style="width: 3%">#</th>
                        <th style="width: 50%"><strong>System Usability Scale Questionnaire. Please check the boxes that reflect your immediate response to each statement.</strong></th>
                        <th>Strongly Disagree</th>
                        <th>Disagree</th>
                        <th>Neutral</th>
                        <th>Agree</th>
                        <th>Strongly Agree</th>
                      </tr>
                    </thead>

                    <tbody>

                      <tr>
                        <td>1</td>
                        <td>I think that I would like to use this web application frequently.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus11" name="questionnaire[sus][1]" required>
                            <label for="customRadiosus11" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus12" name="questionnaire[sus][1]" required>
                            <label for="customRadiosus12" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus13" name="questionnaire[sus][1]" required>
                            <label for="customRadiosus13" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus14" name="questionnaire[sus][1]" required>
                            <label for="customRadiosus14" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus15" name="questionnaire[sus][1]" required>
                            <label for="customRadiosus15" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>2</td>
                        <td>I found the web application unnecessarily complex.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus21" name="questionnaire[sus][2]" required>
                            <label for="customRadiosus21" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus22" name="questionnaire[sus][2]" required>
                            <label for="customRadiosus22" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus23" name="questionnaire[sus][2]" required>
                            <label for="customRadiosus23" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus24" name="questionnaire[sus][2]" required>
                            <label for="customRadiosus24" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus25" name="questionnaire[sus][2]" required>
                            <label for="customRadiosus25" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>3</td>
                        <td>I thought the web application was easy to use.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus31" name="questionnaire[sus][3]" required>
                            <label for="customRadiosus31" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus32" name="questionnaire[sus][3]" required>
                            <label for="customRadiosus32" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus33" name="questionnaire[sus][3]" required>
                            <label for="customRadiosus33" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus34" name="questionnaire[sus][3]" required>
                            <label for="customRadiosus34" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus35" name="questionnaire[sus][3]" required>
                            <label for="customRadiosus35" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>4</td>
                        <td>I think that I would need the support of a technical person to be able to use this web application.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus41" name="questionnaire[sus][4]" required>
                            <label for="customRadiosus41" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus42" name="questionnaire[sus][4]" required>
                            <label for="customRadiosus42" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus43" name="questionnaire[sus][4]" required>
                            <label for="customRadiosus43" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus44" name="questionnaire[sus][4]" required>
                            <label for="customRadiosus44" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus45" name="questionnaire[sus][4]" required>
                            <label for="customRadiosus45" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>5</td>
                        <td>I found the various functions in this web application were well integrated.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus51" name="questionnaire[sus][5]" required>
                            <label for="customRadiosus51" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus52" name="questionnaire[sus][5]" required>
                            <label for="customRadiosus52" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus53" name="questionnaire[sus][5]" required>
                            <label for="customRadiosus53" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus54" name="questionnaire[sus][5]" required>
                            <label for="customRadiosus54" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus55" name="questionnaire[sus][5]" required>
                            <label for="customRadiosus55" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>6</td>
                        <td>I thought there was too much inconsistency in this web application.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus61" name="questionnaire[sus][6]" required>
                            <label for="customRadiosus61" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus62" name="questionnaire[sus][6]" required>
                            <label for="customRadiosus62" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus63" name="questionnaire[sus][6]" required>
                            <label for="customRadiosus63" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus64" name="questionnaire[sus][6]" required>
                            <label for="customRadiosus64" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus65" name="questionnaire[sus][6]" required>
                            <label for="customRadiosus65" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>7</td>
                        <td>I would imagine that most people would learn to use this web application very quickly.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus71" name="questionnaire[sus][7]" required>
                            <label for="customRadiosus71" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus72" name="questionnaire[sus][7]" required>
                            <label for="customRadiosus72" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus73" name="questionnaire[sus][7]" required>
                            <label for="customRadiosus73" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus74" name="questionnaire[sus][7]" required>
                            <label for="customRadiosus74" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus75" name="questionnaire[sus][7]" required>
                            <label for="customRadiosus75" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>8</td>
                        <td>I found the web application very cumbersome / awkward to use.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus81" name="questionnaire[sus][8]" required>
                            <label for="customRadiosus81" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus82" name="questionnaire[sus][8]" required>
                            <label for="customRadiosus82" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus83" name="questionnaire[sus][8]" required>
                            <label for="customRadiosus83" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus84" name="questionnaire[sus][8]" required>
                            <label for="customRadiosus84" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus85" name="questionnaire[sus][8]" required>
                            <label for="customRadiosus85" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>9</td>
                        <td>I felt very confident using the web application.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus91" name="questionnaire[sus][9]" required>
                            <label for="customRadiosus91" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus92" name="questionnaire[sus][9]" required>
                            <label for="customRadiosus92" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus93" name="questionnaire[sus][9]" required>
                            <label for="customRadiosus93" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus94" name="questionnaire[sus][9]" required>
                            <label for="customRadiosus94" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus95" name="questionnaire[sus][9]" required>
                            <label for="customRadiosus95" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>10</td>
                        <td>I needed to learn a lot of things before I could get going with this system.</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiosus101" name="questionnaire[sus][10]" required>
                            <label for="customRadiosus101" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiosus102" name="questionnaire[sus][10]" required>
                            <label for="customRadiosus102" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiosus103" name="questionnaire[sus][10]" required>
                            <label for="customRadiosus103" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiosus104" name="questionnaire[sus][10]" required>
                            <label for="customRadiosus104" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiosus105" name="questionnaire[sus][10]" required>
                            <label for="customRadiosus105" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>11</td>
                        <td>What are some aspects of the HOMVIZ platform which you found to be positive?</td>
                        <td colspan="5">
                          <input class="form-control" type="text" name="questionnaire[sus][11]" required>
                        </td>
                      </tr>

                      <tr>
                        <td>12</td>
                        <td>What are some aspects of the HOMVIZ platform which you found to be negative?</td>
                        <td colspan="5">
                          <input class="form-control" type="text" name="questionnaire[sus][12]" required>
                        </td>
                      </tr>

                    </tbody>

                  </table>

                


                  <table class="table table-bordered table-striped">
                    <thead>                  
                      <tr>
                        <th style="width: 3%">#</th>
                        <th style="width: 50%;"><strong>How often do you use the following programs?</strong></th>
                        <th>Never</th>
                        <th>Rarely</th>
                        <th>Some times</th>
                        <th>Often</th>
                        <th>Very often</th>
                      </tr>
                    </thead>

                    <tbody>

                      <tr>
                        <td>1</td>
                        <td>Word processing (e.g., Word)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio11" name="questionnaire[cuq][1][1]" required>
                            <label for="customRadio11" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio12" name="questionnaire[cuq][1][1]" required>
                            <label for="customRadio12" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio13" name="questionnaire[cuq][1][1]" required>
                            <label for="customRadio13" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio14" name="questionnaire[cuq][1][1]" required>
                            <label for="customRadio14" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio15" name="questionnaire[cuq][1][1]" required>
                            <label for="customRadio15" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>2</td>
                        <td>Spreadsheet (e.g., Excel)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio21" name="questionnaire[cuq][1][2]" required>
                            <label for="customRadio21" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio22" name="questionnaire[cuq][1][2]" required>
                            <label for="customRadio22" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio23" name="questionnaire[cuq][1][2]" required>
                            <label for="customRadio23" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio24" name="questionnaire[cuq][1][2]" required>
                            <label for="customRadio24" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio25" name="questionnaire[cuq][1][2]" required>
                            <label for="customRadio25" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>3</td>
                        <td>Presentation program (e.g., Powerpoint)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio31" name="questionnaire[cuq][1][3]" required>
                            <label for="customRadio31" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio32" name="questionnaire[cuq][1][3]" required>
                            <label for="customRadio32" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio33" name="questionnaire[cuq][1][3]" required>
                            <label for="customRadio33" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio34" name="questionnaire[cuq][1][3]" required>
                            <label for="customRadio34" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio35" name="questionnaire[cuq][1][3]" required>
                            <label for="customRadio35" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>4</td>
                        <td>Programming language (e.g., Java)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio41" name="questionnaire[cuq][1][4]" required>
                            <label for="customRadio41" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio42" name="questionnaire[cuq][1][4]" required>
                            <label for="customRadio42" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio43" name="questionnaire[cuq][1][4]" required>
                            <label for="customRadio43" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio44" name="questionnaire[cuq][1][4]" required>
                            <label for="customRadio44" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio45" name="questionnaire[cuq][1][4]" required>
                            <label for="customRadio45" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>5</td>
                        <td>Graphics software (e.g., CorelDraw)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio51" name="questionnaire[cuq][1][5]" required>
                            <label for="customRadio51" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio52" name="questionnaire[cuq][1][5]" required>
                            <label for="customRadio52" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio53" name="questionnaire[cuq][1][5]" required>
                            <label for="customRadio53" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio54" name="questionnaire[cuq][1][5]" required>
                            <label for="customRadio54" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio55" name="questionnaire[cuq][1][5]" required>
                            <label for="customRadio55" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>6</td>
                        <td>Sound or video editing software</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio61" name="questionnaire[cuq][1][6]" required>
                            <label for="customRadio61" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio62" name="questionnaire[cuq][1][6]" required>
                            <label for="customRadio62" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio63" name="questionnaire[cuq][1][6]" required>
                            <label for="customRadio63" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio64" name="questionnaire[cuq][1][6]" required>
                            <label for="customRadio64" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio65" name="questionnaire[cuq][1][6]" required>
                            <label for="customRadio65" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>7</td>
                        <td>e-mail client (e.g., Outlook)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio71" name="questionnaire[cuq][1][7]" required>
                            <label for="customRadio71" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio72" name="questionnaire[cuq][1][7]" required>
                            <label for="customRadio72" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio73" name="questionnaire[cuq][1][7]" required>
                            <label for="customRadio73" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio74" name="questionnaire[cuq][1][7]" required>
                            <label for="customRadio74" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio75" name="questionnaire[cuq][1][7]" required>
                            <label for="customRadio75" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>8</td>
                        <td>Chat program (e.g., IRC, Skype)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio81" name="questionnaire[cuq][1][8]" required>
                            <label for="customRadio81" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio82" name="questionnaire[cuq][1][8]" required>
                            <label for="customRadio82" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio83" name="questionnaire[cuq][1][8]" required>
                            <label for="customRadio83" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio84" name="questionnaire[cuq][1][8]" required>
                            <label for="customRadio84" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio85" name="questionnaire[cuq][1][8]" required>
                            <label for="customRadio85" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>9</td>
                        <td>Web browser (e.g., Firefox, IE)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio91" name="questionnaire[cuq][1][9]" required>
                            <label for="customRadio91" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio92" name="questionnaire[cuq][1][9]" required>
                            <label for="customRadio92" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio93" name="questionnaire[cuq][1][9]" required>
                            <label for="customRadio93" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio94" name="questionnaire[cuq][1][9]" required>
                            <label for="customRadio94" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio95" name="questionnaire[cuq][1][9]" required>
                            <label for="customRadio95" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>10</td>
                        <td>Games (e.g., The Sims)</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadio101" name="questionnaire[cuq][1][10]" required>
                            <label for="customRadio101" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadio102" name="questionnaire[cuq][1][10]" required>
                            <label for="customRadio102" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadio103" name="questionnaire[cuq][1][10]" required>
                            <label for="customRadio103" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadio104" name="questionnaire[cuq][1][10]" required>
                            <label for="customRadio104" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadio105" name="questionnaire[cuq][1][10]" required>
                            <label for="customRadio105" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>

                    </tbody>

                  </table>




                  <table class="table table-bordered table-striped">
                    <thead>                  
                      <tr>
                        <th style="width: 3%">#</th>
                        <th style="width: 50%"><strong>How often do you perform the following computer activities?</strong></th>
                        <th>Never</th>
                        <th>Rarely</th>
                        <th>Some times</th>
                        <th>Often</th>
                        <th>Very often</th>
                      </tr>
                    </thead>

                    <tbody>

                      <tr>
                        <td>1</td>
                        <td>Creating a presentation</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox11" name="questionnaire[cuq][2][1]" required>
                            <label for="customRadiox11" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox12" name="questionnaire[cuq][2][1]" required>
                            <label for="customRadiox12" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox13" name="questionnaire[cuq][2][1]" required>
                            <label for="customRadiox13" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox14" name="questionnaire[cuq][2][1]" required>
                            <label for="customRadiox14" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox15" name="questionnaire[cuq][2][1]" required>
                            <label for="customRadiox15" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>2</td>
                        <td>Programming</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox21" name="questionnaire[cuq][2][2]" required>
                            <label for="customRadiox21" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox22" name="questionnaire[cuq][2][2]" required>
                            <label for="customRadiox22" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox23" name="questionnaire[cuq][2][2]" required>
                            <label for="customRadiox23" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox24" name="questionnaire[cuq][2][2]" required>
                            <label for="customRadiox24" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox25" name="questionnaire[cuq][2][2]" required>
                            <label for="customRadiox25" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>3</td>
                        <td>Sound editing</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox31" name="questionnaire[cuq][2][3]" required>
                            <label for="customRadiox31" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox32" name="questionnaire[cuq][2][3]" required>
                            <label for="customRadiox32" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox33" name="questionnaire[cuq][2][3]" required>
                            <label for="customRadiox33" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox34" name="questionnaire[cuq][2][3]" required>
                            <label for="customRadiox34" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox35" name="questionnaire[cuq][2][3]" required>
                            <label for="customRadiox35" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>4</td>
                        <td>Writing e-mails</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox41" name="questionnaire[cuq][2][4]" required>
                            <label for="customRadiox41" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox42" name="questionnaire[cuq][2][4]" required>
                            <label for="customRadiox42" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox43" name="questionnaire[cuq][2][4]" required>
                            <label for="customRadiox43" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox44" name="questionnaire[cuq][2][4]" required>
                            <label for="customRadiox44" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox45" name="questionnaire[cuq][2][4]" required>
                            <label for="customRadiox45" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>5</td>
                        <td>Chatting</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox51" name="questionnaire[cuq][2][5]" required>
                            <label for="customRadiox51" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox52" name="questionnaire[cuq][2][5]" required>
                            <label for="customRadiox52" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox53" name="questionnaire[cuq][2][5]" required>
                            <label for="customRadiox53" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox54" name="questionnaire[cuq][2][5]" required>
                            <label for="customRadiox54" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox55" name="questionnaire[cuq][2][5]" required>
                            <label for="customRadiox55" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>6</td>
                        <td>Surfing the web</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox61" name="questionnaire[cuq][2][6]" required>
                            <label for="customRadiox61" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox62" name="questionnaire[cuq][2][6]" required>
                            <label for="customRadiox62" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox63" name="questionnaire[cuq][2][6]" required>
                            <label for="customRadiox63" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox64" name="questionnaire[cuq][2][6]" required>
                            <label for="customRadiox64" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox65" name="questionnaire[cuq][2][6]" required>
                            <label for="customRadiox65" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>7</td>
                        <td>Playing alone</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox71" name="questionnaire[cuq][2][7]" required>
                            <label for="customRadiox71" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox72" name="questionnaire[cuq][2][7]" required>
                            <label for="customRadiox72" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox73" name="questionnaire[cuq][2][7]" required>
                            <label for="customRadiox73" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox74" name="questionnaire[cuq][2][7]" required>
                            <label for="customRadiox74" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox75" name="questionnaire[cuq][2][7]" required>
                            <label for="customRadiox75" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>8</td>
                        <td>Playing online</td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-1" id="customRadiox81" name="questionnaire[cuq][2][8]" required>
                            <label for="customRadiox81" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-2" id="customRadiox82" name="questionnaire[cuq][2][8]" required>
                            <label for="customRadiox82" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-3" id="customRadiox83" name="questionnaire[cuq][2][8]" required>
                            <label for="customRadiox83" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-4" id="customRadiox84" name="questionnaire[cuq][2][8]" required>
                            <label for="customRadiox84" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" value="option-5" id="customRadiox85" name="questionnaire[cuq][2][8]" required>
                            <label for="customRadiox85" class="custom-control-label"></label>
                          </div>
                        </td>
                      </tr>

                    </tbody>

                  </table>




                  <button type="submit" class="btn btn-primary" style="float: right">Submit</button>

                </form>

              </div>
                    
            </div><!-- /.card -->

          </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

@stop