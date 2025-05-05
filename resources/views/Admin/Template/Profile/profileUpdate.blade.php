@extends('Admin.Template.Profile.index')

@section('profile-setting')

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
        <p class="card-description">
          Personal info
        </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nickname</label>
              <div class="col-sm-9">
                <input type="text" name="nickname" class="form-control" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">E-Mail</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Phone Number</label>
              <div class="col-sm-9">
                <input type="number" name="phone" class="form-control" placeholder="09*********"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Address </label>
                <div class="col-sm-9">
                    <textarea name="address" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col">
                <button>cancel</button>
                <button>update</button>
            </div>
        </div>

</form>

@endsection
