@extends('dashboard')
<script src="../../../js/jquery-3.6.0.min.js"></script>
@section('content')
<div class="card">
    <div class="card-body overflow-hidden p-lg-6" style="overflow-x: auto !important;overflow-y: auto !important;">
        <div class="row align-items-center">
            <h3 class="text" style="padding-bottom:20px;color:#00A651;">Tetapan Dashboard</h3>
            <div class="card-body bg-light">
                <div class="position-relative rounded-1 border bg-white dark__bg-1100 p-3">
                  <div class="position-absolute end-0 top-0 mt-2 me-3 z-index-1">
                    <button class="btn btn-link btn-sm p-0" type="button"><span class="fas fa-times-circle text-danger" data-fa-transform="shrink-1"></span></button>
                  </div>
                  <div class="row gx-2">
                    {{-- <div class="col-sm-6 mb-3">
                      <label class="form-label" for="field-name">Name</label>
                      <input class="form-control form-control-sm" id="field-name" type="text" placeholder="Name (e.g. T-shirt)" />
                    </div>
                    <div class="col-sm-6 mb-3">
                      <label class="form-label" for="field-type">Type</label>
                      <select class="form-select form-select-sm" id="field-type">
                        <option>Select a type</option>
                        <option>Text</option>
                        <option>Checkboxes</option>
                        <option>Radio Buttons</option>
                        <option>Textarea</option>
                        <option>Date</option>
                        <option>Dropdowns</option>
                        <option>File</option>
                      </select>
                    </div> --}}
                    <div class="col-12">
                      <label class="form-label" for="field-options">Field Options</label>
                      <textarea class="form-control form-control-sm" id="field-options" rows="3"></textarea>
                      <div class="form-text fs--1 text-warning">* Separate your options with comma</div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-falcon-default btn-sm mt-2" type="submit"><span class="fas fa-plus fs--2 me-1" data-fa-transform="up-1"></span>Add Item</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection