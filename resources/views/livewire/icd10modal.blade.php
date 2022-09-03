<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade wire:ignore.self" data-bs-backdrop="static" data-bs-keyboard="false" id="icd10modal" tabindex="-1" role="dialog" aria-labelledby="icd10modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createVisitModal">Modal title</h5>
            <button type="button" class="btn-close" id="closeICD"  aria-label="Close">
              {{-- <span aria-hidden="true">&times;</span> --}}
            </button>
        </div>
        <div class="modal-body">
          <livewire:icd10/>
        </div>
      </div>
    </div>
  </div>