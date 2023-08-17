@extends("frontend.layout.app")
@section("title", "Add Bio | ")

@section("styles")
    <style>
        .slider1 {
            padding: 0;
        }

        .form-control {
            border: 1px solid #b92e34;
        }

        .form-control:focus {
            box-shadow: none;
            border: 1px solid red;
            outline: 0 none;
        }

        .form-group i {
            font-size: 28px;
        }

        @media screen and (max-width: 600px) {
            .form {
                padding: 0px 80px 0px 80px !important;
                margin: 50px 0px 20px 0px !important;
            }

        }

        .carousel-item img {
            height: 700px;
            object-fit: cover;
        }

        input[type="file"] {
            display: block;
        }

        .image-select > input {
            display: none;
        }

        .image-select {
            border: 2px red dashed;
            border-radius: 5px;
            width: 100%;
            height: 115px;
        }

        textarea {
            height: 115px;
            font-size: 14px;
            padding: 7px;
        }

        .image-select img, video {
            width: 100%;
            height: 100%;
            cursor: pointer;
            border-radius: 5px;
            object-fit: cover;
        }

        /*Loading*/
        #progress {
            position: fixed;
            z-index: 2147483647;
            top: 0;
            left: 0px;
            width: 0%;
            height: 2px;
            background: red;
            -moz-border-radius: 1px;
            -webkit-border-radius: 1px;
            border-radius: 1px;
            -moz-transition: width 500ms ease-out, opacity 400ms linear;
            -ms-transition: width 500ms ease-out, opacity 400ms linear;
            -o-transition: width 500ms ease-out, opacity 400ms linear;
            -webkit-transition: width 500ms ease-out, opacity 400ms linear;
            transition: width 500ms ease-out, opacity 400ms linear;
        }

        #progress dd, #progress dt {
            position: absolute;
            top: 0;
            height: 2px;
            -moz-box-shadow: red 1px 0 6px 1px;
            -ms-box-shadow: red 1px 0 6px 1px;
            -webkit-box-shadow: red 1px 0 6px 1px;
            box-shadow: red 1px 0 6px 1px;
            -moz-border-radius: 100%;
            -webkit-border-radius: 100%;
            border-radius: 100%;
        }

        #progress dt {
            opacity: .6;
            width: 180px;
            right: -80px;
            clip: rect(-6px, 90px, 14px, -6px);
        }

        #progress dd {
            opacity: .6;
            width: 20px;
            right: 0;
            clip: rect(-6px, 22px, 14px, 10px);
        }
    </style>
@endsection

@section("section")
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-2"></div> -->
            <div class="col-lg-7 col-md-12 col-sm-12 slider1">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('frontend/img/signup1.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/img/signup2.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/img/signup3.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-5 col-md-12 col-sm-12 scrollContainer"
                 style="padding: 0px 150px 0px 150px; height: 700px;">
                <div class="logo me-auto mt-4 text-center"><a href="{{ route("home") }}">
                        <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}"/>
                    </a>
                </div>

                <div class="mt-5 mb-5 ">
                    <h4 class="fw-bolder">Bio / Your Photos & Video</h4>


                    <form action="{{ route("addBio") }}" method="post" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="bio">About Your Self</label>
                            <textarea onkeyup="countWords(99, 'bio', 'bioCount')"
                                      class="form-control mt-2 @error('bio') is-invalid @enderror" name="bio"
                                      id="bio">{{ $user->bio }}</textarea>
                            <span style="font-size: 12px; color: grey">Words Count: <span
                                    id="bioCount">100</span></span>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="">Select Photos</label>
                            <div id="photosTab">
                                @if($user->unOrderGalleries->count() != 0)
                                    @foreach($user->unOrderGalleries as $gallery)
                                        <div class="row mt-3" id="removeImg[{{ $gallery->id }}]">
                                            <input type="number" value="{{ $gallery->id }}"
                                                   name="uploadedPhotosID[{{ $gallery->id }}]"
                                                   hidden/>
                                            <div class="col-6">
                                                <label class="image-select" for="uploadedPhotos[{{ $gallery->id }}]">
                                                    <img width="145" height="145" class="img-fluid"
                                                         id="uploadedPhotosImg[{{ $gallery->id }}]"
                                                         src="{{ asset('storage/'.substr($gallery->image, 6)) }}"
                                                         alt="Image Not Found!">
                                                    <input type="file" class="form-control"
                                                           id="uploadedPhotos[{{ $gallery->id }}]"
                                                           name="uploadedPhotos[{{ $gallery->id }}]"
                                                           accept="image/*" onchange="getImage(event, 'uploadedPhotosImg[{{ $gallery->id }}]');"/>
                                                </label>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <textarea onkeydown="checkWordLen(this);"
                                                              {{--                                                              onkeyup="countWords(29, 'uploadedPhotosDescription[{{ $gallery->id }}]', 'uploadedImgCount[{{ $gallery->id }}]')"--}}
                                                              placeholder="Description" class="form-control"
                                                              maxlength="30"
                                                              name="uploadedPhotosDescription[{{ $gallery->id }}]"
                                                              id="uploadedPhotosDescription[{{ $gallery->id }}]">{{ $gallery->description }}</textarea>
                                                    <span style="font-size: 12px; color: grey">Max 30 Characters</span>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="d-grid">
                                                    <button type="button" onclick="deleteImage({{ $gallery->id }})" id="deleteImg{{ $gallery->id }}"
                                                            class="btn btn-block btn-custom" >Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row mt-3" id="remove_image[0]">
                                        <div class="col-6">
                                            <label class="image-select" for="photos[0]">
                                                <img width="145" height="145" class="img-fluid" id="photos_img[0]"
                                                     src="{{ asset('frontend/img/vectors/select-image.png') }}"
                                                     alt="Image Not Found!">
                                                <input type="file" class="form-control" id="photos[0]" name="photos[0]"
                                                       accept="image/*"
                                                       onchange="getImage(event, 'photos_img[0]');" {{ $user->galleries->count() == 0 ? "required" : null }}/>
                                            </label>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                            <textarea onkeydown="checkWordLen(this);"
                                                      {{--                                                      onkeyup="countWords(29, 'photos_description[0]', 'imgCount[0]')"--}}
                                                      maxlength="30"
                                                      placeholder="Description" rows="5" class="form-control"
                                                      name="photos_description[0]"
                                                      id="photos_description[0]"></textarea>
                                                <span style="font-size: 12px; color: grey">Max 30 Characters</span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="d-grid">
                                                <button type="button" onclick="removePhotoTab(0)"
                                                        class="btn btn-block btn-custom">Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mt-3" id="remove_image[0]">
                                        <div class="col-6">
                                            <label class="image-select" for="photos[0]">
                                                <img width="145" height="145" class="img-fluid" id="photos_img[0]"
                                                     src="{{ asset('frontend/img/vectors/select-image.png') }}"
                                                     alt="Image Not Found!">
                                                <input type="file" class="form-control" id="photos[0]" name="photos[0]"
                                                       accept="image/*"
                                                       onchange="getImage(event, 'photos_img[0]');" {{ $user->galleries->count() == 0 ? "required" : null }}/>
                                            </label>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                            <textarea onkeydown="checkWordLen(this);"
                                                      {{--                                                      onkeyup="countWords(29, 'photos_description[0]', 'imgCount[0]')"--}}
                                                      placeholder="Description" rows="5" class="form-control"
                                                      name="photos_description[0]" maxlength="30"
                                                      id="photos_description[0]"></textarea>
                                                <span
                                                    style="font-size: 12px; color: grey">Max 30 Characters</span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="button" onclick="addPhotosTab()" id="addPhoto"
                                    class="btn btn-block btn-custom mt-3">Add New
                                Photo
                            </button>
                        </div>

                        <div class="form-group mt-3">
                            <label for="videos">Select Videos</label>

                            <div id="videosTab">
                                @if($user->unOrderVideos->count() != 0)
                                    @foreach($user->unOrderVideos as $video)
                                        <div class="row mt-3" id="removeVideo[{{ $video->id }}]">
                                            <input type="number" value="{{ $video->id }}"
                                                   name="uploadedVideosID[{{ $video->id }}]"
                                                   hidden/>
                                            <div class="col-6">
                                                <label class="image-select" for="uploadedVideo[{{ $video->id }}]">
                                                    <video width="145" height="145"
                                                           id="uploadedVideoImg[{{ $video->id }}]"
                                                           src="{{ asset('storage/'.substr($video->video, 6)) }}"></video>
                                                </label>
                                                <input type="file" class="form-control d-none"
                                                       id="uploadedVideo[{{ $video->id }}]"
                                                       name="uploadedVideo[{{ $video->id }}]"
                                                       accept="video/*"
                                                       onchange="getVideo(event, 'uploadedVideoImg[{{ $video->id }}]');"/>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                        <textarea onkeydown="checkWordLen(this);" maxlength="30"
                                                                  {{--                                                                  onkeyup="countWords(29, 'uploadedVideoDescription[{{ $video->id }}]', 'uploadedVideoCount[{{ $video->id }}]')"--}}
                                                                  placeholder="Description" rows="5"
                                                                  class="form-control"
                                                                  name="uploadedVideoDescription[{{ $video->id }}]"
                                                                  id="uploadedVideoDescription[{{ $video->id }}]">{{ $video->description }}</textarea>
                                                    <span style="font-size: 12px; color: grey">Max 30 characters</span>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="d-grid">
                                                    <button type="button" id="deleteVideo{{ $video->id }}"
                                                            onclick="deleteVideo({{ $video->id }})"
                                                            class="btn btn-block btn-custom">Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($user->videos->count() !== 2)
                                        <div class="row mt-3" id="remove_video[0]">
                                            <div class="col-6">
                                                <label class="image-select" for="video[0]">
                                                    <img width="145" height="145" class="img-fluid " id="videoImg[0]"
                                                         src="{{ asset('frontend/img/vectors/select-video.png') }}"
                                                         alt="Image Not Found!">
                                                </label>
                                                <input type="file" class="form-control d-none" id="video[0]"
                                                       name="video[0]" required
                                                       accept="video/*" onchange="getVideo(event, 'videoImg[0]');"/>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                        <textarea onkeydown="checkWordLen(this);" maxlength="30"
                                                                  {{--                                                                  onkeyup="countWords(29, 'videoDescription[0]', 'videoCount[0]')"--}}
                                                                  placeholder="Description" rows="5"
                                                                  class="form-control"
                                                                  name="videoDescription[0]"
                                                                  id="videoDescription[0]"></textarea>
                                                    <span style="font-size: 12px; color: grey">Max 30 Characters</span>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="d-grid">
                                                    <button type="button" onclick="removeVideoTab(0)"
                                                            class="btn btn-block btn-custom">Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="row mt-3" id="remove_video[0]">
                                        <div class="col-6">
                                            <label class="image-select" for="video[0]">
                                                <img width="145" height="145" class="img-fluid " id="videoImg[0]"
                                                     src="{{ asset('frontend/img/vectors/select-video.png') }}"
                                                     alt="Image Not Found!">
                                            </label>
                                            <input type="file" class="form-control d-none" id="video[0]"
                                                   name="video[0]" required
                                                   accept="video/*" onchange="getVideo(event, 'videoImg[0]');"/>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                        <textarea onkeydown="checkWordLen(this);" maxlength="30"
                                                                  {{--                                                                  onkeyup="countWords(29, 'videoDescription[0]', 'videoCount[0]')"--}}
                                                                  placeholder="Description" rows="5"
                                                                  class="form-control"
                                                                  name="videoDescription[0]"
                                                                  id="videoDescription[0]"></textarea>
                                                <span style="font-size: 12px; color: grey">Max 30 characters</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($user->videos->count() < 1)
                                <button type="button" onclick="addVideoTab()" id="addVideo"
                                        class="btn btn-block btn-custom mt-3">
                                    Add New Video
                                </button>
                            @endif

                        </div>

                        <div class="form-group mt-3">
                            <label for="">Add Urls</label>
                            <div id="urlTab">
                                @if($user->urls->count() != 0)
                                    @foreach($user->urls as $url)
                                        <div class="row mt-3" id="removeUrl[{{ $url->id }}]">
                                            <input type="number" value="{{ $url->id }}"
                                                   name="uploadedUrlIDs[{{ $url->id }}]"
                                                   hidden/>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input value="{{ $url->url }}" type="url" class="form-control"
                                                           name="uploadedUrl[{{ $url->id }}]"
                                                           id="uploadedUrl[{{ $url->id }}]"
                                                           onkeyup="validateYouTubeUrl('uploadedUrl[{{ $url->id }}]')"
                                                           placeholder="Url"
                                                           />

                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="d-grid">
                                                    <button type="button" id="deleteUrl{{ $url->id }}"
                                                            onclick="deleteUrl({{ $url->id }})"
                                                            class="btn btn-block btn-custom">Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row mt-3" id="remove_url[0]">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="url" class="form-control" name="url[0]" id="url[0]"
                                                       placeholder="Url" onkeyup="validateYouTubeUrl('url[0]')"/>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="d-grid">
                                                <button type="button" onclick="removeUrlTab(0)"
                                                        class="btn btn-block btn-custom">Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mt-3" id="remove_url[0]">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="url" class="form-control" name="url[0]" id="url[0]"
                                                       placeholder="Url" onkeyup="validateYouTubeUrl('url[0]')" />
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="d-grid">
                                                <button type="button" onclick="removeUrlTab(0)"
                                                        class="btn btn-block btn-custom">Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="button" onclick="addUrlTab()" id="addUrl"
                                    class="btn btn-block btn-custom mt-3">
                                Add New Url
                            </button>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" id="submit" class="btn btn-block btn-custom">Next</button>
                        </div>

                        <div class="text-center mt-5">
                            <div class="d-flex">
                                <a href="{{ route("addPersonalityView") }}" type="submit" id="back">
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function validateYouTubeUrl(id) {
            let url = document.getElementById(id).value;
            // url = $('#' + id).val();
            $('#submit').attr("disabled", "");
            if (url != undefined || url != '') {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                console.warn(url);
                var match = url.match(regExp);
                if (match && match[2].length == 11) {
                    $('#submit').removeAttr("disabled", "");
                } else {
                    $('#submit').attr("disabled", "");
                }
            }
        }

        $('textarea[name=bio]').keyup(function () {
            // Get value of textarea
            var str = $('textarea[name=bio]').val();
            // Check if value has more than 20 words
            if (str.split(" ").length > 100) {
                // Create string with first 20 words
                var str_new = str.split(" ").splice(0, 100).join(" ");
                // Overwrite the content with the first 20 words
                $('textarea[name=bio]').val(str_new);
            }
        });

        var wordLen = 30; // Maximum word length
        function checkWordLen(obj) {
            var len = obj.value.split(/[\s]+/);
            if (len.length > wordLen) {
                var str_new = obj.value.split(' ').splice(0, 30).join(' ');
                obj.value = str_new;
                // alert("You cannot put more than "+wordLen+" words in this text area."+ obj.value);
                // obj.oldValue = obj.value!=obj.oldValue?obj.value:obj.oldValue;
                // obj.value = obj.oldValue?obj.oldValue:"";
                return false;
            }
            return true;
        }

        function countWords(num, id, countID) {
            let text = document.getElementById(id).value;
            let numWords = num;

            for (let i = 0; i < text.length; i++) {
                let currentCharacter = text[i];
                if (currentCharacter === " ") {
                    numWords -= 1;
                }
            }
            numWords += 1;

            document.getElementById(countID).innerHTML = numWords;
        }

        function getImage(event, id) {
            let output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }

        function getVideo(event, string) {
            let file = event.target.files[0];
            let blobURL = URL.createObjectURL(file);

            let str = "<video controls autoplay src='" + blobURL + "' width='145' height='145' id='video'></video>";
            let output = document.getElementById(string);
            let trElement = output.parentNode;
            trElement.removeChild(output);
            trElement.innerHTML = str + trElement.innerHTML;
        }

        let i = 1;
        let j = 1;
        let h = 1;

        function addPhotosTab() {
            i++;
            if (i === 21) {
                $('#addPhoto').hide();
            }
            if (i <= 21) {
                let container = document.getElementById('photosTab');
                container.insertAdjacentHTML('beforeend',
                    "<div class='row mt-3' id='remove_image[" + i + "]'>" +
                    "<div class='col-6'>" +
                    "<label class='image-select' for='photos[" + i + "]'>" +
                    "<img width='145' height='145' " +
                    "class='img-fluid' id='photos_img[" + i + "]' " +
                    "src='{{ asset('frontend/img/vectors/select-image.png') }}'" +
                    "alt='Image Not Found!'>" +
                    "<input type='file' class='form-control' " +
                    "<input type='file' class='form-control' " +
                    "id='photos[" + i + "]' required " +
                    "name='photos[" + i + "]' accept='image/*' " +
                    "onchange='getImage(event, \"photos_img[" + i + "]\");' required/> " +
                    "</label>" +
                    "</div>" +
                    "<div class='col-6'> " +
                    "<div class='form-group'>" +
                    "<textarea onkeydown='checkWordLen(this);' maxlength='30'" +
                    // "onkeyup='countWords(29, 'photos_description[" + i + "]', 'imgCount[" + i + "]')'" +
                    "placeholder='Description' rows='5' class='form-control'" +
                    "name='photos_description[" + i + "]'" +
                    "id='photos_description[" + i + "]'></textarea>" +
                    "<span style='font-size: 12px; color: grey'>Max 30 characters" +
                    "</span>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-12 mt-3'>" +
                    "<div class='d-grid'>" +
                    "<button type='button' onclick='removePhotoTab(" + i + ")' class='btn btn-block btn-custom'>Remove</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );
            }
        }

        function removePhotoTab(index) {
            i--;
            const element = document.getElementById("remove_image[" + index + "]");
            element.remove();
            if (i <= 21) {
                $('#addPhoto').show();
            }
        }

        function addUrlTab() {
            let container = document.getElementById('urlTab');
            container.insertAdjacentHTML('beforeend',
                "<div class='row mt-3' id='remove_url[" + j + "]'>" +
                "<div class='col-12'>" +
                "<div class='form-group'>" +
                "<input type='url' onkeyup='validateYouTubeUrl(\"url[" + j + "]\")' class='form-control' required name='url[" + j + "]' id='url[" + j + "]' placeholder='Url'/>" +
                "</div>" +
                "</div>" +
                "<div class='col-12 mt-3'>" +
                "<div class='d-grid'>" +
                "<button type='button' onclick='removeUrlTab(" + j + ")' class='btn btn-block btn-custom'>Remove" +
                "</button>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
        }

        function removeUrlTab(index) {
            j--;
            const element = document.getElementById("remove_url[" + index + "]");
            element.remove();
        }

        function addVideoTab() {
            h++;
            if (h === 2) {
                $('#addVideo').hide();
            }
            if (h <= 2) {
                let container = document.getElementById('videosTab');
                container.insertAdjacentHTML('beforeend',
                    "<div class='row mt-3' id='remove_video[" + h + "]'>" +
                    "<div class='col-6'>" +
                    "<label class='image-select' for='video[" + h + "]'>" +
                    "<img width='145' height='145' class='img-fluid' id='videoImg[" + h + "]'" +
                    "src='{{ asset('frontend/img/vectors/select-video.png') }}'" +
                    "alt='Image Not Found!'>" +
                    "</label>" +
                    "<input type='file' class='form-control d-none' id='video[" + h + "]'" +
                    "name='video[" + h + "]' accept='video/*' " +
                    "onchange='getVideo(event, \"videoImg[" + h + "]\")' >" +
                    "</div>" +
                    "<div class='col-6'>" +
                    "<div class='form-group'>" +
                    "<textarea onkeydown='checkWordLen(this);' maxlength='30'" +
                    "placeholder='Description' rows='5'" +
                    "class='form-control'" +
                    "name='videoDescription[" + h + "]'" +
                    "id='videoDescription[" + h + "]'></textarea>" +
                    "<span style='font-size: 12px; color: grey'>Max 30 Characters</span>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-12 mt-3'>" +
                    "<div class='d-grid'>" +
                    "<button type='button' onclick='removeVideoTab(" + h + ")'" +
                    "class='btn btn-block btn-custom'>Remove" +
                    "</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );
            }
        }

        function removeVideoTab(index) {
            h--;
            const element = document.getElementById("remove_video[" + index + "]");
            element.remove();
            if (h < 2) {
                $('#addVideo').show();
            }
        }

        const deleteUrl = (id) => {
            $(document).ready(function () {
                $.ajax({
                    type: "GET",
                    url: '/delete_url/' + id,
                    success: function (response) {
                        const element = document.getElementById("removeUrl[" + id + "]");
                        element.remove();
                    },
                    error: function (xhr, status, error) {
                        // There was an error.
                    }
                });
            });
        }

        const deleteVideo = (id) => {
            $(document).ready(function () {
                $.ajax({
                    type: "GET",
                    url: '/delete_video/' + id,
                    success: function (response) {
                        const element = document.getElementById("removeVideo[" + id + "]");
                        element.remove();
                    },
                    error: function (xhr, status, error) {
                        // There was an error.
                    }
                });
            });
        }

        const deleteImage = (id) => {
            $(document).ready(function () {
                $.ajax({
                    type: "GET",
                    url: '/delete_img/' + id,
                    success: function (response) {
                        const element = document.getElementById("removeImg[" + id + "]");
                        element.remove();
                    },
                    error: function (xhr, status, error) {
                        // There was an error.
                    }
                });
            });
        }

        $(function () {
            var $progress = $('#progress');
            $(document).ajaxStart(function () {
                //only add progress bar if not added yet.
                if ($progress.length === 0) {
                    $progress = $('<div><dt/><dd/></div>').attr('id', 'progress');
                    $("body").append($progress);
                }
                $progress.width((50 + Math.random() * 30) + "%");
            });

            $(document).ajaxComplete(function () {
                //End loading animation
                $progress.width("100%").delay(10000).fadeOut(10000, function () {
                    $progress.width("0%").delay(10000).show();
                });
            });

            $('#submit').on('click', function () {
                $.getJSON('http://jsonip.com');
            });
        });
    </script>
@endsection
