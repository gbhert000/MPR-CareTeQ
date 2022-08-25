

<!-- Modal -->
<div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close"  aria-label="Close" id="closeReset" onclick="resetWebcam()"></button>
          {{-- <span aria-hidden="true">&times;</span> --}}
        </button>
      </div>
     
        {{-- @csrf --}}
      <div class="modal-body">
        <div class="row">
           <div class="col-md-6">
          <div id="my_camera"></div>
          <br/>
          <input type=button value="Take Snapshot" onClick="take_snapshot()">
          <input type="hidden" name="image" class="image-tag" id="imageID">
      </div>
      <div class="col-md-6">
          <div id="results">Your captured image will appear here...</div>
      </div>
        </div>
       
      <div class="col-md-12 text-center">
          <br/>
          <button class="btn btn-primary" id="saveImage">Submit</button>
      </div>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" id="closeAddImageModal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
      
    </div>
  </div>
</div>
