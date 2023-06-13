@extends('backend.layouts.main')
@section('content')
<style>
.flexi-content{
  display: flex;
    flex-direction: row;
    font-size: 16px;
}
.flex-item-left,
.flex-item-right {
    padding: 10px;
    flex: 50%;
}
</style>
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-body">
            <h3>Edit Qualification</h3>
            <form action="{{route('qualification.update',$qualification->id)}}" method="post">
              @csrf
              @method('patch')
              <div class="flexi-content">
                <div class="flex-item-left">
                  <label for="qual_catg_desc">Course Type <span class="text-danger">*</span></label>
                  <input type="text" class="form-control timepicker" name="qual_catg_desc" value="{{old('name') ?? $qualification->qual_catg_desc}}">
                </div> 

                <div class="flex-item-right">
                  <label for="qual_desc">Course Name <span class="text-danger">*</span></label>
                  <input type="text" name="qual_desc" class="form-control" value="{{old('name') ?? $qualification->qual_desc}}">
                </div>
            
                <div class="flex-item-right">
                  <label for="pass_year">Passing Year <span class="text-danger">*</span></label>
                  <input type="text" class="form-control timepicker" name="pass_year" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('name') ?? $qualification->pass_year}}">     
                </div>  

                <div class="flex-item-right">
                  <label for="pass_perc">Passing Percentage <span class="text-danger">*</span></label>
                  <input type="text" class="form-control timepicker" name="pass_perc" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('name') ?? $qualification->pass_perc}}">     
                </div>

                <div class="flex-item-right">
                  <label for="pass_division">Passing Division <span class="text-danger">*</span></label>
                  <input type="text" class="form-control timepicker" name="pass_division" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('name') ?? $qualification->pass_division}}">     
                </div>

              </div>

              <div class="row ">

                <div class="col-md-12 mb-5">
                  <input type="submit" value="Submit" class="btn btn-sm btn-primary">
                </div> 

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection