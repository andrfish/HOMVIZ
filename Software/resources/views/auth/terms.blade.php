@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="https://www.youtube.com/iframe_api"></script>
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
                  Consent Form for HOMVIZ software usability Survey
                </div>

              </div>

              <div class="card-body">

                <form action="/terms" method="post">

                  <p>Please read the following documents and check the box if you undrestand and agree </p>

                  <p><a href="/assets/Infomation Letter.pdf?1" download>Infomation Letter.pdf</a></p>

                  <p><a href="/assets/Consent Form.pdf?1" download>Consent Form.pdf</a></p>

                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                    <label for="agreeTerms">
                     I read and agree to the terms mentioned in the Information Letter and the Consent Form above
                    </label>
                  </div>

                  <button type="submit" class="btn btn-primary" style="float: right">Continue</button>

                </form>

              </div>
                    
            </div><!-- /.card -->

          </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

@stop