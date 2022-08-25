<div>
    <video class="rounded-lg shadow-lg" playsinline autoplay></video>
    <canvas style="display:none"></canvas>
    <button class="px-4 py-2 mt-4 text-white bg-green-500 rounded-lg" >Save Photo</button>

    <div class="grid grid-cols-12 gap-2 mt-4 sm:grid-cols-3">
        @foreach ($photos as $photo)
            <div class="relative flex items-center px-5 py-5 space-x-3 bg-white border border-gray-300 rounded-lg shadow-sm hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <div class="flex-shrink-0">
                    <img class="h-32 rounded-lg" src="{{ $photo->path }}" alt="">
                </div>
            </div>
            
        @endforeach
    </div>
</div>
<script>
const video = document.querySelector('video');
const canvas = document.querySelector('canvas');

const button = document.querySelector('button');
button.onclick = function() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    Livewire.emit('storePhoto', canvas.toDataURL());
};

const constraints = {
    audio: false,
    video: true
};

function handleSuccess(stream) {
    window.stream = stream; // make stream available to browser console
    video.srcObject = stream;
}

function handleError(error) {
    console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
}

navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
</script>