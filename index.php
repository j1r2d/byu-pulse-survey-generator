<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="BYU Pulse Survey Generator">
        <meta name="author" content="Jared Stark">
        <meta name="generator" content="Hugo 0.84.0">
        <title>BYU Pulse Survey Generator</title>
        <link rel="icon" type="image/png" href="favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        .ddown {
            font-family: Sans-Serif, "Font Awesome 5 Pro";
            font-weight: 400;
        }
        header {
            margin-top: 20px;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        textarea {
          resize: none;
        }
        </style>
    </head>
    <body class="d-flex flex-column h-100">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">BYU Pulse Survey Generator</a>
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="https://www.youtube.com/watch?v=ll5UUjwZlWw" id="video_tutorial_link" target="_blank">Video Tutorial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="https://github.com/j1r2d/byu-pulse-survey-generator/" id="source_link" target="_blank">Source on GitHub</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="flex-shrink-0">
            <div class="container">
                <h1 class="mt-5">Create your pulse survey</h1>
                <p class="lead">This generator is intended to facilitate the process of creating pulse surveys. Use the fields the generate the HTML code, and then copy and paste it into the code editor while editing a page.</p>
                <p>This tool is relatively new and is regularly being updated. Please feel free to reach out to <a href="mailto:jstark7@byu.edu">jstark7@byu.edu</a> with any questions or suggestions.</p>
                <br>
                <div class="alert alert-danger" role="alert" id="display-error-form" style="display:none;"></div>
                <form method="post" id="form">
                    <h3>Course information</h3>
                    <div class="mb-3">
                        <label for="course_name" class="form-label"><strong>Course name</strong>&nbsp;&nbsp;<span style="color:#084298;"><i class="far fa-exclamation-triangle"></i>&nbsp;Required</span></label>
                        <input type="text" class="form-control" id="course_name" placeholder="example: ACC 200, STAT 121, etc.">
                    </div>
                    <div class="mb-3">
                        <label for="drill_down_items" class="form-label"><strong>Drill-down items (enter one per line)</strong></label>
                        <textarea class="form-control" id="drill_down_items" rows="5"></textarea>
                    </div>
                    <h3>Links</h3>
                    <div class="accordion" id="links_accordion">
                        <?php
                        $num = 1;
                        while($num <= 5) {
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="link_<?php echo $num; ?>_heading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#link_<?php echo $num; ?>_collapse" aria-controls="link_<?php echo $num; ?>_collapse" aria-expanded="<?php if ($num == 1) { echo "true"; } else { echo "false"; } ?>">
                                        <strong><?php echo "Link ".$num; ?></strong>
                                    </button>
                                </h2>
                                <div id="link_<?php echo $num; ?>_collapse" class="accordion-collapse <?php if ($num == 1) { echo "collapse show"; } else { echo "collapse"; } ?>" aria-labelledby="link_<?php echo $num; ?>_heading" data-bs-parent="#links_accordion">
                                    <div class="accordion-body">
                                        <?php
                                        if ($num == 1) {
                                            ?>
                                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                                <div>
                                                    <i class="far fa-exclamation-triangle"></i><i>&nbsp;You must add at least one link to the pulse survey; the others are optional. Each field below is required.</i>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="mb-3">
                                            <label for="link_<?php echo $num;?>_title" class="form-label"><strong>Link <?php echo $num;?> Title</strong></label>
                                            <input type="text" class="form-control" id="link_<?php echo $num;?>_title" placeholder="Link title here">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Link <?php echo $num; ?> Destination</strong></label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="link_<?php echo $num; ?>_radio" id="link_<?php echo $num; ?>_radio_url" checked>
                                                <label class="form-check-label" for="link_<?php echo $num; ?>_radio_url">URL</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="link_<?php echo $num; ?>_radio" id="link_<?php echo $num; ?>_radio_email">
                                                <label class="form-check-label" for="link_<?php echo $num; ?>_radio_email">Compose email</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="link_<?php echo $num; ?>_radio" id="link_<?php echo $num; ?>_radio_message_instructor">
                                                <label class="form-check-label" for="link_<?php echo $num; ?>_radio_message_instructor">Compose Canvas message to instructor(s)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="link_<?php echo $num; ?>_radio" id="link_<?php echo $num; ?>_radio_message_ta">
                                                <label class="form-check-label" for="link_<?php echo $num; ?>_radio_message_ta">Compose Canvas message to TA(s)</label>
                                            </div>
                                        </div>
                                        <div class="mb-3" style="display:none;" id="link_<?php echo $num; ?>_email_div">
                                            <label for="link_<?php echo $num;?>_email" class="form-label"><strong>Link <?php echo $num;?> Email Address</strong></label>
                                            <input type="text" class="form-control email-hide" id="link_<?php echo $num;?>_email"<?php if ($num == 1) { echo ' placeholder="instructor@byu.edu"'; } ?>>
                                        </div>
                                        <div class="mb-3">
                                            <label for="link_<?php echo $num;?>_url" class="form-label"><strong>Link <?php echo $num;?> URL (enter the full URL)</strong></label>
                                            <input type="text" class="form-control" id="link_<?php echo $num;?>_url" placeholder="https://">
                                        </div>
                                        <div class="mb-3">
                                            <label for="link_<?php echo $num;?>_type" class="form-label"><strong>Link <?php echo $num;?> Type</strong></label>
                                            <select class="form-select" aria-label="Default select example" id="link_<?php echo $num;?>_type">
                                                <option selected>Select...</option>
                                                <option value="--message-instructor">A link to send a Canvas message to the course's instructor(s)</option>
                                                <option value="--message-tas">A link to send a Canvas message to the course's TA(s)</option>
                                                <option value="--message">A link to send a Canvas message to someone else</option>
                                                <option value="--email-instructor">A link to send an email to the course's instructor</option>
                                                <option value="--email-tas">A link to send an email to the course's TA(s)</option>
                                                <option value="--email">A link to send an email to someone else</option>
                                                <option value="--officehours-instructor">A link to view the instructor's office hours</option>
                                                <option value="--officehours-tas">A link to view the TAs' office hours</option>
                                                <option value="--officehours">A link to view someone else's office hours</option>
                                                <option value="--talab-hours">A link to view the TA lab hours</option>
                                                <option value="--talab-online">A link to visit an online TA lab</option>
                                                <option value="--talab">A link for any other TA interaction</option>
                                                <option value="--resources-canvas">A link to study resources on Canvas</option>
                                                <option value="--resources-external">A link to external study resources</option>
                                                <option value="--other">A link to anything else that doesn't fall into one of the above categories</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="link_<?php echo $num; ?>_icon" class="form-label"><strong>Link <?php echo $num; ?> Icon</strong></label>
                                            <select class="form-select" id="link_<?php echo $num; ?>_icon" size="5">
                                                <option selected>Select...</option>
                                                <?php
                                                $buttons = array("address-book" => "f2b9", "address-card" => "f2bb", "at" => "f1fa", "atom" => "f5d2", "bell" => "f0f3", "bolt" => "f0f3", "book-open" => "f518", "bookmark" => "f02e", "box-open" => "f49e", "calculator" => "f1ec", "calendar" => "f133", "chalkboard" => "f51b", "chalkboard-teacher" => "f51c", "chart-bar" => "f080", "clipboard" => "f328", "comment" => "f075", "envelope-open-text" => "f658", "edit" => "f044", "exclamation-triangle" => "f071", "file" => "f15b", "folder-open" => "f07c", "globe-americas" => "f57d", "graduation-cap" => "f19d", "home" => "f015", "hourglass" => "f254", "id-card" => "f2c2", "info" => "f129", "key" => "f084", "laptop" => "f109", "play" => "f04b", "question" => "f128", "reply" => "f3e5", "save" => "f0c7", "search" => "f002", "share" => "f064", "tag" => "f02b", "user" => "f007", "user-graduate" => "f501");
                                                foreach($buttons as $button => $code) {
                                                    ?>
                                                    <option class="ddown" value="<?php echo $button; ?>">&#x<?php echo $code; ?>;&nbsp;&nbsp;<?php echo ucwords(str_replace("-"," ",$button)); ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $num++;
                        }
                        ?>
                    </div>
                    <br>
                    <p><button type="submit" class="btn btn-primary submit" id="submit"><i class="fas fa-cogs"></i>&nbsp; Generate</button></p>
                </form>
                <br>
                <div>
                    <h3>Output&nbsp;&nbsp;<button type="button" class="btn btn-outline-secondary" id="copy">Copy Output</button>&nbsp;&nbsp;<button type="button" class="btn btn-outline-danger" id="clear">Clear All</button></h3>
                    <br>
                    <div class="alert alert-warning" role="alert" id="code_instructions" style="display:none;">
                        <i class="far fa-info-circle"></i>&nbsp;<i>Paste this code into the Canvas HTML editor where you want the survey to appear (usually near the bottom of the page before links to assessments, progress meters, etc.) <strong style="color:red;">Do NOT place the Pulse Survey directly on a quiz or assignment page; always place it on the content page before an assessment.</strong></i>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="output" rows="10" style="font-family:Courier New;" readonly></textarea>
                    </div>
                </div>
            </div>
        </main>
        <br>
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <span class="text-muted">Copyright &copy; <?php echo date("Y"); ?> Jared Stark. All Rights Reserved.</span>
            </div>
        </footer>
        <script src="https://kit.fontawesome.com/5ec1b67ef6.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() { 
                let userAgentString = navigator.userAgent;
                let safariAgent = userAgentString.indexOf("Safari") > -1;
                let chromeAgent = userAgentString.indexOf("Chrome") > -1;
                if ((chromeAgent) && (safariAgent)) safariAgent = false;
                if (safariAgent == true) {
                    alert("Icons may not load properly on Safari. Please use a different browser.");
                }
            })
            $(document).ready(function() {
                $('#submit').click(function(e) {
                    $("#display-error-form").css("display","hidden");
                    e.preventDefault();
                    const regexCourse = new RegExp("[^a-zA-Z0-9]+");
                    const regexEmail = new RegExp("^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$", "i")
                    const regexUrl = new RegExp("^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$")
                    let code = '';
                    let errorMsg = '';
                    let ddArray = new Array();
                    
                    let course_name = $("#course_name").val();
                    let drill_down_items = $("#drill_down_items").val();
                    let link_1_title = $('#link_1_title').val();
                    let link_1_url = $('#link_1_url').val();
                    let num = 1;
                    while (num <= 5) {
                        let link_title = $(`#link_${num}_title`).val();
                        let link_url = $(`#link_${num}_url`).val();
                        let link_type = $(`#link_${num}_type`).val();
                        let link_icon = $(`#link_${num}_icon`).val();

                        let lengthTitle = link_title.length;
                        let lengthUrl = link_url.length;
                        let lengthType = link_type.length;
                        let lengthIcon = link_icon.length;
                        if(num === 1){
                            if(lengthTitle === 0 || lengthUrl === 0 || link_type == 'Select...' || link_icon == 'Select...'){
                                errorMsg = `Please enter a title for Link ${num}`;
                            }
                        }
                        
                        if(lengthTitle > 0){
                            if (link_type == "Select..." || link_icon == "Select...") {
                                errorMsg = `Please ensure all of the fields for Link ${num} are filled out.`;
                            }else if(link_url.substr(0,7) === 'mailto:' && regexEmail.test(link_url.substr(7)) !== true){
                                errorMsg = `Please enter a valid email address for Link ${num}`; 
                            }else if(regexUrl.test(link_url) !== true){
                                errorMsg = `Please enter a valid URL for Link`;
                            }
                        }
                        num++;
                    }
                   
                    //validation link title and url
                    if(link_1_title.length > 0 && link_1_url.length === 0){
                        errorMsg = "Please include at least one link."
                    }
                    if(link_1_title.length === 0 && link_1_url.length === 0){
                        errorMsg = "Please give Link 1 a title."
                    }
                     // validation drill down items
                    if(drill_down_items.length > 0){
                        ddArray = drill_down_items.split(/\r?\n/);
                    }else{
                        errorMsg = 'Please enter the Drill down items';
                    }
                    // validation course name 
                    if(course_name.length === 0){
                        errorMsg = 'Please enter the course name';
                    }
                    course_name = course_name.replace(" ","");
                    
                    if(regexCourse.test(course_name) === true){
                       errorMsg = 'The course name should only contain numbers, letters, and spaces.';
                    }else{
                        course_name = '--' + course_name.toLowerCase().replace(" ","");
                    }
                    if(errorMsg.length === 0 ){
                        let code;
                        code = "<!-- BEGIN BYU PULSE SURVEY -->";
                        code += "\n<div style=\"background-color:white;\">";
                        code += "\n<ul class=\"dce-pulse "+course_name+"\" data-apvr=\"1.2\">";
                        if(ddArray.length > 0){
                            ddArray.forEach(el => {
                                if(el.length > 1){
                                    code += `<li>${decodeURI(el.replace("+"," "))}</li>`;
                                }
                                
                            })
                        }
                        let num = 1;
                        while (num <= 5) {
                            let link_title = $(`#link_${num}_title`).val();
                            let link_url = $(`#link_${num}_url`).val();
                            let link_type = $(`#link_${num}_type`).val();
                            let link_icon = $(`#link_${num}_icon`).val();

                            let lengthTitle = link_title.length;
                            let lengthUrl = link_url.length;
                            let lengthType = link_type.length;
                            let lengthIcon = link_icon.length;
                            let icon = '';
                            if(lengthTitle !== 0){
                                if(lengthIcon !== 0 && link_icon != "Select..." ){
                                    icon = `<i class="fas fa-${link_icon}"></i>`;
                                }else{
                                    icon = '';
                                }
                                code += `\n <li class="${link_type}"><a href="${link_url}" target="_blank">${icon}${link_title}</a></li>`
                            }
                            num++;
                        }
                        code += "\n</ul>";
                        code += "\n</div>";
                        code += "\n<!-- END BYU PULSE SURVEY -->";
                        
                        $("html, body").animate({ scrollTop: $(document).height() }, 100);
                        $("#output").val(code);
                        $('#code_instructions').fadeIn('slow').delay(20000).hide(0);
                    }else{
                        $("#display-error-form").css("display","block");
                        $("#display-error-form").html('<i class="far fa-exclamation-triangle"></i>&nbsp;'+errorMsg);
                        window.scrollTo(0,0);
                        $('#display-error-form').fadeIn('slow').delay(20000).hide(0);
                    }
                    // $.ajax({
                    //     type: "POST",
                    //     url: "form.php",
                    //     dataType: "json",
                    //     data: {course_name:course_name, drill_down_items:drill_down_items, <?php $num = 1; while($num <= 5) { if ($num == 5) { $comma = ""; } else { $comma = ", "; } echo 'link_'.$num.'_title:link_'.$num.'_title, link_'.$num.'_url:link_'.$num.'_url, link_'.$num.'_type:link_'.$num.'_type, link_'.$num.'_icon:link_'.$num.'_icon'.$comma; $num++; } ?>},
                    //     success: function(data) {
                    //         if (data.code == "200") {
                                
                    
                    //         }
                    //         else {
                    //             $("#display-error-form").css("display","block");
                    //             $("#display-error-form").html('<i class="far fa-exclamation-triangle"></i>&nbsp;'+data.msg);
                    //             window.scrollTo(0,0);
                    //             $('#display-error-form').fadeIn('slow').delay(20000).hide(0);
                    //         }
                    //     }
                    // });
                });
            });
            $(document).ready(function() {
                $('#copy').click(function() {
                    var copyText = document.getElementById("output");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    document.execCommand("copy");
                    $('#copy').removeClass('btn btn-outline-secondary');
                    $('#copy').addClass('btn');
                    $('#copy').addClass('btn-outline-success');
                    $('#copy').text("Copied!");
                    setTimeout(function(){
                        $('#copy').removeClass('btn btn-outline-success');
                        $('#copy').addClass('btn');
                        $('#copy').addClass('btn-outline-secondary');
                        $('#copy').text("Copy Output");
                    }, 2000);
                });
            });
            $(document).ready(function() {
                $("#clear").click(function() {
                    if (confirm("Are you sure you want to clear all fields?")) {
                        document.getElementById("form").reset();
                        $("#output").val("");
                        $('#code_instructions').css('display','none');
                        $('#display-error-form').css('display','none');
                        $("#link_1_collapse").collapse('show');
                    }
                });
            });
            <?php
            $num = 1;
            while($num <= 5) {
                ?>
                $(document).ready(function() { 
                    $('#link_<?php echo $num; ?>_radio_message_instructor').click(function() {
                        $("#link_<?php echo $num; ?>_email_div").css("display","none");
                        $("#link_<?php echo $num; ?>_title").val("Message the instructor");
                        $("#link_<?php echo $num; ?>_url").prop("disabled", true);
                        $("#link_<?php echo $num; ?>_url").val("https://byu.instructure.com/conversations#__COURSE_TEACHERS__");
                        $("select#link_<?php echo $num; ?>_type")[0].selectedIndex = 1;
                        $("#link_<?php echo $num; ?>_type").prop("disabled",true);
                        $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('envelope-open-text', array_keys($buttons)) + 1; ?>;
                        $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                    });
                    $('#link_<?php echo $num; ?>_radio_email').click(function() {
                        $("#link_<?php echo $num; ?>_email_div").fadeIn(100).css("display","block");
                        $("#link_<?php echo $num; ?>_title").val("Send us an email");
                        $("#link_<?php echo $num; ?>_url").val("mailto:")
                        $("#link_<?php echo $num; ?>_url").prop("disabled", true);
                        $("select#link_<?php echo $num; ?>_type")[0].selectedIndex = 4;
                        $("#link_<?php echo $num; ?>_type").prop("disabled",false);
                        $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('at',array_keys($buttons)) + 1; ?>;
                        $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                    })
                    $('#link_<?php echo $num; ?>_email').bind('input', function() {
                        $('#link_<?php echo $num; ?>_url').val('mailto:' + $(this).val());
                    });
                    $('#link_<?php echo $num; ?>_radio_message_ta').click(function() {
                        $("#link_<?php echo $num; ?>_email_div").css("display","none");
                        $("#link_<?php echo $num; ?>_title").val("Message the TAs");
                        $("#link_<?php echo $num; ?>_url").prop("disabled", true);
                        $("#link_<?php echo $num; ?>_url").val("https://byu.instructure.com/conversations#__COURSE_TAS__");
                        $("select#link_<?php echo $num; ?>_type")[0].selectedIndex = 2;
                        $("#link_<?php echo $num; ?>_type").prop("disabled",true);
                        $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('envelope-open-text', array_keys($buttons)) + 1; ?>;
                        $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                    });
                    $('#link_<?php echo $num; ?>_radio_url').click(function() {
                        $("#link_<?php echo $num; ?>_email_div").css("display","none");
                        $("#link_<?php echo $num; ?>_title").val("");
                        $("#link_<?php echo $num; ?>_url").prop("disabled", false);
                        $("#link_<?php echo $num; ?>_url").val("");
                        $("select#link_<?php echo $num; ?>_type")[0].selectedIndex = 0
                        $("#link_<?php echo $num; ?>_type").prop("disabled",false);;
                        $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = 0;
                        $("#link_<?php echo $num; ?>_icon").prop("disabled",false);
                    });
                    $('#link_<?php echo $num; ?>_type').click(function() { 
                        var link_<?php echo $num; ?>_type_value = $('#link_<?php echo $num; ?>_type').val();
                        if (link_<?php echo $num; ?>_type_value == "--message-instructor" || link_<?php echo $num; ?>_type_value == "--message-tas" || link_<?php echo $num; ?>_type_value == "--message") {
                            $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('envelope-open-text', array_keys($buttons)) + 1; ?>;
                            $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                        }
                        else if (link_<?php echo $num; ?>_type_value == "--email-instructor" || link_<?php echo $num; ?>_type_value == "--email-tas" || link_<?php echo $num; ?>_type_value == "--email") {
                            $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('at', array_keys($buttons)) + 1; ?>;
                            $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                        }
                        else if (link_<?php echo $num; ?>_type_value == "--officehours-instructor" || link_<?php echo $num; ?>_type_value == "--officehours-tas" || link_<?php echo $num; ?>_type_value == "--officehours" || link_<?php echo $num;?>_type_value == "--talabhours") {
                            $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('calendar', array_keys($buttons)) + 1; ?>;
                            $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                        }
                        else if (link_<?php echo $num; ?>_type_value == "--talab-online" || link_<?php echo $num; ?>_type_value == "--talab") {
                            $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('chalkboard-teacher', array_keys($buttons)) + 1; ?>;
                            $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                        }
                        else if (link_<?php echo $num; ?>_type_value == "--resources-canvas" || link_<?php echo $num; ?>_type_value == "--resources-external") {
                            $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = <?php echo array_search('book-open', array_keys($buttons)) + 1; ?>;
                            $("#link_<?php echo $num; ?>_icon").prop("disabled",true);
                        }
                        else {
                            $("select#link_<?php echo $num; ?>_icon")[0].selectedIndex = 0;
                            $("#link_<?php echo $num; ?>_icon").prop("disabled",false);
                        }
                        
                    });
                });
                <?php
                $num++;
                }
            ?>
        </script>
    </body>
</html>
