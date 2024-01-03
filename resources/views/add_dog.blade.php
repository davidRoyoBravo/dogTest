@extends('layouts.app')

@section('content')
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
 <div class="container">
     <div class="row">
         <div class="col">
             <form id="form-add-dog">
                 <div class="mb-3 ">
                     <label for="dogName" class="form-label">Dog Name</label>
                     <input type="text" name="name" class="form-control" id="dogName" aria-describedby="dogNameHelp">
                     <div id="dogNameHelp" class="form-text">You can add your last name to your dog name.</div>
                     <div class="invalid-feedback"></div>
                 </div>
                 <div class="mb-3 form-check">
                     <input type="checkbox" class="form-check-input know-birthday" id="iKnowMyDogBirthday">
                     <label class="form-check-label" for="iKnowMyDogBirthday">I know my dog Birthday</label>
                 </div>
                 <div class="mb-3 dogAge">
                     <label for="dogAge" class="form-label">Age</label>
                     <input type="number" name="age" class="form-control" id="dogAge">
                     <div class="invalid-feedback"></div>
                 </div>
                 <div class="mb-3 dogBornDate d-none">
                     <label for="dogBornDate" class="form-label">Born Date</label>
                     <input type="datetime-local" name="born_date" class="form-control" id="dogBornDate">
                     <div class="invalid-feedback"></div>
                 </div>
                 <button type="submit" class="btn btn-primary btn-loader">
                     <div class="title">Submit</div>
                     <div class="loader spinner-border text-light d-none" role="status">
                         <span class="visually-hidden">Loading...</span>
                     </div>
                 </button>
             </form>
         </div>
     </div>
 </div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endpush
@endsection
