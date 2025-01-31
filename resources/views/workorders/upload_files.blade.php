@extends('layouts.mainlayout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.2/plupload.full.min.js"></script>

<div class="container">
    <div class="card col-10 offset-1">
        <h5 class="card-header">Upload Files for WorkOrder "{{$order->jobname}}"</h5>
        <div class="card-body">
            @include('layouts.messages')

            <div id="upload-progress" class="mt-3">
                <div class="progress">
                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
            <div id="file-list" class="mt-3">
                <ul class="list-group"></ul>
            </div>
            <div id="file-uploader" class="mt-3">
                <button id="browse" class="btn btn-primary">Browse Files</button>
                <button id="start-upload" class="btn btn-success">Start Upload</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const browseButton = document.getElementById('browse');
        const startButton = document.getElementById('start-upload');
        const progressBar = document.getElementById('progress-bar');
        const fileList = document.querySelector('#file-list ul');

        let totalFiles = 0;
        let completedFiles = 0;

        const uploader = new plupload.Uploader({
            browse_button: 'browse',
            url: "{{ route('fileuploadem') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            chunk_size: '10mb',
            multipart_params: {
                order_id: '{{$order->id}}'
            },
            max_file_size: '4096mb',
            filters: {
                mime_types: [{
                    title: "Allowed files",
                    extensions: "jpg,png,pdf,docx,zip"
                }]
            },
            init: {
                PostInit: function() {
                    startButton.onclick = function() {
                        if (uploader.files.length === 0) {
                            alert("Please select files to upload.");
                            return;
                        }

                        // browseButton.disabled = true;
                        // startButton.disabled = true;
                        // display none the browse and state buttons
                        browseButton.classList.add('d-none');
                        startButton.classList.add('d-none');

                        document.querySelectorAll('.remove-file').forEach(function(button) {
                            button.classList.add('d-none');
                        });

                        totalFiles = uploader.files.length;
                        progressBar.style.width = '0%';
                        progressBar.classList.add('progress-bar-striped', 'progress-bar-animated');
                        uploader.start();
                    };
                },
                FilesAdded: function(up, files) {
                    files.forEach(file => {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.setAttribute('id', `file-${file.id}`);
                        listItem.innerHTML = `
                            ${file.name} (${plupload.formatSize(file.size)})
                            <span class="badge bg-secondary float-end"></span>
                            <button class="btn btn-sm btn-danger float-end me-2 remove-file" data-id="${file.id}">&times;</button>
                        `;
                        fileList.appendChild(listItem);

                        // Handle file removal
                        listItem.querySelector('.remove-file').addEventListener('click', function() {
                            uploader.removeFile(file);
                            listItem.remove();
                        });
                    });
                },
                FilesRemoved: function(up, files) {
                    files.forEach(file => {
                        const listItem = document.querySelector(`#file-${file.id}`);
                        if (listItem) {
                            listItem.remove();
                        }
                    });
                },
                UploadProgress: function(up, file) {
                    const listItem = document.querySelector(`#file-${file.id}`);
                    const badge = listItem.querySelector('.badge');
                    badge.className = 'badge bg-primary float-end'; // Change to blue while uploading
                    badge.textContent = `${file.percent}%`;

                    // Update progress bar
                    const totalPercent = Math.round((completedFiles / totalFiles) * 100);
                    progressBar.style.width = `${totalPercent}%`;
                    progressBar.setAttribute('aria-valuenow', totalPercent);
                },
                FileUploaded: function(up, file, info) {
                    completedFiles++;
                    const listItem = document.querySelector(`#file-${file.id}`);
                    const badge = listItem.querySelector('.badge');
                    badge.className = 'badge bg-success float-end'; // Change to green on completion
                    badge.textContent = 'Completed';

                    // Update progress bar after file upload
                    const totalPercent = Math.round((completedFiles / totalFiles) * 100);
                    progressBar.style.width = `${totalPercent}%`;
                    progressBar.setAttribute('aria-valuenow', totalPercent);
                },
                UploadComplete: function(up, files) {
                    // send ajax request to route uploads.createZip with workorderid
                    $.ajax({
                        url: "{{ route('uploads.createZip', $order->id) }}",
                        type: 'GET',
                        success: function(response) {
                            if (response.msg == 'success') {
                                progressBar.style.width = '100%';
                                progressBar.setAttribute('aria-valuenow', '100');
                                progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');
                                progressBar.classList.add('bg-success');
                                setTimeout(() => {
                                    window.location.href = "{{ route('workorders.index') }}";
                                }, 1000);
                            } else {
                                progressBar.style.width = '100%';
                                progressBar.setAttribute('aria-valuenow', '100');
                                progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');
                                progressBar.classList.add('bg-danger');
                                alert('Failed to create zip file');
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }

                        },
                        error: function(err) {
                            console.log(err);
                            // show failed
                            progressBar.style.width = '100%';
                            progressBar.setAttribute('aria-valuenow', '100');
                            progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');
                            progressBar.classList.add('bg-danger');
                            alert('Failed to create zip file');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });

                },
                Error: function(up, err) {
                    alert(`Error: ${err.message}`);
                    location.reload();
                }
            }
        });

        uploader.init();
    });
</script>

@endsection