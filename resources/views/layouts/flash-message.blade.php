
   <div class="d-flex justify-content-center">
      <div class="col-sm-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert"> ×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if($errors = Session::get('error'))
            <div class="alert alert-danger " role="alert">
                <button type="button" class="close" data-dismiss="alert"> ×</button>
                <strong>{{ $errors }}</strong>
            </div>
        @endif
      </div>
   </div>
