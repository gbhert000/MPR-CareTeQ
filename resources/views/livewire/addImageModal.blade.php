

<!-- Modal -->
<div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image Capture</h5>
        {{-- <button type="button" class="btn-close"  aria-label="Close" id="closeReset" onclick="resetWebcam()"></button> --}}
        <button type="button" class="btn-close" id="closeAll5"  aria-label="Close">
          {{-- <span aria-hidden="true">&times;</span> --}}
        </button>
      </div>
     
        {{-- @csrf --}}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
              <div id="my_camera"></div>
                <br/>
              
              <input type="hidden" name="image" class="image-tag" id="imageID">
            </div>

            <div class="col-md-6">
              <div id="results">Your captured image will appear here...</div>
            </div>
            
        </div>
       
        <div class="col-md-12 text-center">
            <input type=button value="Take Snapshot" class="btn btn-success" onClick="take_snapshot()">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="saveImage" disabled>Submit</button>
      </div>
    </div>
  </div>
</div>
