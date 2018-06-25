<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!--Bootsrtap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
            .container{
                border-left: 1px solid lightgray;
                border-right: 1px solid lightgray;
                border-bottom: 1px solid lightgray;
            }
            .sliderCont{
                text-align: center;
            }
            .sliderCont ul li{
                cursor: pointer;
            }
            .errMsg{
                background-color: pink;
                color:red;
                border:1px solid red;
                display: none;
            }
            .suggestionBoxCont{
                position:relative;
                margin-top: 30px;
            }
            .categoryListItem{
                width:100%;
                background-color: white;
                border:1px solid black;
                cursor: pointer;
            }
            #suggesstion-box ul{
                list-style: none; 
            }
            #categoriesHolder{
                overflow-x: auto;
                max-width: 92vmin;
                padding-bottom:2px;
                background-color: #f7f7f7;
                border: 1px solid #e6e6e6;
            }
            #categoriesHolder a{
                cursor: pointer;
            }
            #categoriesHolder a:not(:first-child){
                border-left:1px solid gray;
            }
            #categoriesHolder a:hover{
                background-color: #eaecec;
            }
            .bolder{
                font-weight: bold;
                background-color: #eaecec;
            }
            #categoriesHolder::-webkit-scrollbar {
                height: 10px;
            }

            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
                /*                border-radius: 10px;*/
            }

            ::-webkit-scrollbar-thumb {
                /*                border-radius: 10px;*/
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
            }
            .progressbarFather{
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .hidden{
                position:fixed;
                opacity: 0;
                width:0px;
                height:0px;
                z-index: 0;
            }
            #displayFormBTN{
                z-index: 9000;
            }
            #uploadedImage{
                height: 20px;
                display: none;
            }
            .file_drag_over{
                background-color: gray;
                opacity:0.5;
                border:dotted 1px black;
            }
            #collapseForm{
                border-bottom: 1px solid lightgray;
                padding-bottom: 10px;
            }
            button[data-target="#collapseForm"]{
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <input type="file" class="hidden" id="uploadImage"/>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div id="categoriesHolder" class="navbar-nav">

                    </div>
                </div>
            </nav>
            <div id="demo" class="sliderCont carousel slide" data-ride="carousel">
                <ul id='carouselIndicators' class="carousel-indicators">

                </ul>
                <div id='carouselInner' class="carousel-inner">

                </div>
                <div id="sliders">
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <button class="btn btn-basic" type="button" data-toggle="collapse" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                Upload Image Show/Hide</button>
            <div id="collapseForm" class="collapse">
                <div class="progressbarFather progress">
                    <div id="uploadProgressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <form action="" id="uploader">
                    <div class="form-group">
                        <label for="uploadImage">Drag Image to upload</label>
                        <img id="drop_here" src="images/folder.png" title="Drag And Drop Image" style="height:100px"/>
                        <img id="uploadedImage" src="images/check.png"/>
                    </div>
                    <div class="form-group">
                        <label for="pictureName">Picture Name</label>
                        <input type="text" class="form-control" id="pictureName"/>
                    </div>
                    <div class="form-group">
                        <label for="pictureCategory">Picture #(Category)</label>
                        <input type="text" class="form-control" id="pictureCategory" autocomplete="false"/>
                        <div class="errMsg" id="imgErrMsg"></div>
                        <div class="suggestionBoxCont">
                            <div id="suggesstion-box"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Add!</button>
                </form>
            </div>
        </div>

    </body>
    <script>
        let nowTriggeredCategory;
        let categoriesAutoComplete = [];
        // onload selfInvoke Function
        (() => {
            $('#sliders').hide();
            setTimeout(() => {
                /// true will trigger the slideBar to get the right images.
                getAllCategories(createTrigger = true);
            }, 60);
        })();
        /// clears form after successful adding
        let clearForm = (formInputsArray) => {
            $(formInputsArray).each((i, input) => {
                input.wrap('<form>').closest('form').get(0).reset();
                input.unwrap();
            });
        };
        /// active category nav item and slidebar show relevant pictures onclick.
        let activeNavItem = (it) => {
            $('.nav-item').attr("class", "nav-item nav-link");
            $(it).attr("class", "nav-item nav-link bolder active");
            /// active and now.. slidebar show relevant pictures.
            let categoryName = it.dataset.name
            let categoryId = it.dataset.id
            nowTriggeredCategory = it.dataset.loop;
            slidebarDataShower(categoryId, categoryName);
            $('#pictureCategory')[0].value = categoryName;
            return false;
        };
        // gets id to show in slidebar relevant category images
        let slidebarDataShower = (categoryId, categoryName) => {
            $('#carouselIndicators').empty();
            $('#carouselInner').empty();
            $('#sliders').show();
            let formData = new FormData();
            formData.append('categoryId', categoryId);
            formData.append('getCategoryImages', 'action');
            $.ajax({
                url: "Controller/getCategoryImages.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    let images = JSON.parse(response);
                    $(images).each((i, image) => {
                        let active = '';
                        if (i === 0) {
                            active = " active ";
                        }
                        ;
                        $('#carouselIndicators').append(`<li data-target="#demo" data-slide-to="${i}" class='${active}'></li>`);
                        $('#carouselInner').append(`<div class="carousel-item ${active}">
                <img src="uploads/${image.location}" alt="${image.name}" width="1100" height="500">
                <div class="carousel-caption">
                    <h3>${image.name}</h3>
                    <p>${categoryName}</p>
                </div>   
            </div>`)

                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        };
        /// get all categories and set them on nav bar.
        let getAllCategories = (createTrigger = false) => {
            $.ajax({
                url: "Controller/start.php",
                type: "GET",
                success: function (response) {
                    $('#categoriesHolder').empty();
                    categoriesAutoComplete = [];
                    response = JSON.parse(response);
                    setTimeout(() => {
                        $(response).each((i, category) => {
                            $('#categoriesHolder').append(`<a class="nav-item nav-link" data-loop='${i+1}' data-id='${category.id}' data-name='${category.name}' onclick='activeNavItem(this);'>${category.name}</a>`);
                            categoriesAutoComplete.push(category.name);
                        });
                    }, 10);
                    if (createTrigger) {
                        //page start called.
                        setTimeout(() => {
                            let chosenVarNum = $($('#categoriesHolder')[0]).children().length;
                            if (chosenVarNum > 0) {
                                nowTriggeredCategory = Math.floor(Math.random() * ((chosenVarNum) - 1)) + 1;
                                $("a[data-loop='" + nowTriggeredCategory + "']").trigger("click");
                            }
                            ;
                        }, 40);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        };
        /// check image type and size before uploading.
        let checkImage = (file) => {
            let imageValid = false;
            let allowedTypes = ['image/jpg', 'image/jpeg', 'image/gif', 'image/bmp', 'image/png'];
            $(allowedTypes).each((i, allowed) => {
                if (file.type === allowed) {
                    imageValid = true;
                }
            });
            return imageValid;
        };
        /// function to show err msg in relevant div and message
        let showErrMsg = (errID, message) => {
            $('#' + errID + '').html(message);
            $('#' + errID + '').show();
            setTimeout(() => {
                $('#' + errID + '').hide();
            }, 3000);
        };
        /// check uploading image form
        let checkRestOfImageUploadForm = (objectForm, callBackFunc) => {
            let imageName = objectForm.name.val();
            let imageCategory = objectForm.category.val();
            let hashtagName = /^#\w+$/.test(imageName);
            if (imageName.length > 0 && !(hashtagName)) {
                /// not empty
                let hashtagCategory = /^#\w+$/.test(imageCategory);
                if (hashtagCategory && imageCategory.length > 3) {
                    /// category name has hashtag on start
                    callBackFunc(objectForm.file, imageName, imageCategory);
                    return true;
                } else {
                    /// 1 means category format is wrong
                    return 1;
                }
            } else {
                // missing image name...
                showErrMsg('imgErrMsg', "image name is empty or includes #");
            }
        };
        /// after all image upload validations, call db and add.
        let addImage = (image, name, category) => {
            /// after all validations.. we can ask to add image to Db.
            let formData = new FormData();
            formData.append("imageFile", image, ".jpg");
            formData.append("imageName", name);
            formData.append("imageCategory", category);
            formData.append("upload", "action");
            $.ajax({
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', progress, false);
                    }
                    return myXhr;
                },
                url: "Controller/upload.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    let formInputs = [$('#uploadImage'), $('#pictureName'), $('#pictureCategory')];
                    switch (response) {
                        case '1':
                            $('#uploadedImage').hide();
                            showErrMsg('imgErrMsg', "couln't upload image, try again later.");
                            break;
                        case '2':
                            /// clear all fields or something..
                            clearForm(formInputs);
                            setTimeout(() => {
                                getAllCategories();
                            }, 50);
                            $('#uploadedImage').hide();
                            setTimeout(() => {
                                debugger;
                                $("a[data-loop='" + nowTriggeredCategory + "']").trigger("click");
                            }, 80)
                            break;
                        case '3':
                            showErrMsg('imgErrMsg', "couln't communicate server.");
                            break;
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function () {
                    let formInputs = [$('#uploadImage'), $('#pictureName'), $('#pictureCategory')];
                    showErrMsg('imgErrMsg', "couln't upload image, try again later.");
                    /// clear all fields or something..
                    clearForm(formInputs);
                }
            });
        };
        //// when click on add an image, the function who call all the functions to check if valid and what to response if not.
        $('#uploader').on("submit", (e) => {
            $(this).submit(false);
            //reset progress bar
            clearProgressBar();
            //
            /// image validations
            if ($("#uploadImage")[0].filelist.length < 1) {
                /// no files selected...
                showErrMsg('imgErrMsg', "no file selected");
            } else {
                /// keep going..
                let file = $("#uploadImage")[0].filelist[0];
                let isImageValid = checkImage(file);
                if (isImageValid) {
                    /// file is image 
                    if (file.size < 20000000) {
                        // size ok -under 20MB
                        let response = checkRestOfImageUploadForm({name: $('#pictureName'), category: $('#pictureCategory'), file: file}, addImage);
                        if (response === 1) {
                            /// name and category is not ok
                            showErrMsg('imgErrMsg', "category format is wrong (#category)");
                        }
                    } else {
                        ///
                        showErrMsg('imgErrMsg', "image size is too big: max 20MB");
                        $('#uploadedImage').hide();
                    }
                } else {
                    // uploaded file mime type is not an image
                    showErrMsg('imgErrMsg', "file is not an image type");
                    $('#uploadedImage').hide();
                }
            }
        });

        //
        let progress = (e) => {
            let uploadProgressBar = $('#uploadProgressBar');
            //
            if (e.lengthComputable) {
                let percentage = Math.round((e.loaded / e.total) * 100);
                uploadProgressBar.attr("style", "width:" + percentage + "%;");
                uploadProgressBar.attr("valuenow", percentage);
                uploadProgressBar.html(percentage + "%");
                //
                if (percentage >= 100)
                {
                    // process completed  
                    uploadProgressBar.html("complete");
                    uploadProgressBar.attr("class", "progress-bar bg-success");
                    setTimeout(() => {
                        clearProgressBar()
                    }, 3000);
                }
            }
        };
        let clearProgressBar = () => {
            ///reset progress bar
            let uploadProgressBar = $('#uploadProgressBar');
            uploadProgressBar.attr("style", "width: 0%;");
            uploadProgressBar.attr("valuenow", 0);
            uploadProgressBar.html("0%");
            uploadProgressBar.attr("class", "progress-bar");
        };


        //dropable image();
        /// prevent uploading via click
        $(() => {
            $("#uploadImage").click(function (e) {
                e.preventDefault();
            });
        });
        ///
        $("#drop_here").on('dragover', () => {
            $("#drop_here").addClass("file_drag_over");
            return false;
        });
        $("#drop_here").on('dragleave', () => {
            $("#drop_here").removeClass("file_drag_over");
            return false;

        });
        $("#drop_here").on('drop', (e) => {
            e.preventDefault();
            $("#drop_here").removeClass("file_drag_over");
            $("#uploadImage")[0].filelist = e.originalEvent.dataTransfer.files;
            if ($("#uploadImage")[0].filelist.length > 0) {
                $('#uploadedImage').show();
            } else {
                showErrMsg('imgErrMsg', "file didn't inserted right, try again please;");
            }
        });
        //ennd of dropable;

        //
        //jQuery UI. start()
        //autocomplete();
        $(() => {
            $("#pictureCategory").autocomplete({
                source: categoriesAutoComplete,
            });
        });
    </script>
</html>
